<?php
session_start();
include 'src/koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

date_default_timezone_set('Asia/Jakarta');  // Waktu Indonesia

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $plat = $_POST['plat_nomor'];
  $jenis = $_POST['jenis_kendaraan'];
  $petugas = $_SESSION['username'];

  $waktu_masuk = date('Y-m-d H:i:s');  // Ambil waktu sekarang dari PHP

  $stmt = $koneksi->prepare("INSERT INTO parkir (plat_nomor, jenis_kendaraan, waktu_masuk, petugas_masuk) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $plat, $jenis, $waktu_masuk, $petugas);
  $stmt->execute();

  header("Location: daftar_parkir.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parkir Masuk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h3 class="mb-4">Form Parkir Masuk</h3>
  <form method="post" class="bg-white p-4 rounded shadow-sm">
    <div class="mb-3">
      <label for="plat_nomor" class="form-label">Plat Nomor</label>
      <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
      <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select" required>
        <option value="">-- Pilih --</option>
        <option value="Motor">Motor</option>
        <option value="Mobil">Mobil</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>