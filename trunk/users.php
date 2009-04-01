<?php
// assigning action
$smarty->assign('action', $_GET['action']);
switch($_GET['action']) {
	case 'register':
		try {		
			//if($_SESSION['user_id']) {
				//header("Location: index.php?p=users&action=loginalready");
				//exit;
			//}
			
			$users = new mod_Users($dbFrameWork, $Common);
			if($_POST['MM_insert']==1) {
				// validate fields
				$users->validateRegister($_POST);
				// check if email already exists
				$users->checkUsername($_POST);
				// insert into users table
				$users->register($_POST);
				$errorMessage = "You are successfully registerd on our site.";
				$smarty->assign('errorMessage', $errorMessage);
				$success = 1;
				$smarty->assign('success', $success);
			}
			
			$code = md5(rand(1000, 9999));
			$smarty->assign('code', $code);
			
			// defining page heading and page title
			$PAGEHEADING = "Register New User";
			// calling body
			$body = $smarty->fetch('users/register.html');
		} catch (exception $e) { 
			$errorMessage = $e->getMessage();
			$smarty->assign('errorMessage', $errorMessage);
			$body = $smarty->fetch('users/register.html');
		} 
		break;
	case 'forgot':
		// defining page heading and page title
		$PAGEHEADING = "Forgot Password";
		// calling body
		$body = $smarty->fetch('users/forgot.html');
		break;
	case 'change':
		// defining page heading and page title
		$PAGEHEADING = "Change Password";
		// calling body
		$body = $smarty->fetch('users/change.html');
		break;	
	case 'loginalready':
		// defining page heading and page title
		$PAGEHEADING = "Already Logged In";
		// calling body
		$body = $smarty->fetch('users/loginalready.html');
		break;
	case 'login':
	default:		
		if($_SESSION['user_id']) {
			header("Location: users.php?p=users&action=loginalready");
			exit;
		}
		// defining page heading and page title
		$PAGEHEADING = "Login User";
		// calling body
		$body = $smarty->fetch('users/login.html');
		break;
}
?>