-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2023 at 09:40 AM
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
  `candidate_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `candidate_position` int NOT NULL,
  `img_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `votes` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_position` (`candidate_position`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_candidates`
--

INSERT INTO `tbl_candidates` (`id`, `candidate_name`, `candidate_position`, `img_name`, `votes`, `user_id`, `created_at`) VALUES
(1, 'Anthony', 1, 'Pres1.jpg', 100, 1, ''),
(2, 'Tony', 1, 'Pres2.jpg', 150, 1, ''),
(3, 'Mast', 1, 'Pres3.jpg', 300, 1, ''),
(4, 'Mary', 2, 'Vpres1.jpg', 119, 1, ''),
(5, 'Grace', 2, 'Vpres2.jpg', 110, 1, ''),
(6, 'Michael', 2, 'Vpres3.jpg', 125, 1, ''),
(7, 'Kristhea', 3, 'Sec1.jpg', 165, 1, ''),
(8, 'Chris', 3, 'Sec2.jpg', 178, 1, ''),
(9, 'Ezzer', 4, 'Treas1.jpg', 133, 1, ''),
(10, 'Kirt', 4, 'Treas2.jpg', 149, 1, ''),
(11, 'Ken', 4, 'Treas3.jpg', 120, 1, ''),
(12, 'Ash', 4, 'Treas4.jpg', 158, 1, ''),
(13, 'Hermet', 5, 'Aud1.jpg', 162, 1, ''),
(14, 'Aubrey', 5, 'Aud2.jpg', 129, 1, ''),
(15, 'Shaika', 6, 'PIO1.jpg', 138, 1, ''),
(16, 'Hanzel', 6, 'PIO2.jpg', 174, 1, ''),
(17, 'Rosario', 6, 'PIO3.jpg', 195, 1, ''),
(18, 'Jenny', 7, 'PO1.jpg', 136, 1, ''),
(19, 'Arnold', 7, 'PO2.jpg', 173, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gender`
--

DROP TABLE IF EXISTS `tbl_gender`;
CREATE TABLE IF NOT EXISTS `tbl_gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_grade_level`
--

INSERT INTO `tbl_grade_level` (`id`, `grade_level`) VALUES
(1, 'Grade 11'),
(2, 'Grade 12'),
(3, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

DROP TABLE IF EXISTS `tbl_position`;
CREATE TABLE IF NOT EXISTS `tbl_position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
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
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `student_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `vote_status` int NOT NULL,
  `gender` tinyint NOT NULL,
  `img_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `grade_level` int NOT NULL,
  `section` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vote_status` (`vote_status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `email`, `student_id`, `password`, `vote_status`, `gender`, `img_name`, `firstname`, `middlename`, `lastname`, `grade_level`, `section`) VALUES
(1, 'test@test.com', '12345', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, 'default.jpg', 'Winslie', 'Pardillo', 'Dada', 2, 1),
(2, 'sample@sample.com', '54321', '01cfcd4f6b8770febfb40cb906715822', 2, 1, 'default.jpg', 'Roselyn', 'Bornea', 'Responte', 1, 2),
(5, 'test@test.com', '12345678901', 'bfd81ee3ed27ad31c95ca75e21365973', 1, 1, 'default.jpg', 'Shiella Mae', 'Braza', 'Bilbar', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

DROP TABLE IF EXISTS `tbl_teacher`;
CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `img_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`id`, `email`, `username`, `password`, `img_name`, `firstname`, `middlename`, `lastname`) VALUES
(1, 'sample@sample.com', '54321', '01cfcd4f6b8770febfb40cb906715822', 'default.jpg', 'Test', 'Only', 'Here');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vote_status`
--

DROP TABLE IF EXISTS `tbl_vote_status`;
CREATE TABLE IF NOT EXISTS `tbl_vote_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vote_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
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
  `student` int NOT NULL,
  `voted_president` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `voted_vice_president` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `voted_secretary` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `voted_treasurer` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `voted_auditor` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `voted_pio` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `voted_protocol_officer` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `month_voted` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `day_voted` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `time_voted` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student` (`student`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_votings`
--

INSERT INTO `tbl_votings` (`id`, `student`, `voted_president`, `voted_vice_president`, `voted_secretary`, `voted_treasurer`, `voted_auditor`, `voted_pio`, `voted_protocol_officer`, `month_voted`, `day_voted`, `time_voted`) VALUES
(1, 1, 'Anthony', 'Mary', 'Kristhea', 'Ezzer', 'Hemet', 'Shaika', 'Jenny', '', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_candidates`
--
ALTER TABLE `tbl_candidates`
  ADD CONSTRAINT `tbl_candidates_ibfk_1` FOREIGN KEY (`candidate_position`) REFERENCES `tbl_position` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `tbl_student_ibfk_1` FOREIGN KEY (`vote_status`) REFERENCES `tbl_vote_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_votings`
--
ALTER TABLE `tbl_votings`
  ADD CONSTRAINT `tbl_votings_ibfk_1` FOREIGN KEY (`student`) REFERENCES `tbl_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
