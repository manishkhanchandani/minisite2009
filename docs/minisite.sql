-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2009 at 01:54 AM
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
  `user_id` int(11) DEFAULT NULL,
  `album` varchar(200) DEFAULT NULL,
  `album_created` datetime DEFAULT NULL,
  `file_type` enum('Image','Music','Video') DEFAULT NULL,
  `public` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `id`, `user_id`, `album`, `album_created`, `file_type`, `public`) VALUES
(12, 1, 1, 'General', '2009-04-17 09:24:27', 'Image', 1),
(13, 1, 1, 'Xth Std Picnic to Mahableshwar', '2009-04-17 09:24:43', 'Image', 0);

-- --------------------------------------------------------

--
-- Table structure for table `auction_bids`
--

CREATE TABLE IF NOT EXISTS `auction_bids` (
  `bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bid_amount` float(12,2) DEFAULT NULL,
  `bid_date` datetime DEFAULT NULL,
  `charity_id` int(11) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `feepaid` float(12,2) DEFAULT NULL,
  `bstatus` int(1) NOT NULL DEFAULT '0',
  `is_winner` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `auction_bids`
--


-- --------------------------------------------------------

--
-- Table structure for table `auction_charities`
--

CREATE TABLE IF NOT EXISTS `auction_charities` (
  `charity_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `charity_name` varchar(200) DEFAULT NULL,
  `charity_site` varchar(255) DEFAULT NULL,
  `charity_url` varchar(255) DEFAULT NULL,
  `charity_description` text,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`charity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `auction_charities`
--


-- --------------------------------------------------------

--
-- Table structure for table `auction_item_settings`
--

CREATE TABLE IF NOT EXISTS `auction_item_settings` (
  `auction_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `get4price` float(12,2) DEFAULT NULL,
  `maxbidprice` float(12,2) DEFAULT NULL,
  `bidfee` float(12,2) DEFAULT NULL,
  `maxnumofbids` int(11) DEFAULT NULL,
  `charityamtperc` float(12,2) DEFAULT NULL,
  `bonus` int(1) NOT NULL DEFAULT '0',
  `freebid` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`auction_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `auction_item_settings`
--


-- --------------------------------------------------------

--
-- Table structure for table `auction_settings`
--

CREATE TABLE IF NOT EXISTS `auction_settings` (
  `auction_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `charity` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`auction_setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `auction_settings`
--


-- --------------------------------------------------------

--
-- Table structure for table `auction_user_settings`
--

CREATE TABLE IF NOT EXISTS `auction_user_settings` (
  `user_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `loyaltycredit` int(11) NOT NULL DEFAULT '0',
  `referralcredit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `auction_user_settings`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blog`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=7 ;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`category_id`, `id`, `category`, `parent_id`) VALUES
(1, 1, 't', 0),
(2, 1, 't', 0),
(3, 1, 'ddd', 0),
(4, 1, 'd', 0),
(5, 1, 'dd', 2),
(6, 1, 'eee', 5);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blog_comments`
--


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `ccategory`
--

CREATE TABLE IF NOT EXISTS `ccategory` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ccategory`
--

INSERT INTO `ccategory` (`category_id`, `id`, `category`, `parent_id`, `concept_id`, `user_id`) VALUES
(15, 1, 'test', 0, 42, 1),
(16, 1, 'aa', 0, 44, 1),
(17, 1, 'ddddd', 0, 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text,
  `pid` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


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
-- Table structure for table `deathreminder`
--

CREATE TABLE IF NOT EXISTS `deathreminder` (
  `reminder_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` int(11) DEFAULT NULL,
  `sms` int(1) DEFAULT NULL,
  `smsmessage` varchar(160) DEFAULT NULL,
  `smsphone` text,
  `emails` text,
  `login_freq` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `lastreminderdate` datetime DEFAULT NULL,
  `loginfailedattempt` int(4) DEFAULT NULL,
  `loginattemptrequired` int(4) DEFAULT NULL,
  `is_dead` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reminder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `deathreminder`
--


-- --------------------------------------------------------

--
-- Table structure for table `downtime`
--

CREATE TABLE IF NOT EXISTS `downtime` (
  `downtime_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` text,
  `usphone` varchar(50) DEFAULT NULL,
  `email` text,
  `smsphone` varchar(255) DEFAULT NULL,
  `checkfrequency` varchar(200) DEFAULT NULL,
  `datetocheck` int(11) DEFAULT NULL,
  `lastcheckdate` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `texttocheck` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`downtime_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `downtime`
--

INSERT INTO `downtime` (`downtime_id`, `id`, `user_id`, `url`, `usphone`, `email`, `smsphone`, `checkfrequency`, `datetocheck`, `lastcheckdate`, `status`, `texttocheck`, `created`) VALUES
(3, 1, 1, 'http://mkgalaxy.com', '', 'naveenkhanchandani@gmail.com', '919323532886', '5', 1240160482, 1240160182, 1, 'kumar', '2009-04-14 23:29:01'),
(4, 1, 1, 'http:xkdkd.com', '', 'naveenkhanchanani@gmail.com', '919323532886', '5', 1240160485, 1240160185, 1, 'dddd', '2009-04-14 23:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `downtime_results`
--

CREATE TABLE IF NOT EXISTS `downtime_results` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `downtime_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `check_date` datetime DEFAULT NULL,
  `pingstatus` int(1) NOT NULL DEFAULT '1',
  `textcheckstatus` int(1) NOT NULL DEFAULT '1',
  `finalstatus` int(1) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `downtime_results`
--

INSERT INTO `downtime_results` (`result_id`, `downtime_id`, `id`, `check_date`, `pingstatus`, `textcheckstatus`, `finalstatus`) VALUES
(13, 4, 1, '2009-04-15 11:30:47', 0, 0, 0),
(12, 3, 1, '2009-04-15 11:30:44', 1, 0, 0),
(11, 4, 1, '2009-04-15 11:23:46', 0, 0, 0),
(10, 4, 1, '2009-04-15 11:20:36', 0, 0, 0),
(8, 3, 1, '2009-04-14 23:38:26', 1, 0, 0),
(9, 3, 1, '2009-04-15 11:20:33', 1, 0, 0),
(14, 4, 1, '2009-04-15 11:31:29', 0, 0, 0),
(15, 3, 1, '2009-04-18 17:44:54', 1, 0, 0),
(16, 4, 1, '2009-04-18 17:45:01', 0, 0, 0),
(17, 3, 1, '2009-04-18 18:12:38', 1, 0, 0),
(18, 4, 1, '2009-04-18 18:12:42', 0, 0, 0),
(19, 3, 1, '2009-04-18 19:35:05', 1, 0, 0),
(20, 4, 1, '2009-04-18 19:35:11', 0, 0, 0),
(21, 3, 1, '2009-04-19 21:28:54', 1, 0, 0),
(22, 4, 1, '2009-04-19 21:28:57', 0, 0, 0),
(23, 3, 1, '2009-04-19 22:26:22', 1, 0, 0),
(24, 4, 1, '2009-04-19 22:26:25', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emailreminders`
--

CREATE TABLE IF NOT EXISTS `emailreminders` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) DEFAULT NULL,
  `message` text,
  `toemail` varchar(150) DEFAULT NULL,
  `senddate` int(11) DEFAULT NULL,
  `emailtype` enum('Fixed','Recurring') DEFAULT NULL,
  `emaildatetime` datetime DEFAULT NULL,
  `recurringtype` enum('Every 10 Minutes','Every Half Hourly','Hourly','Every 2 Hour','Every 3 Hours','Every 6 Hours','Daily','WeekDays','Sunday','SatSun','Fortnight','Monthly','Quarterly','SixMonthly','Yearly','Fixed') DEFAULT NULL,
  `recurringfixedtypedates` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `lastsenddate` datetime DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `emailreminders`
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
  `ref` varchar(255) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filerealname` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `fileext` varchar(15) DEFAULT NULL,
  `filetype` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `album_id` int(11) NOT NULL,
  `hosttype` enum('Image','File','Music','Video') NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `id`, `group_id`, `user_id`, `ref`, `filename`, `filerealname`, `filepath`, `filesize`, `fileext`, `filetype`, `created`, `album_id`, `hosttype`) VALUES
(1, 1, NULL, 1, '', '1616949e802bae34c3.jpg', 'scan0003.jpg', 'sc/user_1', 318573, 'jpg', 'image/jpeg', '2009-04-17 09:46:58', 13, 'Image'),
(2, 1, NULL, 1, '', '18749e802e49995c.jpg', 'scan0004.jpg', 'sc/user_1', 473872, 'jpg', 'image/jpeg', '2009-04-17 09:47:40', 13, 'Image'),
(3, 1, NULL, 1, '', '2915149e802e52489d.jpg', 'scan0005.jpg', 'sc/user_1', 520596, 'jpg', 'image/jpeg', '2009-04-17 09:47:40', 13, 'Image'),
(4, 1, NULL, 1, '', '395449e802e5a649b.jpg', 'scan0006.jpg', 'sc/user_1', 384753, 'jpg', 'image/jpeg', '2009-04-17 09:47:40', 13, 'Image'),
(5, 1, NULL, 1, '', '1269949e9304be81bf.jpg', 'scan0005.jpg', 'sc/user_1', 520596, 'jpg', 'image/jpeg', '2009-04-18 07:13:39', 13, 'Image'),
(6, 1, NULL, 1, '', '2354349e96c3ee2c0b.jpg', 'bh2.jpg', 'bh/user_1', 23541, 'jpg', 'image/jpeg', '2009-04-18 11:29:26', 13, 'Image'),
(7, 1, NULL, 1, '', '2475249e96c3f0dc11.jpg', 'bhani.jpg', 'bh/user_1', 85865, 'jpg', 'image/jpeg', '2009-04-18 11:29:26', 13, 'Image'),
(8, 1, NULL, 1, '', '857749e96c3f2c981.jpg', 'Raj.jpg', 'Ra/user_1', 33636, 'jpg', 'image/jpeg', '2009-04-18 11:29:26', 13, 'Image'),
(9, 1, NULL, 1, '', '1707149e96c3f51aa7.jpg', 'kareena_has_landed_saif.jpg', 'ka/user_1', 53094, 'jpg', 'image/jpeg', '2009-04-18 11:29:26', 13, 'Image'),
(10, 1, NULL, 1, '', '29749e96d238bec4.jpg', '12736523.WA_204170810.jpg', '12/user_1', 53761, 'jpg', 'image/jpeg', '2009-04-18 11:33:15', 12, 'Image'),
(11, 1, NULL, 1, '', '2360849e96d23df0b9.jpg', 'bld130005.jpg', 'bl/user_1', 42282, 'jpg', 'image/jpeg', '2009-04-18 11:33:15', 12, 'Image'),
(12, 1, NULL, 1, '', '37949e97dd4aa51d.png', 'Black_couple.png', 'Bl/user_1', 366015, 'png', 'image/png', '2009-04-18 12:44:28', 12, 'Image'),
(13, 1, NULL, 1, '', '1983249e97e175deef.jpg', 'anjali-jay-2.jpg', 'an/user_1', 185216, 'jpg', 'image/jpeg', '2009-04-18 12:45:35', 12, 'Image');

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
-- Table structure for table `geo_countries`
--

CREATE TABLE IF NOT EXISTS `geo_countries` (
  `con_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`con_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=227 ;

--
-- Dumping data for table `geo_countries`
--

INSERT INTO `geo_countries` (`con_id`, `name`) VALUES
(1, 'Antarctica'),
(2, 'Argentina'),
(3, 'Falkland Islands'),
(4, 'Chile'),
(5, 'French Southern Territories'),
(6, 'New Zealand'),
(7, 'Saint Helena'),
(8, 'Uruguay'),
(9, 'South Africa'),
(10, 'Brazil'),
(11, 'Lesotho'),
(12, 'Namibia'),
(13, 'French Polynesia'),
(14, 'Paraguay'),
(15, 'Swaziland'),
(16, 'Smaller Territories of Chile'),
(17, 'Botswana'),
(18, 'Mozambique'),
(19, 'Madagascar'),
(20, 'Smaller Territories of the UK'),
(21, 'Bolivia'),
(22, 'New Caledonia'),
(23, 'Zimbabwe'),
(24, 'Cook Islands'),
(25, 'Reunion'),
(26, 'Tonga'),
(27, 'Mauritius'),
(28, 'Vanuatu'),
(29, 'Fiji Islands'),
(30, 'Peru'),
(31, 'Zambia'),
(32, 'Angola'),
(33, 'Malawi'),
(34, 'American Samoa'),
(35, 'Wallis and Futuna'),
(36, 'Samoa'),
(37, 'Mayotte'),
(38, 'Comoros'),
(39, 'External Territories of Australia'),
(40, 'Congo (Dem. Rep.)'),
(41, 'Solomon Islands'),
(42, 'Tanzania'),
(43, 'Papua New Guinea'),
(44, 'Indonesia'),
(45, 'Tokelau'),
(46, 'Tuvalu'),
(47, 'East Timor'),
(48, 'Congo'),
(49, 'Kenya'),
(50, 'Ecuador'),
(51, 'Colombia'),
(52, 'Burundi'),
(53, 'Gabon'),
(54, 'Kiribati'),
(55, 'Rwanda'),
(56, 'Equatorial Guinea'),
(57, 'Uganda'),
(58, 'Somalia'),
(59, 'Maldives'),
(60, 'Nauru'),
(61, 'São Tomé and Príncipe'),
(62, 'Malaysia'),
(63, 'Cameroon'),
(64, 'Palau'),
(65, 'French Guiana'),
(66, 'Guyana'),
(67, 'Central African Republic'),
(68, 'Ethiopia'),
(69, 'Micronesia'),
(70, 'Sudan'),
(71, 'Nigeria'),
(72, 'Liberia'),
(73, 'Ivory Coast'),
(74, 'Brunei'),
(75, 'Marshall Islands'),
(76, 'Philippines'),
(77, 'Ghana'),
(78, 'Suriname'),
(79, 'Venezuela'),
(80, 'Thailand'),
(81, 'Sri Lanka'),
(82, 'Togo'),
(83, 'Benin'),
(84, 'Sierra Leone'),
(85, 'Panama'),
(86, 'Guinea'),
(87, 'Chad'),
(88, 'India'),
(89, 'Costa Rica'),
(90, 'Vietnam'),
(91, 'Burkina Faso'),
(92, 'Trinidad and Tobago'),
(93, 'Cambodia'),
(94, 'Nicaragua'),
(95, 'Mali'),
(96, 'Djibouti'),
(97, 'Guinea-Bissau'),
(98, 'Niger'),
(99, 'Grenada'),
(100, 'Netherlands Antilles'),
(101, 'Myanmar'),
(102, 'Senegal'),
(103, 'Yemen'),
(104, 'Saint Vincent and The Grenadines'),
(105, 'Eritrea'),
(106, 'Barbados'),
(107, 'Honduras'),
(108, 'Gambia'),
(109, 'El Salvador'),
(110, 'Guam'),
(111, 'Saint Lucia'),
(112, 'Guatemala'),
(113, 'Northern Mariana Islands'),
(114, 'Martinique'),
(115, 'Mexico'),
(116, 'Cape Verde'),
(117, 'Laos'),
(118, 'Mauritania'),
(119, 'Dominica'),
(120, 'Guadeloupe'),
(121, 'Belize'),
(122, 'Saudi Arabia'),
(123, 'Oman'),
(124, 'Antigua and Barbuda'),
(125, 'Saint Kitts and Nevis'),
(126, 'Virgin Islands of the United States'),
(127, 'Jamaica'),
(128, 'Dominican Republic'),
(129, 'Puerto Rico'),
(130, 'Haiti'),
(131, 'China'),
(132, 'British Virgin Islands'),
(133, 'Cayman Islands'),
(134, 'Algeria'),
(135, 'Cuba'),
(136, 'Bangladesh'),
(137, 'Bahamas'),
(138, 'Turks and Caicos Islands'),
(139, 'Taiwan'),
(140, 'Western Sahara'),
(141, 'Egypt'),
(142, 'Pakistan'),
(143, 'Libya'),
(144, 'United Arab Emirates'),
(145, 'Japan'),
(146, 'Qatar'),
(147, 'Iran'),
(148, 'Bahrain'),
(149, 'Nepal'),
(150, 'Bhutan'),
(151, 'Spain'),
(152, 'Morocco'),
(153, 'Kuwait'),
(154, 'Jordan'),
(155, 'Israel'),
(156, 'Iraq'),
(157, 'Afghanistan'),
(158, 'Palestine'),
(159, 'Tunisia'),
(160, 'Bermuda'),
(161, 'Syria'),
(162, 'Portugal'),
(163, 'Lebanon'),
(164, 'Korea (South)'),
(165, 'Cyprus'),
(166, 'Greece'),
(167, 'Malta'),
(168, 'Turkey'),
(169, 'Italy'),
(170, 'Uzbekistan'),
(171, 'Tajikistan'),
(172, 'Turkmenistan'),
(173, 'Korea (North)'),
(174, 'Azerbaijan'),
(175, 'Armenia'),
(176, 'Albania'),
(177, 'Kyrgyzstan'),
(178, 'Kazakhstan'),
(179, 'Macedonia'),
(180, 'Georgia'),
(181, 'Russia'),
(182, 'France'),
(183, 'Bulgaria'),
(184, 'Serbia and Montenegro'),
(185, 'Andorra'),
(186, 'Croatia'),
(187, 'Bosnia and Herzegovina'),
(188, 'Mongolia'),
(189, 'Romania'),
(190, 'Monaco'),
(191, 'San Marino'),
(192, 'Ukraine'),
(193, 'Slovenia'),
(194, 'Moldova'),
(195, 'Hungary'),
(196, 'Switzerland'),
(197, 'Austria'),
(198, 'Saint Pierre and Miquelon'),
(199, 'Liechtenstein'),
(200, 'Germany'),
(201, 'Slovakia'),
(202, 'Czech Republic'),
(203, 'Jersey'),
(204, 'Poland'),
(205, 'Guernsey and Alderney'),
(206, 'Luxembourg'),
(207, 'Belgium'),
(208, 'Netherlands'),
(209, 'Ireland'),
(210, 'Belarus'),
(211, 'Lithuania'),
(212, 'Isle of Man'),
(213, 'Denmark'),
(214, 'Sweden'),
(215, 'Latvia'),
(216, 'Estonia'),
(217, 'Norway'),
(218, 'Finland'),
(219, 'Greenland'),
(220, 'Faroe Islands'),
(221, 'Iceland'),
(222, 'Svalbard and Jan Mayen'),
(223, 'United States'),
(224, 'Canada'),
(225, 'United Kingdom'),
(226, 'Australia');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `mes_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `concept_id` int(11) NOT NULL DEFAULT '0',
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
-- Table structure for table `phonebook`
--

CREATE TABLE IF NOT EXISTS `phonebook` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` text,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `province` varchar(25) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zipcode` varchar(25) DEFAULT NULL,
  `email` text,
  `book_type` enum('phone','address','email','link') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `link` text,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `public` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `phonebook`
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
  `home_text` text,
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
  `login_site` int(1) NOT NULL DEFAULT '1',
  `smsusername` varchar(200) DEFAULT NULL,
  `smspassword` varchar(200) DEFAULT NULL,
  `twilio_account_sid` varchar(200) DEFAULT NULL,
  `twilio_auth_token` varchar(200) DEFAULT NULL,
  `twilio_caller_id` varchar(200) DEFAULT NULL,
  `privacy` text,
  `terms` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Dumping data for table `prebuilt_1`
--

INSERT INTO `prebuilt_1` (`id`, `keyword`, `default_id`, `home_text`, `template`, `css`, `js`, `siteurl`, `sitename`, `siteemail`, `ftphost`, `ftpuser`, `ftppassword`, `ftpdir`, `dbhost`, `db`, `dbuser`, `dbpassword`, `login_site`, `smsusername`, `smspassword`, `twilio_account_sid`, `twilio_auth_token`, `twilio_caller_id`, `privacy`, `terms`) VALUES
(1, 'xoriant solutions', 1, NULL, '<!-- start header -->\r\n<div id="header">\r\n	<div id="logo">\r\n		<h1><a href="#"><span>Xoriant</span> Solutions</a></h1>\r\n		<p>Designed By Manish Khanchandani</p>\r\n	</div>\r\n</div>\r\n	<div id="menu">\r\n		<ul id="main">\r\n			<li class="current_page_item"><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>">Homepage</a></li>\r\n			<?php if($_SESSION[''user_id'']) { ?>\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=change">Change Password</a></li>\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=logout">Logout</a></li>			\r\n			<?php } else { ?>\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=register">Register</a></li>\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=login">Login</a></li>	\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=forgot">Forgot Password</a></li>				\r\n			<?php } ?>\r\n		</ul>\r\n	</div>\r\n	\r\n<!-- end header -->\r\n<div id="wrapper">\r\n	<!-- start page -->\r\n	<div id="page">\r\n		<div id="sidebar1" class="sidebar">\r\n			<ul>\r\n				<li>\r\n					<h2>Modules</h2>\r\n					<ul>\r\n						<?php echo $MENU2; ?>\r\n					</ul>\r\n				</li>\r\n			</ul>\r\n		</div>\r\n		<!-- start content -->\r\n		[[BODY]]\r\n		<div style="clear: both;"></div>\r\n	</div>\r\n	<!-- end page -->\r\n</div>\r\n<div id="footer">\r\n	<p class="copyright">copyright </p>\r\n	<p class="link"><a href="#">Privacy Policy</a> - <a href="#">Terms of Use</a></p>\r\n</div>', 'body {\r\n	margin: 0px;\r\n	padding: 0;\r\n	background: url(../../images/coolblack/img01.jpg) repeat-x left top;\r\n	text-align: justify;\r\n	font-family: Georgia, "Times New Roman", Times, serif;\r\n	font-size: 12px;\r\n	color: #616161;\r\n}\r\n\r\nh1, h2, h3 {\r\n	margin-top: 0;\r\n	color: #A66100;\r\n}\r\n\r\nh1 {\r\n	font-size: 1.6em;\r\n	font-weight: normal;\r\n}\r\n\r\nh2 {\r\n	font-size: 1.6em;\r\n}\r\n\r\nh3 {\r\n	font-size: 1em;\r\n}\r\n\r\nul {\r\n}\r\n\r\na {\r\n	text-decoration: none;\r\n	color: #A66100;\r\n}\r\n\r\na:hover {\r\n	border-bottom: none;\r\n}\r\n\r\na img {\r\n	border: none;\r\n}\r\n\r\nimg.left {\r\n	float: left;\r\n	margin: 0 20px 0 0;\r\n}\r\n\r\nimg.right {\r\n	float: right;\r\n	margin: 0 0 0 20px;\r\n}\r\n\r\n#header {\r\n	width: 960px;\r\n	margin: 0 auto;\r\n	height: 165px;\r\n	background: url(../../images/coolblack/img02.jpg) no-repeat left top;\r\n}\r\n\r\n/* Header */\r\n\r\n#logo {\r\n	width: 960px;\r\n	height: 100px;\r\n	margin: 0 auto;\r\n	padding: 60px 10px 0 10px;\r\n}\r\n\r\n#logo h1, #logo p {\r\n	float: left;\r\n	margin: 0;\r\n	color: #00D8D5;\r\n}\r\n\r\n#logo span {\r\n	color: #FFFFFF;\r\n}\r\n\r\n#logo h1 {\r\n	padding: 25px 0 0 0;\r\n	letter-spacing: -1px;\r\n	text-transform: lowercase;\r\n	font-weight: normal;\r\n	font-size: 3em;\r\n}\r\n\r\n#logo p {\r\n	text-transform: uppercase;\r\n	padding: 47px 0 0 3px;\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n}\r\n\r\n#logo a {\r\n	border: none;\r\n	text-decoration: none;\r\n	color: #DC8700;\r\n}\r\n\r\n/* Menu */\r\n\r\n#menu {\r\n	width: 960px;\r\n	margin: 0 auto;\r\n	padding: 0;\r\n	height: 59px;\r\n	background: url(../../images/coolblack/img03.jpg) no-repeat left top;\r\n}\r\n\r\n#menu ul {\r\n	margin: 0;\r\n	padding-left: 270px;\r\n	list-style: none;\r\n}\r\n\r\n#menu li {\r\n	display: inline;\r\n}\r\n\r\n#menu a {\r\n	display: block;\r\n	float: left;\r\n	height: 41px;\r\n	margin: 0;\r\n	padding: 18px 40px 0 40px;\r\n	background: url(../../images/coolblack/img08.jpg) no-repeat left 30%;\r\n	text-decoration: none;\r\n	text-transform: capitalize;\r\n	font-family: Georgia, "Times New Roman", Times, serif;\r\n	font-size: 12px;\r\n	color: #FFFFFF;\r\n}\r\n\r\n#menu a:hover {\r\n	color: #FFFFFF;\r\n}\r\n\r\n#menu .current_page_item a {\r\n	color: #FFFFFF;\r\n}\r\n\r\n/* Wrapper */\r\n\r\n#wrapper {\r\n}\r\n\r\n/* Page */\r\n\r\n#page {\r\n	width: 960px;\r\n	margin: 0 auto;\r\n	padding: 20px 5px;\r\n	background: #FFFFFF;\r\n}\r\n\r\n#page-bg {\r\n}\r\n\r\n/* Latest Post */\r\n\r\n#latest-post {\r\n	padding: 20px;\r\n	border: 1px solid #E7E7E7;\r\n}\r\n\r\n/* Content */\r\n\r\n#content {\r\n	float: left;\r\n	width: 480px;\r\n}\r\n\r\n.post {\r\n	padding-bottom: 15px;\r\n	line-height: 200%;\r\n}\r\n\r\n.post h1 {\r\n	font-weight: normal;\r\n}\r\n\r\n.title {\r\n	height: 78px;\r\n	margin: 0;\r\n	padding: 15px 0 4px 20px;\r\n	font-weight: normal;\r\n	background: url(../../images/coolblack/img07.jpg) no-repeat left top;\r\n}\r\n\r\n.title a {\r\n	border-bottom: none;\r\n	color: #FFFFFF;\r\n}\r\n\r\n.title a:hover {\r\n	border-bottom: 1px dotted #000000;\r\n}\r\n\r\n.byline {\r\n	margin: -60px 20px 20px 20px;\r\n}\r\n\r\n.byline a {\r\n	color: #DC8700;\r\n}\r\n\r\n.tag {\r\n	padding: 0 15px;\r\n}\r\n\r\n.entry {\r\n	padding: 0 20px;\r\n}\r\n\r\n.links {\r\n	padding: 4px 0px;\r\n	text-align: right;\r\n	font-weight: bold;\r\n}\r\n\r\n.links a {\r\n	border: none;\r\n}\r\n\r\n.links a:hover {\r\n}\r\n\r\n/* Sidebars */\r\n\r\n#sidebar1 {\r\n	float: left;\r\n	margin-top: -70px;\r\n}\r\n\r\n#sidebar2 {\r\n	float: right;\r\n}\r\n\r\n.sidebar {\r\n	float: left;\r\n	width: 240px;\r\n	padding: 0;\r\n	font-size: 12px;\r\n}\r\n\r\n.sidebar ul {\r\n	margin: 0;\r\n	padding: 0;\r\n	list-style: none;\r\n}\r\n\r\n.sidebar li {\r\n	padding: 0 0 20px 0;\r\n}\r\n\r\n.sidebar li ul {\r\n}\r\n\r\n.sidebar li li {\r\n	margin: 0 20px 0 15px;\r\n	padding: 8px 0px;\r\n	border-bottom: 1px dashed #C5C4C4;\r\n}\r\n\r\n\r\n.sidebar li h2 {\r\n	height: 40px;\r\n	margin: 0 0 0 0;\r\n	padding: 20px 15px 0px 65px;\r\n	background: url(../../images/coolblack/img04.jpg) no-repeat left top;\r\n	letter-spacing: -1px;\r\n	font-size: 16px;\r\n	font-weight: normal;\r\n	color: #FFFFFF;\r\n}\r\n\r\n.sidebar a {\r\n}\r\n\r\n/* Search */\r\n\r\n#searchform {\r\n	margin: 0;\r\n	padding: 0 0 0 0;\r\n}\r\n\r\n#searchform br {\r\n	display: none;\r\n}\r\n\r\n#searchform h2 {\r\n}\r\n\r\n#s {\r\n	margin: 10px 0px 0 15px;\r\n	padding: 2px 2px;\r\n	width: 180px;\r\n	height: 18px;\r\n	border: 1px solid #6F6E6E;\r\n	background: #FFFFFF;\r\n	font-size: 10px;\r\n	color: #000000;\r\n}\r\n\r\n#x {\r\n	margin: 0;\r\n	padding: 2px 5px;\r\n	height: 25px;\r\n	background: #CA8186;\r\n	text-decoration: none;\r\n	text-transform: uppercase;\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	font-size: 10px;\r\n	color: #CCCCCC;\r\n}\r\n/* Calendar */\r\n\r\n#calendar_wrap {\r\n	padding: 0 15px;\r\n	text-align: center;\r\n}\r\n\r\n#calendar_wrap table {\r\n	width: 100%;\r\n}\r\n\r\n#calendar_wrap th {\r\n}\r\n\r\n#calendar_wrap td {\r\n}\r\n\r\n#calendar_wrap tfoot td {\r\n	border: none;\r\n}\r\n\r\n#calendar_wrap tfoot td#prev {\r\n	text-align: left;\r\n	font-weight: bold;\r\n	border: none;\r\n}\r\n\r\n#calendar_wrap tfoot td#prev a {\r\n	border: none;\r\n}\r\n\r\n#calendar_wrap tfoot td#next {\r\n	text-align: right;\r\n	font-weight: bold;\r\n	border: none;\r\n}\r\n\r\n#calendar_wrap tfoot td#next a {\r\n	border: none;\r\n}\r\n\r\n/* Footer */\r\n\r\n#footer {\r\n	width: 960px;\r\n	height: 70px;\r\n	margin: 0 auto;\r\n	padding: 0 20px;\r\n	background: #2E2E2E;\r\n}\r\n\r\n#footer p {\r\n	margin: 0;\r\n	padding: 25px 0 0 0;\r\n	text-align: center;\r\n	font-size: smaller;\r\n}\r\n\r\n#footer a {\r\n}\r\n\r\n#footer .link {\r\n	float: right;\r\n}\r\n\r\n#footer .copyright {\r\n	float: left;\r\n}\r\n\r\n', NULL, 'http://india.com', 'xoriant solutions', 'admin@mumbaionline.org.in', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nkhanchandani', 'password', 'AC94b06e556ff5dc4047cf5599522ff470', '4a11eb43a9ab1c1eeaa7d2db067daf73', '919-386-1678', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prebuilt_2_concepts`
--

CREATE TABLE IF NOT EXISTS `prebuilt_2_concepts` (
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `homepage` int(1) NOT NULL DEFAULT '1',
  `displayname` varchar(200) NOT NULL,
  `home_text` text,
  `priority` int(11) NOT NULL DEFAULT '999',
  `concept_value` text,
  `selfhomepage` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`concept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prebuilt_2_concepts`
--

INSERT INTO `prebuilt_2_concepts` (`id`, `concept_id`, `homepage`, `displayname`, `home_text`, `priority`, `concept_value`, `selfhomepage`) VALUES
(1, 1, 1, '', '', 0, '', 0),
(1, 5, 0, '', '', 0, 'india, china', 0),
(1, 10, 0, '', '', 0, '', 0),
(1, 7, 0, '', '', 0, '', 0),
(1, 15, 0, '', '', 0, '', 0),
(1, 8, 0, '', '', 0, '', 0),
(1, 9, 0, '', '', 0, '', 0),
(1, 35, 0, '', '', 0, '', 0),
(1, 16, 0, '', '', 0, '', 0),
(1, 34, 0, '', '', 0, '', 0),
(1, 17, 0, '', '', 0, '', 0),
(1, 21, 0, '', '', 0, '', 0),
(1, 36, 0, '', '', 0, '', 0),
(1, 37, 0, '', '', 0, '', 0),
(1, 38, 0, '', '', 0, '', 0),
(1, 39, 0, '', '', 0, '', 0),
(1, 40, 0, '', '', 0, '', 0),
(1, 41, 0, '', '', 0, '', 0),
(1, 42, 0, '', '', 0, '', 0),
(1, 43, 0, '', '', 0, '', 0),
(1, 44, 0, '', '', 0, '', 0),
(1, 45, 0, '', '', 0, '', 0),
(1, 46, 0, '', '', 0, '', 0),
(1, 33, 0, '', '', 0, '', 0),
(1, 32, 0, '', '', 0, '', 0),
(1, 31, 0, '', '', 0, '', 0),
(1, 19, 0, '', '', 0, '', 0),
(1, 20, 0, '', '', 0, '', 0),
(1, 22, 0, '', '', 0, '', 0),
(1, 23, 0, '', '', 0, '', 0),
(1, 24, 0, '', '', 0, '', 0),
(1, 25, 0, '', '', 0, '', 0),
(1, 26, 0, '', '', 0, '', 0),
(1, 27, 0, '', '', 0, '', 0),
(1, 28, 0, '', '', 0, '', 0),
(1, 29, 0, '', '', 0, '', 0),
(1, 30, 0, '', '', 0, '', 0),
(1, 47, 0, '', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prebuilt_3_settings`
--

CREATE TABLE IF NOT EXISTS `prebuilt_3_settings` (
  `id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  `setting_value` text,
  PRIMARY KEY (`id`,`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prebuilt_3_settings`
--

INSERT INTO `prebuilt_3_settings` (`id`, `setting_id`, `setting_value`) VALUES
(1, 13, 'multi'),
(1, 1, '1'),
(1, 2, '2'),
(1, 10, '10'),
(1, 9, '9'),
(1, 11, '11'),
(1, 12, '12');

-- --------------------------------------------------------

--
-- Table structure for table `prebuilt_concepts`
--

CREATE TABLE IF NOT EXISTS `prebuilt_concepts` (
  `concept_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept` varchar(200) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `cpriority` int(11) NOT NULL DEFAULT '999',
  PRIMARY KEY (`concept_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `prebuilt_concepts`
--

INSERT INTO `prebuilt_concepts` (`concept_id`, `concept`, `active`, `cpriority`) VALUES
(1, 'blog', 1, 2),
(5, 'news', 1, 3),
(7, 'smsreminder', 1, 4),
(8, 'emailreminder', 1, 5),
(9, 'filehost', 1, 6),
(10, 'youtube', 1, 9),
(11, 'gtalk', 0, 10),
(13, 'allchat', 0, 11),
(14, 'cricketscore', 0, 12),
(15, 'sendsms', 1, 999),
(16, 'downtimealert', 1, 8),
(17, 'imagehost', 1, 7),
(18, 'auction4cause', 0, 1),
(19, 'musicalbum', 1, 999),
(20, 'videoalbum', 1, 999),
(21, 'photoalbum', 1, 999),
(22, 'ask', 1, 999),
(23, 'faq', 1, 999),
(24, 'deathreminder', 1, 999),
(25, 'events', 1, 999),
(26, 'messages', 1, 999),
(27, 'polls', 1, 999),
(28, 'profile', 1, 999),
(29, 'cart', 1, 999),
(30, 'emailsmsreminder', 1, 999),
(31, 'phonereminder', 1, 999),
(32, 'auction', 1, 999),
(33, 'classifieds', 1, 999),
(34, 'directory', 1, 999),
(35, 'realestate', 1, 999),
(36, 'automobile', 1, 999),
(37, 'dating', 1, 999),
(38, 'matrimonial', 1, 999),
(39, 'modelling', 1, 999),
(40, 'hotels', 1, 999),
(41, 'restaurants', 1, 999),
(42, 'phonebook', 1, 999),
(43, 'addressbook', 1, 999),
(44, 'emailbook', 1, 999),
(45, 'linkbook', 1, 999),
(46, 'history', 1, 999),
(47, 'notes', 1, 999);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `prebuilt_concepts_settings`
--

INSERT INTO `prebuilt_concepts_settings` (`setting_id`, `concept_id`, `setting_label`, `comments`, `inputtype`, `reference`, `setting_vals`) VALUES
(1, 5, 'Yahoo News', 'http://news.search.yahoo.com/news/rss?p=[[KEYWORD]]&ei=UTF-8&fl=0&x=wrt\r\n', 'checkbox', 'yahoonews', NULL),
(2, 5, 'Google News', 'http://news.google.com/news?pz=1&ned=us&hl=en&q=[[KEYWORD]]&output=rss', 'checkbox', 'googlenews', NULL),
(10, 10, 'Top Rated Videos', NULL, 'checkbox', 'toprated', NULL),
(9, 10, 'Most Viewed Videos', NULL, 'checkbox', 'mostviewed', NULL),
(11, 10, 'Recently Featured Videos', NULL, 'checkbox', 'featured', NULL),
(12, 10, 'Large Result Set', NULL, 'checkbox', 'largeresultset', NULL),
(13, 1, 'Category', NULL, 'radio', NULL, 'nocat|No Category||single|Single Level Category||multi|Multilevel Category');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=7 ;

--
-- Dumping data for table `prebuilt_templates`
--

INSERT INTO `prebuilt_templates` (`tid`, `name`, `template`, `css`, `js`) VALUES
(4, 'Master Template', '<div id="mainBody">\r\n	<div id="mainHeader">\r\n		<h1><?php echo ucwords($SITE[0][''sitename'']); ?></h1>\r\n		<p><?php echo $SITE[0][''home_text'']; ?></p>\r\n	</div>\r\n	<div id="mainLower">\r\n		<div id="mainNavigation">\r\n			<?php echo $MENU; ?>		\r\n		</div>\r\n		<div id="mainContent">\r\n			[[BODY]]\r\n		</div>\r\n		<div id="mainFooter">\r\n			<p>Copyright 2009</p>\r\n		</div>\r\n	</div>\r\n</div>', '<!--\r\nbody {\r\n	background-color: #990099;\r\n	margin: 0px;\r\n	padding: 0px;\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\ntd, th, table, p, select, input, textarea {\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\na {\r\n	text-decoration: none;\r\n}\r\n#mainBody {\r\n	width: 800px;\r\n	border: 1px solid #000000;\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	margin-top:-25px;\r\n}\r\n#mainBody #mainHeader {\r\n	background-color: #000000;\r\n	text-align:center;\r\n	padding-top:25px;\r\n}\r\n#mainBody #mainHeader h1 {\r\n	font-size: 36px;\r\n	font-weight: bold;\r\n	color: #FFFFFF;\r\n}\r\n#mainBody #mainHeader p {\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n	text-align:center;\r\n	margin-top: -20px;\r\n	padding-bottom: 25px;\r\n}\r\n#mainBody #mainLower {\r\n	background-color: #FFFFFF;\r\n	margin-top: -20px;\r\n	padding-bottom: 15px;\r\n}\r\n#mainBody #mainLower #mainNavigation {\r\n	padding: 5px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990099;\r\n}\r\n#mainBody #mainLower #mainContent {\r\n	padding: 10px;\r\n	min-height: 300px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990099;\r\n}\r\n-->', NULL),
(5, 'Auction4Cause', '<table border="0" cellpadding="0" cellspacing="0" width="781">\r\n  <tbody><tr> \r\n    <td colspan="2" background="<?php echo HTTPPATH; ?>/auction4cause/images/top3.gif" height="107"> \r\n      <table cellpadding="0" cellspacing="0" width="100%">\r\n        <tbody><tr> \r\n          <td width="37%" height="52"> \r\n            <div align="right"><a href="<?php echo HTTPPATH; ?>"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" border="0" width="242" height="52"></a></div>\r\n\r\n          </td>\r\n          <td class="bodytext" align="left" valign="top" width="63%" height="55"> \r\n            <div align="center"><font size="2"><b>Where you get amazing deals \r\n              while supporting charities<br>\r\n              <font color="#660099">Charities get at least 25% of net proceeds</font></b></font></div>\r\n          </td>\r\n        </tr>\r\n        <tr> \r\n          <td colspan="2" align="right">\r\n		  <a href="<?php echo HTTPPATH; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(''main'','''',''<?php echo HTTPPATH; ?>/auction4cause/images/main-after.gif'',1)"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/main-before.gif" name="main" border="0" width="100" height="25"></a><img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" width="3" height="1"><a href="http://www.auctions4acause.com/charities.asp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(''charities'','''',''<?php echo HTTPPATH; ?>/auction4cause/images/charities-after.gif'',1)"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/charities-before.gif" name="charities" border="0" width="100" height="25"></a><img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" width="3" height="1"><a href="http://www.auctions4acause.com/winners.asp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(''winners'','''',''<?php echo HTTPPATH; ?>/auction4cause/images/winners-after.gif'',1)"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/winners-before.gif" name="winners" border="0" width="100" height="25"></a><img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" width="3" height="1"><a href="http://www.auctions4acause.com/free-auctions.asp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(''free'','''',''<?php echo HTTPPATH; ?>/auction4cause/images/free-after.gif'',1)"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/free-before.gif" name="free" border="0" width="100" height="25"></a><img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" width="3" height="1"><a href="http://www.auctions4acause.com/referafriend.asp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(''refer'','''',''<?php echo HTTPPATH; ?>/auction4cause/images/friend-after.gif'',1)"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/friend-before.gif" name="refer" border="0" width="100" height="25"></a><img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" width="3" height="1"><a href="http://www.auctions4acause.com/faq.asp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(''faq'','''',''<?php echo HTTPPATH; ?>/auction4cause/images/faq-after.gif'',1)"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/faq-before.gif" name="faq" border="0" width="100" height="25"></a><img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" width="3" height="1"><a href="http://www.auctions4acause.com/aboutus.asp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(''about'','''',''<?php echo HTTPPATH; ?>/auction4cause/images/about-after.gif'',1)"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/about-before.gif" name="about" border="0" width="100" height="25"></a><img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" width="3" height="1"> </td>\r\n        </tr>\r\n      </tbody></table>\r\n        \r\n         </td>\r\n  </tr>\r\n  <tr> \r\n    <td align="center" background="<?php echo HTTPPATH; ?>/auction4cause/images/left-gif.gif" valign="top" width="150">\r\n      <p> </p>\r\n      <p><a href="http://www.auctions4acause.com/howdoesitwork.asp"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/how-gif.gif" border="0" width="140" height="50"></a>\r\n	  </p>\r\n      <p class="bodytext"><b></b></p>\r\n	  </p><!-- Page name = -->\r\n	  \r\n<p><span class="orangebody">Offers valid in</span><br>\r\n  <img src="<?php echo HTTPPATH; ?>/auction4cause/images/flag_icon_usa.gif" width="32" height="18" title="Offers Valid in US & Canada. Prices are in USD" alt="Offers Valid in US & Canada. Prices are in USD"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/flag_icon_canada.gif" width="32" height="18" title="Offers Valid in US & Canada. Prices are in USD" alt="Offers Valid in US & Canada. Prices are in USD"></p>\r\n\r\n\r\n<p>\r\n	  <table width="145" bordercolor="#FF00FF" cellpadding="0" cellspacing="0">\r\n        <tr>\r\n\r\n          <td width="9" height="33"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/member-topl-gif.gif" width="9" height="33"></td>\r\n          <td background="<?php echo HTTPPATH; ?>/auction4cause/images/member-top-gif.gif" height="33"> \r\n            <div align="center"><font color="#FFFFFF" class="smalltext"><b class="bodytext"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" width="8" height="8" align="middle"><span class="smalltext">You are not logged in.<img src="<?php echo HTTPPATH; ?>/auction4cause/images/pix3.gif" width="8" height="8" align="absbottom"></span></b></font></div>\r\n          </td>\r\n          <td width="9" height="33"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/member-topr-gif.gif" width="9" height="33"></td>\r\n        </tr>\r\n        <tr>\r\n          <td background="<?php echo HTTPPATH; ?>/auction4cause/images/member-sidel-gif.gif" width="9"> </td>\r\n          \r\n    <td bgcolor="#FFFFFF" align="center" valign="top"> \r\n      <p class="orangebodycap"><b><p>\r\n\r\n						\r\n								</p></b>\r\n						\r\n						\r\n      \r\n				<table class="menu" cellpadding="1" cellspacing="0">\r\n					<tr>\r\n						<td align="left">\r\n							<p><span class="bodytext"><b>\r\n							Not a member yet?<br> *<a href="https://www.auctions4acause.com/memberapp.asp">Register for free</a><br> *Receive a FREE Auction bid credit!<p><a href="https://www.auctions4acause.com/memberapp.asp" title="Click to register">REGISTER NOW</a><p><a class="menubox" href = "https://www.auctions4acause.com/memberlogin.asp" title = "Click to Log In">Already a Member? <br>Please Login</a><p>\r\n\r\n								</b>\r\n							</span>	\r\n						</td>\r\n					</tr>\r\n				</table>\r\n\r\n		\r\n\r\n          </td>\r\n          <td width="9" background="<?php echo HTTPPATH; ?>/auction4cause/images/member-sider-gif.gif"> </td>\r\n        </tr>\r\n\r\n	\r\n        <tr>\r\n          <td width="9" valign="top" height="14"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/member-botl-gif.gif" width="9" height="14"></td>\r\n          <td background="<?php echo HTTPPATH; ?>/auction4cause/images/member-bot-gif.gif" height="14" align="center" valign="top"></td>\r\n          <td width="9" valign="top" height="14"><img src="<?php echo HTTPPATH; ?>/auction4cause/images/member-botr-gif.gif" width="9" height="14"></span></td>\r\n        </tr>\r\n      </table>\r\n	  <p>\r\n	  <table align="right">\r\n	  <tr>\r\n\r\n	  	<td><b><a class="undermenubox" href="/referafriend.asp" title="Click to refer a friend and earn Free Auction bid credits!">Refer a Friend<br>Earn FREE Auction<br>Bid Credits!</a></b></td>\r\n	  </tr>\r\n	  <tr>\r\n			<td title="Free Shipping!"><br />	<b><font color="#FF6633" class="bodytext">FREE<br />SHIPPING<br />on every<br />product!</font></b>\r\n			<br />\r\n\r\n			</td>\r\n	  </tr>\r\n	  </table>\r\n	\r\n<p /> \r\n<p />  \r\n\r\n      <p> </p>\r\n      <p> </p>\r\n      <p> </p>\r\n      <p> </p>\r\n      <p><img src="images/shipping-gif.gif" width="100" height="128" alt="Free shipping on the unqiue bid auctions"></p>\r\n\r\n      <p> </p>\r\n      <p>\r\n</p>\r\n     \r\n      <p class="bodytext"><b></b></p>\r\n      <p> </p>\r\n    </td>\r\n    <td valign="top" align="left" width="631"> \r\n	[[BODY]]\r\n    </td>\r\n  </tr>\r\n</table>\r\n<table width="781" border="0" cellpadding="0" cellspacing="0" mm:layoutgroup="true">\r\n  <tr> \r\n    <td width="781" height="72" valign="middle" background="<?php echo HTTPPATH; ?>/auction4cause/images/bottom-gif.gif" align="center">\r\n	 \r\n<p align="center" /><a href="../faq.asp" class="botnav" title="Frequently Asked Questions">Frequently \r\n  Asked Questions</a> | <a href="../charities.asp" class="botnav" title="Charity Listings">Charity \r\n  Listings</a> | <a href="../suggest.asp" class="botnav" title="Suggest a Product">Suggest \r\n  a Product</a> | <a href="../l1.asp" class="botnav" title="Links">Links</a> \r\n  | <a href="../affiliates.asp" class="botnav" title="Affiliate Program">Affiliate \r\n  Program</a> | <a href="../aboutus.asp" class="botnav" title="About Us">About \r\n  Us</a><br>\r\n\r\n  <a href="../useragreement.asp" class="botnav" title="User Agreement & Rules">User \r\n  Agreement & Rules</a> | <a href="../privacy.asp" class="botnav" title="Privacy Policy">Privacy \r\n  Policy</a> | <a href="../secure.asp" class="botnav" title="Security">Security</a> \r\n  | <a href="http://auctions4acause.blogspot.com/" class="botnav" title="About Us" target="_blank">Blog</a> \r\n  | <a href="../sitemap.asp" class="botnav" title="About Us">Site Map</a> | <a href="../referafriend.asp" class="botnav" title=""></a><a href="../referafriend.asp" class="botnav" title="Tell a Friend">Tell \r\n  a Friend</a> <br />\r\n\r\n  <span class="bodywhite" align="center" title="© 2009 Auctions4aCause.com">© \r\n  2009 Copyright</span> \r\n  \r\n	</td>\r\n  </tr>\r\n</table>', 'body {\r\n	font-family: Verdana, Arial, Helvetica, sans-serif;\r\n	font-size: 12px;\r\n	margin-top: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\n.bodywhite {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; }\r\n\r\n.bodytext {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px}\r\n\r\n.bodytextbold {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;}\r\n\r\n.bidfeetotal {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;\r\n	font-weight: bold; \r\n}\r\n\r\n.bigbodytext {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px}\r\n\r\n.tallbodytext {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; line-height:17px;}\r\n\r\n.smallbody { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px }\r\n.smallbodyred { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: red; }\r\n\r\n.smalltext {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; letter-spacing: normal}\r\n.smalltextred {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; letter-spacing: normal; color: red;}\r\n.smalltextredbold {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; letter-spacing: normal; color: red; font-weight: bold;}\r\n\r\n.orangebody { color: #FF6633;  font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold}\r\n.orangebodycap { color: #FF6633;  font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-decoration: capitalize;}\r\n.orangebodysmalltext { color: #FF6633;  font-family: Arial, Helvetica, sans-serif; font-size: 9px; font-weight: bold}\r\n\r\n.highestuniquebreakdown  {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #660099; font-weight: bold; font-size: 12px; letter-spacing: normal; }\r\n\r\nh1 {  font-family: Arial, Helvetica, sans-serif; font-size: 20px; line-height: normal; font-weight: bold}\r\nh1.product { font-family: Arial, Helvetica, sans-serif; font-size: 20px; line-height: normal; font-weight: bold;  color: #660099;}\r\nh2 {  font-family: Arial, Helvetica, sans-serif; font-size: 15px; font-weight: bold}\r\nh3 {  font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold}\r\n\r\n.price {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; color: #FFFFFF;}\r\n\r\n\r\n.bulletbig {  font-family: Arial, Helvetica, sans-serif; font-size: 16px; list-style-image: url(../images/sun-sm.gif); list-style-position: inside}\r\n\r\n.button { font: bold  Arial, Helvetica, Geneva, sans-serif;\r\n				color: #ffffff;\r\n				background-color: #660099;\r\n				 font-size: 12px}\r\n\r\ninput.btn{\r\n   color:#ffffff;\r\n   font-family:''trebuchet ms'',helvetica,sans-serif;\r\n   font-size: 12px ;\r\n   font-weight:bold;\r\n   background-color:#660099;\r\n   border:1px solid;\r\n   border-top-color:#660099;\r\n   border-left-color:#660099;\r\n   border-right-color:#000000;\r\n   border-bottom-color:#000000;\r\n   filter:progid:DXImageTransform.Microsoft.Gradient\r\n      (GradientType=0,StartColorStr=''#ffffffff'',EndColorStr=''#660099''); 	  }\r\n\r\ninput.btnhov{\r\n   border-top-color:#c63;\r\n   border-left-color:#c63;\r\n   border-right-color:#930;\r\n   border-bottom-color:#930;}\r\n\r\n\r\na.menubox:link { font-size: 9px; color: #660099; text-decoration: none; }\r\na.menubox:active { font-size: 9px; color: #FF0000; text-decoration: none; }\r\na.menubox:visited { font-size: 9px; color: #660099; text-decoration: none; }\r\na.menubox:visited:hover { font-size: 9px; color: #FF6633;  text-decoration: none; }\r\na.menubox:hover { font-size: 9px; color: #FF6633;  text-decoration: underline; }\r\n\r\na.undermenubox:link { font-size: 9px; color: #FF6633; text-decoration: underline; }\r\na.undermenubox:active { font-size: 9px; color: #FF0000; text-decoration: none; }\r\na.undermenubox:visited { font-size: 9px; color: #FF6633; text-decoration: underline; }\r\na.undermenubox:visited:hover { font-size: 9px; color: #0000FF;  text-decoration: none; }\r\na.undermenubox:hover { font-size: 9px; color: #0000FF;  text-decoration: none; }\r\n\r\na.botnav:link { font-size: 11px; color: #FFFFFF; text-decoration: underline; font-weight: normal;}\r\na.botnav:active { font-size: 11px; color: #FF6633; text-decoration: none; font-weight: normal;}\r\na.botnav:visited { font-size: 11px; color: #FFFFFF; text-decoration: underline; font-weight: normal; }\r\na.botnav:visited:hover { font-size: 11px; color: #FF6633;  text-decoration: none; font-weight: normal; }\r\na.botnav:hover { font-size: 11px; color: #FF6633;  text-decoration: none; font-weight: normal; }\r\n\r\na.pagenav:link { font-size: 12px; color: #FF6633; text-decoration: underline; }\r\na.pagenav:active { font-size: 12px; color: #FF0000; text-decoration: none; }\r\na.pagenav:visited { font-size: 12px; color: #FF6633; text-decoration: underline; }\r\na.pagenav:visited:hover { font-size: 12px; color: #0000FF;  text-decoration: none; }\r\na.pagenav:hover { font-size: 12px; color: #0000FF;  text-decoration: none; }\r\n\r\n\r\na.auctionnav:link { font-size: 12px; color: #FF6633; text-decoration: underline; }\r\na.auctionnav:active { font-size: 12px; color: #FF0000; text-decoration: none; }\r\na.auctionnav:visited { font-size: 12px; color: #FF6633; text-decoration: underline; }\r\na.auctionnav:visited:hover { font-size: 12px; color: #0000FF;  text-decoration: none; }\r\na.auctionnav:hover { font-size: 12px; color: #0000FF;  text-decoration: none; }\r\n\r\n\r\na:active {  color: #FF0000}\r\na:link {  color: #0000FF; text-decoration: underline}\r\na:visited {  color: #6600FF; text-decoration: underline}\r\na:hover {  color: #FF6633}\r\na:visited:hover {  color: #FF6633; text-decoration: underline}\r\n\r\n.friend td { font-family: Arial, Helvetica, sans-serif; \r\n				font-size:9pt;\r\n				color: #ffffff;\r\n				}\r\n\r\n.menu td {  font-family: Verdana, Arial, Helvetica, sans-serif; \r\n				font-size:9pt;				\r\n				}\r\n\r\n.orangeH3 { color: #FF6633;  font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold}\r\n.purpleH3  { color: #660099;  font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold}\r\n.largepurpletext  { color: #660099;  font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-weight: bold}\r\n\r\n.required {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FF6600; font-size: 10px; letter-spacing: normal; }\r\n\r\n.formTableTitle { font-family: Verdana, Arial, Helvetica, sans-serif; color: #660099; font-size: 11px; letter-spacing: normal;	}\r\n\r\n.formHead { font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 11px; letter-spacing: normal;	}\r\n\r\n.formTableDataR1 { font-family: Verdana, Arial, Helvetica, sans-serif; color: #660099; font-size: 10px; letter-spacing: normal;\r\n							border:1px black solid; border-bottom:3px #660099 double}\r\n\r\n.formTableDataR { font-family: Verdana, Arial, Helvetica, sans-serif; color: #660099; font-size: 11px; letter-spacing: normal;\r\n							border:1px black solid;}\r\n\r\n.formTableData { font-family: Verdana, Arial, Helvetica, sans-serif; color: #660099; font-size: 11px; letter-spacing: normal;	}\r\n\r\n.formTableRowhighlight { font-family: Verdana, Arial, Helvetica, sans-serif; color: #660099; font-size: 11px; letter-spacing: normal; background-color: #FFFF99;}\r\n\r\n\r\n.errclassemail { font-family: Verdana, Arial, Helvetica, sans-serif; color: #FF0000; font-size: 10px; letter-spacing: normal;	\r\n								background-color: #FFFF99;	}\r\n\r\n.errclasspw { font-family: Verdana, Arial, Helvetica, sans-serif; color: #FF0000; font-size: 10px; letter-spacing: normal;	\r\n								background-color: #FFFF99;	}\r\n.errclassform { font-family: Verdana, Arial, Helvetica, sans-serif; color: #FF0000; font-size: 14px; letter-spacing: normal;	\r\n								background-color: #FFFF99;	}\r\n\r\n.difftable { border-color: #660099; border-collapse: collapse; }\r\n\r\n.strike  { text-decoration: line-through; }\r\n\r\n.capthis { text-decoration: capitalize; }\r\n\r\n\r\n/*MyBids page*/\r\n.uniqueclass  {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FF6600; font-size: 9px; letter-spacing: normal; }\r\n.normclass  {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; font-size: 9px; letter-spacing: normal; }\r\n.highestuniqueclass  {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #660099; font-weight: bold; font-size: 10px; letter-spacing: normal; }\r\n\r\n/*MyBids page*/\r\n\r\n#at16lb{    display: none;   position: absolute;   top: 0%;   left: 0%;   width: 100%;   height: 100%;   z-index:1001;   background-color: black;   opacity:0.001;   filter:alpha(opacity=0.001)} .at15a{border:0px;height:0px;margin:0px;padding:0px;width:100%;width:230px}.atnt {text-align:center!important;padding:6px 0px 0px 0px!important;height:24px!important}.atnt a {text-decoration:none;color:#3366bb}.atnt a:hover {text-decoration:underline}#at15a1{border-bottom:1px solid #eee}#at15a2{border-top:1px solid #eee}#at_msg,#at16p label,#at_share .at_item,#at16p,#at15s,#at16p form input,#at16p form textarea {font-family:arial,helvetica,tahoma,verdana,sans-serif!important;font-size:12px!important}#at15s{background:#fff!important;border:1px solid #ccc!important;color:#666!important;float:none!important;line-height:1em!important;margin:0px!important;overflow:visible!important;padding:1px!important;text-align:left!important;width:230px!important}#at15s_head{position:relative;background:#f2f2f2;padding:4px;cursor:default;   border-bottom:1px solid #e5e5e5}#at15s_head_brand{position:absolute;top:4px;right:4px}#at_hover{padding:4px}#at_hover .at_item, #at_share .at_item{background:#fff!important;float:left!important;color:#4c4c4c !important}#at_hover .at_item{width:102px!important;padding:2px 3px!important;margin:1px}#at_hover .at_item:hover,#at_hover .at_item.athov {    margin:0px!important}#at_hover .at_item:hover,#at_hover .at_item.athov,#at_share .at_item:hover,#at_share .at_item.athov{background:#f2f2f2!important;   border:1px solid #e5e5e5;color:#000!important}#at_email15{padding-top:5px}.at15e_row{height:28px}.at15e_row label,.at15e_row span{padding-left:10px!important;display:block!important;width:60px!important;float:left!important}.at15e_row input,.at15e_row textarea{display:block!important;width:150px!important;float:left!important;background:#fff!important;border:1px solid #ccc!important;color:#333!important;font-size:12px!important;font-weight:normal!important;padding:0pt!important}#at_email{    height:338px!important}.at15t{display:block!important;height:16px!important;line-height:16px!important;padding-left:20px!important;background:url(http://s7.addthis.com/static/r05/widget05.gif) no-repeat left;cursor:pointer}.at15t_more{background-position:0px 100px}.at15t_000{background-position:0px -0px}.at15t_aim{background-position:0px -16px}.at15t_ask{background-position:0px -32px}.at15t_backflip{background-position:0px -48px}.at15t_ballhype{background-position:0px -64px}.at15t_bebo{background-position:0px -80px}.at15t_blinklist{background-position:0px -96px}.at15t_blogmarks{background-position:0px -112px}.at15t_buzz{background-position:0px -128px}.at15t_delicious{background-position:0px -144px}.at15t_digg{background-position:0px -160px}.at15t_diigo{background-position:0px -176px}.at15t_email{background-position:0px -192px}.at15t_facebook{background-position:0px -208px}.at15t_fark{background-position:0px -224px}.at15t_faves{background-position:0px -240px}.at15t_favorites{background-position:0px -256px}.at15t_feedmelinks{background-position:0px -272px}.at15t_friendfeed{background-position:0px -288px}.at15t_furl{background-position:0px -304px}.at15t_google{background-position:0px -320px}.at15t_kaboodle{background-position:0px -336px}.at15t_kirtsy{background-position:0px -352px}.at15t_linkagogo{background-position:0px -368px}.at15t_linkedin{background-position:0px -384px}.at15t_live{background-position:0px -400px}.at15t_misterwong{background-position:0px -416px}.at15t_mixx{background-position:0px -432px}.at15t_multiply{background-position:0px -448px}.at15t_myaol{background-position:0px -464px}.at15t_myspace{background-position:0px -480px}.at15t_netvibes{background-position:0px -496px}.at15t_netvouz{background-position:0px -512px}.at15t_newsvine{background-position:0px -528px}.at15t_pownce{background-position:0px -544px}.at15t_print{background-position:0px -560px}.at15t_propeller{background-position:0px -576px}.at15t_reddit{background-position:0px -592px}.at15t_segnalo{background-position:0px -608px}.at15t_shadows{background-position:0px -624px}.at15t_simpy{background-position:0px -640px}.at15t_slashdot{background-position:0px -672px}.at15t_spurl{background-position:0px -688px}.at15t_stumbleupon{background-position:0px -704px}.at15t_stylehive{background-position:0px -720px}.at15t_tailrank{background-position:0px -736px}.at15t_technorati{background-position:0px -752px}.at15t_thisnext{background-position:0px -768px}.at15t_twitter{background-position:0px -784px}.at15t_yahoobkm{background-position:0px -800px}.at15t_yardbarker{background-position:0px -816px}.at15t_netscape{background-position:0px -576px}#at16clb {    font-size:16pt;   font-family:"verdana bold", verdana, arial, sans-serif}#at_share .at_item {width:105px !important;   padding:4px;   margin-right:4px;   border:1px solid #ffffff}#at16pcc {position:fixed;top:0px;left:0px;width:100%;margin:0 auto;font-size:10px!important;color:#4c4c4c;   padding:0px;z-index:10000001;   overflow:visible}/* hack for ie6 only */* html #at16pcc {    position:absolute}#at16p {    position:absolute;background:url(http://s7.addthis.com/static/t00/atbkg.png);padding:10px;margin-left:-261px;   width:502px;   left:50%}#at_share {    margin:0;   padding:0}#at16pi {background:#fff;width:500px;text-align:left;   border:1px solid #fff;   border-bottom:0}#at16pt {position:relative;background:#f2f2f2;border-bottom:1px solid #e5e5e5;height:16px;padding:8px 14px}#at16pt h4, #at16pt a{font-weight:bold}#at16pt h4 {display:inline;margin:0;padding:0;font-size:1.3em;color:#4c4c4c;cursor:default}#at16pt a {position:absolute;top:8px;right:14px;font-size:1.4em;text-decoration:none;color:#4c4c4c}#at16pc {padding:20px 0 20px 14px}#at16pc .tmsg {    height: 1.2em;   margin-bottom:14px;   padding-left: 90px;   font-weight: normal}#at16pc form{margin:0;width:460px}#at16pc form label {    display: block;   width: 70px;   font-weight: bold;   line-height: 24px;   margin: 0;   text-align: right;   float: left}#at_email form input,#at_email form textarea {    background: #fff;   border: 1px solid #ccc;   width: 268px;   font-size: 12px!important;   font-weight: normal;   padding: 3px;   /*zoom:1!important;   line-height: 20px!important;*/    margin: 0 0 8px 20px !important;   color: #ccc!important}#at16pc form .at_ent {    color:#333!important}#at16pc form textarea {    width: 356px}/* doesn''t work on windows */#at16pc form input:focus,#at16pc form textarea:focus {background:#fffff0;   color: #333}#at16pc .atbtn {    border-top: 1px solid #f5f5f5;   border-left: 1px solid #f5f5f5;   border-right: 1px solid #ccc;   border-bottom: 1px solid #ccc;   background:#c0c0c0;   width: 90px;   margin: 0;   margin-bottom:20px;   padding: 2px 8px;   font-weight: normal;   color: #000;   cursor: pointer}#at16pc .atbtn:hover {    background: #666;   border-color: #444;   color: #fff}#at16pc form .form-text {    padding-left: 90px;   margin-bottom: 10px;   line-height: 1em}#at16pc form .form-button {    padding-left: 90px;   margin: 0 120px 20px 0}#at16pc form .form-char {    width: 120px;   margin-right: 5px;   text-align: right;   color: #ccc;   float: right}/* footer */#at16pf {position:relative;background:#f2f2f2;height:12px;   border-top:1px solid #e5e5e5}#at16pf a#at-gyo {background:url(http://s7.addthis.com/static/t00/gyo.gif) no-repeat;width:105px;left:14px}#at_complete {    font-size:13pt;   color:#47731d;   text-align:center;padding-top:130px;   height:208px!important;   width:472px}#at_s_msg {    margin-bottom:10px} #at16pf a#at-logo {background:url(http://s7.addthis.com/static/t00/logo.gif) no-repeat;width:48px;right:14px}.at_baa {display:block;overflow:hidden;outline:none;text-indent:-9000px}#at16pf a {position:absolute;top:3px;height:7px;line-height:7px;padding:0;margin:0}#at16pc form #at_send {    width:80px !important;   }#at_share.fbtns {padding-left:6px;height:140px}#at_feed {    display:none;   height:160px}#at_feed div {width:102px!important;height:26px!important;line-height:26px!important;float:left!important;   margin-right:78px}#at_feed div.at_litem {    margin-right:0px}#at_feed a {margin:10px 0px;height:17px;line-height:17px}.fbtn{background:url(http://s7.addthis.com/static/r05/feed00.gif) no-repeat;float:left;width:102px;cursor:pointer}.fbtn.bloglines{background-position:0 0;width:94px;height:20px !important;line-height:20px !important;margin-top:8px !important}.fbtn.yahoo{background-position:0 -20px}.fbtn.newsgator{background-position:0 -37px}.fbtn.technorati{background-position:0 -71px}.fbtn.netvibes{background-position:0 -88px}.fbtn.pageflakes{background-position:0 -141px}.fbtn.feedreader{background-position:0 -172px}.fbtn.newsisfree{background-position:0 -207px}.fbtn.google{background-position:0 -54px;width:104px}.fbtn.winlive{background-position:0 -105px;width:100px;height:19px !important;line-height:19px;margin-top:9px !important}.fbtn.mymsn{background-position:0 -158px;width:71px;height:14px !important;line-height:14px !important;margin-top:12px !important}.fbtn.aol {background-position:0 -189px;width:92px;height:18px !important;line-height:18px !important}\r\n', '<!--\r\nfunction MM_preloadImages() { //v3.0\r\n  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();\r\n    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)\r\n    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}\r\n}\r\n\r\nfunction MM_swapImgRestore() { //v3.0\r\n  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;\r\n}\r\n\r\nfunction MM_findObj(n, d) { //v4.0\r\n  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {\r\n    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}\r\n  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];\r\n  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);\r\n  if(!x && document.getElementById) x=document.getElementById(n); return x;\r\n}\r\n\r\nfunction MM_swapImage() { //v3.0\r\n  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)\r\n   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}\r\n}\r\n//-->'),
(6, 'coolblack', '<!-- start header -->\r\n<div id="header">\r\n	<div id="logo">\r\n		<h1><a href="#"><span>Xoriant</span> Solutions</a></h1>\r\n		<p>Designed By Manish Khanchandani</p>\r\n	</div>\r\n</div>\r\n	<div id="menu">\r\n		<ul id="main">\r\n			<li class="current_page_item"><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>">Homepage</a></li>\r\n			<?php if($_SESSION[''user_id'']) { ?>\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=change">Change Password</a></li>\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=logout">Logout</a></li>			\r\n			<?php } else { ?>\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=register">Register</a></li>\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=login">Login</a></li>	\r\n				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=forgot">Forgot Password</a></li>				\r\n			<?php } ?>\r\n		</ul>\r\n	</div>\r\n	\r\n<!-- end header -->\r\n<div id="wrapper">\r\n	<!-- start page -->\r\n	<div id="page">\r\n		<div id="sidebar1" class="sidebar">\r\n			<ul>\r\n				<li>\r\n					<h2>Modules</h2>\r\n					<ul>\r\n						<?php echo $MENU2; ?>\r\n					</ul>\r\n				</li>\r\n			</ul>\r\n		</div>\r\n		<!-- start content -->\r\n		[[BODY]]\r\n		<div style="clear: both;"> </div>\r\n	</div>\r\n	<!-- end page -->\r\n</div>\r\n<div id="footer">\r\n	<p class="copyright">copyright </p>\r\n	<p class="link"><a href="#">Privacy Policy</a> • <a href="#">Terms of Use</a></p>\r\n</div>', '\r\nbody {\r\n	margin: 0px;\r\n	padding: 0;\r\n	background: url(http://localhost/minisite/images/coolblack/img01.jpg) repeat-x left top;\r\n	text-align: justify;\r\n	font-family: Georgia, "Times New Roman", Times, serif;\r\n	font-size: 12px;\r\n	color: #616161;\r\n}\r\n\r\nh1, h2, h3 {\r\n	margin-top: 0;\r\n	color: #A66100;\r\n}\r\n\r\nh1 {\r\n	font-size: 1.6em;\r\n	font-weight: normal;\r\n}\r\n\r\nh2 {\r\n	font-size: 1.6em;\r\n}\r\n\r\nh3 {\r\n	font-size: 1em;\r\n}\r\n\r\nul {\r\n}\r\n\r\na {\r\n	text-decoration: none;\r\n	color: #A66100;\r\n}\r\n\r\na:hover {\r\n	border-bottom: none;\r\n}\r\n\r\na img {\r\n	border: none;\r\n}\r\n\r\nimg.left {\r\n	float: left;\r\n	margin: 0 20px 0 0;\r\n}\r\n\r\nimg.right {\r\n	float: right;\r\n	margin: 0 0 0 20px;\r\n}\r\n\r\n#header {\r\n	width: 960px;\r\n	margin: 0 auto;\r\n	height: 165px;\r\n	background: url(http://localhost/minisite/images/coolblack/img02.jpg) no-repeat left top;\r\n}\r\n\r\n/* Header */\r\n\r\n#logo {\r\n	width: 960px;\r\n	height: 100px;\r\n	margin: 0 auto;\r\n	padding: 60px 10px 0 10px;\r\n}\r\n\r\n#logo h1, #logo p {\r\n	float: left;\r\n	margin: 0;\r\n	color: #00D8D5;\r\n}\r\n\r\n#logo span {\r\n	color: #FFFFFF;\r\n}\r\n\r\n#logo h1 {\r\n	padding: 25px 0 0 0;\r\n	letter-spacing: -1px;\r\n	text-transform: lowercase;\r\n	font-weight: normal;\r\n	font-size: 3em;\r\n}\r\n\r\n#logo p {\r\n	text-transform: uppercase;\r\n	padding: 47px 0 0 3px;\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n}\r\n\r\n#logo a {\r\n	border: none;\r\n	text-decoration: none;\r\n	color: #DC8700;\r\n}\r\n\r\n/* Menu */\r\n\r\n#menu {\r\n	width: 960px;\r\n	margin: 0 auto;\r\n	padding: 0;\r\n	height: 59px;\r\n	background: url(http://localhost/minisite/images/coolblack/img03.jpg) no-repeat left top;\r\n}\r\n\r\n#menu ul {\r\n	margin: 0;\r\n	padding-left: 270px;\r\n	list-style: none;\r\n}\r\n\r\n#menu li {\r\n	display: inline;\r\n}\r\n\r\n#menu a {\r\n	display: block;\r\n	float: left;\r\n	height: 41px;\r\n	margin: 0;\r\n	padding: 18px 40px 0 40px;\r\n	background: url(http://localhost/minisite/images/coolblack/img08.jpg) no-repeat left 30%;\r\n	text-decoration: none;\r\n	text-transform: capitalize;\r\n	font-family: Georgia, "Times New Roman", Times, serif;\r\n	font-size: 12px;\r\n	color: #FFFFFF;\r\n}\r\n\r\n#menu a:hover {\r\n	color: #FFFFFF;\r\n}\r\n\r\n#menu .current_page_item a {\r\n	color: #FFFFFF;\r\n}\r\n\r\n/* Wrapper */\r\n\r\n#wrapper {\r\n}\r\n\r\n/* Page */\r\n\r\n#page {\r\n	width: 960px;\r\n	margin: 0 auto;\r\n	padding: 20px 5px;\r\n	background: #FFFFFF;\r\n}\r\n\r\n#page-bg {\r\n}\r\n\r\n/* Latest Post */\r\n\r\n#latest-post {\r\n	padding: 20px;\r\n	border: 1px solid #E7E7E7;\r\n}\r\n\r\n/* Content */\r\n\r\n#content {\r\n	float: left;\r\n	width: 480px;\r\n}\r\n\r\n.post {\r\n	padding-bottom: 15px;\r\n	line-height: 200%;\r\n}\r\n\r\n.post h1 {\r\n	font-weight: normal;\r\n}\r\n\r\n.title {\r\n	height: 78px;\r\n	margin: 0;\r\n	padding: 15px 0 4px 20px;\r\n	font-weight: normal;\r\n	background: url(http://localhost/minisite/images/coolblack/img07.jpg) no-repeat left top;\r\n}\r\n\r\n.title a {\r\n	border-bottom: none;\r\n	color: #FFFFFF;\r\n}\r\n\r\n.title a:hover {\r\n	border-bottom: 1px dotted #000000;\r\n}\r\n\r\n.byline {\r\n	margin: -60px 20px 20px 20px;\r\n}\r\n\r\n.byline a {\r\n	color: #DC8700;\r\n}\r\n\r\n.tag {\r\n	padding: 0 15px;\r\n}\r\n\r\n.entry {\r\n	padding: 0 20px;\r\n}\r\n\r\n.links {\r\n	padding: 4px 0px;\r\n	text-align: right;\r\n	font-weight: bold;\r\n}\r\n\r\n.links a {\r\n	border: none;\r\n}\r\n\r\n.links a:hover {\r\n}\r\n\r\n/* Sidebars */\r\n\r\n#sidebar1 {\r\n	float: left;\r\n	margin-top: -70px;\r\n}\r\n\r\n#sidebar2 {\r\n	float: right;\r\n}\r\n\r\n.sidebar {\r\n	float: left;\r\n	width: 240px;\r\n	padding: 0;\r\n	font-size: 12px;\r\n}\r\n\r\n.sidebar ul {\r\n	margin: 0;\r\n	padding: 0;\r\n	list-style: none;\r\n}\r\n\r\n.sidebar li {\r\n	padding: 0 0 20px 0;\r\n}\r\n\r\n.sidebar li ul {\r\n}\r\n\r\n.sidebar li li {\r\n	margin: 0 20px 0 15px;\r\n	padding: 8px 0px;\r\n	border-bottom: 1px dashed #C5C4C4;\r\n}\r\n\r\n\r\n.sidebar li h2 {\r\n	height: 40px;\r\n	margin: 0 0 0 0;\r\n	padding: 20px 15px 0px 65px;\r\n	background: url(http://localhost/minisite/images/coolblack/img04.jpg) no-repeat left top;\r\n	letter-spacing: -1px;\r\n	font-size: 16px;\r\n	font-weight: normal;\r\n	color: #FFFFFF;\r\n}\r\n\r\n.sidebar a {\r\n}\r\n\r\n/* Search */\r\n\r\n#searchform {\r\n	margin: 0;\r\n	padding: 0 0 0 0;\r\n}\r\n\r\n#searchform br {\r\n	display: none;\r\n}\r\n\r\n#searchform h2 {\r\n}\r\n\r\n#s {\r\n	margin: 10px 0px 0 15px;\r\n	padding: 2px 2px;\r\n	width: 180px;\r\n	height: 18px;\r\n	border: 1px solid #6F6E6E;\r\n	background: #FFFFFF;\r\n	font-size: 10px;\r\n	color: #000000;\r\n}\r\n\r\n#x {\r\n	margin: 0;\r\n	padding: 2px 5px;\r\n	height: 25px;\r\n	background: #CA8186;\r\n	text-decoration: none;\r\n	text-transform: uppercase;\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	font-size: 10px;\r\n	color: #CCCCCC;\r\n}\r\n/* Calendar */\r\n\r\n#calendar_wrap {\r\n	padding: 0 15px;\r\n	text-align: center;\r\n}\r\n\r\n#calendar_wrap table {\r\n	width: 100%;\r\n}\r\n\r\n#calendar_wrap th {\r\n}\r\n\r\n#calendar_wrap td {\r\n}\r\n\r\n#calendar_wrap tfoot td {\r\n	border: none;\r\n}\r\n\r\n#calendar_wrap tfoot td#prev {\r\n	text-align: left;\r\n	font-weight: bold;\r\n	border: none;\r\n}\r\n\r\n#calendar_wrap tfoot td#prev a {\r\n	border: none;\r\n}\r\n\r\n#calendar_wrap tfoot td#next {\r\n	text-align: right;\r\n	font-weight: bold;\r\n	border: none;\r\n}\r\n\r\n#calendar_wrap tfoot td#next a {\r\n	border: none;\r\n}\r\n\r\n/* Footer */\r\n\r\n#footer {\r\n	width: 960px;\r\n	height: 70px;\r\n	margin: 0 auto;\r\n	padding: 0 20px;\r\n	background: #2E2E2E;\r\n}\r\n\r\n#footer p {\r\n	margin: 0;\r\n	padding: 25px 0 0 0;\r\n	text-align: center;\r\n	font-size: smaller;\r\n}\r\n\r\n#footer a {\r\n}\r\n\r\n#footer .link {\r\n	float: right;\r\n}\r\n\r\n#footer .copyright {\r\n	float: left;\r\n}\r\n\r\n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `product_description` text,
  `product_price` float DEFAULT NULL,
  `product_tax` float DEFAULT NULL,
  `product_tax_type` enum('Percentage','Fixed') DEFAULT NULL,
  `is_taxable` int(1) DEFAULT NULL,
  `product_discount` float DEFAULT NULL,
  `product_discount_type` enum('Percentage','Fixed') DEFAULT NULL,
  `product_final_price` float DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_start_date` date DEFAULT NULL,
  `product_end_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `comments` text,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_cat_rel`
--

CREATE TABLE IF NOT EXISTS `product_cat_rel` (
  `product_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_cat_rel`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE IF NOT EXISTS `product_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `commentor` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `comment_date` datetime DEFAULT NULL,
  `cstatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filerealname` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `fileext` varchar(15) DEFAULT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_images`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_settings`
--

CREATE TABLE IF NOT EXISTS `product_settings` (
  `product_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `image_height` int(11) DEFAULT NULL,
  `image_width` int(11) DEFAULT NULL,
  `thumbnail_height` int(11) DEFAULT NULL,
  `thumbnail_width` int(11) DEFAULT NULL,
  `is_proportionate` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_settings`
--


-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `review_title` varchar(200) DEFAULT NULL,
  `review_comments` text,
  `review_rating` int(4) NOT NULL DEFAULT '5',
  `review_date` datetime DEFAULT NULL,
  `review_confirm` int(1) DEFAULT '1',
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `reviews`
--


-- --------------------------------------------------------

--
-- Table structure for table `review_confirm`
--

CREATE TABLE IF NOT EXISTS `review_confirm` (
  `confirm_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) DEFAULT NULL,
  `cuser_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `agree` int(1) DEFAULT NULL,
  `comments` text,
  `ip` int(11) DEFAULT NULL,
  `agree_date` datetime DEFAULT NULL,
  PRIMARY KEY (`confirm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `review_confirm`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `smsreminders`
--

INSERT INTO `smsreminders` (`rid`, `id`, `user_id`, `title`, `message`, `tophone`, `senddate`, `smstype`, `smsdatetime`, `recurringtype`, `recurringfixedtypedates`, `created`, `modified`, `status`, `lastsenddate`) VALUES
(1, 1, 1, 'dd', 'dd', '919323532886', 1239561000, 'Fixed', '2009-04-13 00:00:00', '', NULL, '2009-04-13 10:10:46', NULL, 1, NULL),
(2, 1, 1, 'd', 'dd', '919323532886', 1239564600, 'Fixed', '2009-04-13 01:00:00', '', NULL, '2009-04-14 10:47:38', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(100) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tags`
--


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
  `rn` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `code`, `status`, `created`, `modified`, `deleted`, `role`, `name`, `squestion`, `sanswer`, `rn`) VALUES
(1, 'naveenkhanchandani@gmail.com', 'password', '5b0fa0e4c041548bb6289e15d865a696', 0, '2009-03-18 03:25:38', NULL, NULL, 'User', 'naveen', 'Name of Your First School', 'new era high school', 0),
(2, 'mkgxy@mkgalaxy.com', 'password', '350db081a661525235354dd3e19b8c05', 0, '2009-03-24 18:18:23', NULL, NULL, 'User', 'Manish Khanchandani', 'Name of Your First School', 'new era high school', 0),
(3, 'naveenkhanchandani1@mkgalaxy.com', 'password', NULL, 1, '2009-04-01 06:10:40', NULL, NULL, 'User', 'Manish Khanchandani', 'Name of Your First School', 'ddddd', 0),
(4, 'naveen@mkgalaxy.com', 'pp', NULL, 1, '2009-04-01 06:13:06', NULL, NULL, 'User', 'mm', 'Name of Your First School', 'mm', 0),
(5, 'mk@mk.com', 'password', 'bc6fe82635b1429d3e886eec0fc34f49', 1, '2009-04-02 07:26:33', NULL, NULL, 'User', 'manish', 'Name of Your First School', 'manish', 0),
(6, 'mk1@mkgalaxy.com', 'password', '55a0ce8200cf39c3028ebc66f356bf7e', 1, '2009-04-12 14:33:12', NULL, NULL, 'User', 'Manish Khanchandani', 'Name of Your First School', 'new era high school', 2);
