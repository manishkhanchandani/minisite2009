<?php
class mod_Filehost {
	
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
	public function uploadFile($files, $post, $user_id) {
		$record['user_id'] = $user_id;
		$record['ip']  = $_SERVER['REMOTE_ADDR'];		
		$record['created'] = date('Y-m-d H:i:s');	
		$record['ref']  = $_SESSION['ref'];	
		foreach($files as $file){
			if ($file->upload['error']) {
				throw new Exception($file->getMessage());
			}
			$file->setName("uniq");
			
			$real = $file->getProp("real");
			$ext = $file->getProp("ext");
			$size = $file->getProp("size");
			$filetype = $file->getProp("type");
			$name = $file->getProp("name");
			
			// creating path
			$path = DOCPATH."/filehost/uploadDir";
			$firsttwo = substr($real, 0, 2);
			$path = $path."/".$firsttwo;
			if(!is_dir($path)) {
				mkdir($path, 0777);
				chmod($path, 0777);
			}
			$path = $path."/user_".$record['user_id'];
			if(!is_dir($path)) {
				mkdir($path, 0777);
				chmod($path, 0777);
			}			
			$record['filepath']  = $firsttwo."/user_".$record['user_id'];	
			$record['hosttype'] = 'File';		
			$record['id'] = $post['id'];	
			if(!$record['id']) $record['id'] = ID;				
			$dest_name = $file->moveTo($path);
			if (PEAR::isError($dest_name)) {
				throw new Exception($dest_name->getMessage());	
			}
			$inValidExtensions = array('php', 'html', 'htm', 'pl', 'cgi');
			if(!in_array($ext, $inValidExtensions)) {	
				// create thumbnail and store
				$record['filename']  = $name;
				$record['filerealname']  = $real;
				$record['filesize']  = $size;
				$record['fileext']  = $ext;
				$record['filetype']  = $filetype;
				$uid = $this->Common->phpinsert('files', 'file_id', $record);
				$filehostlinks .= "File Location: <a href='".HTTPPATH."/filehost/download.php?fid=".$uid."'>".$real."</a>, or Copy the following link:<br>";
				$filehostlinks .= HTTPPATH."/filehost/download.php?fid=".$uid."<br><br>";
				unset($_SESSION['checksum']);
				$success = 1;
			} else {
				throw new Exception("File type should not be of php, html, htm, cgi, pl.");	
			}
		}
		
		$return['success'] = $success;
		$return['filehostlinks'] = $filehostlinks;
		return $return;
	}
}
?>