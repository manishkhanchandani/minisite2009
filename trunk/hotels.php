<?php
try {
	$mod = new mod_Hotels($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('hotels', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "hotels Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);
	
	$SIDEBAR = $Common->getMenu('hotels');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	$body = $smarty->fetch('hotels/sample.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>