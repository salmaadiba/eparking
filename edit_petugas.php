<?php
// File: edit_petugas.php
session_start();
include 'src/koneksi.php';
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$stmt = $koneksi->prepare("SELECT * FROM admin WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$petugas = $result->fetch_assoc();

if (!$petugas) {
    echo "<div class='alert alert-danger'>Petugas tidak ditemukan</div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $level = $_POST['level'];

    $update = $koneksi->prepare("UPDATE admin SET username=?, level=? WHERE id=?");
    $update->bind_param("ssi", $username, $level, $id);
    if ($update->execute()) {
        $sukses = "Petugas berhasil diupdate.";
    } else {
        $error = "Gagal mengupdate petugas.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Petugas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <h4 class="mb-4">Edit Petugas</h4>
    <?php if (!empty($sukses)) echo "<div class='alert alert-success'>$sukses</div>"; ?>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?= $petugas['username'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Level</label>
        <select name="level" class="form-control">
          <option value="petugas" <?= $petugas['level'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
          <option value="admin" <?= $petugas['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
      </div>
      <button class="btn btn-primary">Simpan Perubahan</button>
      <a href="admin_petugas.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</body>
</html>
