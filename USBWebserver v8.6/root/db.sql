-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2017 at 01:46 PM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum`
--
CREATE DATABASE IF NOT EXISTS `forum` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `forum`;

-- --------------------------------------------------------

--
-- Table structure for table `komentarji`
--

CREATE TABLE IF NOT EXISTS `komentarji` (
  `ID_Teme` int(5) NOT NULL,
  `ID_Uporabnika` int(4) NOT NULL,
  `cas` datetime NOT NULL,
  `Vsebina` varchar(1042) NOT NULL,
  KEY `ID_Teme` (`ID_Teme`),
  KEY `ID_Uporabnika` (`ID_Uporabnika`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentarji`
--

INSERT INTO `komentarji` (`ID_Teme`, `ID_Uporabnika`, `cas`, `Vsebina`) VALUES
(4, 3, '2017-05-31 03:42:16', 'prvi komentar\r\n'),
(4, 3, '2017-05-31 03:42:21', 'drugi komentar'),
(4, 2, '2017-05-31 03:42:34', 'komentar druge osebe'),
(4, 1, '2017-05-31 03:42:52', 'komnetar anonimne osebe');

-- --------------------------------------------------------

--
-- Table structure for table `teme`
--

CREATE TABLE IF NOT EXISTS `teme` (
  `ID_Teme` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Uporabnika` int(11) NOT NULL,
  `Ime_Teme` varchar(300) NOT NULL,
  `SteviloKomentarjev` int(6) NOT NULL,
  PRIMARY KEY (`ID_Teme`),
  KEY `ID_Uporabnika` (`ID_Uporabnika`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `teme`
--

INSERT INTO `teme` (`ID_Teme`, `ID_Uporabnika`, `Ime_Teme`, `SteviloKomentarjev`) VALUES
(4, 3, 'Test za zagovor', 4);

-- --------------------------------------------------------

--
-- Table structure for table `uporabniki`
--

CREATE TABLE IF NOT EXISTS `uporabniki` (
  `ID_Uporabnika` int(4) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(30) NOT NULL,
  `Geslo` varchar(32) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Slika` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_Uporabnika`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `uporabniki`
--

INSERT INTO `uporabniki` (`ID_Uporabnika`, `Ime`, `Geslo`, `Email`, `Slika`) VALUES
(1, 'Anonymouse', '/', '/', 'default.jpg'),
(2, 'blaz', 'f6b8cc397e810a178d2062ede307bca9', 'blaz@gmail.com', '12088511_1262603883765476_6494297121641743578_n.jpg'),
(3, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@gmail.com', 'army-military-helicopter-animated-gif-13.gif');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentarji`
--
ALTER TABLE `komentarji`
  ADD CONSTRAINT `komentarji_ibfk_1` FOREIGN KEY (`ID_Teme`) REFERENCES `teme` (`ID_Teme`),
  ADD CONSTRAINT `komentarji_ibfk_2` FOREIGN KEY (`ID_Uporabnika`) REFERENCES `uporabniki` (`ID_Uporabnika`);

--
-- Constraints for table `teme`
--
ALTER TABLE `teme`
  ADD CONSTRAINT `teme_ibfk_1` FOREIGN KEY (`ID_Uporabnika`) REFERENCES `uporabniki` (`ID_Uporabnika`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
