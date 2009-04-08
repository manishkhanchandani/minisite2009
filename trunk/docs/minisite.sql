-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2009 at 04:39 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `id`, `user_id`, `title`, `description`, `created`, `status`) VALUES
(1, 1, 1, 'ddd', 'ddddd ddddddddd ddddddddddd dddddddddddddddd dddddddddddd ddddddddddddd d ddddddddddd', '2009-04-05 14:30:24', 1),
(2, 1, 1, 'ddd', 'ddddd ddddddddd ddddddddddd dddddddddddddddd dddddddddddd ddddddddddddd d ddddddddddd', '2009-04-05 14:30:24', 1),
(3, 1, 1, 'ddd', 'ddddd ddddddddd ddddddddddd dddddddddddddddd dddddddddddd ddddddddddddd d ddddddddddd', '2009-04-05 14:30:24', 1),
(4, 1, 1, 'ddd', 'ddddd ddddddddd ddddddddddd dddddddddddddddd dddddddddddd ddddddddddddd d ddddddddddd', '2009-04-05 14:30:24', 1),
(5, 1, 1, 'ddd', 'ddddd ddddddddd ddddddddddd dddddddddddddddd dddddddddddd ddddddddddddd d ddddddddddd', '2009-04-05 14:30:24', 1),
(6, 1, 1, 'test', 'est dd ddd\r\nd\r\nd\r\nd\r\n\r\nd\r\nd\r\nd\r\nd\r\n\r\nd\r\ndgddff fdddddddddddd', '2009-04-05 15:32:30', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`category_id`, `id`, `category`, `parent_id`) VALUES
(1, 1, 'test', 0);

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
(6, 1, 1);

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

INSERT INTO `blog_tags` (`blog_id`, `id`, `tag_id`) VALUES
(4, 1, 1),
(5, 1, 1),
(6, 1, 2);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `downtime`
--


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `downtime_results`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=11 ;

--
-- Dumping data for table `emailreminders`
--

