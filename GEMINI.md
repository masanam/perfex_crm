# GEMINI.md

> File ini berisi instruksi khusus untuk model Gemini yang berjalan di dalam **Google Antigravity**. Instruksi ini melengkapi (bukan menggantikan) `AGENTS.md`.

## Konteks Eksekusi
- Kamu berjalan di dalam Google Antigravity dengan akses ke: editor, terminal, browser (jika diaktifkan), dan artifact/task manager bawaan Antigravity.
- Manfaatkan **Agent Manager / Task List** Antigravity untuk memecah tugas besar (mis. "refactor module Payment") menjadi sub-task yang bisa dilacak progresnya, bukan mengerjakan semuanya dalam satu langkah besar tanpa checkpoint.
- Gunakan tool `read_file` / `list_directory` / `search` sebelum mengedit — jangan berasumsi isi file dari nama file saja.
- Jika Antigravity menyediakan **browser tool** untuk verifikasi (misal cek dokumentasi resmi PHP/Laravel/Symfony versi terbaru), gunakan itu untuk memverifikasi API yang sudah deprecated atau berubah, terutama untuk hal yang cepat berubah antar versi framework.

## Cara Kerja yang Diharapkan di Antigravity
1. **Plan dulu, baru eksekusi.** Untuk task code review/refactor/fitur yang melibatkan >1 file, tuliskan rencana singkat (artifact/plan) sebelum mulai edit massal.
2. **Verifikasi sebelum klaim selesai.** Setelah edit, jalankan:
   - `composer validate` (jika ada perubahan `composer.json`)
   - Linter/formatter project (`phpcs`, `php-cs-fixer`, `phpstan`/`psalm` jika tersedia)
   - Test suite (`phpunit`/`pest`) relevan dengan file yang diubah
   Laporkan hasilnya secara eksplisit, jangan hanya bilang "sudah selesai" tanpa bukti run.
3. **Gunakan checkpoint/commit granular.** Saran commit message per logical change (lihat konvensi di bawah), bukan satu commit besar untuk semua perubahan tak berkaitan.
4. **Jangan modifikasi file di luar scope task** tanpa menyebutkannya secara eksplisit ke user terlebih dulu.

## Batasan & Kehati-hatian
- Jangan menjalankan perintah destruktif (`rm -rf`, `git reset --hard`, `DROP TABLE`, migration `down` di production config) tanpa konfirmasi eksplisit dari user.
- Jangan mengubah file `.env`, kredensial, atau config production secara langsung — hanya sarankan perubahan dan biarkan user yang menerapkan pada environment sensitif.
- Jika menemukan kredensial/secret ter-hardcode saat review, laporkan sebagai temuan **Blocking (🔴)**, jangan hanya diam-diam menghapusnya.
- Jika task tidak jelas cakupannya (misal "refactor billing module" tapi module besar), ajukan pertanyaan singkat untuk konfirmasi scope, atau buat asumsi eksplisit dan sebutkan di awal.

## Konvensi Commit (disarankan ke user)
Gunakan format Conventional Commits:
```
feat(module): tambah fitur X
fix(module): perbaiki bug Y
refactor(module): sederhanakan logic Z
review: catatan review untuk PR #123
```

## Gaya Komunikasi
- Ringkas, langsung ke poin teknis, dalam Bahasa Indonesia.
- Saat melaporkan hasil review/refactor, gunakan format daftar dengan prioritas (Blocking/Suggestion/Nitpick) sesuai `AGENTS.md`.
- Jika ragu antara dua pendekatan implementasi, tampilkan trade-off singkat, bukan langsung memilih tanpa penjelasan.
