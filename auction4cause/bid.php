<?php
try {
	if(!$_SESSION['user_id']) {
		throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
	}
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
	$charity = $mod_Auction4cause->isCharity($ID, $conceptId);
	if($charity) {
		$smarty->assign('charity', $charity);
		$charitySelBox = $mod_Auction4cause->charitySelBox($ID, $conceptId);
		$smarty->assign('charitySelBox', $charitySelBox);		
	}
	
	if($_POST['MM_Insert']=="bid") {
		if(!$_POST['bid']) {
			$errorMessage = "Bid amount is not valid.";
			$smarty->assign('errorMessage', $errorMessage);
			$body = $smarty->fetch('auction4cause/detail.html');		
		} else if($_POST['bid']=="xx.xx") {
			$errorMessage = "Bid amount is not valid.";
			$smarty->assign('errorMessage', $errorMessage);
			$body = $smarty->fetch('auction4cause/detail.html');
		} else if($_POST['bid']>$records['maxbidprice']) {
			$errorMessage = "Bid amount is greater than maximum bid price.";
			$smarty->assign('errorMessage', $errorMessage);
			$body = $smarty->fetch('auction4cause/detail.html');
		} else {
			// send user to paypal
			$uid = $mod_Auction4cause->submitBid($_POST, $ID, $conceptId, $_POST['product_id'], $records);
			// post data to paypal
			header("Location: ".HTTPPATH."/index.php?ID=".$ID."&p=auction4cause/bidconfirm&product_id=".$_POST['product_id']."&bid_id=".$uid);
			exit;
		}
	} else {
		$body = $smarty->fetch('auction4cause/bid.html');
	}
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>