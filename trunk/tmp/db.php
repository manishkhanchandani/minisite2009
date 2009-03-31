<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn = "localhost";
$database_conn = "minisite2";
$username_conn = "user";
$password_conn = "password";
$conn = mysql_connect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_conn, $conn) or die('cannot select db');


$sql = "CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog set `blog_id`='1', `id`='1', `user_id`='1', `title`='My Great India', `description`='i am indian and born in india. so come enjoy me. that is the spirit.', `created`='2009-03-30 03:40:41', `status`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog set `blog_id`='2', `id`='1', `user_id`='1', `title`='great maharashtra', `description`='great maharashtra is here . so come and enjoy it, thanks for adding by.', `created`='2009-03-30 04:02:23', `status`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog set `blog_id`='3', `id`='2', `user_id`='1', `title`='testtest', `description`='testest testest testest testesttestest testesttestest testesttestest testesttestest testesttestest testesttestest testesttestest testesttestest testest', `created`='2009-03-30 17:16:53', `status`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog set `blog_id`='4', `id`='3', `user_id`='1', `title`='dd', `description`='ddd dddddddd ddd
ddd
ddddddddddddddddddddddddd
Dddddddddd ddddddddddddddddddddd ddddddddd ddddddddddd', `created`='2009-03-30 17:29:13', `status`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `blog_cat_rel` (
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_cat_rel set `blog_id`='1', `id`='0', `category_id`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_cat_rel set `blog_id`='2', `id`='0', `category_id`='3'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_cat_rel set `blog_id`='3', `id`='0', `category_id`='7'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `blog_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_categories set `category_id`='1', `id`='1', `category`='India', `parent_id`='0'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_categories set `category_id`='2', `id`='1', `category`='USA', `parent_id`='0'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_categories set `category_id`='3', `id`='1', `category`='Maharashtra', `parent_id`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_categories set `category_id`='4', `id`='1', `category`='Gujarat', `parent_id`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_categories set `category_id`='5', `id`='1', `category`='Pune', `parent_id`='3'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_categories set `category_id`='6', `id`='1', `category`='Mumbai', `parent_id`='3'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_categories set `category_id`='7', `id`='2', `category`='test', `parent_id`='0'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_categories set `category_id`='8', `id`='2', `category`='test1', `parent_id`='0'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `commentor` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `comment_date` datetime DEFAULT NULL,
  `cstatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='1', `id`='1', `blog_id`='2', `commentor`='1', `comments`='aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', `comment_date`='2009-03-30 16:10:31', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='2', `id`='1', `blog_id`='2', `commentor`='1', `comments`='aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', `comment_date`='2009-03-30 16:13:15', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='3', `id`='1', `blog_id`='2', `commentor`='1', `comments`='aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', `comment_date`='2009-03-30 16:14:15', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='4', `id`='1', `blog_id`='2', `commentor`='1', `comments`='aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', `comment_date`='2009-03-30 16:15:19', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='5', `id`='1', `blog_id`='2', `commentor`='1', `comments`='aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', `comment_date`='2009-03-30 16:15:19', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='6', `id`='1', `blog_id`='2', `commentor`='1', `comments`='aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', `comment_date`='2009-03-30 16:15:52', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='7', `id`='1', `blog_id`='2', `commentor`='1', `comments`='dddmanish aaa ssssssssssss ssssssssssss ssssssssssssssssssss sssssssssssssssss', `comment_date`='2009-03-30 16:19:59', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='8', `id`='2', `blog_id`='3', `commentor`='1', `comments`='sssssssss sssssssssssssss sssssssssssssssssssssssssssssssss', `comment_date`='2009-03-30 17:17:03', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='9', `id`='2', `blog_id`='3', `commentor`='1', `comments`='axxxxxxx xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxccccccccccccc cx', `comment_date`='2009-03-30 17:17:13', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='10', `id`='2', `blog_id`='3', `commentor`='1', `comments`='asssss
s
s
s
s
s

s

s
ssssssssssssssssssssssssssssssssssssssss
















sssssssssssssssss', `comment_date`='2009-03-30 17:20:04', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='11', `id`='2', `blog_id`='3', `commentor`='1', `comments`='asssss
s
s
s
s
s

s

s
ssssssssssssssssssssssssssssssssssssssss
















sssssssssssssssss', `comment_date`='2009-03-30 17:20:23', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='12', `id`='2', `blog_id`='3', `commentor`='1', `comments`='asssss
s
s
s
s
s

