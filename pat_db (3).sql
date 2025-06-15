-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2025 at 02:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pat_db`
--

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `criterium`, `max_waarde`, `min_waarde`, `evaluatie_id`) VALUES
(1, 'Test', 10.00, 0.00, 1),
(2, 'test', 10.00, 0.00, 2),
(3, 'test2', 10.00, 0.00, 2);

--
-- Dumping data for table `docenten_vakken`
--

INSERT INTO `docenten_vakken` (`docent_id`, `vak_id`) VALUES
(1, 1);

--
-- Dumping data for table `evaluaties`
--

INSERT INTO `evaluaties` (`id`, `titel`, `beschrijving`, `deadline`, `vak_id`) VALUES
(1, 'Test', 'een test', '2025-06-21 03:03:00', 1),
(2, 'Opdracht 2 - Peer evaluatie', 'test', '2025-12-31 00:03:00', 1);

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `r_nummer`, `voornaam`, `achternaam`, `email`, `password`, `rol_id`) VALUES
(1, NULL, 'do', 'docent', 'docent@mail.com', '$2y$12$GbPqjDwKHdSQM/BEnB7DFePWwOp0hNDbK.rX5P1dmy/j62f46JS6q', 2),
(2, 'q0448776', 'Chee Chung', 'Lum', 'cheechung.lum@student.odisee.be', '', 1),
(3, 'q0504281', 'Sam', 'De Lombaert', 'sam.delombaert@student.odisee.be', '', 1),
(4, 'q0768961', 'Roman', 'Bereznev', 'roman.bereznev@student.odisee.be', '', 1),
(5, 'q1231099', 'Sergon', 'Begtas', 'sergon.begtas@student.odisee.be', '', 1),
(6, 'q1275557', 'Elodie', 'Cannon', 'elodie.cannon@student.odisee.be', '', 1),
(7, 'q1340830', 'Aikarose', 'Mwasha', 'aikarose.mwasha@student.odisee.be', '', 1),
(8, 'q1381305', 'Ilias', 'Touzani', 'ilias.touzani@student.odisee.be', '', 1),
(9, 'q1416830', 'Mohammad', 'Rahmanzai', 'mohammad.rahmanzai@student.odisee.be', '', 1),
(10, 'q1433199', 'Cindy', 'Vo', 'cindy.vo@student.odisee.be', '', 1),
(11, 'q1448158', 'Sohane', 'Chehboune', 'sohane.chehboune@student.odisee.be', '', 1),
(12, 'q1452692', 'Marwan', 'Saidi', 'marwan.saidi@student.odisee.be', '', 1),
(13, 'q1468530', 'Oumaima', 'Ahmiti', 'oumaima.ahmiti@student.odisee.be', '', 1),
(14, 'q1487698', 'Yassir', 'Benamar', 'yassir.benamar@student.odisee.be', '', 1),
(15, 'q1494194', 'Senne', 'Van Mol', 'senne.vanmol@student.odisee.be', '', 1),
(16, 'q1510044', 'Alex', 'Vandenwyngaert', 'alex.vandenwyngaert@student.odisee.be', '', 1),
(17, 'q1532488', 'Zakariya-Aymane', 'Amhaouch', 'zakariyaaymane.amhaouch@student.odisee.be', '', 1),
(18, 'q1532544', 'Arham', 'Qureshi', 'arham.qureshi@student.odisee.be', '', 1),
(19, 'q1539121', 'Lawrence', 'Cuizon', 'lawrence.cuizon@student.odisee.be', '', 1),
(20, 'q1549671', 'Erhan', 'Manav', 'erhan.manav@student.odisee.be', '', 1),
(21, 'q1552448', 'Tim', 'Vanheerswynghels', 'tim.vanheerswynghels@student.odisee.be', '', 1),

INSERT INTO `groepen` (`id`, `naam`, `vak_id`, `evaluatie_id`) VALUES
(1, 'Groep 1', 1, 1),
(2, 'Groep 2', 1, 1),
(3, 'Groep 3', 1, 1),
(4, 'Groep 4', 1, 1),
(5, 'Groep 5', 1, 1),
(6, 'Groep 6', 1, 1),
(7, 'Groep 7', 1, 1),
(8, 'Groep 8', 1, 1),
(9, 'Groep 9', 1, 1),
(10, 'Groep 10', 1, 1),
(11, 'Groep 11', 1, 1),
(12, 'Groep 12', 1, 1),
(13, 'Groep 1', 1, 2),
(14, 'Groep 2', 1, 2),
(15, 'Groep 3', 1, 2),
(16, 'Groep 4', 1, 2),
(17, 'Groep 5', 1, 2),
(18, 'Groep 6', 1, 2),
(19, 'Groep 7', 1, 2);

--
-- Dumping data for table `klassen`
--

INSERT INTO `klassen` (`id`, `naam`, `vak_id`) VALUES
(1, 'Lol', 1);

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_06_04_214807_create_personal_access_tokens_table', 1),
(4, '2025_06_14_221848_create_password_reset_tokens_table', 2);

--
-- Dumping data for table `rollen`
--

INSERT INTO `rollen` (`id`, `naam`) VALUES
(1, 'student'),
(2, 'docent');

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`criterium_id`, `student_id_geevalueerd`, `student_id_evalueert`, `score`, `feedback`, `gescoord_op`) VALUES
(1, 7, 139, 10.00, NULL, '2025-06-15 01:30:37'),
(1, 8, 139, 10.00, NULL, '2025-06-14 23:02:29'),
(1, 21, 139, 10.00, NULL, '2025-06-14 23:02:36'),
(1, 24, 139, 10.00, NULL, '2025-06-14 23:11:26'),
(1, 39, 139, 10.00, NULL, '2025-06-14 23:02:54'),
(1, 43, 139, 10.00, NULL, '2025-06-14 23:03:01'),
(1, 96, 139, 10.00, NULL, '2025-06-14 23:03:09'),
(1, 97, 139, 10.00, NULL, '2025-06-14 23:03:17'),
(1, 127, 139, 10.00, NULL, '2025-06-14 23:03:24'),
(1, 132, 139, 10.00, NULL, '2025-06-14 23:03:32'),
(1, 135, 139, 10.00, NULL, '2025-06-14 23:10:00');

--
-- Dumping data for table `studenten_groepen`
--

INSERT INTO `studenten_groepen` (`student_id`, `groep_id`) VALUES
(2, 1),
(2, 13),
(3, 5),
(3, 13),
(4, 12),
(4, 13),
(5, 4),
(5, 14),
(6, 5),
(6, 14),
(7, 2),
(7, 14),
(8, 2),
(8, 15),
(9, 5),
(9, 15),
(10, 1),
(10, 15),
(11, 1),
(11, 13),
(12, 9),
(12, 14),
(13, 9),
(13, 15),
(14, 7),
(14, 16),
(15, 3),
(15, 16),
(16, 4),
(16, 16),
(17, 8),
(17, 16),
(18, 1),
(18, 17),
(19, 10),
(19, 13),
(20, 6),
(20, 16),
(21, 2),
(21, 18),
(22, 3),
(22, 19),
(23, 3),
(23, 17),
(24, 2),
(24, 18),
(25, 12),
(25, 16),
(26, 5),
(26, 15),
(27, 10),
(27, 13),
(28, 7),
(28, 18),
(29, 3),
(29, 19),
(30, 11),
(30, 18),
(31, 12),
(31, 13),
(32, 7),
(32, 15),
(33, 12),
(33, 13),
(34, 12),
(34, 17),
(35, 7),
(35, 15),
(36, 10),
(36, 17),
(37, 11),
(37, 14),
(38, 5),
(38, 16),
(39, 2),
(39, 13),
(40, 8),
(40, 14),
(41, 7),
(41, 16),
(42, 8),
(42, 14),
(43, 2),
(43, 18),
(44, 8),
(44, 19),
(45, 1),
(45, 19),
(46, 9),
(46, 13),
(47, 6),
(47, 18),
(48, 4),
(48, 14),
(49, 8),
(49, 15),
(50, 3),
(50, 13),
(51, 3),
(51, 18),
(52, 11),
(52, 19),
(53, 8),
(53, 19),
(54, 1),
(54, 17),
(55, 5),
(55, 15),
(56, 7),
(56, 13),
(57, 1),
(57, 17),
(58, 9),
(58, 14),
(59, 9),
(59, 15),
(60, 10),
(60, 16),
(61, 6),
(61, 17),
(62, 6),
(62, 16),
(63, 11),
(63, 13),
(64, 6),
(64, 14),
(65, 6),
(65, 14),
(66, 5),
(66, 16),
(67, 7),
(67, 15),
(68, 3),
(68, 16),
(69, 10),
(69, 13),
(70, 12),
(70, 18),
(71, 4),
(71, 19),
(72, 6),
(72, 19),
(73, 11),
(73, 17),
(74, 4),
(74, 15),
(75, 8),
(75, 15),
(76, 10),
(76, 14),
(77, 11),
(77, 18),
(78, 1),
(78, 14),
(79, 1),
(79, 16),
(80, 6),
(80, 15),
(81, 11),
(81, 16),
(82, 8),
(82, 16),
(83, 1),
(83, 17),
(84, 7),
(84, 14),
(85, 8),
(85, 16),
(86, 9),
(86, 17),
(87, 10),
(87, 19),
(88, 4),
(88, 17),
(89, 4),
(89, 16),
(90, 10),
(90, 13),
(91, 9),
(91, 15),
(92, 4),
(92, 13),
(93, 12),
(93, 18),
(94, 5),
(94, 18),
(95, 9),
(95, 14),
(96, 2),
(96, 16),
(97, 2),
(97, 19),
(98, 6),
(98, 19),
(99, 12),
(99, 16),
(100, 8),
(100, 15),
(101, 3),
(101, 17),
(102, 3),
(102, 17),
(103, 7),
(103, 13),
(104, 9),
(104, 18),
(105, 7),
(105, 13),
(106, 4),
(106, 17),
(107, 6),
(107, 14),
(108, 4),
(108, 13),
(109, 8),
(109, 14),
(110, 6),
(110, 18),
(111, 1),
(111, 19),
(112, 10),
(112, 15),
(113, 11),
(113, 15),
(114, 1),
(114, 19),
(115, 7),
(115, 19),
(116, 6),
(116, 18),
(117, 11),
(117, 18),
(118, 11),
(118, 14),
(119, 5),
(119, 14),
(120, 12),
(120, 18),
(121, 11),
(121, 15),
(122, 3),
(122, 16),
(123, 10),
(123, 19),
(124, 9),
(124, 13),
(125, 5),
(125, 19),
(126, 12),
(126, 13),
(127, 2),
(127, 13),
(128, 4),
(128, 18),
(129, 9),
(129, 14),
(130, 5),
(130, 15),
(131, 3),
(131, 15),
(132, 2),
(132, 17),
(133, 5),
(133, 17),
(134, 10),
(134, 16),
(135, 2),
(135, 17),
(136, 4),
(136, 19),
(137, 3),
(137, 15),
(138, 12),
(138, 14),
(139, 2),
(139, 15);

--
-- Dumping data for table `studenten_klassen`
--

INSERT INTO `studenten_klassen` (`klas_id`, `student_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139);

--
-- Dumping data for table `vakken`
--

INSERT INTO `vakken` (`id`, `naam`) VALUES
(1, 'Lol');

-- --------------------------------------------------------

--
-- Structure for view `docenten_view`
--
DROP TABLE IF EXISTS `docenten_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `docenten_view`  AS SELECT `g`.`id` AS `id`, `g`.`r_nummer` AS `r_nummer`, `g`.`voornaam` AS `voornaam`, `g`.`achternaam` AS `achternaam`, `g`.`email` AS `email` FROM `gebruikers` AS `g` WHERE `g`.`rol_id` = 2 ;

-- --------------------------------------------------------

--
-- Structure for view `studenten_view`
--
DROP TABLE IF EXISTS `studenten_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studenten_view`  AS SELECT `g`.`id` AS `id`, `g`.`r_nummer` AS `r_nummer`, `g`.`voornaam` AS `voornaam`, `g`.`achternaam` AS `achternaam`, `g`.`email` AS `email` FROM `gebruikers` AS `g` WHERE `g`.`rol_id` = 1 ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
