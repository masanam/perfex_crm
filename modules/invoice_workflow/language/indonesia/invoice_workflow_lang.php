<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Invoice Workflow Engine - Indonesian Language Strings
 */

$lang['invoice_workflow'] = 'Workflow Invoice';
$lang['iwf_dashboard_title'] = 'Dashboard Workflow Invoice';
$lang['iwf_dashboard_subtitle'] = 'Pemantauan alur kerja persetujuan invoice multi-tahap dan audit log.';
$lang['iwf_manage_approvers'] = 'Kelola Approver';
$lang['iwf_manage_approvers_subtitle'] = 'Pengaturan staff persetujuan alur alokasi invoice.';
$lang['iwf_manage_delegations'] = 'Kelola Delegasi';
$lang['iwf_manage_delegations_subtitle'] = 'Alokasi delegasi wewenang persetujuan sementara.';

$lang['iwf_stat_total_in_workflow'] = 'Total Invoice di Workflow';
$lang['iwf_stat_stuck_invoices'] = 'Invoice Tertahan (Overdue)';
$lang['iwf_stat_active_approvers'] = 'Approver Aktif';
$lang['iwf_stat_active_delegations'] = 'Delegasi Aktif';
$lang['iwf_state_distribution'] = 'Distribusu Status Workflow';
$lang['iwf_stuck_invoices_table_title'] = 'Daftar Invoice Tertahan Melebihi Batas Waktu (SLA)';

$lang['iwf_current_state'] = 'Status Workflow Saat Ini';
$lang['iwf_workflow_actions'] = 'Tindakan Workflow';
$lang['iwf_audit_timeline'] = 'Riwayat Audit & Komentar';
$lang['iwf_comment_placeholder'] = 'Tulis catatan atau alasan tindakan di sini...';
$lang['iwf_internal_comment_notice'] = 'Catatan internal hanya terlihat oleh tim verifikasi/persetujuan.';

$lang['iwf_add_approver'] = 'Tambah Approver Baru';
$lang['iwf_add_delegation'] = 'Tambah Delegasi Baru';
$lang['iwf_action_successful'] = 'Tindakan alur kerja berhasil diperbarui.';
$lang['iwf_action_failed'] = 'Gagal memproses alur kerja: ';

// Menus
$lang['iwf_menu_workflow']    = 'Workflow Invoice';
$lang['iwf_menu_approvers']   = 'Approver';
$lang['iwf_menu_delegations'] = 'Delegasi';

// States
$lang['iwf_state_draft']              = 'Draft';
$lang['iwf_state_submitted']          = 'Diajukan';
$lang['iwf_state_ap_review']          = 'Review AP/Receiver';
$lang['iwf_state_tax_review']         = 'Review Pajak';
$lang['iwf_state_treasury_ack']       = 'Konfirmasi Treasury';
$lang['iwf_state_pending_approval']   = 'Menunggu Persetujuan';
$lang['iwf_state_approved_senior']    = 'Disetujui (Senior Manager)';
$lang['iwf_state_approved']           = 'Disetujui Penuh';
$lang['iwf_state_payment_processing'] = 'Proses Pembayaran';
$lang['iwf_state_closed']             = 'Selesai / Ditutup';
$lang['iwf_state_rejected']           = 'Ditolak';
$lang['iwf_state_cancelled']          = 'Dibatalkan';

// Actions
$lang['iwf_action_submit']          = 'Ajukan';
$lang['iwf_action_verify']          = 'Verifikasi';
$lang['iwf_action_approve']         = 'Setujui';
$lang['iwf_action_acknowledge']     = 'Konfirmasi';
$lang['iwf_action_return']          = 'Kembalikan untuk Koreksi';
$lang['iwf_action_reject']          = 'Tolak';
$lang['iwf_action_process_payment'] = 'Proses Pembayaran';
$lang['iwf_action_confirm_payment'] = 'Konfirmasi Pembayaran';
$lang['iwf_action_cancel']          = 'Batalkan';
$lang['iwf_action_delegate']        = 'Delegasikan Wewenang';
$lang['iwf_action_resubmit']        = 'Ajukan Ulang';

// Panel
$lang['iwf_panel_title']          = 'Status Workflow Invoice';
$lang['iwf_available_actions']    = 'Tindakan yang Tersedia:';
$lang['iwf_no_actions_available'] = 'Tidak ada tindakan yang tersedia untuk peran Anda saat ini.';
$lang['iwf_state_not_initialized'] = 'Status workflow belum diinisialisasi untuk invoice ini.';
$lang['iwf_state_locked_at']       = 'Invoice ini telah selesai dan dikunci pada';
$lang['iwf_timeline_title']        = 'Riwayat Workflow';
$lang['iwf_timeline_empty']        = 'Belum ada riwayat alur kerja.';
$lang['iwf_comment_internal']      = 'Internal';

// Modal
$lang['iwf_modal_confirm_action']  = 'Konfirmasi Tindakan Workflow';
$lang['iwf_label_action']          = 'Tindakan';
$lang['iwf_label_comment']         = 'Catatan / Alasan';
$lang['iwf_label_delegatee']       = 'Delegasikan Kepada';
$lang['iwf_select_staff']          = 'Pilih Anggota Staff';
$lang['iwf_btn_confirm']           = 'Konfirmasi';

// Capabilities
$lang['iwf_cap_view']               = 'Lihat Workflow';
$lang['iwf_cap_transition']         = 'Eksekusi Transisi Workflow';
$lang['iwf_cap_manage_approvers']   = 'Kelola Approver';
$lang['iwf_cap_manage_delegations'] = 'Kelola Delegasi';
$lang['iwf_cap_export_audit']       = 'Ekspor Audit Trail';

