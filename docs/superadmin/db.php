<?php require_once('../Connections/conn.php'); ?>
<?php
ini_set("max_execution_time",-1);
ini_set("memory_limit","200M");
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
	$conn2 = mysql_connect($row_rsSite['db_host'], $row_rsSite['db_user'], $row_rsSite['db_pass']) or die('could not connect');
	if($_POST['tables']) {
		foreach($_POST['tables'] as $tbl) {
			$query = "show create table `".$tbl."`";
			mysql_select_db($database_conn, $conn) or die('could not select db');
			$rs = mysql_query($query, $conn) or die('error'.mysql_error());
			$rec = mysql_fetch_array($rs);
			$struct = $rec[1];
			mysql_select_db($row_rsSite['db_database'], $conn2) or die('could not select db');
			$query = "DROP TABLE `".$tbl."`";
			@mysql_query($query, $conn2);
			@mysql_query($struct, $conn2);
			
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
				mysql_select_db($row_rsSite['db_database'], $conn2) or die('could not select db');
				@mysql_query($query, $conn2);
			}			 			
		}
	}
	$errorMessage = "DB updated successfully";
	$sql = "update sites set `tables` = '".addslashes(stripslashes(trim(serialize($_POST['tables']))))."', site_id = '".$_POST['site_id']."' WHERE site_id = '".$_POST['site_id']."'";
	mysql_select_db($database_conn, $conn) or die('could not select db');
	mysql_query($sql, $conn) or die(mysql_error());
	echo '<script language="javascript">location.href="'.$_SERVER['PHP_SELF'].'?site_id='.$_GET['site_id'].'&errorMessage='.urlencode($errorMessage).'";</script>';
} else {
	$errorMessage = $_GET['errorMessage'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/superadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Database details</title>
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
<h1>DB of site &quot;<a href="<?php echo $row_rsSite['siteurl']; ?>" target="_blank"><?php echo $row_rsSite['sitename']; ?></a>&quot;</h1>
<p><a href="sites.php">Back</a></p>
<form id="form1" name="form1" method="post" action="">
<?php if($errorMessage) echo "<p class=\"error\">".$errorMessage."</p>"; ?>
  <p>Choose the tables to be exported to the site:</p>
  <p>
    <?php
$rs = mysql_list_tables($database_conn, $conn);
if($rs) {
$tables = unserialize($row_rsSite['tables']);
if(!$tables) $tables = array();
	while($rec = mysql_fetch_array($rs)) {
	?>
<input type="checkbox" name="tables[]" value="<?php echo $rec[0]; ?>"<?php if(in_array($rec[0], $tables)) echo ' checked'; ?> /> <?php echo $rec[0]; ?><br />
	<?php
	}
	
}
?>
			
</p>
  <p>
    <input type="submit" name="Submit" value="Create Tables on Server" />
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
