-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2018 at 06:21 PM
-- Server version: 5.7.19-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `locator`
--

-- --------------------------------------------------------

--
-- Table structure for table `e_contacts`
--

CREATE TABLE IF NOT EXISTS `e_contacts` (
  `Sr. No.` int(11) NOT NULL AUTO_INCREMENT,
  `Contact` int(11) NOT NULL,
  `contacts` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`Contact`),
  UNIQUE KEY `Sr. No.` (`Sr. No.`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `signedup`
--

CREATE TABLE IF NOT EXISTS `signedup` (
  `Sr. No.` int(11) NOT NULL AUTO_INCREMENT,
  `Contact` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `image` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`Contact`),
  UNIQUE KEY `Sr. No.` (`Sr. No.`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
