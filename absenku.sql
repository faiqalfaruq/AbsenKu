-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 05:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absenku`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `status` enum('hadir','sakit','izin','alfa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id`, `nis`, `tanggal`, `waktu`, `status`) VALUES
(7, '101010', '2025-04-01', '14:41:13', 'hadir'),
(8, '101010', '2025-04-02', '14:43:46', 'hadir'),
(9, '101010', '2025-04-03', '14:45:52', 'izin'),
(10, '101010', '2025-04-04', '14:46:11', 'hadir'),
(11, '101010', '2025-04-05', '14:46:39', 'alfa'),
(12, '101010', '2025-04-06', '14:46:39', 'sakit'),
(13, '202020', '2025-04-03', '14:45:52', 'izin'),
(14, '202020', '2025-04-04', '14:45:52', 'hadir'),
(15, '202020', '2025-04-05', '14:45:52', 'hadir'),
(16, '202020', '2025-04-06', '14:45:52', 'alfa'),
(17, '202020', '2025-04-07', '14:45:52', 'alfa');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` enum('admin','siswa','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`, `role`) VALUES
(6, '280107', '$2y$10$vnLZbCikXNwUlw9oD8EvPu7i40sImbhG4YXG3YN.RHhPet4xLrg/q', 'admin'),
(11, '101010', '$2y$10$mFDsqvmSrE4KKaD4tMSeE.vaG59T3//V.zcGFvQyXzEfa53pLrMbq', 'siswa'),
(12, '202020', '$2y$10$S4EIO7W78VqL.CBADoYMtu1wjX8haxe7kbSDPBKd.2XEXkRCtAOYu', 'siswa'),
(13, '303030', '$2y$10$S4.BatA/c8/5/zksKphsD.eMHLgekL4Agp.f.DjUc6/Xv7FDoY.JG', 'siswa'),
(14, '404040', '$2y$10$9HYs7308XZ2qmk4VxqOwzuV.8Ppx9aMHcTgBaNKxLrsE4sw14OJq.', 'siswa'),
(15, '505050', '$2y$10$RJKFve2ijNcWuts.zeHD2eiQIjcp2tSiZVbzwY1GqscEO7uKtIWF.', 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama` varchar(64) NOT NULL,
  `nis` varchar(32) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `kelas` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `foto`, `nama`, `nis`, `jenis_kelamin`, `kelas`) VALUES
(6, NULL, 'ThisAdmin', '280107', 'Laki - Laki', '12 PPLG A'),
(11, NULL, 'Nomor Satu', '101010', 'Laki - Laki', '12 PPLG A'),
(12, NULL, 'Nomor Dua', '202020', 'Laki - Laki', '12 PPLG A'),
(13, '', 'Nomor Tiga', '303030', 'Laki-laki', '12 PPLG A'),
(14, NULL, 'Nomor Empat', '404040', 'Laki - Laki', '12 PPLG A'),
(15, NULL, 'Nomor Lima', '505050', 'Perempuan', '12 PPLG A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
