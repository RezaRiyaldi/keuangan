-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2022 at 07:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kendaraan`
--

CREATE TABLE `jenis_kendaraan` (
  `id_jenis_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` varchar(20) NOT NULL,
  `harga_perhari` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kendaraan`
--

INSERT INTO `jenis_kendaraan` (`id_jenis_kendaraan`, `jenis_kendaraan`, `harga_perhari`) VALUES
(7, 'Motor', '2000'),
(8, 'Mobil', '5000'),
(9, 'Bis', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(11) NOT NULL,
  `tipe_transaksi` tinyint(1) NOT NULL,
  `jenis_transaksi` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id_kas`, `tipe_transaksi`, `jenis_transaksi`, `jumlah`, `tanggal_transaksi`) VALUES
(17, 1, 'Parkir', 10000, '2022-06-26'),
(18, 1, 'Parkir', 5000, '2022-06-26'),
(20, 0, 'Jajan', 5000, '2022-06-26'),
(21, 1, 'Parkir', 2000, '2022-06-26'),
(22, 1, 'Parkir', 10000, '2022-06-26'),
(23, 1, 'Parkir', 10000, '2022-06-27'),
(24, 0, 'Beli lampu', 25000, '2022-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `parkir`
--

CREATE TABLE `parkir` (
  `id_parkir` int(11) NOT NULL,
  `jenis_kendaraan_id` int(11) NOT NULL,
  `plat` varchar(15) NOT NULL,
  `jam_masuk` time NOT NULL,
  `tanggal_parkir` date NOT NULL,
  `jam_keluar` time DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `harga_parkir` int(11) DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  `status` enum('active','non-active') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parkir`
--

INSERT INTO `parkir` (`id_parkir`, `jenis_kendaraan_id`, `plat`, `jam_masuk`, `tanggal_parkir`, `jam_keluar`, `tanggal_keluar`, `harga_parkir`, `petugas_id`, `status`) VALUES
(18, 7, 'B 1234 FWB', '10:16:25', '2022-06-26', NULL, NULL, 2000, 3, 'non-active'),
(20, 8, 'J 1234 FWB', '10:28:11', '2022-06-26', NULL, NULL, 5000, 3, 'non-active'),
(21, 9, 'E 9021 XXX', '23:12:31', '2022-06-26', '23:14:52', '2022-06-26', 10000, 11, 'non-active'),
(22, 7, 'F 4442 FTY', '23:16:02', '2022-06-26', NULL, NULL, NULL, NULL, 'active'),
(23, 8, 'AD 4222 FKA', '23:16:20', '2022-06-26', '00:39:33', '2022-06-27', 10000, 11, 'non-active');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Parkir'),
(3, 'Keuangan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki - laki','Perempuan') NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `nama_lengkap`, `jenis_kelamin`, `password`, `role_id`, `foto`) VALUES
(3, 'admin', 'Kang Admin', 'Laki - laki', '$2y$10$IM78t7dJ9BFP1ICsE53F0ef7S.42OIDVyr22iTGBs6MyhUpiRanmC', 1, 'default-man.png'),
(11, 'parkir', 'Mba Parkir', 'Perempuan', '$2y$10$vmEdilTDLzzHujelsYg1Ke.NiJ9QnCC5ORyxkphS9HGF6tWsy/.7m', 2, 'default-woman.png'),
(15, 'keuangan', 'Aa Keuangan', 'Laki - laki', '$2y$10$M95Dp6Euksz9uw3fXY/Lne9v1xVvzrRxigGQCYeunr3k1WX08Utbu', 3, 'default-man.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_kendaraan`
--
ALTER TABLE `jenis_kendaraan`
  ADD PRIMARY KEY (`id_jenis_kendaraan`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `parkir`
--
ALTER TABLE `parkir`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `jenis_kendaraan` (`jenis_kendaraan_id`),
  ADD KEY `petugas` (`petugas_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_kendaraan`
--
ALTER TABLE `jenis_kendaraan`
  MODIFY `id_jenis_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id_kas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `parkir`
--
ALTER TABLE `parkir`
  MODIFY `id_parkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parkir`
--
ALTER TABLE `parkir`
  ADD CONSTRAINT `jenis_kendaraan` FOREIGN KEY (`jenis_kendaraan_id`) REFERENCES `jenis_kendaraan` (`id_jenis_kendaraan`),
  ADD CONSTRAINT `petugas` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id_role`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
