-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2009 at 03:51 AM
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
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '1',
  `form_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`, `parent_id`, `level`, `form_id`) VALUES
(1, 'india', 0, 1, 2),
(2, 'usa', 0, 1, 2),
(3, 'maharashtra', 1, 1, 2),
(4, 'mumbai', 3, 1, 2),
(5, 'pune', 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `datas`
--

CREATE TABLE IF NOT EXISTS `datas` (
  `data_id` int(11) NOT NULL,
  `data_key` varchar(200) DEFAULT NULL,
  `data_value` text,
  `reference` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datas`
--


-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL DEFAULT '0',
  `field_name` varchar(200) DEFAULT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `field_type` enum('text','password','textarea','list','listmultiple','checkbox','checkboxmultiple','radio','file','image','hidden') DEFAULT NULL,
  `field_input` enum('fint','ftext','fvc','ffloat','fdate','fdatetime') DEFAULT NULL,
  `field_default` text,
  `field_default_selected` text,
  `field_validate` int(1) NOT NULL DEFAULT '0',
  `field_validate_required` int(1) NOT NULL DEFAULT '0',
  `field_validate_rule` enum('number','email','sametext','regexp') DEFAULT NULL,
  `field_validate_value` text,
  `field_validate_error` text,
  `field_search` int(1) NOT NULL DEFAULT '0',
  `field_search_label` varchar(200) DEFAULT NULL,
  `field_search_type` enum('text','list','listmultiple','checkbox','checkboxmultiple','radio') DEFAULT NULL,
  `field_search_default` text,
  `field_search_default_selected` text,
  `field_view_show` int(1) NOT NULL DEFAULT '1',
  `field_detail_show` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`field_id`, `form_id`, `field_name`, `field_label`, `field_type`, `field_input`, `field_default`, `field_default_selected`, `field_validate`, `field_validate_required`, `field_validate_rule`, `field_validate_value`, `field_validate_error`, `field_search`, `field_search_label`, `field_search_type`, `field_search_default`, `field_search_default_selected`, `field_view_show`, `field_detail_show`) VALUES
(1, 2, 'title', 'Title', 'text', 'fvc', NULL, NULL, 1, 1, NULL, NULL, 'Please fill the title.', 1, 'Title', 'text', NULL, NULL, 1, 1),
(2, 2, 'description', 'Description', 'textarea', 'ftext', NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 'Description:', 'text', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(100) DEFAULT NULL,
  `category` enum('None','Single','Multiple') NOT NULL DEFAULT 'None',
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`form_id`, `form_name`, `category`) VALUES
(1, 'Test', 'None'),
(2, 'test2', 'Single');
