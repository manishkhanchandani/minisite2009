<?php
try {							
	if(!$_SESSION['user_id']) {
		throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
	}
	$mod = new mod_Addressbook($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('addressbook', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "addressbook Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);	
	
	$SIDEBAR = $Common->getMenu('addressbook');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	switch($_GET['action']) {
		case 'view':
			$body = $smarty->fetch('addressbook/view.html');
			break;
		case 'category':
			try {
				// defining page heading and page title
				$PAGEHEADING = "Manage Category";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);	
				$table = "phonebook";
				$smarty->assign('table', $table);			
				include('category.php');
				$body = $smarty->fetch('addressbook/category.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);				
				$body = $smarty->fetch('addressbook/category.html');
			} 
			break;
		case 'new':
		default:
			$PAGEHEADING = "Add New Address";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			try {
				$country = $Common->getCountrySelBoxName($_POST['country']);
				$smarty->assign('country', $country);
				$Category = new Category($dbFrameWork, $Common);	
				$Category->treeSelectBox($ID, 0, $conceptId, $_SESSION['user_id']);
				$category_ids = $Category->treeSelectBox;
				$smarty->assign('category_ids', $category_ids);
				if($_POST['MM_Insert']==1) {
					$post = $_POST;
					$validate = array(array('field'=>'name', 'type'=>'isreq', 'error'=>'Please fill the name.'));
					$Common->validate($post, $validate);
					$Common->phpinsert('phonebook', 'book_id', $post);
					$success = 1;
					$smarty->assign('success', $success);
				}				
				$body = $smarty->fetch('addressbook/new.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);				
				$body = $smarty->fetch('addressbook/new.html');
			} 
			break;
	}
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>