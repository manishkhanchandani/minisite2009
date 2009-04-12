<?php
class table {
	public $cacheSecs = 300;
	
	public function __construct($dbFrameWork) {
		$this->dbFrameWork = $dbFrameWork;
	}	
	
	public function getRecords($sql, $start, $max, $cache=1) {
		if($cache==1) {
			$rsCnt = $this->dbFrameWork->CacheExecute($this->cacheSecs,$sql); 
		} else {
			$rsCnt = $this->dbFrameWork->Execute($sql); 
		}
		$total = $rsCnt->RecordCount();
		$return['total'] = $total;
		if(!$max) $max = 1000;
		if(!$start) $start = 0;
		if($cache==1) {
			$rs = $this->dbFrameWork->CacheSelectLimit($this->cacheSecs,$sql,$max,$start);
		} else {
			$rs = $this->dbFrameWork->SelectLimit($sql,$max,$start);
		}
		$num = $rs->RecordCount();
		if($num) {
			while($rec = $rs->FetchRow()) {
				$return['records'][] = $rec;
			}
		}
		$this->returnRecords = $return;
		return $return;
	}
	
	public function pagination($start, $page, $max, $totalRows, $currentPage, $qstring) {
		$totalPages = ceil($totalRows/$max);
		$string = "<div id='pagination'>";
		$string .= '<p class="showrecord">Records '.($start + 1).' to '.min($start + $max, $totalRows).' of '.$totalRows.'</p>';
		if ($totalPages > 1) { // Show if not first page
			$string .= '<p class="pages">';
			for($i=0;$i<$totalPages;$i++) {
				if($page==$i) {
					$class = "selected";
					$string .= "<span class='$class'>".($i+1)."</span> ";
				} else {
					$class = "normal";
					$string .= "<span class='$class'><a href='".$currentPage."/page/".$i."/max/".$max."/".$qstring."'>".($i+1)."</a></span> ";
				}				
			}
			$string .= '</p>';
		}
		$next = $page+1;
		$prev = $page-1;
		if($next>=$totalPages) $next = 0;
		if($prev<0) $prev = $totalPages-1;
		$this->nextPage = $next;
		$this->currPage = $page;
		$this->prevPage = $prev;
		return $string;
	}
	
	public function paginationAjax($start, $page, $max, $totalRows, $currentPage, $qstring, $div) {
		$totalPages = ceil($totalRows/$max);
		$string = "<div id='pagination'>";
		$string .= '<p class="showrecord">Records '.($start + 1).' to '.min($start + $max, $totalRows).' of '.$totalRows.'</p>';
		if ($totalPages > 1) { // Show if not first page
			$string .= '<p class="pages">';
			for($i=0;$i<$totalPages;$i++) {
				if($page==$i) {
					$class = "selected";
					$string .= "<span class='$class'>".($i+1)."</span> ";
				} else {
					$class = "normal";
					$string .= "<span class='$class'><a href='javascript:;' onClick=\"doAjaxLoadingText('".$currentPage."/page/".$i."/max/".$max."/".$qstring."','GET','','','".$div."','yes','0','');\">".($i+1)."</a></span> ";
				}				
			}
			$string .= '</p>';
		}
		$next = $page+1;
		$prev = $page-1;
		if($next>=$totalPages) $next = 0;
		if($prev<0) $prev = $totalPages-1;
		$this->nextPage = $next;
		$this->currPage = $page;
		$this->prevPage = $prev;
		return $string;
	}
	
