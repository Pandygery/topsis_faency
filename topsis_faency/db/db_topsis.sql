-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2025 at 10:08 AM
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
-- Database: `db_topsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--
CREATE DATABASE `db_topsis`;
USE `db_topsis`;
CREATE TABLE `tbl_akun` (
  `id_akun` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_akun`
--

INSERT INTO `tbl_akun` (`id_akun`, `nama_lengkap`, `username`, `password`, `level`) VALUES
(1, 'ADMINISTRATOR', 'ADMIN', '12345', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `dmax` double NOT NULL,
  `dmin` double NOT NULL,
  `nilai_topsis` double NOT NULL,
  `ranking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id_alternatif`, `nama_alternatif`, `dmax`, `dmin`, `nilai_topsis`, `ranking`) VALUES
(1, 'ALTERNATIF A', 0.10305782373348, 0.11185688053261, 0.52047104415023, 2),
(2, 'ALTERNATIF B', 0.10998874133208, 0.10504929097977, 0.48851493780145, 3),
(3, 'ALTERNATIF C', 0.063960214906683, 0.13799263626824, 0.68329134976518, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot_kriteria` double NOT NULL,
  `akar_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`, `akar_kriteria`) VALUES
(1, 'Harga', 25, 3),
(2, 'Kualitas Produk', 25, 4.1231056256177),
(3, 'Jumlah Barang Terjual', 30, 4.6904157598234),
(4, 'Ketersediaan Stok', 20, 4.3588989435407);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL,
  `normalisasi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `id_alternatif`, `id_kriteria`, `id_subkriteria`, `normalisasi`) VALUES
(1, 1, 1, 3, 0.083333333333333),
(2, 1, 2, 5, 0.12126781251817),
(3, 1, 3, 7, 0.19188064472005),
(4, 1, 4, 10, 0.13764944032234),
(5, 2, 1, 2, 0.16666666666667),
(6, 2, 2, 5, 0.12126781251817),
(7, 2, 3, 7, 0.19188064472005),
(8, 2, 4, 12, 0.045883146774112),
(9, 3, 1, 2, 0.16666666666667),
(10, 3, 2, 4, 0.18190171877725),
(11, 3, 3, 8, 0.12792042981337),
(12, 3, 4, 10, 0.13764944032234);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subkriteria`
--

CREATE TABLE `tbl_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_subkriteria` varchar(50) NOT NULL,
  `nilai_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subkriteria`
--

INSERT INTO `tbl_subkriteria` (`id_subkriteria`, `id_kriteria`, `nama_subkriteria`, `nilai_subkriteria`) VALUES
(1, 1, 'Murah', 3),
(2, 1, 'Standar', 2),
(3, 1, 'Mahal', 1),
(4, 2, 'Grade A', 3),
(5, 2, 'Grade B', 2),
(6, 2, 'Grade C', 1),
(7, 3, 'Tinggi', 3),
(8, 3, 'Sedang', 2),
(9, 3, 'Rendah', 1),
(10, 4, 'Tinggi', 3),
(11, 4, 'Sedang', 2),
(12, 4, 'Rendah', 1),
(13, 5, 'Baik', 3),
(14, 5, 'Sedang', 2),
(15, 5, 'Kurang', 1),
(16, 6, 'Tinggi', 3),
(17, 6, 'Sedang', 2),
(18, 6, 'Rendah', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
