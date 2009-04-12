<?php
try {
	$result = $Common->getConceptSettings('auction4cause', $ID);				
	$smarty->assign('result', $result);
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$mod_Auction4cause = new mod_Auction4cause($dbFrameWork, $Common);	
		
	$max = 10;
	$page = $_GET['page'];
	if(!$page) $page = 1;	
	$smarty->assign('page', $page);
	$pageNum = $page-1;
	$start = $pageNum * $max;
				
	$records = $mod_Auction4cause->getListing($ID, $conceptId, $max, $page);
	$smarty->assign('records', $records);
	if($records['totalRows']>$max) {
		// pagination
		$PaginateIt = new PaginateIt();
		$PaginateIt->SetItemCount($records['totalRows']);
		$PaginateIt->SetItemsPerPage($max);
		$pagination = $PaginateIt->GetPageLinks_Old();
		$smarty->assign('pagination', $pagination);
	}
	
	$body = $smarty->fetch('auction4cause/index.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('auction4cause/index.html');
} 
?>