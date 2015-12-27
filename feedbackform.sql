-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2015 at 08:42 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `feedbackform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `name`) VALUES
('tanmay', '123456', 'Tanmay Garg'),
('anuparna', '123456', 'Anuparna Deb');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `cno` int(5) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `duration` int(5) NOT NULL,
  `dno` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cno`, `cname`, `duration`, `dno`) VALUES
(1, 'B.Tech', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `hodno` int(5) DEFAULT NULL,
  `dno` int(5) NOT NULL,
  `dname` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`hodno`, `dno`, `dname`) VALUES
(1, 1, 'Computer Science'),
(3, 2, 'Information Technolo'),
(NULL, 3, 'History'),
(NULL, 4, 'Business');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `fname` varchar(30) NOT NULL,
  `fno` int(5) NOT NULL,
  `dno` int(5) DEFAULT NULL,
  UNIQUE KEY `fno` (`fno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fname`, `fno`, `dno`) VALUES
('Dr. Vinita Singh', 1, 1),
('Dr. Anupam Sharma', 2, 1),
('Mr. Manoj Kumar', 3, 2),
('Mr. Kumar', 4, 3),
('Mr. ABCD', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `scode` varchar(20) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `dno` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`scode`, `sname`, `dno`) VALUES
('CS-101', 'Operating Systems', 1),
('CS-102', 'Networking', 1),
('CS-104', 'Microprocessors', 1),
('CS-105', 'Algorithms', 1),
('IT-101', 'IT Subject 1', 2),
('IT-102', 'IT Subject 2', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
