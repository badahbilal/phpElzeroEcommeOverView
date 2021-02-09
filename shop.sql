-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 09, 2021 at 11:10 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `orodering` int(11) NOT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(4) NOT NULL DEFAULT '0',
  `allow_ads` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_cat` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `orodering`, `visibility`, `allow_comment`, `allow_ads`) VALUES
(1, 'Electonic', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `groupID` int(11) NOT NULL DEFAULT '0',
  `trustStatus` int(11) NOT NULL DEFAULT '0',
  `RegStatus` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fullname`, `groupID`, `trustStatus`, `RegStatus`, `date`) VALUES
(1, 'badah', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'b@b.com', 'badah bilal', 1, 0, 1, '2019-10-01'),
(2, 'ayman2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'a@a.com', 'ayman2 badah', 0, 0, 1, '2019-10-02'),
(5, 'ziani', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'z@z.com', 'ziani badre', 0, 0, 1, '2019-10-03'),
(11, 'zinii', '38625293c97cfb774e3ddc072b90803e20a8475a', 'a@a.com', 'zpojd', 0, 0, 0, '2019-10-05'),
(13, 'najia', '0ec09ef9836da03f1add21e3ef607627e687e790', 'a@a.com', 'najia lharchi', 0, 0, 1, '2019-10-27'),
(15, 'fatima', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'f@f.com', 'fatima badah', 1, 0, 1, '2019-10-27'),
(16, 'hello', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'a@a.com', 'hello', 0, 0, 1, '2020-03-20'),
(17, 'TEST', 'hhh', 'e@e.com', 'badah bilal', 0, 0, 0, NULL),
(18, 'test2', 'e@e.com', 'test', 'badah bilal', 0, 0, 0, '2020-02-02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
