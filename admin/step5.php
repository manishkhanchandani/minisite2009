<?php require_once('../Connections/conn.php'); ?>
<?php
ini_set('memory_limit','500M');
ini_set('max_execution_time','-1'); 
include ('Archive/Zip.php');        // imports
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $up = "UPDATE prebuilt_1 SET default_id = 0";
  mysql_select_db($database_conn, $conn);
  mysql_query($up) or die(mysql_error());
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE prebuilt_1 SET default_id=%s, siteurl=%s, sitename=%s, siteemail=%s, ftphost=%s, ftpuser=%s, ftppassword=%s, ftpdir=%s, dbhost=%s, db=%s, dbuser=%s, dbpassword=%s WHERE id=%s",
                       GetSQLValueString($_POST['default_id'], "int"),
                       GetSQLValueString($_POST['siteurl'], "text"),
                       GetSQLValueString($_POST['sitename'], "text"),
                       GetSQLValueString($_POST['siteemail'], "text"),
                       GetSQLValueString($_POST['ftphost'], "text"),
                       GetSQLValueString($_POST['ftpuser'], "text"),
                       GetSQLValueString($_POST['ftppassword'], "text"),
                       GetSQLValueString($_POST['ftpdir'], "text"),
                       GetSQLValueString($_POST['dbhost'], "text"),
                       GetSQLValueString($_POST['db'], "text"),
                       GetSQLValueString($_POST['dbuser'], "text"),
                       GetSQLValueString($_POST['dbpassword'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}
?>
<?php
$colname_rsKeyword = "-1";
if (isset($_GET['id'])) {
  $colname_rsKeyword = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsKeyword = sprintf("SELECT * FROM prebuilt_1 WHERE id = %s", $colname_rsKeyword);
$rsKeyword = mysql_query($query_rsKeyword, $conn) or die(mysql_error());
$row_rsKeyword = mysql_fetch_assoc($rsKeyword);
$totalRows_rsKeyword = mysql_num_rows($rsKeyword);
?>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$obj = new Archive_Zip('../'.$row_rsKeyword['id'].'.zip'); // name of zip file
	echo 'creating db tables<br>';
	$data = '<?php
include("../Connections/conn.php");

';
$qRy[] = "CREATE DATABASE IF NOT EXISTS `".$row_rsKeyword['db']."`";
$qRy[] = "USE `".$row_rsKeyword['db']."`";
	$sql = "SHOW TABLES FROM ".$database_conn;
	$rst = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_row($rst)) {
		$tbls[] = $row[0];
		echo '. ';
		flush();
	}
	if($tbls) {
		foreach($tbls as $tbl) {
			$qRy[] = "drop table `".$tbl."`";
			$query = "show create table `".$tbl."`";
			mysql_select_db($database_conn, $conn) or die('could not select db');
			$rs = mysql_query($query, $conn) or die('error'.mysql_error());
			$rect = mysql_fetch_array($rs);
			$qRy[] = $rect[1].";";
			
			$sql="select * from `".$tbl."`";
			mysql_select_db($database_conn, $conn) or die('could not select db');
			$result = mysql_query($sql, $conn) or die('error'.mysql_error());
			while($rec = mysql_fetch_array($result)) {
				$query = "insert into ".$tbl." set ";
				$i = 0;
				$subquery = '';
				while ($i < mysql_num_fields($result)) {
					$meta = mysql_fetch_field($result, $i);
					$subquery .= "`".$meta->name."`='".addslashes(stripslashes(trim($rec[$meta->name])))."', ";
					$i++;
				}
				$query = $query.substr($subquery,0,-2);
				$qRy[] = $query;
				echo '. ';
				flush();
			}	
		}
	}
	foreach($qRy as $v) {
		$data .= '$sql = "'.$v.'";
@mysql_query($sql);

';
	}
	$data .= '
header("Location: db2.php?ID='.$row_rsKeyword['id'].'");
exit;
?>';
	file_put_contents("../db.php", $data);
	echo "<br>";
	include('conn_start.php');
	// check connection
	$ftp = ftp_connect($row_rsKeyword['ftphost']);
	if($ftp) {
		if(@ftp_login($ftp,$row_rsKeyword['ftpuser'],$row_rsKeyword['ftppassword'])) {
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
	flush();
	if($done == 1) {
		if(!$row_rsKeyword['ftpdir']) $d=ftp_pwd($ftp); else $d = $row_rsKeyword['ftpdir'];	
		if ($d=="/") $d="";	
		//echo "Path is ".$d."<br>";	
		if (!@ftp_chdir($ftp,$d)) {
			//echo "<p>Can't enter that folder!</p>"; 
		} else {
			require_once("RecursiveSearch.php");
			$directory = "../".$dirs;
			
			// uploading folders and files
			$search = new RecursiveSearch($directory);
			
			//print_r($search);
			if($search->folders) {
				foreach($search->folders as $folder) {
					if(eregi(".svn", $folder)) {
						continue;
					}				
					if(eregi("_mmServerScripts", $folder)) {
						continue;
					}
					//static $j=0;$j++;
					//echo $j.". ";
					//echo $folder."<br>";
					$explodefolder = explode("/", $folder);
					if($explodefolder) {
						$newDir = $d."/";
						foreach($explodefolder as $direc) {
							//echo "Directory is ".$direc;
							//echo "<br>";
							$newDir .= $direc."/";
							if(@ftp_mkdir($ftp, $newDir)) {
								//echo "created successfully<br>";
							} else {
								//echo "already created<br>";
							}
							if($direc=="templates_c") {
								if(ftp_chmod($ftp, 0777, $newDir) !== false) {
									//echo "$newDir chmoded successfully to 777<br>";
								} else {
									//echo "could not chmod $newDir<br>";
								}
							}
							if($direc=="ADODB_cache") {
								if(ftp_chmod($ftp, 0777, $newDir) !== false) {
									//echo "$newDir chmoded successfully to 777<br>";
								} else {
									//echo "could not chmod $newDir<br>";
								}
							}
							if($direc=="cache") {
								if(ftp_chmod($ftp, 0777, $newDir) !== false) {
									//echo "$newDir chmoded successfully to 777<br>";
								} else {
									//echo "could not chmod $newDir<br>";
								}
							}
							if($direc=="tmp") {
								if(ftp_chmod($ftp, 0777, $newDir) !== false) {
									//echo "$newDir chmoded successfully to 777<br>";
								} else {
									//echo "could not chmod $newDir<br>";
								}
							}
							//echo "<br>";
							echo '. ';
							flush();
						}
					}
				}
			}
			echo "<br>";
			if($search->files) {
				foreach($search->files as $file) {		
					$file = str_replace("..//", "../", $file);	
					if(eregi(".svn", $file)) {
						continue;
					}
					if(eregi("_mmServerScripts", $file)) {
						continue;
					}
					$files[] = $file;
				}
			}
			if ($obj->create($files)) {
				echo "Uploading the files. Please wait....<br><img src='../images/loading.gif'><br>";
				flush();
				if(!@ftp_put($ftp, "Zip.php", "../Zip.php", FTP_BINARY)) { 
					echo $error = "<font color=#ff0000><strong>FTP upload error for Zip.php</strong></font><br>"; 
				} else {
					echo "Zip.php uploaded succcessfully<br>";
				}
				flush();
				if(!@ftp_put($ftp, "unzip.php", "../unzip.php", FTP_BINARY)) { 
					echo $error = "<font color=#ff0000><strong>FTP upload error for unzip.php</strong></font><br>"; 
				} else {
					echo "unzip.php uploaded succcessfully<br>";
				}
				flush();
				if(!@ftp_put($ftp, "db.php", "../db.php", FTP_BINARY)) { 
					echo $error = "<font color=#ff0000><strong>FTP upload error for db.php</strong></font><br>"; 
				} else {
					echo "db.php uploaded succcessfully<br>";
				}
				flush();
				if(!@ftp_put($ftp, "db2.php", "../db2.php", FTP_BINARY)) { 
					echo $error = "<font color=#ff0000><strong>FTP upload error for db2.php</strong></font><br>"; 
				} else {
					echo "db2.php uploaded succcessfully<br>";
				}
				flush();
				if(!@ftp_put($ftp, "index.php", "../config.php", FTP_BINARY)) { 
					echo $error = "<font color=#ff0000><strong>FTP upload error for config.php</strong></font><br>"; 
				} else {
					echo "index.php uploaded succcessfully<br>";
				}
				flush();
				if(!@ftp_put($ftp, "index.php", "../index.php", FTP_BINARY)) { 
					echo $error = "<font color=#ff0000><strong>FTP upload error for index.php</strong></font><br>"; 
				} else {
					echo "index.php uploaded succcessfully<br>";
				}
				flush();
				if(!@ftp_put($ftp, $row_rsKeyword['id'].".zip", "../".$row_rsKeyword['id'].".zip", FTP_BINARY)) { 
					echo $error = "<font color=#ff0000><strong>FTP upload error for ".$row_rsKeyword['id'].".zip</strong></font><br>"; 
				} else {
					echo $row_rsKeyword['id'].".zip uploaded succcessfully<br>";
				}
				flush();
			} else {
				echo 'Error in file creation';
			}
			
			/*
			echo "<hr>";
			if($search->files) {
				foreach($search->files as $file) {	
					if(!@ftp_chdir($ftp, $d)) {
						echo "<p>Can't enter that folder! ($d)</p>"; 
						exit;
					}
					$file = str_replace("..//", "", $file);
					if(eregi(".svn", $file)) {
						continue;
					}
					if(eregi("_mmServerScripts", $file)) {
						continue;
					}
					static $i=0;$i++;
					echo $i.". ";
					echo $file."<br>";
					$basename = basename($file);
					$tmpDir = explode("/", $file);
					if($tmpDir) {
						$str = '';
						for($k=0;$k<(count($tmpDir)-1);$k++) {
							$str .= $tmpDir[$k]."/";
						}
						if($str) {
							if(!@ftp_chdir($ftp, $str)) {
								echo "<p>Can't enter that folder! ($str)</p>"; 
								exit;
							}
						}
						$s1 = filesize("../".$file);
						$s2 = ftp_size($ftp, $basename);
						echo $s1."/".$s2." (".$file.")";
						echo "<br>";
						if($s1!=$s2) {
							if(!@ftp_put($ftp, $basename, "../".$file, FTP_BINARY)) { 
								echo $error = "<font color=#ff0000><strong>FTP upload error for $file</strong></font><br>"; 
							} else {
								echo "$file uploaded succcessfully<br>";
							}
						}
					}
					//echo "<br>";
					
					echo '. ';
					flush();
				}
			}
			*/
		}
		include('conn_end.php');
		echo '<script language="javascript">
			location.href="'.$row_rsKeyword['siteurl'].'/unzip.php?ID='.$row_rsKeyword['id'].'";
		</script>'; 
		exit;
	}	
	include('conn_end.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Step 5: Publish</title>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<h1>Step 5: Set FTP and DB Details for &quot;<?php echo $row_rsKeyword['keyword']; ?>&quot;</h1>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1" onsubmit="MM_validateForm('siteurl','','R','sitename','','R','siteemail','','RisEmail','ftphost','','R','ftpuser','','R','dbhost','','R','db','','R','dbuser','','R','ftppassword','','R');return document.MM_returnValue">
  <table border="1" cellpadding="5" cellspacing="1">
    <tr>
      <th align="right">Siteurl:</th>
      <td><input name="siteurl" type="text" id="siteurl" value="<?php echo $row_rsKeyword['siteurl']; ?>" maxlength="200" /></td>
    </tr>
    <tr>
      <th align="right">Sitename:</th>
      <td><input name="sitename" type="text" id="sitename" value="<?php echo $row_rsKeyword['sitename']; ?>" maxlength="200" /></td>
    </tr>
    <tr>
      <th align="right">Site Email: </th>
      <td><input name="siteemail" type="text" id="siteemail" value="<?php echo $row_rsKeyword['siteemail']; ?>" maxlength="150" /></td>
    </tr>
    <tr>
      <th align="right">Site FTP Host: </th>
      <td><input name="ftphost" type="text" id="ftphost" value="<?php echo $row_rsKeyword['ftphost']; ?>" maxlength="255" /></td>
    </tr>
    <tr>
      <th align="right">Site FTP User: </th>
      <td><input name="ftpuser" type="text" id="ftpuser" value="<?php echo $row_rsKeyword['ftpuser']; ?>" maxlength="255" /></td>
    </tr>
    <tr>
      <th align="right">Site FTP Password: </th>
      <td><input name="ftppassword" type="password" id="ftppassword" value="<?php echo $row_rsKeyword['ftppassword']; ?>" maxlength="255" /></td>
    </tr>
    <tr>
      <th align="right">Site FTP Dir: </th>
      <td><input name="ftpdir" type="text" id="ftpdir" value="<?php echo $row_rsKeyword['ftpdir']; ?>" maxlength="255" /></td>
    </tr>
    <tr>
      <th align="right">Mysql Host: </th>
      <td><input name="dbhost" type="text" id="dbhost" value="<?php echo $row_rsKeyword['dbhost']; ?>" /></td>
    </tr>
    <tr>
      <th align="right">Mysql DB: </th>
      <td><input name="db" type="text" id="db" value="<?php echo $row_rsKeyword['db']; ?>" /></td>
    </tr>
    <tr>
      <th align="right">Mysql User: </th>
      <td><input name="dbuser" type="text" id="dbuser" value="<?php echo $row_rsKeyword['dbuser']; ?>" maxlength="255" /></td>
    </tr>
    <tr>
      <th align="right">Mysql Password: </th>
      <td><input name="dbpassword" type="password" id="dbpassword" value="<?php echo $row_rsKeyword['dbpassword']; ?>" maxlength="255" /></td>
    </tr>
    <tr>
      <th colspan="2" align="right"><input type="submit" name="Submit" value="Publish" />
        <input name="Submit222" type="button" onclick="MM_goToURL('parent','step4.php?id=<?php echo $_GET['id']; ?>');return document.MM_returnValue" value="Go To Step 4" />
        <input name="Submit22" type="button" onclick="MM_goToURL('parent','step3.php?id=<?php echo $_GET['id']; ?>');return document.MM_returnValue" value="Go To Step 3" />
        <input name="Submit2" type="button" onclick="MM_goToURL('parent','step2.php?id=<?php echo $_GET['id']; ?>');return document.MM_returnValue" value="Go To Step 2" />
        <input name="Submit3" type="button" onclick="MM_goToURL('parent','step1.php');return document.MM_returnValue" value="Go To Step 1" />
<a href="../index.php?ID=<?php echo $row_rsKeyword['id']; ?>" target="_blank">Preview</a>
        <input name="id" type="hidden" id="id" value="<?php echo $row_rsKeyword['id']; ?>" />
      <input name="default_id" type="hidden" id="default_id" value="1" /></th>
    </tr>
  </table>
  
    <input type="hidden" name="MM_update" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsKeyword);
?>
