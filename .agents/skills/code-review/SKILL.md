---
name: code-review
description: >
  Review kode untuk security, performance, error handling, dan kualitas.
  Gunakan saat diminta review file, fungsi, atau PR.
  Aktifkan secara proaktif sebelum merge yang menyentuh auth atau payment.
tools: Read, Grep, Glob
---

**Trigger:** User meminta review PR, diff, atau file PHP tertentu ("review kode ini", "cek PR #...", "ada bug tidak di file ini").

**Langkah:**
1. Identifikasi scope perubahan (file, function, class yang terdampak).
2. Baca konteks sekitar (caller, dependency, test yang ada).
3. Periksa 6 dimensi berikut:
   - **Correctness** — logic benar, edge case tertangani (null, empty array, tipe data tak terduga).
   - **Security** — SQL injection, XSS, CSRF, insecure deserialization, path traversal, mass assignment.
   - **Performance** — N+1 query, loop tidak efisien, query tanpa index/limit, memory leak pada loop besar.
   - **Maintainability** — penamaan jelas, function tidak terlalu panjang/kompleks (cyclomatic complexity), DRY.
   - **Konsistensi** — mengikuti coding standard & pola arsitektur project.
   - **Test coverage** — apakah perubahan ini punya test, apakah test lama masih valid.
4. Tulis hasil review dengan label prioritas: 🔴 Blocking / 🟡 Suggestion / 🟢 Nitpick.
5. Untuk tiap temuan, sertakan: lokasi (file:line), penjelasan masalah, dan contoh perbaikan.

**Output checklist:**
- [ ] Semua temuan diberi prioritas
- [ ] Ada contoh kode perbaikan untuk temuan Blocking
- [ ] Disebutkan jika ada test yang perlu ditambahkan
