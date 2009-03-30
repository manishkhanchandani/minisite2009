<?php
class Common {

	public $cacheSecs = -300;
	private static $instance;
	
	function __construct($dbFrameWork) {
		if(self::$instance) {
			return self::$instance;
		} else {
			self::$instance = $this;
			$this->dbFrameWork = $dbFrameWork;
		}
	}
	
	public function phpinsert($table_name, $pk, $record) {
		$sql = "SELECT * FROM $table_name WHERE $pk = -1";  
		# Select an empty record from the database 
		$rs = $this->dbFrameWork->Execute($sql); # Execute the query and get the empty recordset 
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		# Pass the empty recordset and the array containing the data to insert 
		# into the GetInsertSQL function. The function will process the data and return 
		# a fully formatted insert sql statement. 
		$insertSQL = $this->dbFrameWork->GetInsertSQL($rs, $record);
		$this->dbFrameWork->Execute($insertSQL); 
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$uid = $this->dbFrameWork->Insert_ID();
		return $uid;
	}
	
	public function phpedit($table_name, $pk, $record, $uid) {
		$sql = "SELECT * FROM `$table_name` WHERE `$pk` = $uid";  
		# Select a record to update 
		$rs = $this->dbFrameWork->Execute($sql); // Execute the query and get the existing record to update 
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		# Pass the single record recordset and the array containing the data to update 
		# into the GetUpdateSQL function. The function will process the data and return 
		# a fully formatted update sql statement with the correct WHERE clause. 
		# If the data has not changed, no recordset is returned 

		$updateSQL = $this->dbFrameWork->GetUpdateSQL($rs, $record); # Update the record in the database
		if($updateSQL) {
			$return = $this->dbFrameWork->Execute($updateSQL); 
			if($this->dbFrameWork->ErrorMsg()) {
				throw new Exception($this->dbFrameWork->ErrorMsg());
			}		
		}
	}
	public function selectCount($sql) {
		$rs = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$arr = $rs->FetchRow();
		$cnt = $arr['cnt'];
		return $cnt;
	}
	
	public function selectCacheCount($sql) {
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$arr = $rs->FetchRow();
		$cnt = $arr['cnt'];
		return $cnt;
	}
	
	public function selectRecord($sql) {
		$rs = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$return[] = $arr;
		}
		return $return;
	}
	
	public function selectRecordFull($sql, $sqlCnt) {
		$rs = $this->dbFrameWork->Execute($sqlCnt);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$arr = $rs->FetchRow();
		$return['totalRows'] = $arr['cnt'];
		
		$rs = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$return['record'][] = $arr;
		}
		return $return;
	}
	
	public function selectLimitRecord($sql,$max=10,$start=0) {
		$rs = $this->dbFrameWork->SelectLimit($sql, $max, $start);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$return[] = $arr;
		}
		return $return;
	}
	
	public function selectLimitRecordFull($sql, $sqlCnt, $max=10, $start=0) {
		$rs = $this->dbFrameWork->Execute($sqlCnt);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$arr = $rs->FetchRow();
		$return['totalRows'] = $arr['cnt'];
		
		if($return['totalRows']>0) {
			$rs = $this->dbFrameWork->SelectLimit($sql, $max, $start);
			if($this->dbFrameWork->ErrorMsg()) {
				throw new Exception($this->dbFrameWork->ErrorMsg());
			}
			while ($arr = $rs->FetchRow()) { 
				$return['record'][] = $arr;
			}
		}		
		return $return;
	}
	
	public function selectCacheRecord($sql) {
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$return[] = $arr;
		}
		return $return;
	}
	
	public function selectCacheLimitRecord($sql, $max=10, $start=0) {
		$rs = $this->dbFrameWork->CacheSelectLimit($this->cacheSecs, $sql, $max, $start);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$return[] = $arr;
		}
		return $return;
	}
	public function selectCacheLimitRecordFull($sql, $sqlCnt, $max=10, $start=0) {
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sqlCnt);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$arr = $rs->FetchRow();
		$return['totalRows'] = $arr['cnt'];
		if($return['totalRows']>0) {
			$rs = $this->dbFrameWork->CacheSelectLimit($this->cacheSecs, $sql, $max, $start);
			if($this->dbFrameWork->ErrorMsg()) {
				throw new Exception($this->dbFrameWork->ErrorMsg());
			}
			while ($arr = $rs->FetchRow()) { 
				$return['record'][] = $arr;
			}
		}
		return $return;
	}
		
	public function deleteRecord($table_name, $pk, $uid) {
		$sql = "DELETE FROM `$table_name` WHERE `$pk` = $uid";  
		# Select a record to update 
		$rs = $this->dbFrameWork->Execute($sql); // Execute the query and get the existing record to update 
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->db->ErrorMsg());
		}
		return true;
	}

	public function query($sql) {
		$rs = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->db->ErrorMsg());
		}
		return $rs;
	}
	
	public function emailvalidity($email) {
		if (eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$', $email)) {
			// this is a valid email domain!
			return 1;
		}
		return 0;
	}
	
	public function emailSimple($to,$subject,$message,$headers) {
		if(@mail($to, $subject, $message, $headers)) {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function emailHTML($to,$subject,$message,$additional) {
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= $additional;
		if(@mail($to, $subject, $message, $headers)) {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function make_url_lookup($input) {
		$input = trim($input);
		$url_lookup = strip_tags($input);
		$url_lookup = str_replace(" ", "-", $url_lookup);
		$url_lookup = str_replace("&amp", "and", $url_lookup);
		$url_lookup = ereg_replace("[^a-zA-Z0-9]+", "-", $url_lookup);
		$url_lookup = ereg_replace("-+$", "", $url_lookup);
		$url_lookup = strtolower($url_lookup);
		return $url_lookup;
	}
			
	public function pagination($pageNum, $max, $totalRows, $divtag) {
		// pagination has to include include('../Classes/PaginateIt.php'); where it is called.
		// pagination			
		$PaginateIt = new PaginateIt();
		$PaginateIt->SetDivTag($divtag);
		$PaginateIt->SetCurrentPage(($pageNum+1));
		$PaginateIt->SetItemsPerPage($max);
		$PaginateIt->SetItemCount($totalRows);
		$paginate = $PaginateIt->GetPageLinksComplete();
		return $paginate;
	}
	
	public function getConceptSettings($concept, $ID) {		
		$sql = "select * from prebuilt_1 WHERE id = '".$ID."'";
		$result['keyword'] = $this->selectCacheRecord($sql);
		$sql = "select * from prebuilt_2_concepts as a INNER JOIN prebuilt_concepts as b ON a.concept_id = b.concept_id WHERE a.id = '".$ID."' and b.concept = '".$concept."'";
		$result['concepts'] = $this->selectCacheRecord($sql);
		$conceptsId = 0;
		if($result['concepts']){
			foreach($result['concepts'] as $concept) {
				$conceptsIdArr[] = $concept['concept_id'];
			}
			$conceptsId = implode(",", $conceptsIdArr);
		}
		$sql = "select * from prebuilt_3_settings as a INNER JOIN prebuilt_concepts_settings as b ON a.setting_id = b.setting_id WHERE a.id = '".$ID."' and b.concept_id IN (".$conceptsId.")";		
		$result['settings'] = $this->selectCacheRecord($sql);
		return $result;
	}
}
?>