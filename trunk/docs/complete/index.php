<?php
ini_set('memory_limit','500M');
ini_set('max_execution_time','-1'); 
//error_reporting(0);
ob_start();
session_start();

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" ); 

// put full path to Smarty.class.php
require('includes/smarty/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = 'includes/templates';
$smarty->compile_dir = 'includes/templates_c';
$smarty->cache_dir = 'includes/cache';
$smarty->config_dir = 'includes/configs';
if($_SERVER['HTTP_HOST']=="localhost") {
	$smarty->force_compile = true;
}

if($_SERVER['HTTP_HOST']=="mumbaionline.org.in" || $_SERVER['HTTP_HOST']=="www.mumbaionline.org.in") {
	define('FOLDER', "/complete");
} else if($_SERVER['HTTP_HOST']=="localhost") {
	define('FOLDER', "/complete");
} else {
	define('FOLDER', "/complete");
}
define('HTTPPATH', "http://".$_SERVER['HTTP_HOST'].FOLDER);
define('DOCPATH', $_SERVER['DOCUMENT_ROOT'].FOLDER);
$PAGETITLE = "Mumbaionline.org.in";
$smarty->assign('HTTPPATH', HTTPPATH);
$smarty->assign('FOLDER', FOLDER);
$smarty->assign('DOCPATH', DOCPATH);
$smarty->assign('PAGETITLE', $PAGETITLE);

define('CACHETIME', 1500); // seconds
define('SITENAME', 'Mumbaionline.org.in'); 
define('SITEURL', HTTPPATH); 
define('ADMINNAME', 'Administrator'); 
define('ADMINEMAIL', 'admin@mumbaionline.org.in'); 
$smarty->assign('CACHETIME', CACHETIME);
$smarty->assign('SITENAME', SITENAME);
$smarty->assign('SITEURL', SITEURL);
$smarty->assign('ADMINNAME', ADMINNAME);
$smarty->assign('ADMINEMAIL', ADMINEMAIL);

// adodb connection
include('includes/adodb/adodb-exceptions.inc.php'); # load code common to ADOdb
include('includes/adodb/adodb.inc.php'); # load code common to ADOdb 

$ADODB_CACHE_DIR = 'ADODB_cache'; 
//$dbFrameWork = &ADONewConnection('mysql');  # create a connection 
//$dbFrameWork->Connect('remote-mysql3.servage.net','framework2008','framework2008','framework2008');# connect to MySQL, framework db
try { 
	$dbFrameWork = &ADONewConnection('mysql');  # create a connection 
	if($_SERVER['HTTP_HOST']=="localhost") {
		$dbFrameWork->Connect('localhost','user','password','complete');# connect to MySQL, framework db
	} else {
		$dbFrameWork->Connect('remote-mysql4.servage.net','complete','mAnIsH74','complete');# connect to MySQL, framework db
	}
} catch (exception $e) { 
	ob_end_clean();
	echo 'Loading in 5 seconds. If page does not refresh in 5 seconds, please refresh manually.<meta http-equiv="refresh" content="5">';
	//echo "<pre>";var_dump($e); adodb_backtrace($e->gettrace());
	exit;
} 

function __autoload($classname) {
	include("Classes/{$classname}.php");
}
spl_autoload_register('spl_autoload');
if (function_exists('__autoload')) {
	spl_autoload_register('__autoload');
}
$Common = new Common($dbFrameWork); // this is common class used all over the site.
$AJAX = $_GET['AJAX']; // used to show page directly without ajax, if this is set to 1, then ajax is not called and page is directly called. remove exit if direct is set to 1.

if($_GET['p']) $p = $_GET['p'].".php";
if(!$p) {
	$p = "home.php";
	if($_COOKIE['user_id'] && $_GET['action']!="logout") {
		header("Location: index.php?p=main");
		exit;
	}
}
if(!file_exists($p)) $p = "error.php";
if($p=="main.php" && !$_COOKIE['user_id']) {
	header("Location: index.php");
	exit;
}
include_once($p);


if(!$body) $body = "Content Will be Displayed Here.";
$header = $smarty->fetch("header.html");
$footer = $smarty->fetch("footer.html");
echo $header.$body.$footer;
?>