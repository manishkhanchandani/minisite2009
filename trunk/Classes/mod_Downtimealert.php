<?php
class mod_Downtimealert {	
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
	public function validateNewDowntime($post) {
		if(!trim($post['url'])) {
			throw new Exception('please insert site url. ');
		}
		if(!trim($post['email'])) {
			throw new Exception('please insert email.');
		}
		return true;
	}
	public function getOneElement($id, $user_id) {
		$sql = "select * from downtime where downtime_id = '".$id."' and user_id = '".$user_id."' and id = '".ID."'";
		$rs = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$edit = $rs->FetchRow();
		return $edit;
	}
	public function getDowntimeResult($id, $from='', $to='') {
		$sql = "select * from downtime_results where downtime_id = '".$id."' and id = '".ID."'";
		if($from && $to) {
			$sql .= " AND check_date BETWEEN '".$from." 00:00:00' AND '".$to." 23:59:59'";
		} else if($from) {
			$sql .= " AND check_date BETWEEN '".$from." 00:00:00' AND '".date('Y-m-d H:i:s')."'";
		} else if($to) {
			$sql .= " AND check_date BETWEEN '1970-01-01 00:00:00' AND '".$to." 23:59:59'";
		}
		$sql .= " ORDER BY check_date DESC";
		$res = $this->Common->selectCacheRecord($sql);
		$ret['details']['up'] = 0;
		$ret['details']['down'] = 0;
		if($res) {
			$ret['found'] = 1;
			foreach($res as $det) {
				if($det['finalstatus']==1) {
					$ret['details']['up'] += 1;
				} else {
					$ret['details']['down'] += 1;
				}
				$ret['data']['check'][$det['check_date']] = $det['finalstatus'];
			}
		} 
		return $ret;
	}
	public function getAll($user_id) {
		$sql = "select * from downtime where user_id = '".$user_id."' and id = '".ID."' order by url";
		$return = $this->Common->selectCacheRecord($sql);
		return $return;
	}
	public function cronDowntime() {
		$sql = "select * from downtime where datetocheck < ".time()." AND status = 1";
		$rs = $this->dbFrameWork->Execute($sql);
		$Twilio = new Twilio;
		while($arr = $rs->FetchRow()) {
			if(!$datas[$arr['id']]) {
				$datas[$arr['id']] = $this->Common->getConceptSettings('downtimealert', $arr['id']);
			}
			$data = $datas[$arr['id']];
			$url = $arr['url'];
			$text = $arr['texttocheck'];
			$checkRequest = $this->checkRequest($url);
			if($text) {
				$checkText = $this->checkText($url, $text);
			} else {
				$checkText = 1;
			}
			if($checkRequest!=1 && $checkText!=1) {
				$reason = "We cannot ping the site \"".$url."\". Text \"".$text."\" not found on the site. ";
			} else if($checkRequest!=1) {
				$reason = "We cannot ping the site \"".$url."\". ";
			} else if($checkText!=1) {
				$reason = "Text \"".$text."\" not found on the site. ";
			}
			if($checkRequest==1 && $checkText==1) {
				$record['finalstatus'] = 1;	
			} else {
				$record['finalstatus'] = 0;
				$msg = "Your site ".$arr['url']." is down. Please check it.";
				if($arr['usphone']) {
					if($this->validateUSPhone($arr['usphone'])) {
						$xml = "http://10000projects.info/call.php?msg=".urlencode($msg);
						$Twilio->initiate_call($arr['usphone'], $xml, $data);
					}
				}
				if($arr['email']) {
					$Emailtemplate = new Emailtemplate;
					$patterns[0] = "{SITENAME}";
					$replacements[0] = $url;		
					$patterns[1] = "{REASON}";
					$replacements[1] = $reason;	
					$to = $arr['email'];
					echo $message = $Emailtemplate->template($to, 'downtimealert', $patterns, $replacements);
				}
				if($arr['smsphone']) {
				
				}				
			}
			$record['check_date'] = date('Y-m-d H:i:s');
			$record['pingstatus'] = $checkRequest;
			$record['textcheckstatus'] = $checkText;
			$record['downtime_id'] = $arr['downtime_id'];
			$record['id'] = $arr['id'];
			$this->Common->phpinsert('downtime_results', 'result_id', $record); 
			$checked['lastcheckdate'] = strtotime($record['check_date']);
			$checked['datetocheck'] = $checked['lastcheckdate']+($arr['checkfrequency']*60);
			$this->Common->phpedit('downtime', 'downtime_id', $checked, $arr['downtime_id']); 
		}
	}
	public function validateUSPhone($ph) {
		return true;
	}
	public function checkText($url, $text) {
		$content = $this->getFileContent($url);
		if(eregi($text, $content)) {
			return 1;
		} else {
			return 0;
		}		
	}
	public function getFileContent($url, $params=array()) {
		$cookie_file_path = DOCPATH."/tmp/Cookie/cookie.txt"; 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
		if($params['agent']) curl_setopt($ch, CURLOPT_USERAGENT, $params['agent']); 
		if($params['post']) {
			curl_setopt($ch, CURLOPT_POST, 1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS,$params['post']); 
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		if($params['reffer']) curl_setopt($ch, CURLOPT_REFERER, $params['reffer']); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path); 
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$result = curl_exec($ch); 
		curl_close($ch); 
		return $result; 
	}
	public function checkRequest($url) {
		require_once "HTTP/Request.php";
		$req =& new HTTP_Request($url);
		$req->sendRequest();
		$code = $req->getResponseCode();
		if($code==200) {
			return 1;
		} else {
			return 0;
		}
	}
	public function sendSMS() {
	
	}
	public function sendPhone($phone) {
		
	}
}
?>