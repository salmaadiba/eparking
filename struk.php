<?php
session_start();
include 'src/koneksi.php';
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

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
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Struk Parkir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @media print {
      .no-print { display: none; }
    }
  </style>
</head>
<body class="p-4">
  <div class="container border p-4 shadow-sm bg-white">
    <h5 class="text-center mb-4">Struk Parkir</h5>
    <table class="table">
      <tr><th>Plat Nomor</th><td><?= htmlspecialchars($data['plat_nomor']) ?></td></tr>
      <tr><th>Jenis Kendaraan</th><td><?= htmlspecialchars($data['jenis_kendaraan']) ?></td></tr>
      <tr><th>Waktu Masuk</th><td><?= htmlspecialchars($data['waktu_masuk']) ?></td></tr>
      <tr><th>Waktu Keluar</th><td><?= htmlspecialchars($data['waktu_keluar'] ?: '-') ?></td></tr>
      <tr><th>Durasi</th><td><?= htmlspecialchars($data['durasi'] ?? '-') ?> jam</td></tr>
      <tr><th>Petugas</th>
        <td>
          <?php
            if (!empty($data['waktu_keluar'])) {
              echo htmlspecialchars($data['petugas_keluar'] ?? '-');
            } else {
              echo htmlspecialchars($data['petugas_masuk'] ?? '-');
            }
          ?>
        </td>
      </tr>
    </table>

    <div class="text-center mt-3">
      <button onclick="window.print()" class="btn btn-primary no-print">Cetak Struk</button>
      <a href="dashboard.php" class="btn btn-secondary no-print">Kembali</a>
    </div>
  </div>
</body>
</html>