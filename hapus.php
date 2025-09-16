<?php
session_start();
require_once 'koneksi.php';

/* hanya admin yang boleh */
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header('Location: login.php?pesan=akses_ditolak'); exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: produk.php?pesan=idkosong'); exit;
}

/* eksekusi hapus */
$sql = "DELETE FROM produk WHERE idProduk = $id LIMIT 1";
if (mysqli_query($koneksi, $sql)) {
    header('Location: produk.php?pesan=hapus_sukses');
} else {
    header('Location: produk.php?pesan=hapus_gagal');
}
exit;
?>
