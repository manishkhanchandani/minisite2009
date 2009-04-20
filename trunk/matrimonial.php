<?php
try {
	$mod = new mod_Matrimonial($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('matrimonial', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "matrimonial Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);
	
	$SIDEBAR = $Common->getMenu('matrimonial');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	$body = $smarty->fetch('matrimonial/sample.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>