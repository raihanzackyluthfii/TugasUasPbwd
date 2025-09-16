<?php
session_start();
require_once 'koneksi.php';

/* ── Hanya admin ── */
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header('Location: login.php?pesan=akses_ditolak'); exit;
}

/* ── Validasi ID produk ── */
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { header('Location: produk.php?pesan=idkosong'); exit; }

/* ── DATA KATEGORI (static atau bisa di‑query) ── */
$kategoriList = [
  1001 => 'Alat Kantor',
  1004 => 'Buku Cetak',
  1005 => 'Brosur',
  1006 => 'Undangan',
  1007 => 'Spanduk',
  1008 => 'Stiker',
  1009 => 'Kalender',
  1010 => 'Kartu Nama',
];

/* ========== JIKA TOMBOL SIMPAN ========== */
if (isset($_POST['simpan'])) {
    $namaBarang   = mysqli_real_escape_string($koneksi, $_POST['namaBarang']);
    $stokBarang   = (int)$_POST['stokBarang'];
    $harga        = (float)$_POST['harga'];
    $idKategori   = (int)$_POST['idKategori'];
    $deskripsi    = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $sql = "UPDATE produk SET
              namaBarang  = '$namaBarang',
              stokBarang  = $stokBarang,
              harga       = $harga,
              idKategori  = $idKategori,
              deskripsi   = '$deskripsi'
            WHERE idProduk = $id LIMIT 1";

    if (mysqli_query($koneksi, $sql)) {
        header('Location: produk.php?pesan=update_sukses'); exit;
    } else {
        echo 'Gagal update: '.mysqli_error($koneksi); exit;
    }
}

/* ========== AMBIL DATA PRODUK ========== */
$res = mysqli_query(
    $koneksi,
    "SELECT p.idProduk, p.namaBarang, p.stokBarang, p.harga,
            p.idKategori, k.namaKategori, p.deskripsi
     FROM   produk   p
     JOIN   kategori k ON k.idKategori = p.idKategori
     WHERE  p.idProduk = $id
     LIMIT  1"
);
if (!mysqli_num_rows($res)) { echo 'Produk tidak ditemukan'; exit; }
$p = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk - Zie Printing</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="image/zie_nobg.png" type="image/x-icon">
</head>
<body>
  <nav>
    <ul>
      <li class="nav-left">
        <a href="#"><img src="image/zie_nobg.png" alt="ZIE PRINTING"></a>
      </li>
      <li class="nav-right">
        <a href="indexAdminPengguna.php">Beranda</a>
        <a href="produk.php">Produk</a>
        <a href="tambahproduk.php">Tambah Produk</a>
        <a href="login.php" class="dl">Masuk</a>
      </li>
    </ul>
  </nav>

  <main>
    <div class="selamatDatang">
      <div class="content"><h1>EDIT PRODUK</h1></div>
    </div>

    <form class="mainformproduk" method="post">
      <div class="formproduk">
        <table>
          <tr>
            <td>Nama Barang</td>
            <td><input type="text" name="namaBarang"
                       value="<?= htmlspecialchars($p['namaBarang']) ?>" required></td>
          </tr>
          <tr>
            <td>Stok</td>
            <td><input type="number" name="stokBarang"
                       value="<?= $p['stokBarang'] ?>" required></td>
          </tr>
          <tr>
            <td>Harga (Rp)</td>
            <td><input type="number" name="harga" step="0.01"
                       value="<?= $p['harga'] ?>" required></td>
          </tr>
          <tr>
            <td>Kategori</td>
            <td>
              <select name="idKategori" required>
                <option value="">-Pilih Kategori-</option>
                <?php foreach ($kategoriList as $kid => $knama): ?>
                  <option value="<?= $kid ?>"
                    <?= $kid == $p['idKategori'] ? 'selected' : '' ?>>
                    <?= $knama ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>Deskripsi</td>
            <td><textarea name="deskripsi" rows="4"
                  style="width:250px"><?= htmlspecialchars($p['deskripsi']) ?></textarea></td>
          </tr>
          <tr>
            <td>
              <input type="submit" name="simpan" value="Edit" class="btn1">
              <a href="produk.php" class="btn2" style="text-decoration:none;">Batal</a>
            </td>
          </tr>
        </table>
      </div>
    </form>
  </main>

  <footer>
    <p>&copy; Zie Printing. All Rights Reserved.</p>
  </footer>
</body>
</html>
