<?php
try {
	$mod = new mod_Dating($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('dating', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "dating Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);	
	
	$SIDEBAR = $Common->getMenu('dating');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	$body = $smarty->fetch('dating/sample.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>