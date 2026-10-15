<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Invoice Workflow Engine
Description: Multi-step approval workflow untuk Sistem Manajemen Invoice sesuai TOR/SOW NEC Indonesia.
             Mengimplementasikan alur: Submit → AP/Receiver → Tax → Treasury → Approval → Payment → Closed.
Version: 1.0.0
Requires at least: 3.0.*
Author: Digivla
*/

define('IWF_MODULE_NAME', 'invoice_workflow');
define('IWF_VERSION', '1.0.0');
define('IWF_REVISION', 100);

// ──────────────────────────────────────────────────────────────────────────────
// Module lifecycle hooks
// ──────────────────────────────────────────────────────────────────────────────

register_activation_hook(IWF_MODULE_NAME, 'iwf_activation_hook');
register_language_files(IWF_MODULE_NAME, [IWF_MODULE_NAME]);

$CI = &get_instance();
$CI->load->helper(IWF_MODULE_NAME . '/invoice_workflow');

// ──────────────────────────────────────────────────────────────────────────────
// Admin UI hooks
// ──────────────────────────────────────────────────────────────────────────────

hooks()->add_action('admin_init', 'iwf_register_menu_items');
hooks()->add_action('admin_init', 'iwf_register_permissions');
hooks()->add_action('app_admin_head', 'iwf_add_head_component');
hooks()->add_action('app_admin_footer', 'iwf_add_footer_component');

// Inject panel workflow ke halaman detail invoice
hooks()->add_action('admin_invoice_view_after_details', 'iwf_render_workflow_panel');

// ──────────────────────────────────────────────────────────────────────────────
// Invoice lifecycle hooks — integrasi dengan Perfex core
// ──────────────────────────────────────────────────────────────────────────────

// Inisialisasi state workflow saat invoice baru dibuat
hooks()->add_action('after_invoice_added', 'iwf_init_workflow_on_invoice_added');

// Form rendering & save handlers untuk klasifikasi PO vs Non-PO
hooks()->add_action('after_render_invoice_template', 'iwf_render_po_classification_form');
hooks()->add_action('after_invoice_added', 'iwf_save_po_classification_details');
hooks()->add_action('invoice_updated', 'iwf_save_po_classification_details');

// Guard: blokir edit/delete invoice yang sudah masuk workflow (bukan draft/rejected)
hooks()->add_filter('invoice_can_be_edited',  'iwf_guard_invoice_edit',   10, 2);
hooks()->add_filter('invoice_can_be_deleted', 'iwf_guard_invoice_delete', 10, 2);

// ──────────────────────────────────────────────────────────────────────────────
// Cron hooks
// ──────────────────────────────────────────────────────────────────────────────

// Proses queue notifikasi setiap kali cron Perfex berjalan
hooks()->add_action('cron_run', 'iwf_process_notification_queue_cron');

// Kirim reminder overdue action (invoice stuck di suatu stage terlalu lama)
hooks()->add_action('cron_run', 'iwf_send_overdue_action_reminders');

// ──────────────────────────────────────────────────────────────────────────────
// Activation hook
// ──────────────────────────────────────────────────────────────────────────────

function iwf_activation_hook()
{
    $CI = &get_instance();
    require_once module_dir_path(IWF_MODULE_NAME, 'install.php');
}

// ──────────────────────────────────────────────────────────────────────────────
// Menu items
// ──────────────────────────────────────────────────────────────────────────────

function iwf_register_menu_items()
{
    $CI = &get_instance();

    $CI->app_menu->add_sidebar_menu_item('invoice-workflow', [
        'slug'     => 'invoice_workflow',
        'name'     => _l('iwf_menu_workflow'),
        'icon'     => 'fa fa-sitemap',
        'href'     => admin_url('invoice_workflow'),
        'position' => 10,
    ]);

    $CI->app_menu->add_sidebar_children_item('invoice-workflow', [
        'slug'     => 'invoice_workflow_approvers',
        'name'     => _l('iwf_menu_approvers'),
        'href'     => admin_url('invoice_workflow/approvers'),
        'position' => 1,
    ]);

    $CI->app_menu->add_sidebar_children_item('invoice-workflow', [
        'slug'     => 'invoice_workflow_delegations',
        'name'     => _l('iwf_menu_delegations'),
        'href'     => admin_url('invoice_workflow/delegations'),
        'position' => 2,
    ]);
}

