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
			try {					
				if(!$_SESSION['user_id']) {
					throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
				}
				$PAGEHEADING = "Manage Albums";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				
				// insert new album
				if($_POST['MM_Insert']==1) {
					$post = $_POST;
					$mod_Photoalbum->validate($post);
					$post['public'] = ($_POST['public'])?1:0;
					$post['user_id'] = $_SESSION['user_id'];
					$post['file_type'] = $hosttype;
					$Common->phpinsert('albums', 'album_id', $post);
				}
				// update album
				if($_POST['MM_Update']==1) {
					$post = $_POST;
					$post['public'] = ($_POST['public'])?1:0;
					$post['user_id'] = $_SESSION['user_id'];
					$post['file_type'] = $hosttype;
					$Common->phpedit('albums', 'album_id', $post, $_GET['album_id']);
					header("Location: ".HTTPPATH."/index.php?ID=".$ID."&p=photoalbum&action=managealbum&page=".$_GET['page']);
					exit;
				}
				// delete album
				if($_GET['did']) {
					$mod_Photoalbum->deleteAlbum($_GET['did'], $_SESSION['user_id'], $hosttype);	
					header("Location: ".HTTPPATH."/index.php?ID=".$ID."&p=photoalbum&action=managealbum&page=".$_GET['page']);
					exit;			
				}
				// if edit is called
				if($_GET['album_id']) {				
					$edit = $mod_Photoalbum->getOneElement($_GET['album_id'], $_SESSION['user_id']);
					$smarty->assign('edit', $edit);
				} 
				// getting all albums				
				$max = 25;
				$page = $_GET['page'];
				if(!$page) $page = 1;
				$pageNum = $page-1;
				$start = $pageNum * $max;
			
				$records = $mod_Photoalbum->getAllAlbum($hosttype, $_SESSION['user_id'], $max, $start);
				if(!$records['record'] && $page>1) {
					header("Location: ".HTTPPATH."/index.php?ID=".$ID."&p=photoalbum&action=managealbum&page=".($page-1));
					exit;	
				}
				$smarty->assign('view', $records['record']);
				
				if($records['totalRows']>$max) {
					// pagination
					$PaginateIt = new PaginateIt();
					$PaginateIt->SetItemCount($records['totalRows']);
					$PaginateIt->SetItemsPerPage($max);
					$pagination = $PaginateIt->GetPageLinks_Old();
					$smarty->assign('pagination', $pagination);
				}				
				$body = $smarty->fetch('photoalbum/managealbum.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('photoalbum/managealbum.html');
			} 
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