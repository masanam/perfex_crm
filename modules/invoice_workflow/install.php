<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Invoice Workflow Engine — Database Migrations & Seed Data
 *
 * Dijalankan saat module diaktifkan pertama kali.
 * Semua operasi menggunakan `if (!table_exists)` agar idempotent (aman dijalankan ulang).
 */

$CI = &get_instance();

// ──────────────────────────────────────────────────────────────────────────────
// Default options / settings
// ──────────────────────────────────────────────────────────────────────────────

add_option('iwf_approval_threshold_senior', 50000000);  // 50 juta IDR (batas kewenangan Senior Manager)
add_option('iwf_overdue_action_days', 2);                // Hari sebelum reminder overdue dikirim
add_option('iwf_notification_retry_max', 3);             // Maksimal retry notifikasi
add_option('iwf_po_flow_enabled', 1);                    // 1 = aktifkan flow PO
add_option('iwf_non_po_skip_tax', 0);                    // 1 = Non-PO skip step Tax
add_option('iwf_non_po_skip_treasury', 0);               // 1 = Non-PO skip step Treasury

// ──────────────────────────────────────────────────────────────────────────────
// Tabel 1: wf_invoice_states
// Status workflow terkini per invoice (1:1 dengan tbl_invoices)
// ──────────────────────────────────────────────────────────────────────────────

