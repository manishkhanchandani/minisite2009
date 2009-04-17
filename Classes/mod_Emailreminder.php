<?php
class mod_Emailreminder {	
	private $cacheSecs = CACHETIME;
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
		if(!trim($post['toemail'])) $msg .= "Please insert the 'To Phone Numbers'. ";
		if(!trim($post['emaildatetime'])) $msg .= "Please insert the email date. ";
		if(!trim($post['emailtime'])) $msg .= "Please insert the email time. ";
		if($post['emailtype']=="Recurring" && !trim($post['recurringtype'])) {
			$msg .= "Please choose the recurring type. ";
		}
		if($msg) throw new Exception($msg);
	}
	
	public function cronEMAIL() {
		global $common;
		$currentTime = time();
		$sql = "select id, toemail, message, emailtype, senddate, recurringtype, recurringfixedtypedates from emailreminders WHERE status = 1 AND senddate != '' AND senddate IS NOT NULL AND senddate < ".$currentTime;
		$record = $this->Common->selectRecord($sql);
		if($record) {
			foreach($record as $rec) {
				// get phone number and text message
				$email = $rec['toemail'];
				$text = $rec['message'];
				// send email and get the result
				$emailResult = $this->sendEmail($email, $text);				
				if($emailResult) {
					$ret['senddate'] = $this->getSendDate($rec);
					if($ret['senddate']) $ret['emaildatetime'] = date('Y-m-d H:i:s',$ret['senddate']);
					$ret['lastsenddate'] = date('Y-m-d H:i:s');
					$ret['modified'] = date('Y-m-d H:i:s');
					$this->Common->phpedit('emailreminders', 'id', $ret, $rec['id']);
				}
			}
		}
	}
	
	public function sendEmail($email, $text) {
		$em = explode(",",$email);
		$myEmail = new myEmail;
		$myEmail->txt = strip_tags($text);
		$myEmail->html = $text;
		$myEmail->from = SITEEMAIL;
		$myEmail->subject = "New Email Reminder";
		if($em) {
			foreach($em as $to) {
				$myEmail->to = $to;
				$myEmail->emailTxtHtml();
			}
		}
		return true;
	}
	
	public function getSendDate($rec) {
		if($rec['emailtype']=="Fixed") {
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