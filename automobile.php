<?php
try {
	$mod = new mod_Automobile($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('automobile', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "automobile Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);	
	
	$SIDEBAR = $Common->getMenu('automobile');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	switch($_GET['action']) {		
		case 'category':	
			try {
				// defining page heading and page title
				$PAGEHEADING = "Manage Category";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);	
				$table = "phonebook";
				$smarty->assign('table', $table);			
				include('category.php');
				$body = $smarty->fetch('notes/category.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);				
				$body = $smarty->fetch('automobile/category.html');
			} 
			break;
		default:
			$body = $smarty->fetch('automobile/sample.html');
			break;
	}
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>