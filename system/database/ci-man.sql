-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2018 at 08:58 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci-man`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `no_telp`, `email`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Kang Oman', '08787777772', 'oman@gmail.com', 'admin'),
(2, 'jimmy', 'c3284d0f94606de1fd2af172aba15bf3', 'Jimmy Febriadi ', '55650011211', 'Jimmy@gmail.com', 'pemasukan'),
(5, 'asep', 'dc855efb0dc7476760afaa1b281665f1', 'Asep Sukmana', '087877555572', 'asep@gmail.com', 'pengeluaran');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id_rek` int(3) NOT NULL,
  `nm_bank` varchar(19) NOT NULL,
  `rek` varchar(23) NOT NULL,
  `atasnama` varchar(27) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id_rek`, `nm_bank`, `rek`, `atasnama`) VALUES
(1, 'Bank BCA', '10711999145', 'Nurohman'),
(2, 'Bank Mandiri', '1252227779999', 'Nurohim');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(4) NOT NULL,
  `nip` varchar(12) NOT NULL,
  `nm_guru` varchar(50) NOT NULL,
  `bid_studi` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nm_guru`, `bid_studi`, `no_telp`, `email`) VALUES
(1, '200970210002', 'Amir sarifudin.ST', 'IPA', '087877771111', 'amir@gmail.com'),
(2, '200970210003', 'Budi Setiadi', 'IPA', '08787777772', 'budi@gmail.com'),
(3, '200970210004', 'Amin Muhlisin', 'KEWARGANEGARAAN', '087877555571', 'amin@gmail.com'),
(4, '200970210005', 'Aa Jims', 'B.INDONESIA', '087877777727', 'aajims@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(3) NOT NULL,
  `dana` varchar(35) NOT NULL,
  `saldo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id_kas`, `dana`, `saldo`) VALUES
(1, 'Dana BOS', '25000'),
(2, 'Dana Tata Usaha', '30000'),
(3, 'Dana Kurikulum', '360000');

-- --------------------------------------------------------

--
-- Table structure for table `kas_keluar`
--

CREATE TABLE `kas_keluar` (
  `id_keluar` int(3) NOT NULL,
  `kwitansi` varchar(19) NOT NULL,
  `id_guru` int(3) NOT NULL,
  `keperluan` varchar(25) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `nominal` varchar(15) NOT NULL,
  `id_kas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas_keluar`
--

INSERT INTO `kas_keluar` (`id_keluar`, `kwitansi`, `id_guru`, `keperluan`, `tgl_keluar`, `nominal`, `id_kas`) VALUES
(1, 'KW/DN-201706001', 1, 'Pembelian Buku', '2017-06-18', '50000', 3),
(2, 'KW/DN-201706002', 2, 'alat kantor', '2017-06-19', '5000', 3),
(3, 'KW/DN-201706003', 3, 'pembelian Alat Kantor', '2017-06-19', '7000', 2),
(4, 'KW/DN-201706004', 3, 'pembelian Alat Kantor', '2017-06-19', '5000', 3),
(5, 'KW/DN-201706005', 1, 'Beli Alat Sekolah', '2017-06-19', '15000', 1),
(6, 'KW/DN-201706006', 4, 'Pembelian Buku', '2017-06-19', '3000', 2),
(7, 'KW/DN-201706007', 2, 'alat kantor', '2017-06-19', '20000', 3),
(8, 'KW/DN-201706008', 2, 'beli keperluan sekolah', '2017-06-19', '20000', 3),
(9, 'KW/DN-201706009', 2, 'alat kantor', '2017-06-19', '200000', 1),
(10, 'KW/DN-201706010', 4, 'Beli Alat Sekolah', '2017-06-19', '25000', 3),
(11, 'KW/DN-201706011', 1, 'beli keperluan sekolah', '2017-06-19', '15000', 3);

-- --------------------------------------------------------

--
-- Table structure for table `kas_masuk`
--

CREATE TABLE `kas_masuk` (
  `id_masuk` int(3) NOT NULL,
  `kwitansi` varchar(12) NOT NULL,
  `id_kas` varchar(25) NOT NULL,
  `id_rek` int(3) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `nominal` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas_masuk`
--

INSERT INTO `kas_masuk` (`id_masuk`, `kwitansi`, `id_kas`, `id_rek`, `tgl_masuk`, `nominal`) VALUES
(1, 'KWI-20170601', '2', 1, '2017-06-18', '10000'),
(2, 'KWI-20170602', '1', 2, '2017-06-18', '10000'),
(3, 'KWI-20170603', '1', 0, '2017-06-19', '20000'),
(4, 'KWI-20170604', '2', 0, '2017-06-19', '20000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_rek`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `kas_keluar`
--
ALTER TABLE `kas_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `kas_masuk`
--
ALTER TABLE `kas_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id_rek` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id_kas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kas_keluar`
--
ALTER TABLE `kas_keluar`
  MODIFY `id_keluar` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kas_masuk`
--
ALTER TABLE `kas_masuk`
  MODIFY `id_masuk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
