<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Invoice_workflow_model
 *
 * Data access layer untuk semua tabel workflow.
 * Tidak mengandung business logic — itu ada di Invoice_state_machine.
 *
 * @package invoice_workflow
 */
class Invoice_workflow_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // ──────────────────────────────────────────────────────────────────────────
    // wf_invoice_states
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Inisialisasi state workflow untuk invoice baru.
     * Dipanggil via hook 'after_invoice_added'.
     *
     * @return int  ID record baru di wf_invoice_states
     */
    public function initializeWorkflow(int $invoiceId, string $invoiceType = 'non_po'): int
    {
        // Cegah duplikasi jika dipanggil lebih dari sekali
        if ($this->getCurrentState($invoiceId)) {
            return 0;
        }

        $this->db->insert(db_prefix() . 'wf_invoice_states', [
            'invoice_id'    => $invoiceId,
            'invoice_type'  => $invoiceType,
            'current_state' => 'draft',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        $id = $this->db->insert_id();

        log_activity('IWF: Workflow initialized for invoice #' . $invoiceId . ' [state=draft]');

        return (int) $id;
    }

    /**
     * Ambil record state terkini untuk sebuah invoice.
     *
     * @return object|null
     */
    public function getCurrentState(int $invoiceId): ?object
    {
        $this->db->where('invoice_id', $invoiceId);
        $result = $this->db->get(db_prefix() . 'wf_invoice_states')->row();

        return $result ?: null;
    }

    /**
     * Update state dan metadata di wf_invoice_states.
     *
     * @param array $data  Kolom yang akan diupdate
     */
    public function updateState(int $invoiceId, array $data): bool
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('invoice_id', $invoiceId);
        $this->db->update(db_prefix() . 'wf_invoice_states', $data);

        return $this->db->affected_rows() > 0;
    }

    /**
     * Ambil invoice yang stagnan di suatu state melebihi threshold hari.
     * Digunakan untuk cron overdue action reminder.
     *
     * @return array  Array of stdClass dengan invoice_id dan current_state
     */
    public function getStuckInvoices(int $thresholdDays = 2): array
    {
        $cutoff = date('Y-m-d H:i:s', strtotime('-' . $thresholdDays . ' days'));

        // Hanya state aktif (bukan terminal state)
        $activeStates = [
            'submitted', 'ap_review', 'tax_review',
            'treasury_ack', 'pending_approval', 'approved_senior',
            'approved', 'payment_processing',
        ];

        $this->db->where_in('current_state', $activeStates);
        $this->db->where('updated_at <', $cutoff);
        $this->db->where('locked_at IS NULL');
        $this->db->select('invoice_id, current_state, updated_at');

        return $this->db->get(db_prefix() . 'wf_invoice_states')->result();
    }

    /**
     * Ambil daftar invoice berdasarkan state dan role aktor.
     * Digunakan untuk dashboard per role.
     *
     * @param  string $state      State workflow yang ingin ditampilkan
     * @param  int    $actorId
     * @param  string $actorType
     * @param  array  $filters    ['search' => string, 'limit' => int, 'offset' => int]
     * @return array
     */
    public function getInvoicesByState(string $state, int $actorId, string $actorType, array $filters = []): array
    {
        $this->db->select(
            db_prefix() . 'wf_invoice_states.*, ' .
            db_prefix() . 'invoices.number as invoice_number, ' .
            db_prefix() . 'invoices.total as invoice_total, ' .
            db_prefix() . 'invoices.date as invoice_date, ' .
            db_prefix() . 'invoices.duedate as invoice_duedate, ' .
            'clients.company as client_company'
        );
        $this->db->from(db_prefix() . 'wf_invoice_states');
        $this->db->join(db_prefix() . 'invoices', db_prefix() . 'invoices.id = ' . db_prefix() . 'wf_invoice_states.invoice_id', 'left');
        $this->db->join(db_prefix() . 'clients', db_prefix() . 'clients.userid = ' . db_prefix() . 'invoices.clientid', 'left');
        $this->db->where(db_prefix() . 'wf_invoice_states.current_state', $state);

        if (!empty($filters['search'])) {
            $search = $this->db->escape_like_str($filters['search']);
            $this->db->group_start();
            $this->db->like(db_prefix() . 'invoices.number', $search);
            $this->db->or_like('clients.company', $search);
            $this->db->group_end();
        }

        $limit  = (int) ($filters['limit']  ?? 20);
        $offset = (int) ($filters['offset'] ?? 0);
        $this->db->limit($limit, $offset);
        $this->db->order_by(db_prefix() . 'wf_invoice_states.updated_at', 'DESC');

        return $this->db->get()->result();
    }

    /**
     * Statistik ringkasan untuk dashboard per aktor.
     *
     * @return array  ['by_state' => [...], 'total' => int, 'pending_my_action' => int]
     */
    public function getDashboardStats(int $actorId, string $actorType): array
    {
        // Count per state
        $this->db->select('current_state, COUNT(*) as total');
        $this->db->from(db_prefix() . 'wf_invoice_states');
        $this->db->where('locked_at IS NULL');
        $this->db->group_by('current_state');
        $rows = $this->db->get()->result();

        $byState = [];
        $total   = 0;
        foreach ($rows as $row) {
            $byState[$row->current_state] = (int) $row->total;
            $total += (int) $row->total;
        }

        return [
            'by_state' => $byState,
            'total'    => $total,
        ];
    }

    // ──────────────────────────────────────────────────────────────────────────
    // wf_state_logs (IMMUTABLE — hanya INSERT)
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Tambah entry audit log. SATU-SATUNYA operasi yang diizinkan pada tabel ini.
     *
     * @return int  ID log yang baru dibuat
     */
    public function addStateLog(array $data): int
    {
        // PENTING: Tidak ada UPDATE/DELETE pada tabel ini.
        $this->db->insert(db_prefix() . 'wf_state_logs', $data);
        return (int) $this->db->insert_id();
    }

    /**
     * Ambil riwayat lengkap transisi untuk sebuah invoice.
     * Digunakan untuk timeline UI.
     *
     * @return array  Array of stdClass, ordered by created_at ASC
     */
    public function getStateHistory(int $invoiceId): array
    {
        $this->db->select(
            db_prefix() . 'wf_state_logs.*, ' .
            db_prefix() . 'wf_comments.comment as comment_text, ' .
            db_prefix() . 'wf_comments.is_internal'
        );
        $this->db->from(db_prefix() . 'wf_state_logs');
        $this->db->join(
            db_prefix() . 'wf_comments',
            db_prefix() . 'wf_comments.id = ' . db_prefix() . 'wf_state_logs.comment_id',
            'left'
        );
        $this->db->where(db_prefix() . 'wf_state_logs.invoice_id', $invoiceId);
        $this->db->order_by(db_prefix() . 'wf_state_logs.created_at', 'ASC');

        return $this->db->get()->result();
    }

    /**
     * Export audit log dalam format array untuk download.
     *
     * @param  array $filters  ['invoice_id', 'from_date', 'to_date', 'actor_id']
     * @return array
     */
    public function exportAuditLog(array $filters = []): array
    {
        $this->db->select(db_prefix() . 'wf_state_logs.*, ' . db_prefix() . 'wf_comments.comment as comment_text');
        $this->db->from(db_prefix() . 'wf_state_logs');
        $this->db->join(
            db_prefix() . 'wf_comments',
            db_prefix() . 'wf_comments.id = ' . db_prefix() . 'wf_state_logs.comment_id',
            'left'
        );

        if (!empty($filters['invoice_id'])) {
            $this->db->where(db_prefix() . 'wf_state_logs.invoice_id', (int) $filters['invoice_id']);
        }
        if (!empty($filters['from_date'])) {
            $this->db->where(db_prefix() . 'wf_state_logs.created_at >=', $filters['from_date'] . ' 00:00:00');
        }
        if (!empty($filters['to_date'])) {
            $this->db->where(db_prefix() . 'wf_state_logs.created_at <=', $filters['to_date'] . ' 23:59:59');
        }
        if (!empty($filters['actor_id'])) {
            $this->db->where(db_prefix() . 'wf_state_logs.actor_id', (int) $filters['actor_id']);
        }

        $this->db->order_by(db_prefix() . 'wf_state_logs.created_at', 'DESC');

        return $this->db->get()->result_array();
    }

    // ──────────────────────────────────────────────────────────────────────────
    // wf_comments
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Tambah komentar workflow.
     *
     * @return int  ID comment baru
     */
    public function addComment(int $invoiceId, ?int $logId, string $comment, bool $isInternal, int $actorId, string $actorType): int
    {
        $actorName = $actorType === 'staff'
            ? (get_staff_full_name($actorId) ?: 'Staff #' . $actorId)
            : 'Vendor #' . $actorId;

        $this->db->insert(db_prefix() . 'wf_comments', [
            'invoice_id'  => $invoiceId,
            'log_id'      => $logId,
            'actor_type'  => $actorType,
            'actor_id'    => $actorId,
            'actor_name'  => $actorName,
            'comment'     => htmlspecialchars(strip_tags($comment), ENT_QUOTES, 'UTF-8'),
            'is_internal' => $isInternal ? 1 : 0,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return (int) $this->db->insert_id();
    }

    /**
     * Update log_id pada komentar setelah log dibuat.
     */
    public function updateCommentLogId(int $commentId, int $logId): void
    {
        $this->db->where('id', $commentId);
        $this->db->update(db_prefix() . 'wf_comments', ['log_id' => $logId]);
    }

    /**
     * Ambil semua komentar untuk sebuah invoice.
     *
     * @param  bool $includeInternal  Jika false, komentar internal (is_internal=1) tidak disertakan
     * @return array
     */
    public function getComments(int $invoiceId, bool $includeInternal = true): array
    {
        $this->db->where('invoice_id', $invoiceId);

        if (!$includeInternal) {
            $this->db->where('is_internal', 0);
        }

        $this->db->order_by('created_at', 'ASC');

        return $this->db->get(db_prefix() . 'wf_comments')->result();
    }

    // ──────────────────────────────────────────────────────────────────────────
    // wf_notification_queue
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Tambah notifikasi ke antrian.
     */
    public function queueNotification(array $data): int
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert(db_prefix() . 'wf_notification_queue', $data);
        return (int) $this->db->insert_id();
    }

    /**
     * Ambil notifikasi yang pending untuk diproses (batch).
     *
     * @param  int $batchSize   Jumlah maksimal notifikasi per run
     * @param  int $maxAttempts Lewati notifikasi yang sudah melewati batas retry
     * @return array
     */
    public function getPendingNotifications(int $batchSize = 50, int $maxAttempts = 3): array
    {
        $this->db->where('status', 'pending');
        $this->db->where('attempts <', $maxAttempts);
        $this->db->limit($batchSize);
        $this->db->order_by('created_at', 'ASC');

        return $this->db->get(db_prefix() . 'wf_notification_queue')->result();
    }

    /**
     * Update status notifikasi setelah diproses.
     */
    public function updateNotificationStatus(int $id, string $status, ?string $errorMessage = null): void
    {
        $data = [
            'status'          => $status,
            'last_attempt_at' => date('Y-m-d H:i:s'),
        ];

        // Increment attempts
        $this->db->set('attempts', 'attempts + 1', false);

        if ($errorMessage) {
            $data['error_message'] = substr($errorMessage, 0, 1000);
        }

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'wf_notification_queue', $data);
    }
}
