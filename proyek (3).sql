-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2021 pada 19.00
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilik_proyek`
--

CREATE TABLE `pemilik_proyek` (
  `id_pemilik_proyek` int(11) NOT NULL,
  `nama_pemilik` varchar(30) NOT NULL,
  `no_telpon` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `penanggung_jawab` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemilik_proyek`
--

INSERT INTO `pemilik_proyek` (`id_pemilik_proyek`, `nama_pemilik`, `no_telpon`, `alamat`, `penanggung_jawab`) VALUES
(1, 'dadang', '089864998312', 'jl. amanah no 2 sarijanuh', 'dzihan'),
(2, 'dzihan', '0822-1309-5918', 'Kp sadang ds purwasari', 'dzihan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `persentase`
--

CREATE TABLE `persentase` (
  `id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `persentase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `persentase`
--

INSERT INTO `persentase` (`id`, `proyek_id`, `persentase`) VALUES
(1, 14, '0'),
(3, 24, '2'),
(4, 22, '2'),
(5, 23, '2'),
(6, 21, '2'),
(7, 24, '2'),
(8, 25, '0'),
(9, 26, '0'),
(10, 25, '0'),
(11, 25, '0'),
(12, 25, '0'),
(13, 25, '0'),
(14, 26, '0'),
(15, 27, '0'),
(16, 25, '0'),
(17, 25, '0'),
(18, 26, '0'),
(19, 27, '0'),
(20, 27, '0'),
(21, 27, '0'),
(22, 28, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `progres`
--

CREATE TABLE `progres` (
  `id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `progres`
--

INSERT INTO `progres` (`id`, `proyek_id`, `type`, `user_id`, `task`, `status`, `detail`) VALUES
(7, 22, 1, 10, 'Analisis Masalah', 'Sudah Selesai', ''),
(8, 22, 1, 10, 'Gudang', 'Sudah Selesai', 'Input data gudang'),
(13, 24, 1, 10, 'Analisis Masalah', 'Sudah Selesai', 'Merencanakan Penjadwalan Barang'),
(14, 24, 2, 10, 'Framework', 'Sudah Selesai', 'Code Igniter 3'),
(25, 22, 3, 12, 'asdsad', 'Sudah Selesai', 'asdasd'),
(27, 21, 1, 10, 'Analisis Masalah', 'Sudah Selesai', 'Input data gudang'),
(30, 24, 1, 13, 'hduowskbc', 'Sudah Selesai', 'menambahkan data'),
(31, 23, 1, 1, 'Perencanaan 1', 'Belum Selesai', 'Menyusun kerangka proyek'),
(32, 23, 2, 1, 'Perencanaan 1', 'Sudah Selesai', 'dfghhnijk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id` int(11) NOT NULL,
  `nama_proyek` varchar(255) NOT NULL,
  `jenis_proyek` varchar(255) NOT NULL,
  `keterangan_proyek` varchar(50) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `estimasi_pengerjaan` varchar(255) NOT NULL,
  `estimasi_biaya` varchar(255) NOT NULL,
  `start` varchar(20) NOT NULL,
  `end` varchar(20) NOT NULL,
  `progress` varchar(255) NOT NULL,
  `laporan` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  `aproval_admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id`, `nama_proyek`, `jenis_proyek`, `keterangan_proyek`, `supplier`, `estimasi_pengerjaan`, `estimasi_biaya`, `start`, `end`, `progress`, `laporan`, `status`, `user_id`, `vendor`, `aproval_admin`) VALUES
(23, 'proyek iseng lagi', 'iseng', '12', 'A', '10', 'estimasi23.xlsx', '2021-01-12', '2021-01-20', '[0,0,0,0,0]', '', 'Berjalan', 12, 'B', 'Sudah diapprove'),
(24, 'proyek indo', 'modem', '400', 'telkom', '30', 'estimasi24.xlsx', '2021-01-21', '2021-02-04', '[null,null,null,null,null]', '', 'Akan Berjalan', 13, 'telkom', 'Sudah diapprove'),
(25, 'haha proyek', 'ujicoba', '0', 'xzxzx', '10', 'estimasi25.jpg', '2021-07-25', '2021-08-01', '[0,0,0,0,0]', '', 'Berjalan', 1, 'telkom', 'Sudah diapprove'),
(26, 'pt di', 'jl. kelapa 1', '0', '', '', 'estimasi26.', '098964998312--', '--', '[0,0,0,0,0]', '', 'Berjalan', 0, '', 'Sudah diapprove'),
(27, 'sariayu', 'baha', '0', 'astinet telkom', '3', 'estimasi27.jpg', '2021-07-26', '2021-07-27', '[0,0,0,0,0]', '', 'Berjalan', 1, 'PT Telkom', 'Belum Diapprove(Tambah Data)'),
(28, 'bismilo', 'huhu', 'proyek ini dibuat untuk ini dan itu', 'astra', '5', 'estimasi28.jpg', '2021-07-26', '2021-07-27', '[0,0,0,0,0]', '', 'Berjalan', 1, 'akuilah', 'Belum Diapprove(Tambah Data)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `task`
--

CREATE TABLE `task` (
  `id_task` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `label` varchar(10) NOT NULL,
  `hari` int(11) NOT NULL,
  `predescessor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `task`
--

INSERT INTO `task` (`id_task`, `id_proyek`, `label`, `hari`, `predescessor`) VALUES
(31, 23, 'a', 2, '-'),
(32, 23, 'b', 3, 'a'),
(13, 24, 'a', 1, '-'),
(14, 24, 'b', 2, 'a'),
(30, 24, 'c', 2, 'b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `tanggal_gabung` varchar(30) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `nama`, `email`, `level`, `password`, `telp`, `tanggal_gabung`, `status`) VALUES
(1, 'admin', 'dwi', 'Dwiyulianingsih21@gmail.com', 1, 'e00cf25ad42683b3df678c61f42c6bda', '082213095918', '1609603663', '1'),
(9, 'genta', 'genta genti', 'helmy.hudiya@gmail.com', 2, '413be8ffa930ad1b82d0b2bd8dbb1f5f', '0857212189656', '1609666469', '1'),
(10, 'mibnusina', 'Muhammad Ibnu Sina', 'mibnusina26@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', '08224464646', '1610630105', '1'),
(11, 'ujangwiliem', 'ujangwilliem', 'ujangwilliem@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', '0827328172832', '1610716162', '1'),
(12, 'dodo', 'dodo', 'dodo@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', '092839271623', '1610785826', '1'),
(13, 'luki', 'lukina', 'luki@gmail.com', 2, '21232f297a57a5a743894a0e4a801fc3', '0856788977', '1610794499', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(11) NOT NULL,
  `nama_vendor` varchar(30) NOT NULL,
  `no_telpon` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `penanggung_jawab` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `no_telpon`, `alamat`, `penanggung_jawab`) VALUES
(1, 'ah', '089864998312', 'jl. kelapa satu desa sarijadi', 'dwiyul'),
(2, 'haha', '09090909', 'Kp sadang ds purwasari', 'dwiyul123456'),
(4, 'aadfa', '3453424t2', 'Kp sadang ds purwasari', 'aadfa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemilik_proyek`
--
ALTER TABLE `pemilik_proyek`
  ADD PRIMARY KEY (`id_pemilik_proyek`);

--
-- Indeks untuk tabel `persentase`
--
ALTER TABLE `persentase`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `progres`
--
ALTER TABLE `progres`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemilik_proyek`
--
ALTER TABLE `pemilik_proyek`
  MODIFY `id_pemilik_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `persentase`
--
ALTER TABLE `persentase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `progres`
--
ALTER TABLE `progres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
