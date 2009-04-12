<?php
class mod_Auction4cause {
	
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
	
	public function getListing($ID, $conceptId, $max, $page) {
		$sql = "select a.product_id, a.id, a.concept_id, a.product_name, a.product_price, a.comments, a.product_end_date, b.get4price, b.maxbidprice, b.bidfee, b.maxnumofbids from product as a LEFT JOIN auction_item_settings as b ON a.product_id = b.product_id WHERE a.product_start_date < '".date('Y-m-d H:i:s')."' AND a.product_end_date > '".date('Y-m-d H:i:s')."' AND a.id = '".$ID."' AND a.concept_id = '".$conceptId."' ORDER BY product_end_date ASC";
		$sqlCnt = "select count(a.product_id) as cnt from product as a LEFT JOIN auction_item_settings as b ON a.product_id = b.product_id WHERE a.product_start_date < '".date('Y-m-d H:i:s')."' AND a.product_end_date > '".date('Y-m-d H:i:s')."' AND a.id = '".$ID."' AND a.concept_id = '".$conceptId."'";	
		$pageNum = $page-1;	
		$start = $pageNum * $max;
		$records = $this->Common->selectCacheLimitRecordFull($sql, $sqlCnt, $max, $start);
		//echo "<pre>";
		//print_r($records);
		//exit;
		return $records;
	}
	
	public function getDetail($ID, $conceptId, $productId) {
		$sql = "select a.product_id, a.id, a.concept_id, a.product_name, a.product_price, a.comments, a.product_end_date, b.get4price, b.maxbidprice, b.bidfee, b.maxnumofbids, a.product_description, a.product_start_date from product as a LEFT JOIN auction_item_settings as b ON a.product_id = b.product_id WHERE a.product_id = '".$productId."' AND a.id = '".$ID."' AND a.concept_id = '".$conceptId."' ORDER BY product_end_date ASC";
		$records = $this->Common->selectCacheRecord($sql);
		//echo "<pre>";
		//print_r($records[0]);
		//exit;
		return $records[0];	
	}
	
	public function submitBid($post, $ID, $conceptId, $productId, $records) {		
		$sql = "INSERT INTO `auction_bids` ( `id` , `concept_id` , `product_id` , `user_id` , `bid_amount` , `bid_date` , `charity_id` , `ip` , `feepaid` ) VALUES ( '".$ID."', '".$conceptId."', '".$productId."', '".$_SESSION['user_id']."' , '".$post['bid']."', '".date('Y-m-d H:i:s')."' , '".$post['charity_id']."', '".$_SERVER['REMOTE_ADDR']."', '".$records['bidfee']."' )";
		$this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$uid = $this->dbFrameWork->Insert_ID();
		return $uid;
	}
	
	public function updateBid($bid_id) {
		$sql = "update `auction_bids` set bstatus = 1 where bid_id = '".$bid_id."'";
		$this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		return true;
	}
	
	public function getCharity($ID, $conceptId) {
		$sql = "select * from auction_charities WHERE id = '".$ID."' AND concept_id = '".$conceptId."' and deleted = 0";
		$records = $this->Common->selectCacheRecord($sql);
		return $records;		
	}
}
?>