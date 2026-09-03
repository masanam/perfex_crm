# 🤖 AI Executive Summary — Panduan Fitur & Perubahan

Fitur **AI Executive Summary** menambahkan kemampuan analisis proyek berbasis AI langsung di dalam tab **Project** pada Perfex CRM. Fitur ini menganalisis data proyek secara real-time dan menghasilkan ringkasan eksekutif 4-bab dalam Bahasa Indonesia.

---

## 📦 File yang Dimodifikasi / Ditambahkan

| File | Status | Keterangan |
|---|---|---|
| `application/controllers/admin/Projects.php` | MODIFIED | Ditambahkan 2 method baru: `generate_ai_summary()` dan `stream_ai_summary()` |
| `application/views/admin/projects/project_ai_summary.php` | NEW | View tab AI Summary lengkap dengan UI, streaming SSE, dan fallback AJAX |

---

## ✨ Fitur yang Diimplementasikan

### 1. Tab "AI Summary" di Project

Tab baru **AI Summary** ditambahkan di halaman detail project (`/admin/projects/view/{id}`).
Menampilkan ringkasan eksekutif hasil analisis AI yang dapat di-*generate* ulang kapan saja.

### 2. Generate AI Summary (AJAX Non-Streaming)

**Endpoint:** `POST /admin/projects/generate_ai_summary/{id}`

Menghasilkan ringkasan dalam satu request tanpa streaming. Terdapat 3 lapisan fallback:

| Prioritas | Provider | Model | Timeout |
|---|---|---|---|
| 1 (Utama) | Alibaba Cloud Model Studio | `qwen-plus`, `qwen-turbo`, dll. | 8 detik |
| 2 (Fallback) | Ollama Server Lokal | `qwen2.5:3b` | 20 detik |
| 3 (Last resort) | Pollinations.ai Cloud | `qwen` | 12 detik |

### 3. Real-time Streaming AI Summary (SSE)

**Endpoint:** `GET /admin/projects/stream_ai_summary/{id}`

Mengirim token AI secara *real-time* ke browser menggunakan **Server-Sent Events (SSE)**.
Jika SSE gagal (Cloudflare/proxy timeout), otomatis fallback ke AJAX POST.

Header SSE anti-buffering:
```
Content-Type: text/event-stream; charset=utf-8
Cache-Control: no-cache, no-transform
X-Accel-Buffering: no
```

### 4. Pilihan Model AI

| Opsi | Value | Keterangan |
|---|---|---|
| ⚡ Ultra Cepat **(default)** | `local:qwen2.5:3b` | Ollama server lokal, ~6–8 detik, streaming real-time |
| 🚀 Qwen Turbo | `qwen-turbo` | Alibaba Cloud, cepat |
| 🎯 Qwen Plus | `qwen-plus` | Alibaba Cloud, lebih cerdas |
| 🧠 Qwen Max | `qwen-max` | Alibaba Cloud, analisis mendalam |

### 5. Konteks Data Proyek yang Dianalisis AI

- **Identitas Proyek** — Nama, klien, tanggal mulai, deadline
- **Progres & Task** — Persentase progres, jumlah task selesai/pending/overdue
- **Milestone** — Nama dan target tanggal (maks 4)
- **Task Overdue** — Daftar task terlambat beserta PIC (maks 5)
- **Task Aktif** — Daftar task berjalan beserta PIC (maks 8)
- **Beban Kerja Tim** — Jumlah task per anggota tim + berapa yang selesai/overdue

### 6. Format Output AI (4 Bab Eksekutif)

```
## 📊 1. Rekapitulasi & Progres Proyek
## ⚠️ 2. Hal Penting & Analisis Risiko
## 🎯 3. Rekomendasi Tindakan Strategis
## 👥 4. Catatan & Saran untuk Personil / Tim Terlibat
```

### 7. Penyimpanan ke Database

Kolom ditambahkan otomatis ke `tbl_projects` jika belum ada:

| Kolom DB | Tipe | Keterangan |
|---|---|---|
| `ai_summary` | `LONGTEXT` | Konten markdown ringkasan AI |
| `ai_summary_last_updated` | `DATETIME` | Waktu terakhir generate |
| `ai_summary_status` | `VARCHAR(20)` | Status: `done` |
| `ai_summary_model` | `VARCHAR(50)` | Model yang digunakan |

---

## 🛡️ Penanganan Error & Timeout

| Masalah | Penanganan |
|---|---|
| SSE terputus (Cloudflare buffer) | Auto-fallback ke AJAX POST |
| Alibaba Cloud timeout (>8 detik) | Auto-switch ke Ollama lokal |
| Ollama lokal tidak responsif | Fallback ke Pollinations.ai cloud |
| Semua provider gagal | Error alert ditampilkan ke user |

---

## ⚙️ Konfigurasi

### Ollama Server
- **URL:** `http://188.166.208.79:11434`
- **Model:** `qwen2.5:3b`
- **Tokens max:** `1000` (num_predict)
- **Context window:** `3072` token

### Alibaba Cloud Model Studio
- **Endpoint:** `https://ws-8m543cnyx3a7d404.ap-southeast-1.maas.aliyuncs.com/compatible-mode/v1/chat/completions`
- **Max tokens:** `1200`
- ⚠️ API Key tersimpan di `Projects.php` — disarankan dipindah ke config/environment variable

---

## 🌐 Catatan Cloudflare

`erp.digivla.id` berada di belakang **Cloudflare Proxy (Orange Cloud)**:

- Seluruh request AI selesai < 30 detik (aman dari timeout Cloudflare ~100 detik)
- Header `X-Accel-Buffering: no` mencegah SSE di-buffer proxy
- Mode **Ultra Cepat** (Ollama lokal) paling stabil: selesai 6–8 detik

---

## 🚀 Cara Penggunaan

1. Buka `https://erp.digivla.id/admin/projects/view/{id}`
2. Klik tab **AI Summary**
3. Pilih model dari dropdown (default: **⚡ Ultra Cepat**)
4. Klik tombol **Generate AI Summary**
5. Ringkasan muncul real-time token per token
6. Hasil tersimpan otomatis untuk ditampilkan kembali

---

## 📝 Changelog

### v1.3.0 — 2026-09-03
- ✅ `stream_ai_summary()` kini memuat data proyek penuh (bug fix: sebelumnya hanya kirim prompt kosong)
- ✅ Default model diganti ke **⚡ Ultra Cepat** (`local:qwen2.5:3b`) di dropdown & JS
- ✅ Badge nama model teknis disembunyikan dari UI
- ✅ `ai_summary_last_updated` di-update saat streaming selesai

### v1.2.0 — 2026-09-03
- ✅ Auto-fallback dari SSE ke AJAX POST jika streaming terputus
- ✅ Animasi cursor streaming saat AI sedang menulis
- ✅ `session_write_close()` sebelum streaming agar request CRM lain tidak terblokir

### v1.1.0 — 2026-09-02
- ✅ SSE streaming endpoint `stream_ai_summary`
- ✅ AJAX generate `generate_ai_summary` dengan 3 provider fallback
- ✅ Auto-create kolom DB jika belum ada
- ✅ Integrasi Alibaba Cloud Model Studio + Ollama lokal

### v1.0.0 — 2026-09-02
- ✅ Tab AI Summary pertama kali ditambahkan ke halaman Project
- ✅ UI awal: tombol Generate, dropdown model, area konten
