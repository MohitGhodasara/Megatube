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
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Autos & Vehicles'),
(2, 'Comedy'),
(3, 'Education'),
(4, 'Entertainment'),
(5, 'File & Animation'),
(6, 'Gaming'),
(7, 'Howto & Style'),
(8, 'Music'),
(9, 'News & Politics'),
(10, 'Nonprofits & Activism'),
(11, 'People & Blogs'),
(12, 'pets & Animals'),
(13, 'Science & Technology'),
(14, 'Sports'),
(15, 'Travel & Events');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `city` varchar(50) DEFAULT NULL,
  `stateid` int(4) DEFAULT NULL,
  `countryid` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city`, `stateid`, `countryid`) VALUES
(1, 'Los Angales', 2, 1),
(2, 'New York', 1, 1),
(3, 'Toranto', 4, 2),
(4, 'Vancovour', 3, 2),
(5, 'Junagadh', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `country` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country`) VALUES
(1, 'USA'),
(2, 'Canada'),
(3, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `vidid` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `like` tinyint(1) NOT NULL,
  `dislike` tinyint(1) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `commentdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `vidid`, `userid`, `like`, `dislike`, `comment`, `commentdate`) VALUES
(94, '560694cee31b9', 'billgates', 0, 1, '', '0000-00-00'),
(95, '5606a163e77ac', 'Mohit123', 1, 0, '', '0000-00-00'),
(96, '560694cee31b9', 'Mohit123', 1, 0, '', '0000-00-00'),
(97, '560694cee31b9', 'Mohit123', 2, 2, 'great.......', '2015-09-26'),
(98, '560694cee31b9', 'Mohit123', 2, 2, 'nicee song..', '2015-09-26'),
(99, '560694cee31b9', 'billgates', 2, 2, 'DHOOM 3', '2015-09-26'),
(100, '560694cee31b9', 'billgates', 2, 2, 'asd', '2015-09-26'),
(101, '560694cee31b9', 'Mohit123', 2, 2, 'xyz', '2015-09-26'),
(102, '560694cee31b9', 'Mohit123', 2, 2, 'asd', '2015-09-27');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `countryid` int(4) NOT NULL,
  `statename` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `countryid`, `statename`) VALUES
(1, 1, 'New York'),
(2, 1, 'Los Angeles'),
(3, 2, 'British Columbia'),
(4, 2, 'Torentu'),
(5, 3, 'Gujrat');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `vidid` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL,
  `descriptions` varchar(1000) NOT NULL,
  `category` int(10) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `viewers` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `vidid` (`vidid`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=145 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `vidid`, `name`, `descriptions`, `category`, `userid`, `date`, `viewers`) VALUES
(77, '560692bba7c69', 'Arijit Singh with his soulful performance - YouTube', 'Arijit Singh is an Indian playback singer and a music programmer. Born in Jiaganj, Murshidabad, West Bengal, his career began upon participating in the reality show Fame Gurukul, which he lost the finals. Wikipedia\r\nBorn: April 25, 1987 (age 28), Jiaganj Azimganj\r\nSpouse: Koel Roy (m. 2014)\r\nAlbums: Khamoshiyan, Mary Kom, Arijit Singh Love Stories, more\r\nAwards: Filmfare Award for Best Male Playback Singer, more\r\nNominations: World Music Award for World’s Best Live Act, more\r\nSongs', 8, 'Mohit123', '2015-09-26', 10),
(84, '560694cee31b9', 'Kamli___Full_Song___DHOOM_3_hd720.mp4', '', 8, 'Mohit123', '2015-09-26', 29),
(87, '5606951d5e2b8', 'Yaariyan Mashup.mp4', '', 6, 'Mohit123', '2015-09-26', 2),
(88, '560695425d1e3', 'Love Me Thoda Aur.mp4', '', 6, 'Mohit123', '2015-09-26', 3),
(95, '5606962e77737', 'Love Me Thoda Aur.mp4', '', 6, 'Mohit123', '2015-09-26', 2),
(98, '5606967729495', 'JADOO KI JHAPPI.mp4', '', 6, 'Mohit123', '2015-09-26', 1),
(99, '5606968939512', 'JEENE LAGA HOON.mp4', '', 6, 'Mohit123', '2015-09-26', 4),
(100, '560696c5e7a66', 'TU MERE AGAL BAGAL HAI.mp4', '', 4, 'Mohit123', '2015-09-26', 2),
(102, '56069719926cb', 'KASHMIR MAIN TU KANYAKUMARI.mp4', '', 4, 'Mohit123', '2015-09-26', 2),
(103, '5606973732763', 'SHIRT DA BUTTON.mp4', '', 3, 'Mohit123', '2015-09-26', 0),
(104, '56069769c9487', 'CHURA KE LEJA.mp4', '', 4, 'Mohit123', '2015-09-26', 2),
(105, '560697a4c3ebc', 'SHIRT DA BUTTON.mp4', '', 4, 'Mohit123', '2015-09-26', 3),
(106, '560697cc243f3', 'LUT GAYE TERE MOHALLE.mp4', '', 4, 'Mohit123', '2015-09-26', 2),
(107, '560698056fd8e', 'Romantic Mashup Full Video Song _ DJ Chetas_Full-HD.mp4', '', 4, 'Mohit123', '2015-09-26', 3),
(113, '56069a4122aac', 'Saajna Video Song Feat. Falak __ I Me Aur Main __ John Abrah', '', 2, 'Mohit123', '2015-09-26', 1),
(114, '56069a7848cfe', 'Cocktail Mashup HD 3D(by DJ SONU) _1080p_ (full video song).', '', 2, 'Mohit123', '2015-09-26', 2),
(115, '56069b09044b0', 'Romantic Mashup Full Video Song _ DJ Chetas_Full-HD.mp4', '', 2, 'Mohit123', '2015-09-26', 1),
(118, '56069c87d9fec', 'Arijit Singh with his soulful performance - YouTube.mp4', '', 7, 'billgates', '2015-09-26', 6),
(123, '56069d6062194', 'RANG JO LAGYO.mp4', '', 7, 'billgates', '2015-09-26', 2),
(124, '56069db74a48a', 'JEENE LAGA HOON.mp4', '', 7, 'billgates', '2015-09-26', 0),
(125, '56069def9617d', 'Kamli___Full_Song___DHOOM_3_hd720.mp4', '', 7, 'billgates', '2015-09-26', 0),
(128, '56069e5319298', 'Love Me Thoda Aur.mp4', '', 7, 'billgates', '2015-09-26', 2),
(129, '5606a163e77ac', 'Heropanti- Rabba Video Song - Mohit Chauhan - Tiger Shroff -', '', 4, 'Mohit123', '2015-09-26', 6),
(132, '5606b40ac88b5', 'Yaariyan Love Me Thoda Aur Full Video Song - Arijit Singh - ', '', 6, 'billgates', '2015-09-26', 16),
(134, '560d6e70cdaee', 'Yaariyan Love Me Thoda Aur Full Video Song - Arijit Singh - ', '', 8, 'billgates', '2015-10-01', 1),
(135, '560d7322c4157', 'Exclusive- LOVE DOSE Full Video Song - Yo Yo Honey Singh, Ur', '', 8, 'billgates', '2015-10-01', 1),
(136, '560d736014a5c', 'Samjhawan_Video_–_Humpty_Sharma_Ki_Dulhania_(2014).mp4', '', 8, 'billgates', '2015-10-01', 1),
(137, '560d739aa375b', 'Heropanti- Rabba Video Song - Mohit Chauhan - Tiger Shroff -', '', 8, 'billgates', '2015-10-01', 0),
(139, '560d75889eb16', 'Samjhawan_Video_–_Humpty_Sharma_Ki_Dulhania_(2014).mp4', '', 2, 'billgates', '2015-10-01', 0),
(140, '560d75ddab3ac', 'Heropanti- Rabba Video Song - Mohit Chauhan - Tiger Shroff -', '', 7, 'billgates', '2015-10-01', 0),
(143, '560d797908869', 'KASHMIR MAIN TU KANYAKUMARI.mp4', '', 2, 'billgates', '2015-10-01', 1),
(144, '560d7a0f23b59', 'SHIRT DA BUTTON.mp4', '', 2, 'billgates', '2015-10-01', 1);

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
INSERT INTO `userinfo` (`id`, `name`, `sname`, `userid`, `emailid`, `password`, `gender`, `birthdate`, `mobile`, `countryid`, `stateid`, `city`, `createdate`, `photo`, `active`) VALUES
INSERT INTO `userinfo` (`id`, `name`, `sname`, `userid`, `emailid`, `password`, `gender`, `birthdate`, `mobile`, `countryid`, `stateid`, `city`, `createdate`, `photo`, `active`) VALUES
(3, 'larry', 'page', 'lp12345', 'lp12345@yahoo.com', '123', 'male', '2000-01-01', 8888888888, 2, 3, 4, '2015-09-08', '', 1),
(4, 'mark', 'zuckerberg', 'mz12345', 'mz12345@yahoo.com', '123', 'male', '1955-10-28', 7777777777, 2, 3, 4, '2015-09-26', '', 1),
(5, 'Steve ', 'Jobs', 'sj12345', 'sj12345@yahoo.com', '123', 'male', '1998-01-01', 6666666666, 1, 1, 2, '2015-09-26', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;