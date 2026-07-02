# api-standards.md — Standar Kode, Review, dan Checklist
# Lokasi: agents/rules/api-standards.md
# Dibaca Antigravity sebagai workspace rules yang selalu aktif di setiap sesi

---

## Lima Area yang Selalu Diperiksa Saat Review

### 1. Keamanan (Security)
- Input validation dan sanitization ada di setiap endpoint
- SQL injection dan NoSQL injection dicegah dengan parameterized query
- Autentikasi dan otorisasi ada di setiap endpoint yang membutuhkan akses
- Sensitive data (password, token, PII) tidak di-log dan tidak muncul di response
- Secret dan credential tidak hardcoded di source code
- Rate limiting ada di endpoint publik yang bisa disalahgunakan

### 2. Error Handling
- Semua error ditangkap — tidak ada unhandled exception atau unhandled promise rejection
- Pesan error tidak mengekspos stack trace atau detail internal ke client
- Semua endpoint menggunakan format error response yang konsisten
- Logging error di server cukup untuk debugging tanpa informasi sensitif

### 3. Performa
- Tidak ada N+1 query — gunakan eager loading atau join yang tepat
- Index database digunakan dengan benar untuk query yang sering dijalankan
- Endpoint yang mengembalikan list wajib memiliki pagination
- Operasi berat yang bisa diparalelkan tidak dijalankan secara serial
- Caching diterapkan untuk data yang sering diakses dan jarang berubah

### 4. Kualitas Kode
- Setiap fungsi melakukan satu hal (Single Responsibility Principle)
- Tidak ada duplikasi logika yang bisa diekstrak menjadi fungsi atau modul (DRY)
- Nama variabel, fungsi, dan class deskriptif dan tidak ambigu
- Magic number dan magic string diganti dengan konstanta bernama
- Komentar menjelaskan mengapa, bukan apa yang sudah jelas dari kode itu sendiri

### 5. API Contract
- Schema request dan response terdokumentasi di OpenAPI/Swagger
- Tidak ada breaking change tanpa versioning yang jelas
- Format response konsisten di seluruh endpoint (struktur sukses dan error sama)
- HTTP status code yang digunakan sesuai dengan kondisi yang sebenarnya terjadi

---

## Teknik Refactoring yang Digunakan

| Teknik | Kapan Digunakan |
|--------|----------------|
| Extract Function | Fungsi lebih dari 25 baris atau melakukan lebih dari satu hal |
| Replace Magic Number | Literal angka atau string tanpa nama yang jelas |
| Guard Clause | Nested if yang dalam — ganti dengan early return |
| Extract Class | Class memiliki terlalu banyak tanggung jawab |
| Replace Callback | Callback hell — ganti dengan async/await |
| Introduce DTO | Raw request body langsung diproses — bungkus dengan validated object |
| Move Business Logic | Logika bisnis ada di controller — pindahkan ke service layer |

---

## Pola Feature Development yang Diikuti

### Urutan Implementasi yang Aman
```
1. Migration file        — buat file, JANGAN jalankan
2. Model / Entity        — representasi data
3. Repository            — akses database
4. Service               — logika bisnis + unit test
5. DTO / Validator       — validasi dan transformasi input
6. Controller            — handler HTTP request dan response
7. Route                 — daftarkan endpoint
8. Integration test      — test endpoint secara end-to-end
```

### Layer Architecture yang Diikuti
```
Request masuk
    > Router
    > Middleware (auth, rate limit, validate)
    > Controller (handle HTTP saja, delegasi ke service)
    > Service (logika bisnis murni, tidak tahu tentang HTTP)
    > Repository (akses database saja)
    > Database
Response keluar
```

---

## Checklist Sebelum PR

- [ ] Self-review menggunakan 5 area di atas sudah dilakukan
- [ ] Semua unit test dan integration test passing
- [ ] Tidak ada console.log atau debug statement tertinggal
- [ ] Dokumentasi API (OpenAPI spec) sudah diperbarui
- [ ] Commit message mengikuti format Conventional Commits
- [ ] Tidak ada any type yang dibiarkan di TypeScript
- [ ] Tidak ada hardcoded URL production atau staging
- [ ] Tidak ada credential atau secret yang masuk ke source code
