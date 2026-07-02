---
name: refactor
description: >
  Refactor kode untuk meningkatkan struktur dan keterbacaan tanpa mengubah
  perilaku. Gunakan saat diminta refactor, clean up, atau improve fungsi/file.
tools: Read, Grep, Glob, Edit, Write
---

**Trigger:** User meminta refactor, improve, clean up, atau restrukturisasi kode PHP.

**Prinsip Utama:**
- **Preserve behavior** — perilaku kode tidak boleh berubah (kecuali disetujui eksplisit)
- **Incremental changes** — pecah refactor kompleks menjadi langkah-langkah kecil
- **Test coverage first** — ingatkan jika tidak ada test, dan buat test dasar jika perlu sebelum refactor besar
- **Don’t fix unrelated issues** — fokus hanya pada apa yang diminta; laporkan temuan lain secara terpisah

**Langkah-langkah:**
1. **Analysis (Read-only)**
   - Baca kode target + semua caller, dependency, dan test terkait
   - Identifikasi bottleneck, complexity, duplikasi, atau maintainability issues
2. **Planning**
   - Buat tabel: Perubahan | Alasan | Dampak | Risiko
   - Sertakan contoh kode sebelum & sesudah
   - Presentasikan rencana ke user, TUNGGU KONFIRMASI
3. **Execution (Step-by-step)**
   - Lakukan perubahan bertahap, tampilkan diff
   - Setelah setiap langkah, validasi: `composer validate` + lint + test relevan
4. **Verification**
   - Pastikan perilaku fungsional tetap sama (happy path + edge cases)
   - Bandingkan output/behavior dengan kondisi sebelum refactor
   - Laporkan hasil dan konfirmasi ke user

**Output Checklist:**
- [ ] Rencana refactor didokumentasikan
- [ ] Perubahan dipecah menjadi langkah kecil
- [ ] Setiap langkah diverifikasi dengan test/lint
- [ ] Perilaku tidak berubah (bukti bisa ditunjukkan)
- [ ] Ada dokumentasi singkat perubahan jika mengubah public API

---

## Alur Refactoring

1. **Understand** — Baca kode target + semua caller-nya
2. **Plan** — Buat tabel: Perubahan | Alasan
3. **Confirm** — Presentasikan rencana, TUNGGU konfirmasi
4. **Execute** — Lakukan perubahan bertahap, tampilkan diff
5. **Verify** — Pastikan perilaku tidak berubah

## Batasan
- STOP jika menemukan bug — laporkan dulu
- Ingatkan jika tidak ada test coverage
- Jangan gabungkan refactor + bug fix dalam satu langkah