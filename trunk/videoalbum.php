<?php
try {
	$result = $Common->getConceptSettings('videoalbum', $ID);				
	$smarty->assign('result', $result);
	if(!$result['concepts']) {	
		unset($_GET['action']);
		throw new Exception("Videoalbum Concept does not exist for this id. ");
	}	
	$mod_Videoalbum = new mod_Videoalbum($dbFrameWork, $Common);				
	$smarty->assign('action', $_GET['action']);	
	$hosttype = 'Video';
	
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>