<?php
class mod_Users {
	
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
	
	public function checkUsername($post) {
		// *** Redirect if username exists
		$MM_flag="MM_insert";
		if (isset($post[$MM_flag])) {
		  $MM_dupKeyRedirect="register.php";
		  $loginUsername = $post['email'];
		  $LoginRS__query = "SELECT email FROM users WHERE email='" . $loginUsername . "'";
		  $LoginRS=$this->dbFrameWork->Execute($LoginRS__query);
		  	if($this->dbFrameWork->ErrorMsg()) {
				throw new Exception($this->dbFrameWork->ErrorMsg());
			}
		  $loginFoundUser = $LoginRS->RecordCount();
		
		  //if there is a row in the database, the username was found - can not add the requested username
		  if($loginFoundUser){
			$errorMessage = "Email already exists. Please try another email. ";
			if($errorMessage) $errorMessage = "<p class=error>".$errorMessage."</p>";
			throw new Exception($errorMessage);
		  }
		}
		return true;
	}
	
	public function validateRegister($post) {
		if(!trim($post['name'])) {
			$errorMessage .= "Please insert name. ";
		}
		if(!trim($post['email'])) {
			$errorMessage .= "Please insert email. ";
		}
		if(!trim($post['password'])) {
			$errorMessage .= "Please insert password. ";
		}
		if(strlen(trim($post['password']))<8) {
			$errorMessage .= "Password should be minimum of 8 characters. ";
		}
		if(!trim($post['password2'])) {
			$errorMessage .= "Please insert confirm password. ";
		}
		if(trim($post['password'])!=trim($post['password2'])) {
			$errorMessage .= "Confirm password is not same as password. ";
		}
		if($errorMessage) {
			throw new Exception($errorMessage);
		}
		return true;
	}
	
	public function register($post) {
		$insertSQL = sprintf("INSERT INTO users (email, password, code, status, created, name, squestion, sanswer) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
					   $this->Common->GetSQLValueString($post['email'], "text"),
					   $this->Common->GetSQLValueString($post['password'], "text"),
					   $this->Common->GetSQLValueString($post['code'], "text"),
					   $this->Common->GetSQLValueString($post['status'], "int"),
					   $this->Common->GetSQLValueString($post['created'], "date"),
					   $this->Common->GetSQLValueString($post['name'], "text"),
					   $this->Common->GetSQLValueString($post['squestion'], "text"),
					   $this->Common->GetSQLValueString($post['sanswer'], "text"));
		$this->dbFrameWork->Execute($insertSQL);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		return true;
	}
	
	public function validateLoginForm($post) {
		if(!trim($post['email'])) {
			$msg = "Email field is blank.";
			throw new Exception($msg);
		}
		if(!trim($_POST['password'])) {
			$msg = "Password field is blank.";
			throw new Exception($msg);
		}
		if(!$_POST['validEmail']) {
			$msg = "Email field is not valid.";
			throw new Exception($msg);
		}
		return true;
	}
	public function login($id, $rem, $email, $role) {
		if($rem) $time = time()+(60*60*24*365);
		else $time = 0;
		setcookie("user_id", $id, $time, "/");
		setcookie("email", $email, $time, "/");	
		setcookie("role", $role, $time, "/");	
	}
	public function logout() {
		setcookie("user_id", '', (time()-300), "/");
		setcookie("email", '', (time()-300), "/");	
		setcookie("role", '', (time()-300), "/");	
	}
	public function validate_email($email) {
		if(!trim($email)) {
			throw new Exception("Email field is blank.");
		}
		if(!$this->Common->emailvalidity(trim($email))) {
			throw new Exception("Email field is not valid.");
		}
		return true;
	}
	public function validate_change_password($post, $email) {
		if(!trim($post['oldpassword'])) {
			throw new Exception("Old password field is blank.");
		}
		if(!trim($post['password'])) {
			throw new Exception("New password field is blank.");
		}
		if(!trim($post['cpassword'])) {
			throw new Exception("Confirm password field is blank.");
		}
		if(trim($post['password'])!=trim($post['cpassword'])) {
			throw new Exception("New password does not match with confirm new password.");
		}
		$sql = "select * from users where email = '".addslashes(stripslashes(trim($email)))."' and password = '".addslashes(stripslashes(trim($post['oldpassword'])))."'";
		$rs = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$num = $rs->RecordCount();
		if($num) {
			$rec = $rs->FetchRow();
			$sql = "update users set password = '".addslashes(stripslashes(trim($post['password'])))."' where user_id = '".$rec['user_id']."'";
			$rs = $this->dbFrameWork->Execute($sql);
		} else {
			throw new Exception("Old password does not matches with our record.");
		}
		return ture;
	}
	public function send_forgot_password($email) {
		$sql = "select * from users where email = '".addslashes(stripslashes(trim($email)))."'";
		$rs = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$num = $rs->RecordCount();
		if($num) {
			$rec = $rs->FetchRow();
			$pass = $rec['password'];
			// email
			$Emailtemplate = new Emailtemplate;
			$patterns[0] = "{PASSWORD}";
			$replacements[0] = $rec['password'];		
			$patterns[1] = "{SITEURL}";
			$replacements[1] = HTTPPATH;
			$to = $rec['email'];
			$message = $Emailtemplate->template($to, 'forgot', $patterns, $replacements);
			// email ends
			$msg = "Password successfully sent to your email.";
		} else {
			throw new Exception("Email is not valid. Our database does not contain this email. Please verify your email and try again.");
		}
		return $msg;
	}
}
?>