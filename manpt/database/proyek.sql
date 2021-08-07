-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2021 at 02:10 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

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
-- Table structure for table `persentase`
--

CREATE TABLE `persentase` (
  `id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `persentase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persentase`
--

INSERT INTO `persentase` (`id`, `proyek_id`, `persentase`) VALUES
(1, 14, '0'),
(3, 24, '2'),
(4, 22, '2'),
(5, 23, '0'),
(6, 21, '2'),
(7, 24, '2');

-- --------------------------------------------------------

--
-- Table structure for table `progres`
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
-- Dumping data for table `progres`
--

INSERT INTO `progres` (`id`, `proyek_id`, `type`, `user_id`, `task`, `status`, `detail`) VALUES
(7, 22, 1, 10, 'Analisis Masalah', 'Sudah Selesai', ''),
(8, 22, 1, 10, 'Gudang', 'Sudah Selesai', 'Input data gudang'),
(13, 24, 1, 10, 'Analisis Masalah', 'Sudah Selesai', 'Merencanakan Penjadwalan Barang'),
(14, 24, 2, 10, 'Framework', 'Sudah Selesai', 'Code Igniter 3'),
(25, 22, 3, 12, 'asdsad', 'Sudah Selesai', 'asdasd'),
(27, 21, 1, 10, 'Analisis Masalah', 'Sudah Selesai', 'Input data gudang'),
(30, 24, 1, 13, 'hduowskbc', 'Sudah Selesai', 'menambahkan data');

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE `proyek` (
  `id` int(11) NOT NULL,
  `nama_proyek` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
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
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `nama_proyek`, `nama_barang`, `jumlah_barang`, `supplier`, `estimasi_pengerjaan`, `estimasi_biaya`, `start`, `end`, `progress`, `laporan`, `status`, `user_id`, `vendor`, `aproval_admin`) VALUES
(23, 'proyek iseng lagi', 'iseng', 12, 'A', '10', 'estimasi23.xlsx', '2021-01-12', '2021-01-20', '[0,0,0,0,0]', '', 'Berjalan', 12, 'B', 'Belum Diapprove(Tambah Data)'),
(24, 'proyek indo', 'modem', 400, 'telkom', '30', 'estimasi24.xlsx', '2021-01-21', '2021-02-04', '[null,null,null,null,null]', '', 'Akan Berjalan', 13, 'telkom', 'Sudah diapprove');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `nama`, `email`, `level`, `password`, `telp`, `tanggal_gabung`, `status`) VALUES
(1, 'admin', 'dwi', 'Dwiyulianingsih21@gmail.com', 1, 'e00cf25ad42683b3df678c61f42c6bda', '082213095918', '1609603663', '1'),
(9, 'genta', 'genta genti', 'helmy.hudiya@gmail.com', 2, '413be8ffa930ad1b82d0b2bd8dbb1f5f', '0857212189656', '1609666469', '1'),
(10, 'mibnusina', 'Muhammad Ibnu Sina', 'mibnusina26@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', '08224464646', '1610630105', '1'),
(11, 'ujangwiliem', 'ujangwilliem', 'ujangwilliem@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', '0827328172832', '1610716162', '1'),
(12, 'dodo', 'dodo', 'dodo@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', '092839271623', '1610785826', '1'),
(13, 'luki', 'lukina', 'luki@gmail.com', 2, '21232f297a57a5a743894a0e4a801fc3', '0856788977', '1610794499', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `persentase`
--
ALTER TABLE `persentase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progres`
--
ALTER TABLE `progres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `persentase`
--
ALTER TABLE `persentase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `progres`
--
ALTER TABLE `progres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
