<?php
session_start();
include 'src/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['level'] !== 'admin') {
  header("Location: login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['hapus_id'])) {
  $ids = array_map('intval', $_POST['hapus_id']);
  $id_list = implode(',', $ids);

  $koneksi->query("DELETE FROM parkir WHERE id IN ($id_list)");
}

header("Location: daftar_parkir.php");
exit;
?>
