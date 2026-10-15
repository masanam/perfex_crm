<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php defined('BASEPATH') or exit('No direct script access allowed');

// Helper functions untuk Invoice Workflow module

/**
 * Mendapatkan label human-readable untuk setiap state.
 */
function iwf_state_label(string $state): string
{
    $CI = &get_instance();

    $map = [
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

    return $map[$state] ?? ucfirst(str_replace('_', ' ', $state));
}

/**
 * Mendapatkan CSS class untuk badge state.
 */
function iwf_state_badge(string $state): string
{
    $map = [
        'draft'              => 'label-default',
        'submitted'          => 'label-info',
        'ap_review'          => 'label-primary',
        'tax_review'         => 'label-primary',
        'treasury_ack'       => 'label-primary',
        'pending_approval'   => 'label-warning',
        'approved_senior'    => 'label-warning',
        'approved'           => 'label-success',
        'payment_processing' => 'label-success',
        'closed'             => 'label-dark',
        'rejected'           => 'label-danger',
        'cancelled'          => 'label-default',
    ];

    return $map[$state] ?? 'label-default';
}

/**
 * Mendapatkan CSS class untuk button aksi.
 */
function iwf_action_btn_class(string $action): string
{
    $map = [
        'submit'          => 'btn-primary',
        'verify'          => 'btn-info',
        'approve'         => 'btn-success',
        'acknowledge'     => 'btn-success',
        'return'          => 'btn-warning',
        'reject'          => 'btn-danger',
        'process_payment' => 'btn-primary',
        'confirm_payment' => 'btn-success',
        'cancel'          => 'btn-default',
        'delegate'        => 'btn-default',
        'resubmit'        => 'btn-primary',
    ];

    return $map[$action] ?? 'btn-default';
}

/**
 * Mendapatkan Font Awesome icon class untuk setiap aksi.
 */
function iwf_action_icon(string $action): string
{
    $map = [
        'submit'          => 'fa-paper-plane',
        'verify'          => 'fa-check-circle',
        'approve'         => 'fa-thumbs-up',
        'acknowledge'     => 'fa-handshake-o',
        'return'          => 'fa-undo',
        'reject'          => 'fa-times-circle',
        'process_payment' => 'fa-credit-card',
        'confirm_payment' => 'fa-check-square',
        'cancel'          => 'fa-ban',
        'delegate'        => 'fa-share',
        'resubmit'        => 'fa-refresh',
    ];

    return $map[$action] ?? 'fa-circle';
}

/**
 * Format currency IDR.
 */
function iwf_format_currency(float $amount): string
{
    return 'IDR ' . number_format($amount, 0, ',', '.');
}

/**
 * Cek apakah staff punya role workflow tertentu.
 */
function iwf_staff_has_role(string $roleSlug, int $staffId = 0): bool
{
    $staffId = $staffId ?: get_staff_user_id();

    if (is_admin($staffId)) {
        return true;
    }

    $CI = &get_instance();
    $CI->load->model(IWF_MODULE_NAME . '/Wf_approvers_model', 'iwf_approvers');

    $roles = $CI->iwf_approvers->getRolesByStaff($staffId);

    return in_array($roleSlug, $roles, true);
}
