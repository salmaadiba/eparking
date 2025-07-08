<?php
session_start();
include 'src/koneksi.php';

// Cek login dan level admin
if (!isset($_SESSION['login']) || $_SESSION['level'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil ID petugas
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Cek ID valid
if ($id <= 0) {
    header("Location: admin_petugas.php?msg=invalid_id");
    exit;
}

// Set password default
$password_default = '12345';

// Update password di database
$stmt = $koneksi->prepare("UPDATE admin SET password = ? WHERE id = ?");
$stmt->bind_param("si", $password_default, $id);

if ($stmt->execute()) {
    header("Location: admin_petugas.php?msg=reset_success");
    exit;
} else {
    header("Location: admin_petugas.php?msg=reset_failed");
    exit;
}
?>
