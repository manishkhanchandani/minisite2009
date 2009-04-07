<?php
try {
	$SMS = new mod_Smsreminder($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('smsreminder', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "Smsreminder Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	// user access
	if(!$_SESSION['user_id']) {
		throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
	}
	// assigning action
	$smarty->assign('action', $_GET['action']);
	switch($_GET['action']) {
		case 'cron':
			try {	
				$result = $SMS->cronSMS();
				$message = 'SMS sent successfully.';
				$PAGEHEADING= "Cron Confirmation";
				$smarty->assign('PAGEHEADING',$PAGEHEADING);
				$smarty->assign('content',$message);
				$body = $smarty->fetch('content.html');
			} catch(Exception $e) {
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('errorMessage.html');
			}
			break;
		case 'new':
			try {	
				$PAGEHEADING= "Create New SMS Reminder";
				$smarty->assign('PAGEHEADING',$PAGEHEADING);
				if($_POST['MM_Insert']==1) {
					$SMS->validateForm($_POST);
					$_POST['user_id'] = $_SESSION['user_id'];
					$time1 = strtotime($_POST['smsdatetime']);
					$time2 = explode(":", $_POST['smstime']);
					$time3 = mktime($time2[0], $time2[1], 0, date('m', $time1), date('d', $time1), date('Y', $time1));
					$_POST['senddate'] = $time3;
					$_POST['smsdatetime'] = date('Y-m-d H:i:s', $time3);
					$Common->phpinsert("smsreminders", "id", $_POST);
					$errorMessage = 'SMS Created Successfully. SMS will be sent as per your details. ';
					$success = 1;
					$smarty->assign('success',$success);
					$smarty->assign('errorMessage',$errorMessage);
				}				
				$body = $smarty->fetch('smsreminder/new.html');
			} catch(Exception $e) {
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('smsreminder/new.html');
			}
			break;
		case 'viewinactive':
			try {			
				$PAGEHEADING= "View My Inactive Reminder";
				$smarty->assign('PAGEHEADING',$PAGEHEADING);		
				if($_GET['delId']) {
					// delete the record
					$Common->deleteRecord('smsreminders', 'rid', $_GET['delId']);
					$errorMessage = "Record Deleted Successfully";
					$smarty->assign('errorMessage', $errorMessage);
				}
				if($_GET['page']) $pageNum = $_GET['page']-1;
				if(!$pageNum) $pageNum = 0;
				$maxRows = 5;
				$startRow = $pageNum * $maxRows;
				$smarty->assign('maxRows', $maxRows);
				$smarty->assign('pageNum', $pageNum);
				$smarty->assign('page', ($pageNum+1));
				$sql = "select * from smsreminders WHERE user_id = '".$_SESSION['user_id']."' and status = 1 AND smsdatetime < '".date('Y-m-d H:i:s')."' and id = '".$ID."' ORDER BY smsdatetime DESC";
				$sqlCnt = "select count(*) as cnt from smsreminders WHERE user_id = '".$_SESSION['user_id']."' and status = 1 and smsdatetime < '".date('Y-m-d H:i:s')."' and id = '".$ID."'";
				$records = $Common->selectCacheLimitRecordFull($sql, $sqlCnt, $maxRows, $startRow);
				$smarty->assign('records', $records);
				$totalRows = $records['totalRows'];
				$totalPages = ceil($totalRows/$maxRows)-1;
				
				if($totalRows>$maxRows) {
					// pagination
					$PaginateIt = new PaginateIt();
					$PaginateIt->SetItemCount($totalRows);
					$PaginateIt->SetItemsPerPage($maxRows);
					$pagination = $PaginateIt->GetPageLinks_Old();
					$smarty->assign('pagination', $pagination);
				}							
				$body = $smarty->fetch('smsreminder/view.html');
			} catch(Exception $e) {
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('smsreminder/view.html');
			}
			break;
		case 'view':
		default:
			try {			
				$PAGEHEADING= "View My Active SMS Reminder";
				$smarty->assign('PAGEHEADING',$PAGEHEADING);		
				if($_GET['delId']) {
					// delete the record
					$Common->deleteRecord('smsreminders', 'rid', $_GET['delId']);
					$errorMessage = "Record Deleted Successfully";
					$smarty->assign('errorMessage', $errorMessage);
				}
				if($_GET['page']) $pageNum = $_GET['page']-1;
				if(!$pageNum) $pageNum = 0;
				$maxRows = 5;
				$startRow = $pageNum * $maxRows;
				$smarty->assign('maxRows', $maxRows);
				$smarty->assign('pageNum', $pageNum);
				$smarty->assign('page', ($pageNum+1));
				$sql = "select * from smsreminders WHERE user_id = '".$_SESSION['user_id']."' and status = 1 AND smsdatetime >= '".date('Y-m-d H:i:s')."' and id = '".$ID."' ORDER BY smsdatetime ASC";
				$sqlCnt = "select count(*) as cnt from smsreminders WHERE user_id = '".$_SESSION['user_id']."' and status = 1 and smsdatetime >= '".date('Y-m-d H:i:s')."' and id = '".$ID."'";
				$records = $Common->selectCacheLimitRecordFull($sql, $sqlCnt, $maxRows, $startRow);
				$smarty->assign('records', $records);
				$totalRows = $records['totalRows'];
				$totalPages = ceil($totalRows/$maxRows)-1;
				
				if($totalRows>$maxRows) {
					// pagination
					$PaginateIt = new PaginateIt();
					$PaginateIt->SetItemCount($totalRows);
					$PaginateIt->SetItemsPerPage($maxRows);
					$pagination = $PaginateIt->GetPageLinks_Old();
					$smarty->assign('pagination', $pagination);
				}							
				$body = $smarty->fetch('smsreminder/view.html');
			} catch(Exception $e) {
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('smsreminder/view.html');
			}
			break;
	}
	
	// send cron for now on each individual page, later on put it in cron jobs.
	$SMS->cronSMS();
} catch(Exception $e) {
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
}
?>