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
-- Struktura tabeli dla tabeli `meals`
--

CREATE TABLE IF NOT EXISTS `meals` (
`id` int(10) unsigned NOT NULL,
  `food_id` int(11) NOT NULL,
  `planed` int(1) DEFAULT NULL,
  `weight` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=199 ;

--
-- Zrzut danych tabeli `meals`
--

INSERT INTO `meals` (`id`, `food_id`, `planed`, `weight`, `user_id`, `date`, `comment`, `created_at`, `updated_at`) VALUES
(2, 13, NULL, 15, 1, '2015-07-13', 'Łyżka', '2015-07-13 15:42:33', '2015-07-13 21:42:36'),
(3, 12, NULL, 30, 1, '2015-07-14', 'jeden batonik', '2015-07-14 13:31:01', '2015-07-14 13:41:11'),
(5, 23, NULL, 100, 1, '2015-07-14', 'mleko do kawy', '2015-07-14 14:38:35', '2015-07-14 14:38:35'),
(6, 17, NULL, 120, 1, '2015-07-15', 'średni banan', '2015-07-15 15:04:53', '2015-07-15 15:04:53'),
(7, 23, NULL, 100, 1, '2015-07-16', 'szklanka 250 ml', '2015-07-16 16:53:54', '2015-07-16 16:53:54'),
(8, 2, NULL, 112, 1, '2015-07-16', 'dwa jajka', '2015-07-16 16:57:31', '2015-07-16 16:57:31'),
(12, 3, NULL, 10, 1, '2015-07-16', 'łyżeczka', '2015-07-16 17:04:53', '2015-07-16 17:04:53'),
(15, 18, NULL, 99, 1, '2015-07-17', '3 kromki', '2015-07-17 13:14:53', '2015-07-17 13:14:53'),
(21, 3, NULL, 20, 1, '2015-07-17', 'Łyżka', '2015-07-17 14:10:43', '2015-07-17 14:10:43'),
(32, 2, NULL, 60, 1, '2015-07-17', 'Łyżka', '2015-07-17 14:47:15', '2015-07-17 14:47:15'),
(34, 23, NULL, 200, 1, '2015-07-17', 'szklanka', '2015-07-17 14:50:25', '2015-07-17 14:50:25'),
(41, 19, NULL, 28, 1, '2015-07-18', 'morning owsianka', '2015-07-18 09:05:50', '2015-07-18 09:05:50'),
(42, 19, NULL, 25, 2, '2015-07-18', 'owsianka rano', '2015-07-18 09:45:50', '2015-07-18 09:45:50'),
(43, 23, NULL, 120, 2, '2015-07-18', '4 x 30g lycha', '2015-07-18 09:47:51', '2015-07-18 09:47:51'),
(44, 23, NULL, 130, 1, '2015-07-18', ' 5 x 30g lycha? ok?', '2015-07-18 09:49:20', '2015-07-18 09:49:20'),
(45, 20, NULL, 100, 1, '2015-07-19', 'estimated', '2015-07-19 09:38:13', '2015-07-19 09:38:13'),
(46, 20, NULL, 100, 1, '2015-07-19', 'estimated', '2015-07-19 09:38:28', '2015-07-19 09:38:28'),
(47, 20, NULL, 100, 1, '2015-07-19', 'estimated', '2015-07-19 09:39:03', '2015-07-19 09:39:03'),
(53, 21, NULL, 70, 1, '2015-07-20', 'dwie', '2015-07-20 09:28:17', '2015-07-20 09:28:17'),
(54, 18, NULL, 66, 1, '2015-07-20', 'dwieasdf', '2015-07-20 09:29:15', '2015-07-20 17:52:26'),
(55, 19, NULL, 30, 1, '2015-07-21', '2 łyżki', '2015-07-21 11:15:05', '2015-07-21 11:15:05'),
(56, 23, NULL, 200, 1, '2015-07-21', 'szklanka do owsianki', '2015-07-21 11:15:28', '2015-07-21 11:15:28'),
(57, 17, NULL, 100, 1, '2015-07-21', '-', '2015-07-21 11:15:38', '2015-07-21 11:15:38'),
(58, 24, NULL, 95, 1, '2015-07-21', 'jedno duże', '2015-07-21 11:15:58', '2015-07-21 11:15:58'),
(59, 3, NULL, 10, 1, '2015-07-21', 'dwie łyżeczki do kawy', '2015-07-21 11:16:22', '2015-07-21 11:16:22'),
(60, 23, NULL, 300, 1, '2015-07-21', 'do dwoch kaw', '2015-07-21 11:16:32', '2015-07-21 11:16:32'),
(61, 18, NULL, 66, 1, '2015-07-21', 'dwie kromki', '2015-07-21 11:49:13', '2015-07-21 11:49:13'),
(62, 25, NULL, 20, 1, '2015-07-21', 'do dwóch kromek', '2015-07-21 11:51:23', '2015-07-21 11:51:23'),
(63, 26, NULL, 90, 1, '2015-07-21', 'do kanapek', '2015-07-21 11:53:54', '2015-07-21 11:53:54'),
(64, 3, NULL, 10, 1, '2015-07-20', 'dwie łyżeczki', '2015-07-21 15:56:46', '2015-07-21 15:56:46'),
(66, 18, NULL, 66, 1, '2015-07-22', 'dwie ', '2015-07-22 08:16:37', '2015-07-22 08:16:37'),
(67, 2, NULL, 112, 1, '2015-07-22', 'dwa', '2015-07-22 08:17:22', '2015-07-22 08:17:22'),
(68, 25, NULL, 20, 1, '2015-07-22', '-', '2015-07-22 08:18:38', '2015-07-22 08:18:38'),
(69, 23, NULL, 150, 1, '2015-07-22', 'w kawie', '2015-07-22 08:20:41', '2015-07-22 08:20:41'),
(70, 3, NULL, 5, 1, '2015-07-22', 'kawa', '2015-07-22 08:20:56', '2015-07-22 08:20:56'),
(71, 27, NULL, 450, 1, '2015-07-22', 'całe opakowanie', '2015-07-22 14:38:57', '2015-07-22 14:38:57'),
(72, 2, NULL, 58, 1, '2015-07-18', 'Jajko M', '2015-07-23 11:51:27', '2015-07-23 11:51:27'),
(73, 23, NULL, 100, 1, '2015-07-15', 'do kawy', '2015-07-15 15:04:53', '2015-07-15 15:04:53'),
(74, 19, NULL, 30, 1, '2015-07-23', '-', '2015-07-23 14:25:13', '2015-07-23 14:25:13'),
(75, 23, NULL, 200, 1, '2015-07-23', 'do owsianki', '2015-07-23 14:25:28', '2015-07-23 14:25:28'),
(76, 34, NULL, 105, 1, '2015-07-23', '100g mleko i 5g cukier', '2015-07-23 14:25:59', '2015-07-23 14:25:59'),
(77, 23, NULL, 100, 1, '2015-07-23', 'do kawy bez cukru', '2015-07-23 14:26:17', '2015-07-23 14:26:17'),
(78, 35, NULL, 150, 1, '2015-07-23', 'małe opakowanie', '2015-07-23 14:29:23', '2015-07-23 14:29:23'),
(79, 36, NULL, 100, 1, '2015-07-23', 'jedno', '2015-07-23 14:39:54', '2015-07-23 14:39:54'),
(80, 3, NULL, 0, 1, '2015-07-24', 'fasdfa', '2015-07-24 17:53:04', '2015-07-24 17:53:04'),
(81, 3, NULL, 1, 1, '2015-07-24', '', '2015-07-24 17:53:07', '2015-07-24 17:53:07'),
(82, 50, NULL, 15, 1, '2015-07-25', '25', '2015-07-25 11:27:07', '2015-07-25 11:27:07'),
(83, 63, NULL, 290, 1, '2015-07-27', 'pół słoika', '2015-07-27 14:16:28', '2015-07-27 14:16:28'),
(84, 18, NULL, 99, 1, '2015-07-27', 'trzy', '2015-07-27 14:16:44', '2015-07-27 16:07:13'),
(85, 34, NULL, 210, 1, '2015-07-27', 'dwie', '2015-07-27 14:17:07', '2015-07-27 14:17:07'),
(86, 17, NULL, 120, 1, '2015-07-28', '---', '2015-07-28 15:23:02', '2015-07-28 15:57:15'),
(87, 24, 0, 60, 1, '2015-07-28', 'małe', '2015-07-28 16:16:04', '2015-07-29 13:31:37'),
(88, 18, 0, 33, 1, '2015-07-28', 'kromka', '2015-07-28 16:17:17', '2015-07-28 16:17:17'),
(94, 73, 0, 90, 1, '2015-07-29', 'trzy kromki', '2015-07-29 13:47:40', '2015-07-29 13:47:40'),
(95, 34, 0, 210, 1, '2015-07-29', 'dwie', '2015-07-29 13:47:58', '2015-07-29 13:47:58'),
(96, 25, 0, 20, 1, '2015-07-29', 'do kanapek', '2015-07-29 13:48:46', '2015-07-29 13:48:46'),
(97, 74, 0, 30, 1, '2015-07-29', 'dwie łyżeczki', '2015-07-29 13:51:53', '2015-07-29 13:51:53'),
(98, 75, 0, 25, 1, '2015-07-29', 'na dwie kromki', '2015-07-29 13:54:47', '2015-07-29 13:54:47'),
(100, 24, 1, 65, 1, '2015-07-29', 'jedno małe', '2015-07-29 13:56:17', '2015-07-29 13:56:17'),
(101, 2, NULL, 108, 1, '2015-07-30', 'dwa', '2015-07-30 07:14:17', '2015-07-30 09:33:51'),
(102, 73, 0, 30, 1, '2015-07-30', 'kromka', '2015-07-30 09:34:17', '2015-07-30 09:34:17'),
(103, 34, NULL, 315, 1, '2015-07-30', 'trzy', '2015-07-30 09:34:30', '2015-07-30 17:24:54'),
(104, 77, 0, 5, 1, '2015-07-30', 'łyżeczka', '2015-07-30 09:36:35', '2015-07-30 09:36:35'),
(105, 78, 0, 150, 1, '2015-07-30', 'do sałatki', '2015-07-30 09:38:34', '2015-07-30 09:38:34'),
(107, 79, NULL, 350, 1, '2015-07-30', 'trzy duże ziemniaki', '2015-07-30 10:31:23', '2015-07-30 12:58:03'),
(108, 82, 0, 250, 1, '2015-07-30', '1/4 całości sosu', '2015-07-30 10:39:10', '2015-07-30 12:57:14'),
(109, 83, 0, 170, 1, '2015-07-30', '4 małe', '2015-07-30 12:57:28', '2015-07-30 12:57:28'),
(111, 34, 0, 210, 1, '2015-07-31', 'dwie', '2015-07-31 09:32:38', '2015-07-31 10:21:52'),
(113, 73, 0, 60, 1, '2015-07-31', 'dwie kromki', '2015-07-31 09:33:04', '2015-07-31 10:25:51'),
(114, 76, 0, 20, 1, '2015-07-31', 'do chleba', '2015-07-31 10:26:26', '2015-07-31 10:26:26'),
(115, 74, 0, 55, 1, '2015-07-31', 'do chleba', '2015-07-31 10:26:47', '2015-07-31 10:26:47'),
(116, 84, 0, 260, 1, '2015-07-31', 'jedna sztuka', '2015-07-31 10:30:58', '2015-07-31 15:59:19'),
(117, 34, 0, 105, 1, '2015-07-31', '-', '2015-07-31 15:59:37', '2015-07-31 15:59:37'),
(118, 73, 0, 60, 1, '2015-07-31', 'dwie', '2015-07-31 16:59:56', '2015-07-31 16:59:56'),
(119, 49, 0, 200, 1, '2015-07-31', 'jeden', '2015-07-31 17:00:19', '2015-07-31 17:00:19'),
(120, 77, 0, 10, 1, '2015-07-31', '-', '2015-07-31 17:00:34', '2015-07-31 17:00:34'),
(121, 76, 0, 20, 1, '2015-07-31', 'do burgerów', '2015-07-31 17:00:50', '2015-07-31 17:00:50'),
(122, 85, 0, 25, 1, '2015-07-31', 'łyżka', '2015-07-31 17:03:40', '2015-07-31 17:03:40'),
(123, 73, 0, 80, 1, '2015-08-04', 'dwie kromki', '2015-08-04 11:45:11', '2015-08-04 11:45:11'),
(124, 89, 0, 40, 1, '2015-08-04', '-', '2015-08-04 11:45:22', '2015-08-04 11:45:22'),
(125, 2, 0, 112, 1, '2015-08-04', 'dwa', '2015-08-04 11:45:33', '2015-08-04 11:45:33'),
(126, 34, 0, 210, 1, '2015-08-04', 'dwie', '2015-08-04 11:45:44', '2015-08-04 11:45:44'),
(127, 25, 0, 30, 1, '2015-08-04', '-', '2015-08-04 11:46:06', '2015-08-04 11:46:06'),
(128, 70, 0, 20, 1, '2015-08-04', '-', '2015-08-04 11:46:32', '2015-08-04 11:46:32'),
(129, 34, 0, 105, 1, '2015-08-04', 'jedna', '2015-08-04 15:12:46', '2015-08-04 15:12:46'),
(131, 19, 0, 30, 1, '2015-08-05', 'two spoons', '2015-08-05 09:51:02', '2015-08-05 09:51:02'),
(132, 17, 0, 50, 1, '2015-08-05', 'pół', '2015-08-05 09:51:21', '2015-08-05 09:51:21'),
(133, 91, 0, 10, 1, '2015-08-05', 'łyżeczka', '2015-08-05 09:54:07', '2015-08-05 09:54:07'),
(134, 34, 0, 210, 1, '2015-08-05', 'dwie', '2015-08-05 09:54:19', '2015-08-05 09:54:19'),
(135, 17, 0, 100, 1, '2015-08-04', 'jeden', '2015-08-05 09:54:49', '2015-08-05 09:54:49'),
(136, 12, 0, 30, 1, '2015-08-04', 'jeden', '2015-08-05 09:55:35', '2015-08-05 09:55:35'),
(137, 90, 0, 115, 1, '2015-08-04', 'jedna', '2015-08-05 09:56:26', '2015-08-05 09:56:26'),
(138, 92, 0, 60, 1, '2015-08-04', 'jeden', '2015-08-05 10:00:01', '2015-08-05 10:00:01'),
(139, 84, 0, 260, 1, '2015-08-05', '-', '2015-08-05 13:23:15', '2015-08-05 13:23:15'),
(140, 68, 0, 500, 1, '2015-08-05', 'porcja', '2015-08-05 14:29:39', '2015-08-05 14:29:39'),
(141, 2, 0, 100, 1, '2015-08-06', 'dwa', '2015-08-06 09:08:34', '2015-08-06 09:08:34'),
(142, 73, 0, 123, 1, '2015-08-06', 'trzy małe kromki', '2015-08-06 09:08:50', '2015-08-06 09:08:50'),
(143, 78, 0, 87, 1, '2015-08-06', '8 sztuk', '2015-08-06 09:09:12', '2015-08-06 09:09:12'),
(144, 25, 0, 20, 1, '2015-08-06', '-', '2015-08-06 09:09:27', '2015-08-06 09:09:27'),
(145, 34, 0, 210, 1, '2015-08-06', '-', '2015-08-06 09:09:39', '2015-08-06 15:55:21'),
(146, 90, 0, 115, 1, '2015-08-06', 'jedna', '2015-08-06 15:55:05', '2015-08-06 15:55:05'),
(147, 93, 0, 70, 1, '2015-08-06', 'jedna duża czerwona', '2015-08-06 15:57:35', '2015-08-06 15:57:35'),
(148, 34, 1, 105, 1, '2015-08-06', 'wieczorna kawa', '2015-08-06 15:57:50', '2015-08-06 15:57:50'),
(149, 95, 0, 100, 1, '2015-08-07', 'dwie', '2015-08-07 10:00:03', '2015-08-07 10:00:03'),
(150, 34, 0, 105, 1, '2015-08-07', 'jedna', '2015-08-07 10:00:14', '2015-08-07 10:00:14'),
(152, 34, 1, 105, 1, '2015-08-07', '-', '2015-08-07 10:00:34', '2015-08-07 10:00:34'),
(153, 3, 0, 1, 3, '2015-08-09', 'a', '2015-08-09 10:04:40', '2015-08-09 10:04:40'),
(154, 3, 0, 5, 3, '2015-08-09', '', '2015-08-09 10:05:36', '2015-08-09 10:05:36'),
(158, 19, 0, 35, 1, '2015-08-11', 'saszetka', '2015-08-11 07:39:18', '2015-08-11 07:39:18'),
(159, 34, 0, 105, 1, '2015-08-11', '-', '2015-08-11 07:39:27', '2015-08-11 07:39:27'),
(160, 23, 0, 200, 1, '2015-08-11', '-', '2015-08-11 07:40:31', '2015-08-11 07:40:31'),
(162, 84, 0, 260, 1, '2015-08-11', 'jeden', '2015-08-11 07:41:09', '2015-08-11 18:00:03'),
(163, 34, 0, 105, 1, '2015-08-11', 'południowa', '2015-08-11 07:41:27', '2015-08-11 18:00:00'),
(164, 2, 0, 112, 1, '2015-08-11', 'dwa', '2015-08-11 07:41:56', '2015-08-11 17:59:55'),
(165, 18, 0, 99, 1, '2015-08-11', 'trzy', '2015-08-11 18:00:20', '2015-08-11 18:00:20'),
(166, 34, 1, 105, 1, '2015-08-11', '-', '2015-08-11 18:00:40', '2015-08-11 18:00:40'),
(167, 75, 0, 35, 1, '2015-08-11', '-', '2015-08-11 18:01:21', '2015-08-11 18:01:21'),
(169, 2, 0, 168, 2, '2015-08-11', 'trzy', '2015-08-11 18:27:49', '2015-08-11 18:27:49'),
(170, 18, 0, 33, 2, '2015-08-11', 'jedna', '2015-08-11 18:29:01', '2015-08-11 18:29:01'),
(171, 75, 0, 15, 2, '2015-08-11', 'do kanapki', '2015-08-11 18:35:19', '2015-08-11 18:35:19'),
(172, 78, 0, 100, 1, '2015-08-11', '', '2015-08-11 18:48:20', '2015-08-11 18:48:20'),
(173, 77, 0, 10, 1, '2015-08-11', '', '2015-08-11 18:49:08', '2015-08-11 18:49:08'),
(174, 34, 0, 315, 1, '2015-08-12', 'trzy', '2015-08-12 18:58:36', '2015-08-12 18:58:36'),
(175, 18, 0, 33, 1, '2015-08-12', '', '2015-08-12 18:58:46', '2015-08-12 18:58:46'),
(176, 2, 0, 224, 1, '2015-08-12', '-', '2015-08-12 18:59:00', '2015-08-12 18:59:00'),
(177, 64, 0, 10, 1, '2015-08-12', '', '2015-08-12 18:59:37', '2015-08-12 18:59:37'),
(179, 19, 0, 35, 1, '2015-08-13', '', '2015-08-13 10:26:27', '2015-08-13 10:26:27'),
(181, 19, 0, 35, 2, '2015-08-13', 'owsianka', '2015-08-13 11:35:24', '2015-08-13 11:35:24'),
(182, 23, 0, 200, 2, '2015-08-13', '', '2015-08-13 11:36:54', '2015-08-13 11:36:54'),
(183, 34, 0, 105, 2, '2015-08-13', '', '2015-08-13 11:38:11', '2015-08-13 11:38:11'),
(184, 18, 0, 33, 2, '2015-08-13', '', '2015-08-13 11:38:38', '2015-08-13 11:38:38'),
(185, 23, 0, 200, 1, '2015-08-13', '-', '2015-08-13 11:43:10', '2015-08-13 11:43:10'),
(187, 18, 0, 66, 1, '2015-08-13', '', '2015-08-13 12:59:05', '2015-08-13 12:59:05'),
(190, 34, 0, 105, 1, '2015-08-13', '', '2015-08-13 14:00:29', '2015-08-13 16:22:35'),
(196, 3, 0, 22, 1, '2015-08-13', '', '2015-08-13 14:17:41', '2015-08-13 14:17:41'),
(197, 34, 0, 105, 1, '2015-08-13', '', '2015-08-13 16:22:56', '2015-08-13 16:22:56'),
(198, 34, 0, 105, 2, '2015-08-13', '', '2015-08-13 16:23:11', '2015-08-13 16:23:11');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `meals`
--
ALTER TABLE `meals`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=199;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;