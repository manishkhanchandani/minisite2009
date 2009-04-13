-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2009 at 03:39 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `minisite`
--

-- --------------------------------------------------------

--
-- Table structure for table `prebuilt_concepts_settings`
--

CREATE TABLE IF NOT EXISTS `prebuilt_concepts_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `setting_label` varchar(200) DEFAULT NULL,
  `comments` text,
  `inputtype` enum('radio','checkbox') DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `setting_vals` text,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `prebuilt_concepts_settings`
--

INSERT INTO `prebuilt_concepts_settings` (`setting_id`, `concept_id`, `setting_label`, `comments`, `inputtype`, `reference`, `setting_vals`) VALUES
(1, 5, 'Yahoo News', 'http://news.search.yahoo.com/news/rss?p=[[KEYWORD]]&ei=UTF-8&fl=0&x=wrt\r\n', 'checkbox', 'yahoonews', NULL),
(2, 5, 'Google News', 'http://news.google.com/news?pz=1&ned=us&hl=en&q=[[KEYWORD]]&output=rss', 'checkbox', 'googlenews', NULL),
(3, 1, 'No Category', NULL, 'radio', 'nocat', NULL),
(4, 1, 'Single Level Category', NULL, 'radio', 'single', NULL),
(5, 1, 'Multilevel Category', NULL, 'radio', 'multi', NULL),
(10, 10, 'Top Rated Videos', NULL, 'checkbox', 'toprated', NULL),
(9, 10, 'Most Viewed Videos', NULL, 'checkbox', 'mostviewed', NULL),
(11, 10, 'Recently Featured Videos', NULL, 'checkbox', 'featured', NULL),
(12, 10, 'Large Result Set', NULL, 'checkbox', 'largeresultset', NULL);
