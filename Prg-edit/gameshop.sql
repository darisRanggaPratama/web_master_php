-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2022 at 02:24 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gameshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `idberita` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `isi` text NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `gambar` varchar(30) NOT NULL,
  PRIMARY KEY (`idberita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `noinvoice` varchar(6) NOT NULL,
  `tanggal` datetime NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `totalbayar` float NOT NULL,
  `transfer` tinyint(1) NOT NULL,
  `tglkirim` datetime DEFAULT NULL,
  PRIMARY KEY (`noinvoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`noinvoice`, `tanggal`, `idpelanggan`, `totalbayar`, `transfer`, `tglkirim`) VALUES
('T00001', '2015-11-24 17:46:17', 4, 7600000, 0, NULL),
('T00002', '2015-11-24 18:20:07', 4, 1160000, 0, NULL),
('T00003', '2015-11-24 19:09:38', 8, 7100000, 0, NULL),
('T00004', '2015-11-24 19:10:01', 8, 500000, 0, '2022-04-09 05:38:16'),
('T00005', '2015-11-24 19:10:05', 8, 500000, 0, NULL),
('T00006', '2015-11-24 19:17:03', 8, 600000, 0, NULL),
('T00007', '2015-11-24 22:35:55', 4, 7600000, 0, NULL),
('T00008', '2015-11-25 09:04:21', 9, 1100000, 0, NULL),
('T00009', '2015-12-09 18:27:51', 9, 7100000, 0, NULL),
('T00010', '2022-04-09 05:32:12', 10, 1050000, 1, '2022-04-09 05:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `idkategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(40) NOT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`) VALUES
(1, 'Console'),
(3, 'PS3 Games'),
(4, 'PS4 Games');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `idpelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) NOT NULL,
  `kelamin` set('L','P') NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kodepos` varchar(6) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `telp` varchar(200) NOT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idpelanggan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama`, `kelamin`, `email`, `alamat`, `kodepos`, `kota`, `telp`, `tanggal_daftar`, `password`, `status`) VALUES
(4, 'Muhammad Ridwan', 'L', 'mr_rid15@gmail.com', 'THB Blok U4/14', '14125', 'bekasi', '085776335003', '2015-11-24', 'aa7b2038f04af0e4e62858a8f805aa64', 1),
(8, 'naufal', 'L', 'mursyidnaufal@gmail.com', '					\r\n		b		', '3', 'bandung', '0898989898', '2015-11-24', '9b10fff33476b792f79cdcce22598a48', 0),
(9, 'Ridwan', 'L', 'ridwan@gmail.com', 'thb u4/14					\r\n				', '14125', 'Bekasi', '085776335003', '2015-11-25', 'a43ae60e8f6bd1411e347a646d7901ca', 0),
(10, 'Yuniar Supardi', 'L', 'yuniarsupardi@yahoo.com', 'Cikole	\r\n				', '43126', 'Sukabumi', '08128829964', '2022-04-09', 'e9a95d775de3c6927aceb3f9ecf661bb', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengelola`
--

CREATE TABLE IF NOT EXISTS `pengelola` (
  `idpengelola` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`idpengelola`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pengelola`
--

INSERT INTO `pengelola` (`idpengelola`, `nama`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'ee61e766467546320854c3446ccde3d4'),
(2, 'Muhammad Ridwan', 'ridwan', 'd584c96e6c1ba3ca448426f66e552e8e');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `idproduk` int(10) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(200) NOT NULL,
  `idkategori` int(255) NOT NULL,
  `deskripsi` text,
  `foto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idproduk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `nama_produk`, `idkategori`, `deskripsi`, `foto`) VALUES
(1, 'Call Of Duty Black Ops 3', 3, '', 'ps3_codbo.jpg'),
(2, 'Fifa 16', 3, '', 'ps3_fifa16.jpg'),
(3, 'NBA2K16', 3, '', 'ps3_nba2k16.jpg'),
(4, 'Pro Evolution Soccer 2016', 3, '', 'ps3_pes2016.jpg'),
(5, 'WWE2K16', 3, '', 'ps3_wwe2k16.jpg'),
(6, 'BloodBorne', 4, '', 'ps4_bb.jpg'),
(7, 'Fallout 4', 4, '', 'ps4_fallout4.jpg'),
(8, 'NBA2K16', 4, '', 'ps4_nba2k15.png'),
(9, 'SAO Lost Song', 4, '', 'ps4_saols.jpg'),
(10, 'PS4 System MGS V Edition', 1, NULL, 'cps4_mgs5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `idstok` int(11) NOT NULL AUTO_INCREMENT,
  `idproduk` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`idstok`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idstok`, `idproduk`, `harga_beli`, `harga_jual`, `jumlah`) VALUES
(1, 1, 530000, 550000, 19),
(2, 2, 480000, 500000, 19),
(3, 3, 580000, 600000, 15),
(4, 4, 520000, 540000, 10),
(5, 5, 580000, 600000, 20),
(6, 6, 730000, 750000, 20),
(7, 7, 640000, 660000, 10),
(8, 8, 590000, 610000, 5),
(9, 9, 770000, 790000, 5),
(10, 10, 6700000, 7100000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `idtransaksi` int(11) NOT NULL AUTO_INCREMENT,
  `noinvoice` varchar(6) NOT NULL,
  `idproduk` int(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`idtransaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `noinvoice`, `idproduk`, `jumlah`) VALUES
(3, 'T00001', 10, 1),
(4, 'T00001', 2, 1),
(5, 'T00002', 2, 1),
(6, 'T00002', 7, 1),
(7, 'T00003', 10, 1),
(8, 'T00004', 2, 1),
(9, 'T00005', 2, 1),
(10, 'T00006', 5, 1),
(11, 'T00007', 10, 1),
(12, 'T00007', 2, 1),
(13, 'T00008', 1, 2),
(14, 'T00009', 10, 1),
(15, 'T00010', 1, 1),
(16, 'T00010', 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
