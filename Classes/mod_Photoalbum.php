<?php
class mod_Photoalbum {
	
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
		return true;
	}
	
	public function validate($post) {
		if(!trim($post['album'])) {
			throw new Exception('please insert album. ');
		}
		return true;
	}
	public function getOneElement($id, $user_id) {
		$sql = "select * from albums where album_id = '".$id."' and user_id = '".$user_id."' and id = '".ID."'";
		$rs = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		$edit = $rs->FetchRow();
		return $edit;
	}
	
	public function getAllAlbum($type, $user_id, $max, $start) {		
		$sql = "select * from albums where user_id = '".$_SESSION['user_id']."' and id = '".ID."' and file_type = '".$type."' order by album";
		$sqlCnt = "select count(*) as cnt from albums where user_id = '".$_SESSION['user_id']."' and id = '".ID."' and file_type = '".$type."'";
		$records = $this->Common->selectLimitRecordFull($sql, $sqlCnt, $max, $start);
		return $records;
	}
	
	public function deleteAlbum($did, $user_id, $hosttype) {
		$sql = "delete from albums where id = '".ID."' and album_id = '".$did."' and user_id = '".$user_id."' and file_type = '".$hosttype."'";
		$this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
	}
}
?>