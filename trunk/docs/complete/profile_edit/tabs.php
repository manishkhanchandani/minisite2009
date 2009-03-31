<?php
if($_COOKIE['user_id']) {
	$userId = $_COOKIE['user_id'];
	$doCache = 0;
} else {
	$body = $smarty->fetch("restrict.html");
	echo $body;
	exit;
}
// getting details for general page
$profile = new Profile;

// get details for selected users
$edit = $profile->getGeneralDetails($userId, $doCache);

if($_GET['action']=="remove") {
	$profile->deletePreviousImage($edit['profile2'][0]['image']);
	$_POST['image'] = "";
	$profile->updateGeneralProfile($_POST, $userId);
	echo "Image deleted successfully.";
	exit;
}
if($_POST['MM_Insert']) {
	//print_r($_POST);
	//exit;
	try {
		if($_FILES) {
			$firstletter = substr($_COOKIE['email'], 0, 1);
			$dest = "assets/profileimages/".$firstletter."/".$_COOKIE['user_id']."_".$_FILES['image']['name'];
			$Image = new Image;
			$format = $Image->getExtension($_FILES['image']['name']);
			$thumbnail = $Image->buildThumbnail($_FILES['image']['tmp_name'], 100, 100, $format, $dest);
			if($thumbnail) { // deleting old image if exists
				$profile->deletePreviousImage($edit['profile2'][0]['image']);
			}
			$_POST['image'] = $dest;
		}
		$profile->updateGeneralProfile($_POST, $userId);
		echo "Your details updated successfully.";
	} catch (exception $e) { 
		$errorMessage = $e->getMessage();
		echo $errorMessage;
	} 
	exit;
}

// create profile for the current user if not already done before.
if(!$edit['profile1']) {
	$profile->createProfile1($userId);
	$profile->createProfile2($userId);
}

// get countrys list

$countryId = $edit['country'][0]['country_id'];
$smarty->assign('country_options', $edit['countrys']);
$smarty->assign('countryId', $countryId);

// birthdate time
if($edit['profile1'][0]['bYear']) $bYear = $edit['profile1'][0]['bYear']; else $bYear = date('Y');
if($edit['profile1'][0]['bMonth']) $bMonth = $edit['profile1'][0]['bMonth']; else $bMonth = date('m');
if($edit['profile1'][0]['bDay']) $bDay = $edit['profile1'][0]['bDay']; else $bDay = date('d');
$bdate = $bYear."-".$bMonth."-".$bDay;
$smarty->assign('bdate', $bdate);

// assign value to edit variable
$smarty->assign('edit', $edit);

$body = $smarty->fetch("profile_edit/tabs_one.html");
if($AJAX==1) {
	echo $body;
	exit;
}
?>