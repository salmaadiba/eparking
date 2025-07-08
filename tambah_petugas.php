<?php
// File: tambah_petugas.php
session_start();
include 'src/koneksi.php';
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Cek username unik
    $cek = $koneksi->prepare("SELECT id FROM admin WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        $error = "Username sudah terdaftar.";
    } else {
        $stmt = $koneksi->prepare("INSERT INTO admin (username, password, level) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $level);

        if ($stmt->execute()) {
            $sukses = "Petugas berhasil ditambahkan.";
        } else {
            $error = "Gagal menambahkan petugas.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Petugas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <h4 class="mb-4">Tambah Petugas</h4>
    <?php if (!empty($sukses)) echo "<div class='alert alert-success'>$sukses</div>"; ?>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Level</label>
        <select name="level" class="form-control">
          <option value="petugas">Petugas</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <button class="btn btn-success">Simpan</button>
      <a href="admin_petugas.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</body>
</html>
