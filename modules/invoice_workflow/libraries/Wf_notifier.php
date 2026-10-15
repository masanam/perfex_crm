<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Wf_notifier — Notification Engine
 *
 * Mengirimkan notifikasi email + in-app Perfex berdasarkan aksi workflow.
 * Menggunakan queue dengan retry untuk ketahanan terhadap kegagalan email.
 *
 * @package invoice_workflow
 */
class Wf_notifier
{
    private CI_Controller $CI;

    /**
     * Peta: aksi → siapa yang diberitahu.
     * Format: action => [['role_slug' => string, 'channel' => 'both|email|in_app'], ...]
     */
    private array $notificationMap = [
        'submit'          => [['role' => 'ap_receiver',    'channel' => 'both']],
        'verify'          => [['role' => 'ap_receiver',    'channel' => 'in_app']],
        'approve'         => [
            // Saat approve di ap_review → beritahu tax
            // Mapping dinamis di resolveRecipients()
        ],
        'return'          => [['role' => 'submitter',      'channel' => 'both']],
        'acknowledge'     => [['role' => 'pending_approver', 'channel' => 'both']],
        'reject'          => [['role' => 'submitter',      'channel' => 'both']],
        'process_payment' => [['role' => 'submitter',      'channel' => 'email']],
        'confirm_payment' => [['role' => 'submitter',      'channel' => 'both']],
        'delegate'        => [['role' => 'delegatee',      'channel' => 'both']],
        'resubmit'        => [['role' => 'ap_receiver',    'channel' => 'both']],
    ];

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model(IWF_MODULE_NAME . '/Invoice_workflow_model', 'iwf_model');
        $this->CI->load->model(IWF_MODULE_NAME . '/Wf_approvers_model',    'iwf_approvers');
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Public API
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Queue notifikasi pasca-transisi workflow.
     * Dipanggil dari Invoice_state_machine setelah transisi berhasil.
     */
    public function queueNotification(int $invoiceId, int $logId, string $action): void
    {
        $recipients = $this->resolveRecipients($invoiceId, $action, $logId);

        foreach ($recipients as $recipient) {
            $this->CI->iwf_model->queueNotification([
                'invoice_id'        => $invoiceId,
                'log_id'            => $logId,
                'recipient_type'    => $recipient['type'],
                'recipient_id'      => $recipient['id'],
                'notification_type' => 'wf_' . $action,
                'channel'           => $recipient['channel'] ?? 'both',
                'payload'           => json_encode($this->buildPayload($invoiceId, $action, $recipient)),
                'status'            => 'pending',
                'attempts'          => 0,
            ]);
        }
    }

    /**
     * Queue notifikasi reminder overdue action.
     */
    public function queueOverdueReminder(int $invoiceId, string $currentState): void
    {
        $recipients = $this->resolveStateOwners($currentState, $invoiceId);

        foreach ($recipients as $recipient) {
            $this->CI->iwf_model->queueNotification([
                'invoice_id'        => $invoiceId,
                'log_id'            => 0,
                'recipient_type'    => $recipient['type'],
                'recipient_id'      => $recipient['id'],
                'notification_type' => 'wf_overdue_action',
                'channel'           => 'both',
                'payload'           => json_encode([
                    'state'    => $currentState,
                    'invoice_id' => $invoiceId,
                ]),
                'status'            => 'pending',
                'attempts'          => 0,
            ]);
        }
    }

