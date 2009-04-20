<?php
try {
	$mod = new mod_Emailsmsreminder($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('emailsmsreminder', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "emailsmsreminder Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);				
	$smarty->assign('action', $_GET['action']);	
	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);		
	
	$SIDEBAR = $Common->getMenu('emailsmsreminder');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	
	switch($_GET['action']) {
	
	}
	
	$body = $smarty->fetch('emailsmsreminder/sample.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>