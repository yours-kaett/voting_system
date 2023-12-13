-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 01, 2023 at 11:12 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_candidates`
--

DROP TABLE IF EXISTS `tbl_candidates`;
CREATE TABLE IF NOT EXISTS `tbl_candidates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidate_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `candidate_position` int NOT NULL,
  `img_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `votes` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_position` (`candidate_position`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_candidates`
--

INSERT INTO `tbl_candidates` (`id`, `candidate_name`, `candidate_position`, `img_name`, `votes`, `user_id`, `created_at`, `updated_at`) VALUES
(34, 'Tiny', 1, 'pres1.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:24:31 am', ''),
(35, 'Andy', 1, 'pres2.jpeg', 0, 4, 'November 21, 2023 | Tuesday - 09:35:11 am', ''),
(36, 'Mast', 1, 'pres3.png', 0, 4, 'November 21, 2023 | Tuesday - 09:40:07 am', ''),
(37, 'Trisha', 2, 'vpres1.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:41:34 am', ''),
(38, 'Kenny', 2, 'vpres2.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:42:00 am', ''),
(39, 'Janella', 2, 'vpres3.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:42:15 am', ''),
(40, 'Christyl', 3, 'sec1.jpeg', 0, 4, 'November 21, 2023 | Tuesday - 09:42:31 am', ''),
(41, 'Billy', 3, 'sec2.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:43:03 am', ''),
(42, 'June', 4, 'treas1.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:47:04 am', ''),
(43, 'Jenny', 4, 'treas2.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:47:23 am', ''),
(44, 'Emma', 4, 'treas3.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:48:00 am', ''),
(45, 'Mia', 5, 'aud1.png', 0, 4, 'November 21, 2023 | Tuesday - 09:48:20 am', ''),
(46, 'Elsy', 5, 'aud2.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:48:35 am', ''),
(47, 'Nelly', 6, 'po1.jpg', 0, 4, 'November 21, 2023 | Tuesday - 09:51:02 am', ''),
(48, 'Jella', 6, 'pio2.jpg', 0, 4, 'November 21, 2023 | Tuesday - 10:00:06 am', ''),
(49, 'Mandy', 6, 'pio3.jpg', 0, 4, 'November 21, 2023 | Tuesday - 10:00:21 am', ''),
(50, 'Zydney', 7, 'po1.jpg', 0, 4, 'November 21, 2023 | Tuesday - 10:01:15 am', ''),
(51, 'Mecca', 7, 'po2.jpg', 0, 4, 'November 21, 2023 | Tuesday - 10:01:33 am', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gender`
--

DROP TABLE IF EXISTS `tbl_gender`;
CREATE TABLE IF NOT EXISTS `tbl_gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gender`
--

INSERT INTO `tbl_gender` (`id`, `gender`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'LGBTQIA+');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_level`
--

DROP TABLE IF EXISTS `tbl_grade_level`;
CREATE TABLE IF NOT EXISTS `tbl_grade_level` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grade_level` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_grade_level`
--

INSERT INTO `tbl_grade_level` (`id`, `grade_level`) VALUES
(1, 'Grade 7'),
(2, 'Grade 8'),
(3, 'Grade 9'),
(4, 'Grade 10'),
(5, 'Grade 11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

DROP TABLE IF EXISTS `tbl_position`;
CREATE TABLE IF NOT EXISTS `tbl_position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`id`, `position`) VALUES
(1, 'President'),
(2, 'Vice President'),
(3, 'Secretary'),
(4, 'Treasurer'),
(5, 'Auditor'),
(6, 'P.I.O'),
(7, 'Protocol Officer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

DROP TABLE IF EXISTS `tbl_section`;
CREATE TABLE IF NOT EXISTS `tbl_section` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`id`, `section`) VALUES
(1, 'Hope'),
(2, 'Faith'),
(3, 'Love'),
(4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `student_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vote_status` int NOT NULL,
  `gender` tinyint NOT NULL,
  `img_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `grade_level` int NOT NULL,
  `section` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vote_status` (`vote_status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

DROP TABLE IF EXISTS `tbl_teacher`;
CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vote_status`
--

DROP TABLE IF EXISTS `tbl_vote_status`;
CREATE TABLE IF NOT EXISTS `tbl_vote_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vote_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vote_status`
--

INSERT INTO `tbl_vote_status` (`id`, `vote_status`) VALUES
(1, 'Undone'),
(2, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_votings`
--

DROP TABLE IF EXISTS `tbl_votings`;
CREATE TABLE IF NOT EXISTS `tbl_votings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `candidates_id` int NOT NULL,
  `created_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student` (`student_id`),
  KEY `student_id` (`student_id`),
  KEY `candidates_id` (`candidates_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
