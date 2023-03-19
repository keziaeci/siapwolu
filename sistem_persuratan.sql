-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 06:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_persuratan`
--

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_surat` varchar(20) NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `file_surat` varchar(100) NOT NULL,
  `laporan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `tanggal`, `nomor_surat`, `kepada`, `keperluan`, `file_surat`, `laporan`) VALUES
(14, '2022-09-01', '0877544577776', 'Kepala Sekolah', 'Mitra Bisnis', 'Salinan SOAL KSN IPA.pdf', 'Tidak ada');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_surat` varchar(20) NOT NULL,
  `asal_surat` varchar(200) NOT NULL,
  `nomor_tanggal_surat` varchar(30) NOT NULL,
  `perihal` text NOT NULL,
  `file_surat` varchar(100) NOT NULL,
  `file_disposisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `tanggal`, `nomor_surat`, `asal_surat`, `nomor_tanggal_surat`, `perihal`, `file_surat`, `file_disposisi`) VALUES
(25, '2022-09-01', '0906390920692', 'Alibaba ', '11/202/22222', 'Kerjasama', 'Module_Practice_Mobile_Computing_System.pdf', 'Tidak ada'),
(26, '2022-11-25', '0122443333333', 'Google  LLC', '87/11/2033', 'undangan', 'PROPOSAL CENIL.pdf', 'Tidak ada');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'Admin', '$2y$10$9fBxrq409sAzwwuCSP3j4ehikUPgjJ4tBXpceRcnC9VobqscObMji', 'admin'),
(6, 'Kepala Tu', '$2y$10$PK7VQpn5R64taDrRxVk08e29yRQsqe3DOKDvQBN2rYvHa2d9zUYni', 'user'),
(7, 'Kepala Sekolah', '$2y$10$ZFIECdSGEwIlzfhUD0PjR.5COfJJjdcuMWqHJZRPXAFpNEFUNvzU6', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`,`nomor_surat`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`,`nomor_surat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
