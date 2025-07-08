<?php
session_start();
include 'src/koneksi.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baru = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $koneksi->prepare("UPDATE admin SET password=? WHERE username=?");
    $stmt->bind_param("ss", $baru, $username);
    if ($stmt->execute()) {
        $sukses = "Password berhasil diubah.";
    } else {
        $error = "Gagal mengubah password.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <h4 class="mb-4">Ubah Password</h4>
    <?php if (!empty($sukses)): ?><div class="alert alert-success"><?= $sukses ?></div><?php endif; ?>
    <?php if (!empty($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" value="<?= $username ?>" readonly>
      </div>
      <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</body>
</html>