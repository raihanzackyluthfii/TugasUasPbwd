<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Zie Printing</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="image/zie_nobg.png" type="image/x-icon">
    <style>
        .alert {
            padding: 12px 18px;
            border-radius: 6px;
            margin: 16px 0;
            font-weight: 600;
        }

        .alert.sukses {
            background: #d4edda;
            /* hijau muda */
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background: #f8d7da;
            /* merah muda */
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body class="bodylogin">
    <!-- Berhasil Daftar -->
    <?php if (isset($_GET['pesan']) && $_GET['pesan'] === 'daftar_sukses'): ?>
    <div class="alert sukses">🎉 Pendaftaran berhasil! Silakan login.</div>
    <?php endif; ?>

    <!-- Berhasil Logout-->
    <?php
    if (isset($_GET['pesan']) && $_GET['pesan'] === 'logout_sukses') {
    echo '<div class="alert sukses">🔒 Anda sudah logout. Sampai jumpa lagi!</div>';
    }
    ?>

    <main>
        <form action="loginProses.php" method="post">
            <div class="cardlogin">
                <div class="title">
                    <img src="image/login.png" alt="login-page">
                </div>
                <div class="content">
                    <h1>Masuk</h1>
                    <table>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td><input type="text" name="username" placeholder="Username"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><input type="password" name="password" placeholder="Password"></td>
                        </tr>
                    </table>
                    <p><input type="submit" name="masuk" value="Masuk"></p>
                    <p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
                    <p><a href="index.php">Kembali ke beranda</a></p>
                </div>
            </div>
        </form>
    </main>
</body>

</html>