<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Invoice_state_machine — Finite State Machine (FSM) Engine
 *
 * Bertanggung jawab untuk:
 * - Mendefinisikan semua state dan transisi yang valid
 * - Memvalidasi apakah aktor berwenang melakukan aksi (guard)
 * - Menjalankan transisi state secara atomik (DB transaction)
 * - Mencatat audit log immutable setelah setiap transisi
 * - Memicu event/hook pasca transisi
 *
 * @package invoice_workflow
 */
class Invoice_state_machine
{
    private CI_Controller $CI;

    /**
     * Definisi transisi yang valid.
     *
     * Format:
     * [from_state][action] => [
     *   'to'               => string|null     — null jika target dinamis (gunakan 'resolver')
     *   'roles'            => string[]        — role yang diizinkan melakukan aksi ini
     *   'comment_required' => bool            — wajib isi komentar
     *   'resolver'         => string|null     — nama method untuk resolve 'to' secara dinamis
     *   'special'          => string|null     — aksi khusus: 'delegation'
     * ]
     */
    private array $transitions = [
        'draft' => [
            'submit' => [
                'to'               => 'submitted',
                'roles'            => ['vendor', 'requester', 'ap_receiver', 'admin'],
                'comment_required' => false,
            ],
            'cancel' => [
                'to'               => 'cancelled',
                'roles'            => ['vendor', 'requester', 'admin'],
                'comment_required' => true,
            ],
        ],
        'submitted' => [
            'verify' => [
                'to'               => 'ap_review',
                'roles'            => ['ap_receiver', 'admin'],
                'comment_required' => false,
            ],
            'return' => [
                'to'               => 'draft',
                'roles'            => ['ap_receiver', 'admin'],
                'comment_required' => true,
            ],
        ],
        'ap_review' => [
            'approve' => [
                'to'               => 'tax_review',
                'roles'            => ['ap_receiver', 'admin'],
                'comment_required' => false,
            ],
            'return' => [
                'to'               => 'submitted',
                'roles'            => ['ap_receiver', 'admin'],
                'comment_required' => true,
            ],
        ],
        'tax_review' => [
            'approve' => [
                'to'               => 'treasury_ack',
                'roles'            => ['tax', 'admin'],
                'comment_required' => false,
            ],
            'return' => [
                'to'               => 'ap_review',
                'roles'            => ['tax', 'admin'],
                'comment_required' => true,
            ],
        ],
        'treasury_ack' => [
            'acknowledge' => [
                'to'               => 'pending_approval',
                'roles'            => ['treasury', 'admin'],
                'comment_required' => false,
            ],
            'return' => [
                'to'               => 'tax_review',
                'roles'            => ['treasury', 'admin'],
                'comment_required' => true,
            ],
        ],
        'pending_approval' => [
            'approve' => [
                'to'               => null,               // Dinamis: approved_senior atau approved
                'roles'            => ['senior_manager', 'gm_finance', 'admin'],
                'comment_required' => false,
                'resolver'         => 'resolveApprovalTarget',
            ],
            'reject' => [
                'to'               => 'rejected',
                'roles'            => ['senior_manager', 'gm_finance', 'admin'],
                'comment_required' => true,
            ],
            'return' => [
                'to'               => 'treasury_ack',
                'roles'            => ['senior_manager', 'gm_finance', 'admin'],
                'comment_required' => true,
            ],
            'delegate' => [
                'to'               => 'pending_approval', // State tidak berubah
                'roles'            => ['senior_manager', 'gm_finance', 'admin'],
                'comment_required' => true,
                'special'          => 'delegation',
            ],
        ],
        'approved_senior' => [
            'approve' => [
                'to'               => 'approved',
                'roles'            => ['gm_finance', 'admin'],
                'comment_required' => false,
            ],
            'reject' => [
                'to'               => 'rejected',
                'roles'            => ['gm_finance', 'admin'],
                'comment_required' => true,
            ],
            'return' => [
                'to'               => 'pending_approval',
                'roles'            => ['gm_finance', 'admin'],
                'comment_required' => true,
            ],
        ],
        'approved' => [
            'process_payment' => [
                'to'               => 'payment_processing',
                'roles'            => ['treasury', 'admin'],
                'comment_required' => false,
            ],
        ],
        'payment_processing' => [
            'confirm_payment' => [
                'to'               => 'closed',
                'roles'            => ['treasury', 'admin'],
                'comment_required' => false,
            ],
        ],
        'rejected' => [
            'resubmit' => [
                'to'               => 'draft',
                'roles'            => ['vendor', 'requester', 'admin'],
                'comment_required' => false,
            ],
        ],
        // 'closed' dan 'cancelled' => tidak ada transisi keluar (terminal state)
    ];

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model(IWF_MODULE_NAME . '/Invoice_workflow_model',  'iwf_model');
        $this->CI->load->model(IWF_MODULE_NAME . '/Wf_approvers_model',     'iwf_approvers');
        $this->CI->load->model(IWF_MODULE_NAME . '/Wf_delegation_model',    'iwf_delegation');
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Public API
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Validasi apakah aktor boleh melakukan aksi pada invoice ini.
     *
     * @param  int    $invoiceId
     * @param  string $action      e.q. 'submit', 'approve', 'return'
     * @param  int    $actorId     staffid atau contactid
     * @param  string $actorType   'staff' atau 'vendor'
     * @return true|string         true jika boleh, string pesan error jika tidak
     */
    public function canTransition(int $invoiceId, string $action, int $actorId, string $actorType): bool|string
    {
        $stateRecord = $this->CI->iwf_model->getCurrentState($invoiceId);

        if (!$stateRecord) {
            return 'Workflow state untuk invoice ini tidak ditemukan.';
        }

        // Cek apakah invoice sudah terkunci (closed)
        if ($stateRecord->locked_at !== null) {
            return 'Invoice ini sudah ditutup dan tidak dapat diubah.';
        }

        $currentState = $stateRecord->current_state;

        // Cek apakah aksi ada untuk state ini
        if (!isset($this->transitions[$currentState][$action])) {
            return sprintf(
                'Aksi "%s" tidak valid dari state "%s".',
                $action,
                $currentState
            );
        }

        $transition = $this->transitions[$currentState][$action];

        // Cek role aktor
        $effectiveRoles = $this->getEffectiveRoles($actorId, $actorType);

        $hasRole = false;
        foreach ($effectiveRoles as $role) {
            if (in_array($role, $transition['roles'], true)) {
                $hasRole = true;
                break;
            }
        }

        if (!$hasRole) {
            return sprintf(
                'Anda tidak memiliki kewenangan untuk melakukan aksi "%s". Role yang diperlukan: %s.',
                $action,
                implode(', ', $transition['roles'])
            );
        }

        return true;
    }

