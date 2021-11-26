-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 11:35 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_kuliah`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kuliah`
--

CREATE TABLE `jadwal_kuliah` (
  `id_matkul` int(11) NOT NULL,
  `nama_matkul` varchar(100) DEFAULT NULL,
  `nm_dosen` varchar(100) DEFAULT NULL,
  `waktu` varchar(20) DEFAULT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `ruangan` varchar(20) DEFAULT NULL,
  `terlaksana` varchar(50) DEFAULT NULL,
  `tugas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_kuliah`
--

INSERT INTO `jadwal_kuliah` (`id_matkul`, `nama_matkul`, `nm_dosen`, `waktu`, `hari`, `ruangan`, `terlaksana`, `tugas`) VALUES
(65, 'Pemerograman Web', 'Tomi Tri Sujaka., S.kom., M.kom', '12:10 - 14:00', 'Rabu', 'RPL - 1', 'OFFLINE', 'Screenshot_101.png'),
(66, 'Pemerograman Web', 'Tomi Tri Sujaka., S.kom., M.kom', '08:00 - 9:40', 'Rabu', 'RPL - 1', 'OFFLINE', '619f8e4ba72c1.png'),
(67, 'Pemerograman Web', 'dasda', '08:00 - 9:40', 'Rabu', 'RPL - 1', 'OFFLINE', '61a0253b9c061.png'),
(68, 'Pemerograman Web', 'dasda', '08:00 - 9:40', 'Rabu', 'RPL - 1', 'OFFLINE', '61a025b1b4de9.jpg'),
(69, 'Sistem Operasi', 'mudawil Tri Sujaka., S.kom., M.kom', '08:00 - 9:40', 'Rabu', 'DKV - 1', 'OFFLINE', '61a02890108b3.jpg'),
(70, 'Pemerograman Web', 'dasda', '12:10 - 14:00', 'Rabu', 'RPL - 1', 'OFFLINE', '61a028e916111.jpg'),
(71, 'Administrasi Sistem Basis Data', 'dasda', '08:00 - 9:40', 'Rabu', 'DKV - 1', 'OFFLINE', '61a02904dd62e.jpg'),
(72, 'Pemerograman Web', 'dasda', '08:00 - 9:40', 'Rabu', 'RPL - 1', 'OFFLINE', '61a0295e5760d.png'),
(74, 'Pemerograman Web', 'dasda', '08:00 - 9:40', 'Rabu', 'RPL - 1', 'OFFLINE', '61a096ca69755.png'),
(75, 'Pemerograman Web', 'dasda', '08:00 - 9:40', 'Rabu', 'RPL - 1', 'OFFLINE', '61a09bdf14f39.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'michael', '$2y$10$L7O2vaFA/o9zIR9d76Amye2emCmJXsqn/Y8i5/tENxIUS.RPeRhDG'),
(2, 'michael', '$2y$10$jrOVREXksRmLoV/pQC7Q8OgkCudX3A443mXeu.TX737hBQryhajPq'),
(3, 'michael', '$2y$10$sIEudpdvcqzDkkGYJFRx8OzrpsJvBF6r79.o8qo5x.FPPOjkUCOqK'),
(4, 'michael christ', '$2y$10$7TVhF7IuXeFaXnvpluEmUeyLxdedEWbnS7hoRI5cG6Z4J8S1OyJau'),
(5, '123', '$2y$10$D5fkUyKZ87fv0qArvwnwAeOfxenlhmisbIWbOtxcQIZeOR0rqGqEa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
