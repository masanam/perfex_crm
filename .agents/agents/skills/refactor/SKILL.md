---
name: refactor
description: >
  Gunakan skill ini saat diminta memperbaiki struktur, keterbacaan, atau
  kualitas kode yang sudah ada tanpa mengubah perilakunya. Trigger kata kunci:
  refactor, bersihkan kode, kode ini terlalu panjang, improve struktur,
  ada duplikasi, clean up. Selalu presentasikan rencana dan tunggu konfirmasi
  sebelum mengubah file apapun.
tools: Read, Grep, Glob, Edit, Write
---

## Tujuan

Melakukan refactoring kode yang aman, bertahap, dan terdokumentasi dengan baik
tanpa mengubah perilaku atau logika bisnis yang sudah ada.

---

## Alur Eksekusi (5 Langkah)

### STEP 1 — UNDERSTAND
Baca dan pahami kode sepenuhnya sebelum menyentuh apapun.
- Baca file target secara keseluruhan dari awal sampai akhir
- Cari file test yang terkait (*.test.*, *.spec.*) — catat ada atau tidaknya
- Gunakan Grep untuk menemukan semua caller dan consumer dari fungsi target
- Catat semua import dan dependensi yang relevan

Jika tidak ada test coverage: laporkan di rencana dan rekomendasikan tulis test dulu.

### STEP 2 — PLAN
Buat rencana perubahan secara lengkap SEBELUM menulis kode apapun.

Format rencana yang harus ditampilkan:

```
## Rencana Refactoring — [Nama File atau Fungsi]

### Kondisi Saat Ini
[Jelaskan masalah yang ditemukan: terlalu panjang, duplikasi, nested dalam, dll]

### Perubahan yang Direncanakan
| No | Teknik              | Target                    | Alasan                                    |
|----|---------------------|---------------------------|-------------------------------------------|
| 1  | Extract Function    | blok validasi baris 45-67 | terlalu panjang, bisa ditest terpisah     |
| 2  | Guard Clause        | nested if baris 23        | kurangi indentasi, lebih mudah dibaca     |
| 3  | Replace Magic Number| angka 86400 baris 89      | ganti dengan TOKEN_EXPIRY_SECONDS         |

### Risiko
- [apakah ada perilaku yang mungkin berubah secara subtle?]
- [apakah ada test yang perlu diperbarui?]
- [apakah ada caller lain yang terpengaruh?]

### Catatan Test Coverage
[Ada test? Tidak ada? Rekomendasi apa?]

Konfirmasi untuk melanjutkan?
```

### STEP 3 — EXECUTE
Lakukan perubahan satu langkah logis per iterasi sesuai rencana.
- Tampilkan diff yang jelas untuk setiap perubahan
- Jelaskan alasan perubahan saat diterapkan
- Jika menemukan bug tersembunyi: BERHENTI, laporkan, tanya apakah lanjut refactor atau perbaiki bug dulu

### STEP 4 — VERIFY
Setelah semua perubahan selesai:
- Konfirmasi semua caller yang ditemukan di Step 1 masih kompatibel
- Identifikasi test yang perlu diperbarui akibat perubahan signature fungsi
- Sebutkan file lain yang mungkin terpengaruh tapi belum dicek

### STEP 5 — DOCUMENT
Tulis ringkasan akhir:

```
## Refactoring Selesai — [Nama File atau Fungsi]

### Perubahan yang Dilakukan
| No | Perubahan           | File                | Alasan                    |
|----|---------------------|---------------------|---------------------------|
| 1  | Extract validateUser| UserService.js      | SRP, meningkatkan testability |

### Saran Commit Message
refactor(scope): deskripsi singkat dalam bahasa Inggris

### Yang Perlu Diperhatikan
- test mana yang perlu diperbarui
- file lain yang mungkin terpengaruh
```

---

## Aturan Tambahan

- JANGAN gabungkan refactoring dengan bug fix atau penambahan fitur dalam satu langkah
- JANGAN ubah nama fungsi atau method publik tanpa memverifikasi semua consumer ikut diupdate
- JANGAN refactor test file bersamaan dengan source file — lakukan secara terpisah
- Jika diminta refactor tapi ditemukan bug — laporkan bug dulu, tanya prioritasnya
- Gunakan teknik dari tabel "Teknik Refactoring" yang ada di agents/rules/api-standards.md
