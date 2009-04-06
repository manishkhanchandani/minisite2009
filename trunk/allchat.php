<?php
try {
	// fetching concepts and settings
	$result = $Common->getConceptSettings('allchat', $ID);	
	$smarty->assign('result', $result);
	$keyword = $result['keyword'][0]['keyword'];
	
	if(!$result['concepts']) {	
		throw new Exception("All in One Talk Concept does not exist for this id. ");
	}
	// defining page heading and page title
	$PAGEHEADING = $result['keyword'][0]['keyword']." All in One Talk";
	$smarty->assign('PAGEHEADING', $PAGEHEADING);
	// if setting occurs then call news
	$mod_Allchat = new mod_Allchat($dbFrameWork, $Common);	
	$content = $mod_Allchat->displayChat($keyword);
	$smarty->assign('content', $content);
	// calling body
	$body = $smarty->fetch('content.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>