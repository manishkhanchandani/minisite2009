<?php
if($_GET['user_id']) {
	$userId = $_GET['user_id'];
} else if($_COOKIE['user_id']) {
	$userId = $_COOKIE['user_id'];
} else {
	$body = $smarty->fetch("restrict.html");
	echo $body;
	exit;
}
// getting details for general page
$profile = new Profile;
if($_POST['MM_Insert']==1) {
	print_r($_POST);
	//$profile->updateGeneralProfile($_POST);
	exit;
}
$edit = $profile->getGeneralDetails($userId);

$smarty->assign('edit', $edit);
$body = $smarty->fetch("profile_edit/general.html");
echo $body;
exit;
?>