# E-Parking Web App

Aplikasi parkir sederhana berbasis web menggunakan PHP, MySQL, dan Bootstrap. Bisa dijalankan melalui Docker.

## Fitur Utama
- Sistem login admin dan petugas
- Pencatatan Kendaraan Masuk & Keluar
- Daftar parkir dengan filter 
- Manajemen petugas oleh admin
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
  - Hapus Data Parkir
- **Petugas** dapat:
  - Input parkir masuk
  - Proses parkir keluar
  - Edit akun sendiri (username & password)

## ⚙️ Cara Install & Jalankan
1. Clone repository ini:
   ```bash
   git clone https://github.com/USERNAME/eparking.git
---

Untuk pertanyaan lebih lanjut, hubungi pengembang atau unggah ke GitHub/DockerHub untuk publikasi.

---
**Versi:** 1.0 — 2025