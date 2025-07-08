CREATE DATABASE IF NOT EXISTS eparking_db;
USE eparking_db;

CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  level ENUM('admin','petugas') DEFAULT 'petugas'
);

-- Menambahkan user 'admin' dengan password 'admin' (MD5 hashed)
INSERT IGNORE INTO admin (username, password, level) VALUES ('admin', 'admin', 'admin');

CREATE TABLE IF NOT EXISTS parkir (
  id INT AUTO_INCREMENT PRIMARY KEY,
  plat_nomor VARCHAR(20),
  jenis_kendaraan VARCHAR(50),
  waktu_masuk DATETIME,
  waktu_keluar DATETIME NULL,
  durasi INT NULL,
  biaya INT NULL,
  petugas_masuk VARCHAR(50),
  petugas_keluar VARCHAR(50)
);