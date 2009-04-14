<?php
try {
	$result = $Common->getConceptSettings('downtimealert', $ID);				
	$smarty->assign('result', $result);
	if(!$result['concepts']) {	
		unset($_GET['action']);
		throw new Exception("Downtimealert Concept does not exist for this id. ");
	}							
	if(!$_SESSION['user_id']) {
		throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
	}
	$mod_Downtimealert = new mod_Downtimealert($dbFrameWork, $Common);
	switch($_GET['action']) {
		case 'cron':
			$mod_Downtimealert->cronDowntime();
			exit;
			break;
		case 'detail':
			$detail = $mod_Downtimealert->getOneElement($_GET['downtime_id'], $_SESSION['user_id']);
			$smarty->assign('detail', $detail);
			if($detail) {
				$report = $mod_Downtimealert->getDowntimeResult($_GET['downtime_id'], $_GET['from'], $_GET['to']);
				$smarty->assign('report', $report);
			}
			$body = $smarty->fetch('downtimealert/detail.html');
			break;
		case 'edit':
			try {
				if($_POST['MM_Update']==1) {
					$mod_Downtimealert->validateNewDowntime($_POST);
					$_POST['datetocheck'] = time()+($_POST['checkfrequency']*60);
					$Common->phpedit('downtime', 'downtime_id', $_POST, $_POST['downtime_id']);
					$success = 1;
					$smarty->assign('success', $success); 
				}
				$edit = $mod_Downtimealert->getOneElement($_GET['downtime_id'], $_SESSION['user_id']);
				$smarty->assign('edit', $edit);
				$body = $smarty->fetch('downtimealert/edit.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('downtimealert/new.html');
			} 
			break;
		case 'new':
			try {
				if($_POST['MM_Insert']==1) {
					$mod_Downtimealert->validateNewDowntime($_POST);
					$_POST['datetocheck'] = time()+($_POST['checkfrequency']*60);
					$Common->phpinsert('downtime', 'downtime_id', $_POST);
					$success = 1;
					$smarty->assign('success', $success); 
				}
				$body = $smarty->fetch('downtimealert/new.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('downtimealert/new.html');
			} 
			break;
		case 'view':
		default:
			$sql = "select * from downtime where user_id = '".$_SESSION['user_id']."' and id = '".$ID."' order by url";
			$sqlCnt = "select count(*) as cnt from downtime where user_id = '".$_SESSION['user_id']."' and id = '".$ID."'";
			$max = 25;
			$page = $_GET['page'];
			if(!$page) $page = 1;
			$pageNum = $page-1;
			$start = $pageNum * $max;
			
			$records = $Common->selectCacheLimitRecordFull($sql, $sqlCnt, $max, $start);
			$smarty->assign('view', $records['record']);
			
			if($records['totalRows']>$max) {
				// pagination
				$PaginateIt = new PaginateIt();
				$PaginateIt->SetItemCount($records['totalRows']);
				$PaginateIt->SetItemsPerPage($max);
				$pagination = $PaginateIt->GetPageLinks_Old();
				$smarty->assign('pagination', $pagination);
			}
			
			$body = $smarty->fetch('downtimealert/view.html');
			break;
	}
	$mod_Downtimealert->cronDowntime();
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>