<?php
try {
	$mod = new mod_Deathreminder($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('deathreminder', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "deathreminder Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);	
	
	$SIDEBAR = $Common->getMenu('deathreminder');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	$body = $smarty->fetch('deathreminder/sample.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>