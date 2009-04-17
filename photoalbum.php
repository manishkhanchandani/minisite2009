<?php
try {
	$result = $Common->getConceptSettings('photoalbum', $ID);				
	$smarty->assign('result', $result);
	if(!$result['concepts']) {	
		unset($_GET['action']);
		throw new Exception("Photo Album Concept does not exist for this id. ");
	}	
	$mod_Photoalbum = new mod_Photoalbum($dbFrameWork, $Common);				
	$smarty->assign('action', $_GET['action']);	
	$hosttype = 'Image';
	
	switch($_GET['action']) {
		case 'managealbum':						
			if(!$_SESSION['user_id']) {
				throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
			}
			$PAGEHEADING = "Manage Albums";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			
			// insert new album
			if($_POST['MM_Insert']==1) {
				print_r($_POST);
			}
			// update album
			if($_POST['MM_Update']==1) {
				print_r($_POST);
			}
			// getting all albums
			$sql = "select * from albums where user_id = '".$_SESSION['user_id']."' and id = '".$ID."' order by album";
			$sqlCnt = "select count(*) as cnt from albums where user_id = '".$_SESSION['user_id']."' and id = '".$ID."'";
			$max = 25;
			$page = $_GET['page'];
			if(!$page) $page = 1;
			$pageNum = $page-1;
			$start = $pageNum * $max;
			
			$records = $Common->selectCacheLimitRecordFull($sql, $sqlCnt, $max, $start);
			$smarty->assign('view', $records['record']);
			
			$body = $smarty->fetch('photoalbum/managealbum.html');
			break;
		case 'new':						
			if(!$_SESSION['user_id']) {
				throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
			}
			$PAGEHEADING = "Add New Photos";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			
			
			$body = $smarty->fetch('photoalbum/new.html');
			break;
		case 'edit':						
			if(!$_SESSION['user_id']) {
				throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
			}
			$PAGEHEADING = "Edit Photo";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			
			
			$body = $smarty->fetch('photoalbum/edit.html');
			break;
		case 'delete':						
			if(!$_SESSION['user_id']) {
				throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
			}
			$PAGEHEADING = "Delete Photo";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			
			
			$body = $smarty->fetch('photoalbum/delete.html');
			break;
		case 'detail':
			$PAGEHEADING = "Details";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			
			
			$body = $smarty->fetch('photoalbum/detail.html');
			break;
		case 'view':
		default:
			$PAGEHEADING = "Photo Gallery";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			
			
			
			$body = $smarty->fetch('photoalbum/view.html');
			break;
	}
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>