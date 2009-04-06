<?php
$table = new table($dbFrameWork);
$cache = 1;
if($_POST) {
	$record['user_id']  = $_SESSION['user_id'];
	$record['category_id']  = 0;
	$record['ip']  = $_SERVER['REMOTE_ADDR'];
	$record['caption']  = "";
	
	require_once('HTTP/Upload.php');
	$upload = new HTTP_Upload("en");
	$files = $upload->getFiles();
	foreach($files as $file){
		if ($file->upload['error']) {
			continue;
			$error .= "<p class='error'>".$file->getMessage()."</p>";
			unset($_POST['MM_Insert']);
			continue;
		}
		$file->setName("uniq");
		$dest_name = $file->moveTo($CONFIG['dirPath']."/imagehost/images");
		if (PEAR::isError($dest_name)) {
			$error .= "<p class='error'>".$dest_name->getMessage()."</p>";
			unset($_POST['MM_Insert']);
			continue;
		}
		$real = $file->getProp("real");
		$ext = $file->getProp("ext");
		$size = $file->getProp("size");
		$filetype = $file->getProp("type");
		$name = $file->getProp("name");
		$validImagesExtension = array('php', 'html', 'htm', 'pl', 'cgi', 'mumbai');
		if(!in_array($ext, $validImagesExtension)) {	
			$error1 = "<p class='error'>File Uploaded Successfully. Following are the details of your uploaded file:</p><br>";
			// create thumbnail and store
			$record['file_name']  = $name;
			$record['file_realname']  = $real;
			$record['file_size']  = $size;
			$record['file_ext']  = $ext;
			$record['filetype']  = $filetype;
			$uid = $table->modifiedInsert("mo_files", "file_id", $record);
			if($_SESSION['user_id']) {
				// update points
				$table->updatePoints($_SESSION['user_id'], 3);
				$userSettings = $table->getPoints($_SESSION['user_id']);
				$_SESSION['userPoints'] = $userSettings['points'];
			}
			$error .= "File Location: <a href='".$CONFIG['httpPath']."/filehost/download.php?filename=".urlencode($real)."&file=files/".$name."'>".$real."</a> <br>".$CONFIG['httpPath']."/filehost/download.php?filename=".urlencode($real)."&file=files/".$name."<br><br>";
			$cache = 0;
		} else {
		
		}
	}
	mail("naveenkhanchandani@gmail.com",SITENAME.": new image uploaded", SITENAME.": new image uploaded with drag and drop upload feature", "From:system<".SITEEMAIL.">");
}
?>