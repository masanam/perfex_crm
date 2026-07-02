---
description: Rancang dan implementasikan fitur API baru dengan pendekatan API-first
---

# /feature — Feature Development Workflow

Gunakan skill feature-dev untuk membangun fitur baru: $ARGUMENTS

## Instruksi untuk Agent

1. Aktifkan skill dari agents/skills/feature-dev/SKILL.md
2. Jika requirement belum lengkap, ajukan pertanyaan klarifikasi terlebih dahulu
3. Ikuti alur 7 langkah: CLARIFY > EXPLORE > DESIGN > CONFIRM > IMPLEMENT > SELF-REVIEW > HANDOFF
4. WAJIB presentasikan Feature Plan lengkap dan tunggu persetujuan sebelum mulai koding
5. Implementasi dari layer dalam ke luar: migration > model > repository > service > controller > route
6. Tulis unit test bersamaan dengan setiap komponen yang diimplementasikan

## Contoh Penggunaan

```
/feature tambahkan endpoint untuk upload foto profil user
/feature buat fitur reset password via email
/feature implementasikan pagination di endpoint GET /products
/feature tambahkan rate limiting di endpoint login
```
