<?php
class mod_Sendsms {
	
	private $cacheSecs = -300;
	private static $instance;
	
	public function __construct($dbFrameWork, $Common) {
		if(self::$instance) {
			return self::$instance;
		} else {
			self::$instance = $this;
			$this->dbFrameWork = $dbFrameWork;
			$this->Common = $Common;
		}
	}
	
	public function viewHomePage($ID, $data, $settings) {
		$keyword = $data['keyword'][$ID]['keyword'];
		$result['content']=$this->showSMSForm();
		return $result;
	}
	
	public function showSMSForm() {
$string = '<div style="width:90%; margin-left:auto; margin-right:auto;">
<div id="smsMessage"></div>
	<form name="frmSmsMessage" method="post" action="" id="frmSmsMessage">
	  <p><b>Phone Number: (eg. 919323....)</b> <br> 
	    <input name="phone" type="text" id="phone" size="45">
	  </p>
	  <p><b>Message (160 chars max):</b> 
	    <br>
	    <textarea name="message" cols="30" rows="3" id="message"></textarea>
	  </p>
	  <p>  
	    <input type="button" name="Submit" value="Send SMS" onClick="if(!document.frmSmsMessage.phone.value) { alert(\'Please fill phone.\'); document.frmSmsMessage.phone.focus(); } else if(!document.frmSmsMessage.message.value) { alert(\'Please fill message.\'); document.frmSmsMessage.message.focus(); } else { doAjaxLoadingText(\''.HTTPPATH.'/index.php\',\'POST\',\'p=sendsms&ID='.ID.'&action=send\',\'phone=\'+document.frmSmsMessage.phone.value+\'&message=\'+encodeURIComponent(document.frmSmsMessage.message.value),\'smsMessage\',\'yes\',\'Sending SMS ...\');}">
          </p>
	</form>
</div>';
		return $string;
	}
	
	public function sendSMS($PhoneNumber, $text, $data) {
		$url = "http://www.globalsms-mms.com/sendsmsv2.asp"; 
		$user = $data['keyword'][ID]['smsusername'];//"nkhanchandani";
		$password = $data['keyword'][ID]['smspassword']; //"password";
		$sender = "mumbaionlin";
		$sendercdma = "919860609000";
		$post_fields = 'user='.$user.'&password='.$password.'&sender='.urlencode($sender).'&sendercdma='.urlencode($sendercdma).'&PhoneNumber='.urlencode($PhoneNumber).'&text='.urlencode($text); 

		$ch = curl_init(); // Initialize a CURL session.
		curl_setopt($ch, CURLOPT_URL, $url); // Pass URL as parameter.
		curl_setopt($ch, CURLOPT_POST, 1); // use this option to Post a form
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); // Pass form Fields.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return Page contents.
		$result = curl_exec($ch); // grab URL and pass it to the variable.
		curl_close($ch); // close curl resource, and free up system resources.
		return $result; // Print page contents.
	}
}
?>