<?php
$table = new table($dbFrameWork);
$cache = 1;
if($_POST['MM_Insert'] && $_SESSION['checksum']==$_POST['checksum']) {
	$record['user_id']  = $_POST['user_id'];
	$record['category_id']  = $_POST['category_id'];
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
			unset($_SESSION['checksum']);
			$cache = 0;
		} else {
			$error .= "<p class='error'>File type should be jpg, gif or png.</p>";
			unset($_POST['MM_Insert']);
		}
	}
	$error = $error1.$error;
	mail("naveenkhanchandani@gmail.com",SITENAME.": new file uploaded", SITENAME.": new file uploaded with multiple upload feature", "From:system<".SITEEMAIL.">");
}
$_SESSION['checksum'] = md5(time());
?>
<table width="100%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
	<td class="topSmallHead">Multiple Image Upload</td>
  </tr>
  <tr>
	<td><?php include($CONFIG['dirPath'].'/filehost/menu.php'); ?></td>
  </tr>
  <tr>
	<td>

<script src="<?php echo $CONFIG['httpPath']; ?>/libs/jquery/jquery-latest.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo $CONFIG['httpPath']; ?>/libs/jquery/jquery.MetaData.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo $CONFIG['httpPath']; ?>/libs/jquery/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo $CONFIG['httpPath']; ?>/libs/jquery/jquery.blockUI.js" type="text/javascript" language="javascript"></script>
<form action="" method="post" enctype="multipart/form-data" class="P10">
	<?php echo $error; ?>
	<input type="file" class="multi" />
	<input type="submit" name="submit" value="submit">
    <br>
    Allowed extensions: gif, png and jpg.
	<input name="user_id" type="hidden" id="user_id" value="<?php if($_SESSION['user_id']) echo $_SESSION['user_id']; else echo 0; ?>"> 
	<input name="MM_Insert" type="hidden" id="MM_Insert" value="1">
	<input name="checksum" type="hidden" id="checksum" value="<?php echo $_SESSION['checksum']; ?>">
</form>
	</td>
  </tr>
</table>