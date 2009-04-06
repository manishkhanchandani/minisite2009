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
			$error .= "<p class='error'>File Uploaded Successfully. Following are the details of your uploaded image:</p><br>";
			$error .= "Image Url:<a href='".$CONFIG['httpPath']."/imagehost/images/".$name."' target='_blank'>".$CONFIG['httpPath']."/imagehost/images/".$name."</a> <br>Thumbnail (450x450) Url:<a href='".$CONFIG['httpPath']."/imagehost/images450x450/".$name."' target='_blank'>".$CONFIG['httpPath']."/imagehost/images450x450/".$name."</a> <br>Thumbnail (70x70) Url:<a href='".$CONFIG['httpPath']."/imagehost/images70x70/".$name."' target='_blank'>".$CONFIG['httpPath']."/imagehost/images70x70/".$name."</a><br><br>";
			unset($_SESSION['checksum']);
			mail("naveenkhanchandani@gmail.com",SITENAME.": new image uploaded", SITENAME.": new image uploaded with id: ".$uid, "From:system<".SITEEMAIL.">");
			$cache = 0;
		} else {
			$error .= "<p class='error'>File type should be jpg, gif or png.</p>";
			unset($_POST['MM_Insert']);
		}
	}
}
$_SESSION['checksum'] = md5(time());
?>
<table width="100%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
	<td class="topSmallHead">Image Upload</td>
  </tr>
  <tr>
	<td><?php include($CONFIG['dirPath'].'/imagehost/menu.php'); ?></td>
  </tr>
  <tr>
	<td><form action="" method="post" enctype="multipart/form-data" name="form1">
	<?php echo $error; ?>
	    <input name="userfile[]" type="file" id="userfile[]" size="40">
	    <input type="submit" name="Submit" value="Upload"> 
<input name="user_id" type="hidden" id="user_id" value="<?php if($_SESSION['user_id']) echo $_SESSION['user_id']; else echo 0; ?>"> 
<input name="MM_Insert" type="hidden" id="MM_Insert" value="1">
<input name="checksum" type="hidden" id="checksum" value="<?php echo $_SESSION['checksum']; ?>">
<br>
(Extensions allowed: png, jpg, gif)
<?php
if($_SESSION['status']>100) {
	?>
	<br />
	<a href="<?php echo $CONFIG['httpPath']."/imagehost/admin.".URLPATH; ?>">Admin</a>
	<?php
}
?>
        </form></td>
  </tr>
</table>
<br>
<?php
if($_SESSION['user_id']) {



$table = new table($dbFrameWork);
$max = 25; if($CONFIG['query']['max']) $max = $CONFIG['query']['max'];
$page = 0; if($CONFIG['query']['page']) $page = $CONFIG['query']['page'];
$start = $page*$max;
$qstring = "";
$currentPage = $CONFIG['httpPath']."/imagehost/index.".URLPATH;
$sql = "select * from mo_images WHERE user_id = '".$_SESSION['user_id']."' order by image_id desc";
if(is_numeric($CONFIG['query']['cache'])==2) {
	$cache = 0;
} else if(is_numeric($CONFIG['query']['cache'])==1) {
	$cache = 1;
} 
$images = $table->getRecords($sql, $start, $max, $cache);
$totalRows = $images['total'];
$pagination = $table->pagination($start, $page, $max, $totalRows, $currentPage, $qstring);
?>
<?php if($totalRows>0) { ?>
<table width="100%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
	<td class="topSmallHead">My Images</td>
  </tr>
  <tr>
	<td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
      <tr valign="top">
        <td><strong>Image</strong></td>
        <td><strong>Image Real Name </strong></td>
        <td><strong>Height</strong></td>
        <td><strong>Width</strong></td>
        <td><strong>Size</strong></td>
        <td><strong>Delete</strong></td>
      </tr>
	  <?php foreach($images['records'] as $key => $rsImage) { 
	  $qstring = "did/".$rsImage['image_id']."/";
	  ?>
      <tr valign="top">
        <td rowspan="2"><img src="<?php echo $CONFIG['httpPath']."/imagehost/images70x70/".$rsImage['image_name']; ?>"></td>
        <td><?php echo $rsImage['image_realname']; ?>&nbsp;</td>
        <td><?php echo $rsImage['image_height']; ?>&nbsp;</td>
        <td><?php echo $rsImage['image_width']; ?>&nbsp;</td>
        <td><?php echo $rsImage['image_size']; ?>&nbsp;</td>
        <td><a href="<?php echo $CONFIG['httpPath']."/imagehost/deleteuser.".URLPATH."/page/".$page."/max/".$max."/".$qstring; ?>" onClick="str=confirm('Do you really want to delete this image?'); if(str) return true; else return false;">Delete</a>&nbsp;</td>
      </tr>
      <tr valign="top">
        <td colspan="5"><?php echo $error = "Image Url:<a href='".$CONFIG['httpPath']."/imagehost/images/".$rsImage['image_name']."' target='_blank'>".$CONFIG['httpPath']."/imagehost/images/".$rsImage['image_name']."</a> <br>Thumbnail (450x450) Url:<a href='".$CONFIG['httpPath']."/imagehost/images450x450/".$rsImage['image_name']."' target='_blank'>".$CONFIG['httpPath']."/imagehost/images450x450/".$rsImage['image_name']."</a> <br>Thumbnail (70x70) Url:<a href='".$CONFIG['httpPath']."/imagehost/images70x70/".$rsImage['image_name']."' target='_blank'>".$CONFIG['httpPath']."/imagehost/images70x70/".$rsImage['image_name']."</a>"; ?>&nbsp;</td>
        </tr>
	  <?php } ?>
    </table>
<?php echo $pagination; ?>

	</td>
  </tr>
</table>
<?php } else {
	
}
?>
<?php } ?>