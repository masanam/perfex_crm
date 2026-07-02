---
trigger: always_on
---

## Standar Kode API

### REST API Design
```
✅ GET    /users/{id}           — baca resource tunggal
✅ POST   /users                — buat resource baru
✅ PUT    /users/{id}           — replace resource penuh
✅ PATCH  /users/{id}           — update parsial
✅ DELETE /users/{id}           — hapus resource

❌ GET    /getUser              — jangan gunakan verb di URL
❌ POST   /users/delete/{id}    — jangan campur method dengan aksi
```

### Naming Conventions
| Konteks       | Style         | Contoh                        |
|---------------|---------------|-------------------------------|
| URL/endpoint  | kebab-case    | `/user-profiles/{id}`         |
| JSON key      | camelCase     | `{ "userId": 1 }`             |
| Konstanta     | UPPER_SNAKE   | `MAX_RETRY_COUNT = 3`         |
| Fungsi        | camelCase     | `getUserById()`               |
| Class         | PascalCase    | `UserService`                 |
| Database col  | snake_case    | `created_at`                  |

### HTTP Status Code
```
200 OK              — sukses GET/PUT/PATCH
201 Created         — sukses POST (buat resource)
204 No Content      — sukses DELETE
400 Bad Request     — input tidak valid
401 Unauthorized    — tidak ada/invalid token
403 Forbidden       — token valid, tapi tidak punya izin
404 Not Found       — resource tidak ditemukan
409 Conflict        — konflik data (duplikat, dll)
422 Unprocessable   — validasi gagal (lebih spesifik dari 400)
429 Too Many Req    — rate limit tercapai
500 Internal Error  — kesalahan server (jangan expose detail)
```

---

## Checklist Code Review

Gunakan label berikut saat memberikan feedback:

- 🚨 **[BLOCKER]** — wajib diperbaiki sebelum merge (security hole, data loss risk, logic error fatal)
- ⚠️ **[MAJOR]** — sangat disarankan diperbaiki (performa buruk, pattern berbahaya, tidak ada error handling)
- 💡 **[MINOR]** — saran peningkatan (readability, naming, duplikasi kecil)
- 🔍 **[NITPICK]** — preferensi gaya, bisa diabaikan (formatting, komentar opsional)
- ✅ **[PRAISE]** — kode yang baik dan patut dipertahankan

### Area yang Selalu Diperiksa

#### 1. Keamanan (Security)
- [ ] Input validation & sanitization
- [ ] SQL injection / NoSQL injection
- [ ] Autentikasi & otorisasi di setiap endpoint
- [ ] Sensitive data tidak di-log atau di-expose di response
- [ ] Secret/credential tidak hardcoded
- [ ] Rate limiting ada di endpoint publik

#### 2. Error Handling
- [ ] Semua error ditangkap (tidak ada unhandled exception)
- [ ] Pesan error tidak mengekspos stack trace ke client
- [ ] Error response konsisten formatnya
- [ ] Logging error yang cukup untuk debugging

#### 3. Performa
- [ ] Tidak ada N+1 query
- [ ] Index database digunakan dengan benar
- [ ] Pagination ada di endpoint yang mengembalikan list
- [ ] Tidak ada operasi berat di dalam loop
- [ ] Caching digunakan di mana relevan

#### 4. Kualitas Kode
- [ ] Fungsi melakukan satu hal (Single Responsibility)
- [ ] Tidak ada duplikasi logika (DRY)
- [ ] Nama variabel/fungsi deskriptif dan tidak ambigu
- [ ] Magic number/string diganti dengan konstanta bernama
- [ ] Komentar menjelaskan *mengapa*, bukan *apa*

#### 5. API Contract
- [ ] Request/response schema terdokumentasi
- [ ] Backward compatibility terjaga (tidak breaking change tanpa versioning)
- [ ] Konsistensi format response di seluruh endpoint

---

## Format Output Review

Saat melakukan code review, gunakan format berikut:

```
## Code Review — [Nama File / Fitur]

### Ringkasan
[1-3 kalimat tentang kondisi keseluruhan kode]

### Temuan

#### 🚨 [BLOCKER] Judul Masalah
**Lokasi:** `file.js:42` atau `UserController.getUser()`
**Masalah:** Penjelasan mengapa ini bermasalah.
**Dampak:** Apa yang bisa terjadi jika tidak diperbaiki.
**Saran:**
\`\`\`javascript
// Perbaikan yang disarankan
\`\`\`

#### ⚠️ [MAJOR] Judul Masalah
...

### ✅ Yang Sudah Baik
- [Sebutkan aspek positif spesifik]

### Rekomendasi Prioritas
1. Perbaiki [BLOCKER] terlebih dahulu
2. Lanjut ke [MAJOR]
3. [MINOR] dan [NITPICK] bisa dikerjakan iterasi berikutnya
```

---

## Format Output Refactoring

Saat melakukan refactoring, gunakan format berikut:

```
## Refactoring — [Nama File / Fungsi]

### Apa yang Diubah & Mengapa

| # | Perubahan | Alasan |
|---|-----------|--------|
| 1 | Ekstrak fungsi `validateInput()` | Mengurangi panjang fungsi utama, meningkatkan testability |
| 2 | Ganti callback dengan async/await | Keterbacaan dan error handling lebih bersih |
| 3 | ... | ... |

### Kode Sebelum
\`\`\`javascript
// kode asli
\`\`\`

### Kode Sesudah
\`\`\`javascript
// kode hasil refactor
\`\`\`

### Catatan Penting
- [Apakah ada perilaku yang berubah secara subtle?]
- [Test mana yang perlu diperbarui?]
- [Dependensi yang terpengaruh?]
```

---

## Pola Refactoring Umum

### 1. Extract Function
Jika fungsi > 20-30 baris atau melakukan lebih dari satu hal → ekstrak ke fungsi terpisah.

### 2. Replace Magic Number
```javascript
// ❌ Sebelum
if (status === 3) { ... }

// ✅ Sesudah
const ORDER_STATUS_CANCELLED = 3;
if (status === ORDER_STATUS_CANCELLED) { ... }
```

### 3. Early Return (Guard Clause)
```javascript
// ❌ Sebelum (deeply nested)
function processUser(user) {
  if (user) {
    if (user.isActive) {
      if (user.hasPermission) {
        // logic utama
      }
    }
  }
}

// ✅ Sesudah
function processUser(user) {
  if (!user) return;
  if (!user.isActive) return;
  if (!user.hasPermission) return;
  // logic utama
}
```

### 4. Consistent Error Response
```javascript
// ✅ Format response error yang konsisten
{
  "success": false,
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Email tidak valid",
    "details": [{ "field": "email", "message": "Format email salah" }]
  }
}
```

---