    /**
     * Eksekusi transisi state secara atomik.
     * Gunakan DB transaction — jika salah satu langkah gagal, semua di-rollback.
     *
     * @param  int    $invoiceId
     * @param  string $action
     * @param  int    $actorId
     * @param  string $actorType
     * @param  array  $data        ['comment' => string, 'metadata' => array, 'delegatee_id' => int]
     * @return array  ['success' => bool, 'data' => array, 'error' => string]
     */
    public function transition(int $invoiceId, string $action, int $actorId, string $actorType, array $data = []): array
    {
        // Guard check
        $canDo = $this->canTransition($invoiceId, $action, $actorId, $actorType);
        if ($canDo !== true) {
            return ['success' => false, 'error' => $canDo];
        }

        $stateRecord  = $this->CI->iwf_model->getCurrentState($invoiceId);
        $currentState = $stateRecord->current_state;
        $transition   = $this->transitions[$currentState][$action];

        // Validasi komentar wajib
        if ($transition['comment_required'] && empty(trim($data['comment'] ?? ''))) {
            return [
                'success' => false,
                'error'   => 'Komentar wajib diisi untuk aksi ini.',
                'code'    => 'WF_COMMENT_REQUIRED',
            ];
        }

        // Resolve target state
        $toState = $transition['to'];
        if ($toState === null && isset($transition['resolver'])) {
            $toState = $this->{$transition['resolver']}($invoiceId);
        }

        // Aksi khusus: delegation — tidak mengubah state, hanya mencatat
        $isSpecialDelegation = ($transition['special'] ?? '') === 'delegation';

        // ── BEGIN TRANSACTION ──────────────────────────────────────────────────
        $this->CI->db->trans_begin();

        try {
            // 1. Lock baris state untuk hindari race condition
            $this->CI->db->query(
                'SELECT id FROM ' . db_prefix() . 'wf_invoice_states WHERE invoice_id = ? FOR UPDATE',
                [$invoiceId]
            );

            // 2. Simpan komentar (jika ada)
            $commentId = null;
            if (!empty(trim($data['comment'] ?? ''))) {
                $commentId = $this->CI->iwf_model->addComment(
                    $invoiceId,
                    null, // log_id akan diupdate setelah log dibuat
                    trim($data['comment']),
                    (bool) ($data['is_internal'] ?? false),
                    $actorId,
                    $actorType
                );
            }

            // 3. Catat audit log (immutable)
            $actorName = $this->resolveActorName($actorId, $actorType);
            $logId = $this->CI->iwf_model->addStateLog([
                'invoice_id'  => $invoiceId,
                'from_state'  => $currentState,
                'to_state'    => $toState,
                'action'      => $action,
                'actor_type'  => $actorType,
                'actor_id'    => $actorId,
                'actor_name'  => $actorName,
                'comment_id'  => $commentId,
                'metadata'    => !empty($data['metadata']) ? json_encode($data['metadata']) : null,
                'ip_address'  => $this->CI->input->ip_address(),
                'user_agent'  => substr($this->CI->input->user_agent() ?? '', 0, 500),
            ]);

            // 4. Update comment dengan log_id
            if ($commentId) {
                $this->CI->iwf_model->updateCommentLogId($commentId, $logId);
            }

            // 5. Update state di wf_invoice_states (kecuali delegasi)
            if (!$isSpecialDelegation) {
                $updateData = ['current_state' => $toState];

                if ($action === 'submit') {
                    $updateData['submitted_by'] = $actorId;
                    $updateData['submitted_at'] = date('Y-m-d H:i:s');
                }

                if ($toState === 'closed') {
                    $updateData['locked_at'] = date('Y-m-d H:i:s');
                }

                $this->CI->iwf_model->updateState($invoiceId, $updateData);
            }

            // 6. Handle delegasi khusus
            if ($isSpecialDelegation && !empty($data['delegatee_id'])) {
                $this->CI->iwf_delegation->createDelegationFromAction($invoiceId, $actorId, (int) $data['delegatee_id'], $logId);
            }

            $this->CI->db->trans_commit();

            // 7. Queue notifikasi (di luar transaction — failure tidak rollback workflow)
            $this->CI->load->library(IWF_MODULE_NAME . '/Wf_notifier', null, 'wf_notifier');
            $this->CI->wf_notifier->queueNotification($invoiceId, $logId, $action);

            // 8. Trigger hook untuk keperluan integrasi eksternal
            hooks()->do_action('iwf_after_transition', [
                'invoice_id'   => $invoiceId,
                'from_state'   => $currentState,
                'to_state'     => $toState,
                'action'       => $action,
                'actor_id'     => $actorId,
                'actor_type'   => $actorType,
                'log_id'       => $logId,
            ]);

            return [
                'success' => true,
                'data'    => [
                    'invoice_id' => $invoiceId,
                    'from_state' => $currentState,
                    'to_state'   => $toState,
                    'action'     => $action,
                    'log_id'     => $logId,
                    'timestamp'  => date('c'),
                ],
            ];
        } catch (Exception $e) {
            $this->CI->db->trans_rollback();
            log_activity('IWF transition error [invoice_id=' . $invoiceId . ']: ' . $e->getMessage());

            return [
                'success' => false,
                'error'   => 'Terjadi kesalahan sistem saat memproses transisi. Silakan coba lagi.',
                'code'    => 'WF_SYSTEM_ERROR',
            ];
        }
    }

