-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 02:47 PM
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
-- Database: `a_project`
--
CREATE DATABASE IF NOT EXISTS `a_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `a_project`;

-- --------------------------------------------------------

--
-- Table structure for table `book_cats`
--

CREATE TABLE IF NOT EXISTS `book_cats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover_path` varchar(2048) NOT NULL,
  `cat_name` varchar(1024) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_items`
--

CREATE TABLE IF NOT EXISTS `book_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(1024) NOT NULL,
  `book_cover` varchar(1024) NOT NULL,
  `pdf_path` varchar(2048) NOT NULL,
  `book_details` longtext NOT NULL,
  `book_cat_id` int(11) NOT NULL,
  `time` varchar(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(64) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `role` varchar(32) NOT NULL DEFAULT 'USER',
  `time` varchar(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT IGNORE INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `time`) VALUES
(1, 'Amrin', 'hsamrin42@gmail.com', '700c8b805a3e2a265b01c77614cd8b21', 'ADMIN', '0'),
(2, 'Naibir', 'hossionniber@gmail.com', '700c8b805a3e2a265b01c77614cd8b21', 'ADMIN', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
