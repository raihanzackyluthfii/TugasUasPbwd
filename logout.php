<?php
// logout.php
session_start();          // pastikan session aktif

// Hapus semua data session
session_unset();          // kosongkan variabel‑variabel session
session_destroy();        // destroy session di server

// (Opsional) hapus cookie PHPSESSID di browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Arahkan kembali ke halaman login
header('Location: login.php?pesan=logout_sukses');
exit;
?>
