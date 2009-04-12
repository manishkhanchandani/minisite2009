<?php
try {
	$result = $Common->getConceptSettings('auction4cause', $ID);				
	$smarty->assign('result', $result);
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$mod_Auction4cause = new mod_Auction4cause($dbFrameWork, $Common);	
	$records = $mod_Auction4cause->getCharity($ID, $conceptId);
	$smarty->assign('records', $records);
	$body = $smarty->fetch('auction4cause/charity.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>