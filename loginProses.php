<?php
session_start();
include 'koneksi.php';

if (isset($_POST['masuk'])) {

    /* Ambil data form */
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    /* Validasi kosong */
    if ($username === '' || $password === '') {
        header('Location: index.php?pesan=kosong');
        exit;
    }

    /* ----- Query: ambil level juga ----- */
    $sql = "SELECT username, level
            FROM users
            WHERE username = '$username'
            AND password = '$password'
            LIMIT 1";

    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['idUser'] = $row['idUser']; // <-- WAJIB ADA
$_SESSION['username'] = $row['username'];
$_SESSION['level'] = $row['level'];



        /* ⇢ Selalu ke file yang sama */
        header('Location: indexAdminPengguna.php');
        exit;

    } else {
        header('Location: login.php?pesan=gagal');
        exit;
    }

} else {
    /* Akses langsung → balik ke form */
    header('Location: index.php');
    exit;
}
?>