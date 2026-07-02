---
description: Refactor kode yang ada untuk meningkatkan kualitas tanpa mengubah perilaku
---

# /refactor — Refactoring Workflow

Gunakan skill refactor untuk memperbaiki struktur kode: $ARGUMENTS

## Instruksi untuk Agent

1. Aktifkan skill dari agents/skills/refactor/SKILL.md
2. Jika tidak ada argumen, tanya: "File atau fungsi mana yang ingin direfactor?"
3. Ikuti alur 5 langkah: UNDERSTAND > PLAN > EXECUTE > VERIFY > DOCUMENT
4. WAJIB tampilkan rencana perubahan dalam tabel dan tunggu konfirmasi sebelum menulis kode
5. Tampilkan diff sebelum dan sesudah untuk setiap perubahan
6. BERHENTI dan laporkan jika menemukan bug tersembunyi di kode yang sedang direfactor

## Contoh Penggunaan

```
/refactor src/services/OrderService.js
/refactor src/utils/helper.js
/refactor src/controllers/
```
