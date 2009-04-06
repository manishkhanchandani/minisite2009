<?php
try {
	$EMAIL = new mod_Emailreminder($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('emailreminder', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "Emailreminder Concept does not exist for this id. ";
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
				$result = $EMAIL->cronEMAIL();
				$message = 'Email sent successfully.';
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
				$PAGEHEADING= "Create New Email Reminder";
				$smarty->assign('PAGEHEADING',$PAGEHEADING);
				if($_POST['MM_Insert']==1) {
					$EMAIL->validateForm($_POST);
					$_POST['user_id'] = $_SESSION['user_id'];
					$time1 = strtotime($_POST['emaildatetime']);
					$time2 = explode(":", $_POST['emailtime']);
					$time3 = mktime($time2[0], $time2[1], 0, date('m', $time1), date('d', $time1), date('Y', $time1));
					$_POST['senddate'] = $time3;
					$_POST['emaildatetime'] = date('Y-m-d H:i:s', $time3);
					$Common->phpinsert("emailreminders", "id", $_POST);
					$errorMessage = 'Email Reminder Created Successfully. Email will be sent as per your details. ';
					$success = 1;
					$smarty->assign('success',$success);
					$smarty->assign('errorMessage',$errorMessage);
				}				
				$body = $smarty->fetch('emailreminder/new.html');
			} catch(Exception $e) {
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('emailreminder/new.html');
			}
			break;
		case 'viewinactive':
			try {			
				$PAGEHEADING= "View My Inactive Reminders";
				$smarty->assign('PAGEHEADING',$PAGEHEADING);		
				if($_GET['delId']) {
					// delete the record
					$Common->deleteRecord('emailreminders', 'rid', $_GET['delId']);
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
				$sql = "select * from emailreminders WHERE user_id = '".$_SESSION['user_id']."' and status = 1 AND emaildatetime < '".date('Y-m-d H:i:s')."' ORDER BY emaildatetime DESC";
				$sqlCnt = "select count(*) as cnt from emailreminders WHERE user_id = '".$_SESSION['user_id']."' and status = 1 and emaildatetime < '".date('Y-m-d H:i:s')."'";
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
				$body = $smarty->fetch('emailreminder/view.html');
			} catch(Exception $e) {
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('emailreminder/view.html');
			}
			break;
			
		case 'view':
		default:
			try {	
				$PAGEHEADING= "View My Active Email Reminders";
				$smarty->assign('PAGEHEADING',$PAGEHEADING);				
				if($_GET['delId']) {
					// delete the record
					$Common->deleteRecord('emailreminders', 'rid', $_GET['delId']);
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
				$sql = "select * from emailreminders WHERE user_id = '".$_SESSION['user_id']."' and status = 1 AND emaildatetime >= '".date('Y-m-d H:i:s')."' ORDER BY emaildatetime ASC";
				$sqlCnt = "select count(*) as cnt from emailreminders WHERE user_id = '".$_SESSION['user_id']."' and status = 1 and emaildatetime >= '".date('Y-m-d H:i:s')."'";
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
				$body = $smarty->fetch('emailreminder/view.html');
			} catch(Exception $e) {
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('emailreminder/view.html');
			}
			break;
	}
	
	// send cron for now on each individual page, later on put it in cron jobs.
	$EMAIL->cronEMAIL();
} catch(Exception $e) {
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
}
?>