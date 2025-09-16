<?php
session_start();
require_once 'koneksi.php';

/* ── Hanya Admin ── */
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header('Location: login.php?pesan=akses_ditolak');
    exit;
}

/* ── Pastikan idUser tersedia di session ── */
$idUser = $_SESSION['idUser'] ?? 0;
if ($idUser == 0) {
    /* ambil idUser berdasarkan username yg login */
    $get = $koneksi->prepare("SELECT idUser FROM users WHERE username=? LIMIT 1");
    $get->bind_param("s", $_SESSION['username']);
    $get->execute();
    $get->bind_result($tmpId);
    if ($get->fetch()) {
        $idUser = $tmpId;
        $_SESSION['idUser'] = $idUser;           // simpan ke session utk next request
    } else {
        die("User tidak valid, silakan login ulang.");
    }
    $get->close();
}

/* ── Proses simpan ── */
if (isset($_POST['tambah'])) {

    /* Ambil & sanitasi input */
    $namaBarang  = trim($_POST['namaBarang']);
    $stokBarang  = (int)$_POST['stokBarang'];
    $harga       = (int)str_replace(['.',','],'', $_POST['harga']); // rupiah → int
    $tglTambah   = $_POST['tglTambah'];                              // YYYY‑MM‑DD
    $idKategori  = (int)$_POST['idKategori'];
    $deskripsi   = trim($_POST['deskripsi']);

    /* Prepared‑statement */
    $stmt = $koneksi->prepare(
      "INSERT INTO produk
       (namaBarang, stokBarang, harga, tglTambah, idKategori, deskripsi, idUser)
       VALUES (?,?,?,?,?,?,?)"
    );
    /* tipe: s i i s i s i */
    $stmt->bind_param(
       "siisisi",
       $namaBarang,
       $stokBarang,
       $harga,
       $tglTambah,
       $idKategori,
       $deskripsi,
       $idUser
    );

    if ($stmt->execute()) {
        header('Location: produk.php?pesan=tambah_sukses');
    } else {
        header('Location: tambahproduk.php?pesan=tambah_gagal&err='.
               urlencode($stmt->error));
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Produk - Zie Printing</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="image/zie_nobg.png" type="image/x-icon" />
  <style>
    .btn-logout{background:#fa2727;color:#fff;border:none;border-radius:6px;padding:15px 18px;font-size:large;cursor:pointer}
    .btn-logout:hover{opacity:.85}
  </style>
</head>

<body>
  <nav>
    <ul>
      <li class="nav-right">
        <a href="indexAdminPengguna.php">Beranda</a>
        <a href="produk.php">Produk</a>
        <?php if ($_SESSION['level'] === 'admin'): ?>
          <a href="tambahproduk.php" class="active">Tambah Produk</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['username'])): ?>
          <form action="logout.php" method="post" style="display:inline;">
            <button type="submit" name="keluar" class="btn-logout">Keluar</button>
          </form>
        <?php else: ?>
          <a href="login.php" class="dl">Masuk</a>
        <?php endif; ?>
      </li>
    </ul>
  </nav>

  <main>
    <div class="selamatDatang">
      <div class="content">
        <h1>Tambah Produk</h1>
        <p>Scroll ke bawah untuk menambahkan produk!</p>
      </div>
    </div>

    <form action="" class="mainformproduk" method="post">
      <div class="formproduk">
        <table>
          <tr>
            <td>Nama Barang</td><td>:</td>
            <td><input type="text" name="namaBarang" placeholder="Masukkan Nama Barang" required /></td>
          </tr>
          <tr>
            <td>Stok Barang</td><td>:</td>
            <td><input type="number" name="stokBarang" min="0" placeholder="Masukkan Stok Barang" required /></td>
          </tr>
          <tr>
            <td>Kategori</td><td>:</td>
            <td>
              <select name="idKategori" id="kategori" required>
  <option value="">-Pilih Kategori-</option>
  <option value="1001">Alat Kantor</option>
  <option value="1004">Buku Cetak</option>
  <option value="1005">Brosur</option>
  <option value="1006">Undangan</option>
  <option value="1007">Spanduk</option>
  <option value="1008">Stiker</option>
  <option value="1009">Kalender</option>
  <option value="1010">Kartu Nama</option>
</select>

            </td>
          </tr>
          <tr>
            <td>Harga (Rupiah)</td><td>:</td>
            <td><input type="number" name="harga" min="0" step="100" placeholder="Masukkan Harga" required /></td>
          </tr>
          <tr>
            <td>Tanggal Tambah</td><td>:</td>
            <td><input type="date" name="tglTambah" value="<?= date('Y-m-d') ?>" required /></td>
          </tr>
          <tr>
            <td>Deskripsi</td><td>:</td>
            <td><textarea name="deskripsi" rows="4" style="height:100px"></textarea></td>
          </tr>
          <tr>
            <td colspan="3">
              <input type="submit" value="Tambah" name="tambah" class="btn1" />
              <input type="reset"  value="Batal" class="btn2" />
            </td>
          </tr>
        </table>
      </div>
      <div class="ilusproduk">
        <img src="image/gambar1.png" alt="gambar" />
      </div>
    </form>
  </main>

  <footer>
    <p>&copy; Zie Printing. All Rights Reserved.</p>
  </footer>
</body>
</html>
