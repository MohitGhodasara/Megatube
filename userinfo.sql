-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2015 at 08:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `megatube`
--

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `countryid` int(10) NOT NULL,
  `stateid` int(10) NOT NULL,
  `city` int(10) NOT NULL,
  `createdate` date NOT NULL,
  `photo` longblob NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `name`, `sname`, `userid`, `emailid`, `password`, `gender`, `birthdate`, `mobile`, `countryid`, `stateid`, `city`, `createdate`, `photo`, `active`) VALUES
(1, 'Mohit', 'Ghodasara', 'Mohit123', 'Mohit123@yahoo.com', '123', 'male', '2000-04-30', 9999999999, 1, 1, 1, '2015-07-12', '', 2);
INSERT INTO `userinfo` (`id`, `name`, `sname`, `userid`, `emailid`, `password`, `gender`, `birthdate`, `mobile`, `countryid`, `stateid`, `city`, `createdate`, `photo`, `active`) VALUES
(2, 'Bill', 'Gates', 'billgates', 'billgates@mohit.com', '123', 'male', '1955-10-28', 9999999999, 1, 1, 2, '2015-07-18', '', 1);
INSERT INTO `userinfo` (`id`, `name`, `sname`, `userid`, `emailid`, `password`, `gender`, `birthdate`, `mobile`, `countryid`, `stateid`, `city`, `createdate`, `photo`, `active`) VALUES
(3, 'larry', 'page', 'lp12345', 'lp12345@yahoo.com', '123', 'male', '2000-01-01', 8888888888, 2, 3, 4, '2015-09-08', '', 1),
(4, 'mark', 'zuckerberg', 'mz12345', 'mz12345@yahoo.com', '123', 'male', '1955-10-28', 7777777777, 2, 3, 4, '2015-09-26', '', 1),
(5, 'Steve ', 'Jobs', 'sj12345', 'sj12345@yahoo.com', '123', 'male', '1998-01-01', 6666666666, 1, 1, 2, '2015-09-26', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