s

s
ssssssssssssssssssssssssssssssssssssssss
















sssssssssssssssss', `comment_date`='2009-03-30 17:28:39', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='13', `id`='2', `blog_id`='3', `commentor`='1', `comments`='asssss
s
s
s
s
s

s

s
ssssssssssssssssssssssssssssssssssssssss
















sssssssssssssssss', `comment_date`='2009-03-30 17:28:41', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='14', `id`='2', `blog_id`='3', `commentor`='1', `comments`='asssss
s
s
s
s
s

s

s
ssssssssssssssssssssssssssssssssssssssss
















sssssssssssssssss', `comment_date`='2009-03-30 17:28:42', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='15', `id`='3', `blog_id`='4', `commentor`='1', `comments`='dddddddddd ddddddddddddddddddd ddddddddd ddddddddd ddddddddddddddd', `comment_date`='2009-03-30 17:29:32', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_comments set `comment_id`='16', `id`='3', `blog_id`='4', `commentor`='1', `comments`='ee
e
e
e
e

e
eeeeeeeeeeee
eeeeeeeeeeeeeeeeeee
eeeeeeeeeeeeeeeeeeeeeeeeeee
eeeeeeeeeeeeeeeeeee', `comment_date`='2009-03-30 18:23:59', `cstatus`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `blog_tags` (
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_tags set `blog_id`='1', `id`='1', `tag_id`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_tags set `blog_id`='1', `id`='1', `tag_id`='2'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_tags set `blog_id`='2', `id`='1', `tag_id`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_tags set `blog_id`='2', `id`='1', `tag_id`='3'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_tags set `blog_id`='3', `id`='2', `tag_id`='2'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into blog_tags set `blog_id`='4', `id`='3', `tag_id`='4'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `form_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into categories set `category_id`='1', `category`='india', `parent_id`='0', `form_id`='2'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into categories set `category_id`='2', `category`='usa', `parent_id`='0', `form_id`='2'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into categories set `category_id`='3', `category`='maharashtra', `parent_id`='1', `form_id`='2'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into categories set `category_id`='4', `category`='mumbai', `parent_id`='3', `form_id`='2'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into categories set `category_id`='5', `category`='pune', `parent_id`='3', `form_id`='2'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `datas` (
  `data_id` int(11) NOT NULL,
  `data_key` varchar(200) DEFAULT NULL,
  `data_value` text,
  `reference` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

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
mysql_query($sql) or die(mysql_error());

$sql = "insert into fields set `field_id`='1', `form_id`='2', `field_name`='title', `field_label`='Title', `field_type`='text', `field_input`='fvc', `field_default`='', `field_default_selected`='', `field_validate`='1', `field_validate_required`='1', `field_validate_rule`='', `field_validate_value`='', `field_validate_error`='Please fill the title.', `field_search`='1', `field_search_label`='Title', `field_search_type`='text', `field_search_default`='', `field_search_default_selected`='', `field_view_show`='1', `field_detail_show`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into fields set `field_id`='2', `form_id`='2', `field_name`='description', `field_label`='Description', `field_type`='textarea', `field_input`='ftext', `field_default`='', `field_default_selected`='', `field_validate`='0', `field_validate_required`='0', `field_validate_rule`='', `field_validate_value`='', `field_validate_error`='', `field_search`='1', `field_search_label`='Description:', `field_search_type`='text', `field_search_default`='', `field_search_default_selected`='', `field_view_show`='1', `field_detail_show`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `forms` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(100) DEFAULT NULL,
  `category` enum('None','Single','Multiple') NOT NULL DEFAULT 'None',
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into forms set `form_id`='1', `form_name`='Test', `category`='None'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into forms set `form_id`='2', `form_name`='test2', `category`='Single'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `prebuilt_1` (
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_1 set `id`='1', `keyword`='Mumbai', `template`='Mumbai header
<hr>
[[BODY]]
<hr>
footer', `css`='', `js`='', `sitename`='Mumbai', `siteemail`='mumbai@mkgalaxy.com', `ftphost`='ftp.servage.net', `ftpuser`='manishkk', `ftppassword`='mAnIsH74', `ftpdir`='/www/minisite', `dbhost`='mysql1076.servage.net', `db`='minisite09', `dbuser`='minisite09', `dbpassword`='password123'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_1 set `id`='2', `keyword`='Mulund', `template`='Mulund header
<hr>
[[BODY]]
<hr>
footer', `css`='', `js`='', `sitename`='', `siteemail`='', `ftphost`='', `ftpuser`='', `ftppassword`='', `ftpdir`='', `dbhost`='', `db`='', `dbuser`='', `dbpassword`=''";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_1 set `id`='3', `keyword`='Bhandup', `template`='Bhandup header
<hr>
[[BODY]]
<hr>
footer', `css`='', `js`='', `sitename`='', `siteemail`='', `ftphost`='', `ftpuser`='', `ftppassword`='', `ftpdir`='', `dbhost`='', `db`='', `dbuser`='', `dbpassword`=''";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_1 set `id`='4', `keyword`='Tomato', `template`='', `css`='', `js`='', `sitename`='', `siteemail`='', `ftphost`='', `ftpuser`='', `ftppassword`='', `ftpdir`='', `dbhost`='', `db`='', `dbuser`='', `dbpassword`=''";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `prebuilt_2_concepts` (
  `id` int(11) NOT NULL DEFAULT '0',
  `concept_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`concept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='1', `concept_id`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='2', `concept_id`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='3', `concept_id`='1'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_2_concepts set `id`='4', `concept_id`='5'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `prebuilt_3_settings` (
  `id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='1', `setting_id`='5'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='1', `setting_id`='7'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='1', `setting_id`='8'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='2', `setting_id`='4'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='3', `setting_id`='3'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_3_settings set `id`='4', `setting_id`='2'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `prebuilt_concepts` (
  `concept_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept` varchar(200) DEFAULT NULL,
  `links` text,
  PRIMARY KEY (`concept_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='1', `concept`='blog', `links`=''";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='2', `concept`='classifieds', `links`=''";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='3', `concept`='adsense', `links`=''";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='4', `concept`='google analytics', `links`=''";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='5', `concept`='news', `links`=''";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts set `concept_id`='6', `concept`='articles', `links`=''";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `prebuilt_concepts_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `concept_id` int(11) NOT NULL DEFAULT '0',
  `setting_label` varchar(200) DEFAULT NULL,
  `comments` text,
  `inputtype` enum('radio','checkbox') DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='1', `concept_id`='5', `setting_label`='Yahoo News', `comments`='http://news.search.yahoo.com/news/rss?p=[[KEYWORD]]&ei=UTF-8&fl=0&x=wrt', `inputtype`='checkbox'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='2', `concept_id`='5', `setting_label`='Google News', `comments`='http://news.google.com/news?pz=1&ned=us&hl=en&q=[[KEYWORD]]&output=rss', `inputtype`='checkbox'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='3', `concept_id`='1', `setting_label`='No Category', `comments`='', `inputtype`='radio'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='4', `concept_id`='1', `setting_label`='Single Level Category', `comments`='', `inputtype`='radio'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='5', `concept_id`='1', `setting_label`='Multilevel Category', `comments`='', `inputtype`='radio'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='7', `concept_id`='1', `setting_label`='Logged In Users can only Post', `comments`='', `inputtype`='checkbox'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into prebuilt_concepts_settings set `setting_id`='8', `concept_id`='1', `setting_label`='Logged In Users can only Comment', `comments`='', `inputtype`='checkbox'";
mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(100) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into tags set `tag_id`='1', `tagname`='great india'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into tags set `tag_id`='2', `tagname`='test'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into tags set `tag_id`='3', `tagname`='great maharashtra'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into tags set `tag_id`='4', `tagname`='dd'";
mysql_query($sql) or die(mysql_error());

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";
mysql_query($sql) or die(mysql_error());

$sql = "insert into users set `user_id`='1', `email`='naveenkhanchandani@gmail.com', `password`='password', `code`='5b0fa0e4c041548bb6289e15d865a696', `status`='0', `created`='2009-03-18 03:25:38', `modified`='', `deleted`='', `role`='User', `name`='naveen', `squestion`='Name of Your First School', `sanswer`='new era high school'";
mysql_query($sql) or die(mysql_error());

$sql = "insert into users set `user_id`='2', `email`='mkgxy@mkgalaxy.com', `password`='password', `code`='350db081a661525235354dd3e19b8c05', `status`='0', `created`='2009-03-24 18:18:23', `modified`='', `deleted`='', `role`='User', `name`='Manish Khanchandani', `squestion`='Name of Your First School', `sanswer`='new era high school'";
mysql_query($sql) or die(mysql_error());


?>