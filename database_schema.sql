-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2015 at 01:54 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stt`
--
CREATE DATABASE IF NOT EXISTS `stt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `stt`;


-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

DROP TABLE IF EXISTS `incidents`;
CREATE TABLE IF NOT EXISTS `incidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `owner` varchar(64) NOT NULL,
  `status` varchar(128) NOT NULL,
  `laptopserial` varchar(64) NOT NULL,
  `chargerserial` varchar(64) NOT NULL,
  `laptoptaken` tinyint(1) NOT NULL,
  `chargertaken` tinyint(1) NOT NULL,
  `newlaptop` tinyint(1) NOT NULL,
  `newlaptopserial` varchar(64) NOT NULL,
  `newchargerserial` varchar(64) NOT NULL,
  `explanation` varchar(256) NOT NULL,
  `receviedby` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pageviews`
--

DROP TABLE IF EXISTS `pageviews`;
CREATE TABLE IF NOT EXISTS `pageviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(32) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `article_id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `image_url` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `archive` int(3) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`article_id`, `title`, `message`, `image_url`, `date`, `archive`) VALUES
(1, 'News is Here!', 'Finally the Student Tech Team has a news reel on the front page! It will help spread around all the important information of the class faster!', 'http://goo.gl/nIaQj6', '2015-11-25',0);

-- --------------------------------------------------------

--
-- Table structure for table `devicecategories`
--

DROP TABLE IF EXISTS `devicecategories`;
CREATE TABLE IF NOT EXISTS `devicecategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Table structure for table `pageviews`
--

DROP TABLE IF EXISTS `pageviews`;
CREATE TABLE IF NOT EXISTS `pageviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(32) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `devicecategories`
--

INSERT INTO `devicecategories` (`id`, `name`, `description`) VALUES
(1, 'new', 'New device repair, point value not set.'),
(2, 'unassigned', 'Device given point value but not assigned to a student.'),
(3, 'assigned', 'Device in for repairs and assigned to a student.'),
(4, 'repaired', 'Device repaired but not yet returned to owner.'),
(5, 'returned', 'Device returned to owner, points awarded for returning the device.'),
(6, 'complete', 'Points awarded, fines sent to office.');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(64) NOT NULL,
  `assignedto_id` int(11) NOT NULL,
  `received` date NOT NULL,
  `problem` varchar(256) NOT NULL,
  `resolution` varchar(256) NOT NULL,
  `notes` varchar(512) NOT NULL,
  `repaired` date NOT NULL,
  `returned` date NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `receivedby_id` int(11) NOT NULL,
  `serial` date NOT NULL,
  `point_value` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(512) NOT NULL,
  `skillcatid` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `points` int(11) NOT NULL,
  `repeatable` tinyint(1) NOT NULL DEFAULT '0',
  `limitone` tinyint(1) NOT NULL DEFAULT '0',
  `claimedby` int(11) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '1',
  `bypassLimit` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `description`, `skillcatid`, `status`, `points`, `repeatable`, `limitone`, `claimedby`, `priority`) VALUES
(1, 'Job 1', 'The first job', 1, 1, 1, 0, 0, 0, 1),
(2, 'Job 2', 'The Second Job', 2, 1, 2, 0, 0, 0, 1),
(3, 'Job 3', 'The Third Job', 3, 1, 3, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobstatus`
--

DROP TABLE IF EXISTS `jobstatus`;
CREATE TABLE IF NOT EXISTS `jobstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `Rewards`
--

DROP TABLE IF EXISTS `Rewards`;
CREATE TABLE IF NOT EXISTS `Rewards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `category` int(11) NOT NULL DEFAULT '1',
  `points` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `skillcategories`
--

DROP TABLE IF EXISTS `skillcategories`;
CREATE TABLE IF NOT EXISTS `skillcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  `suit` varchar(16) DEFAULT NULL,
  `Theme` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


--
-- Dumping data for table `skillcategories`
--

INSERT INTO `skillcategories` (`id`, `category`, `suit`, `Theme`) VALUES
(1, 'Unclassified', 'Joker', NULL),
(2, 'Computer Software', 'Spade', 'Scifi'),
(3, 'Programming', 'Diamond', 'Technology'),
(4, 'Training/Documentation', 'Heart', 'Medieval'),
(5, 'Computer Hardware', 'Club', 'Steampunk');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skillName` varchar(32) NOT NULL,
  `skillcatid` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `skillName` (`skillName`),
  KEY `skillcatid` (`skillcatid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `class` varchar(4) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `class`, `active`) VALUES
(1, 'Student 1', '2001', 1),
(2, 'Student 2', '2002', 1),
(3, 'Student 3', '2004', 1),
(9, 'Steavie', '2020', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentsxskills`
--

DROP TABLE IF EXISTS `studentsxskills`;
CREATE TABLE IF NOT EXISTS `studentsxskills` (
  `stid` int(11) NOT NULL,
  `skid` int(11) NOT NULL,
  PRIMARY KEY (`stid`,`skid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