if (!$CI->db->table_exists(db_prefix() . 'wf_invoice_states')) {
    $CI->db->query('
        CREATE TABLE `' . db_prefix() . 'wf_invoice_states` (
            `id`            INT(11)      NOT NULL AUTO_INCREMENT,
            `invoice_id`    INT(11)      NOT NULL COMMENT "FK ke tbl_invoices.id",
            `invoice_type`  ENUM("po","non_po") NOT NULL DEFAULT "non_po",
            `current_state` VARCHAR(50)  NOT NULL DEFAULT "draft",
            `submitted_by`  INT(11)      NULL     COMMENT "staffid atau contactid yang mengajukan",
            `submitted_at`  DATETIME     NULL,
            `locked_at`     DATETIME     NULL     COMMENT "Diset saat state = closed",
            `created_at`    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at`    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_wf_invoice_id` (`invoice_id`),
            KEY `idx_wf_current_state` (`current_state`),
            KEY `idx_wf_updated_at` (`updated_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';
    ');
}

// ──────────────────────────────────────────────────────────────────────────────
// Tabel 2: wf_state_logs (IMMUTABLE AUDIT TRAIL)
// Append-only — tidak ada UPDATE/DELETE yang diizinkan di level aplikasi
// ──────────────────────────────────────────────────────────────────────────────

if (!$CI->db->table_exists(db_prefix() . 'wf_state_logs')) {
    $CI->db->query('
        CREATE TABLE `' . db_prefix() . 'wf_state_logs` (
            `id`          BIGINT       NOT NULL AUTO_INCREMENT,
            `invoice_id`  INT(11)      NOT NULL,
            `from_state`  VARCHAR(50)  NULL     COMMENT "NULL = initial submit",
            `to_state`    VARCHAR(50)  NOT NULL,
            `action`      VARCHAR(50)  NOT NULL COMMENT "submit|verify|approve|return|reject|acknowledge|delegate|confirm_payment",
            `actor_type`  ENUM("staff","vendor","system") NOT NULL DEFAULT "staff",
            `actor_id`    INT(11)      NOT NULL,
            `actor_name`  VARCHAR(255) NOT NULL COMMENT "Snapshot nama — tidak pakai JOIN agar immutable",
            `comment_id`  INT(11)      NULL     COMMENT "FK ke wf_comments.id",
            `metadata`    JSON         NULL     COMMENT "Data tambahan: amount, bank_voucher_ref, dll",
            `ip_address`  VARCHAR(45)  NOT NULL DEFAULT "",
            `user_agent`  VARCHAR(500) NULL,
            `created_at`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_wfl_invoice_id` (`invoice_id`),
            KEY `idx_wfl_created_at` (`created_at`),
            KEY `idx_wfl_actor` (`actor_type`, `actor_id`),
            KEY `idx_wfl_action` (`action`)
        ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';
    ');
}

// ──────────────────────────────────────────────────────────────────────────────
// Tabel 3: wf_comments
// Komentar per aksi workflow — wajib diisi saat return/reject
// ──────────────────────────────────────────────────────────────────────────────

if (!$CI->db->table_exists(db_prefix() . 'wf_comments')) {
    $CI->db->query('
        CREATE TABLE `' . db_prefix() . 'wf_comments` (
            `id`          INT(11)      NOT NULL AUTO_INCREMENT,
            `invoice_id`  INT(11)      NOT NULL,
            `log_id`      BIGINT       NULL     COMMENT "FK ke wf_state_logs.id",
            `actor_type`  ENUM("staff","vendor","system") NOT NULL DEFAULT "staff",
            `actor_id`    INT(11)      NOT NULL,
            `actor_name`  VARCHAR(255) NOT NULL COMMENT "Snapshot nama",
            `comment`     TEXT         NOT NULL,
            `is_internal` TINYINT(1)   NOT NULL DEFAULT 0 COMMENT "1 = tidak terlihat vendor",
            `created_at`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_wfc_invoice_id` (`invoice_id`),
            KEY `idx_wfc_log_id` (`log_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';
    ');
}

// ──────────────────────────────────────────────────────────────────────────────
// Tabel 4: wf_approvers
// Konfigurasi pejabat berwenang per role + batas kewenangan (amount threshold)
// ──────────────────────────────────────────────────────────────────────────────

if (!$CI->db->table_exists(db_prefix() . 'wf_approvers')) {
    $CI->db->query('
        CREATE TABLE `' . db_prefix() . 'wf_approvers` (
            `id`          INT(11)        NOT NULL AUTO_INCREMENT,
            `staff_id`    INT(11)        NOT NULL COMMENT "FK ke tbl_staff.staffid",
            `role_slug`   VARCHAR(50)    NOT NULL COMMENT "ap_receiver|tax|treasury|senior_manager|gm_finance",
            `amount_min`  DECIMAL(15,2)  NULL     COMMENT "NULL = tanpa batas bawah",
            `amount_max`  DECIMAL(15,2)  NULL     COMMENT "NULL = tanpa batas atas",
            `is_active`   TINYINT(1)     NOT NULL DEFAULT 1,
            `notes`       TEXT           NULL,
            `created_by`  INT(11)        NOT NULL,
            `created_at`  DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at`  DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_wfa_role_slug` (`role_slug`),
            KEY `idx_wfa_staff_id` (`staff_id`),
            KEY `idx_wfa_active` (`is_active`)
        ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';
    ');
}

// ──────────────────────────────────────────────────────────────────────────────
// Tabel 5: wf_delegations
// Delegasi persetujuan sementara (Senior Manager/GM Finance -> orang lain)
// ──────────────────────────────────────────────────────────────────────────────

if (!$CI->db->table_exists(db_prefix() . 'wf_delegations')) {
    $CI->db->query('
        CREATE TABLE `' . db_prefix() . 'wf_delegations` (
            `id`            INT(11)    NOT NULL AUTO_INCREMENT,
            `delegator_id`  INT(11)    NOT NULL COMMENT "Staff yang mendelegasikan",
            `delegatee_id`  INT(11)    NOT NULL COMMENT "Staff yang menerima delegasi",
            `role_slug`     VARCHAR(50) NOT NULL COMMENT "Role yang didelegasikan",
            `valid_from`    DATETIME   NOT NULL,
            `valid_until`   DATETIME   NOT NULL,
            `reason`        TEXT       NULL,
            `is_active`     TINYINT(1) NOT NULL DEFAULT 1,
            `revoked_at`    DATETIME   NULL,
            `revoked_by`    INT(11)    NULL,
            `created_at`    DATETIME   NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_wfd_delegatee` (`delegatee_id`),
            KEY `idx_wfd_validity` (`valid_from`, `valid_until`, `is_active`),
            KEY `idx_wfd_delegator` (`delegator_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';
    ');
}

// ──────────────────────────────────────────────────────────────────────────────
// Tabel 6: wf_notification_queue
// Antrian notifikasi email + in-app dengan mekanisme retry
// ──────────────────────────────────────────────────────────────────────────────

if (!$CI->db->table_exists(db_prefix() . 'wf_notification_queue')) {
    $CI->db->query('
        CREATE TABLE `' . db_prefix() . 'wf_notification_queue` (
            `id`                BIGINT       NOT NULL AUTO_INCREMENT,
            `invoice_id`        INT(11)      NOT NULL,
            `log_id`            BIGINT       NOT NULL,
            `recipient_type`    ENUM("staff","vendor") NOT NULL,
            `recipient_id`      INT(11)      NOT NULL,
            `notification_type` VARCHAR(100) NOT NULL COMMENT "wf_submitted|wf_ap_approved|wf_returned|wf_approved|wf_rejected|wf_payment_confirmed|wf_overdue_action",
            `channel`           ENUM("email","in_app","both") NOT NULL DEFAULT "both",
            `payload`           JSON         NULL COMMENT "Merge fields & data tambahan untuk template email",
            `status`            ENUM("pending","sent","failed") NOT NULL DEFAULT "pending",
            `attempts`          TINYINT(3)   NOT NULL DEFAULT 0,
            `last_attempt_at`   DATETIME     NULL,
            `error_message`     TEXT         NULL,
            `created_at`        DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_wfnq_status_attempts` (`status`, `attempts`),
            KEY `idx_wfnq_invoice_id` (`invoice_id`),
            KEY `idx_wfnq_recipient` (`recipient_type`, `recipient_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';
    ');
}

// ──────────────────────────────────────────────────────────────────────────────
// Tabel 7: wf_invoice_po_details
// Metadata klasifikasi Invoice PO vs Non-PO, Faktur Pajak, WHT & Vendor Inv No
// ──────────────────────────────────────────────────────────────────────────────

if (!$CI->db->table_exists(db_prefix() . 'wf_invoice_po_details')) {
    $CI->db->query('
        CREATE TABLE `' . db_prefix() . 'wf_invoice_po_details` (
            `id`                    INT(11)        NOT NULL AUTO_INCREMENT,
            `invoice_id`            INT(11)        NOT NULL COMMENT "FK ke tbl_invoices.id",
            `invoice_type`          ENUM("po","non_po") NOT NULL DEFAULT "non_po",
            `po_number`             VARCHAR(100)   NULL COMMENT "Nomor Purchase Order",
            `gr_number`             VARCHAR(100)   NULL COMMENT "Nomor Goods Receipt / BA Penerimaan",
            `vendor_invoice_number` VARCHAR(100)   NULL COMMENT "Nomor Invoice dari Vendor",
            `faktur_pajak_number`  VARCHAR(100)   NULL COMMENT "Nomor Seri Faktur Pajak 16 digit",
            `faktur_pajak_date`    DATE           NULL COMMENT "Tanggal Faktur Pajak",
            `wht_type`              VARCHAR(50)    NULL COMMENT "PPh 23|PPh 4(2)|PPh 21|PPh 22|Non-WHT",
            `wht_rate`              DECIMAL(5,2)   DEFAULT 0.00 COMMENT "Tarif PPh %",
            `wht_amount`            DECIMAL(15,2)  DEFAULT 0.00 COMMENT "Nilai Potongan PPh",
            `non_po_reason`         TEXT           NULL COMMENT "Alasan/Justifikasi jika Non-PO",
            `created_at`            DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at`            DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_wf_po_invoice_id` (`invoice_id`),
            KEY `idx_wf_vendor_inv_num` (`vendor_invoice_number`),
            KEY `idx_wf_po_number` (`po_number`)
        ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';
    ');
}

// ──────────────────────────────────────────────────────────────────────────────
// Tabel 8: wf_payment_details
// Pencatatan rincian pembayaran & bukti Bank Voucher oleh Treasury (FR-10)
// ──────────────────────────────────────────────────────────────────────────────

if (!$CI->db->table_exists(db_prefix() . 'wf_payment_details')) {
    $CI->db->query('
        CREATE TABLE `' . db_prefix() . 'wf_payment_details` (
            `id`                  INT(11)        NOT NULL AUTO_INCREMENT,
            `invoice_id`          INT(11)        NOT NULL COMMENT "FK ke tbl_invoices.id",
            `bank_voucher_number` VARCHAR(100)   NOT NULL COMMENT "Nomor Bukti Bank Voucher",
            `bank_name`           VARCHAR(100)   NULL     COMMENT "Nama Bank Pengirim/Tujuan",
            `bank_account_number` VARCHAR(100)   NULL     COMMENT "Nomor Rekening Bank",
            `payment_method`      VARCHAR(50)    NOT NULL DEFAULT "bank_transfer",
            `payment_amount`      DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
            `payment_date`        DATE           NOT NULL,
            `payment_notes`       TEXT           NULL,
            `created_by`          INT(11)        NOT NULL COMMENT "Staffid Treasury",
            `created_at`          DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_wf_pay_invoice_id` (`invoice_id`),
            KEY `idx_wf_bank_voucher` (`bank_voucher_number`)
        ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';
    ');
}

// ──────────────────────────────────────────────────────────────────────────────
// Tabel 9: wf_vendor_otp
// Penyimpanan kode OTP autentikasi Login Vendor (FR-01)
// ──────────────────────────────────────────────────────────────────────────────

if (!$CI->db->table_exists(db_prefix() . 'wf_vendor_otp')) {
    $CI->db->query('
        CREATE TABLE `' . db_prefix() . 'wf_vendor_otp` (
            `id`          INT(11)      NOT NULL AUTO_INCREMENT,
            `contact_id`  INT(11)      NOT NULL COMMENT "FK ke tblcontacts.id",
            `email`       VARCHAR(150) NOT NULL,
            `otp_code`    VARCHAR(6)   NOT NULL,
            `expires_at`  DATETIME     NOT NULL,
            `attempts`    TINYINT(3)   NOT NULL DEFAULT 0,
            `is_used`     TINYINT(1)   NOT NULL DEFAULT 0,
            `ip_address`  VARCHAR(45)  NOT NULL DEFAULT "",
            `created_at`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_wf_email_otp` (`email`, `otp_code`, `is_used`),
            KEY `idx_wf_contact_id` (`contact_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';
    ');
}

log_activity('Invoice Workflow Engine module installed successfully (v' . IWF_VERSION . ')');


