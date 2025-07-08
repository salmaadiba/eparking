<?php
// File: hapus_petugas.php
session_start();
include 'src/koneksi.php';
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;

// Tidak bisa hapus diri sendiri
if ($_SESSION['id'] == $id) {
    echo "<div class='alert alert-danger'>Anda tidak dapat menghapus akun sendiri.</div>";
    exit;
}

$stmt = $koneksi->prepare("DELETE FROM admin WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admin_petugas.php?msg=hapus");
    exit;
} else {
    echo "<div class='alert alert-danger'>Gagal menghapus petugas.</div>";
}
?>
