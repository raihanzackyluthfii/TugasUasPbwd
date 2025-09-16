-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2025 pada 10.26
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zieprinting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idKategori` int(11) NOT NULL,
  `namaKategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idKategori`, `namaKategori`) VALUES
(1001, 'Alat Kantor'),
(1005, 'Brosur'),
(1004, 'Buku Cetak'),
(1009, 'Kalender'),
(1010, 'Kartu Nama'),
(1007, 'Spanduk'),
(1008, 'Stiker'),
(1006, 'Undangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idProduk` int(11) NOT NULL,
  `namaBarang` varchar(50) NOT NULL,
  `stokBarang` int(11) NOT NULL DEFAULT 0,
  `harga` decimal(10,0) NOT NULL DEFAULT 0,
  `tglTambah` date NOT NULL,
  `idUser` int(11) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `idKategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idProduk`, `namaBarang`, `stokBarang`, `harga`, `tglTambah`, `idUser`, `deskripsi`, `idKategori`) VALUES
(1, 'Amplop Custom', 12, 20000, '2025-07-31', 1, 'barang bagus bangettt', 1001),
(5, 'Brosur A4', 8, 70000, '2025-07-01', 1, 'qweqweqw', 1005);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `noHp` varchar(20) DEFAULT NULL,
  `tglLahir` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','pengguna') NOT NULL DEFAULT 'pengguna'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`idUser`, `username`, `email`, `noHp`, `tglLahir`, `password`, `level`) VALUES
(1, 'zacky', 'zacky@gmail.com', '12349821', '2025-07-02', '123', 'admin'),
(2, 'milo', 'milo123@gmail.com', '087212341234', '2015-06-26', '123', 'pengguna'),
(3, 'leon', 'leon213@gmail.com', '098123873', '2025-07-11', '123', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idKategori`),
  ADD UNIQUE KEY `namaKategori` (`namaKategori`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idProduk`),
  ADD KEY `fk_produk_user` (`idUser`),
  ADD KEY `fk_produk_kategori` (`idKategori`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idProduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_kategori` FOREIGN KEY (`idKategori`) REFERENCES `kategori` (`idKategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produk_user` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
