<?php
session_start();
require_once 'koneksi.php';

/* ── Tolak akses langsung (GET) ───────────────────── */
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['daftar'])) {
    header('Location: daftar.php');
    exit;
}

/* ── Ambil & sanitasi input ───────────────────────── */
$username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
$email    = mysqli_real_escape_string($koneksi, trim($_POST['email']));
$noHp     = mysqli_real_escape_string($koneksi, trim($_POST['noHp']));
$tglLahir = mysqli_real_escape_string($koneksi, trim($_POST['tglLahir']));
$password = mysqli_real_escape_string($koneksi, trim($_POST['password']));

/* ── Validasi kosong ──────────────────────────────── */
if ($username === '' || $email === '' || $password === '') {
    header('Location: daftar.php?pesan=kosong');
    exit;
}

/* ── Cek duplikat username / email ────────────────── */
$cek = mysqli_query($koneksi,
    "SELECT idUser FROM users
        WHERE username='$username' OR email='$email' LIMIT 1");

if (mysqli_num_rows($cek) > 0) {
    header('Location: daftar.php?pesan=terpakai');
    exit;
}

/* ── Simpan ke DB ─────────────────────────────────── */
$sql = "INSERT INTO users
        (username, email, noHp, tglLahir, password, level)
        VALUES
        ('$username', '$email', '$noHp', '$tglLahir', '$password', 'User')";

if (mysqli_query($koneksi, $sql)) {
    header('Location: login.php?pesan=daftar_sukses');
} else {
    header('Location: daftar.php?pesan=gagal');
}
exit;
?>