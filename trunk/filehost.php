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
			$_SESSION['checksum'] = md5(time());	
			// defining page heading and page title
			$PAGEHEADING = "Multiple File Upload";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			break;
		case 'newdrag':
			$_SESSION['checksum'] = md5(time());	
			// defining page heading and page title
			$PAGEHEADING = "Drag N Drop Upload";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			break;
		case 'view':
			// defining page heading and page title
			$PAGEHEADING = "My Files";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
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