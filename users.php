<?php
// assigning action
$smarty->assign('action', $_GET['action']);
switch($_GET['action']) {
	case 'register':
		try {		
			if($_SESSION['user_id']) {
				header("Location: index.php?p=users&action=loginalready&ID=".$ID);
				exit;
			}
			
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
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			// calling body
			$body = $smarty->fetch('users/register.html');
		} catch (exception $e) { 
			$errorMessage = $e->getMessage();
			$smarty->assign('errorMessage', $errorMessage);
			$body = $smarty->fetch('users/register.html');
		} 
		break;
	case logout:
		// *** Logout the current user.
		$logoutGoTo = HTTPPATH."/index.php?p=users&action=login&ID=".$ID;
		$_SESSION['MM_Username'] = NULL;
		$_SESSION['MM_UserGroup'] = NULL;
		$_SESSION['user_id'] = NULL;
		$_SESSION['name'] = NULL;
		unset($_SESSION['MM_Username']);
		unset($_SESSION['MM_UserGroup']);
		unset($_SESSION['user_id']);
		unset($_SESSION['name']);
		header("Location: $logoutGoTo");
		exit;
		break;
	case 'forgot':
		try {		
			$users = new mod_Users($dbFrameWork, $Common);
			if($_POST['MM_insert']==1) {
				// validate fields
				$users->validate_email($_POST['email']);
				// check if email already exists
				$users->send_forgot_password($_POST['email']);
				$errorMessage = "Password send to your email address.";
				$smarty->assign('errorMessage', $errorMessage);
				$success = 1;
				$smarty->assign('success', $success);
			}			
			// defining page heading and page title
			$PAGEHEADING = "Forgot Password";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			// calling body
			$body = $smarty->fetch('users/forgot.html');
		} catch (exception $e) { 
			$errorMessage = $e->getMessage();
			$smarty->assign('errorMessage', $errorMessage);
			$body = $smarty->fetch('users/forgot.html');
		} 
		break;
	case 'change':
		try {		
			$users = new mod_Users($dbFrameWork, $Common);
			if($_POST['MM_insert']==1) {
				// validate fields
				$users->validate_change_password($_POST, $_POST['email']);
				$errorMessage = "Password updated successfully.";
				$smarty->assign('errorMessage', $errorMessage);
				$success = 1;
				$smarty->assign('success', $success);
			}						
			// defining page heading and page title
			$PAGEHEADING = "Change Password";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			// calling body
			$body = $smarty->fetch('users/change.html');
		} catch (exception $e) { 
			$errorMessage = $e->getMessage();
			$smarty->assign('errorMessage', $errorMessage);
			$body = $smarty->fetch('users/change.html');
		} 		
		break;	
	case 'loginalready':
		// defining page heading and page title
		$PAGEHEADING = "Already Logged In";
		$smarty->assign('PAGEHEADING', $PAGEHEADING);
		// calling body
		$body = $smarty->fetch('users/loginalready.html');
		break;
	case 'loginSuccess':
		// defining page heading and page title
		$PAGEHEADING = "Confirmation";
		$smarty->assign('PAGEHEADING', $PAGEHEADING);
		// calling body
		$body = $smarty->fetch('users/loginSuccess.html');
		break;
	case 'login':
	default:		
		try {		
			if($_SESSION['user_id']) {
				header("Location: index.php?p=users&action=loginalready&ID=".$ID);
				exit;
			}
			$loginFormAction = $_SERVER['PHP_SELF'];
			if (isset($_GET['accesscheck'])) {
  				$_SESSION['PrevUrl'] = $_GET['accesscheck'];
			}

			$users = new mod_Users($dbFrameWork, $Common);
			if (isset($_POST['email'])) {
				$loginUsername=$_POST['email'];
				$password=$_POST['password'];
				$MM_fldUserAuthorization = "role";
				$MM_redirectLoginSuccess = HTTPPATH."/index.php?p=users&action=loginSuccess&ID=".$ID;
				$MM_redirectLoginFailed = HTTPPATH."/index.php?p=users&action=login&ID=".$ID;
				$MM_redirecttoReferrer = true;
				
				$LoginRS__query=sprintf("SELECT email, password, role, name, user_id FROM users WHERE email='%s' AND password='%s'", get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
				$LoginRS = $dbFrameWork->Execute($LoginRS__query);
				if($dbFrameWork->ErrorMsg()) {
					throw new Exception($dbFrameWork->ErrorMsg());
				}
		
				$loginFoundUser = $LoginRS->RecordCount();
				if ($loginFoundUser) {
					$LoginRecord = $LoginRS->FetchRow();				
					$loginStrGroup  = $LoginRecord['role'];				
					//declare two session variables and assign them
					$_SESSION['MM_Username'] = $loginUsername;
					$_SESSION['MM_UserGroup'] = $loginStrGroup;	
					$_SESSION['user_id'] = $LoginRecord['user_id']; 
					$_SESSION['name'] = $LoginRecord['name'];	       
				
					if (isset($_SESSION['PrevUrl']) && true) {
						$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
					}
					header("Location: ".$MM_redirectLoginSuccess);
					exit;
				} else {
					throw new Exception("Login Failed. Try again.");
				}
			}
			
			// defining page heading and page title			
			$PAGEHEADING = "Login User";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			// calling body
			$body = $smarty->fetch('users/login.html');
		} catch (exception $e) { 
			$errorMessage = $e->getMessage();
			$smarty->assign('errorMessage', $errorMessage);
			$body = $smarty->fetch('users/login.html');
		} 
		break;
}
?>