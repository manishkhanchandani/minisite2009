<?php
$catId = $_GET['catId'];
$Category = new newCategory($dbFrameWork, $Common);	
if($_GET['delete']==1) {
	$Category->deleteCat($_GET['did'], $_GET['t']);
}
if($_POST['MM_Insert']==1) {
	if(!trim($_POST['category'])) {
		$errorMessage = "Could not add category. Please fill the category field.";
		$smarty->assign('errorMessage', $errorMessage);	
	} else {
		$Common->phpinsert('ccategory', 'category_id', $_POST);
	}
}
if($_GET['editId']) {
	$sql = "select * from ccategory WHERE category_id = '".$_GET['editId']."' and id = '".$ID."' and concept_id = '".$conceptId."' and user_id = '".$_SESSION['user_id']."'";
	$edit = $Common->selectRecord($sql);
	$smarty->assign('edit', $edit[0]);
}
if($_POST['MM_Update']==1) {
	if(!trim($_POST['category'])) {
		$editErrorMessage = "Could not edit category. Please fill the category field.";
		$smarty->assign('editErrorMessage', $editErrorMessage);	
	} else {
		$Common->phpedit('ccategory', 'category_id', $_POST, $_POST['category_id']);
		header("Location: index.php?p=".$_GET['p']."&action=".$_GET['action']."&ID=".$ID."&catId=".$catId);
		exit;
	}
}
if(!$catId) $catId = 0;			
$smarty->assign('catId', $catId);
$breadCrumb = $Category->categoryParentLink($ID, $catId, $conceptId, $_SESSION['user_id']);
$smarty->assign('breadCrumb', $Category->catLinkDisplay);
$sql = "select * from ccategory WHERE category_id = '".$catId."' and id = '".$ID."' and concept_id = '".$conceptId."' and user_id = '".$_SESSION['user_id']."'";
$current = $Common->selectRecord($sql);
$smarty->assign('current', $current[0]);
$sql = "select * from ccategory WHERE parent_id = '".$catId."' and id = '".$ID."' and concept_id = '".$conceptId."' and user_id = '".$_SESSION['user_id']."'";
$records = $Common->selectRecord($sql);
$smarty->assign('records', $records);	
?>