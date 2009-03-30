<?php
class mod_News {
	
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
	
	public function getNews($url) {
		$itemNum=0;
		$result = '';
		$myRss = new RSSParser($url);
		$myRss_RSSmax=0;
		if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
		for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){
			$result .= '<p><a href="'.$myRss->links[$itemNum].'" rel="nofollow" target="_blank">'.$myRss->titles[$itemNum].'</a><br /><small><b>Pub: </b>'.$myRss->pubDates[$itemNum].'</small></p><p>'.$myRss->descriptions[$itemNum].'</p>'; 
		}
		return $result;
	}
	
	public function getNewsString($result) {
		if($result['settings']) {
			foreach($result['settings'] as $k => $v) {
				$url = $v['comments'];
				$url = str_replace("[[KEYWORD]]", urlencode($result['keyword'][0]['keyword']), $url);
				$news .= $this->getNews($url);
			}
		} 
		return $news;
	}
}
?>