    /**
     * Mendapatkan daftar aksi yang tersedia untuk aktor pada invoice tertentu.
     *
     * @return array  [['action' => string, 'label' => string, 'comment_required' => bool], ...]
     */
    public function getAvailableActions(int $invoiceId, int $actorId, string $actorType): array
    {
        $stateRecord = $this->CI->iwf_model->getCurrentState($invoiceId);

        if (!$stateRecord || $stateRecord->locked_at !== null) {
            return [];
        }

        $currentState   = $stateRecord->current_state;
        $effectiveRoles = $this->getEffectiveRoles($actorId, $actorType);
        $available      = [];

        if (!isset($this->transitions[$currentState])) {
            return [];
        }

        foreach ($this->transitions[$currentState] as $action => $transition) {
            foreach ($effectiveRoles as $role) {
                if (in_array($role, $transition['roles'], true)) {
                    $available[] = [
                        'action'           => $action,
                        'label'            => _l('iwf_action_' . $action),
                        'comment_required' => $transition['comment_required'],
                        'special'          => $transition['special'] ?? null,
                    ];
                    break;
                }
            }
        }

        return $available;
    }

    /**
     * Mendapatkan semua state beserta labelnya (untuk UI).
     */
    public function getAllStates(): array
    {
        return [
            'draft'              => _l('iwf_state_draft'),
            'submitted'          => _l('iwf_state_submitted'),
            'ap_review'          => _l('iwf_state_ap_review'),
            'tax_review'         => _l('iwf_state_tax_review'),
            'treasury_ack'       => _l('iwf_state_treasury_ack'),
            'pending_approval'   => _l('iwf_state_pending_approval'),
            'approved_senior'    => _l('iwf_state_approved_senior'),
            'approved'           => _l('iwf_state_approved'),
            'payment_processing' => _l('iwf_state_payment_processing'),
            'closed'             => _l('iwf_state_closed'),
            'rejected'           => _l('iwf_state_rejected'),
            'cancelled'          => _l('iwf_state_cancelled'),
        ];
    }

