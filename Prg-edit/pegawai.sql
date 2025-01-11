-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2022 at 01:50 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `nip` varchar(10) NOT NULL DEFAULT '',
  `nama` varchar(30) NOT NULL DEFAULT '',
  `tgllahir` date NOT NULL DEFAULT '0000-00-00',
  `jenkel` enum('0','1') NOT NULL DEFAULT '0',
  `alamat` text NOT NULL,
  `namafoto` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`nip`),
  UNIQUE KEY `nim` (`nip`),
  KEY `nim_2` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `tgllahir`, `jenkel`, `alamat`, `namafoto`) VALUES
('9999999999', 'Ganesha Noor', '1970-01-01', '0', 'Cikiray', 'yun1.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