    /**
     * Proses antrian notifikasi yang pending (dipanggil dari cron).
     *
     * @param int $batchSize  Jumlah notifikasi yang diproses per run
     */
    public function processQueue(int $batchSize = 50): void
    {
        $maxAttempts  = (int) get_option('iwf_notification_retry_max') ?: 3;
        $notifications = $this->CI->iwf_model->getPendingNotifications($batchSize, $maxAttempts);

        foreach ($notifications as $notif) {
            $payload = json_decode($notif->payload, true) ?: [];

            try {
                $sent = false;

                if (in_array($notif->channel, ['email', 'both'], true)) {
                    $sent = $this->sendEmailNotification($notif, $payload);
                }

                if (in_array($notif->channel, ['in_app', 'both'], true) && $notif->recipient_type === 'staff') {
                    $this->sendInAppNotification($notif, $payload);
                    $sent = true;
                }

                $this->CI->iwf_model->updateNotificationStatus(
                    (int) $notif->id,
                    $sent ? 'sent' : 'failed',
                    $sent ? null : 'Tidak ada saluran notifikasi yang berhasil.'
                );
            } catch (Exception $e) {
                $this->CI->iwf_model->updateNotificationStatus(
                    (int) $notif->id,
                    'failed',
                    $e->getMessage()
                );
                log_activity('IWF Notifier error [notif_id=' . $notif->id . ']: ' . $e->getMessage());
            }
        }
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Private: Resolve recipients
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Resolve siapa yang harus menerima notifikasi untuk aksi tertentu.
     *
     * @return array  [['type' => 'staff|vendor', 'id' => int, 'channel' => string], ...]
     */
    private function resolveRecipients(int $invoiceId, string $action, int $logId): array
    {
        $recipients = [];

        // Ambil log untuk mendapat context transisi
        $this->CI->db->where('id', $logId);
        $log = $this->CI->db->get(db_prefix() . 'wf_state_logs')->row();

        if (!$log) {
            return [];
        }

        $toState = $log->to_state;

        switch ($action) {
            case 'submit':
            case 'resubmit':
                // Beritahu semua AP/Receiver
                foreach ($this->CI->iwf_approvers->getByRole('ap_receiver') as $ap) {
                    $recipients[] = ['type' => 'staff', 'id' => $ap->staff_id, 'channel' => 'both'];
                }
                break;

            case 'verify':
            case 'approve':
                // Beritahu pemilik tahap berikutnya
                $nextRoleMap = [
                    'tax_review'         => 'tax',
                    'treasury_ack'       => 'treasury',
                    'pending_approval'   => 'senior_manager',
                    'approved_senior'    => 'gm_finance',
                    'payment_processing' => 'treasury',
                    'approved'           => 'treasury',
                ];

                if (isset($nextRoleMap[$toState])) {
                    foreach ($this->CI->iwf_approvers->getByRole($nextRoleMap[$toState]) as $approver) {
                        $recipients[] = ['type' => 'staff', 'id' => $approver->staff_id, 'channel' => 'both'];
                    }
                }
                break;

            case 'return':
            case 'reject':
                // Beritahu pengaju (submitter) invoice
                $state = $this->CI->iwf_model->getCurrentState($invoiceId);
                if ($state && $state->submitted_by) {
                    $recipients[] = ['type' => 'staff', 'id' => $state->submitted_by, 'channel' => 'both'];
                }
                break;

            case 'acknowledge':
                // Beritahu Senior Manager
                foreach ($this->CI->iwf_approvers->getByRole('senior_manager') as $approver) {
                    $recipients[] = ['type' => 'staff', 'id' => $approver->staff_id, 'channel' => 'both'];
                }
                break;

            case 'confirm_payment':
                // Beritahu pengaju bahwa invoice sudah dibayar
                $state = $this->CI->iwf_model->getCurrentState($invoiceId);
                if ($state && $state->submitted_by) {
                    $recipients[] = ['type' => 'staff', 'id' => $state->submitted_by, 'channel' => 'email'];
                }
                break;
        }

        return $recipients;
    }

    /**
     * Resolve pemilik tahap berdasarkan state (untuk overdue reminder).
     */
    private function resolveStateOwners(string $state, int $invoiceId): array
    {
        $roleMap = [
            'submitted'          => 'ap_receiver',
            'ap_review'          => 'ap_receiver',
            'tax_review'         => 'tax',
            'treasury_ack'       => 'treasury',
            'pending_approval'   => 'senior_manager',
            'approved_senior'    => 'gm_finance',
            'approved'           => 'treasury',
            'payment_processing' => 'treasury',
        ];

        $recipients = [];

        if (isset($roleMap[$state])) {
            foreach ($this->CI->iwf_approvers->getByRole($roleMap[$state]) as $approver) {
                $recipients[] = ['type' => 'staff', 'id' => $approver->staff_id];
            }
        }

        return $recipients;
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Private: Send notifications
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Kirim notifikasi email menggunakan sistem email Perfex.
     */
    private function sendEmailNotification(object $notif, array $payload): bool
    {
        // Ambil data invoice untuk merge fields
        $this->CI->db->where('id', $notif->invoice_id);
        $invoice = $this->CI->db->get(db_prefix() . 'invoices')->row();

        if (!$invoice) {
            return false;
        }

        // Ambil data penerima
        if ($notif->recipient_type === 'staff') {
            $this->CI->db->where('staffid', $notif->recipient_id);
            $recipient = $this->CI->db->get(db_prefix() . 'staff')->row();
        } else {
            $this->CI->db->where('id', $notif->recipient_id);
            $recipient = $this->CI->db->get(db_prefix() . 'contacts')->row();
        }

        if (!$recipient || empty($recipient->email)) {
            return false;
        }

        // Gunakan send_mail_template Perfex jika template tersedia
        // Fallback ke email manual jika template belum ada
        $subject = $this->buildEmailSubject($notif->notification_type, $invoice);
        $body    = $this->buildEmailBody($notif->notification_type, $invoice, $payload, $recipient);

        $this->CI->load->library('email');

        $mail = $this->CI->app_mail->send_simple_email(
            $recipient->email,
            $subject,
            $body
        );

        return (bool) $mail;
    }

    /**
     * Kirim notifikasi in-app menggunakan sistem notifikasi Perfex.
     */
    private function sendInAppNotification(object $notif, array $payload): void
    {
        if ($notif->recipient_type !== 'staff') {
            return;
        }

        $this->CI->db->where('id', $notif->invoice_id);
        $invoice = $this->CI->db->get(db_prefix() . 'invoices')->row();

        if (!$invoice) {
            return;
        }

        $description = $this->buildInAppDescription($notif->notification_type, $invoice, $payload);

        add_notification([
            'description' => $description,
            'touserid'    => $notif->recipient_id,
            'fromcompany' => 1,
            'link'        => 'invoices/list_invoices/' . $notif->invoice_id,
        ]);
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Private: Build messages
    // ──────────────────────────────────────────────────────────────────────────

    private function buildPayload(int $invoiceId, string $action, array $recipient): array
    {
        return [
            'invoice_id' => $invoiceId,
            'action'     => $action,
            'recipient'  => $recipient,
            'timestamp'  => date('c'),
        ];
    }

    private function buildEmailSubject(string $notificationType, object $invoice): string
    {
        $map = [
            'wf_submit'          => '[Aksi Diperlukan] Invoice #%s baru menunggu verifikasi',
            'wf_verify'          => '[Info] Invoice #%s diteruskan ke AP Review',
            'wf_approve'         => '[Aksi Diperlukan] Invoice #%s diteruskan ke tahap berikutnya',
            'wf_return'          => '[Invoice Dikembalikan] Invoice #%s memerlukan perbaikan',
            'wf_acknowledge'     => '[Aksi Diperlukan] Invoice #%s menunggu persetujuan Anda',
            'wf_reject'          => '[Invoice Ditolak] Invoice #%s telah ditolak',
            'wf_confirm_payment' => '[Pembayaran Dikonfirmasi] Invoice #%s telah dibayarkan',
            'wf_overdue_action'  => '[Reminder] Invoice #%s menunggu tindakan Anda',
        ];

        $template = $map[$notificationType] ?? '[Invoice Workflow] Pembaruan pada Invoice #%s';

        return sprintf($template, $invoice->number ?? $invoice->id);
    }

    private function buildEmailBody(string $notificationType, object $invoice, array $payload, object $recipient): string
    {
        $name    = $recipient->firstname ?? 'Pengguna';
        $invNum  = $invoice->number ?? '#' . $invoice->id;
        $invUrl  = admin_url('invoices/list_invoices/' . $invoice->id);

        $messages = [
            'wf_submit'          => "Invoice <strong>{$invNum}</strong> telah diajukan dan menunggu verifikasi Anda.",
            'wf_return'          => "Invoice <strong>{$invNum}</strong> telah dikembalikan untuk diperbaiki. Silakan periksa komentar dan ajukan ulang.",
            'wf_acknowledge'     => "Invoice <strong>{$invNum}</strong> telah diakui oleh Treasury dan menunggu persetujuan Anda.",
            'wf_reject'          => "Invoice <strong>{$invNum}</strong> telah ditolak. Silakan periksa alasan penolakan.",
            'wf_confirm_payment' => "Pembayaran untuk invoice <strong>{$invNum}</strong> telah dikonfirmasi.",
            'wf_overdue_action'  => "Invoice <strong>{$invNum}</strong> telah menunggu tindakan Anda lebih dari " . get_option('iwf_overdue_action_days') . " hari.",
        ];

        $message = $messages[$notificationType] ?? "Ada pembaruan pada invoice <strong>{$invNum}</strong>.";

        return "
            <p>Yth. {$name},</p>
            <p>{$message}</p>
            <p><a href=\"{$invUrl}\" style=\"background:#4a6cf7;color:#fff;padding:8px 16px;border-radius:4px;text-decoration:none;\">Lihat Invoice</a></p>
            <p style=\"color:#888;font-size:12px;\">Pesan ini dikirim otomatis oleh sistem Invoice Workflow. Harap tidak membalas email ini.</p>
        ";
    }

    private function buildInAppDescription(string $notificationType, object $invoice, array $payload): string
    {
        $invNum = $invoice->number ?? '#' . $invoice->id;

        $map = [
            'wf_submit'          => "Invoice {$invNum} baru menunggu verifikasi Anda",
            'wf_approve'         => "Invoice {$invNum} diteruskan ke tahap berikutnya",
            'wf_return'          => "Invoice {$invNum} dikembalikan untuk perbaikan",
            'wf_acknowledge'     => "Invoice {$invNum} menunggu persetujuan Anda",
            'wf_reject'          => "Invoice {$invNum} telah ditolak",
            'wf_confirm_payment' => "Pembayaran Invoice {$invNum} telah dikonfirmasi",
            'wf_overdue_action'  => "Invoice {$invNum} menunggu tindakan Anda (overdue)",
        ];

        return $map[$notificationType] ?? "Ada pembaruan pada Invoice {$invNum}";
    }
}
