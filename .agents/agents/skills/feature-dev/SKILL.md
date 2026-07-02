---
name: feature-dev
description: >
  Gunakan skill ini saat diminta membangun fitur baru, membuat endpoint baru,
  atau mengimplementasikan fungsi yang belum ada. Trigger kata kunci:
  tambahkan fitur, buat endpoint, implementasikan, saya perlu API yang bisa,
  buat CRUD untuk. Selalu klarifikasi requirement dan presentasikan Feature Plan
  lengkap sebelum menulis satu baris kode implementasi.
tools: Read, Grep, Glob, Edit, Write
---

## Tujuan

Membangun fitur API baru yang mengikuti arsitektur, pola, dan standar
yang sudah ada di codebase dengan pendekatan API-first dan test-alongside.

---

## Alur Eksekusi (7 Langkah)

### STEP 1 — CLARIFY
Pahami requirement sepenuhnya SEBELUM desain atau koding apapun.

Jika requirement belum lengkap, tampilkan pertanyaan ini:

```
KLARIFIKASI DIPERLUKAN

Sebelum saya mulai merancang fitur ini, ada beberapa hal yang perlu dikonfirmasi:

1. Apa yang harus dilakukan fitur ini secara konkret?
2. Siapa yang akan menggunakan endpoint ini — user biasa, admin, atau service lain?
3. Apa yang terjadi jika [sebutkan edge case yang teridentifikasi]?
4. Apakah ada fitur serupa yang sudah ada dan bisa dijadikan referensi pola?
5. Apakah ada batasan performa atau SLA yang harus dipenuhi?

Jawaban ini akan menentukan desain API dan arsitektur yang tepat.
```

Jangan lanjut ke STEP 2 sebelum semua pertanyaan kritis terjawab.

### STEP 2 — EXPLORE
Pelajari codebase yang ada sebelum merancang apapun.
- Baca struktur direktori project untuk memahami layout yang digunakan
- Identifikasi layer architecture yang ada (MVC, layered, hexagonal, dll)
- Cari contoh endpoint atau fitur serupa sebagai referensi pola yang harus diikuti
- Identifikasi shared middleware, validator, helper yang bisa digunakan kembali
- Baca schema database dan migration file yang relevan

### STEP 3 — DESIGN
Rancang API contract dan arsitektur sebelum menulis implementasi apapun.

Tampilkan Feature Plan dengan format berikut:

```
## Feature Plan — [Nama Fitur]

### Ringkasan
[Deskripsi singkat apa yang dibangun dan mengapa dibutuhkan]

### API Contract

[METHOD] /path/endpoint
Authorization: [Bearer token | API Key | Public]

Request Body:
{
  "fieldWajib": "string (required, max 255 char)",
  "fieldOpsional": 123 (optional, default 0)
}

Response Sukses (201):
{
  "success": true,
  "data": { ... }
}

Response Error:
| Status | Code             | Kondisi                  |
|--------|------------------|--------------------------|
| 400    | VALIDATION_ERROR | Input tidak valid        |
| 401    | UNAUTHORIZED     | Token tidak ada/expired  |
| 409    | DUPLICATE_ENTRY  | Data sudah ada           |
| 500    | INTERNAL_ERROR   | Kesalahan server         |

### Perubahan Database
- Tabel baru atau kolom baru: [nama dan deskripsi]
- Index baru: [field di tabel apa untuk query apa]
- Migration file: [nama file yang akan dibuat]

### File yang Akan Dibuat dan Dimodifikasi
| Aksi       | File                           | Keterangan              |
|------------|--------------------------------|-------------------------|
| Baru       | src/controllers/XController.js | Handler HTTP            |
| Baru       | src/services/XService.js       | Logika bisnis           |
| Baru       | src/repositories/XRepository.js| Akses database          |
| Modifikasi | src/routes/index.js            | Tambah route baru       |
| Baru       | tests/X.test.js                | Unit dan integration test|
| Baru       | migrations/[timestamp]_X.js   | Database migration      |

### Risiko dan Catatan
- [Ada breaking change? Jika ya, bagaimana versioning-nya?]
- [Ada dependensi ke service eksternal?]
- [Ada dampak ke fitur lain yang sudah ada?]

Konfirmasi rencana ini sebelum saya mulai implementasi?
```

### STEP 4 — CONFIRM
TUNGGU konfirmasi eksplisit dari developer sebelum menulis satu baris kode.
Jika ada feedback pada rencana, update Feature Plan dan minta konfirmasi ulang.

### STEP 5 — IMPLEMENT
Bangun fitur mengikuti urutan layer dari dalam ke luar:

```
Urutan implementasi:
1. Migration file       — buat file, JANGAN jalankan
2. Model atau Entity    — representasi data
3. Repository           — akses database saja
4. Service              — logika bisnis + unit test service
5. DTO atau Validator   — validasi dan transformasi input
6. Controller           — handler HTTP request dan response
7. Route                — daftarkan endpoint
8. Integration test     — test endpoint secara end-to-end
```

Untuk setiap file:
- Tampilkan kode lengkap sebelum menulis ke disk
- Tunggu konfirmasi jika file yang dimodifikasi sudah ada dan kompleks
- Tulis unit test bersamaan dengan implementasinya, bukan setelah semua selesai

### STEP 6 — SELF-REVIEW
Sebelum menyerahkan ke developer, jalankan checklist ini:
- [ ] Semua acceptance criteria dari STEP 1 terpenuhi
- [ ] Validasi input ada di layer paling awal (DTO atau middleware)
- [ ] Error handling ada di setiap layer, tidak ada unhandled exception
- [ ] Tidak ada logika bisnis di controller
- [ ] Semua test passing
- [ ] Tidak ada console.log atau debug statement tertinggal
- [ ] Tidak ada hardcoded value yang seharusnya jadi konstanta atau env var
- [ ] Backward compatibility terjaga atau versioning sudah direncanakan

### STEP 7 — HANDOFF
Tulis ringkasan akhir untuk developer:

```
## Fitur Selesai — [Nama Fitur]

### Yang Sudah Dibuat
[Daftar file yang dibuat dan dimodifikasi]

### Yang Perlu Developer Lakukan
1. Review migration file sebelum dijalankan: [nama file]
2. Jalankan migration: npm run migrate atau python manage.py migrate
3. Update .env.example jika ada environment variable baru
4. Test manual endpoint: [contoh curl atau request]

### Saran Commit Message
feat(scope): deskripsi singkat dalam bahasa Inggris

### Catatan untuk PR Description
[Ringkasan perubahan, cara test, dan hal yang perlu diperhatikan reviewer]
```

---

## Aturan Tambahan

- JANGAN mulai implementasi sebelum Feature Plan dikonfirmasi developer
- JANGAN gabungkan implementasi fitur baru dengan refactoring kode lama dalam satu langkah
- JANGAN jalankan migration database — hanya buat file-nya, eksekusi oleh developer
- JANGAN ubah endpoint yang sudah ada jika bisa membuat endpoint baru untuk hindari breaking change
- Jika fitur ternyata lebih besar dari perkiraan, pecah menjadi increment lebih kecil
- Jika menemukan bug di kode lama saat implementasi, laporkan secara terpisah dan jangan fix diam-diam
