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
  $updateSQL = sprintf("UPDATE prebuilt_1 SET smsusername=%s, smspassword=%s, twilio_account_sid=%s, twilio_auth_token=%s, twilio_caller_id=%s WHERE id=%s",
                       GetSQLValueString($_POST['smsusername'], "text"),
                       GetSQLValueString($_POST['smspassword'], "text"),
                       GetSQLValueString($_POST['twilio_account_sid'], "text"),
                       GetSQLValueString($_POST['twilio_auth_token'], "text"),
                       GetSQLValueString($_POST['twilio_caller_id'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "step1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsEdit = "-1";
if (isset($_GET['id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM prebuilt_1 WHERE id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Settings</title>

<style type="text/css">
<!--
body,td,th,textarea,select,input,button {
	font-family: Verdana;
	font-size: 11px;
}
-->
</style>
</head>

<body>
<h1>Settings</h1>
<p><a href="step1.php">Back To Step 1</a>  </p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr valign="baseline">
      <td nowrap align="right">Smsusername:</td>
      <td><input type="text" name="smsusername" value="<?php echo $row_rsEdit['smsusername']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Smspassword:</td>
      <td><input type="password" name="smspassword" value="<?php echo $row_rsEdit['smspassword']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Twilio_account_sid:</td>
      <td><input type="text" name="twilio_account_sid" value="<?php echo $row_rsEdit['twilio_account_sid']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Twilio_auth_token:</td>
      <td><input type="text" name="twilio_auth_token" value="<?php echo $row_rsEdit['twilio_auth_token']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Twilio_caller_id:</td>
      <td><input type="text" name="twilio_caller_id" value="<?php echo $row_rsEdit['twilio_caller_id']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_rsEdit['id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsEdit);
?>
