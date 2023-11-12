-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2023 at 08:52 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_candidates`
--
ALTER TABLE `tbl_candidates`
  ADD CONSTRAINT `tbl_candidates_ibfk_1` FOREIGN KEY (`candidate_position`) REFERENCES `tbl_position` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
