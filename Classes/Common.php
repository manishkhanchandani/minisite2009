<?php
class Common {

	public $cacheSecs = CACHETIME;
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
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$result['keyword'][$arr['id']] = $arr;
		}
		$sql = "select * from prebuilt_2_concepts as a INNER JOIN prebuilt_concepts as b ON a.concept_id = b.concept_id WHERE a.id = '".$ID."' and b.concept = '".$concept."'";	
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$result['concepts'][$arr['concept_id']] = $arr;
			$result['conceptId'] = $arr['concept_id'];			
			$result['conceptValue'] = $arr['concept_value'];
			$result['concept'] = $arr['concept'];		
		}
		$conceptsId = 0;
		if($result['concepts']){
			foreach($result['concepts'] as $concept) {
				$conceptsIdArr[] = $concept['concept_id'];
			}
			$conceptsId = implode(",", $conceptsIdArr);
		}
		$sql = "select * from prebuilt_3_settings as a LEFT JOIN prebuilt_concepts_settings as b ON a.setting_id = b.setting_id WHERE a.id = '".$ID."' and b.concept_id IN (".$conceptsId.")";			
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$result['settings'][$arr['setting_id']] = $arr;
		}
		return $result;
	}
	
	public function getConceptId($ID) {
		$sql = "select * from prebuilt_1 WHERE id = '".$ID."'";
		$result = $this->selectCacheRecord($sql);
		return $result;	
	}
	public function getConceptHomePageSettings($ID) {		
		$sql = "select * from prebuilt_1 WHERE id = '".$ID."'";
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$result['keyword'][$arr['id']] = $arr;
		}
		$sql = "select * from prebuilt_2_concepts as a INNER JOIN prebuilt_concepts as b ON a.concept_id = b.concept_id WHERE a.id = '".$ID."' and a.homepage = '1'";
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$result['concepts'][$arr['concept_id']] = $arr;
		}
		$conceptsId = 0;
		if($result['concepts']){
			foreach($result['concepts'] as $concept) {
				$conceptsIdArr[] = $concept['concept_id'];
			}
			$conceptsId = implode(",", $conceptsIdArr);
		}
		$sql = "select * from prebuilt_3_settings as a LEFT JOIN prebuilt_concepts_settings as b ON a.setting_id = b.setting_id WHERE a.id = '".$ID."' and b.concept_id IN (".$conceptsId.")";		
		$ret = $this->selectCacheRecord($sql);
		if($ret) {
			foreach($ret as $k => $v) {
				$result['settings'][$v['concept_id']][$v['setting_id']] = $v;
			}
		}
		return $result;	
	}
	public function generateMenu($ID, $type=2) {	
		$sql = "select * from prebuilt_2_concepts as a INNER JOIN prebuilt_concepts as b ON a.concept_id = b.concept_id WHERE a.id = '".$ID."' ORDER BY a.priority";
		$MENU = $this->selectCacheRecord($sql);
		switch($type) {
			case '1':
				$menuString = "<a href=\"".HTTPPATH."/index.php?ID=".$ID."\">Home</a> ";
				if($MENU){
					foreach($MENU as $concept) {
						if($concept['displayname']) $disp = $concept['displayname']; else $disp = $concept['concept'];
						$menuString .= "| <a href=\"".HTTPPATH."/index.php?ID=".$ID."&p=".$concept['concept']."\">".$disp."</a> ";
					}
				}
				if($_SESSION['user_id']) {
					$menuString .= "| <a href=\"".HTTPPATH."/index.php?ID=".$ID."&p=users&action=change\">Change Password</a> | <a href=\"".HTTPPATH."/index.php?ID=".$ID."&p=users&action=logout\">Logout</a>";
				} else {
					$menuString .= "| <a href=\"".HTTPPATH."/index.php?ID=".$ID."&p=users&action=login\">Login</a> | <a href=\"".HTTPPATH."/index.php?ID=".$ID."&p=users&action=register\">Register</a> | <a href=\"".HTTPPATH."/index.php?ID=".$ID."&p=users&action=forgot\">Forgot Password</a>";
				}
				break;
			case '2':
				$menuString = "";
				if($MENU){
					$menuString .= "<ul>";
					foreach($MENU as $concept) {
						if($concept['displayname']) $disp = $concept['displayname']; else $disp = $concept['concept'];
						$menuString .= "<li><a href=\"".HTTPPATH."/index.php?ID=".$ID."&p=".$concept['concept']."\">".$disp."</a></li>";
					}
					$menuString .= "</ul>";
				}
				break;
		}
		return $menuString;	
	}
	
	public function generateMenuCustomize($ID) {	
		$sql = "select * from prebuilt_2_concepts as a INNER JOIN prebuilt_concepts as b ON a.concept_id = b.concept_id WHERE a.id = '".$ID."' ORDER BY b.concept, a.priority";
		$MENU = $this->selectCacheRecord($sql);
		$menuString = "";
		if($MENU){
			$menuString .= "<ul>";
			foreach($MENU as $concept) {
				if($concept['displayname']) $disp = $concept['displayname']; else $disp = $concept['concept'];
				$menuString .= "<li><a href=\"".HTTPPATH."/index.php?ID=".$ID."&p=".$concept['concept']."\">".$disp."</a></li>";
			}
			$menuString .= "</ul>";
		}
		return $menuString;	
	}
	
	public function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")  {
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		
		switch ($theType) {
		case "text":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;    
		case "long":
		case "int":
		  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
		  break;
		case "double":
		  $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
		  break;
		case "date":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;
		case "defined":
		  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
		  break;
		}
		return $theValue;
	}
	
	public function editFormAction() {
		$editFormAction = $_SERVER['PHP_SELF'];
		if (isset($_SERVER['QUERY_STRING'])) {
		  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
		}
		return $editFormAction;
	}
	public function getId() {
		$sql = "select id from prebuilt_1 WHERE default_id = 1";
		$result = $this->selectCacheRecord($sql);
		if($result[0]) {
			$ID = $result[0]['id'];
		} else {
			$sql = "select id from prebuilt_1 limit 1";
			$result = $this->selectCacheRecord($sql);
			$ID = $result[0]['id'];
		}
		return $ID;
	}
	// thumbnail
	public function getThumbnailSize($ex_width, $ex_height, $maxheight=80, $maxwidth=80) {
		if($ex_width >= $ex_height){  
			if($ex_width > $maxwidth){   
				$ds_width_ex  = $maxwidth;   
				$ratio_ex     = $ex_width / $ds_width_ex;  
				$ds_height_ex = $ex_height / $ratio_ex;
				$ds_height_ex = round($ds_height_ex);  
				if($ds_height_ex > $maxheight)
					$ds_height_ex = $maxheight;    
			} else {   
				$ds_width_ex  = $ex_width;
				$ds_height_ex = $ex_height;   
				if($ds_height_ex > $maxheight)
					$ds_height_ex = $maxheight;    
			}  
		} else if($ex_width < $ex_height){  
			if($ex_height > $maxheight){  
				$ds_height_ex = $maxheight;
				$ratio_ex     = $ex_height / $ds_height_ex;
				$ds_width_ex  = $ex_width / $ratio_ex;
				$ds_width_ex  = round($ds_width_ex);  
				if($ds_width_ex > $maxwidth)
					$ds_width_ex = $maxwidth;   
			} else {   
				$ds_width_ex  = $ex_width;
				$ds_height_ex = $ex_height; 
				if($ds_width_ex > $maxwidth)
					$ds_width_ex = $maxwidth;   
			}  
		}  
		$size['width'] = $ds_width_ex;
		$size['height'] = $ds_height_ex;
		return $size;
	}
	public function buildThumbnail($url, $maxheight, $maxwidth, $format, $dest) {
		$format = strtolower($format);
		list($ex_width, $ex_height) = getimagesize($url);
		$size = $this->getThumbnailSize($ex_width, $ex_height, $maxheight, $maxwidth);
	
		// create a black image
		$image_p = @imagecreatetruecolor($size['width'], $size['height']);
		// create white background
		$background = @imagecolorallocate($image_p, 255, 255, 255);
		// create rectangle with backgournd white
		@imagefilledrectangle($image_p, 0, 0, $size['width'], $size['height'], $background);
	
		if($format=="png") {
			$image = @imagecreatefrompng($url);
		} else if($format=="jpg") {
			$image = @imagecreatefromjpeg($url);	
		} else if($format=="gif") {
			$image = @imagecreatefromgif($url);	
		}
	
		@imagecopyresampled($image_p, $image, 0, 0, 0, 0, $size['width'], $size['height'], $ex_width, $ex_height);
		if($format=="png") {
			//header('Content-Type: image/png');
			@imagepng($image_p, $dest);
		} else if($format=="jpg") {
			//header('Content-Type: image/jpeg');
			@imagejpeg($image_p, $dest);
		} else if($format=="gif") {
			//header('Content-Type: image/gif');
			@imagegif($image_p, $dest);
		}
		@imagedestroy($image_p);
	}
	public function buildThumbnailWithoutResize($url, $maxheight, $maxwidth, $format, $dest) {
		$format = strtolower($format);
		list($ex_width, $ex_height) = getimagesize($url);
		//$size = $this->getThumbnailSize($ex_width, $ex_height, $maxheight, $maxwidth);
		$size['width'] = $maxwidth;
		$size['height'] = $maxheight;
		// create a black image
		$image_p = @imagecreatetruecolor($size['width'], $size['height']);
		// create white background
		$background = @imagecolorallocate($image_p, 255, 255, 255);
		// create rectangle with backgournd white
		imagefilledrectangle($image_p, 0, 0, $size['width'], $size['height'], $background);
	
		if($format=="png") {
			$image = @imagecreatefrompng($url);
		} else if($format=="jpg") {
			$image = @imagecreatefromjpeg($url);	
		} else if($format=="gif") {
			$image = @imagecreatefromgif($url);	
		}
	
		@imagecopyresampled($image_p, $image, 0, 0, 0, 0, $size['width'], $size['height'], $ex_width, $ex_height);
		if($format=="png") {
			//header('Content-Type: image/png');
			@imagepng($image_p, $dest);
		} else if($format=="jpg") {
			//header('Content-Type: image/jpeg');
			@imagejpeg($image_p, $dest);
		} else if($format=="gif") {
			//header('Content-Type: image/gif');
			@imagegif($image_p, $dest);
		}
		@imagedestroy($image_p);
	}
	public function getMenu($concept) {
		ob_start();
		include(DOCPATH."/includes/menu/".$concept.".php");
		$string = ob_get_clean();
		return $string;
	}
	public function validate($post, $validate) {
		if($validate) {
			foreach($validate as $valid) {
				if($valid['type']=="isreq") {
					if(!trim($post[$valid['field']])) {
						throw new Exception($valid['error']);
					}
				}
			}
		}
		return true;
	}
	public function getCountrySelBoxName($sel='') {
		$sql = "select * from geo_countries order by name";
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$selbox .= "<option value='".$arr['name']."'";
			if($sel==$arr['name']) {
				$selbox .= " selected";
			}
			$selbox .= ">".$arr['name']."</option>
			";
		}
		return $selbox;
	}
	public function getCountrySelBoxID($sel='') {
		$sql = "select * from geo_countries order by name";
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$selbox .= "<option value='".$arr['con_id']."'";
			if($sel==$arr['con_id']) {
				$selbox .= " selected";
			}
			$selbox .= ">".$arr['name']."</option>
			";
		}
		return $selbox;
	}
}
?>