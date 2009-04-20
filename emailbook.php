<?php
try {
	$mod = new mod_Emailbook($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('emailbook', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "emailbook Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);	
	
	$SIDEBAR = $Common->getMenu('emailbook');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	switch($_GET['action']) {
		case 'view':
			$body = $smarty->fetch('emailbook/view.html');
			break;
		case 'category':		
			try {
				// defining page heading and page title
				$PAGEHEADING = "Manage Category";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);	
				$table = "phonebook";
				$smarty->assign('table', $table);			
				include('category.php');
				$body = $smarty->fetch('emailbook/category.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);				
				$body = $smarty->fetch('emailbook/category.html');
			} 
			break;
		case 'new':
		default:
			$PAGEHEADING = "Add New Email";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			try {
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
				$body = $smarty->fetch('emailbook/new.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);				
				$body = $smarty->fetch('emailbook/new.html');
			} 
			break;
	}
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>