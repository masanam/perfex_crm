---
name: code-review
description: >
  Gunakan skill ini saat diminta melakukan code review pada file, fungsi,
  atau Pull Request. Aktifkan juga secara proaktif sebelum merge ke main
  yang menyentuh autentikasi, payment, atau perubahan API contract.
  Skill ini berjalan read-only dan tidak mengubah file apapun.
tools: Read, Grep, Glob
---

## Tujuan

Menghasilkan laporan code review yang terstruktur, spesifik, dan konstruktif
sesuai standar Senior API Developer yang ada di AGENTS.md.

---

## Alur Eksekusi (5 Langkah)

### STEP 1 — SCAN
Baca semua file yang relevan sebelum membuat penilaian apapun.
- Identifikasi scope: satu fungsi, satu file, atau multi-file?
- Catat semua import dan dependensi eksternal yang digunakan
- Pahami konteks bisnis dari nama fungsi, variabel, dan komentar yang ada
- Jika ada bagian yang tidak dipahami, tandai dengan [?] untuk ditanyakan

### STEP 2 — ANALYZE
Periksa 5 area secara berurutan sesuai api-standards.md:
1. Security — autentikasi, validasi input, injection, data exposure
2. Error Handling — unhandled exception, format response, logging
3. Performance — N+1 query, missing pagination, operasi berat di loop
4. Code Quality — naming, DRY, SRP, magic number, dead code
5. API Contract — schema, status code, konsistensi, backward compat

### STEP 3 — CLASSIFY
Tandai setiap temuan dengan label severity dari AGENTS.md:
- [BLOCKER]  — security hole, data loss risk, logic error fatal
- [MAJOR]    — performa buruk, pattern berbahaya, tidak ada error handling
- [MINOR]    — readability, naming, duplikasi kecil
- [NITPICK]  — preferensi formatting atau gaya
- [PRAISE]   — bagian kode yang sudah baik dan patut dipertahankan

### STEP 4 — REPORT
Tulis laporan dengan format berikut:

```
## Code Review — [Nama File / Fitur]

### Ringkasan
[1-3 kalimat kondisi keseluruhan kode]

### Temuan

#### [BLOCKER] Judul Masalah
Lokasi: namafile.js baris 42
Masalah: penjelasan mengapa ini bermasalah
Dampak: apa yang bisa terjadi jika tidak diperbaiki
Saran:
// contoh kode perbaikan

#### [MAJOR] Judul Masalah
[format sama seperti di atas]

#### [MINOR] Judul Masalah
[format sama seperti di atas]

### Yang Sudah Baik
- aspek positif spesifik 1
- aspek positif spesifik 2

### Prioritas Pengerjaan
1. Selesaikan semua [BLOCKER] sebelum merge
2. Kerjakan [MAJOR] di PR yang sama atau segera setelahnya
3. [MINOR] dan [NITPICK] bisa dikerjakan di iterasi berikutnya
```

### STEP 5 — WAIT
Setelah laporan selesai, tunggu respons developer.
Jangan eksekusi perbaikan apapun tanpa persetujuan eksplisit.

---

## Aturan Tambahan

- Setiap temuan WAJIB menyebutkan nama file dan nomor baris yang spesifik
- Setiap kritik WAJIB disertai saran perbaikan atau contoh kode alternatif
- Jangan skip area review meski kelihatannya sudah oke — tetap periksa semua 5 area
- Minimal satu [PRAISE] per review — tidak ada kode yang 100% buruk
- Jika ada logika bisnis yang tidak dipahami, tanyakan sebelum memberi penilaian
