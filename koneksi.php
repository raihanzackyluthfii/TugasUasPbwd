<?php
/* -------------------------------------------------------
   koneksi.php   – Koneksi dasar MySQL (tanpa PDO, tanpa OOP)
   ------------------------------------------------------- */

/* Ubah data sesuai server lokal Anda */
$host = 'localhost';   // atau 127.0.0.1
$user = 'root';        // user MySQL
$pass = '';            // password MySQL (kosong di XAMPP bawaan)
$db   = 'zieprinting';  // ganti dengan nama database Anda

/* Buat koneksi */
$koneksi = mysqli_connect($host, $user, $pass, $db);

/* Cek koneksi */
if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

/* Setelah baris ini, variabel $koneksi siap dipakai
   di file lain yang meng‑include koneksi.php */
?>
