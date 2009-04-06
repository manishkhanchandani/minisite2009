<?php
try {
	// fetching concepts and settings
	$result = $Common->getConceptSettings('cricketscore', $ID);	
	$smarty->assign('result', $result);
	$keyword = $result['keyword'][0]['keyword'];
	
	if(!$result['concepts']) {	
		throw new Exception("Cricket Score Concept does not exist for this id. ");
	}
	// defining page heading and page title
	$PAGEHEADING = $result['keyword'][0]['keyword']." Cricket Score";
	$smarty->assign('PAGEHEADING', $PAGEHEADING);
	// if setting occurs then call news
	$mod_Cricketscore = new mod_Cricketscore($dbFrameWork, $Common);	
	$content = $mod_Cricketscore->displayScore($keyword);
	$smarty->assign('content', $content);
	// calling body
	$body = $smarty->fetch('content.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>