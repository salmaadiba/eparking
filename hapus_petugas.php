<?php
session_start();
include 'src/koneksi.php';

// Cek login dan level admin
if (!isset($_SESSION['login']) || $_SESSION['level'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Cek apakah ID ada dan valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin_petugas.php?msg=invalid_id");
    exit;
}

$id = (int)$_GET['id'];

// Eksekusi hapus
$stmt = $koneksi->prepare("DELETE FROM admin WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admin_petugas.php?msg=hapus_success");
    exit;
} else {
    header("Location: admin_petugas.php?msg=hapus_failed");
    exit;
}
?>