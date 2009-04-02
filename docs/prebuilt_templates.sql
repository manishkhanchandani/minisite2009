-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2009 at 05:34 AM
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
-- Table structure for table `prebuilt_templates`
--

CREATE TABLE IF NOT EXISTS `prebuilt_templates` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `template` text,
  `css` text,
  `js` text,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prebuilt_templates`
--

INSERT INTO `prebuilt_templates` (`tid`, `name`, `template`, `css`, `js`) VALUES
(1, 'Blog Template', '<div id="mainBody">\r\n	<div id="mainHeader">\r\n		<h1>Blog Site</h1>\r\n		<p>New blog site is back</p>\r\n	</div>\r\n	<div id="mainLower">\r\n		<div id="mainNavigation">\r\n			<a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>">Home</a> | <a href="<?php echo HTTPPATH; ?>/index.php?p=blog&ID=<?php echo $ID; ?>">Blog</a>		\r\n		</div>\r\n		<div id="mainContent">\r\n			[[BODY]]\r\n		</div>\r\n		<div id="mainFooter">\r\n			<p>Copyright 2009</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n', '<!--\r\nbody {\r\n	background-color: #990000;\r\n	margin: 0px;\r\n	padding: 0px;\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\ntd, th, table, p, select, input, textarea {\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\na {\r\n	text-decoration: none;\r\n}\r\n#mainBody {\r\n	width: 800px;\r\n	border: 1px solid #000000;\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	margin-top:-25px;\r\n}\r\n#mainBody #mainHeader {\r\n	background-color: #000000;\r\n	text-align:center;\r\n	padding-top:25px;\r\n}\r\n#mainBody #mainHeader h1 {\r\n	font-size: 36px;\r\n	font-weight: bold;\r\n	color: #FFFFFF;\r\n}\r\n#mainBody #mainHeader p {\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n	text-align:center;\r\n	margin-top: -20px;\r\n	padding-bottom: 25px;\r\n}\r\n#mainBody #mainLower {\r\n	background-color: #FFFFFF;\r\n	margin-top: -20px;\r\n	padding-bottom: 15px;\r\n}\r\n#mainBody #mainLower #mainNavigation {\r\n	padding: 5px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990000;\r\n}\r\n#mainBody #mainLower #mainContent {\r\n	padding: 10px;\r\n	min-height: 300px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990000;\r\n}\r\n-->', NULL),
(3, 'News Template', '<div id="mainBody">\r\n	<div id="mainHeader">\r\n		<h1>News Site</h1>\r\n		<p>News site is back</p>\r\n	</div>\r\n	<div id="mainLower">\r\n		<div id="mainNavigation">\r\n			<a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>">Home</a> | <a href="<?php echo HTTPPATH; ?>/index.php?p=news&ID=<?php echo $ID; ?>">News</a>		\r\n		</div>\r\n		<div id="mainContent">\r\n			[[BODY]]\r\n		</div>\r\n		<div id="mainFooter">\r\n			<p>Copyright 2009</p>\r\n		</div>\r\n	</div>\r\n</div>', '<!--\r\nbody {\r\n	background-color: #0000FF;\r\n	margin: 0px;\r\n	padding: 0px;\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\ntd, th, table, p, select, input, textarea {\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\na {\r\n	text-decoration: none;\r\n}\r\n#mainBody {\r\n	width: 800px;\r\n	border: 1px solid #000000;\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	margin-top:-25px;\r\n}\r\n#mainBody #mainHeader {\r\n	background-color: #000000;\r\n	text-align:center;\r\n	padding-top:25px;\r\n}\r\n#mainBody #mainHeader h1 {\r\n	font-size: 36px;\r\n	font-weight: bold;\r\n	color: #FFFFFF;\r\n}\r\n#mainBody #mainHeader p {\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n	text-align:center;\r\n	margin-top: -20px;\r\n	padding-bottom: 25px;\r\n}\r\n#mainBody #mainLower {\r\n	background-color: #FFFFFF;\r\n	margin-top: -20px;\r\n	padding-bottom: 15px;\r\n}\r\n#mainBody #mainLower #mainNavigation {\r\n	padding: 5px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #0000FF;\r\n}\r\n#mainBody #mainLower #mainContent {\r\n	padding: 10px;\r\n	min-height: 300px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #0000FF;\r\n}\r\n-->', NULL);
