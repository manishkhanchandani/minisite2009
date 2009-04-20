<?php
try {
	$mod = new mod_Videoalbum($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('videoalbum', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "videoalbum Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);				
	$smarty->assign('action', $_GET['action']);	
	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];	
	$smarty->assign('conceptId', $conceptId);
	
	$SIDEBAR = $Common->getMenu('videoalbum');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	
	switch($_GET['action']) {
		case 'category':		
			try {
				// defining page heading and page title
				$PAGEHEADING = "Manage Category";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);	
				$table = "";
				$smarty->assign('table', $table);			
				include('category.php');
				$body = $smarty->fetch('videoalbum/category.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);				
				$body = $smarty->fetch('videoalbum/category.html');
			} 
			break;
	
	}
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>