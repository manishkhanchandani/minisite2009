<?php
switch($_GET['action']) {
	case 'register':		
		if($_SESSION['user_id']) {
			header("Location: users.php?p=users&action=loginalready");
			exit;
		}
		// defining page heading and page title
		$PAGEHEADING = "Register New User";		
		break;
	case 'forgot':
		// defining page heading and page title
		$PAGEHEADING = "Forgot Password";
		break;
	case 'change':
		// defining page heading and page title
		$PAGEHEADING = "Change Password";
		break;	
	case 'loginalready':
		// defining page heading and page title
		$PAGEHEADING = "Already Logged In";
		break;
	case 'login':
	default:		
		if($_SESSION['user_id']) {
			header("Location: users.php?p=users&action=loginalready");
			exit;
		}
		// defining page heading and page title
		$PAGEHEADING = "Login User";
		break;
}
// assigning action
$smarty->assign('action', $_GET['action']);
// calling body
$body = $smarty->fetch('users.html');
?>