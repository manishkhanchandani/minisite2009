-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 06, 2009 at 05:09 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `minisite`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `albums`
-- 

CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `album` varchar(200) default NULL,
  `album_created` datetime default NULL,
  `file_type` enum('Image','File','Music','Video') default NULL,
  PRIMARY KEY  (`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `albums`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ask_expert`
-- 

CREATE TABLE `ask_expert` (
  `ask_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `title` varchar(200) default NULL,
  `message` text,
  `pid` int(11) default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`ask_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `ask_expert`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `blog`
-- 

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `title` varchar(255) default NULL,
  `description` text,
  `created` datetime default NULL,
  `status` int(1) NOT NULL default '1',
  PRIMARY KEY  (`blog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `blog`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `blog_categories`
-- 

CREATE TABLE `blog_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `category` varchar(200) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `blog_categories`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `blog_cat_rel`
-- 

CREATE TABLE `blog_cat_rel` (
  `blog_id` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL default '0',
  `category_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`blog_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `blog_cat_rel`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `blog_comments`
-- 

CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `blog_id` int(11) NOT NULL default '0',
  `commentor` int(11) NOT NULL default '0',
  `comments` text,
  `comment_date` datetime default NULL,
  `cstatus` int(1) NOT NULL default '1',
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `blog_comments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `blog_tags`
-- 

CREATE TABLE `blog_tags` (
  `blog_id` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL default '0',
  `tag_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`blog_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `blog_tags`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `categories`
-- 

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `category` varchar(200) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  `form_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `categories`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `datas`
-- 

CREATE TABLE `datas` (
  `data_id` int(11) NOT NULL,
  `data_key` varchar(200) default NULL,
  `data_value` text,
  `reference` varchar(200) default NULL,
  PRIMARY KEY  (`data_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `datas`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `deathreminder`
-- 

CREATE TABLE `deathreminder` (
  `reminder_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `message` int(11) default NULL,
  `sms` int(1) default NULL,
  `smsmessage` varchar(160) default NULL,
  `smsphone` text,
  `emails` text,
  `login_freq` varchar(200) default NULL,
  `created` datetime default NULL,
  `lastreminderdate` datetime default NULL,
  `loginfailedattempt` int(4) default NULL,
  `loginattemptrequired` int(4) default NULL,
  `is_dead` int(1) NOT NULL default '0',
  PRIMARY KEY  (`reminder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `deathreminder`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `downtime`
-- 

CREATE TABLE `downtime` (
  `downtime_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `url` text,
  `usphone` varchar(50) default NULL,
  `email` text,
  `smsphone` varchar(255) default NULL,
  `checkfrequency` varchar(200) default NULL,
  `datetocheck` int(11) default NULL,
  `lastcheckdate` int(11) default NULL,
  `status` int(1) NOT NULL default '1',
  `texttocheck` varchar(50) default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`downtime_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `downtime`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `downtime_results`
-- 

CREATE TABLE `downtime_results` (
  `result_id` int(11) NOT NULL auto_increment,
  `downtime_id` int(11) default NULL,
  `id` int(11) default NULL,
  `check_date` datetime default NULL,
  `pingstatus` int(1) NOT NULL default '1',
  `textcheckstatus` int(1) NOT NULL default '1',
  `finalstatus` int(1) NOT NULL,
  PRIMARY KEY  (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `downtime_results`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `emailreminders`
-- 

CREATE TABLE `emailreminders` (
  `rid` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `title` varchar(50) default NULL,
  `message` text,
  `toemail` varchar(150) default NULL,
  `senddate` int(11) default NULL,
  `emailtype` enum('Fixed','Recurring') default NULL,
  `emaildatetime` datetime default NULL,
  `recurringtype` enum('Every 10 Minutes','Every Half Hourly','Hourly','Every 2 Hour','Every 3 Hours','Every 6 Hours','Daily','WeekDays','Sunday','SatSun','Fortnight','Monthly','Quarterly','SixMonthly','Yearly','Fixed') default NULL,
  `recurringfixedtypedates` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `status` int(2) default NULL,
  `lastsenddate` datetime default NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `emailreminders`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `events`
-- 

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `event_title` varchar(200) default NULL,
  `event_desc` text,
  `event_phone` varchar(50) default NULL,
  `event_email` varchar(150) default NULL,
  `event_url` varchar(255) default NULL,
  `event_contact_person` varchar(200) default NULL,
  `event_start_date` datetime default NULL,
  `event_end_date` datetime default NULL,
  `event_created` datetime default NULL,
  `ip` varchar(20) default NULL,
  PRIMARY KEY  (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `events`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `events_rsvp`
-- 

CREATE TABLE `events_rsvp` (
  `rsvp_id` int(11) NOT NULL auto_increment,
  `event_id` int(11) default NULL,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `cuser_id` int(11) default NULL,
  `status` int(1) default NULL,
  `status_date` datetime default NULL,
  PRIMARY KEY  (`rsvp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `events_rsvp`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `fields`
-- 

CREATE TABLE `fields` (
  `field_id` int(11) NOT NULL auto_increment,
  `form_id` int(11) NOT NULL default '0',
  `field_name` varchar(200) default NULL,
  `field_label` varchar(200) default NULL,
  `field_type` enum('text','password','textarea','list','listmultiple','checkbox','checkboxmultiple','radio','file','image','hidden') default NULL,
  `field_input` enum('fint','ftext','fvc','ffloat','fdate','fdatetime') default NULL,
  `field_default` text,
  `field_default_selected` text,
  `field_validate` int(1) NOT NULL default '0',
  `field_validate_required` int(1) NOT NULL default '0',
  `field_validate_rule` enum('number','email','sametext','regexp') default NULL,
  `field_validate_value` text,
  `field_validate_error` text,
  `field_search` int(1) NOT NULL default '0',
  `field_search_label` varchar(200) default NULL,
  `field_search_type` enum('text','list','listmultiple','checkbox','checkboxmultiple','radio') default NULL,
  `field_search_default` text,
  `field_search_default_selected` text,
  `field_view_show` int(1) NOT NULL default '1',
  `field_detail_show` int(1) NOT NULL default '1',
  PRIMARY KEY  (`field_id`)
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

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `ref` varchar(255) NOT NULL,
  `filename` varchar(255) default NULL,
  `filerealname` varchar(255) default NULL,
  `filepath` varchar(255) default NULL,
  `filesize` int(11) default NULL,
  `fileext` varchar(15) default NULL,
  `filetype` varchar(200) default NULL,
  `created` datetime default NULL,
  `album_id` int(11) NOT NULL,
  `hosttype` enum('Image','File','Music','Video') NOT NULL,
  PRIMARY KEY  (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
(17, 1, NULL, 1, 'f8270315053a9e2c2d492150b2aef7e3', '664649d97c39336a8.png', 'mumbaionline.png', 'mu/user_1', 43096, 'png', 'image/png', '2009-04-06 03:51:21', 0, 'File');

-- --------------------------------------------------------

-- 
-- Table structure for table `forms`
-- 

CREATE TABLE `forms` (
  `form_id` int(11) NOT NULL auto_increment,
  `form_name` varchar(100) default NULL,
  `category` enum('None','Single','Multiple') NOT NULL default 'None',
  PRIMARY KEY  (`form_id`)
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

CREATE TABLE `forums` (
  `forum_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `subject` varchar(200) default NULL,
  `message` text,
  `forum_created_date` datetime default NULL,
  `pid` int(11) default NULL,
  `ip` varchar(20) default NULL,
  PRIMARY KEY  (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `forums`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `messages`
-- 

CREATE TABLE `messages` (
  `mes_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `from_user_id` int(11) default NULL,
  `to_user_id` int(11) default NULL,
  `from_delete` int(1) NOT NULL default '0',
  `to_delete` int(1) NOT NULL default '0',
  `read` int(1) NOT NULL default '0',
  `subject` varchar(200) default NULL,
  `message` text,
  `mes_created` datetime default NULL,
  `ip` varchar(20) default NULL,
  PRIMARY KEY  (`mes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `messages`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `poll`
-- 

CREATE TABLE `poll` (
  `poll_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `poll_question` text,
  `poll_options` text,
  `created` datetime default NULL,
  `ip` varchar(20) default NULL,
  PRIMARY KEY  (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `poll`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `poll_results`
-- 

CREATE TABLE `poll_results` (
  `result_id` int(11) NOT NULL auto_increment,
  `poll_id` int(11) default NULL,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `puser_id` int(11) default NULL,
  `option_id` int(4) default NULL,
  `pdate` datetime default NULL,
  PRIMARY KEY  (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `poll_results`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prebuilt_1`
-- 

CREATE TABLE `prebuilt_1` (
  `id` int(11) NOT NULL auto_increment,
  `keyword` varchar(200) default NULL,
  `default_id` int(1) NOT NULL,
  `home_text` text,
  `template` text,
  `css` text,
  `js` text,
  `siteurl` varchar(255) default NULL,
  `sitename` varchar(200) default NULL,
  `siteemail` varchar(150) default NULL,
  `ftphost` varchar(255) default NULL,
  `ftpuser` varchar(255) default NULL,
  `ftppassword` varchar(255) default NULL,
  `ftpdir` varchar(255) default NULL,
  `dbhost` varchar(255) default NULL,
  `db` varchar(255) default NULL,
  `dbuser` varchar(255) default NULL,
  `dbpassword` varchar(255) default NULL,
  `login_site` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `prebuilt_1`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prebuilt_2_concepts`
-- 

CREATE TABLE `prebuilt_2_concepts` (
  `id` int(11) NOT NULL default '0',
  `concept_id` int(11) NOT NULL default '0',
  `homepage` int(1) NOT NULL default '1',
  `displayname` varchar(200) NOT NULL,
  `home_text` text,
  `priority` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`,`concept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prebuilt_2_concepts`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prebuilt_3_settings`
-- 

CREATE TABLE `prebuilt_3_settings` (
  `id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`,`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prebuilt_3_settings`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prebuilt_concepts`
-- 

CREATE TABLE `prebuilt_concepts` (
  `concept_id` int(11) NOT NULL auto_increment,
  `concept` varchar(200) default NULL,
  PRIMARY KEY  (`concept_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `prebuilt_concepts`
-- 

INSERT INTO `prebuilt_concepts` (`concept_id`, `concept`) VALUES 
(1, 'blog'),
(5, 'news'),
(7, 'smsreminder'),
(8, 'emailreminder'),
(9, 'filehost');

-- --------------------------------------------------------

-- 
-- Table structure for table `prebuilt_concepts_settings`
-- 

CREATE TABLE `prebuilt_concepts_settings` (
  `setting_id` int(11) NOT NULL auto_increment,
  `concept_id` int(11) NOT NULL default '0',
  `setting_label` varchar(200) default NULL,
  `comments` text,
  `inputtype` enum('radio','checkbox') default NULL,
  `reference` varchar(50) default NULL,
  PRIMARY KEY  (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `prebuilt_concepts_settings`
-- 

INSERT INTO `prebuilt_concepts_settings` (`setting_id`, `concept_id`, `setting_label`, `comments`, `inputtype`, `reference`) VALUES 
(1, 5, 'Yahoo News', 'http://news.search.yahoo.com/news/rss?p=[[KEYWORD]]&ei=UTF-8&fl=0&x=wrt\r\n', 'checkbox', 'yahoonews'),
(2, 5, 'Google News', 'http://news.google.com/news?pz=1&ned=us&hl=en&q=[[KEYWORD]]&output=rss', 'checkbox', 'googlenews'),
(3, 1, 'No Category', NULL, 'radio', 'nocat'),
(4, 1, 'Single Level Category', NULL, 'radio', 'single'),
(5, 1, 'Multilevel Category', NULL, 'radio', 'multi');

-- --------------------------------------------------------

-- 
-- Table structure for table `prebuilt_templates`
-- 

CREATE TABLE `prebuilt_templates` (
  `tid` int(11) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `template` text,
  `css` text,
  `js` text,
  PRIMARY KEY  (`tid`)
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

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `concept_id` int(11) default NULL,
  `product_name` varchar(200) default NULL,
  `product_description` text,
  `product_price` float default NULL,
  `product_tax` float default NULL,
  `product_tax_type` enum('Percentage','Fixed') default NULL,
  `is_taxable` int(1) default NULL,
  `product_discount` float default NULL,
  `product_discount_type` enum('Percentage','Fixed') default NULL,
  `product_final_price` float default NULL,
  `product_quantity` int(11) default NULL,
  `product_start_date` datetime default NULL,
  `product_end_date` datetime default NULL,
  `created` datetime default NULL,
  `status` int(1) NOT NULL default '1',
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `product`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `product_categories`
-- 

CREATE TABLE `product_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `concept_id` int(11) default NULL,
  `category` varchar(200) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `product_categories`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `product_cat_rel`
-- 

CREATE TABLE `product_cat_rel` (
  `product_id` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL default '0',
  `concept_id` int(11) default NULL,
  `category_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`product_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `product_cat_rel`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `product_comments`
-- 

CREATE TABLE `product_comments` (
  `comment_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `concept_id` int(11) default NULL,
  `product_id` int(11) NOT NULL default '0',
  `commentor` int(11) NOT NULL default '0',
  `comments` text,
  `comment_date` datetime default NULL,
  `cstatus` int(1) NOT NULL default '1',
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `product_comments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `product_images`
-- 

CREATE TABLE `product_images` (
  `file_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `concept_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `filename` varchar(255) default NULL,
  `filerealname` varchar(255) default NULL,
  `filepath` varchar(255) default NULL,
  `filesize` int(11) default NULL,
  `fileext` varchar(15) default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `product_images`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `product_settings`
-- 

CREATE TABLE `product_settings` (
  `product_setting_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `concept_id` int(11) default NULL,
  `image_height` int(11) default NULL,
  `image_width` int(11) default NULL,
  `thumbnail_height` int(11) default NULL,
  `thumbnail_width` int(11) default NULL,
  `is_proportionate` int(1) NOT NULL default '1',
  PRIMARY KEY  (`product_setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `product_settings`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `reviews`
-- 

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `ref_id` int(11) default NULL,
  `concept_id` int(11) default NULL,
  `review_title` varchar(200) default NULL,
  `review_comments` text,
  `review_rating` int(4) NOT NULL default '5',
  `review_date` datetime default NULL,
  `review_confirm` int(1) default '1',
  `ip` varchar(20) default NULL,
  PRIMARY KEY  (`review_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `reviews`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `review_confirm`
-- 

CREATE TABLE `review_confirm` (
  `confirm_id` int(11) NOT NULL auto_increment,
  `review_id` int(11) default NULL,
  `cuser_id` int(11) default NULL,
  `id` int(11) default NULL,
  `ref_id` int(11) default NULL,
  `concept_id` int(11) default NULL,
  `agree` int(1) default NULL,
  `comments` text,
  `ip` int(11) default NULL,
  `agree_date` datetime default NULL,
  PRIMARY KEY  (`confirm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `review_confirm`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `smsreminders`
-- 

CREATE TABLE `smsreminders` (
  `rid` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `title` varchar(50) default NULL,
  `message` varchar(160) default NULL,
  `tophone` text,
  `senddate` int(11) default NULL,
  `smstype` enum('Fixed','Recurring') default NULL,
  `smsdatetime` datetime default NULL,
  `recurringtype` enum('Every 10 Minutes','Every Half Hourly','Hourly','Every 2 Hour','Every 3 Hours','Every 6 Hours','Daily','WeekDays','Sunday','SatSun','Fortnight','Monthly','Quarterly','SixMonthly','Yearly','Fixed') default NULL,
  `recurringfixedtypedates` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `status` int(2) default NULL,
  `lastsenddate` datetime default NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `smsreminders`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tags`
-- 

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL auto_increment,
  `tagname` varchar(100) NOT NULL,
  PRIMARY KEY  (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tags`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `email` varchar(150) default NULL,
  `password` varchar(50) default NULL,
  `code` varchar(200) default NULL,
  `status` int(2) NOT NULL default '0',
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `deleted` timestamp NULL default NULL,
  `role` enum('Superadmin','Admin','User') NOT NULL default 'User',
  `name` varchar(100) default NULL,
  `squestion` varchar(255) default NULL,
  `sanswer` varchar(255) default NULL,
  PRIMARY KEY  (`user_id`)
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
