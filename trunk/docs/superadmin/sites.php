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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO sites (sitename, siteurl, siteemail, ftphost, ftpuser, ftppass, ftpdir, db_user, db_pass, db_host, db_database, site_description, template_id, language_id, DOCPATH, HTTPPATH, FOLDER) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['sitename'], "text"),
                       GetSQLValueString($_POST['siteurl'], "text"),
                       GetSQLValueString($_POST['siteemail'], "text"),
                       GetSQLValueString($_POST['ftphost'], "text"),
                       GetSQLValueString($_POST['ftpuser'], "text"),
                       GetSQLValueString($_POST['ftppass'], "text"),
                       GetSQLValueString($_POST['ftpdir'], "text"),
                       GetSQLValueString($_POST['db_user'], "text"),
                       GetSQLValueString($_POST['db_pass'], "text"),
                       GetSQLValueString($_POST['db_host'], "text"),
                       GetSQLValueString($_POST['db_database'], "text"),
                       GetSQLValueString($_POST['site_description'], "text"),
                       GetSQLValueString($_POST['template_id'], "int"),
                       GetSQLValueString($_POST['language_id'], "int"),
                       GetSQLValueString($_POST['DOCPATH'], "text"),
                       GetSQLValueString($_POST['HTTPPATH'], "text"),
                       GetSQLValueString($_POST['FOLDER'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE sites SET sitename=%s, siteurl=%s, siteemail=%s, ftphost=%s, ftpuser=%s, ftppass=%s, ftpdir=%s, db_user=%s, db_pass=%s, db_host=%s, db_database=%s, site_description=%s, template_id=%s, DOCPATH=%s, HTTPPATH=%s, FOLDER=%s WHERE site_id=%s",
                       GetSQLValueString($_POST['sitename'], "text"),
                       GetSQLValueString($_POST['siteurl'], "text"),
                       GetSQLValueString($_POST['siteemail'], "text"),
                       GetSQLValueString($_POST['ftphost'], "text"),
                       GetSQLValueString($_POST['ftpuser'], "text"),
                       GetSQLValueString($_POST['ftppass'], "text"),
                       GetSQLValueString($_POST['ftpdir'], "text"),
                       GetSQLValueString($_POST['db_user'], "text"),
                       GetSQLValueString($_POST['db_pass'], "text"),
                       GetSQLValueString($_POST['db_host'], "text"),
                       GetSQLValueString($_POST['db_database'], "text"),
                       GetSQLValueString($_POST['site_description'], "text"),
                       GetSQLValueString($_POST['template_id'], "int"),
                       GetSQLValueString($_POST['DOCPATH'], "text"),
                       GetSQLValueString($_POST['HTTPPATH'], "text"),
                       GetSQLValueString($_POST['FOLDER'], "text"),
                       GetSQLValueString($_POST['site_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM sites";
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$colname_rsEdit = "-1";
if (isset($_GET['site_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['site_id'] : addslashes($_GET['site_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM sites WHERE site_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

mysql_select_db($database_conn, $conn);
$query_rsTemplate = "SELECT template_id, templatename FROM templates ORDER BY templatename ASC";
$rsTemplate = mysql_query($query_rsTemplate, $conn) or die(mysql_error());
$row_rsTemplate = mysql_fetch_assoc($rsTemplate);
$totalRows_rsTemplate = mysql_num_rows($rsTemplate);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/superadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Site Management</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->


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

function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
//-->
</script>
<!-- InstanceEndEditable -->
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
<h1>Sites </h1>
<p><a href="templates.php">Templates</a> | <a href="sites.php">Sites Management</a> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" onsubmit="MM_validateForm('sitename','','R');return document.MM_returnValue">
  <table>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Sitename:</strong></td>
      <td><input type="text" name="sitename" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Siteurl:</strong></td>
      <td><input type="text" name="siteurl" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Siteemail:</strong></td>
      <td><input type="text" name="siteemail" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Ftphost:</strong></td>
      <td><input type="text" name="ftphost" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Ftpuser:</strong></td>
      <td><input type="text" name="ftpuser" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Ftppass:</strong></td>
      <td><input type="password" name="ftppass" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Ftpdir:</strong></td>
      <td><input type="text" name="ftpdir" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>DB Host: </strong></td>
      <td><input name="db_host" type="text" id="db_host" value="remote-mysql4.servage.net" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>DB User: </strong></td>
      <td><input name="db_user" type="text" id="db_user" value="masterpiece" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>DB Password: </strong></td>
      <td><input name="db_pass" type="password" id="db_pass" value="password123" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>DB Database: </strong></td>
      <td><input name="db_database" type="text" id="db_database" value="masterpiece" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Site_description:</strong></td>
      <td><textarea name="site_description" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Templates</strong></td>
      <td><select name="template_id" id="template_id">
        <option value="0">Select</option>
        <?php
do {  
?>
        <option value="<?php echo $row_rsTemplate['template_id']?>"><?php echo $row_rsTemplate['templatename']?></option>
        <?php
} while ($row_rsTemplate = mysql_fetch_assoc($rsTemplate));
  $rows = mysql_num_rows($rsTemplate);
  if($rows > 0) {
      mysql_data_seek($rsTemplate, 0);
	  $row_rsTemplate = mysql_fetch_assoc($rsTemplate);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>HTTP Path: </strong></td>
      <td><input name="HTTPPATH" type="text" id="HTTPPATH" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Doc Path: </strong></td>
      <td><input name="DOCPATH" type="text" id="DOCPATH" value="/home37b/sub004/sc29722-KLXJ/" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Folder:</strong></td>
      <td><input name="FOLDER" type="text" id="FOLDER" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="language_id" value="0">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
  <h3>View Sites </h3>
  <table border="1">
    <tr>
      <td><strong>sitename</strong></td>
      <td><strong>ftphost</strong></td>
      <td><strong>ftpuser</strong></td>
      <td><strong>ftppass</strong></td>
      <td><strong>ftpdir</strong></td>
      <td><strong>FTP</strong></td>
      <td><strong>DB</strong></td>
      <td><strong>Edit</strong></td>
      <td><strong>Delete</strong></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsView['sitename']; ?></td>
        <td><?php echo $row_rsView['ftphost']; ?></td>
        <td><?php echo $row_rsView['ftpuser']; ?></td>
        <td>****</td>
        <td><?php echo $row_rsView['ftpdir']; ?></td>
        <td><a href="ftp.php?site_id=<?php echo $row_rsView['site_id']; ?>">FTP</a></td>
        <td><a href="db.php?site_id=<?php echo $row_rsView['site_id']; ?>">DB</a></td>
        <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?site_id=<?php echo $row_rsView['site_id']; ?>#edit">Edit</a></td>
        <td><a href="#" onclick="GP_popupConfirmMsg('Under Construction');return document.MM_returnValue">Delete</a></td>
      </tr>
      <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
    <h3>Edit Sites<a name="edit" id="edit"></a></h3>
    <form id="form2" name="form2" method="POST" action="<?php echo $editFormAction; ?>">
      <table>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Sitename:</strong></td>
          <td><input name="sitename" type="text" id="sitename" value="<?php echo $row_rsEdit['sitename']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Siteurl:</strong></td>
          <td><input name="siteurl" type="text" id="siteurl" value="<?php echo $row_rsEdit['siteurl']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Siteemail:</strong></td>
          <td><input name="siteemail" type="text" id="siteemail" value="<?php echo $row_rsEdit['siteemail']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Ftphost:</strong></td>
          <td><input name="ftphost" type="text" id="ftphost" value="<?php echo $row_rsEdit['ftphost']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Ftpuser:</strong></td>
          <td><input name="ftpuser" type="text" id="ftpuser" value="<?php echo $row_rsEdit['ftpuser']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Ftppass:</strong></td>
          <td><input name="ftppass" type="password" id="ftppass" value="<?php echo $row_rsEdit['ftppass']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Ftpdir:</strong></td>
          <td><input name="ftpdir" type="text" id="ftpdir" value="<?php echo $row_rsEdit['ftpdir']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" valign="top"><strong>DB Host: </strong></td>
          <td><input name="db_host" type="text" id="db_host" value="<?php echo $row_rsEdit['db_host']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" valign="top"><strong>DB User: </strong></td>
          <td><input name="db_user" type="text" id="db_user" value="<?php echo $row_rsEdit['db_user']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" valign="top"><strong>DB Password: </strong></td>
          <td><input name="db_pass" type="password" id="db_pass" value="<?php echo $row_rsEdit['db_pass']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" valign="top"><strong>DB Database: </strong></td>
          <td><input name="db_database" type="text" id="db_database" value="<?php echo $row_rsEdit['db_database']; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" valign="top"><strong>Site_description:</strong></td>
          <td><textarea name="site_description" cols="50" rows="5" id="site_description"><?php echo $row_rsEdit['site_description']; ?></textarea>            </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Templates</strong></td>
          <td><select name="template_id" id="template_id">
            <option value="0" <?php if (!(strcmp(0, $row_rsEdit['template_id']))) {echo "selected=\"selected\"";} ?>>Select</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsTemplate['template_id']?>"<?php if (!(strcmp($row_rsTemplate['template_id'], $row_rsEdit['template_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsTemplate['templatename']?></option>
<?php
} while ($row_rsTemplate = mysql_fetch_assoc($rsTemplate));
  $rows = mysql_num_rows($rsTemplate);
  if($rows > 0) {
      mysql_data_seek($rsTemplate, 0);
	  $row_rsTemplate = mysql_fetch_assoc($rsTemplate);
  }
?>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>HTTP Path: </strong></td>
          <td><input name="HTTPPATH" type="text" id="HTTPPATH" value="<?php echo $row_rsEdit['HTTPPATH']; ?>" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Doc Path: </strong></td>
          <td><input name="DOCPATH" type="text" id="DOCPATH" value="<?php echo $row_rsEdit['DOCPATH']; ?>" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><strong>Folder:</strong></td>
          <td><input name="FOLDER" type="text" id="FOLDER" value="<?php echo $row_rsEdit['FOLDER']; ?>" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input name="submit" type="submit" value="Update" />
          <input name="site_id" type="hidden" id="site_id" value="<?php echo $row_rsEdit['site_id']; ?>" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form2">
  </form>
    <?php } // Show if recordset not empty ?><p>&nbsp; </p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsEdit);

mysql_free_result($rsTemplate);
?>