INSERT INTO `emailreminders` (`rid`, `id`, `user_id`, `title`, `message`, `toemail`, `senddate`, `emailtype`, `emaildatetime`, `recurringtype`, `recurringfixedtypedates`, `created`, `modified`, `status`, `lastsenddate`) VALUES
(6, 1, 1, 'a', 'aa', 'aaa', NULL, 'Recurring', '2009-04-14 02:00:00', 'Every Half Hourly', NULL, '2009-04-05 08:19:46', '2009-04-05 16:09:03', 1, '2009-04-05 16:09:03'),
(5, 1, 1, 'a', 'aa', 'aaa', NULL, 'Recurring', '2009-04-14 02:00:00', 'Every Half Hourly', NULL, '2009-04-05 08:19:46', '2009-04-05 16:09:03', 1, '2009-04-05 16:09:03'),
(7, 1, 1, 'dd', 'ddd', 'na', NULL, 'Fixed', '2009-04-04 00:30:00', '', NULL, '2009-04-05 15:32:57', '2009-04-05 16:09:03', 1, '2009-04-05 16:09:03'),
(8, 1, 1, 'dd', 'ddd', 'na', 1238805000, 'Fixed', '2009-04-04 00:30:00', '', NULL, '2009-04-05 15:32:57', '2009-04-05 16:09:03', 1, '2009-04-05 16:09:03'),
(9, 1, 1, 'dd', 'ddd', 'na', 1238805000, 'Fixed', '2009-04-04 00:30:00', '', NULL, '2009-04-05 15:32:57', '2009-04-05 16:09:03', 1, '2009-04-05 16:09:03');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `id`, `group_id`, `user_id`, `ref`, `filename`, `filerealname`, `filepath`, `filesize`, `fileext`, `filetype`, `created`, `album_id`, `hosttype`) VALUES
(1, 1, NULL, 1, '9b32fb4b2fe3e33ba4ecb256ab3e4958', '2748149d97a29b33af.jpg', 'i73gn5.jpg', 'i7/user_1', 55257, 'jpg', 'image/jpeg', '2009-04-06 03:42:33', 0, 'File'),
(2, 1, NULL, 1, '9b32fb4b2fe3e33ba4ecb256ab3e4958', '43949d97a29b50ce.doc', 'Project.doc', 'Pr/user_1', 29696, 'doc', 'application/msword', '2009-04-06 03:42:33', 0, 'File'),
(3, 1, NULL, 1, '9b32fb4b2fe3e33ba4ecb256ab3e4958', '1783849d97a29b5e3e.jpg', 'r8tf0i.jpg', 'r8/user_1', 57559, 'jpg', 'image/jpeg', '2009-04-06 03:42:33', 0, 'File'),
(4, 1, NULL, 1, '9b32fb4b2fe3e33ba4ecb256ab3e4958', '3148549d97a29b6b69.txt', 'readme.txt', 're/user_1', 1737, 'txt', 'text/plain', '2009-04-06 03:42:33', 0, 'File'),
(5, 1, NULL, 1, '9b32fb4b2fe3e33ba4ecb256ab3e4958', '79049d97a29d903f.jpg', '28nng0.jpg', '28/user_1', 79754, 'jpg', 'image/jpeg', '2009-04-06 03:42:33', 0, 'File'),
(6, 1, NULL, 1, '9b32fb4b2fe3e33ba4ecb256ab3e4958', '1923849d97a29dae99.jpg', '3020yua.jpg', '30/user_1', 63455, 'jpg', 'image/jpeg', '2009-04-06 03:42:33', 0, 'File'),
(7, 1, NULL, 1, '9b32fb4b2fe3e33ba4ecb256ab3e4958', '1764749d97a29dbde7.doc', '1237353762_Project.doc', '12/user_1', 29696, 'doc', 'application/msword', '2009-04-06 03:42:33', 0, 'File'),
(8, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '2859349d97bb40b267.jpg', 'r8tf0i.jpg', 'r8/user_1', 57559, 'jpg', 'image/jpeg', '2009-04-06 03:49:08', 0, 'File'),
(9, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '2730649d97bb40c9bc.txt', 'readme.txt', 're/user_1', 1737, 'txt', 'text/plain', '2009-04-06 03:49:08', 0, 'File'),
(10, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '311049d97bb40d394.jpg', '28nng0.jpg', '28/user_1', 79754, 'jpg', 'image/jpeg', '2009-04-06 03:49:08', 0, 'File'),
(11, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '1197449d97bb40dcc9.jpg', '3020yua.jpg', '30/user_1', 63455, 'jpg', 'image/jpeg', '2009-04-06 03:49:08', 0, 'File'),
(12, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '3144249d97bb41e16c.doc', '1237353762_Project.doc', '12/user_1', 29696, 'doc', 'application/msword', '2009-04-06 03:49:08', 0, 'File'),
(13, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '1391749d97bb41f849.jpg', 'i73gn5.jpg', 'i7/user_1', 55257, 'jpg', 'image/jpeg', '2009-04-06 03:49:08', 0, 'File'),
(14, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '2298649d97bb420146.doc', 'Project.doc', 'Pr/user_1', 29696, 'doc', 'application/msword', '2009-04-06 03:49:08', 0, 'File'),
(15, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '3262649d97c1ed948c.jpg', 'Death.jpg', 'De/user_1', 554242, 'jpg', 'image/jpeg', '2009-04-06 03:50:54', 0, 'File'),
(16, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '880349d97c39318a1.jpg', 'img03.jpg', 'im/user_1', 3063, 'jpg', 'image/jpeg', '2009-04-06 03:51:21', 0, 'File'),
(17, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '664649d97c39336a8.png', 'mumbaionline.png', 'mu/user_1', 43096, 'png', 'image/png', '2009-04-06 03:51:21', 0, 'File'),
(18, 1, NULL, 0, 'cd6c0cfabedfc9d5a0759bfbc23ddb46', '2299849d9800c40a00.png', 'mumbaionline.png', 'mu/user_0', 43096, 'png', 'image/png', '2009-04-06 04:07:40', 0, 'File');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Dumping data for table `prebuilt_1`
--

