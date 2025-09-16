<?php
session_start();
require_once 'koneksi.php';

// Cek login
if (!isset($_SESSION['username'])) {
    header('Location: login.php?pesan=harus_login');
    exit;
}

/* ── QUERY BARU: JOIN supaya dapat namaKategori ── */
$sql = "
  SELECT p.idProduk,
         p.namaBarang,
         p.stokBarang,
         p.harga,
         p.tglTambah,
         k.namaKategori,         /* ← ambil nama, bukan id */
         p.deskripsi,
         p.idUser
  FROM   produk   p
  JOIN   kategori k ON k.idKategori = p.idKategori
  ORDER  BY p.idProduk";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk - Zie Printing</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="image/zie_nobg.png" type="image/x-icon">
  <style>
    .btn-logout{background:#fa2727;color:#fff;border:none;border-radius:6px;padding:15px 18px;font-size:large;cursor:pointer}
    .btn-logout:hover{opacity:.85}
    .aksi-wrapper{display:flex;gap:8px;justify-content:center;align-items:center}
    .edit,.hapus{padding:6px 14px;border-radius:5px;font-weight:600;text-decoration:none;font-size:14px}
    .edit{background:#2A61AD;color:#fff}
    .hapus{background:#fa2727;color:#fff}
  </style>
</head>
<body>
  <nav>
    <ul>
      <li class="nav-right">
        <a href="indexAdminPengguna.php">Beranda</a>
        <a href="produk.php" class="active">Produk</a>
        <?php if (isset($_SESSION['level']) && $_SESSION['level']==='admin'): ?>
          <a href="tambahproduk.php">Tambah Produk</a>
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

  <main class="daftarproduk">
    <div class="selamatDatang">
      <div class="content">
        <h1>Daftar Produk</h1>
        <p>Produk kami 100% original dan berkualitas bagus</p>
      </div>
    </div>

    <div class="daftarproduk">
      <?php if (mysqli_num_rows($result) === 0): ?>
        <p style="text-align:center"><em>Belum ada produk.</em></p>
      <?php else: ?>
        <table>
          <tr class="head">
            <td>ID</td>
            <td>Nama Barang</td>
            <td>Stok</td>
            <td>Harga</td>
            <td>Tanggal & Waktu Tambah</td>
            <td>Nama Kategori</td>      <!-- heading tetap -->
            <td>Deskripsi</td>
            <?php if (isset($_SESSION['level']) && $_SESSION['level']==='admin'): ?>
              <td class="actiondp">Aksi</td>
            <?php endif; ?>
          </tr>
          <?php $i=0; while($p = mysqli_fetch_assoc($result)): ?>
          <tr class="<?= ($i++ % 2 == 0) ? 'content1' : 'content2' ?>">
            <td><?= $p['idProduk'] ?></td>
            <td><?= htmlspecialchars($p['namaBarang']) ?></td>
            <td><?= $p['stokBarang'] ?></td>
            <td>Rp<?= number_format($p['harga'],0,',','.') ?></td>
            <td><?= $p['tglTambah'] ?></td>
            <td><?= htmlspecialchars($p['namaKategori']) ?></td>  <!-- TAMPILKAN NAMA -->
            <td><?= htmlspecialchars($p['deskripsi']) ?></td>
            <?php if (isset($_SESSION['level']) && $_SESSION['level']==='admin'): ?>
            <td class="actiondp">
              <div class="aksi-wrapper">
                <a href="edit.php?id=<?= $p['idProduk'] ?>" class="edit">Edit</a>
                <a href="hapus.php?id=<?= $p['idProduk'] ?>" class="hapus"
                   onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
              </div>
            </td>
            <?php endif; ?>
          </tr>
          <?php endwhile; ?>
        </table>
      <?php endif; ?>
    </div>
  </main>

  <footer>
    <p>&copy; Zie Printing. All Rights Reserved.</p>
  </footer>
</body>
</html>
