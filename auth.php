<?php
/* auth.php  – proteksi multi‑user */

session_start();

/**
 * Pakai di awal halaman:
 *   require 'auth.php';  // ← otomatis cek login & level
 *
 * $allowed_levels = []  → hanya cek “sudah login” (semua level boleh)
 * $allowed_levels = ['Admin']             → khusus Admin
 * $allowed_levels = ['Admin','User']      → Admin dan User
 */
function require_login(array $allowed_levels = []): void
{
    // wajib login lebih dulu
    if (!isset($_SESSION['username'])) {
        header('Location: index.php?pesan=harus_login');
        exit;
    }

    // jika disetel daftar level, cek keanggotaannya
    if ($allowed_levels && !in_array($_SESSION['level'], $allowed_levels, true)) {
        header('Location: index.php?pesan=akses_ditolak');
        exit;
    }
}
