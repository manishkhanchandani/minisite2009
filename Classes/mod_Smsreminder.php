<?php
class mod_Smsreminder {	
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
		return true;
	}
	public function validateForm($post) {
		if(!trim($post['title'])) $msg .= "Please insert the title. ";
		if(!trim($post['message'])) $msg .= "Please insert the message. ";
		if(!trim($post['tophone'])) $msg .= "Please insert the 'To Phone Numbers'. ";
		if(!trim($post['smsdatetime'])) $msg .= "Please insert the sms date. ";
		if(!trim($post['smstime'])) $msg .= "Please insert the sms time. ";
		if($post['smstype']=="Recurring" && !trim($post['recurringtype'])) {
			$msg .= "Please choose the recurring type. ";
		}
		if($msg) throw new Exception($msg);
	}
	
	public function cronSMS() {
		global $common;
		$currentTime = time();
		$sql = "select id, tophone, message, smstype, senddate, recurringtype, recurringfixedtypedates from smsreminders WHERE status = 1 AND senddate != '' AND senddate IS NOT NULL AND senddate < ".$currentTime;
		$record = $this->Common->selectRecord($sql);
		if($record) {
			foreach($record as $rec) {
				// get phone number and text message
				$PhoneNumber = $rec['tophone'];
				$text = substr(strip_tags($rec['message']),0,160);
				// send sms and get the result
				$smsResult = $this->sendSMS($PhoneNumber, $text);
				// extract the first line of result
				$smsResultArr = explode("<br>",$smsResult);
				// if it is Message Submitted then update the database
				if($smsResultArr[0]=="Message Submitted") {
					$ret['senddate'] = $this->getSendSMSDate($rec);
					if($ret['senddate']) $ret['smsdatetime'] = date('Y-m-d H:i:s',$ret['senddate']);
					$ret['lastsenddate'] = date('Y-m-d H:i:s');
					$ret['modified'] = date('Y-m-d H:i:s');
					$this->Common->phpedit('smsreminders', 'id', $ret, $rec['id']);
				} else {
					// mail to administrator
					@mail(ADMINEMAIL, "sms send failed on ".date('r'), "sms send failed on ".$_SERVER['PHP_SELF']." due to ".$smsResult);
				}
			}
		}
	}
	
	public function sendSMS($PhoneNumber, $text) {
		global $conceptValue;
		$url = "http://www.globalsms-mms.com/sendsmsv2.asp"; 
		//$user = "nkhanchandani";
		//$password = "password";
		$sender = "mumbaionlin";
		$sendercdma = "919860609000";
		$post_fields = $conceptValue.'&sender='.urlencode($sender).'&sendercdma='.urlencode($sendercdma).'&PhoneNumber='.urlencode($PhoneNumber).'&text='.urlencode($text); 

		$ch = curl_init(); // Initialize a CURL session.
		curl_setopt($ch, CURLOPT_URL, $url); // Pass URL as parameter.
		curl_setopt($ch, CURLOPT_POST, 1); // use this option to Post a form
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); // Pass form Fields.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return Page contents.
		$result = curl_exec($ch); // grab URL and pass it to the variable.
		curl_close($ch); // close curl resource, and free up system resources.
		return $result; // Print page contents.
	}
	
	public function getSendSMSDate($rec) {
		if($rec['smstype']=="Fixed") {
			return NULL;
		} else {
			switch($rec['recurringtype']) {
				case 'Every 10 Minutes':
					$newTime = $rec['senddate']+(60*10);
					break;
				case 'Every Half Hourly':
					$newTime = $rec['senddate']+(60*30);
					break;
				case 'Hourly':
					$newTime = $rec['senddate']+(60*60);
					break;
				case 'Every 2 Hour':
					$newTime = $rec['senddate']+(60*60*2);
					break;
				case 'Every 3 Hours':
					$newTime = $rec['senddate']+(60*60*3);
					break;
				case 'Every 6 Hours':
					$newTime = $rec['senddate']+(60*60*6);
					break;
				case 'Daily':
					$newTime = $rec['senddate']+(60*60*24);
					break;
				case 'WeekDays':
					$time = $rec['senddate'];
					$days = getdate($time);
					if($days['weekday']=="Thursday") {
						$time2 = strtotime("next Friday", $rec['senddate']);
					}	else if($days['weekday']=="Wednesday") {
						$time2 = strtotime("next Thursday", $rec['senddate']);
					} else if($days['weekday']=="Tuesday") {
						$time2 = strtotime("next Wednesday", $rec['senddate']);
					} else if($days['weekday']=="Monday") {
						$time2 = strtotime("next Tuesday", $rec['senddate']);
					} else {
						$time2 = strtotime("next Monday", $rec['senddate']);
					} 				
					$time1 = $rec['senddate'];
					$days1 = getdate($time1);
					$days2 = getdate($time2);
					$newTime = mktime($days1['hours'], $days1['minutes'], $days1['seconds'], $days2['mon'], $days2['mday'], $days2['year']);	
					break;
				case 'Sunday':
					$time2 = strtotime("next Sunday", $rec['senddate']);
					$time1 = $rec['senddate'];
					$days1 = getdate($time1);
					$days2 = getdate($time2);
					$newTime = mktime($days1['hours'], $days1['minutes'], $days1['seconds'], $days2['mon'], $days2['mday'], $days2['year']);
					break;
				case 'SatSun':
					$time = $rec['senddate'];
					$days = getdate($time);
					if($days['weekday']=="Saturday") {						
						$time2 = strtotime("next Sunday", $rec['senddate']);
					} else {
						$time2 = strtotime("next Saturday", $rec['senddate']);
					}
					$time1 = $rec['senddate'];
					$days1 = getdate($time1);
					$days2 = getdate($time2);
					$newTime = mktime($days1['hours'], $days1['minutes'], $days1['seconds'], $days2['mon'], $days2['mday'], $days2['year']);					
					break;
				case 'Fortnight':
					$newTime = $rec['senddate']+(60*60*24*14);
					break;
				case 'Monthly':
					$newTime = strtotime("+1 Month", $rec['senddate']);
					break;
				case 'Quarterly':
					$newTime = strtotime("+3 Month", $rec['senddate']);
					break;
				case 'SixMonthly':
					$newTime = strtotime("+6 Month", $rec['senddate']);
					break;
				case 'Yearly':
					$newTime = strtotime("+1 Year", $rec['senddate']);
					break;
			}
			return $newTime;
		}
	}
}
?>