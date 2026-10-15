<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Invoice_workflow Controller
 *
 * Menangani semua HTTP request untuk workflow panel, transisi state,
 * manajemen approver, delegasi, dan audit trail.
 *
 * @package invoice_workflow
 */
class Invoice_workflow extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(IWF_MODULE_NAME . '/Invoice_workflow_model', 'iwf_model');
        $this->load->model(IWF_MODULE_NAME . '/Wf_approvers_model',    'iwf_approvers');
        $this->load->model(IWF_MODULE_NAME . '/Wf_delegation_model',   'iwf_delegation');
        $this->load->library(IWF_MODULE_NAME . '/Invoice_state_machine', null, 'iwf_fsm');
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Dashboard
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * GET admin/invoice_workflow
     * Dashboard utama workflow — ringkasan per state.
     */
    public function index()
    {
        if (staff_cant('view', 'invoice_workflow')) {
            access_denied('invoice_workflow');
        }

        $actorId   = get_staff_user_id();
        $actorType = 'staff';

        $stats = $this->iwf_model->getDashboardStats($actorId, $actorType);
        $stuckInvoices = $this->iwf_model->getStuckInvoices(
            (int) get_option('iwf_overdue_action_days') ?: 2
        );

        $data['title']                    = _l('iwf_menu_workflow');
        $data['stats']                    = $stats;
        $data['all_states']               = $this->iwf_fsm->getAllStates();
        $data['stuck_invoices']           = $stuckInvoices;
        $data['total_invoices']           = $stats['total'] ?? 0;
        $data['state_summary']            = $stats['by_state'] ?? [];
        $data['total_approvers_count']    = count($this->iwf_approvers->getAll(true));
        $data['active_delegations_count'] = count($this->iwf_delegation->getAll(true));

        $this->load->view(IWF_MODULE_NAME . '/admin/dashboard', $data);
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Workflow Panel (AJAX partial — di-embed di halaman invoice Perfex)
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * GET admin/invoice_workflow/panel/{invoice_id}
     * Render panel workflow (status + action buttons) untuk di-inject via AJAX.
     */
    public function panel(int $invoiceId = 0)
    {
        if (!$invoiceId) {
            show_404();
        }

        $actorId   = get_staff_user_id();
        $actorType = 'staff';

        $state            = $this->iwf_model->getCurrentState($invoiceId);
        $availableActions = $this->iwf_fsm->getAvailableActions($invoiceId, $actorId, $actorType);
        $history          = $this->iwf_model->getStateHistory($invoiceId);
        $allStaff         = $this->db->get(db_prefix() . 'staff')->result(); // untuk form delegasi

        $data = [
            'invoiceId'        => $invoiceId,
            'state'            => $state,
            'availableActions' => $availableActions,
            'history'          => $history,
            'allStates'        => $this->iwf_fsm->getAllStates(),
            'allStaff'         => $allStaff,
        ];

        // Return JSON jika diminta, HTML jika tidak
        if ($this->input->is_ajax_request()) {
            $html = $this->load->view(IWF_MODULE_NAME . '/admin/partials/workflow_panel', $data, true);
            echo json_encode(['success' => true, 'html' => $html]);
            return;
        }

        $this->load->view(IWF_MODULE_NAME . '/admin/partials/workflow_panel', $data);
    }

    /**
     * GET admin/invoice_workflow/timeline/{invoice_id}
     * Ambil timeline history dalam format JSON (untuk update AJAX tanpa reload).
     */
    public function timeline(int $invoiceId = 0)
    {
        if (!$invoiceId || !$this->input->is_ajax_request()) {
            show_404();
        }

        $history = $this->iwf_model->getStateHistory($invoiceId);
        $allStates = $this->iwf_fsm->getAllStates();

        $html = $this->load->view(IWF_MODULE_NAME . '/admin/partials/timeline', [
            'history'   => $history,
            'allStates' => $allStates,
        ], true);

        echo json_encode(['success' => true, 'html' => $html]);
    }

    // ──────────────────────────────────────────────────────────────────────────
    // State Transition (aksi utama workflow)
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * POST admin/invoice_workflow/transition/{invoice_id}
     * Eksekusi transisi state workflow.
     *
     * Request body:
     * - action:        string  (required)
     * - comment:       string  (wajib untuk return/reject)
     * - delegatee_id:  int     (hanya untuk aksi 'delegate')
     * - metadata:      array   (data tambahan: bank_voucher_ref, dll)
     */
    public function transition(int $invoiceId = 0)
    {
        if (!$this->input->is_ajax_request() || !$this->input->post()) {
            show_404();
        }

        if (staff_cant('transition', 'invoice_workflow')) {
            $this->output->set_status_header(403);
            echo json_encode([
                'success' => false,
                'error'   => ['code' => 'WF_FORBIDDEN', 'message' => _l('iwf_error_no_permission')],
            ]);
            return;
        }

        $action      = $this->input->post('action', true);
        $comment     = $this->input->post('comment', true);
        $delegateeId = (int) $this->input->post('delegatee_id');
        $metadata    = $this->input->post('metadata') ?: [];

        if (empty($action)) {
            $this->output->set_status_header(400);
            echo json_encode([
                'success' => false,
                'error'   => ['code' => 'WF_MISSING_ACTION', 'message' => _l('iwf_error_action_required')],
            ]);
            return;
        }

        $actorId   = get_staff_user_id();
        $actorType = 'staff';

        $result = $this->iwf_fsm->transition($invoiceId, $action, $actorId, $actorType, [
            'comment'      => $comment,
            'delegatee_id' => $delegateeId,
            'metadata'     => $metadata,
        ]);

        if (!$result['success']) {
            $statusCode = ($result['code'] ?? '') === 'WF_FORBIDDEN' ? 403 : 422;
            $this->output->set_status_header($statusCode);
            echo json_encode([
                'success' => false,
                'error'   => [
                    'code'    => $result['code'] ?? 'WF_ERROR',
                    'message' => $result['error'],
                ],
            ]);
            return;
        }

        // Save Bank Voucher & Payment Details if Treasury confirms payment
        if ($action === 'confirm_payment') {
            $this->load->model(IWF_MODULE_NAME . '/Wf_payment_model', 'iwf_payment');
            $paymentData = [
                'bank_voucher_number' => $this->input->post('bank_voucher_number', true),
                'bank_name'           => $this->input->post('bank_name', true),
                'bank_account_number' => $this->input->post('bank_account_number', true),
                'payment_method'      => $this->input->post('payment_method', true) ?: 'bank_transfer',
                'payment_date'        => $this->input->post('payment_date', true) ?: date('Y-m-d'),
                'payment_notes'       => $comment,
            ];
            $this->iwf_payment->save_payment_details($invoiceId, $paymentData, $actorId);
        }

        echo json_encode([
            'success' => true,
            'data'    => $result['data'],
            'message' => _l('iwf_transition_success_' . $action),
        ]);
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Approvers Management
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * GET admin/invoice_workflow/approvers
     */
    public function approvers()
    {
        if (staff_cant('manage_approvers', 'invoice_workflow') && staff_cant('view', 'invoice_workflow')) {
            access_denied('invoice_workflow');
        }

        $this->load->model('staff_model');
        $staff = $this->staff_model->get('', ['active' => 1]);

        $data['title']         = _l('iwf_menu_approvers');
        $data['approvers']     = $this->iwf_approvers->getAll(false);
        $data['roles']         = $this->get_role_options();
        $data['staff_members'] = $staff;
        $data['staff']         = $staff;
        $data['can_manage']    = !staff_cant('manage_approvers', 'invoice_workflow');

        $this->load->view(IWF_MODULE_NAME . '/admin/approvers/manage', $data);
    }

    /**
     * Alias for save_approver
     */
    public function save_approver()
    {
        $this->approvers_save();
    }

    /**
     * POST admin/invoice_workflow/approvers/save
     * Create atau update approver.
     */
    public function approvers_save()
    {
        if (staff_cant('manage_approvers', 'invoice_workflow')) {
            if ($this->input->is_ajax_request()) {
                $this->output->set_status_header(403);
                echo json_encode(['success' => false, 'message' => 'Access denied']);
                return;
            }
            access_denied('invoice_workflow');
        }

        $id        = (int) $this->input->post('id');
        $roleSlug  = $this->input->post('role', true) ?: $this->input->post('role_slug', true);
        $minAmount = $this->input->post('min_amount') !== null ? $this->input->post('min_amount') : $this->input->post('amount_min');
        $maxAmount = $this->input->post('max_amount') !== null ? $this->input->post('max_amount') : $this->input->post('amount_max');
        $isActive  = $this->input->post('is_active') !== null ? (int) $this->input->post('is_active') : 1;

        $data = [
            'staff_id'   => (int) $this->input->post('staff_id'),
            'role_slug'  => $roleSlug,
            'amount_min' => ($minAmount !== '' && $minAmount !== null) ? $minAmount : null,
            'amount_max' => ($maxAmount !== '' && $maxAmount !== null) ? $maxAmount : null,
            'is_active'  => $isActive,
            'notes'      => $this->input->post('notes', true),
        ];

        $result = $this->iwf_approvers->save($data, $id ?: null);

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'success' => (bool) $result,
                'id'      => is_int($result) ? $result : $id,
            ]);
            return;
        }

        if ($result) {
            set_alert('success', _l('iwf_action_successful'));
        } else {
            set_alert('danger', _l('iwf_action_failed'));
        }
        redirect(admin_url('invoice_workflow/approvers'));
    }

    /**
     * Alias for delete_approver
     */
    public function delete_approver(int $id = 0)
    {
        $this->approvers_delete($id);
    }

    /**
     * POST admin/invoice_workflow/approvers/delete/{id}
     */
    public function approvers_delete(int $id = 0)
    {
        if (staff_cant('manage_approvers', 'invoice_workflow')) {
            if ($this->input->is_ajax_request()) {
                $this->output->set_status_header(403);
                echo json_encode(['success' => false]);
                return;
            }
            access_denied('invoice_workflow');
        }

        $success = $this->iwf_approvers->delete($id);

        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => (bool) $success]);
            return;
        }

        if ($success) {
            set_alert('success', 'Approver berhasil dihapus.');
        } else {
            set_alert('danger', 'Gagal menghapus approver.');
        }
        redirect(admin_url('invoice_workflow/approvers'));
    }

    /**
     * GET/POST admin/invoice_workflow/toggle_approver/{id}
     */
    public function toggle_approver(int $id = 0)
    {
        if (staff_cant('manage_approvers', 'invoice_workflow')) {
            access_denied('invoice_workflow');
        }

        $approver = $this->iwf_approvers->getById($id);
        if ($approver) {
            $newStatus = ((int)$approver->is_active === 1) ? 0 : 1;
            $this->iwf_approvers->save(['is_active' => $newStatus], $id);
            set_alert('success', 'Status approver berhasil diubah.');
        }
        redirect(admin_url('invoice_workflow/approvers'));
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Delegations Management
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * GET admin/invoice_workflow/delegations
     */
    public function delegations()
    {
        if (staff_cant('manage_delegations', 'invoice_workflow') && staff_cant('view', 'invoice_workflow')) {
            access_denied('invoice_workflow');
        }

        $this->load->model('staff_model');
        $staff = $this->staff_model->get('', ['active' => 1]);

        $data['title']         = _l('iwf_menu_delegations');
        $data['delegations']   = $this->iwf_delegation->getAll();
        $data['roles']         = $this->get_role_options();
        $data['staff_members'] = $staff;
        $data['staff']         = $staff;
        $data['can_manage']    = !staff_cant('manage_delegations', 'invoice_workflow');

        $this->load->view(IWF_MODULE_NAME . '/admin/delegations/manage', $data);
    }

    /**
     * Alias for save_delegation
     */
    public function save_delegation()
    {
        $this->delegations_save();
    }

    /**
     * POST admin/invoice_workflow/delegations/save
     */
    public function delegations_save()
    {
        if (staff_cant('manage_delegations', 'invoice_workflow')) {
            if ($this->input->is_ajax_request()) {
                $this->output->set_status_header(403);
                echo json_encode(['success' => false, 'message' => 'Access denied']);
                return;
            }
            access_denied('invoice_workflow');
        }

        $roleSlug   = $this->input->post('role', true) ?: $this->input->post('role_slug', true);
        $validFrom  = $this->input->post('start_date', true) ?: $this->input->post('valid_from', true);
        $validUntil = $this->input->post('end_date', true) ?: $this->input->post('valid_until', true);

        $data = [
            'delegator_id' => (int) $this->input->post('delegator_id'),
            'delegatee_id' => (int) $this->input->post('delegatee_id'),
            'role_slug'    => $roleSlug,
            'valid_from'   => $validFrom,
            'valid_until'  => $validUntil,
            'reason'       => $this->input->post('reason', true),
            'is_active'    => 1,
        ];

        $id     = (int) $this->input->post('id');
        $result = $this->iwf_delegation->save($data, $id ?: null);

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'success' => (bool) $result,
                'id'      => is_int($result) ? $result : $id,
            ]);
            return;
        }

        if ($result) {
            set_alert('success', _l('iwf_action_successful'));
        } else {
            set_alert('danger', _l('iwf_action_failed'));
        }
        redirect(admin_url('invoice_workflow/delegations'));
    }

    /**
     * Alias for revoke_delegation
     */
    public function revoke_delegation(int $id = 0)
    {
        $this->delegations_revoke($id);
    }

    /**
     * POST admin/invoice_workflow/delegations/revoke/{id}
     */
    public function delegations_revoke(int $id = 0)
    {
        if (staff_cant('manage_delegations', 'invoice_workflow')) {
            if ($this->input->is_ajax_request()) {
                $this->output->set_status_header(403);
                echo json_encode(['success' => false]);
                return;
            }
            access_denied('invoice_workflow');
        }

        $success = $this->iwf_delegation->revoke($id);

        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => (bool) $success]);
            return;
        }

        if ($success) {
            set_alert('success', 'Delegasi berhasil dibatalkan.');
        } else {
            set_alert('danger', 'Gagal membatalkan delegasi.');
        }
        redirect(admin_url('invoice_workflow/delegations'));
    }

    private function get_role_options(): array
    {
        return [
            'ap_receiver'    => 'AP / Receiver',
            'tax'            => 'Tax Verification',
            'treasury'       => 'Treasury Verification',
            'senior_manager' => 'Senior Manager',
            'gm_finance'     => 'GM Finance',
        ];
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Audit Trail Export
    // ──────────────────────────────────────────────────────────────────────────

    /**
     * GET admin/invoice_workflow/audit
     * Export audit log ke CSV.
     */
    public function audit()
    {
        if (staff_cant('export_audit', 'invoice_workflow')) {
            access_denied('invoice_workflow');
        }

        $filters = [
            'invoice_id' => $this->input->get('invoice_id'),
            'from_date'  => $this->input->get('from_date'),
            'to_date'    => $this->input->get('to_date'),
            'actor_id'   => $this->input->get('actor_id'),
        ];

        $logs = $this->iwf_model->exportAuditLog($filters);

        // Output CSV
        $filename = 'workflow_audit_' . date('Ymd_His') . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'ID', 'Invoice ID', 'Dari State', 'Ke State', 'Aksi',
            'Aktor Tipe', 'Aktor ID', 'Nama Aktor',
            'Komentar', 'IP Address', 'Waktu',
        ]);

        foreach ($logs as $log) {
            fputcsv($output, [
                $log['id'],
                $log['invoice_id'],
                $log['from_state'],
                $log['to_state'],
                $log['action'],
                $log['actor_type'],
                $log['actor_id'],
                $log['actor_name'],
                $log['comment_text'] ?? '',
                $log['ip_address'],
                $log['created_at'],
            ]);
        }

        fclose($output);
    }
}
