<?php
session_start();
include 'src/koneksi.php';
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit;
}
$data = $koneksi->query("SELECT * FROM admin ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Petugas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <h3 class="mb-4">Halaman Admin - Data Petugas</h3>
    <a href="tambah_petugas.php" class="btn btn-success mb-3">+ Tambah Petugas</a>
    <a href="dashboard.php" class="btn btn-secondary mb-3 float-end">Kembali ke Dashboard</a>
    <table class="table table-bordered bg-white">
      <thead><tr><th>ID</th><th>Username</th><th>Level</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php while ($d = $data->fetch_assoc()): ?>
          <tr>
            <td><?= $d['id'] ?></td>
            <td><?= $d['username'] ?></td>
            <td><?= $d['level'] ?></td>
            <td>
              <a href="edit_petugas.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="reset_password.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-info">Reset</a>
              <a href="hapus_petugas.php?id=<?= $d['id'] ?>" onclick="return confirm('Hapus petugas ini?')" class="btn btn-sm btn-danger">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>