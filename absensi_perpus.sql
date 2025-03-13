-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 04:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `masuk` datetime NOT NULL,
  `keluar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `nim`, `masuk`, `keluar`) VALUES
(26, '072202101 ', '2025-03-11 16:08:33', '2025-03-11 16:11:51'),
(27, '3237670626', '2025-03-11 16:09:02', '2025-03-11 16:11:58'),
(28, '3231687170', '2025-03-11 16:09:11', '2025-03-11 16:12:05'),
(29, '072103206 ', '2025-03-11 16:09:21', '2025-03-11 16:12:12'),
(30, '072111113 ', '2025-03-11 16:09:31', '2025-03-11 16:12:20'),
(31, '3233454882', '2025-03-11 16:09:39', '2025-03-11 16:12:27'),
(32, '3239381170', '2025-03-11 16:09:47', '2025-03-11 16:12:34'),
(33, '3233445266', '2025-03-11 16:09:54', '2025-03-11 16:12:41'),
(34, '3240577330', '2025-03-11 16:10:01', '2025-03-11 16:12:50'),
(35, '072202103 ', '2025-03-11 16:10:08', '2025-03-11 16:12:57'),
(36, '3237701922', '2025-03-11 16:10:16', '2025-03-11 16:13:04'),
(37, '3233443154', '2025-03-11 16:10:26', '2025-03-11 16:13:10'),
(38, '3239702946', '2025-03-11 16:10:33', '2025-03-11 16:13:16'),
(39, '3240570482', '2025-03-11 16:10:40', '2025-03-11 16:13:22'),
(40, '072203108 ', '2025-03-11 16:10:49', '2025-03-11 16:13:29'),
(41, '3233397698', '2025-03-11 16:10:56', '2025-03-11 16:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`) VALUES
(9, '072202101', 'Akwila'),
(10, '3237670626', 'Alfret Yonathan Tadjo Talo'),
(11, '3231687170', 'Budianda Tioanda'),
(12, '072103206', 'Ella Kartika'),
(13, '072111113', 'Hans Tunggajaya'),
(14, '3233454882', 'Jerri Sitandi'),
(15, '3239381170', 'Jessica Handayani'),
(16, '3233445266', 'Jordan Frans Adrian'),
(17, '3240577330', 'Joshua Xavier Josephus'),
(18, '072202103', 'Judika Ekaristi Putra Imanuel'),
(19, '3237701922', 'Leonardo Aditya Rangkinaung'),
(20, '3233443154', 'Lois Fendry kristanti'),
(21, '3239702946', 'Maria Stefany'),
(22, '3240570482', 'Melina Dewi Murjadi'),
(23, '072203108', 'Michael Daud Tonda'),
(24, '3233397698', 'Tiffany Alexandria');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
