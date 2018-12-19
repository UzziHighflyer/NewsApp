-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 19, 2018 at 02:29 PM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `korisnici`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

DROP TABLE IF EXISTS `kategorije`;
CREATE TABLE IF NOT EXISTS `kategorije` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `ime`) VALUES
(1, 'Politika'),
(2, 'Sport'),
(3, 'Kultura'),
(4, 'Nauka'),
(5, 'Muzika'),
(6, 'Tehnologija'),
(7, 'Crna hronika');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vest` int(11) NOT NULL,
  `korisnik` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `korisnik_slika` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `sadrzaj` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `vest`, `korisnik`, `korisnik_id`, `korisnik_slika`, `sadrzaj`, `datum`) VALUES
(1, 4, 'Admin', 0, 'slika.jpg', 'Nepozeljni komentari ce biti filtrirani i izbrisani.', '2018-04-05 13:22:49'),
(5, 5, 'Uros Jovanovic', 3, 'B-SeyZ8IMAEUnQo.jpg', 'Ronaldo > Messi', '2018-04-05 13:38:00'),
(6, 4, 'Uros Jovanovic', 3, 'B-SeyZ8IMAEUnQo.jpg', 'Sve to Ameri....', '2018-04-05 13:38:13'),
(8, 4, 'Emilija Kocic', 4, 'emica31.jpg', 'Volim te Urose..\r\nKo brata.', '2018-06-03 15:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `fname`, `lname`, `email`, `password`, `image`) VALUES
(3, 'Uros', 'Jovanovic', 'cxturosh@gmail.com', '$2y$10$4FIgjB15fasPjhWETgrVD.KZFm3wpkcvwWgacLCWV9fPWa86DSYIG', 'B-SeyZ8IMAEUnQo.jpg'),
(4, 'Emilija', 'Kocic', 'emilykocic14@gmail.com', '$2y$10$cTLBZetd0QdVxVuSvcyG5OGsLRtBrGhZ2KvxjF.uk/t/UmCUovDrq', 'emica31.jpg'),
(5, 'Milan', 'Petrovic', 'milanpetro73@gmail.com', '$2y$10$U8PNqMX87lUWLz4sGvgAgeJed3M1PFiKgnownBvLEGt4BoG1TaAYO', 'slika.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

DROP TABLE IF EXISTS `vesti`;
CREATE TABLE IF NOT EXISTS `vesti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slika` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `naslov` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `kategorija` int(11) NOT NULL,
  `tekst` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`id`, `slika`, `naslov`, `kategorija`, `tekst`, `datum`) VALUES
(4, 'djuric.jpg', 'Marko Djuric uhapsen na severu Kosova', 1, 'Pripadnici specijalne jedinice Kosovske policije uhapsili su direktora Kancelarije za KiM Marka ÄuriÄ‡a u Kosovskoj Mitrovici i sproveli ga na ispitivanje u policijsku stanicu u PriÅ¡tini, nakon Äega je proteran sa Kosova. Srpska policija preuzela je Marka ÄuriÄ‡a. RTS je javio da su prethodno okupljeni ispred MitrovaÄkog dvora, gde je trebalo da se odrÅ¾i okrugli sto o unutraÅ¡njem dijalogu, oterani suzavcem, dok KoSSev navodi da je kosovska policija bacila suzavac i ispred sale i u samoj sali.\r\n\r\nÄuriÄ‡ je veÄeras proteran sa Kosova, nakon Äega ga je na prelazu Merdare preuzela srpska policija.\r\n\r\nPredsednik VuÄiÄ‡ najavio je veÄeras da Ä‡e odgovarati svi koji su uÄestvovali u \"otmici Marka ÄuriÄ‡a\", meÄ‘u kojima su i dve osobe srpske nacionalnosti.', '2018-04-05 13:21:09'),
(5, 'ronaldo.jpg', 'Kristiano ronaldo \"makazicama\" resio Juventus', 2, 'NogometaÅ¡ Real Madrida Cristiano Ronaldo postigao je fantastiÄan pogodak makazicama za vodstvo svoje ekipe na Allianz Stadionu protiv Juventusa od 2:0.\r\nRonaldo je u treÄ‡oj minuti doveo svoju ekipu u vodstvo, a u drugom poluvremenu postigao je fantastiÄan gol kojim je faktiÄki odluÄio pitanje prolaznika u polufinale Lige prvaka.\r\n\r\nOn je doÄekao centarÅ¡ut Carajala s desne strane, a onda sjajnim akrobatskim udarcem makazicama matira nemoÄ‡nog Buffona za 2:0. Ronaldo je postao prvi igraÄ u historiji koji je postigao gol na deset uzastopnih utakmica u Ligi prvaka.\r\n\r\nNakon dva gola gola protiv Juventusa u finalu proÅ¡logodiÅ¡njeg izdanja Lige prvaka, Ronaldo je redom postigao dva pogotka protiv APOEL-a, dva protiv Dortmunda, jedan protiv Tottenhama, opet jedan na Wembleyju, dva protiv APOEL-a, jedan protiv Borussije i dva u prvom i jedan u drugom susretu protiv PSG-a.', '2018-04-05 13:27:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
