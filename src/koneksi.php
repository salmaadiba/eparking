<?php
$koneksi = new mysqli("db", "root", "root", "eparking_db");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>