INSERT INTO `prebuilt_1` (`id`, `keyword`, `default_id`, `home_text`, `template`, `css`, `js`, `siteurl`, `sitename`, `siteemail`, `ftphost`, `ftpuser`, `ftppassword`, `ftpdir`, `dbhost`, `db`, `dbuser`, `dbpassword`, `login_site`) VALUES
(1, 'Mumbai', 1, NULL, '<div id="mainBody">\r\n	<div id="mainHeader">\r\n		<h1><?php echo ucwords($SITE[0][''sitename'']); ?></h1>\r\n		<p><?php echo $SITE[0][''home_text'']; ?></p>\r\n	</div>\r\n	<div id="mainLower">\r\n		<div id="mainNavigation">\r\n			<?php echo $MENU; ?>		\r\n		</div>\r\n		<div id="mainContent">\r\n			[[BODY]]\r\n		</div>\r\n		<div id="mainFooter">\r\n			<p>Copyright 2009</p>\r\n		</div>\r\n	</div>\r\n</div>', '<!--\r\nbody {\r\n	background-color: #990099;\r\n	margin: 0px;\r\n	padding: 0px;\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\ntd, th, table, p, select, input, textarea {\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\na {\r\n	text-decoration: none;\r\n}\r\n#mainBody {\r\n	width: 800px;\r\n	border: 1px solid #000000;\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	margin-top:-25px;\r\n}\r\n#mainBody #mainHeader {\r\n	background-color: #000000;\r\n	text-align:center;\r\n	padding-top:25px;\r\n}\r\n#mainBody #mainHeader h1 {\r\n	font-size: 36px;\r\n	font-weight: bold;\r\n	color: #FFFFFF;\r\n}\r\n#mainBody #mainHeader p {\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n	text-align:center;\r\n	margin-top: -20px;\r\n	padding-bottom: 25px;\r\n}\r\n#mainBody #mainLower {\r\n	background-color: #FFFFFF;\r\n	margin-top: -20px;\r\n	padding-bottom: 15px;\r\n}\r\n#mainBody #mainLower #mainNavigation {\r\n	padding: 5px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990099;\r\n}\r\n#mainBody #mainLower #mainContent {\r\n	padding: 10px;\r\n	min-height: 300px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990099;\r\n}\r\n-->', NULL, 'http://10000projects.info/minisite/project2', 'Mumbai', 'admin@mumbaionline.org.in', 'ftp.servage.net', 'manishkk', 'mAnIsH74', '/www/minisite/project2', 'mysql1076.servage.net', 'minisite09', 'minisite09', 'password123', 1);

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
  `priority` int(11) NOT NULL DEFAULT '0',
  `concept_value` text,
  PRIMARY KEY (`id`,`concept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prebuilt_2_concepts`
--

INSERT INTO `prebuilt_2_concepts` (`id`, `concept_id`, `homepage`, `displayname`, `home_text`, `priority`, `concept_value`) VALUES
(1, 1, 0, 'Mumbai Blogs', 'Join us to some exciting blog site.', 0, ''),
(1, 5, 1, 'News', 'Watch news live', 0, 'pune, hyderabad'),
(1, 7, 0, 'SMS Reminder', 'Remind your important jobs using our sms service', 0, ''),
(1, 8, 0, 'Email Reminder', 'Remind your important jobs using our email service', 0, ''),
(1, 9, 0, '', 'File Hosted here.', 0, ''),
(1, 10, 0, 'Videos', 'You tube', 0, ''),
(1, 11, 0, '', '', 0, ''),
(1, 13, 0, '', '', 0, ''),
(1, 14, 0, 'Cricket Scores', 'ckt', 0, ''),
(1, 15, 0, 'Send SMS', '', 0, '');

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
(1, 4, NULL),
(1, 11, NULL),
(1, 9, NULL),
(1, 2, NULL),
(1, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prebuilt_concepts`
--

CREATE TABLE IF NOT EXISTS `prebuilt_concepts` (
  `concept_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`concept_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `prebuilt_concepts`
--

INSERT INTO `prebuilt_concepts` (`concept_id`, `concept`) VALUES
(1, 'blog'),
(5, 'news'),
(7, 'smsreminder'),
(8, 'emailreminder'),
(9, 'filehost'),
(10, 'youtube'),
(11, 'gtalk'),
(13, 'allchat'),
(14, 'cricketscore'),
(15, 'sendsms');

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
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `prebuilt_concepts_settings`
--

INSERT INTO `prebuilt_concepts_settings` (`setting_id`, `concept_id`, `setting_label`, `comments`, `inputtype`, `reference`) VALUES
(1, 5, 'Yahoo News', 'http://news.search.yahoo.com/news/rss?p=[[KEYWORD]]&ei=UTF-8&fl=0&x=wrt\r\n', 'checkbox', 'yahoonews'),
(2, 5, 'Google News', 'http://news.google.com/news?pz=1&ned=us&hl=en&q=[[KEYWORD]]&output=rss', 'checkbox', 'googlenews'),
(3, 1, 'No Category', NULL, 'radio', 'nocat'),
(4, 1, 'Single Level Category', NULL, 'radio', 'single'),
(5, 1, 'Multilevel Category', NULL, 'radio', 'multi'),
(10, 10, 'Top Rated Videos', NULL, 'checkbox', 'toprated'),
(9, 10, 'Most Viewed Videos', NULL, 'checkbox', 'mostviewed'),
(11, 10, 'Recently Featured Videos', NULL, 'checkbox', 'featured'),
(12, 10, 'Large Result Set', NULL, 'checkbox', 'largeresultset');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=5 ;

--
-- Dumping data for table `prebuilt_templates`
--

INSERT INTO `prebuilt_templates` (`tid`, `name`, `template`, `css`, `js`) VALUES
(1, 'Blog Template', '<div id="mainBody">\r\n	<div id="mainHeader">\r\n		<h1>Blog Site</h1>\r\n		<p>New blog site is back</p>\r\n	</div>\r\n	<div id="mainLower">\r\n		<div id="mainNavigation">\r\n			<a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>">Home</a> | <a href="<?php echo HTTPPATH; ?>/index.php?p=blog&ID=<?php echo $ID; ?>">Blog</a>		\r\n		</div>\r\n		<div id="mainContent">\r\n			[[BODY]]\r\n		</div>\r\n		<div id="mainFooter">\r\n			<p>Copyright 2009</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n', '<!--\r\nbody {\r\n	background-color: #990000;\r\n	margin: 0px;\r\n	padding: 0px;\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\ntd, th, table, p, select, input, textarea {\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\na {\r\n	text-decoration: none;\r\n}\r\n#mainBody {\r\n	width: 800px;\r\n	border: 1px solid #000000;\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	margin-top:-25px;\r\n}\r\n#mainBody #mainHeader {\r\n	background-color: #000000;\r\n	text-align:center;\r\n	padding-top:25px;\r\n}\r\n#mainBody #mainHeader h1 {\r\n	font-size: 36px;\r\n	font-weight: bold;\r\n	color: #FFFFFF;\r\n}\r\n#mainBody #mainHeader p {\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n	text-align:center;\r\n	margin-top: -20px;\r\n	padding-bottom: 25px;\r\n}\r\n#mainBody #mainLower {\r\n	background-color: #FFFFFF;\r\n	margin-top: -20px;\r\n	padding-bottom: 15px;\r\n}\r\n#mainBody #mainLower #mainNavigation {\r\n	padding: 5px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990000;\r\n}\r\n#mainBody #mainLower #mainContent {\r\n	padding: 10px;\r\n	min-height: 300px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990000;\r\n}\r\n-->', NULL),
(3, 'News Template', '<div id="mainBody">\r\n	<div id="mainHeader">\r\n		<h1>News Site</h1>\r\n		<p>News site is back</p>\r\n	</div>\r\n	<div id="mainLower">\r\n		<div id="mainNavigation">\r\n			<a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>">Home</a> | <a href="<?php echo HTTPPATH; ?>/index.php?p=news&ID=<?php echo $ID; ?>">News</a>		\r\n		</div>\r\n		<div id="mainContent">\r\n			[[BODY]]\r\n		</div>\r\n		<div id="mainFooter">\r\n			<p>Copyright 2009</p>\r\n		</div>\r\n	</div>\r\n</div>', '<!--\r\nbody {\r\n	background-color: #0000FF;\r\n	margin: 0px;\r\n	padding: 0px;\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\ntd, th, table, p, select, input, textarea {\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\na {\r\n	text-decoration: none;\r\n}\r\n#mainBody {\r\n	width: 800px;\r\n	border: 1px solid #000000;\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	margin-top:-25px;\r\n}\r\n#mainBody #mainHeader {\r\n	background-color: #000000;\r\n	text-align:center;\r\n	padding-top:25px;\r\n}\r\n#mainBody #mainHeader h1 {\r\n	font-size: 36px;\r\n	font-weight: bold;\r\n	color: #FFFFFF;\r\n}\r\n#mainBody #mainHeader p {\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n	text-align:center;\r\n	margin-top: -20px;\r\n	padding-bottom: 25px;\r\n}\r\n#mainBody #mainLower {\r\n	background-color: #FFFFFF;\r\n	margin-top: -20px;\r\n	padding-bottom: 15px;\r\n}\r\n#mainBody #mainLower #mainNavigation {\r\n	padding: 5px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #0000FF;\r\n}\r\n#mainBody #mainLower #mainContent {\r\n	padding: 10px;\r\n	min-height: 300px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #0000FF;\r\n}\r\n-->', NULL),
(4, 'Master Template', '<div id="mainBody">\r\n	<div id="mainHeader">\r\n		<h1><?php echo ucwords($SITE[0][''sitename'']); ?></h1>\r\n		<p><?php echo $SITE[0][''home_text'']; ?></p>\r\n	</div>\r\n	<div id="mainLower">\r\n		<div id="mainNavigation">\r\n			<?php echo $MENU; ?>		\r\n		</div>\r\n		<div id="mainContent">\r\n			[[BODY]]\r\n		</div>\r\n		<div id="mainFooter">\r\n			<p>Copyright 2009</p>\r\n		</div>\r\n	</div>\r\n</div>', '<!--\r\nbody {\r\n	background-color: #990099;\r\n	margin: 0px;\r\n	padding: 0px;\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\ntd, th, table, p, select, input, textarea {\r\n	font-family: Verdana;\r\n	font-size: 11px;\r\n}\r\na {\r\n	text-decoration: none;\r\n}\r\n#mainBody {\r\n	width: 800px;\r\n	border: 1px solid #000000;\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	margin-top:-25px;\r\n}\r\n#mainBody #mainHeader {\r\n	background-color: #000000;\r\n	text-align:center;\r\n	padding-top:25px;\r\n}\r\n#mainBody #mainHeader h1 {\r\n	font-size: 36px;\r\n	font-weight: bold;\r\n	color: #FFFFFF;\r\n}\r\n#mainBody #mainHeader p {\r\n	font-size: 10px;\r\n	color: #FFFFFF;\r\n	text-align:center;\r\n	margin-top: -20px;\r\n	padding-bottom: 25px;\r\n}\r\n#mainBody #mainLower {\r\n	background-color: #FFFFFF;\r\n	margin-top: -20px;\r\n	padding-bottom: 15px;\r\n}\r\n#mainBody #mainLower #mainNavigation {\r\n	padding: 5px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990099;\r\n}\r\n#mainBody #mainLower #mainContent {\r\n	padding: 10px;\r\n	min-height: 300px;\r\n	border-bottom-width: thin;\r\n	border-bottom-style: dotted;\r\n	border-bottom-color: #990099;\r\n}\r\n-->', NULL);

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
  `product_start_date` datetime DEFAULT NULL,
  `product_end_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
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
  `filename` varchar(255) DEFAULT NULL,
  `filerealname` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `fileext` varchar(15) DEFAULT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tagname`) VALUES
(1, 'dd'),
(2, 'test');

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
