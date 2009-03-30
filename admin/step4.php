<?php require_once('../Connections/conn.php'); ?>
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
  $updateSQL = sprintf("UPDATE prebuilt_1 SET template=%s, css=%s, js=%s WHERE id=%s",
                       GetSQLValueString($_POST['template'], "text"),
                       GetSQLValueString($_POST['css'], "text"),
                       GetSQLValueString($_POST['js'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}
?>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$body = explode("[[BODY]]", $_POST['template']);
	$head = stripslashes($body[0]);
	$foot = stripslashes($body[1]);
	$css = stripslashes($_POST['css']);
	$js = stripslashes($_POST['js']);
	$id = stripslashes($_POST['id']);
	@file_put_contents("../includes/sitetemplate/".$id."_head.php", $head);
	@file_put_contents("../includes/sitetemplate/".$id."_foot.php", $foot);
	@file_put_contents("../includes/sitetemplate/".$id."_css.css", $css);
	@file_put_contents("../includes/sitetemplate/".$id."_js.js", $js);
	
  $updateGoTo = "step5.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
  exit;
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>Step4: Choosing Templates for &quot;<?php echo $row_rsKeyword['keyword']; ?>&quot;</h1>
<form id="form1" name="form1" method="POST" action="">
  <table border="1" cellspacing="1" cellpadding="5">
    <tr>
      <td valign="top">PreTemplate</td>
      <td valign="top"><select name="pretemplate" id="pretemplate">
      </select>
        <a href="#">Template Management </a></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Template</td>
      <td valign="top"><textarea name="template" cols="45" rows="10" id="template"><?php echo $row_rsKeyword['template']; ?></textarea></td>
      <td valign="top">Sperate Header and Footer Area by [[BODY]]<br />
        Menu Should contain [[NEWS]] for news link, [[BLOG]] for blog link, etc. </td>
    </tr>
    <tr>
      <td valign="top">CSS</td>
      <td valign="top"><textarea name="css" cols="45" rows="10" id="css"><?php echo $row_rsKeyword['css']; ?></textarea></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">JS</td>
      <td valign="top"><textarea name="js" cols="45" rows="10" id="js"><?php echo $row_rsKeyword['js']; ?></textarea></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top"><input type="submit" name="Submit" value="Go To Step 5" />
      <input name="id" type="hidden" id="id" value="<?php echo $row_rsKeyword['id']; ?>" /></td>
      <td valign="top">&nbsp;</td>
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
