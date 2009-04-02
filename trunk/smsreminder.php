<?php
$result = $Common->getConceptSettings('smsreminder', $ID);
if(!$result['concepts']) {	
	$errorMessage = "Smsreminder Concept does not exist for this id. ";
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} else {
	// assigning action
	$smarty->assign('action', $_GET['action']);
	switch($_GET['action']) {
		case 'new':
			try {	
				// user access
				if(!$_SESSION['user_id']) {
					throw new Exception('Please login first to continue. ');	
				}
				$SMS = new mod_SMS($dbFrameWork, $Common);	
				$SMS->validateForm($_POST);
				$_POST['user_id'] = $_COOKIE['user_id'];
				$time1 = strtotime($_POST['smsdatetime']);
				$time2 = explode(":", $_POST['smstime']);
				$time3 = mktime($time2[0], $time2[1], 0, date('m', $time1), date('d', $time1), date('Y', $time1));
				$_POST['senddate'] = $time3;
				$_POST['smsdatetime'] = date('Y-m-d H:i:s', $time3);
				$common->insertRecord("smsreminders", "id", $_POST);
				$message = 'SMS Created Successfully. SMS will be sent as per your details. ';
				echo "<p class='error'>".$message."</p>";
				
				// send cron for now on each individual page, later on put it in cron jobs.
				$SMS->cronSMS();
				$body = $smarty->fetch('smsreminder/new.html');
			} catch(Exception $e) {
				$body = $smarty->fetch('smsreminder/new.html');
			}
			break;
	}
}
?>