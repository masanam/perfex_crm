<?php defined('BASEPATH') or exit('No direct script access allowed');

$lang['iwf_menu_workflow']    = 'Invoice Workflow';
$lang['iwf_menu_approvers']   = 'Approvers';
$lang['iwf_menu_delegations'] = 'Delegations';

// States
$lang['iwf_state_draft']              = 'Draft';
$lang['iwf_state_submitted']          = 'Submitted';
$lang['iwf_state_ap_review']          = 'AP Review';
$lang['iwf_state_tax_review']         = 'Tax Review';
$lang['iwf_state_treasury_ack']       = 'Treasury Acknowledgement';
$lang['iwf_state_pending_approval']   = 'Pending Approval';
$lang['iwf_state_approved_senior']    = 'Approved (Senior Manager)';
$lang['iwf_state_approved']           = 'Approved';
$lang['iwf_state_payment_processing'] = 'Payment Processing';
$lang['iwf_state_closed']             = 'Closed';
$lang['iwf_state_rejected']           = 'Rejected';
$lang['iwf_state_cancelled']          = 'Cancelled';

// Actions
$lang['iwf_action_submit']          = 'Submit';
$lang['iwf_action_verify']          = 'Verify';
$lang['iwf_action_approve']         = 'Approve';
$lang['iwf_action_acknowledge']     = 'Acknowledge';
$lang['iwf_action_return']          = 'Return for Correction';
$lang['iwf_action_reject']          = 'Reject';
$lang['iwf_action_process_payment'] = 'Process Payment';
$lang['iwf_action_confirm_payment'] = 'Confirm Payment';
$lang['iwf_action_cancel']          = 'Cancel';
$lang['iwf_action_delegate']        = 'Delegate Approval';
$lang['iwf_action_resubmit']        = 'Resubmit';

// Panel
$lang['iwf_panel_title']          = 'Workflow Status';
$lang['iwf_available_actions']    = 'Available Actions:';
$lang['iwf_no_actions_available'] = 'No actions available for your current role.';
$lang['iwf_state_not_initialized'] = 'Workflow state not yet initialized for this invoice.';
$lang['iwf_state_locked_at']       = 'This invoice has been closed and locked on';
$lang['iwf_timeline_title']        = 'Workflow History';
$lang['iwf_timeline_empty']        = 'No workflow history yet.';
$lang['iwf_comment_internal']      = 'Internal';

// Modal
$lang['iwf_modal_confirm_action']  = 'Confirm Workflow Action';
$lang['iwf_label_action']          = 'Action';
$lang['iwf_label_comment']         = 'Comment';
$lang['iwf_label_delegatee']       = 'Delegate To';
$lang['iwf_comment_placeholder']   = 'Enter your comments here...';
$lang['iwf_select_staff']          = 'Select staff member';
$lang['iwf_btn_confirm']           = 'Confirm';

// Capabilities
$lang['iwf_cap_view']               = 'View Workflow';
$lang['iwf_cap_transition']         = 'Execute Transitions';
$lang['iwf_cap_manage_approvers']   = 'Manage Approvers';
$lang['iwf_cap_manage_delegations'] = 'Manage Delegations';
$lang['iwf_cap_export_audit']       = 'Export Audit Trail';

// Errors
$lang['iwf_error_no_permission']   = 'You do not have permission to perform this action.';
$lang['iwf_error_action_required'] = 'Action is required.';
$lang['iwf_error_comment_required'] = 'A comment is required for this action.';
$lang['iwf_error_state_locked']     = 'This invoice is locked and cannot be modified.';

// Success messages
$lang['iwf_transition_success_submit']          = 'Invoice submitted successfully.';
$lang['iwf_transition_success_verify']          = 'Invoice verified and forwarded to AP review.';
$lang['iwf_transition_success_approve']         = 'Invoice approved and forwarded to the next stage.';
$lang['iwf_transition_success_acknowledge']     = 'Invoice acknowledged. Pending approval.';
$lang['iwf_transition_success_return']          = 'Invoice returned for correction.';
$lang['iwf_transition_success_reject']          = 'Invoice rejected.';
$lang['iwf_transition_success_process_payment'] = 'Payment processing initiated.';
$lang['iwf_transition_success_confirm_payment'] = 'Payment confirmed. Invoice closed.';
$lang['iwf_transition_success_cancel']          = 'Invoice cancelled.';
$lang['iwf_transition_success_delegate']        = 'Approval delegated successfully.';
$lang['iwf_transition_success_resubmit']        = 'Invoice resubmitted successfully.';

// Dashboard
$lang['iwf_dashboard_title']         = 'Workflow Dashboard';
$lang['iwf_dashboard_total']         = 'Total Active Invoices';
$lang['iwf_dashboard_stuck']         = 'Overdue Action';
$lang['iwf_dashboard_by_state']      = 'Invoices by State';

// Approvers
$lang['iwf_approver_role']           = 'Role';
$lang['iwf_approver_staff']          = 'Staff Member';
$lang['iwf_approver_amount_min']     = 'Min Amount';
$lang['iwf_approver_amount_max']     = 'Max Amount';
$lang['iwf_approver_status']         = 'Status';
$lang['iwf_approver_add']            = 'Add Approver';
$lang['iwf_approver_edit']           = 'Edit Approver';
$lang['iwf_approver_delete_confirm'] = 'Are you sure you want to remove this approver?';

// Delegations
$lang['iwf_delegation_delegator']    = 'Delegated By';
$lang['iwf_delegation_delegatee']    = 'Delegated To';
$lang['iwf_delegation_role']         = 'Role';
$lang['iwf_delegation_valid_from']   = 'Valid From';
$lang['iwf_delegation_valid_until']  = 'Valid Until';
$lang['iwf_delegation_status']       = 'Status';
$lang['iwf_delegation_reason']       = 'Reason';
$lang['iwf_delegation_add']          = 'Add Delegation';
$lang['iwf_delegation_revoke']       = 'Revoke';
$lang['iwf_delegation_revoke_confirm'] = 'Are you sure you want to revoke this delegation?';
$lang['iwf_delegation_active']       = 'Active';
$lang['iwf_delegation_expired']      = 'Expired';
$lang['iwf_delegation_revoked']      = 'Revoked';
