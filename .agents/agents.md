# SKILLS.md

Daftar skill/kapabilitas spesifik yang dipakai agent saat menangani task PHP. Setiap skill berisi trigger, langkah kerja, dan checklist keluaran.

---

## Skill 1: PHP Code Review

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

---

## Skill 2: PHP Refactoring

**Trigger:** User meminta "refactor", "sederhanakan", "rapikan", "pisahkan class ini", "hilangkan duplikasi".

**Langkah:**
1. Pastikan behavior saat ini dipahami — jika tidak ada test, tulis test karakterisasi dasar dulu (happy path minimal) sebagai jaring pengaman.
2. Identifikasi code smell: duplicate code, long method, large class, feature envy, deep nesting, primitive obsession.
3. Terapkan refactor pattern yang sesuai, contoh:
   - Extract Method/Class untuk method/class yang terlalu besar.
   - Replace Conditional with Polymorphism untuk banyak `if/switch` berdasarkan tipe.
   - Introduce Parameter Object untuk function dengan banyak parameter.
   - Dependency Injection untuk menghilangkan hard-coded dependency (memudahkan testing).
4. Lakukan perubahan bertahap, jalankan test setelah tiap langkah.
5. Jangan ubah public API/signature yang dipakai luas tanpa memberi tahu dampaknya (breaking change) ke user.

**Output checklist:**
- [ ] Behavior tidak berubah (dibuktikan dengan test yang tetap hijau)
- [ ] Perubahan dijelaskan per langkah, bukan hanya diff akhir
- [ ] Disebutkan risiko/breaking change jika ada

---

## Skill 3: Penambahan Fitur PHP

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

---

## Skill 4: Security Audit Cepat (dipakai lintas skill 1–3)

**Trigger:** Otomatis dijalankan sebagai bagian dari review/refactor/fitur, atau saat user eksplisit minta "cek keamanan".

**Checklist:**
- [ ] Tidak ada raw SQL query dengan string concatenation langsung dari input user
- [ ] Semua output ke HTML di-escape (`htmlspecialchars`/templating engine auto-escape)
- [ ] CSRF token dipakai pada form yang mengubah state
- [ ] Upload file divalidasi tipe MIME asli (bukan hanya ekstensi) & disimpan di luar web root atau dengan nama ter-randomize
- [ ] Password di-hash dengan `password_hash()` (bcrypt/argon2), verifikasi dengan `password_verify()`
- [ ] Tidak ada credential/API key hardcoded di kode
- [ ] Authorization check (bukan hanya authentication) ada di setiap endpoint sensitif

---

## Skill 5: Test Writing Pendukung (PHPUnit/Pest)

**Trigger:** Dipakai otomatis saat Skill 2 & 3 membutuhkan test, atau saat diminta eksplisit "buatkan test untuk...".

**Langkah:**
1. Cek framework test yang dipakai project (PHPUnit murni, Pest, atau test bawaan Laravel/Symfony).
2. Tulis test dengan struktur Arrange-Act-Assert.
3. Cover minimal: 1 happy path, 1 edge case (input kosong/invalid), 1 kondisi error yang diharapkan (exception).
4. Gunakan mock/stub untuk dependency eksternal (DB, HTTP client, filesystem) agar test tetap cepat dan terisolasi.
