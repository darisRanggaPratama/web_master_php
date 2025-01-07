-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2022 at 06:52 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('yuniar', 'yuniar2022');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `IDNILAI` int(9) NOT NULL AUTO_INCREMENT,
  `Nip` varchar(10) NOT NULL,
  `Nis` varchar(7) NOT NULL,
  `mk` varchar(30) NOT NULL,
  `nilai` int(5) NOT NULL,
  `tglujian` varchar(10) NOT NULL,
  `ketujian` enum('UTS','UAS') NOT NULL,
  PRIMARY KEY (`IDNILAI`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`IDNILAI`, `Nip`, `Nis`, `mk`, `nilai`, `tglujian`, `ketujian`) VALUES
(1, '1111111', '1111111', 'Pemrograman Web 1', 91, '25/10/2021', 'UAS'),
(2, '2222222', '1111111', 'Struktur Data', 75, '25/10/2021', 'UTS');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `Nip` varchar(7) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Umur` int(11) NOT NULL,
  `Seks` enum('Pria','Wanita') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`Nip`, `Nama`, `Umur`, `Seks`) VALUES
('1111111', 'Arif Rahman', 32, 'Pria'),
('2222222', 'Rahmat Hidayat', 40, 'Pria');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `Nis` varchar(10) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Umur` int(3) NOT NULL,
  `Seks` enum('Pria','Wanita') NOT NULL,
  PRIMARY KEY (`Nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`Nis`, `Nama`, `Umur`, `Seks`) VALUES
('1111111111', 'Ganesha N', 23, 'Pria'),
('2222222222', 'Zumastina Noor', 11, 'Wanita');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
