# 🧾 Invoice Workflow Engine — Documentation & Developer Guide

Modul **Invoice Workflow Engine** (`modules/invoice_workflow`) adalah modul kustom Perfex CRM yang mengimplementasikan alur kerja alokasi dan persetujuan invoice multi-tahap (*multi-step approval workflow*) sesuai dengan dokumen TOR/SOW Sistem Manajemen Invoice NEC Indonesia.

---

## 📦 Ringkasan File & Struktur Direktori

```
modules/invoice_workflow/
├── README.md                           # Dokumentasi teknis & panduan modul
├── invoice_workflow.php                # Entry point utama modul & pendaftaran hooks Perfex
├── install.php                         # Migrasi database (skema tabel & default settings)
├── controllers/
│   ├── Invoice_workflow.php            # Admin Controller (dashboard, transisi state, approver & delegasi)
│   └── Vendor_otp.php                  # Client Controller (endpoint OTP login vendor)
├── models/
│   ├── Invoice_workflow_model.php      # Model inti status workflow & audit log
│   ├── Wf_approvers_model.php          # Model matriks approver & batas kewenangan (amount threshold)
│   ├── Wf_delegation_model.php         # Model manajemen delegasi wewenang sementara
│   ├── Wf_po_details_model.php         # Model klasifikasi PO vs Non-PO & deteksi duplikasi
│   └── Wf_payment_model.php            # Model rincian pembayaran Treasury & Bank Voucher
├── libraries/
│   ├── Invoice_state_machine.php       # Finite State Machine (FSM) core engine & role guard
│   ├── Wf_notifier.php                 # Notifikasi engine (email & in-app dengan retry mechanism)
│   └── Wf_otp_service.php              # Service pembuatan & verifikasi OTP email vendor
├── helpers/
│   └── invoice_workflow_helper.php     # Helper badge, label status, dan helper permission
├── views/
│   ├── admin/
│   │   ├── dashboard.php               # View dashboard alur kerja & monitoring stuck invoices
│   │   ├── approvers/manage.php        # View kelola matriks approver
│   │   ├── delegations/manage.php      # View kelola delegasi persetujuan
│   │   └── partials/
│   │       ├── workflow_panel.php      # Widget alur kerja di halaman detail invoice
│   │       ├── po_classification_fields.php # Form input PO vs Non-PO & Faktur Pajak
│   │       └── timeline.php            # View riwayat audit log & komentar
├── language/
│   ├── english/invoice_workflow_lang.php
│   └── indonesia/invoice_workflow_lang.php
└── assets/
    ├── css/workflow.css                # Style kustom badge, timeline, & kartu statistik
    └── js/workflow.js                  # Frontend JavaScript (AJAX transition & modal)
```

---

## ✨ Fitur Utama yang Diimplementasikan

### 1. Multi-Step Approval Workflow (FSM 8 Tahap)
Mengimplementasikan Finite State Machine terisolasi yang tidak mengubah status pembayaran standar Perfex CRM:
- **`DRAFT`** → Draft invoice (Vendor / Requester)
- **`SUBMITTED`** → Menunggu Verifikasi AP/Receiver
- **`AP_REVIEW`** → Verifikasi Dokumen & Tagihan AP
- **`TAX_REVIEW`** → Verifikasi Pajak & Faktur Pajak
- **`TREASURY_ACK`** → Acknowledgement & Cek Ketersediaan Dana Treasury
- **`PENDING_APPROVAL`** → Persetujuan Senior Manager / GM Finance (berdasarkan amount threshold)
- **`APPROVED`** → Invoice Disetujui (Siap Dibayar)
- **`PAYMENT_PROCESSING`** → Proses Pembayaran & Bank Voucher oleh Treasury
- **`CLOSED`** → Invoice Selesai & Terkunci (Immutable)

### 2. Klasifikasi Invoice PO vs Non-PO & Pajak (FR-03, FR-04 & FR-05)
- **Invoice PO**: Mengharuskan pengisian **PO Number** dan **Goods Receipt (GR/BA) Number**.
- **Invoice Non-PO**: Mengharuskan pengisian **Justifikasi / Alasan Pengajuan Non-PO**.
- **Perpajakan**: Pencatatan **Nomor Seri Faktur Pajak (16 Digit)**, Tanggal Faktur Pajak, serta potongan WHT (PPh 23, PPh 4(2), PPh 21, PPh 22).
- **Deteksi Duplikasi**: Pencegahan otomatis pengajuan nomor invoice vendor ganda (`vendor_invoice_number` + `clientid`).

### 3. Bukti Pembayaran & Bank Voucher (FR-10)
- Pencatatan Bukti **Bank Voucher**, Tanggal Bayar, Metode Bayar (Transfer/Cek/Giro), dan Rekening Bank oleh Treasury saat mengonfirmasi pembayaran (`confirm_payment`).

### 4. Autentikasi OTP Vendor (FR-01 & FR-02)
- Layanan pengiriman OTP 6-digit ke email kontak vendor dengan masa berlaku **10 menit** dan batas proteksi **3x percobaan gagal**.

### 5. Audit Log Imutabel & Komentar Wajib (FR-07, FR-08 & FR-12)
- Catatan audit log append-only pada tabel `tblwf_state_logs` yang merekam setiap transisi state.
- Kewajiban mengisi komentar/catatan saat melakukan pengembalian (`return`) atau penolakan (`reject`).
- Fitur ekspor Audit Log ke format CSV di panel admin.

---

## 🗄️ Skema Tabel Database (`tblwf_*`)

| Nama Tabel | Fungsi |
|---|---|
| `tblwf_invoice_states` | Status workflow terkini per invoice (1:1 dengan `tbl_invoices`) |
| `tblwf_state_logs` | Audit trail imutabel (append-only) setiap aksi transisi |
| `tblwf_comments` | Komentar & catatan aksi pengembalian/penolakan |
| `tblwf_approvers` | Matriks pejabat persetujuan & batas kewenangan nominal |
| `tblwf_delegations` | Pencatatan delegasi persetujuan sementara |
| `tblwf_notification_queue` | Antrean notifikasi email + in-app dengan mekanisme retry |
| `tblwf_invoice_po_details` | Metadata PO vs Non-PO, Faktur Pajak, & WHT PPh |
| `tblwf_payment_details` | Rincian pembayaran Treasury & Bank Voucher |
| `tblwf_vendor_otp` | Penyimpanan kode OTP login vendor |

---

## 🚀 Cara Aktivasi Modul

1. Masuk ke **Perfex CRM Admin Panel** (`/admin`).
2. Navigasi ke **Setup** → **Modules**.
3. Cari modul **Invoice Workflow Engine** dan klik **Activate**.
4. Modul akan mengeksekusi `install.php` secara otomatis untuk membuat 9 tabel database (`tblwf_*`) dan mengkonfigurasi opsi default.
