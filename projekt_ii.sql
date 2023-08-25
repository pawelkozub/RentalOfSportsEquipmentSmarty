-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 10 Lut 2015, 20:12
-- Wersja serwera: 5.5.21-log
-- Wersja PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `projekt_ii`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=REDUNDANT AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`ID`, `name`) VALUES
(1, 'Rower Górskie Damskie'),
(2, 'Rower Górskie Męskie'),
(3, 'Rower Miejskie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `magazine`
--

CREATE TABLE IF NOT EXISTS `magazine` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_cat` int(11) NOT NULL,
  `prod` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `model` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `cena` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `stan` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=10000013 ;

--
-- Zrzut danych tabeli `magazine`
--

INSERT INTO `magazine` (`ID`, `ID_cat`, `prod`, `model`, `opis`, `cena`, `stan`) VALUES
(10000008, 2, 'HEAD', '24f44s', 'asdf22', '100', 0),
(10000010, 2, 'asdf', 'asdfa', 'sdfas', '123', 0),
(10000011, 1, 'asdf', 'asdfas', 'dfasd', '12', 0),
(10000012, 2, '123f', 'sadfs', 'dfasdf', '234', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rental_office`
--

CREATE TABLE IF NOT EXISTS `rental_office` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_M` int(11) NOT NULL,
  `ID_C` int(11) NOT NULL,
  `Date_w` date NOT NULL,
  `Date_z` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `rental_office`
--

INSERT INTO `rental_office` (`ID`, `ID_M`, `ID_C`, `Date_w`, `Date_z`) VALUES
(6, 10000008, 6, '2014-12-10', '2014-12-21'),
(7, 10000011, 6, '2014-12-11', '2014-12-18'),
(8, 10000012, 6, '2014-12-11', '2014-12-28');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_M` int(11) NOT NULL,
  `ID_C` int(11) NOT NULL,
  `Data_accept` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `reservations`
--

INSERT INTO `reservations` (`ID`, `ID_M`, `ID_C`, `Data_accept`) VALUES
(2, 10000010, 7, '2014-12-22');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(15) COLLATE utf8_polish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `active` int(11) NOT NULL,
  `change_pass` int(11) NOT NULL,
  `key_on` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=22 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `user`, `pass`, `mail`, `active`, `change_pass`, `key_on`) VALUES
(1, 'admin', 'QWRtaW4=', 'noreply@agh.ugu.pl', 1, 1, ''),
(2, 'ymki', 'QWRtaW4=', 'noreply1@agh.ugu.pl', 1, 1, ''),
(21, 'karp', 'QWRtaW4=', 'noreply2@agh.ugu.pl', 1, 1, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_adres`
--

CREATE TABLE IF NOT EXISTS `users_adres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `streets` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `users_adres`
--

INSERT INTO `users_adres` (`ID`, `user`, `name`, `surname`, `streets`, `city`) VALUES
(6, 'karp', 'asdf', 'fasdf', 'dfasdfsd', 'dfasfdsf'),
(7, 'ymki', 'ymki', 'ymki', 'ymki', 'ymki');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
