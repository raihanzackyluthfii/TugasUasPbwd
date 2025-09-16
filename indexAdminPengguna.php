<?php 
    session_start();
    $allowed_levels = ['Admin'] 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Zie Printing</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="image/zie_nobg.png" type="image/x-icon">
    <style>
        .btn-logout {
            background: #fa2727;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 15px 18px;
            font-size: large;
            cursor: pointer;
        }

        .btn-logout:hover {
            opacity: .85;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li class="nav-right">
                <a href="indexAdminPengguna.php" class="active">Beranda</a>
                <a href="produk.php">Produk</a>
                <?php if (isset($_SESSION['level']) && $_SESSION['level'] === 'admin'): ?>
                <a href="tambahproduk.php">Tambah Produk</a>
                <?php endif; ?>

                <?php if (isset($_SESSION['username'])): ?>
                <!-- Tombol logout -->
                <form action="logout.php" method="post" style="display:inline;">
                    <button type="submit" name="keluar" class="btn-logout">Keluar</button>
                </form>
                <?php else: ?>
                <a href="login.php" class="dl">Masuk</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
    <header>
        <img src="image/header.png" alt="header">
    </header>
    <main>
        <!-- Selamat Datang -->
        <div class="selamatDatang">
            <div class="content">
                <h1>Selamat Datang! <?php echo $_SESSION['username']; ?></h1>
                <p></p>
            </div>
        </div>

        <!-- Card -->
        <div class="maincard">
            <div class="card">
                <div class="image">
                    <img src="image/gambar4.png" alt="">
                </div>
                <div class="content">
                    <h1>Layanan Cetak Berkualitas Tinggi</h1>
                    Kami menyediakan layanan cetak dengan teknologi modern untuk hasil yang tajam dan warna yang akurat.
                    Cocok untuk kebutuhan banner, brosur, dan media promosi lainnya
                </div>

            </div>
            <div class="card2">
                <div class="content">
                    <h1>Warna Tajam dan Akurat</h1>
                    Proses pencetakan menggunakan standar CMYK untuk memastikan warna tetap konsisten di setiap media.
                    Warna tidak mudah pudar dan tahan lama
                </div>

                <div class="image">
                    <img src="image/gambar3.png" alt="">
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="image/gambar2.png" alt="">
                </div>
                <div class="content">
                    <h1>Layanan Cepat dan Tepat Waktu</h1>
                    Kami memahami pentingnya waktu. Dengan sistem manajemen pesanan yang efisien, pesanan Anda akan
                    diproses dan selesai sesuai jadwal
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Zie Printing. All Rights Reserved.</p>
    </footer>
</body>
</html>