    /**
     * Badge CSS class untuk setiap state (untuk UI).
     */
    public function getStateBadgeClass(string $state): string
    {
        $map = [
            'draft'              => 'badge-secondary',
            'submitted'          => 'badge-info',
            'ap_review'          => 'badge-primary',
            'tax_review'         => 'badge-primary',
            'treasury_ack'       => 'badge-primary',
            'pending_approval'   => 'badge-warning',
            'approved_senior'    => 'badge-warning',
            'approved'           => 'badge-success',
            'payment_processing' => 'badge-success',
            'closed'             => 'badge-dark',
            'rejected'           => 'badge-danger',
            'cancelled'          => 'badge-secondary',
        ];

        return $map[$state] ?? 'badge-secondary';
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Private helpers
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * Resolve target state saat approve di pending_approval.
     * Cek jumlah invoice vs threshold batas kewenangan Senior Manager.
     *
     * Jika invoice amount > threshold → ke approved_senior (perlu GM Finance juga)
     * Jika invoice amount ≤ threshold → langsung ke approved
     */
    private function resolveApprovalTarget(int $invoiceId): string
    {
        $threshold = (float) get_option('iwf_approval_threshold_senior');

        // Ambil total invoice dari Perfex
        $this->CI->db->select('total');
        $this->CI->db->where('id', $invoiceId);
        $invoice = $this->CI->db->get(db_prefix() . 'invoices')->row();

        if (!$invoice) {
            return 'approved_senior'; // default aman — perlu GM Finance
        }

        return ((float) $invoice->total > $threshold) ? 'approved_senior' : 'approved';
    }

    /**
     * Mendapatkan role efektif aktor, termasuk delegasi yang masih aktif.
     *
     * @return string[]  Array of role slugs
     */
    private function getEffectiveRoles(int $actorId, string $actorType): array
    {
        $roles = [];

        if ($actorType === 'staff') {
            // Role dari tabel wf_approvers
            $approverRoles = $this->CI->iwf_approvers->getRolesByStaff($actorId);
            $roles         = array_merge($roles, $approverRoles);

            // Admin selalu dapat semua role
            if (is_admin($actorId)) {
                $roles[] = 'admin';
            }

            // Role dari delegasi yang sedang aktif
            $delegatedRoles = $this->CI->iwf_delegation->getActiveDelegatedRoles($actorId);
            $roles          = array_merge($roles, $delegatedRoles);
        } elseif ($actorType === 'vendor') {
            $roles[] = 'vendor';
        }

        return array_unique($roles);
    }

    /**
     * Resolve nama aktor untuk disimpan sebagai snapshot di audit log.
     */
    private function resolveActorName(int $actorId, string $actorType): string
    {
        if ($actorType === 'staff') {
            return get_staff_full_name($actorId) ?: 'Staff #' . $actorId;
        }

        if ($actorType === 'vendor') {
            // Coba ambil dari contacts (Perfex client contacts)
            $this->CI->db->select('CONCAT(firstname, " ", lastname) as full_name');
            $this->CI->db->where('id', $actorId);
            $contact = $this->CI->db->get(db_prefix() . 'contacts')->row();

            return $contact ? $contact->full_name : 'Vendor #' . $actorId;
        }

        return 'System';
    }
}
