<?php
try {
	$mod = new mod_Profile($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('profile', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "profile Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);
	
	$SIDEBAR = $Common->getMenu('profile');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	$body = $smarty->fetch('profile/sample.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>