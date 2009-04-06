<?php
try {
	// fetching concepts and settings
	$result = $Common->getConceptSettings('sendsms', $ID);	
	$smarty->assign('result', $result);
	$keyword = $result['keyword'][0]['keyword'];
	
	if(!$result['concepts']) {	
		throw new Exception("Send SMS Concept does not exist for this id. ");
	}
	$mod_Sendsms = new mod_Sendsms($dbFrameWork, $Common);	
	switch($_GET['action']) {
		case 'send':
			if(!$_POST['phone']) {
				echo '<p class="error">Please enter phone number.</p>';
				exit;
			}
			if(!$_POST['message']) {
				echo '<p class="error">Please enter message.</p>';
				exit;
			}
			$smsResult = $mod_Sendsms->sendSMS($_POST['phone'], substr($_POST['message'],0,160));
			$smsResultArr = explode("<br>",$smsResult);
			if($smsResultArr[0]=="Message Submitted") {
				echo '<p class="error">SMS sent successfully.</p>';
			} else {
				echo '<p class="error">Could not send sms. Please try again later.</p>';
			}
			exit;
			break;
		default:
			// defining page heading and page title
			$PAGEHEADING = "Send SMS";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			$content = $mod_Sendsms->showSMSForm($keyword);
			$smarty->assign('content', $content);
			// calling body
			$body = $smarty->fetch('content.html');
			break;
	}
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>