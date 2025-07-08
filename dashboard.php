<?php
session_start();
include 'src/koneksi.php';
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #74ebd5, #acb6e5);
      min-height: 100vh;
    }
    .dashboard-box {
      background: white;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 40px;
      max-width: 900px;
      margin: 50px auto;
    }
    .dashboard-box h2 {
      font-weight: 600;
      margin-bottom: 30px;
    }
    .menu-grid a {
      display: block;
      background-color: #007bff;
      color: white;
      padding: 20px;
      border-radius: 12px;
      text-align: center;
      font-size: 18px;
      font-weight: 500;
      text-decoration: none;
      transition: 0.3s;
    }
    .menu-grid a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="dashboard-box text-center">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-start">Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?></h2>
      <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
    <div class="row g-4 menu-grid">
      <div class="col-md-6">
        <a href="parkir_masuk.php">🚗 Parkir Masuk</a>
      </div>
      <div class="col-md-6">
        <a href="daftar_parkir.php">📋 Daftar Parkir</a>
      </div>
      <?php if ($_SESSION['level'] === 'admin'): ?>
      <div class="col-md-6">
        <a href="admin_petugas.php">👥 Manajemen Petugas</a>
      </div>
      <?php endif; ?>
      <div class="col-md-6">
        <a href="akun_petugas.php">⚙️ Akun Saya</a>
      </div>
    </div>
  </div>
</body>
</html>
