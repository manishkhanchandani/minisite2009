<?php
try {
	$mod = new mod_Messages($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('messages', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "messages Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);				
	$smarty->assign('action', $_GET['action']);	
	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);
	
	$SIDEBAR = $Common->getMenu('messages');
	$smarty->assign('SIDEBAR', $SIDEBAR);
		
	
	switch($_GET['action']) {
	
	}
	
	$body = $smarty->fetch('messages/sample.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>