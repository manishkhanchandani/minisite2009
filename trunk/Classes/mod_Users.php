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
}
?>