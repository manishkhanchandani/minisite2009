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
		$validImagesExtension = array('jpg', 'gif', 'png', 'JPG', 'GIF', 'PNG');
		if(in_array($ext, $validImagesExtension)) {	
			// create thumbnail and store
			$table->buildThumbnail($CONFIG['dirPath']."/imagehost/images/".$name, 450, 450, $format=$ext, $CONFIG['dirPath']."/imagehost/images450x450/".$name);
			$table->buildThumbnail($CONFIG['dirPath']."/imagehost/images/".$name, 70, 70, $format=$ext, $CONFIG['dirPath']."/imagehost/images70x70/".$name);
			
			$record['image_name']  = $name;
			$record['image_realname']  = $real;
			$record['image_size']  = $size;
			$record['image_ext']  = $ext;
			$record['image_filetype']  = $filetype;
			list($width, $height, $type, $attr) = getimagesize($CONFIG['dirPath']."/imagehost/images/".$name);
			$record['image_height']  = $width;
			$record['image_width']  = $height;
			$uid = $table->modifiedInsert("mo_images", "image_id", $record);
			if($_SESSION['user_id']) {
				// update points
				$table->updatePoints($_SESSION['user_id'], 3);
				$userSettings = $table->getPoints($_SESSION['user_id']);
				$_SESSION['userPoints'] = $userSettings['points'];
			}
			$cache = 0;
		} else {
		
		}
	}
	mail("naveenkhanchandani@gmail.com",SITENAME.": new image uploaded", SITENAME.": new image uploaded with drag and drop upload feature", "From:system<".SITEEMAIL.">");
}
?>