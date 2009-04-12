<?php
try {
	$result = $Common->getConceptSettings('auction4cause', $ID);				
	$smarty->assign('result', $result);
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$mod_Auction4cause = new mod_Auction4cause($dbFrameWork, $Common);	
	
	$productId = $_GET['product_id'];
	$smarty->assign('productId', $productId);
	$smarty->assign('page', $_GET['page']);
	if(!$productId) {
		throw new Exception("Product Not Found.");
	}
	$records = $mod_Auction4cause->getDetail($ID, $conceptId, $productId);
	$smarty->assign('records', $records);	
	$body = $smarty->fetch('auction4cause/detail.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('auction4cause/detail.html');
} 
?>