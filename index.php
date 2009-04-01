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
$smarty->force_compile = true;
if($_SERVER['HTTP_HOST']=="localhost") {
	define('FOLDER', dirname($_SERVER['PHP_SELF']));
} else {
	define('FOLDER', dirname($_SERVER['PHP_SELF']));
}
define('HTTPPATH', "http://".$_SERVER['HTTP_HOST'].FOLDER);
define('DOCPATH', $_SERVER['DOCUMENT_ROOT'].FOLDER);
$PAGETITLE = "";
$smarty->assign('HTTPPATH', HTTPPATH);
$smarty->assign('FOLDER', FOLDER);
$smarty->assign('DOCPATH', DOCPATH);
$smarty->assign('PAGETITLE', $PAGETITLE);

$ID = $_GET['ID'];
if(!$ID) {
	echo 'No Keyword Selected';
	exit;
}
define('ID', $ID);
$smarty->assign('ID', $ID);

// adodb connection
include('includes/adodb/adodb-exceptions.inc.php'); # load code common to ADOdb
include('includes/adodb/adodb.inc.php'); # load code common to ADOdb 

$ADODB_CACHE_DIR = 'ADODB_cache'; 
//$dbFrameWork = &ADONewConnection('mysql');  # create a connection 
//$dbFrameWork->Connect('remote-mysql3.servage.net','framework2008','framework2008','framework2008');# connect to MySQL, framework db
try { 
	include_once('Connections/conn.php');
	$dbFrameWork = &ADONewConnection('mysql');  # create a connection 
	$dbFrameWork->Connect($hostname_conn,$username_conn,$password_conn,$database_conn);# connect to MySQL, framework db
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
$Common = new Common($dbFrameWork);

$sql = "select * from prebuilt_1 where id = '".$ID."'";
$SITE = $Common->selectCacheRecord($sql);

define('CACHETIME', 1500); // seconds
define('SITENAME', $SITE[0]['keyword']); 
define('SITEURL', $SITE[0]['site_url']); 
define('SITEEMAIL', $SITE[0]['site_email']);
define('ADMINEMAIL', $SITE[0]['admin_email']); 
$smarty->assign('CACHETIME', CACHETIME);
$smarty->assign('SITENAME', SITENAME);
$smarty->assign('SITEURL', SITEURL);
$smarty->assign('SITEEMAIL', SITEEMAIL);
$smarty->assign('ADMINEMAIL', ADMINEMAIL);


if($_GET['p']) $p = $_GET['p'].".php";
if(!$p) {
	$p = "home.php";
}
if(!file_exists($p)) $p = "error.php";

include_once($p);

if(!$body) $body = "Content Will be Displayed Here.";
if(!$PAGEHEADING) $PAGEHEADING = "Welcome to ".SITENAME;
$smarty->assign('PAGEHEADING', $PAGEHEADING);

$pattern = array("[[SITENAME]]", "[[PAGEHEADING]]", "[[NEWS]]", "[[BLOG]]");
$replace   = array(SITENAME, $PAGEHEADING, HTTPPATH."/index.php?action=news&ID=".$ID, HTTPPATH."/index.php?action=blog&ID=".$ID);

$head = @file_get_contents("includes/sitetemplate/".$ID."_head.php");
$head = str_replace($pattern, $replace, $head);
$foot = @file_get_contents("includes/sitetemplate/".$ID."_foot.php");
$foot = str_replace($pattern, $replace, $foot);
$smarty->assign('HEAD', $head);
$smarty->assign('FOOT', $foot);

$header = $smarty->fetch("header.html");
$footer = $smarty->fetch("footer.html");
echo $header.$body.$footer;
?>