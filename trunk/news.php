<?php
try {
	// defining page heading and page title
	$PAGEHEADING = $result['keyword'][0]['keyword']." News";
	$smarty->assign('PAGEHEADING', $PAGEHEADING);
	// fetching concepts and settings
	$result = $Common->getConceptSettings('news', $ID);			
	$smarty->assign('result', $result);
	// if setting occurs then call news
	$news = '';
	if($result['settings']) {
		// initializing news class
		$mod_News = new mod_News($dbFrameWork, $Common);
		// fetching each news result
		$news = $mod_News->getNewsString($result);
	}		
	// assigning
	$smarty->assign('content', $news);
	
	// calling body
	$body = $smarty->fetch('home.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>