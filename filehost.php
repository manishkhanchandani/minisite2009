<?php
try {
	$result = $Common->getConceptSettings('filehost', $ID);				
	$smarty->assign('result', $result);
	if(!$result['concepts']) {	
		unset($_GET['action']);
		throw new Exception("File Host Concept does not exist for this id. ");
	}
	$mod_Host = new mod_Host($dbFrameWork, $Common);				
	$smarty->assign('action', $_GET['action']);	
	$hosttype = 'File';
	
	switch($_GET['action']) {
		case 'newmulti':
			try {				
				// defining page heading and page title
				$PAGEHEADING = "Multiple File Upload";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				if($_POST['MM_Insert']==1 && $_SESSION['checksum']==$_POST['checksum']) {
					$user_id  = $_SESSION['user_id'];
					if(!$_SESSION['user_id']) $user_id = 0;
				
					require_once('HTTP/Upload.php');
					$upload = new HTTP_Upload("en");
					$files = $upload->getFiles();
					if($files) {
						$return = $mod_Host->uploadFile($files, $_POST, $user_id);
						$success = $return['success'];
						$filehostlinks = $return['filehostlinks'];
					}
				}
						
				if($success==1) {				
					$smarty->assign('success', $success);
					$smarty->assign('filehostlinks', $filehostlinks);
				}
				$_SESSION['checksum'] = md5(time());	
				
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('filehost/newmulti.html');
			} 				
			// calling body
			$body = $smarty->fetch('filehost/newmulti.html');
			break;
		case 'newdrag':
			try {			
				$_SESSION['ref'] = md5(time());		
				// defining page heading and page title
				$PAGEHEADING = "Drag N Drop Upload";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				$_SESSION['checksum'] = md5(time());				
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('filehost/newdrag.html');
			} 	
			// calling body
			$body = $smarty->fetch('filehost/newdrag.html');
			break;
		case 'newdragsubmit':
			try {					
				if($_POST) {
					$user_id  = $_SESSION['user_id'];
					if(!$_SESSION['user_id']) $user_id = 0;
				
					require_once('HTTP/Upload.php');
					$upload = new HTTP_Upload("en");
					$files = $upload->getFiles();
					if($files) {
						$return = $mod_Host->uploadFile($files, $_POST, $user_id);
						$success = $return['success'];
						$filehostlinks = $return['filehostlinks'];
					}
				}
						
				if($success==1) {				
					$smarty->assign('success', $success);
					$smarty->assign('filehostlinks', $filehostlinks);
				}	
				exit;			
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('filehost/newdrag.html');
			} 	
			break;
		case 'viewtmp':		
			try {		
				// defining page heading and page title
				$PAGEHEADING = "My Current Session Files";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				
				$sql = "select * from files where hosttype = 'File' and ref = '".$_SESSION['ref']."' order by file_id desc";
				$fileResult = $Common->selectCacheRecord($sql);
				$smarty->assign('fileResult', $fileResult);
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('filehost/viewtmp.html');
			} 
			$body = $smarty->fetch('filehost/viewtmp.html');
			break;
		case 'view':
			try {						
				if(!$_SESSION['user_id']) {
					throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
				}
				// defining page heading and page title
				$PAGEHEADING = "My Files";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				
				$sql = "select * from files where hosttype = 'File' and user_id = '".$_SESSION['user_id']."' order by file_id desc";
				$sqlCnt = "select count(*) as cnt from files where hosttype = 'File' and user_id = '".$_SESSION['user_id']."' order by file_id desc";
				$max = 5;
				$page = $_GET['page'];
				if(!$page) $page = 1;
				$pageNum = $page-1;
				$start = $pageNum * $max;
			
				$fileResult = $Common->selectCacheLimitRecordFull($sql, $sqlCnt, $max, $start);	
				if($fileResult['totalRows']>$max) {
					// pagination
					$PaginateIt = new PaginateIt();
					$PaginateIt->SetItemCount($fileResult['totalRows']);
					$PaginateIt->SetItemsPerPage($max);
					$pagination = $PaginateIt->GetPageLinks_Old();
					$smarty->assign('pagination', $pagination);
				}
			
				$smarty->assign('fileResult', $fileResult);
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('errorMessage.html');
			} 
			$body = $smarty->fetch('filehost/view.html');
			break;
		case 'new':
		default:
			try {				
				// defining page heading and page title
				$PAGEHEADING = "File Upload";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				if($_POST['MM_Insert']==1 && $_SESSION['checksum']==$_POST['checksum']) {
					$user_id  = $_SESSION['user_id'];
					if(!$_SESSION['user_id']) $user_id = 0;
				
					require_once('HTTP/Upload.php');
					$upload = new HTTP_Upload("en");
					$files = $upload->getFiles();
					if($files) {
						$return = $mod_Host->uploadFile($files, $_POST, $user_id);
						$success = $return['success'];
						$filehostlinks = $return['filehostlinks'];
					}
				}
						
				if($success==1) {				
					$smarty->assign('success', $success);
					$smarty->assign('filehostlinks', $filehostlinks);
				}
				$_SESSION['checksum'] = md5(time());	
				
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('filehost/new.html');
			} 				
			// calling body
			$body = $smarty->fetch('filehost/new.html');
			break;
	}
				
	
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 