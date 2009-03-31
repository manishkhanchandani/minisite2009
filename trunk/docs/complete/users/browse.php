<?php
try {
	$Profile = new Profile;
	
	// pagination status
	$page = $_GET['page']; if(!$page) $page = 1;
	$pageNum = $page-1;
	$max = 2;
	$start = $pageNum * $max;
	
	$record = $Profile->browse($action, $max, $start);
	$record['layout'] = "multiple"; // "single", "multiple"
	$totalRows = $record['totalRows'];
	if($totalRows>$max) {
		$divtag = "#east";
		$pagination = $Common->pagination($pageNum, $max, $totalRows, $divtag);
		$smarty->assign('pagination', $pagination);
	}
	$smarty->assign('record', $record);
	
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
	echo $body;
	exit;
} 
$body = $smarty->fetch("users/browse.html");
if($AJAX==1) {
	echo $body;
	exit;
}
?>