// ──────────────────────────────────────────────────────────────────────────────
// Permissions
// ──────────────────────────────────────────────────────────────────────────────

function iwf_register_permissions()
{
    $capabilities = [
        [
            'name'  => _l('iwf_cap_view'),
            'value' => 'view',
        ],
        [
            'name'  => _l('iwf_cap_transition'),
            'value' => 'transition',
        ],
        [
            'name'  => _l('iwf_cap_manage_approvers'),
            'value' => 'manage_approvers',
        ],
        [
            'name'  => _l('iwf_cap_manage_delegations'),
            'value' => 'manage_delegations',
        ],
        [
            'name'  => _l('iwf_cap_export_audit'),
            'value' => 'export_audit',
        ],
    ];

    register_staff_capabilities('invoice_workflow', $capabilities);
}

// ──────────────────────────────────────────────────────────────────────────────
// Asset injection
// ──────────────────────────────────────────────────────────────────────────────

function iwf_add_head_component()
{
    $uri = $_SERVER['REQUEST_URI'] ?? '';

    // Load CSS hanya di halaman yang relevan
    if (strpos($uri, 'admin/invoices') !== false
        || strpos($uri, 'admin/invoice_workflow') !== false) {
        echo '<link href="' . module_dir_url(IWF_MODULE_NAME, 'assets/css/workflow.css') . '?v=' . IWF_REVISION . '" rel="stylesheet" type="text/css" />';
    }
}

function iwf_add_footer_component()
{
    $uri = $_SERVER['REQUEST_URI'] ?? '';

    if (strpos($uri, 'admin/invoices') !== false
        || strpos($uri, 'admin/invoice_workflow') !== false) {
        echo '<script src="' . module_dir_url(IWF_MODULE_NAME, 'assets/js/workflow.js') . '?v=' . IWF_REVISION . '"></script>';
    }
}

// ──────────────────────────────────────────────────────────────────────────────
// Invoice lifecycle callback functions
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Inisialisasi state workflow saat invoice baru dibuat di Perfex.
 * Hook: after_invoice_added
 */
function iwf_init_workflow_on_invoice_added($invoiceId)
{
    $CI = &get_instance();
    $CI->load->model(IWF_MODULE_NAME . '/Invoice_workflow_model', 'iwf_model');
    $CI->iwf_model->initializeWorkflow((int) $invoiceId);
}

/**
 * Guard: blokir pengeditan invoice yang sudah tidak dalam state draft/rejected.
 * Hook: invoice_can_be_edited (filter)
 */
function iwf_guard_invoice_edit($canEdit, $invoiceId)
{
    $CI = &get_instance();
    $CI->load->model(IWF_MODULE_NAME . '/Invoice_workflow_model', 'iwf_model');

    $state = $CI->iwf_model->getCurrentState((int) $invoiceId);

    if ($state && !in_array($state->current_state, ['draft', 'rejected', 'cancelled'], true)) {
        return false;
    }

    return $canEdit;
}

/**
 * Guard: blokir penghapusan invoice yang sudah masuk workflow aktif.
 * Hook: invoice_can_be_deleted (filter)
 */
function iwf_guard_invoice_delete($canDelete, $invoiceId)
{
    $CI = &get_instance();
    $CI->load->model(IWF_MODULE_NAME . '/Invoice_workflow_model', 'iwf_model');

    $state = $CI->iwf_model->getCurrentState((int) $invoiceId);

    if ($state && !in_array($state->current_state, ['draft', 'cancelled'], true)) {
        return false;
    }

    return $canDelete;
}

// ──────────────────────────────────────────────────────────────────────────────
// Workflow panel injection di halaman detail invoice
// ──────────────────────────────────────────────────────────────────────────────

