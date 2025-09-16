<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Zie Printing</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="image/zie_nobg.png" type="image/x-icon">
    <style>
        .alert {
            padding: 12px 18px;
            border-radius: 6px;
            margin: 16px auto;
            max-width: 480px;
            font-weight: 600;
            text-align: center;
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

<body class="bodydaftar">
    <?php
/* --- Notifikasi sederhana dari parameter ?pesan= --- */
if (isset($_GET['pesan'])) {
    switch ($_GET['pesan']) {
        case 'terpakai':
            $msg  = 'Username atau email sudah terpakai. Silakan coba yang lain.';
            $type = 'error';   // akan dipakai di class CSS
            break;
        case 'kosong':
            $msg  = 'Kolom bertanda * wajib diisi.';
            $type = 'error';
            break;
        case 'daftar_sukses':
            $msg  = 'Pendaftaran berhasil! Silakan login.';
            $type = 'sukses';
            break;
        default:
            $msg = ''; $type = '';
    }

    if ($msg !== '') {
        echo "<div class=\"alert $type\">$msg</div>";
    }
}
?>

    <main class="maindaftar">
        <form action="daftarProses.php" method="post">
            <div class="carddaftar">
                <div class="title">
                    <img src="image/daftar.png" alt="daftar-page">
                </div>
                <div class="content">
                    <h1>Daftar</h1>
                    <table>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td><input type="text" name="username" placeholder="Username" required></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="email" name="email" placeholder="Email" required></td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>:</td>
                            <td><input type="text" name="noHp" placeholder="No. Telepon" required></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td><input type="date" name="tglLahir" required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><input type="password" name="password" placeholder="Password" required></td>
                        </tr>
                    </table>
                    <p><input type="submit" name="daftar" value="Daftar"></p>
                    <p>Sudah punya akun? <a href="login.php">Login</a></p>
                    <p><a href="index.php">Kembali ke beranda</a></p>
                </div>
            </div>
        </form>
    </main>
</body>

</html>