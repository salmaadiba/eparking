# E-Parking Web App

Aplikasi parkir sederhana berbasis web menggunakan PHP, MySQL, dan Bootstrap. Bisa dijalankan melalui XAMPP atau Docker.

## Fitur Utama
- Sistem login admin dan petugas
- Dashboard parkir masuk dan keluar
- Daftar parkir dengan filter dan export
- Manajemen petugas oleh admin
- Reset password petugas ke default
- Cetak struk parkir keluar

## Struktur Folder
```
eparking_app/
├── docker-compose.yml
├── Dockerfile
├── eparking_db.sql
├── login.php
├── register.php
├── dashboard.php
├── parkir_masuk.php
├── parkir_keluar.php
├── daftar_parkir.php
├── logout.php
├── struk.php
├── admin_petugas.php
├── tambah_petugas.php
├── edit_petugas.php
├── reset_password.php
├── akun_petugas.php
└── src/
    └── koneksi.php
```

## Cara Menjalankan via XAMPP
1. **Import Database**:
   - Buka phpMyAdmin
   - Buat database: `eparking_db`
   - Import file `eparking_db.sql`

2. **Letakkan file** ke folder `htdocs/eparking`
3. Jalankan Apache & MySQL dari XAMPP
4. Akses aplikasi di browser:
   ```
   http://localhost/eparking/login.php
   ```

## Login Awal
Jika belum ada akun, buat lewat `register.php` atau import user default dari SQL.

## Menjalankan via Docker
### Persiapan
Pastikan sudah install:
- Docker Desktop

### Langkah
1. Jalankan perintah:
   ```bash
   docker-compose up -d
   ```
2. Akses di browser:
   ```
   http://localhost:8080
   ```

## Dockerfile
```Dockerfile
FROM php:8.1-apache
RUN docker-php-ext-install mysqli
COPY . /var/www/html/
EXPOSE 80
```

## docker-compose.yml
```yaml
version: '3.8'
services:
  web:
    build: .
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html
    depends_on:
      - db

  db:
    image: mariadb
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: eparking_db
    ports:
      - "3306:3306"
```

## Panduan Pengguna
- **Admin** dapat:
  - Tambah/Edit/Hapus Petugas
  - Reset Password petugas
- **Petugas** dapat:
  - Input parkir masuk
  - Proses parkir keluar
  - Edit akun sendiri (username & password)

---

Untuk pertanyaan lebih lanjut, hubungi pengembang atau unggah ke GitHub/DockerHub untuk publikasi.

---
**Versi:** 1.0 — 2025