function iwf_render_workflow_panel($invoiceId)
{
    $CI = &get_instance();
    $CI->load->model(IWF_MODULE_NAME . '/Invoice_workflow_model', 'iwf_model');
    $CI->load->model(IWF_MODULE_NAME . '/Wf_po_details_model', 'wf_po_model');
    $CI->load->model(IWF_MODULE_NAME . '/Wf_payment_model', 'wf_pay_model');
    $CI->load->library(IWF_MODULE_NAME . '/Invoice_state_machine', null, 'iwf_fsm');

    $state          = $CI->iwf_model->getCurrentState((int) $invoiceId);
    $poDetails      = $CI->wf_po_model->get_by_invoice_id((int) $invoiceId);
    $paymentDetails = $CI->wf_pay_model->get_by_invoice_id((int) $invoiceId);
    $actorId        = get_staff_user_id();
    $actorType      = 'staff';
    $availableActions = $CI->iwf_fsm->getAvailableActions((int) $invoiceId, $actorId, $actorType);
    $history        = $CI->iwf_model->getStateHistory((int) $invoiceId);

    $CI->load->view(IWF_MODULE_NAME . '/admin/partials/workflow_panel', [
        'invoiceId'        => $invoiceId,
        'state'            => $state,
        'poDetails'        => $poDetails,
        'paymentDetails'   => $paymentDetails,
        'availableActions' => $availableActions,
        'history'          => $history,
    ]);
}

// ──────────────────────────────────────────────────────────────────────────────
// Cron callback functions
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Proses antrian notifikasi email + in-app yang tertunda.
 */
function iwf_process_notification_queue_cron()
{
    $CI = &get_instance();
    $CI->load->library(IWF_MODULE_NAME . '/Wf_notifier', null, 'wf_notifier');
    $CI->wf_notifier->processQueue(50);
}

/**
 * Kirim reminder ke pemilik tahap jika invoice stagnan lebih dari threshold hari.
 */
function iwf_send_overdue_action_reminders()
{
    $CI = &get_instance();
    $CI->load->model(IWF_MODULE_NAME . '/Invoice_workflow_model', 'iwf_model');
    $CI->load->library(IWF_MODULE_NAME . '/Wf_notifier', null, 'wf_notifier');

    $overdueThresholdDays = (int) get_option('iwf_overdue_action_days') ?: 2;
    $stuckInvoices = $CI->iwf_model->getStuckInvoices($overdueThresholdDays);

    foreach ($stuckInvoices as $invoice) {
        $CI->wf_notifier->queueOverdueReminder($invoice->invoice_id, $invoice->current_state);
    }
}

// ──────────────────────────────────────────────────────────────────────────────
// PO vs Non-PO Classification Form Callbacks
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Render Form Fields Klasifikasi PO vs Non-PO di Form Invoice Admin.
 * Hook: after_render_invoice_template
 */
function iwf_render_po_classification_form($invoice = null)
{
    $CI = &get_instance();
    $CI->load->model(IWF_MODULE_NAME . '/Wf_po_details_model', 'wf_po_model');

    $poDetails = null;
    if ($invoice && isset($invoice->id)) {
        $poDetails = $CI->wf_po_model->get_by_invoice_id($invoice->id);
    }

    $CI->load->view(IWF_MODULE_NAME . '/admin/partials/po_classification_fields', [
        'invoice'    => $invoice,
        'po_details' => $poDetails,
    ]);
}

/**
 * Simpan Data Klasifikasi PO vs Non-PO saat Invoice Disimpan.
 * Hook: after_invoice_added & invoice_updated
 */
function iwf_save_po_classification_details($invoiceId)
{
    $CI = &get_instance();
    $CI->load->model(IWF_MODULE_NAME . '/Wf_po_details_model', 'wf_po_model');

    $postData = $CI->input->post();
    if (empty($postData) || !isset($postData['iwf_invoice_type'])) {
        return;
    }

    $payload = [
        'invoice_type'          => $postData['iwf_invoice_type'] ?? 'non_po',
        'po_number'             => $postData['iwf_po_number'] ?? null,
        'gr_number'             => $postData['iwf_gr_number'] ?? null,
        'vendor_invoice_number' => $postData['iwf_vendor_invoice_number'] ?? null,
        'faktur_pajak_number'  => $postData['iwf_faktur_pajak_number'] ?? null,
        'faktur_pajak_date'    => $postData['iwf_faktur_pajak_date'] ?? null,
        'wht_type'              => $postData['iwf_wht_type'] ?? null,
        'wht_amount'            => $postData['iwf_wht_amount'] ?? 0.00,
        'non_po_reason'         => $postData['iwf_non_po_reason'] ?? null,
    ];

    $CI->wf_po_model->save_po_details((int)$invoiceId, $payload);
}

