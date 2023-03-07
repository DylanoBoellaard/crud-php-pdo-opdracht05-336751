-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 07 mrt 2023 om 18:09
-- Serverversie: 5.7.36
-- PHP-versie: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Basicfit`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Inschrijving`
--

DROP TABLE IF EXISTS `Inschrijving`;
CREATE TABLE IF NOT EXISTS `Inschrijving` (
  `inschrijfid` int(11) NOT NULL AUTO_INCREMENT,
  `homeclub` varchar(25) NOT NULL,
  `lidmaatschap` varchar(25) NOT NULL,
  `looptijd` varchar(25) NOT NULL,
  `yanga_water` varchar(50) DEFAULT NULL,
  `coach` varchar(50) DEFAULT NULL,
  `training` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `datum_inschrijving` datetime DEFAULT NULL,
  PRIMARY KEY (`inschrijfid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Inschrijving`
--

INSERT INTO `Inschrijving` (`inschrijfid`, `homeclub`, `lidmaatschap`, `looptijd`, `yanga_water`, `coach`, `training`, `email`, `datum_inschrijving`) VALUES
(1, 'Vestiging 2', 'premium', 'jaarlidmaatschap', 'nee', 'nee', 'nee', 'email@gmail.com', '2023-03-07 16:10:24'),
(3, 'Vestiging 2', 'allin', 'jaarlidmaatschap', 'yanga', 'coach', 'nee', 'email@gmail.com', '2023-03-07 16:16:06'),
(4, 'Vestiging 3', 'comfort', 'on', 'ja', 'nee', 'ja', 'hjshsshs@gmail.com', '2023-03-07 16:34:31'),
(7, 'Vestiging 3', 'allin', 'jaarlidmaatschap', 'nee', 'ja', 'nee', 'eemaiul@gmail.com', '2023-03-07 19:04:02'),
(8, 'Vestiging 3', 'comfort', 'jaarlidmaatschap', 'ja', 'nee', 'ja', 'dsadas@sda.com', '2023-03-07 19:04:30'),
(9, 'Vestiging 3', 'premium', 'jaarlidmaatschap', 'nee', 'ja', 'ja', 'email@gmail.com', '2023-03-07 19:05:18');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Vestiging`
--

DROP TABLE IF EXISTS `Vestiging`;
CREATE TABLE IF NOT EXISTS `Vestiging` (
  `vestigingid` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) NOT NULL,
  `straatnaam` varchar(50) NOT NULL,
  `huisnummer` varchar(50) NOT NULL,
  PRIMARY KEY (`vestigingid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Vestiging`
--

INSERT INTO `Vestiging` (`vestigingid`, `naam`, `straatnaam`, `huisnummer`) VALUES
(1, 'Vestiging 1', 'straatnaam 1', '11'),
(2, 'Vestiging 2', 'examplestreet 2', '22'),
(3, 'Vestiging 3', 'Laan der straten', '3');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
