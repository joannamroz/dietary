-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Sie 2015, 23:13
-- Wersja serwera: 5.6.20
-- Wersja PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `homestead`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
`id` int(10) unsigned NOT NULL,
  `food_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Zrzut danych tabeli `ingredients`
--

INSERT INTO `ingredients` (`id`, `food_id`, `ingredient_id`, `user_id`, `weight`, `created_at`, `updated_at`) VALUES
(4, 54, 50, 1, 150, '2015-07-24 17:35:03', '2015-07-24 17:35:03'),
(5, 54, 51, 1, 275, '2015-07-24 17:35:03', '2015-07-24 17:35:03'),
(6, 54, 3, 1, 40, '2015-07-24 17:35:03', '2015-07-24 17:35:03'),
(7, 54, 52, 1, 25, '2015-07-24 17:35:03', '2015-07-24 17:35:03'),
(8, 62, 2, 1, 25, '2015-07-24 17:49:32', '2015-07-24 17:49:32'),
(9, 62, 3, 1, 25, '2015-07-24 17:49:32', '2015-07-24 17:49:32'),
(10, 68, 49, 1, 240, '2015-07-27 16:24:43', '2015-07-27 16:24:43'),
(11, 68, 65, 1, 47, '2015-07-27 16:24:43', '2015-07-27 16:24:43'),
(12, 68, 66, 1, 105, '2015-07-27 16:24:43', '2015-07-27 16:24:43'),
(13, 68, 64, 1, 20, '2015-07-27 16:24:43', '2015-07-27 16:24:43'),
(14, 68, 67, 1, 100, '2015-07-27 16:24:43', '2015-07-27 16:24:43'),
(15, 68, 27, 1, 450, '2015-07-27 16:24:43', '2015-07-27 16:24:43'),
(22, 82, 64, 1, 30, '2015-07-30 10:36:04', '2015-07-30 10:36:04'),
(23, 82, 49, 1, 450, '2015-07-30 10:36:04', '2015-07-30 10:36:04'),
(24, 82, 66, 1, 65, '2015-07-30 10:36:04', '2015-07-30 10:36:04'),
(25, 82, 65, 1, 150, '2015-07-30 10:36:04', '2015-07-30 10:36:04'),
(26, 82, 81, 1, 30, '2015-07-30 10:36:05', '2015-07-30 10:36:05'),
(27, 82, 69, 1, 100, '2015-07-30 10:36:05', '2015-07-30 10:36:05');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ingredients`
--
ALTER TABLE `ingredients`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