	public function display_table_fields($table_name) {
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs,"select * from ".$table_name);
		$iterator = $rs->_fieldobjects;
		foreach($iterator as $k => $v) {
			$field[] = $v->name;
		}
		$this->field = $field;
		$this->fieldArray = $iterator;
		return $field;
	}
	
	public function insert($table_name, $pk, $postarray) {
		$register_arr = array();
		$register_arr = $this->display_table_fields($table_name);
		$sql = "insert into ".$table_name."(".$pk.")values('')";
		$rs = $this->dbFrameWork->Execute($sql);
		$uid = $this->dbFrameWork->Insert_ID();
		$query = "update ".$table_name." set ";
		foreach($postarray as $key=>$value) {
			if(gettype($value)=="array") {
				$string = '';
				foreach($value as $val) {
					if(strlen($val)>0) { 
						$val = addslashes(stripslashes(trim($val)));
						$string .= $val.'|';
					}
				}
				$string = substr($string,0,-1);
				if(in_array($key,$register_arr)) {
					$query .= $key."='".$string."',"; 
				}
			} else {
				if(in_array($key,$register_arr)) {
					$value = addslashes(stripslashes(trim($value)));
					$query .= $key."='".$value."',";
				}
			}
		}
		$query = substr($query,0,-1);
		$query .= " where ".$pk." = '".$uid."'";
		$result = $this->dbFrameWork->Execute($query);
		$this->uid = $uid;
		return $uid;
	}
	
	public function edit($table_name, $pk, $postarray, $uid) {
		$register_arr = array();
		$register_arr = $this->display_table_fields($table_name);
		$query = "update ".$table_name." set ";
		foreach($postarray as $key=>$value) {
			if(gettype($value)=="array") {
				$string = '';
				foreach($value as $val) {
					if(strlen($val)>0) { 
						$val = addslashes(stripslashes(trim($val)));
						$string .= $val.'|';
					}
				}
				$string = substr($string,0,-1);
				if(in_array($key,$register_arr)) {
					$query .= $key."='".$string."',"; 
				}
			} else {
				if(in_array($key,$register_arr)) {
					$value = addslashes(stripslashes(trim($value)));
					$query .= $key."='".$value."',";
				}
			}
		}
		$query = substr($query,0,-1);
		$query .= " where ".$pk." = '".$uid."'";
		$result = $this->dbFrameWork->Execute($query);
		return $uid;
	}
	public function modifiedInsert($table_name, $pk, $record) {
		$sql = "SELECT * FROM $table_name WHERE $pk = -1";  
		# Select an empty record from the database 
		$rs = $this->dbFrameWork->Execute($sql); # Execute the query and get the empty recordset 
		
		# Pass the empty recordset and the array containing the data to insert 
		# into the GetInsertSQL function. The function will process the data and return 
		# a fully formatted insert sql statement. 
		$insertSQL = $this->dbFrameWork->GetInsertSQL($rs, $record);
		$this->dbFrameWork->Execute($insertSQL); 
		$uid = $this->dbFrameWork->Insert_ID();
		return $uid;
	}
	public function modifiedEdit($table_name, $pk, $record, $uid) {
		$sql = "SELECT * FROM `$table_name` WHERE `$pk` = $uid";  
		# Select a record to update 
		$rs = $this->dbFrameWork->Execute($sql); // Execute the query and get the existing record to update 
		# Pass the single record recordset and the array containing the data to update 
		# into the GetUpdateSQL function. The function will process the data and return 
		# a fully formatted update sql statement with the correct WHERE clause. 
		# If the data has not changed, no recordset is returned 

		$updateSQL = $this->dbFrameWork->GetUpdateSQL($rs, $record); # Update the record in the database
		if($updateSQL) {
			$return = $this->dbFrameWork->Execute($updateSQL); 		
		}
	}
	public function delete($table, $pk, $id) {
		$sql = "delete from $table where $pk = '".addslashes(stripslashes(trim($id)))."'";
		$return = $this->dbFrameWork->Execute($sql);
		return true;
	}
	public function deleteImages($imagepath) {
		if(file_exists($imagepath)) {
			unlink($imagepath);
		}
		return true;
	}
	
	public function deleteFiles($filepath) {
		if(file_exists($filepath)) {
			unlink($filepath);
		}
		return true;
	}
	
	public function emailvalidity($email) {
		if (eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$', $email)) {
			// this is a valid email domain!
			return 1;
		} else {
			// this email domain doesn't exist! bad dog! no biscuit!
			return 0;
		}
	}
	
	public function insertPoints($uid, $points) {		
		$sql = "insert into mo_usersettings set user_id = '".$uid."', points = '".$points."'";
		$rsPoints = $this->dbFrameWork->Execute($sql);
		return true;
	}
	
	public function updatePoints($uid, $points) {		
		$sql = "update mo_usersettings set points = points + ".$points." where user_id = '".$uid."'";
		$rsPoints = $this->dbFrameWork->Execute($sql);
		return true;
	}
	
	public function getPoints($uid) {		
		$sql = "select * from mo_usersettings where user_id = '".$uid."'";
		$rs = $this->dbFrameWork->CacheExecute(60,$sql); 
		$rec = $rs->FetchRow();
		return $rec;
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
	
	public function updateStatus($status, $uid) {
		$sql = "update mo_users set status = '".$status."' where user_id = '".$uid."'";
		$rs = $this->dbFrameWork->Execute($sql);
		return true;
	}
	public function updateLastLogin($uid) {
		$sql = "update mo_users set last_login_dt = '".date('Y-m-d H:i:s')."' where user_id = '".$uid."'";
		$rs = $this->dbFrameWork->Execute($sql);
		return true;
	}
	public function validateTags($tags) {
		if(!$tags) {
			return 0;
		} else {
			$tagArr = explode(",",$tags);
			if(count($tagArr)>5) {
				return 4; // 4 indicates that tag count is more than 5
			}
			$this->tags = $tagArr;
			foreach($tagArr as $v) {
				if(trim($v)) {
					if(strlen($v)>=4&&strlen($v)<=40) {
						
					} else {
						return 3; // 3 denotes that atleast one tag is less than 4 or greater than 40
					}
				} else {
					return 2; // 2 denotes that one tag is empty
				}
			}
		}
		return 1; // 1 denotes everything is fine
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
}
?>