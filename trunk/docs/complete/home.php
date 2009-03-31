<?php

	switch($_GET['action']) {
		case 'forgot':
			$PAGETITLE = "Welcome To Mumbaionline.org.in :: Forgot Password";
			if($_POST['MM_Type']=="forgot") {
				$Users = new Users;
			}
			$styleJs = HTTPPATH."/js/forgot.js";
			$smarty->assign('styleJs', $styleJs);
			$body = $smarty->fetch('forgot.html');
			break;
		case 'register':
			$PAGETITLE = "Welcome To Mumbaionline.org.in :: Register";
			$styleJs = HTTPPATH."/js/register.js";
			$smarty->assign('styleJs', $styleJs);
			if($_POST['MM_Type']=="register") {
				try {
					$Users = new Users;
					$Users->validate_email($_POST['email']);
					$Users->validateRegisterForm($_POST);
					$Users->addNewUser($_POST);
					$msg = "You are successfully registerd on our site. Please check your email and click a link to confirm your email.";
					$smarty->assign('msg', $msg);
				} catch (exception $e) { 
					$errorMessage = $e->getMessage();
					$smarty->assign('errorMessage', $errorMessage);
					$body = $smarty->fetch('register.html');
				} 
			}
			$body = $smarty->fetch('register.html');
			break;
		case 'confirm':
			$PAGETITLE = "Welcome To Mumbaionline.org.in :: Confirm Registration";
			try {
				$Users = new Users;
				$Users->confirmation($_GET['email'], $_GET['vc']);
				$msg = 'You have successfully confirmed your email address. You can now login to our site by <a href="index.php">clicking here.</a>';
				$smarty->assign('msg', $msg);
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('confirm.html');
			} 
			$body = $smarty->fetch('confirm.html');
			break;
		case 'logout':			
			$styleJs = HTTPPATH."/js/login.js";
			$smarty->assign('styleJs', $styleJs);
			try {
				$Users = new Users;
				$Users->logout();
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('login.html');
			} 
			$body = $smarty->fetch('login.html');
			break;
		default:
			$PAGETITLE = "Welcome To Mumbaionline.org.in :: Login";
			$styleJs = HTTPPATH."/js/login.js";
			$smarty->assign('styleJs', $styleJs);
			if($_POST['MM_Type']=="login") {
				try {
					$Users = new Users;
					$Users->validate_email($_POST['email']);
					$Users->validateLoginForm($_POST);
					$Users->login($_POST);
					$body = $smarty->fetch('loginsuccess.html');
					echo $body;
					exit;
				} catch (exception $e) { 
					$errorMessage = $e->getMessage();
					$smarty->assign('errorMessage', $errorMessage);
					$body = $smarty->fetch('login.html');
				} 
			}
			$body = $smarty->fetch('login.html');
			break;
	}
$header = $smarty->fetch("preloginheader.html");
$footer = $smarty->fetch("preloginfooter.html");
echo $header.$body.$footer;
exit;
?>