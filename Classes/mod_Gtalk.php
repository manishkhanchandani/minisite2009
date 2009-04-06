<?php
class mod_Gtalk {
	
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
		$keyword = $data['keyword'][0]['keyword'];
		$result['content']=$this->displayChat($keyword);
		return $result;
	}
	
	public function displayChat($keyword) {
$string = '<div align="center"><script src="http://www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/googletalk.xml&amp;synd=open&amp;w=320&amp;h=451&amp;title='.urlencode($keyword).'&amp;lang=en&amp;country=US&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script></div>';
		return $string;
	}
}
?>