<?php
class mod_News {
	
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
		if($settings) {
			$news = array();
			foreach($settings as $k=>$v) {
				$url = $v['comments'];	
				$cid = $v['concept_id'];
				$concept_value = $data['concepts'][$cid]['concept_value'];
				if($concept_value) {
					$tmp = explode(",", $concept_value);
					$kw = $tmp[0];
				} else {
					$kw = $data['keyword'][$ID]['keyword'];
				}
				$url = str_replace("[[KEYWORD]]", urlencode($kw), $url);
				$tmp = $this->getNewsMaxTitle($url, 3, $ID);
				if($tmp) {
					foreach($tmp as $val) {
						$news[] = $val;
					}
				}
			}
		}
		return $news;
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
	
	public function getNewsMaxTitle($url, $max, $ID) {
		$itemNum=0;
		$ret = array();
		$myRss = new RSSParser($url);
		$myRss_RSSmax=0;
		if($max) $myRss_RSSmax=$max;
		if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
		for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){
			//$result .= '<p><a href="'.$myRss->links[$itemNum].'" rel="nofollow" target="_blank">'.$myRss->titles[$itemNum].'</a><br /><small><b>Pub: </b>'.$myRss->pubDates[$itemNum].'</small></p><p>'.$myRss->descriptions[$itemNum].'</p>'; 
			$ret[$itemNum]['created'] = $myRss->pubDates[$itemNum];
			$ret[$itemNum]['title'] = $myRss->titles[$itemNum];
			$ret[$itemNum]['link'] = HTTPPATH."/index.php?p=news&ID=".$ID;
		}
		return $ret;
	}
	
	public function getNewsString($result) {
		if($result['settings']) {
			foreach($result['settings'] as $k => $v) {
				$url = $v['comments'];
				$cid = $v['concept_id'];
				$concept_value = $result['concepts'][$cid]['concept_value'];
				if($concept_value) {
					$tmp = explode(",", $concept_value);
					foreach($tmp as $kw) {
						$url1 = str_replace("[[KEYWORD]]", urlencode($kw), $url);
						$news .= $this->getNews($url1);
					}
				} else {
					$kw = $data['keyword'][$ID]['keyword'];
					$url = str_replace("[[KEYWORD]]", urlencode($kw), $url);
					$news .= $this->getNews($url);
				}				
			}
		} 
		return $news;
	}
}
?>