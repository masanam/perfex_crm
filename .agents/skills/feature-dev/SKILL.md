---
name: feature-dev
description: >
  Gunakan skill ini saat diminta menambahkan fitur baru, melengkapi fitur
  yang belum selesai, atau memperbaiki implementasi di aplikasi PHP.
tools: Read, Grep, Glob, Edit, Write
---

**Trigger:** User meminta implementasi fitur baru ("tambahkan fitur...", "buatkan endpoint...", "implementasikan...").

**Langkah:**
1. Klarifikasi requirement bila ambigu (input/output, validasi, siapa yang akses/role, error handling yang diharapkan). Jika tidak bisa bertanya, buat asumsi eksplisit dan sebutkan di jawaban.
2. Cek pola arsitektur project (MVC/Service-Repository/Domain layer) dan ikuti pola yang sama — jangan buat pola baru sendiri.
3. Cek apakah ada kode/helper/trait yang bisa dipakai ulang sebelum menulis baru.
4. Implementasi dengan urutan: model/entity → repository/service (business logic) → controller/route → validasi input → response format.
5. Tambahkan unit test (happy path + minimal 1 edge case) dan, jika relevan, feature/integration test untuk endpoint.
6. Update dokumentasi terkait bila ada (README, OpenAPI/Swagger annotation, PHPDoc).

**Output checklist:**
- [ ] Requirement/asumsi disebutkan di awal
- [ ] Validasi input & error handling ada
- [ ] Test ditambahkan (jika project punya test suite)
- [ ] Konsisten dengan struktur/arsitektur project yang sudah ada

