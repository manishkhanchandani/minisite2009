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
		$dest_name = $file->moveTo($CONFIG['dirPath']."/filehost/files");
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
			$error .= "<p class='error'>File Uploaded Successfully. Following are the details of your uploaded file:</p><br>";
			$error .= "File Location: <a href='".$CONFIG['httpPath']."/filehost/download.php?filename=".urlencode($real)."&file=files/".$name."'>".$real."</a> <br>".$CONFIG['httpPath']."/filehost/download.php?filename=".urlencode($real)."&file=files/".$name."<br><br>";
			unset($_SESSION['checksum']);
			mail("naveenkhanchandani@gmail.com",SITENAME.": new file uploaded", SITENAME.": new file uploaded with id: ".$uid, "From:system<".SITEEMAIL.">");
			$cache = 0;
		} else {
			$error .= "<p class='error'>File type should not be of php, html, htm, cgi, pl.</p>";
			unset($_POST['MM_Insert']);
		}
	}
}
$_SESSION['checksum'] = md5(time());
?>
<table width="100%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
	<td class="topSmallHead">File Hosting </td>
  </tr>
  <tr>
	<td><?php include($CONFIG['dirPath'].'/filehost/menu.php'); ?></td>
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
<?php
if($_SESSION['status']>100) {
	?>
	<br />
	<a href="<?php echo $CONFIG['httpPath']."/filehost/admin.".URLPATH; ?>">Admin</a>
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
$sql = "select * from mo_files WHERE user_id = '".$_SESSION['user_id']."' order by file_id desc";
if(is_numeric($CONFIG['query']['cache'])==2) {
	$cache = 0;
} else if(is_numeric($CONFIG['query']['cache'])==1) {
	$cache = 1;
} $cache = 0;
$files = $table->getRecords($sql, $start, $max, $cache);
$totalRows = $files['total'];
$pagination = $table->pagination($start, $page, $max, $totalRows, $currentPage, $qstring);
?>
<?php if($totalRows>0) { ?>
<table width="100%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
	<td class="topSmallHead">My Files </td>
  </tr>
  <tr>
	<td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
      <tr valign="top">
        <td><strong>File</strong></td>
        <td><strong>File Real Name </strong></td>
        <td><strong>Size</strong></td>
        <td><strong>Delete</strong></td>
      </tr>
	  <?php foreach($files['records'] as $key => $rsFile) { 
	  $qstring = "did/".$rsFile['file_id']."/";
	  ?>
      <tr valign="top">
        <td><?php echo "<a href='".$CONFIG['httpPath']."/filehost/download.php?filename=".urlencode($rsFile['file_realname'])."&file=files/".$rsFile['file_name']."'>Download</a>"; ?></td>
        <td><?php echo $rsFile['file_realname']; ?>&nbsp;</td>
        <td><?php echo $rsFile['file_size']; ?></td>
        <td><a href="<?php echo $CONFIG['httpPath']."/filehost/deleteuser.".URLPATH."/".$qstring; ?>" onClick="str=confirm('Do you really want to delete this file?'); if(str) return true; else return false;">Delete</a>&nbsp;</td>
      </tr>
      <tr valign="top">
        <td colspan="4">File Location: <?php echo $CONFIG['httpPath']."/filehost/download.php?filename=".urlencode($rsFile['file_realname'])."&file=files/".$rsFile['file_name']; ?></td>
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