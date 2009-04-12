<?php require_once('../../Connections/conn.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1") && $_POST['auction_setting_id']) {
  echo $updateSQL = sprintf("UPDATE auction_settings SET id=%s, charity=%s WHERE auction_setting_id=%s",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString(isset($_POST['charity']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['auction_setting_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
  header("Location: index.php");
  exit;
} else if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1") && !$_POST['auction_setting_id']) {
  $updateSQL = sprintf("INSERT INTO auction_settings SET id=%s, charity=%s",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString(isset($_POST['charity']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
  header("Location: index.php");
  exit;
}

$colname_rsSettings = "-1";
if (isset($_GET['id'])) {
  $colname_rsSettings = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsSettings = sprintf("SELECT * FROM auction_settings WHERE id = %s", $colname_rsSettings);
$rsSettings = mysql_query($query_rsSettings, $conn) or die(mysql_error());
$row_rsSettings = mysql_fetch_assoc($rsSettings);
$totalRows_rsSettings = mysql_num_rows($rsSettings);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
<!--
body, td, th, p, div, select, input, button, submit {
	font-family: Verdana;
	font-size: 11px;
}
-->
</style>
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<h1>Administrator Settings</h1>
<h3>Auction Settings </h3>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr valign="baseline">
      <td nowrap align="right">Charity:</td>
      <td><input type="checkbox" name="charity" value="1"  <?php if (!(strcmp($row_rsSettings['charity'],1))) {echo "checked";} ?>></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="auction_setting_id" value="<?php echo $row_rsSettings['auction_setting_id']; ?>">
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsSettings);
?>
