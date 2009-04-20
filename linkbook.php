<?php
try {
	$mod = new mod_Linkbook($dbFrameWork, $Common);	
	$result = $Common->getConceptSettings('linkbook', $ID);
	if(!$result['concepts']) {	
		$errorMessage = "linkbook Concept does not exist for this id. ";
		throw new Exception($errorMessage);
	} 
	$smarty->assign('result', $result);	
	$conceptId = $result['conceptId'];
	$conceptValue = $result['conceptValue'];
	$smarty->assign('conceptId', $conceptId);
	
	$SIDEBAR = $Common->getMenu('linkbook');
	$smarty->assign('SIDEBAR', $SIDEBAR);
	
	switch($_GET['action']) {
		case 'view':
			$body = $smarty->fetch('linkbook/view.html');
			break;
		case 'category':		
			try {
				// defining page heading and page title
				$PAGEHEADING = "Manage Category";
				$smarty->assign('PAGEHEADING', $PAGEHEADING);	
				$table = "phonebook";
				$smarty->assign('table', $table);			
				include('category.php');
				$body = $smarty->fetch('linkbook/category.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);				
				$body = $smarty->fetch('linkbook/category.html');
			} 
			break;
		case 'new':
		default:
			$PAGEHEADING = "Add New Link";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			try {
				$Category = new Category($dbFrameWork, $Common);	
				$Category->treeSelectBox($ID, 0, $conceptId, $_SESSION['user_id']);
				$category_ids = $Category->treeSelectBox;
				$smarty->assign('category_ids', $category_ids);
				if($_POST['MM_Insert']==1) {
					$post = $_POST;
					$post['public'] = ($_POST['public'])?1:0;
					$validate = array(array('field'=>'name', 'type'=>'isreq', 'error'=>'Please fill the name.'));
					$Common->validate($post, $validate);
					$Common->phpinsert('phonebook', 'book_id', $post);
					$success = 1;
					$smarty->assign('success', $success);
				}				
				$body = $smarty->fetch('linkbook/new.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);				
				$body = $smarty->fetch('linkbook/new.html');
			} 
			break;
	}
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>