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
		$sql = "select * from albums where user_id = '".$user_id."' and id = '".ID."' and file_type = '".$type."' order by album";
		$sqlCnt = "select count(*) as cnt from albums where user_id = '".$user_id."' and id = '".ID."' and file_type = '".$type."'";
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
	
	public function getAlbumSelbox($type, $user_id, $sel='') {		
		$sql = "select * from albums where user_id = '".$user_id."' and id = '".ID."' and file_type = '".$type."' order by album";
		$records = $this->Common->selectRecord($sql);
		if($records) {
			foreach($records as $record) {
				$selbox .= "<option value='".$record['album_id']."'";
				if($record['album_id']==$sel) {
					$selbox .= " selected";
				}
				$selbox .= ">".$record['album']."</option>
				";
			}
		}
		return $selbox;
	}
	
	public function uploadImage($files, $post, $user_id) {
		$record['user_id'] = $user_id;
		$record['album_id'] = $post['album_id'];
		$record['ip']  = $_SERVER['REMOTE_ADDR'];		
		$record['created'] = date('Y-m-d H:i:s');
		foreach($files as $file){
			if ($file->upload['error']) {
				continue;
			}
			$file->setName("uniq");
			
			$real = $file->getProp("real");
			$ext = $file->getProp("ext");
			$size = $file->getProp("size");
			$filetype = $file->getProp("type");
			$name = $file->getProp("name");
			$folder = substr($real, 0, 2);
			// creating path			
			if(!is_dir(DOCPATH."/photoalbum/uploadDir/".$folder)) {
				mkdir(DOCPATH."/photoalbum/uploadDir/".$folder, 0777);
				chmod(DOCPATH."/photoalbum/uploadDir/".$folder, 0777);
			}	
			if(!is_dir(DOCPATH."/photoalbum/uploadDir/".$folder."/user_".$record['user_id'])) {
				mkdir(DOCPATH."/photoalbum/uploadDir/".$folder."/user_".$record['user_id'], 0777);
				chmod(DOCPATH."/photoalbum/uploadDir/".$folder."/user_".$record['user_id'], 0777);
			}	
			$path = DOCPATH."/photoalbum/uploadDir/".$folder."/user_".$record['user_id']."/normal";
			if(!is_dir($path)) {
				mkdir($path, 0777);
				chmod($path, 0777);
			}	
			$thumbmed = DOCPATH."/photoalbum/uploadDir/".$folder."/user_".$record['user_id']."/medium";
			if(!is_dir($thumbmed)) {
				mkdir($thumbmed, 0777);
				chmod($thumbmed, 0777);
			}	
			$thumbsm = DOCPATH."/photoalbum/uploadDir/".$folder."/user_".$record['user_id']."/small";
			if(!is_dir($thumbsm)) {
				mkdir($thumbsm, 0777);
				chmod($thumbsm, 0777);
			}			
			$record['filepath']  = $folder."/user_".$record['user_id'];	
			$record['hosttype'] = 'Image';
			$record['id'] = ID;				
			$dest_name = $file->moveTo($path);
			if (PEAR::isError($dest_name)) {
				throw new Exception($dest_name->getMessage());	
			}
			$inValidExtensions = array('jpg','gif','png');
			
			if(in_array($ext, $inValidExtensions)) {	
				// create thumbnail and store
				$record['filename']  = $name;
				$record['filerealname']  = $real;
				$record['filesize']  = $size;
				$record['fileext']  = $ext;
				$record['filetype']  = $filetype;
				$uid = $this->Common->phpinsert('files', 'file_id', $record);
				// create thumbnail and store
				$this->Common->buildThumbnail($path."/".$name, 450, 450, $format=$ext, $thumbmed."/".$name);
				$this->Common->buildThumbnail($path."/".$name, 100, 100, $format=$ext, $thumbsm."/".$name);
				
				$success = 1;
			}
		}
		
		unset($_SESSION['checksum']);
		$return['success'] = $success;
		return $return;
	}
}
?>