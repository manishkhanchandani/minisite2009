<?php require_once('../Connections/conn.php'); ?>
<?php
$colname_rsPreview = "-1";
if (isset($_GET['tid'])) {
  $colname_rsPreview = (get_magic_quotes_gpc()) ? $_GET['tid'] : addslashes($_GET['tid']);
}
mysql_select_db($database_conn, $conn);
$query_rsPreview = sprintf("SELECT * FROM prebuilt_templates WHERE tid = %s", $colname_rsPreview);
$rsPreview = mysql_query($query_rsPreview, $conn) or die(mysql_error());
$row_rsPreview = mysql_fetch_assoc($rsPreview);
$totalRows_rsPreview = mysql_num_rows($rsPreview);
?>
<?php
$body = explode("[[BODY]]", $row_rsPreview['template']);
$head = stripslashes($body[0]);
$foot = stripslashes($body[1]);
$css = stripslashes($row_rsPreview['css']);
$js = stripslashes($row_rsPreview['js']);
$id = stripslashes($row_rsPreview['tid']);
@file_put_contents("uploadDir/".$id."_head.php", $head);
@file_put_contents("uploadDir/".$id."_foot.php", $foot);
@file_put_contents("uploadDir/".$id."_css.css", $css);
@file_put_contents("uploadDir/".$id."_js.js", $js);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Title comes here</title>
<link href="uploadDir/<?php echo $row_rsPreview['tid']; ?>_css.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="uploadDir/<?php echo $row_rsPreview['tid']; ?>_js.js"></script>
</head>

<body>
<?php 
include('uploadDir/'.$row_rsPreview['tid'].'_head.php');
?>
content comes here
<?php
include('uploadDir/'.$row_rsPreview['tid'].'_foot.php');
?>
</body>
</html>
<?php
mysql_free_result($rsPreview);
?>
