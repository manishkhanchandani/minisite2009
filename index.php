<?php
include_once('config.php');

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