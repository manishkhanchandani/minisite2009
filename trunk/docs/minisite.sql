CREATE TABLE IF NOT EXISTS `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `blog` (`blog_id`, `id`, `user_id`, `title`, `description`, `created`, `status`) VALUES
(1, 1, 1, 'My Great India', 'i am indian and born in india. so come enjoy me. that is the spirit.', '2009-03-30 03:40:41', 1),
(2, 1, 1, 'great maharashtra', 'great maharashtra is here . so come and enjoy it, thanks for adding by.', '2009-03-30 04:02:23', 1),
(3, 2, 1, 'testtest', 'testest testest testest testesttestest testesttestest testesttestest testesttestest testesttestest testesttestest testesttestest testesttestest testest', '2009-03-30 17:16:53', 1),
(4, 3, 1, 'dd', 'ddd dddddddd ddd\r\nddd\r\nddddddddddddddddddddddddd\r\nDddddddddd ddddddddddddddddddddd ddddddddd ddddddddddd', '2009-03-30 17:29:13', 1);

CREATE TABLE IF NOT EXISTS `blog_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=9 ;

INSERT INTO `blog_categories` (`category_id`, `id`, `category`, `parent_id`) VALUES
(1, 1, 'India', 0),
(2, 1, 'USA', 0),
(3, 1, 'Maharashtra', 1),
(4, 1, 'Gujarat', 1),
(5, 1, 'Pune', 3),
(6, 1, 'Mumbai', 3),
(7, 2, 'test', 0),
(8, 2, 'test1', 0);

