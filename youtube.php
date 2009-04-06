<?php
try {
	// fetching concepts and settings
	$result = $Common->getConceptSettings('youtube', $ID);	
	$smarty->assign('result', $result);
	$keyword = $result['keyword'][0]['keyword'];
	// creating reference
	$reference = array();
	if($result['settings']) {
		foreach($result['settings'] as $setting) {
			$reference[$setting['reference']] = 1;
		}
	}
	
	if(!$result['concepts']) {	
		throw new Exception("Youtube Video Concept does not exist for this id. ");
	}
	// defining page heading and page title
	$PAGEHEADING = $result['keyword'][0]['keyword']." Videos";
	$smarty->assign('PAGEHEADING', $PAGEHEADING);
	// if setting occurs then call news
	$mod_Youtube = new mod_Youtube($dbFrameWork, $Common);	
	$video = $mod_Youtube->displayVideo($keyword, $reference);
	$smarty->assign('content', $video);
	// calling body
	$body = $smarty->fetch('content.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>