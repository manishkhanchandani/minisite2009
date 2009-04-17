<?php
try {
	$result = $Common->getConceptSettings('musicalbum', $ID);				
	$smarty->assign('result', $result);
	if(!$result['concepts']) {	
		unset($_GET['action']);
		throw new Exception("Music Album Concept does not exist for this id. ");
	}	
	$mod_Musicalbum = new mod_Musicalbum($dbFrameWork, $Common);				
	$smarty->assign('action', $_GET['action']);	
	$hosttype = 'Music';
	
	switch($_GET['action']) {
	
	}

} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>