CREATE TABLE IF NOT EXISTS `blog_cat_rel` (
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `blog_cat_rel` (`blog_id`, `id`, `category_id`) VALUES
(1, 0, 1),
(2, 0, 3),
(3, 0, 7);

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `commentor` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `comment_date` datetime DEFAULT NULL,
  `cstatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

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
(16, 3, 4, 1, 'ee\r\ne\r\ne\r\ne\r\ne\r\n\r\ne\r\neeeeeeeeeeee\r\neeeeeeeeeeeeeeeeeee\r\neeeeeeeeeeeeeeeeeeeeeeeeeee\r\neeeeeeeeeeeeeeeeeee', '2009-03-30 18:23:59', 1);

CREATE TABLE IF NOT EXISTS `blog_tags` (
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `blog_tags` (`blog_id`, `id`, `tag_id`) VALUES
(1, 1, 1),
(1, 1, 2),
(2, 1, 1),
(2, 1, 3),
(3, 2, 2),
(4, 3, 4);

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `form_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

INSERT INTO `categories` (`category_id`, `category`, `parent_id`, `form_id`) VALUES
(1, 'india', 0, 2),
(2, 'usa', 0, 2),
(3, 'maharashtra', 1, 2),
(4, 'mumbai', 3, 2),
(5, 'pune', 3, 2);

CREATE TABLE IF NOT EXISTS `datas` (
  `data_id` int(11) NOT NULL,
  `data_key` varchar(200) DEFAULT NULL,
  `data_value` text,
  `reference` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

INSERT INTO `fields` (`field_id`, `form_id`, `field_name`, `field_label`, `field_type`, `field_input`, `field_default`, `field_default_selected`, `field_validate`, `field_validate_required`, `field_validate_rule`, `field_validate_value`, `field_validate_error`, `field_search`, `field_search_label`, `field_search_type`, `field_search_default`, `field_search_default_selected`, `field_view_show`, `field_detail_show`) VALUES
(1, 2, 'title', 'Title', 'text', 'fvc', NULL, NULL, 1, 1, NULL, NULL, 'Please fill the title.', 1, 'Title', 'text', NULL, NULL, 1, 1),
(2, 2, 'description', 'Description', 'textarea', 'ftext', NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 'Description:', 'text', NULL, NULL, 1, 1);

CREATE TABLE IF NOT EXISTS `forms` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(100) DEFAULT NULL,
  `category` enum('None','Single','Multiple') NOT NULL DEFAULT 'None',
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

INSERT INTO `forms` (`form_id`, `form_name`, `category`) VALUES
(1, 'Test', 'None'),
(2, 'test2', 'Single');

CREATE TABLE IF NOT EXISTS `prebuilt_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(200) DEFAULT NULL,
  `template` text,
  `css` text,
  `js` text,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `prebuilt_1` (`id`, `keyword`, `template`, `css`, `js`, `sitename`, `siteemail`, `ftphost`, `ftpuser`, `ftppassword`, `ftpdir`, `dbhost`, `db`, `dbuser`, `dbpassword`) VALUES
(1, 'Mumbai', 'Mumbai header\r\n<hr>\r\n[[BODY]]\r\n<hr>\r\nfooter', NULL, NULL, 'Mumbai', 'mumbai@mkgalaxy.com', 'ftp.servage.net', 'manishkk', 'mAnIsH74', '/www/minisite', 'mysql1076.servage.net', 'minisite09', 'minisite09', 'password123'),
(2, 'Mulund', 'Mulund header\r\n<hr>\r\n[[BODY]]\r\n<hr>\r\nfooter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Bhandup', 'Bhandup header\r\n<hr>\r\n[[BODY]]\r\n<hr>\r\nfooter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Tomato', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

CREATE TABLE IF NOT EXISTS `prebuilt_2_concepts` (
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`concept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `prebuilt_2_concepts` (`id`, `concept_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 5);

CREATE TABLE IF NOT EXISTS `prebuilt_3_settings` (
  `id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `prebuilt_3_settings` (`id`, `setting_id`) VALUES
(1, 5),
(1, 7),
(1, 8),
(2, 4),
(3, 3),
(4, 2);

CREATE TABLE IF NOT EXISTS `prebuilt_concepts` (
  `concept_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept` varchar(200) DEFAULT NULL,
  `links` text,
  PRIMARY KEY (`concept_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `prebuilt_concepts` (`concept_id`, `concept`, `links`) VALUES
(1, 'blog', NULL),
(2, 'classifieds', NULL),
(3, 'adsense', NULL),
(4, 'google analytics', NULL),
(5, 'news', NULL),
(6, 'articles', NULL);

CREATE TABLE IF NOT EXISTS `prebuilt_concepts_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `setting_label` varchar(200) DEFAULT NULL,
  `comments` text,
  `inputtype` enum('radio','checkbox') DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

INSERT INTO `prebuilt_concepts_settings` (`setting_id`, `concept_id`, `setting_label`, `comments`, `inputtype`) VALUES
(1, 5, 'Yahoo News', 'http://news.search.yahoo.com/news/rss?p=[[KEYWORD]]&ei=UTF-8&fl=0&x=wrt\r\n', 'checkbox'),
(2, 5, 'Google News', 'http://news.google.com/news?pz=1&ned=us&hl=en&q=[[KEYWORD]]&output=rss', 'checkbox'),
(3, 1, 'No Category', NULL, 'radio'),
(4, 1, 'Single Level Category', NULL, 'radio'),
(5, 1, 'Multilevel Category', NULL, 'radio'),
(7, 1, 'Logged In Users can only Post', NULL, 'checkbox'),
(8, 1, 'Logged In Users can only Comment', NULL, 'checkbox');

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(100) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=5 ;

INSERT INTO `tags` (`tag_id`, `tagname`) VALUES
(1, 'great india'),
(2, 'test'),
(3, 'great maharashtra'),
(4, 'dd');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

INSERT INTO `users` (`user_id`, `email`, `password`, `code`, `status`, `created`, `modified`, `deleted`, `role`, `name`, `squestion`, `sanswer`) VALUES
(1, 'naveenkhanchandani@gmail.com', 'password', '5b0fa0e4c041548bb6289e15d865a696', 0, '2009-03-18 03:25:38', NULL, NULL, 'User', 'naveen', 'Name of Your First School', 'new era high school'),
(2, 'mkgxy@mkgalaxy.com', 'password', '350db081a661525235354dd3e19b8c05', 0, '2009-03-24 18:18:23', NULL, NULL, 'User', 'Manish Khanchandani', 'Name of Your First School', 'new era high school');
