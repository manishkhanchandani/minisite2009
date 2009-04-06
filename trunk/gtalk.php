<?php
try {
	// fetching concepts and settings
	$result = $Common->getConceptSettings('gtalk', $ID);	
	$smarty->assign('result', $result);
	$keyword = $result['keyword'][0]['keyword'];
	
	if(!$result['concepts']) {	
		throw new Exception("Gtalk Concept does not exist for this id. ");
	}
	// defining page heading and page title
	$PAGEHEADING = $result['keyword'][0]['keyword']." Gtalk";
	$smarty->assign('PAGEHEADING', $PAGEHEADING);
	// if setting occurs then call news
	$mod_Gtalk = new mod_Gtalk($dbFrameWork, $Common);	
	$content = $mod_Gtalk->displayChat($keyword);
	$smarty->assign('content', $content);
	// calling body
	$body = $smarty->fetch('content.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>