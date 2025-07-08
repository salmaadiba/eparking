<?php
// File: reset_password.php
session_start();
include 'src/koneksi.php';
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$password_default = 'user';
$stmt = $koneksi->prepare("UPDATE admin SET password = ? WHERE id = ?");
$stmt->bind_param("si", $password_default, $id);

if ($stmt->execute()) {
    header("Location: admin_petugas.php?msg=reset");
    exit;
} else {
    echo "<div class='alert alert-danger'>Gagal reset password.</div>";
}
?>
