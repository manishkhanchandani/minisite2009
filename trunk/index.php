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

// set cookie
if($_GET['rn']) {
	setcookie('rn', $_GET['rn'], time()+(60*60*24*365), "/");
}

// ini settings
if ( ! defined( "PATH_SEPARATOR" ) ) {
  if ( strpos( $_ENV[ "OS" ], "Win" ) !== false )
    define( "PATH_SEPARATOR", ";" );
  else define( "PATH_SEPARATOR", ":" );
}
ini_set("include_path", ini_get('include_path').PATH_SEPARATOR."Connections/".PATH_SEPARATOR."includes/pear/");

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
define('CACHETIME', 1500); // seconds
$smarty->assign('HTTPPATH', HTTPPATH);
$smarty->assign('FOLDER', FOLDER);
$smarty->assign('DOCPATH', DOCPATH);

// adodb connection
include(DOCPATH.'/includes/adodb/adodb-exceptions.inc.php'); # load code common to ADOdb
include(DOCPATH.'/includes/adodb/adodb.inc.php'); # load code common to ADOdb 

$ADODB_CACHE_DIR = DOCPATH.'/ADODB_cache'; 
//$dbFrameWork = &ADONewConnection('mysql');  # create a connection 
//$dbFrameWork->Connect('remote-mysql3.servage.net','framework2008','framework2008','framework2008');# connect to MySQL, framework db
try { 
	include_once(DOCPATH.'/Connections/connection.php');
	$dbFrameWork = &ADONewConnection('mysql');  # create a connection 
	$dbFrameWork->Connect($hostname_conn,$username_conn,$password_conn,$database_conn);# connect to MySQL, framework db
} catch (exception $e) { 
	ob_end_clean();
	echo 'Loading in 5 seconds. If page does not refresh in 5 seconds, please refresh manually.<meta http-equiv="refresh" content="5">';
	//echo "<pre>";var_dump($e); adodb_backtrace($e->gettrace());
	exit;
} 

function __autoload($classname) {
	include(DOCPATH."/Classes/{$classname}.php");
}
spl_autoload_register('spl_autoload');
if (function_exists('__autoload')) {
	spl_autoload_register('__autoload');
}
$Common = new Common($dbFrameWork);

$ID = $_GET['ID'];
if(!$ID) {
	$ID = $Common->getId();
}
//if(!$ID) {
	//echo 'Site is not ready.';
	//exit;
//}
define('ID', $ID);
$smarty->assign('ID', $ID);

$sql = "select * from prebuilt_1 where id = '".$ID."'";
$SITE = $Common->selectCacheRecord($sql);

define('SITENAME', $SITE[0]['sitename']);
define('KEYWORD', $SITE[0]['keyword']); 
define('SITEURL', $SITE[0]['siteurl']); 
define('SITEEMAIL', $SITE[0]['siteemail']);
define('ADMINEMAIL', $SITE[0]['siteemail']); 
define('ADMINNAME', 'Administrator'); 
$smarty->assign('CACHETIME', CACHETIME);
$smarty->assign('SITENAME', SITENAME);
$smarty->assign('SITEURL', SITEURL);
$smarty->assign('SITEEMAIL', SITEEMAIL);
$smarty->assign('ADMINEMAIL', ADMINEMAIL);
$smarty->assign('ADMINNAME', ADMINNAME);
$smarty->assign('SITE', $SITE);

$MENU = $Common->generateMenu($ID);
define('MENU', $MENU);
$smarty->assign('MENU', $MENU);

if($_GET['p']) $p = $_GET['p'].".php";
if(!$p) {
	$p = "home.php";
}
if(!file_exists($p)) $p = "error.php";

include_once($p);

if(!$body) $body = "Content Will be Displayed Here.";
if(!$PAGEHEADING) $PAGEHEADING = "Welcome to ".SITENAME;
$smarty->assign('PAGEHEADING', $PAGEHEADING);

ob_start();
include("includes/sitetemplate/".$ID."_head.php");
$head = ob_get_clean();
ob_start();
include("includes/sitetemplate/".$ID."_foot.php");
$foot = ob_get_clean();
ob_flush();
$smarty->assign('HEAD', $head);
$smarty->assign('FOOT', $foot);

$header = $smarty->fetch("header.html");
$footer = $smarty->fetch("footer.html");
echo $header.$body.$footer;
?>