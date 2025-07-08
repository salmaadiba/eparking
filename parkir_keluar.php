<?php
session_start();
include 'src/koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

date_default_timezone_set('Asia/Jakarta');

$id = $_GET['id'] ?? null;
if (!$id) {
  echo "<div class='alert alert-danger'>ID tidak ditemukan</div>";
  exit;
}

$data = $koneksi->query("SELECT * FROM parkir WHERE id = $id")->fetch_assoc();
if (!$data) {
  echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
  exit;
}

$waktu_keluar = date('Y-m-d H:i:s');
$durasi = ceil((strtotime($waktu_keluar) - strtotime($data['waktu_masuk'])) / 3600);
$durasi = max(1, $durasi);
$petugas = $_SESSION['username'];

$koneksi->query("UPDATE parkir SET 
  waktu_keluar = '$waktu_keluar',
  durasi = $durasi,
  petugas_keluar = '$petugas'
WHERE id = $id");

header("Location: struk.php?id=$id");
exit;
?>