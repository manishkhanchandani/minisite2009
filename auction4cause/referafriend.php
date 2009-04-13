<?php
try {
	if(!$_SESSION['user_id']) {
		throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
	}
	if($_POST['MM_Insert']==1) {
		$Emailtemplate = new Emailtemplate;
		$patterns[0] = "{SITENAME}";
		$replacements[0] = SITENAME;		
		$patterns[1] = "{SITEURL}";
		$replacements[1] = HTTPPATH."/index.php?ID=".$ID."&p=auction4cause/index&rn=".$_SESSION['user_id'];		
		$patterns[2] = "{MYNAME}";
		$replacements[2] = $_POST['Name'];		
		$patterns[3] = "{TONAME}";
		$replacements[3] = $_POST['n'];	
		$to = $rec['f'];
		$Emailtemplate->fromname = $_POST['Name'];
		$Emailtemplate->fromemail = $_POST['Email'];
		$message = $Emailtemplate->template($to, 'referafriend', $patterns, $replacements);
		// email ends
		$msg = "Thank you for your referral!";
		$smarty->assign('errorMessage', $msg);
	}
	$body = $smarty->fetch('auction4cause/referafriend.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>