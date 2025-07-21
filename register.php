<?php
session_start();
include 'src/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = $koneksi->prepare("SELECT username FROM admin WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $error = "Username sudah digunakan. Pilih username lain.";
    } else {
        $stmt = $koneksi->prepare("INSERT INTO admin (username, password, level) VALUES (?, ?, 'petugas')");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Gagal register.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register eParking</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h4 class="text-center mb-4">Daftar Petugas</h4>
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button class="btn btn-success w-100" type="submit">Daftar</button>
              <div class="text-center mt-3">
                <a href="login.php">Sudah punya akun? Masuk</a>
              </div>
            </form>
          </div>
        </div>
        <p class="text-center mt-3 text-muted small">© <?= date('Y') ?> eParking</p>
      </div>
    </div>
  </div>
</body>
</html>