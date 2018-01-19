-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 08, 2017 at 04:00 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seragam`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `id` int(15) NOT NULL,
  `item` varchar(50) NOT NULL,
  `size` varchar(3) NOT NULL,
  `qty` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`id`, `item`, `size`, `qty`) VALUES
(1, 'celana', '22', '60'),
(2, 'celana', '28', '21'),
(3, 'baju', '21', '0'),
(4, 'Baju Panjang', '38', '0'),
(5, 'Baju Panjang', '81', '0'),
(7, 'asd', '12', '15'),
(8, 'asd', '12', '0'),
(9, 'qwe', '12', '0'),
(10, 'ewq', '12', '0'),
(11, 'asd', '21', '0'),
(12, 'zxc', '12', '0'),
(13, 'sd', '13', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pic`
--

CREATE TABLE `tbl_pic` (
  `id` int(15) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `photo` text,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pic`
--

INSERT INTO `tbl_pic` (`id`, `nik`, `nama`, `password`, `photo`, `level`) VALUES
(1, '123123', 'Rich Chigga', '12345678', '7ec731be5b01760b89cb7e0fb631d59a.jpg', 'admin'),
(2, '141011283', 'ThaliaSuhada Annisa', 'thalia', NULL, 'superadmin'),
(5, '19981101', 'Staff', '12345678', '01-Front.jpg', 'admin'),
(6, '123', 'asd', 'popopo', '5b6b2eba82263c48b546bc28fe5bd0e2.png', 'admin'),
(7, '121212', 'Novianto', 'qweqweqw', '01-Front.jpg', 'admin'),
(8, '909090', 'Nopa', '090909', '34aa547737f255239c39c808d0130905.jpg', 'admin'),
(9, '9999999', 'asp', 'asdasd', '2017-07-23 (1).png', 'admin'),
(10, '123123', 'zxczxc', 'mkmkmk', '861398.png', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id` int(5) NOT NULL,
  `id_item` varchar(15) NOT NULL,
  `id_pic` int(3) NOT NULL,
  `qty` int(15) NOT NULL,
  `tgl` date NOT NULL,
  `tipe` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id`, `id_item`, `id_pic`, `qty`, `tgl`, `tipe`) VALUES
(1, '7', 1, 20, '2017-08-31', 'masuk'),
(2, '7', 1, 5, '2017-08-31', 'keluar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_pic`
--
ALTER TABLE `tbl_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`id_item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_pic`
--
ALTER TABLE `tbl_pic`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
