<?php
include("Connections/conn.php");

$sql = "CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `album` varchar(200) DEFAULT NULL,
  `album_created` datetime DEFAULT NULL,
  `file_type` enum('Image','File','Music','Video') DEFAULT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `ask_expert` (
  `ask_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text,
  `pid` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`ask_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog_cat_rel` (
  `product_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`concept_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `commentor` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `comment_date` datetime DEFAULT NULL,
  `cstatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog_tags` (
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `form_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `datas` (
  `data_id` int(11) NOT NULL,
  `data_key` varchar(200) DEFAULT NULL,
  `data_value` text,
  `reference` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `deathreminder` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `downtime` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `downtime_results` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `downtime_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `check_date` datetime DEFAULT NULL,
  `pingstatus` int(1) NOT NULL DEFAULT '1',
  `textcheckstatus` int(1) NOT NULL DEFAULT '1',
  `finalstatus` int(1) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `emailreminders` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into emailreminders set `rid`='6', `id`='1', `user_id`='1', `title`='a', `message`='aa', `toemail`='aaa', `senddate`='1239674400', `emailtype`='Recurring', `emaildatetime`='2009-04-14 02:00:00', `recurringtype`='Every Half Hourly', `recurringfixedtypedates`='', `created`='2009-04-05 08:19:46', `modified`='', `status`='1', `lastsenddate`=''";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into emailreminders set `rid`='5', `id`='1', `user_id`='1', `title`='a', `message`='aa', `toemail`='aaa', `senddate`='1239674400', `emailtype`='Recurring', `emaildatetime`='2009-04-14 02:00:00', `recurringtype`='Every Half Hourly', `recurringfixedtypedates`='', `created`='2009-04-05 08:19:46', `modified`='', `status`='1', `lastsenddate`=''";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `events` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `events_rsvp` (
  `rsvp_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `cuser_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  PRIMARY KEY (`rsvp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `fields` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into fields set `field_id`='1', `form_id`='2', `field_name`='title', `field_label`='Title', `field_type`='text', `field_input`='fvc', `field_default`='', `field_default_selected`='', `field_validate`='1', `field_validate_required`='1', `field_validate_rule`='', `field_validate_value`='', `field_validate_error`='Please fill the title.', `field_search`='1', `field_search_label`='Title', `field_search_type`='text', `field_search_default`='', `field_search_default_selected`='', `field_view_show`='1', `field_detail_show`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into fields set `field_id`='2', `form_id`='2', `field_name`='description', `field_label`='Description', `field_type`='textarea', `field_input`='ftext', `field_default`='', `field_default_selected`='', `field_validate`='0', `field_validate_required`='0', `field_validate_rule`='', `field_validate_value`='', `field_validate_error`='', `field_search`='1', `field_search_label`='Description:', `field_search_type`='text', `field_search_default`='', `field_search_default_selected`='', `field_view_show`='1', `field_detail_show`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `files` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `forms` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(100) DEFAULT NULL,
  `category` enum('None','Single','Multiple') NOT NULL DEFAULT 'None',
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into forms set `form_id`='1', `form_name`='Test', `category`='None'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into forms set `form_id`='2', `form_name`='test2', `category`='Single'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `forums` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `messages` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `poll` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `poll_question` text,
  `poll_options` text,
  `created` datetime DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `poll_results` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `puser_id` int(11) DEFAULT NULL,
  `option_id` int(4) DEFAULT NULL,
  `pdate` datetime DEFAULT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_1` (
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_1 set `id`='1', `keyword`='Mumbai', `default_id`='1', `home_text`='', `template`='<div id=\"mainBody\">
	<div id=\"mainHeader\">
		<h1><?php echo ucwords($SITE[0][\'sitename\']); ?></h1>
		<p><?php echo $SITE[0][\'home_text\']; ?></p>
	</div>
	<div id=\"mainLower\">
		<div id=\"mainNavigation\">
			<?php echo $MENU; ?>		
		</div>
		<div id=\"mainContent\">
			[[BODY]]
		</div>
		<div id=\"mainFooter\">
			<p>Copyright 2009</p>
		</div>
	</div>
</div>', `css`='<!--
body {
	background-color: #990099;
	margin: 0px;
	padding: 0px;
	font-family: Verdana;
	font-size: 11px;
}
td, th, table, p, select, input, textarea {
	font-family: Verdana;
	font-size: 11px;
}
a {
	text-decoration: none;
}
#mainBody {
	width: 800px;
	border: 1px solid #000000;
	margin-right: auto;
	margin-left: auto;
	margin-top:-25px;
}
#mainBody #mainHeader {
	background-color: #000000;
	text-align:center;
	padding-top:25px;
}
#mainBody #mainHeader h1 {
	font-size: 36px;
	font-weight: bold;
	color: #FFFFFF;
}
#mainBody #mainHeader p {
	font-size: 10px;
	color: #FFFFFF;
	text-align:center;
	margin-top: -20px;
	padding-bottom: 25px;
}
#mainBody #mainLower {
	background-color: #FFFFFF;
	margin-top: -20px;
	padding-bottom: 15px;
}
#mainBody #mainLower #mainNavigation {
	padding: 5px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #990099;
}
#mainBody #mainLower #mainContent {
	padding: 10px;
	min-height: 300px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #990099;
}
-->', `js`='', `siteurl`='http://10000projects.info/minisite/project1', `sitename`='Mumbai', `siteemail`='admin@mumbaionline.org.in', `ftphost`='ftp.servage.net', `ftpuser`='manishkk', `ftppassword`='mAnIsH74', `ftpdir`='/www/minisite/project1', `dbhost`='mysql1076.servage.net', `db`='minisite09', `dbuser`='minisite09', `dbpassword`='password123', `login_site`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_2_concepts` (
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `homepage` int(1) NOT NULL DEFAULT '1',
  `displayname` varchar(200) NOT NULL,
  `home_text` text,
  PRIMARY KEY (`id`,`concept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='1', `homepage`='1', `displayname`='Mumbai Blogs', `home_text`='Join us to some exciting blog site.'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='5', `homepage`='1', `displayname`='News on Mumbai', `home_text`='Watch news live'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='7', `homepage`='1', `displayname`='SMS Reminder', `home_text`='Remind your important jobs using our sms service'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='8', `homepage`='1', `displayname`='Email Reminder', `home_text`='Remind your important jobs using our email service'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_3_settings` (
  `id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='1', `setting_id`='2'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='1', `setting_id`='5'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='1', `setting_id`='7'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='1', `setting_id`='8'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_concepts` (
  `concept_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`concept_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='1', `concept`='blog'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='5', `concept`='news'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='7', `concept`='smsreminder'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='8', `concept`='emailreminder'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_concepts_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `setting_label` varchar(200) DEFAULT NULL,
  `comments` text,
  `inputtype` enum('radio','checkbox') DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='1', `concept_id`='5', `setting_label`='Yahoo News', `comments`='http://news.search.yahoo.com/news/rss?p=[[KEYWORD]]&ei=UTF-8&fl=0&x=wrt', `inputtype`='checkbox', `reference`='yahoonews'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='2', `concept_id`='5', `setting_label`='Google News', `comments`='http://news.google.com/news?pz=1&ned=us&hl=en&q=[[KEYWORD]]&output=rss', `inputtype`='checkbox', `reference`='googlenews'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='3', `concept_id`='1', `setting_label`='No Category', `comments`='', `inputtype`='radio', `reference`='nocat'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='4', `concept_id`='1', `setting_label`='Single Level Category', `comments`='', `inputtype`='radio', `reference`='single'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='5', `concept_id`='1', `setting_label`='Multilevel Category', `comments`='', `inputtype`='radio', `reference`='multi'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='7', `concept_id`='1', `setting_label`='Logged In Users can only Post', `comments`='', `inputtype`='checkbox', `reference`='loginpost'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='8', `concept_id`='1', `setting_label`='Logged In Users can only Comment', `comments`='', `inputtype`='checkbox', `reference`='logincomment'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_templates` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `template` text,
  `css` text,
  `js` text,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_templates set `tid`='1', `name`='Blog Template', `template`='<div id=\"mainBody\">
	<div id=\"mainHeader\">
		<h1>Blog Site</h1>
		<p>New blog site is back</p>
	</div>
	<div id=\"mainLower\">
		<div id=\"mainNavigation\">
			<a href=\"<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>\">Home</a> | <a href=\"<?php echo HTTPPATH; ?>/index.php?p=blog&ID=<?php echo $ID; ?>\">Blog</a>		
		</div>
		<div id=\"mainContent\">
			[[BODY]]
		</div>
		<div id=\"mainFooter\">
			<p>Copyright 2009</p>
		</div>
	</div>
</div>', `css`='<!--
body {
	background-color: #990000;
	margin: 0px;
	padding: 0px;
	font-family: Verdana;
	font-size: 11px;
}
td, th, table, p, select, input, textarea {
	font-family: Verdana;
	font-size: 11px;
}
a {
	text-decoration: none;
}
#mainBody {
	width: 800px;
	border: 1px solid #000000;
	margin-right: auto;
	margin-left: auto;
	margin-top:-25px;
}
#mainBody #mainHeader {
	background-color: #000000;
	text-align:center;
	padding-top:25px;
}
#mainBody #mainHeader h1 {
	font-size: 36px;
	font-weight: bold;
	color: #FFFFFF;
}
#mainBody #mainHeader p {
	font-size: 10px;
	color: #FFFFFF;
	text-align:center;
	margin-top: -20px;
	padding-bottom: 25px;
}
#mainBody #mainLower {
	background-color: #FFFFFF;
	margin-top: -20px;
	padding-bottom: 15px;
}
#mainBody #mainLower #mainNavigation {
	padding: 5px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #990000;
}
#mainBody #mainLower #mainContent {
	padding: 10px;
	min-height: 300px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #990000;
}
-->', `js`=''";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_templates set `tid`='3', `name`='News Template', `template`='<div id=\"mainBody\">
	<div id=\"mainHeader\">
		<h1>News Site</h1>
		<p>News site is back</p>
	</div>
	<div id=\"mainLower\">
		<div id=\"mainNavigation\">
			<a href=\"<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>\">Home</a> | <a href=\"<?php echo HTTPPATH; ?>/index.php?p=news&ID=<?php echo $ID; ?>\">News</a>		
		</div>
		<div id=\"mainContent\">
			[[BODY]]
		</div>
		<div id=\"mainFooter\">
			<p>Copyright 2009</p>
		</div>
	</div>
</div>', `css`='<!--
body {
	background-color: #0000FF;
	margin: 0px;
	padding: 0px;
	font-family: Verdana;
	font-size: 11px;
}
td, th, table, p, select, input, textarea {
	font-family: Verdana;
	font-size: 11px;
}
a {
	text-decoration: none;
}
#mainBody {
	width: 800px;
	border: 1px solid #000000;
	margin-right: auto;
	margin-left: auto;
	margin-top:-25px;
}
#mainBody #mainHeader {
	background-color: #000000;
	text-align:center;
	padding-top:25px;
}
#mainBody #mainHeader h1 {
	font-size: 36px;
	font-weight: bold;
	color: #FFFFFF;
}
#mainBody #mainHeader p {
	font-size: 10px;
	color: #FFFFFF;
	text-align:center;
	margin-top: -20px;
	padding-bottom: 25px;
}
#mainBody #mainLower {
	background-color: #FFFFFF;
	margin-top: -20px;
	padding-bottom: 15px;
}
#mainBody #mainLower #mainNavigation {
	padding: 5px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #0000FF;
}
#mainBody #mainLower #mainContent {
	padding: 10px;
	min-height: 300px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #0000FF;
}
-->', `js`=''";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_templates set `tid`='4', `name`='Master Template', `template`='<div id=\"mainBody\">
	<div id=\"mainHeader\">
		<h1><?php echo ucwords($SITE[0][\'sitename\']); ?></h1>
		<p><?php echo $SITE[0][\'home_text\']; ?></p>
	</div>
	<div id=\"mainLower\">
		<div id=\"mainNavigation\">
			<?php echo $MENU; ?>		
		</div>
		<div id=\"mainContent\">
			[[BODY]]
		</div>
		<div id=\"mainFooter\">
			<p>Copyright 2009</p>
		</div>
	</div>
</div>', `css`='<!--
body {
	background-color: #990099;
	margin: 0px;
	padding: 0px;
	font-family: Verdana;
	font-size: 11px;
}
td, th, table, p, select, input, textarea {
	font-family: Verdana;
	font-size: 11px;
}
a {
	text-decoration: none;
}
#mainBody {
	width: 800px;
	border: 1px solid #000000;
	margin-right: auto;
	margin-left: auto;
	margin-top:-25px;
}
#mainBody #mainHeader {
	background-color: #000000;
	text-align:center;
	padding-top:25px;
}
#mainBody #mainHeader h1 {
	font-size: 36px;
	font-weight: bold;
	color: #FFFFFF;
}
#mainBody #mainHeader p {
	font-size: 10px;
	color: #FFFFFF;
	text-align:center;
	margin-top: -20px;
	padding-bottom: 25px;
}
#mainBody #mainLower {
	background-color: #FFFFFF;
	margin-top: -20px;
	padding-bottom: 15px;
}
#mainBody #mainLower #mainNavigation {
	padding: 5px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #990099;
}
#mainBody #mainLower #mainContent {
	padding: 10px;
	min-height: 300px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #990099;
}
-->', `js`=''";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_cat_rel` (
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `commentor` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `comment_date` datetime DEFAULT NULL,
  `cstatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_images` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_settings` (
  `product_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `concept_id` int(11) DEFAULT NULL,
  `image_height` int(11) DEFAULT NULL,
  `image_width` int(11) DEFAULT NULL,
  `thumbnail_height` int(11) DEFAULT NULL,
  `thumbnail_width` int(11) DEFAULT NULL,
  `is_proportionate` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `review_confirm` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `reviews` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `smsreminders` (
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(100) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into users set `user_id`='1', `email`='naveenkhanchandani@gmail.com', `password`='password', `code`='5b0fa0e4c041548bb6289e15d865a696', `status`='0', `created`='2009-03-18 03:25:38', `modified`='', `deleted`='', `role`='User', `name`='naveen', `squestion`='Name of Your First School', `sanswer`='new era high school'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into users set `user_id`='2', `email`='mkgxy@mkgalaxy.com', `password`='password', `code`='350db081a661525235354dd3e19b8c05', `status`='0', `created`='2009-03-24 18:18:23', `modified`='', `deleted`='', `role`='User', `name`='Manish Khanchandani', `squestion`='Name of Your First School', `sanswer`='new era high school'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into users set `user_id`='3', `email`='naveenkhanchandani1@mkgalaxy.com', `password`='password', `code`='', `status`='1', `created`='2009-04-01 06:10:40', `modified`='', `deleted`='', `role`='User', `name`='Manish Khanchandani', `squestion`='Name of Your First School', `sanswer`='ddddd'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into users set `user_id`='4', `email`='naveen@mkgalaxy.com', `password`='pp', `code`='', `status`='1', `created`='2009-04-01 06:13:06', `modified`='', `deleted`='', `role`='User', `name`='mm', `squestion`='Name of Your First School', `sanswer`='mm'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into users set `user_id`='5', `email`='mk@mk.com', `password`='password', `code`='bc6fe82635b1429d3e886eec0fc34f49', `status`='1', `created`='2009-04-02 07:26:33', `modified`='', `deleted`='', `role`='User', `name`='manish', `squestion`='Name of Your First School', `sanswer`='manish'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());


header("Location: db2.php?ID=1");
exit;
?>