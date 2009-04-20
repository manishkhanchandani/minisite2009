<?php require_once('../Connections/conn.php'); ?>
<?php
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
  $updateSQL = sprintf("UPDATE prebuilt_1 SET default_id=%s, siteurl=%s, sitename=%s, siteemail=%s WHERE id=%s",
                       GetSQLValueString($_POST['default_id'], "int"),
                       GetSQLValueString($_POST['siteurl'], "text"),
                       GetSQLValueString($_POST['sitename'], "text"),
                       GetSQLValueString($_POST['siteemail'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
  
  $updateGoTo = "step6.php";
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
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1" onsubmit="MM_validateForm('siteurl','','R','sitename','','R','siteemail','','RisEmail');return document.MM_returnValue">
  <table border="1" cellpadding="5" cellspacing="1">
    <tr>
      <th align="right">Siteurl:</th>
      <td><input name="siteurl" type="text" id="siteurl" value="<?php echo $row_rsKeyword['siteurl']; ?>" maxlength="200" /></td>
    </tr>
    <tr>
      <th align="right">Sitename:</th>
      <td><input name="sitename" type="text" id="sitename" value="<?php echo $row_rsKeyword['keyword']; ?>" maxlength="200" /></td>
    </tr>
    <tr>
      <th align="right">Site Email: </th>
      <td><input name="siteemail" type="text" id="siteemail" value="<?php echo $row_rsKeyword['siteemail']; ?>" maxlength="150" /></td>
    </tr>
    <tr>
      <th colspan="2" align="right"><input type="submit" name="Submit" value="Go To Step 6" />
        <input name="Submit222" type="button" onclick="MM_goToURL('parent','step4.php?id=<?php echo $_GET['id']; ?>');return document.MM_returnValue" value="Go To Step 4" />
        <input name="Submit22" type="button" onclick="MM_goToURL('parent','step3.php?id=<?php echo $_GET['id']; ?>');return document.MM_returnValue" value="Go To Step 3" />
        <input name="Submit2" type="button" onclick="MM_goToURL('parent','step2.php?id=<?php echo $_GET['id']; ?>');return document.MM_returnValue" value="Go To Step 2" />
        <input name="Submit3" type="button" onclick="MM_goToURL('parent','step1.php');return document.MM_returnValue" value="Go To Step 1" />
<a href="../index.php?ID=<?php echo $row_rsKeyword['id']; ?>" target="_blank"></a>
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
