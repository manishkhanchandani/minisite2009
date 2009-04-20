<?php
try {
	$mod = new mod_Reviews($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('reviews', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "reviews Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 	
	$smarty->assign('result', $result);		
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);
	
	$SIDEBAR = $Common->getMenu('reviews');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	$body = $smarty->fetch('reviews/sample.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>