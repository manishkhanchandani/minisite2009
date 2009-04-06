<?php
include("Connections/conn.php");

$sql = "CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `album` varchar(200) default NULL,
  `album_created` datetime default NULL,
  `file_type` enum('Image','File','Music','Video') default NULL,
  PRIMARY KEY  (`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `ask_expert` (
  `ask_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `title` varchar(200) default NULL,
  `message` text,
  `pid` int(11) default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`ask_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `title` varchar(255) default NULL,
  `description` text,
  `created` datetime default NULL,
  `status` int(1) NOT NULL default '1',
  PRIMARY KEY  (`blog_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into blog set `blog_id`='1', `id`='1', `user_id`='1', `title`='test', `description`='tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes 


tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes', `created`='2009-04-06 05:14:52', `status`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog_cat_rel` (
  `blog_id` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL default '0',
  `category_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`blog_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `category` varchar(200) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `blog_id` int(11) NOT NULL default '0',
  `commentor` int(11) NOT NULL default '0',
  `comments` text,
  `comment_date` datetime default NULL,
  `cstatus` int(1) NOT NULL default '1',
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into blog_comments set `comment_id`='1', `id`='1', `blog_id`='1', `commentor`='1', `comments`='test tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes', `comment_date`='2009-04-06 05:15:05', `cstatus`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into blog_comments set `comment_id`='2', `id`='1', `blog_id`='1', `commentor`='6', `comments`='ddddd ddddd ddddd ddddd ddddd ddddd ddddd ddddd ddddd ddddd ddddd 

ddddd ddddd ddddd ddddd', `comment_date`='2009-04-06 05:16:06', `cstatus`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `blog_tags` (
  `blog_id` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL default '0',
  `tag_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`blog_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into blog_tags set `blog_id`='1', `id`='1', `tag_id`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `category` varchar(200) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  `form_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `datas` (
  `data_id` int(11) NOT NULL,
  `data_key` varchar(200) default NULL,
  `data_value` text,
  `reference` varchar(200) default NULL,
  PRIMARY KEY  (`data_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `deathreminder` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `downtime` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `downtime_results` (
  `result_id` int(11) NOT NULL auto_increment,
  `downtime_id` int(11) default NULL,
  `id` int(11) default NULL,
  `check_date` datetime default NULL,
  `pingstatus` int(1) NOT NULL default '1',
  `textcheckstatus` int(1) NOT NULL default '1',
  `finalstatus` int(1) NOT NULL,
  PRIMARY KEY  (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `emailreminders` (
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into emailreminders set `rid`='1', `id`='1', `user_id`='6', `title`='test', `message`='test', `toemail`='manish.', `senddate`='', `emailtype`='Fixed', `emaildatetime`='2009-04-05 02:00:00', `recurringtype`='', `recurringfixedtypedates`='', `created`='2009-04-06 05:34:31', `modified`='2009-04-06 05:35:09', `status`='1', `lastsenddate`='2009-04-06 05:35:09'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into emailreminders set `rid`='2', `id`='1', `user_id`='6', `title`='test', `message`='test', `toemail`='manish@mkgalaxy.com', `senddate`='1238896800', `emailtype`='Fixed', `emaildatetime`='2009-04-05 02:00:00', `recurringtype`='', `recurringfixedtypedates`='', `created`='2009-04-06 05:34:31', `modified`='2009-04-06 05:35:09', `status`='1', `lastsenddate`='2009-04-06 05:35:09'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into emailreminders set `rid`='3', `id`='1', `user_id`='6', `title`='test', `message`='test', `toemail`='manish@mkgalaxy.com', `senddate`='1238896800', `emailtype`='Fixed', `emaildatetime`='2009-04-05 02:00:00', `recurringtype`='', `recurringfixedtypedates`='', `created`='2009-04-06 05:34:31', `modified`='2009-04-06 05:35:09', `status`='1', `lastsenddate`='2009-04-06 05:35:09'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `events` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `events_rsvp` (
  `rsvp_id` int(11) NOT NULL auto_increment,
  `event_id` int(11) default NULL,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `cuser_id` int(11) default NULL,
  `status` int(1) default NULL,
  `status_date` datetime default NULL,
  PRIMARY KEY  (`rsvp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `fields` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into fields set `field_id`='1', `form_id`='2', `field_name`='title', `field_label`='Title', `field_type`='text', `field_input`='fvc', `field_default`='', `field_default_selected`='', `field_validate`='1', `field_validate_required`='1', `field_validate_rule`='', `field_validate_value`='', `field_validate_error`='Please fill the title.', `field_search`='1', `field_search_label`='Title', `field_search_type`='text', `field_search_default`='', `field_search_default_selected`='', `field_view_show`='1', `field_detail_show`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into fields set `field_id`='2', `form_id`='2', `field_name`='description', `field_label`='Description', `field_type`='textarea', `field_input`='ftext', `field_default`='', `field_default_selected`='', `field_validate`='0', `field_validate_required`='0', `field_validate_rule`='', `field_validate_value`='', `field_validate_error`='', `field_search`='1', `field_search_label`='Description:', `field_search_type`='text', `field_search_default`='', `field_search_default_selected`='', `field_view_show`='1', `field_detail_show`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `files` (
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='1', `id`='1', `group_id`='', `user_id`='1', `ref`='9b32fb4b2fe3e33ba4ecb256ab3e4958', `filename`='2748149d97a29b33af.jpg', `filerealname`='i73gn5.jpg', `filepath`='i7/user_1', `filesize`='55257', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:42:33', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='2', `id`='1', `group_id`='', `user_id`='1', `ref`='9b32fb4b2fe3e33ba4ecb256ab3e4958', `filename`='43949d97a29b50ce.doc', `filerealname`='Project.doc', `filepath`='Pr/user_1', `filesize`='29696', `fileext`='doc', `filetype`='application/msword', `created`='2009-04-06 03:42:33', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='3', `id`='1', `group_id`='', `user_id`='1', `ref`='9b32fb4b2fe3e33ba4ecb256ab3e4958', `filename`='1783849d97a29b5e3e.jpg', `filerealname`='r8tf0i.jpg', `filepath`='r8/user_1', `filesize`='57559', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:42:33', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='4', `id`='1', `group_id`='', `user_id`='1', `ref`='9b32fb4b2fe3e33ba4ecb256ab3e4958', `filename`='3148549d97a29b6b69.txt', `filerealname`='readme.txt', `filepath`='re/user_1', `filesize`='1737', `fileext`='txt', `filetype`='text/plain', `created`='2009-04-06 03:42:33', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='5', `id`='1', `group_id`='', `user_id`='1', `ref`='9b32fb4b2fe3e33ba4ecb256ab3e4958', `filename`='79049d97a29d903f.jpg', `filerealname`='28nng0.jpg', `filepath`='28/user_1', `filesize`='79754', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:42:33', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='6', `id`='1', `group_id`='', `user_id`='1', `ref`='9b32fb4b2fe3e33ba4ecb256ab3e4958', `filename`='1923849d97a29dae99.jpg', `filerealname`='3020yua.jpg', `filepath`='30/user_1', `filesize`='63455', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:42:33', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='7', `id`='1', `group_id`='', `user_id`='1', `ref`='9b32fb4b2fe3e33ba4ecb256ab3e4958', `filename`='1764749d97a29dbde7.doc', `filerealname`='1237353762_Project.doc', `filepath`='12/user_1', `filesize`='29696', `fileext`='doc', `filetype`='application/msword', `created`='2009-04-06 03:42:33', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='8', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='2859349d97bb40b267.jpg', `filerealname`='r8tf0i.jpg', `filepath`='r8/user_1', `filesize`='57559', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:49:08', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='9', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='2730649d97bb40c9bc.txt', `filerealname`='readme.txt', `filepath`='re/user_1', `filesize`='1737', `fileext`='txt', `filetype`='text/plain', `created`='2009-04-06 03:49:08', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='10', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='311049d97bb40d394.jpg', `filerealname`='28nng0.jpg', `filepath`='28/user_1', `filesize`='79754', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:49:08', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='11', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='1197449d97bb40dcc9.jpg', `filerealname`='3020yua.jpg', `filepath`='30/user_1', `filesize`='63455', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:49:08', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='12', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='3144249d97bb41e16c.doc', `filerealname`='1237353762_Project.doc', `filepath`='12/user_1', `filesize`='29696', `fileext`='doc', `filetype`='application/msword', `created`='2009-04-06 03:49:08', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='13', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='1391749d97bb41f849.jpg', `filerealname`='i73gn5.jpg', `filepath`='i7/user_1', `filesize`='55257', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:49:08', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='14', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='2298649d97bb420146.doc', `filerealname`='Project.doc', `filepath`='Pr/user_1', `filesize`='29696', `fileext`='doc', `filetype`='application/msword', `created`='2009-04-06 03:49:08', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='15', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='3262649d97c1ed948c.jpg', `filerealname`='Death.jpg', `filepath`='De/user_1', `filesize`='554242', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:50:54', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='16', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='880349d97c39318a1.jpg', `filerealname`='img03.jpg', `filepath`='im/user_1', `filesize`='3063', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 03:51:21', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='17', `id`='1', `group_id`='', `user_id`='1', `ref`='f8270315053a9e2c2d492150b2aef7e3', `filename`='664649d97c39336a8.png', `filerealname`='mumbaionline.png', `filepath`='mu/user_1', `filesize`='43096', `fileext`='png', `filetype`='image/png', `created`='2009-04-06 03:51:21', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='18', `id`='1', `group_id`='', `user_id`='6', `ref`='41df8a0ffe1267ef99cc900f22aa80eb', `filename`='237649d9936cd67ff.jpg', `filerealname`='nikhil.jpg', `filepath`='ni/user_6', `filesize`='344257', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 05:30:20', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into files set `file_id`='19', `id`='1', `group_id`='', `user_id`='6', `ref`='41df8a0ffe1267ef99cc900f22aa80eb', `filename`='459849d9936cd8eaf.jpg', `filerealname`='nikhilkhanchandani.jpg', `filepath`='ni/user_6', `filesize`='136196', `fileext`='jpg', `filetype`='image/jpeg', `created`='2009-04-06 05:30:20', `album_id`='0', `hosttype`='File'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `forms` (
  `form_id` int(11) NOT NULL auto_increment,
  `form_name` varchar(100) default NULL,
  `category` enum('None','Single','Multiple') NOT NULL default 'None',
  PRIMARY KEY  (`form_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into forms set `form_id`='1', `form_name`='Test', `category`='None'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into forms set `form_id`='2', `form_name`='test2', `category`='Single'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `forums` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `messages` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `poll` (
  `poll_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `poll_question` text,
  `poll_options` text,
  `created` datetime default NULL,
  `ip` varchar(20) default NULL,
  PRIMARY KEY  (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `poll_results` (
  `result_id` int(11) NOT NULL auto_increment,
  `poll_id` int(11) default NULL,
  `id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `puser_id` int(11) default NULL,
  `option_id` int(4) default NULL,
  `pdate` datetime default NULL,
  PRIMARY KEY  (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_1` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_1 set `id`='1', `keyword`='Pune', `default_id`='0', `home_text`='', `template`='<div id=\"mainBody\">
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
-->', `js`='', `siteurl`='http://mkgalaxy.com', `sitename`='Pune Blogs', `siteemail`='pune@mkgalaxy.com', `ftphost`='', `ftpuser`='', `ftppassword`='', `ftpdir`='', `dbhost`='', `db`='', `dbuser`='', `dbpassword`='', `login_site`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_1 set `id`='2', `keyword`='Mumbai', `default_id`='1', `home_text`='', `template`='<div id=\"mainBody\">
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
-->', `js`='', `siteurl`='http://64.186.128.115/minisite/project1', `sitename`='Mumbai Samachar', `siteemail`='admin@mumbaionline.org.in', `ftphost`='64.186.128.115', `ftpuser`='administrator', `ftppassword`='mAnIsH74', `ftpdir`='/minisite/project1', `dbhost`='64.186.128.115', `db`='minisite', `dbuser`='manishkk', `dbpassword`='manishkk', `login_site`='1'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_2_concepts` (
  `id` int(11) NOT NULL default '0',
  `concept_id` int(11) NOT NULL default '0',
  `homepage` int(1) NOT NULL default '1',
  `displayname` varchar(200) NOT NULL,
  `home_text` text,
  `priority` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`,`concept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='1', `homepage`='1', `displayname`='Blog', `home_text`='Blog is here', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='8', `homepage`='1', `displayname`='Email Reminder', `home_text`='email reminder is on', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='9', `homepage`='1', `displayname`='File Hosting', `home_text`='file host', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='5', `homepage`='1', `displayname`='Pune News', `home_text`='news', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='7', `homepage`='1', `displayname`='SMS Reminder', `home_text`='sms reminder', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='2', `concept_id`='1', `homepage`='1', `displayname`='Mumbai Blog', `home_text`='Mumbai Blog is Back', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='2', `concept_id`='8', `homepage`='0', `displayname`='Mumbai Email Reminder', `home_text`='', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='2', `concept_id`='9', `homepage`='0', `displayname`='Mumbai File Hosting', `home_text`='', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='2', `concept_id`='5', `homepage`='1', `displayname`='Mumbai News', `home_text`='Mumbai News is flashed here!!', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='2', `concept_id`='7', `homepage`='0', `displayname`='Mumbai SMS Reminder', `home_text`='', `priority`='0'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_3_settings` (
  `id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`,`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='1', `setting_id`='2'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='1', `setting_id`='3'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='2', `setting_id`='2'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='2', `setting_id`='3'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_concepts` (
  `concept_id` int(11) NOT NULL auto_increment,
  `concept` varchar(200) default NULL,
  PRIMARY KEY  (`concept_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='1', `concept`='blog'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='5', `concept`='news'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='7', `concept`='smsreminder'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='8', `concept`='emailreminder'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='9', `concept`='filehost'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `prebuilt_concepts_settings` (
  `setting_id` int(11) NOT NULL auto_increment,
  `concept_id` int(11) NOT NULL default '0',
  `setting_label` varchar(200) default NULL,
  `comments` text,
  `inputtype` enum('radio','checkbox') default NULL,
  `reference` varchar(50) default NULL,
  PRIMARY KEY  (`setting_id`)
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

$sql = "CREATE TABLE `prebuilt_templates` (
  `tid` int(11) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `template` text,
  `css` text,
  `js` text,
  PRIMARY KEY  (`tid`)
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_cat_rel` (
  `product_id` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL default '0',
  `concept_id` int(11) default NULL,
  `category_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`product_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `concept_id` int(11) default NULL,
  `category` varchar(200) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_comments` (
  `comment_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `concept_id` int(11) default NULL,
  `product_id` int(11) NOT NULL default '0',
  `commentor` int(11) NOT NULL default '0',
  `comments` text,
  `comment_date` datetime default NULL,
  `cstatus` int(1) NOT NULL default '1',
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_images` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `product_settings` (
  `product_setting_id` int(11) NOT NULL auto_increment,
  `id` int(11) default NULL,
  `concept_id` int(11) default NULL,
  `image_height` int(11) default NULL,
  `image_width` int(11) default NULL,
  `thumbnail_height` int(11) default NULL,
  `thumbnail_width` int(11) default NULL,
  `is_proportionate` int(1) NOT NULL default '1',
  PRIMARY KEY  (`product_setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `review_confirm` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `reviews` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `smsreminders` (
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into smsreminders set `rid`='12', `id`='1', `user_id`='6', `title`='test', `message`='test', `tophone`='919323532886', `senddate`='', `smstype`='Fixed', `smsdatetime`='2009-04-05 01:30:00', `recurringtype`='', `recurringfixedtypedates`='', `created`='2009-04-06 05:31:36', `modified`='2009-04-06 05:31:56', `status`='1', `lastsenddate`='2009-04-06 05:31:56'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL auto_increment,
  `tagname` varchar(100) NOT NULL,
  PRIMARY KEY  (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "insert into tags set `tag_id`='1', `tagname`='test'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());

$sql = "CREATE TABLE `users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
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

$sql = "insert into users set `user_id`='6', `email`='manish.khanchandani@xoriant.com', `password`='password', `code`='662a2e96162905620397b19c9d249781', `status`='1', `created`='2009-04-06 05:15:20', `modified`='', `deleted`='', `role`='User', `name`='Manish Khanchandani', `squestion`='Name of Your First School', `sanswer`='new era high school'";
mysql_query($sql) or die('error'.__LINE__." ".mysql_error());


header("Location: db2.php?ID=2");
exit;
?>