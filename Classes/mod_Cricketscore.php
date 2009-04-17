<?php
class mod_Cricketscore {
	
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
		$keyword = $data['keyword'][$ID]['keyword'];
		$result['content']=$this->displayScore($keyword);
		return $result;
	}
	
	public function displayScore($keyword) {
$string = '<div align="center"><script src="http://www.gmodules.com/ig/ifr?url=http://hosting.gmodules.com/ig/gadgets/file/103760280006499199146/Cricket-Score-Board.xml&amp;synd=open&amp;w=250&amp;h=250&amp;title='.urlencode($keyword).'&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script></div>';
		return $string;
	}
}
?>