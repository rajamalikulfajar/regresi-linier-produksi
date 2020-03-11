-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2020 at 09:42 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datamining_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `produksi_kecerdasan`
--

CREATE TABLE `produksi_kecerdasan` (
  `id` int(11) NOT NULL,
  `nama_karyawan` varchar(25) NOT NULL,
  `y` float NOT NULL,
  `x` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi_kecerdasan`
--

INSERT INTO `produksi_kecerdasan` (`id`, `nama_karyawan`, `y`, `x`) VALUES
(1, 'A', 30, 6),
(2, 'B', 49, 9),
(3, 'C', 18, 3),
(4, 'D', 42, 8),
(5, 'E', 39, 7),
(6, 'F', 25, 5),
(7, 'G', 41, 8),
(8, 'H', 52, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produksi_kecerdasan`
--
ALTER TABLE `produksi_kecerdasan`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
