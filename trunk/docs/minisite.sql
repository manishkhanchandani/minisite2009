-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2009 at 07:40 PM
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
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `album` varchar(200) DEFAULT NULL,
  `album_created` datetime DEFAULT NULL,
  `file_type` enum('Image','File','Music','Video') DEFAULT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `albums`
--


-- --------------------------------------------------------

--
-- Table structure for table `ask_expert`
--

CREATE TABLE IF NOT EXISTS `ask_expert` (
  `ask_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text,
  `pid` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`ask_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ask_expert`
--


-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `id`, `user_id`, `title`, `description`, `created`, `status`) VALUES
(1, 1, 1, 'My Great India', 'i am indian and born in india. so come enjoy me. that is the spirit.', '2009-03-30 03:40:41', 1),
(2, 1, 1, 'great maharashtra', 'great maharashtra is here . so come and enjoy it, thanks for adding by.', '2009-03-30 04:02:23', 1),
(3, 2, 1, 'testtest', 'testest testest testest testesttestest testesttestest testesttestest testesttestest testesttestest testesttestest testesttestest testesttestest testest', '2009-03-30 17:16:53', 1),
(4, 3, 1, 'dd', 'ddd dddddddd ddd\r\nddd\r\nddddddddddddddddddddddddd\r\nDddddddddd ddddddddddddddddddddd ddddddddd ddddddddddd', '2009-03-30 17:29:13', 1),
(5, 1, 0, 'aaaaa', 'aaaaaa aaaaaaaaaa aaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaa', '2009-04-02 16:42:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE IF NOT EXISTS `blog_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=9 ;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`category_id`, `id`, `category`, `parent_id`) VALUES
(1, 1, 'India', 0),
(2, 1, 'USA', 0),
(3, 1, 'Maharashtra', 1),
(4, 1, 'Gujarat', 1),
(5, 1, 'Pune', 3),
(6, 1, 'Mumbai', 3),
(7, 2, 'test', 0),
(8, 2, 'test1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog_cat_rel`
--

CREATE TABLE IF NOT EXISTS `blog_cat_rel` (
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_cat_rel`
--

INSERT INTO `blog_cat_rel` (`blog_id`, `id`, `category_id`) VALUES
(1, 0, 1),
(2, 0, 3),
(3, 0, 7),
(5, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `commentor` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `comment_date` datetime DEFAULT NULL,
  `cstatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`comment_id`, `id`, `blog_id`, `commentor`, `comments`, `comment_date`, `cstatus`) VALUES
(1, 1, 2, 1, 'aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', '2009-03-30 16:10:31', 1),
(2, 1, 2, 1, 'aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', '2009-03-30 16:13:15', 1),
(3, 1, 2, 1, 'aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', '2009-03-30 16:14:15', 1),
(4, 1, 2, 1, 'aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', '2009-03-30 16:15:19', 1),
(5, 1, 2, 1, 'aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', '2009-03-30 16:15:19', 1),
(6, 1, 2, 1, 'aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', '2009-03-30 16:15:52', 1),
(7, 1, 2, 1, 'dddmanish aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', '2009-03-30 16:19:59', 1),
(8, 2, 3, 1, 'sssssssss sssssssssssssss sssssssssssssssssssssssssssssssss', '2009-03-30 17:17:03', 1),
(9, 2, 3, 1, 'axxxxxxx xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxccccccccccccc cx', '2009-03-30 17:17:13', 1),
(10, 2, 3, 1, 'asssss\r\ns\r\ns\r\ns\r\ns\r\ns\r\n\r\ns\r\n\r\ns\r\nssssssssssssssssssssssssssssssssssssssss\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nsssssssssssssssss\r\n', '2009-03-30 17:20:04', 1),
(11, 2, 3, 1, 'asssss\r\ns\r\ns\r\ns\r\ns\r\ns\r\n\r\ns\r\n\r\ns\r\nssssssssssssssssssssssssssssssssssssssss\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nsssssssssssssssss', '2009-03-30 17:20:23', 1),
(12, 2, 3, 1, 'asssss\r\ns\r\ns\r\ns\r\ns\r\ns\r\n\r\ns\r\n\r\ns\r\nssssssssssssssssssssssssssssssssssssssss\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nsssssssssssssssss', '2009-03-30 17:28:39', 1),
(13, 2, 3, 1, 'asssss\r\ns\r\ns\r\ns\r\ns\r\ns\r\n\r\ns\r\n\r\ns\r\nssssssssssssssssssssssssssssssssssssssss\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nsssssssssssssssss', '2009-03-30 17:28:41', 1),
(14, 2, 3, 1, 'asssss\r\ns\r\ns\r\ns\r\ns\r\ns\r\n\r\ns\r\n\r\ns\r\nssssssssssssssssssssssssssssssssssssssss\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nsssssssssssssssss', '2009-03-30 17:28:42', 1),
(15, 3, 4, 1, 'dddddddddd ddddddddddddddddddd ddddddddd ddddddddd ddddddddddddddd', '2009-03-30 17:29:32', 1),
(16, 3, 4, 1, 'ee\r\ne\r\ne\r\ne\r\ne\r\n\r\ne\r\neeeeeeeeeeee\r\neeeeeeeeeeeeeeeeeee\r\neeeeeeeeeeeeeeeeeeeeeeeeeee\r\neeeeeeeeeeeeeeeeeee', '2009-03-30 18:23:59', 1),
(17, 1, 2, 0, 'aaa aaaaaaaaaaaaa aaaaaaaaaaaaaa aaaaaaaaaaaa aaaaaaa aaaaaaaaaaaaa a aaaaaaaaaaaaaaaaaaaa', '2009-04-02 16:27:56', 1),
(18, 1, 2, 0, 'aaa aaaaaaaaaaaaa aaaaaaaaaaaaaa aaaaaaaaaaaa aaaaaaa aaaaaaaaaaaaa a aaaaaaaaaaaaaaaaaaaa', '2009-04-02 16:27:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE IF NOT EXISTS `blog_tags` (
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_tags`
--

INSERT INTO `blog_tags` (`blog_id`, `id`, `tag_id`) VALUES
(1, 1, 1),
(1, 1, 2),
(2, 1, 1),
(2, 1, 3),
(3, 2, 2),
(4, 3, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `form_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`, `parent_id`, `form_id`) VALUES
(1, 'india', 0, 2),
(2, 'usa', 0, 2),
(3, 'maharashtra', 1, 2),
(4, 'mumbai', 3, 2),
(5, 'pune', 3, 2);

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
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_title` varchar(200) DEFAULT NULL,
  `event_desc` text,
  `event_phone` varchar(50) DEFAULT NULL,
  `event_email` varchar(150) DEFAULT NULL,
  `event_url` varchar(255) DEFAULT NULL,
  `event_contact_person` varchar(200) DEFAULT NULL,
  `event_start_date` datetime DEFAULT NULL,
  `event_end_date` datetime DEFAULT NULL,
  `event_created` datetime DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `events`
--


-- --------------------------------------------------------

--
-- Table structure for table `events_rsvp`
--

CREATE TABLE IF NOT EXISTS `events_rsvp` (
  `rsvp_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `cuser_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  PRIMARY KEY (`rsvp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `events_rsvp`
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
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filerealname` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `fileext` varchar(15) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `album_id` int(11) NOT NULL,
  `hosttype` enum('Image','File','Music','Video') NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `files`
--


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

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text,
  `forum_created_date` datetime DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forums`
--


-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `mes_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `from_delete` int(1) NOT NULL DEFAULT '0',
  `to_delete` int(1) NOT NULL DEFAULT '0',
  `read` int(1) NOT NULL DEFAULT '0',
  `subject` varchar(200) DEFAULT NULL,
  `message` text,
  `mes_created` datetime DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `poll_question` text,
  `poll_options` text,
  `created` datetime DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `poll`
--


-- --------------------------------------------------------

--
-- Table structure for table `poll_results`
--

CREATE TABLE IF NOT EXISTS `poll_results` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `puser_id` int(11) DEFAULT NULL,
  `option_id` int(4) DEFAULT NULL,
  `pdate` datetime DEFAULT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `poll_results`
--


-- --------------------------------------------------------

--
-- Table structure for table `prebuilt_1`
--

CREATE TABLE IF NOT EXISTS `prebuilt_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(200) DEFAULT NULL,
  `default_id` int(1) NOT NULL,
  `template` text,
  `css` text,
  `js` text,
  `siteurl` varchar(255) DEFAULT NULL,
  `sitename` varchar(200) DEFAULT NULL,
  `siteemail` varchar(150) DEFAULT NULL,
  `ftphost` varchar(255) DEFAULT NULL,
  `ftpuser` varchar(255) DEFAULT NULL,
  `ftppassword` varchar(255) DEFAULT NULL,
  `ftpdir` varchar(255) DEFAULT NULL,
  `dbhost` varchar(255) DEFAULT NULL,
  `db` varchar(255) DEFAULT NULL,
  `dbuser` varchar(255) DEFAULT NULL,
  `dbpassword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=5 ;

--
-- Dumping data for table `prebuilt_1`
--

INSERT INTO `prebuilt_1` (`id`, `keyword`, `default_id`, `template`, `css`, `js`, `siteurl`, `sitename`, `siteemail`, `ftphost`, `ftpuser`, `ftppassword`, `ftpdir`, `dbhost`, `db`, `dbuser`, `dbpassword`) VALUES
(1, 'Mumbai', 1, '<div id="mainBody">\r\n	<div id="mainHeader">\r\n		<h1>Blog Site</h1>\r\n		<p>New blog site is back</p>\r\n	</div>\r\n	<div id="mainLower">\r\n		<div id="mainNavigation">\r\n			<a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>">Home</a> | <a href="<?php echo HTTPPATH; ?>/index.php?p=blog&ID=<?php echo $ID; ?>">Blog</a>		\r\n		</div>\r\n		<div id="mainContent">\r\n			[[BODY]]\r\n		</div>\r\n		<div id="mainFooter">\r\n			<p>Copyright 2009</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n', '<!--\r\nbody {\r\n	background-color: #990000;\r\n	margin: 0px;\r\n	padding: 0px;\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\ntd, th, table, p, select, input, textarea {\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\na {\r\n	text-decoration: none;\r\n}\r\n#mainBody {\r\n	width: 800px;\r\n	border: 1px solid #000000;\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	margin-top:-25px;\r\n}\r\n#mainBody #mainHeader {\r\n	background-color: #000000;\r\n	text-align:center;\r\n	padding-top:25px;\r\n}\r\n#mainBody #mainHeader h1 {\r\n	font-size: 36px;\r\n	font-weight: bold;\r\n	color: #FFFFFF;\r\n}\r\n#mainBody #mainHeader p {\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n	text-align:center;\r\n	margin-top: -20px;\r\n	padding-bottom: 25px;\r\n}\r\n#mainBody #mainLower {\r\n	background-color: #FFFFFF;\r\n	margin-top: -20px;\r\n	padding-bottom: 15px;\r\n}\r\n#mainBody #mainLower #mainNavigation {\r\n	padding: 5px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990000;\r\n}\r\n#mainBody #mainLower #mainContent {\r\n	padding: 10px;\r\n	min-height: 300px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990000;\r\n}\r\n-->', NULL, 'http://10000projects.info/minisite/project1', 'Mumbai', 'mumbai@mkgalaxy.com', 'ftp.servage.net', 'manishkk', 'mAnIsH74', '/www/minisite/project1', 'mysql1076.servage.net', 'minisite09', 'minisite09', 'password123'),
(2, 'Mulund', 0, 'Mulund header\r\n<hr>\r\n[[BODY]]\r\n<hr>\r\nfooter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Bhandup', 0, 'Bhandup header\r\n<hr>\r\n[[BODY]]\r\n<hr>\r\nfooter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Tomato', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prebuilt_2_concepts`
--

CREATE TABLE IF NOT EXISTS `prebuilt_2_concepts` (
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `homepage` int(1) NOT NULL DEFAULT '1',
  `displayname` varchar(200) NOT NULL,
  PRIMARY KEY (`id`,`concept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prebuilt_2_concepts`
--

INSERT INTO `prebuilt_2_concepts` (`id`, `concept_id`, `homepage`, `displayname`) VALUES
(1, 1, 1, 'My Blog'),
(2, 1, 1, ''),
(3, 1, 1, ''),
(4, 5, 1, ''),
(1, 5, 1, 'My News');

-- --------------------------------------------------------

--
-- Table structure for table `prebuilt_3_settings`
--

CREATE TABLE IF NOT EXISTS `prebuilt_3_settings` (
  `id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prebuilt_3_settings`
--

INSERT INTO `prebuilt_3_settings` (`id`, `setting_id`) VALUES
(1, 2),
(1, 5),
(1, 7),
(1, 8),
(2, 4),
(3, 3),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `prebuilt_concepts`
--

CREATE TABLE IF NOT EXISTS `prebuilt_concepts` (
  `concept_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept` varchar(200) DEFAULT NULL,
  `links` text,
  PRIMARY KEY (`concept_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `prebuilt_concepts`
--

INSERT INTO `prebuilt_concepts` (`concept_id`, `concept`, `links`) VALUES
(1, 'blog', NULL),
(5, 'news', NULL),
(7, 'smsreminder', '');

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
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `prebuilt_concepts_settings`
--

INSERT INTO `prebuilt_concepts_settings` (`setting_id`, `concept_id`, `setting_label`, `comments`, `inputtype`) VALUES
(1, 5, 'Yahoo News', 'http://news.search.yahoo.com/news/rss?p=[[KEYWORD]]&ei=UTF-8&fl=0&x=wrt\r\n', 'checkbox'),
(2, 5, 'Google News', 'http://news.google.com/news?pz=1&ned=us&hl=en&q=[[KEYWORD]]&output=rss', 'checkbox'),
(3, 1, 'No Category', NULL, 'radio'),
(4, 1, 'Single Level Category', NULL, 'radio'),
(5, 1, 'Multilevel Category', NULL, 'radio'),
(7, 1, 'Logged In Users can only Post', NULL, 'checkbox'),
(8, 1, 'Logged In Users can only Comment', NULL, 'checkbox');

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

-- --------------------------------------------------------

--
-- Table structure for table `smsreminders`
--

CREATE TABLE IF NOT EXISTS `smsreminders` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) DEFAULT NULL,
  `message` varchar(160) DEFAULT NULL,
  `tophone` text,
  `senddate` int(11) DEFAULT NULL,
  `smstype` enum('Fixed','Recurring') DEFAULT NULL,
  `smsdatetime` datetime DEFAULT NULL,
  `recurringtype` enum('Every 10 Minutes','Every Half Hourly','Hourly','Every 2 Hour','Every 3 Hours','Every 6 Hours','Daily','WeekDays','Sunday','SatSun','Fortnight','Monthly','Quarterly','SixMonthly','Yearly','Fixed') DEFAULT NULL,
  `recurringfixedtypedates` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `lastsenddate` datetime DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `smsreminders`
--


-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(100) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tagname`) VALUES
(1, 'great india'),
(2, 'test'),
(3, 'great maharashtra'),
(4, 'dd'),
(5, 'aaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `code` varchar(200) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted` timestamp NULL DEFAULT NULL,
  `role` enum('Superadmin','Admin','User') NOT NULL DEFAULT 'User',
  `name` varchar(100) DEFAULT NULL,
  `squestion` varchar(255) DEFAULT NULL,
  `sanswer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `code`, `status`, `created`, `modified`, `deleted`, `role`, `name`, `squestion`, `sanswer`) VALUES
(1, 'naveenkhanchandani@gmail.com', 'password', '5b0fa0e4c041548bb6289e15d865a696', 0, '2009-03-18 03:25:38', NULL, NULL, 'User', 'naveen', 'Name of Your First School', 'new era high school'),
(2, 'mkgxy@mkgalaxy.com', 'password', '350db081a661525235354dd3e19b8c05', 0, '2009-03-24 18:18:23', NULL, NULL, 'User', 'Manish Khanchandani', 'Name of Your First School', 'new era high school'),
(3, 'naveenkhanchandani1@mkgalaxy.com', 'password', NULL, 1, '2009-04-01 06:10:40', NULL, NULL, 'User', 'Manish Khanchandani', 'Name of Your First School', 'ddddd'),
(4, 'naveen@mkgalaxy.com', 'pp', NULL, 1, '2009-04-01 06:13:06', NULL, NULL, 'User', 'mm', 'Name of Your First School', 'mm'),
(5, 'mk@mk.com', 'password', 'bc6fe82635b1429d3e886eec0fc34f49', 1, '2009-04-02 07:26:33', NULL, NULL, 'User', 'manish', 'Name of Your First School', 'manish');
