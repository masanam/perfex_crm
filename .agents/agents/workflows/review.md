---
description: Jalankan code review lengkap menggunakan standar Senior API Developer
---

# /review — Code Review Workflow

Gunakan skill code-review untuk mereview: $ARGUMENTS

## Instruksi untuk Agent

1. Aktifkan skill dari agents/skills/code-review/SKILL.md
2. Jika tidak ada argumen, tanya: "File atau folder mana yang ingin direview?"
3. Ikuti alur 5 langkah: SCAN > ANALYZE > CLASSIFY > REPORT > WAIT
4. Gunakan label: [BLOCKER] / [MAJOR] / [MINOR] / [NITPICK] / [PRAISE]
5. Setiap temuan WAJIB menyebutkan nama file dan nomor baris yang spesifik
6. Jangan ubah file apapun — skill ini berjalan read-only sepenuhnya

## Contoh Penggunaan

```
/review src/controllers/UserController.js
/review src/services/
/review src/api/routes/payment.js
```
