<?php require_once('../Connections/conn.php'); ?>
<?php
ini_set('memory_limit','500M');
ini_set('max_execution_time','-1'); 
?>
<?php
$colname_rsSite = "-1";
if (isset($_GET['site_id'])) {
  $colname_rsSite = (get_magic_quotes_gpc()) ? $_GET['site_id'] : addslashes($_GET['site_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsSite = sprintf("SELECT * FROM sites WHERE site_id = %s", $colname_rsSite);
$rsSite = mysql_query($query_rsSite, $conn) or die(mysql_error());
$row_rsSite = mysql_fetch_assoc($rsSite);
$totalRows_rsSite = mysql_num_rows($rsSite);
?>
<?php
if($_POST['MM_Insert']==1) {
	$ftp = ftp_connect($row_rsSite['ftphost']);
	if($ftp) {
		if(@ftp_login($ftp,$row_rsSite['ftpuser'],$row_rsSite['ftppass'])) {
			$done = 1;
			echo 'Connected and login successfull.<br>';
		} else {
			@ftp_quit($ftp); 
			echo "<p>FTP Login Failed</p>";
		}
	} else {
		@ftp_quit($ftp); 
		echo "<p>FTP Login Failed</p>";
	}
	if($done == 1) {
		$sql = '';
		if(!$row_rsSite['ftpdir']) $d=ftp_pwd($ftp); else $d = $row_rsSite['ftpdir'];
		echo "Path is ".$d."<br>";
		if (!@ftp_chdir($ftp,$d)) {
			echo "<p>Can't enter that folder!</p>"; 
		} else {
			if ($d=="/") $d="";
			if(!@ftp_chdir($ftp, $d)) {
				echo "<p>Can't enter that folder! ($tmpDir)</p>"; 
				exit;
			}
			// htaccess creation
			$htaccess = 'php_value include_path ".:/usr/local/lib/php/:'.$row_rsSite['DOCPATH'].$row_rsSite['FOLDER'].'includes/:'.$row_rsSite['DOCPATH'].$row_rsSite['FOLDER'].'includes/pear/:'.$row_rsSite['DOCPATH'].$row_rsSite['FOLDER'].'Connections/"

#IndexIgnore *';
			$fp = fopen('../htaccesslin.txt', "w");
			fwrite($fp, $htaccess);
			fclose($fp);
			@ftp_put($ftp, ".htaccess", '../htaccesslin.txt', FTP_ASCII);
			// htaccess complete
			
			if($_POST['index']) {
				$sql .= "`index` = '".addslashes(stripslashes(trim($_POST['index'])))."', ";
				if(!@ftp_put($ftp, "index.php", "../".$_POST['index'], FTP_BINARY)) { 
					echo $error = "<font color=#ff0000><strong>FTP upload error for ".$_POST['index']."</strong></font><br>"; 
				} else {
					echo $_POST['index']." uploaded succcessfully<br>";
				}
			}
			require_once("RecursiveSearch.php");
			$files = array();
			if($_POST['dirs']) {
				include('connection.php');
				$sql .= "`files` = '".addslashes(stripslashes(trim(implode("\n", $_POST['dirs']))))."', ";
				foreach($_POST['dirs'] as $dirs) {
					$directory = "../".$dirs;
					$search = new RecursiveSearch($directory);
					$files = array_merge($files, $search->files);
				}			
				if($files) {
					foreach($files as $file) {
						$explode = explode("/", $file);
						if($explode) {
							$newDir = $d."/";
							$olddir = "../";
							foreach($explode as $direc) {
								if($direc=="..") continue;
								$olddir .= $direc;
								if(!is_dir($olddir)) {
									$tmpDir = $newDir;
									$newDir .= $direc;	
									if(!@ftp_chdir($ftp, $tmpDir)) {
										echo "<p>Can't enter that folder! ($tmpDir)</p>"; 
										exit;
									}
									if(!@ftp_put($ftp, $direc, $olddir, FTP_BINARY)) { 
										echo $error = "<font color=#ff0000><strong>FTP upload error for $newDir</strong></font><br>"; 
									} else {
										echo "$newDir uploaded succcessfully<br>";
									}
								} else {
									$newDir .= $direc."/";
									$olddir .= "/";
									echo $newDir."<br>";
									if(@ftp_mkdir($ftp, $newDir)) {
										echo "created successfully<br>";
									} else {
										echo "is not created<br>";
									}
								}
							}
						}
					}
				}				
				include('connections_end.php');
			}
		}
	}
	
	$sql = "update sites set ".$sql." site_id = '".$_POST['site_id']."' WHERE site_id = '".$_POST['site_id']."'";
	mysql_query($sql) or die(mysql_error());
	echo '<script language="javascript">location.href="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'";</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/superadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>FTP Details</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	font-family: Verdana;
	font-size: 11px;
}
-->
</style>
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<h1>FTP of site &quot;<a href="<?php echo $row_rsSite['siteurl']; ?>" target="_blank"><?php echo $row_rsSite['sitename']; ?></a>&quot;</h1>
<p><a href="sites.php">Back</a></p>
<form id="form1" name="form1" method="post" action="">
  <p><strong>Choose Main File which will be renamed as Index.php</strong></p>
  <p>
    <?php
$dirname = "../";
if ($handle = opendir($dirname)) {
	/* This is the correct way to loop over the directory. */
	while (false !== ($file = readdir($handle))) {
		$filetype = filetype($dirname."/".$file);
		if(!($file == "." || $file == ".." || is_dir("../".$file) || $file == ".htaccess" || eregi(".txt", $file))) {
			// anything
			?>
<input <?php if (!(strcmp($row_rsSite['index'],$file))) {echo "checked=\"checked\"";} ?> type="radio" name="index" value="<?php echo $file; ?>" /> 
<?php echo $file; ?>&nbsp;&nbsp;
			<?php
		}
	}
	closedir($handle);
}
?>
</p>
  <p><strong>Choose Folders: </strong></p>
  <p>
    <?php
$files = $row_rsSite['files'];
if($files) {
	$fileArr = explode("\n", $files);
} else {
	$fileArr = array();
}

$dirname = "../";
if ($handle = opendir($dirname)) {
	/* This is the correct way to loop over the directory. */
	while (false !== ($file = readdir($handle))) {
		$filetype = filetype($dirname."/".$file);
		if(!($file == "." || $file == "..") && is_dir("../".$file)) {
			// anything
			?>
<div style="float:left; width:150px;">
<input type="checkbox" name="dirs[]" value="<?php echo $file; ?>" <?php if(in_array($file, $fileArr)) echo ' checked'; ?> /> <?php echo $file; ?></div>
			<?php
		}
	}
	closedir($handle);
}
?>
</p>
<div style="clear:both;"></div>
  <p>
    <input type="submit" name="Submit" value="FTP the selected files" />
    <input name="MM_Insert" type="hidden" id="MM_Insert" value="1" />
    <input name="site_id" type="hidden" id="site_id" value="<?php echo $row_rsSite['site_id']; ?>" />
  </p>
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsSite);
?>
