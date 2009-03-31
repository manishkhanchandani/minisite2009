<?php require_once('../Connections/conn.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

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
  $insertSQL = sprintf("INSERT INTO templates (template, js, css, templatename) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['template'], "text"),
                       GetSQLValueString($_POST['js'], "text"),
                       GetSQLValueString($_POST['css'], "text"),
                       GetSQLValueString($_POST['templatename'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE templates SET template=%s, js=%s, css=%s, templatename=%s WHERE template_id=%s",
                       GetSQLValueString($_POST['template'], "text"),
                       GetSQLValueString($_POST['js'], "text"),
                       GetSQLValueString($_POST['css'], "text"),
                       GetSQLValueString($_POST['templatename'], "text"),
                       GetSQLValueString($_POST['template_id'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

if ((isset($_GET['did'])) && ($_GET['did'] != "")) {
  $deleteSQL = sprintf("DELETE FROM templates WHERE template_id=%s",
                       GetSQLValueString($_GET['did'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());
}

$maxRows_rsView = 10;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT template_id, templatename FROM templates";
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);

if (isset($_GET['totalRows_rsView'])) {
  $totalRows_rsView = $_GET['totalRows_rsView'];
} else {
  $all_rsView = mysql_query($query_rsView);
  $totalRows_rsView = mysql_num_rows($all_rsView);
}
$totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;

$colname_rsEdit = "-1";
if (isset($_GET['template_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['template_id'] : addslashes($_GET['template_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM templates WHERE template_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

$queryString_rsView = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView") == false && 
        stristr($param, "totalRows_rsView") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/superadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Super Administration :: Template Management</title>
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
<h1>Template Creation</h1>
<p><a href="templates.php">Add New</a> | <a href="templates.php?view=1">View Templates</a> | <a href="sites.php">Sites Management</a></p>
<?php if(!($_GET['view']||$_GET['template_id'])) { ?>
<h3>Add New Template  </h3>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" onsubmit="MM_validateForm('templatename','','R');return document.MM_returnValue">
      <table>
        <tr valign="baseline">
          <td nowrap align="right">Name:</td>
          <td><input type="text" name="templatename" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top">Template:</td>
          <td><textarea name="template" cols="50" rows="5"></textarea>          </td>
        </tr>

        <tr valign="baseline">
          <td nowrap align="right" valign="top">Js:</td>
          <td><textarea name="js" cols="50" rows="5"></textarea>          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top">Css:</td>
          <td><textarea name="css" cols="50" rows="5"></textarea>          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
<?php } ?>
<?php if(!$_GET['template_id']) { ?>
      <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
        <h3>View Templates    </h3>
        <table border="1" cellpadding="5" cellspacing="0">
          <tr>
            <td><strong>Template Id </strong></td>
            <td><strong>Template Name </strong></td>
            <td><strong>Preview</strong></td>
            <td><strong>Edit</strong></td>
            <td><strong>Delete</strong></td>
          </tr>
          <?php do { ?>
                <tr>
                  <td><?php echo $row_rsView['template_id']; ?></td>
                  <td><?php echo $row_rsView['templatename']; ?></td>
                  <td><a href="template_preview.php?template_id=<?php echo $row_rsView['template_id']; ?>" target="_blank">Preview</a></td>
                  <td><a href="templates.php?template_id=<?php echo $row_rsView['template_id']; ?>">Edit</a></td>
                  <td><a href="templates.php?did=<?php echo $row_rsView['template_id']; ?>">Delete</a></td>
                </tr>
                <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
      </table>
        <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></p>
      <table border="0" width="50%" align="center">
            <tr>
              <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                          <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                          <?php } // Show if not first page ?>                      </td>
              <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                          <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                          <?php } // Show if not first page ?>                      </td>
              <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                          <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                          <?php } // Show if not last page ?>                      </td>
              <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                          <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                          <?php } // Show if not last page ?>                      </td>
            </tr>
      </table>
        <?php } // Show if recordset not empty ?>
<?php } ?>
    <?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
      <h3>Edit Templates</h3>
      <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
        <table>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap">Name:</td>
            <td><input type="text" name="templatename" value="<?php echo $row_rsEdit['templatename']; ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right" valign="top">Template:</td>
            <td><textarea name="template" cols="50" rows="5"><?php echo $row_rsEdit['template']; ?></textarea>          </td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right" valign="top"><p>&nbsp;</p>
            <p>Js:</p></td>
            <td><textarea name="js" cols="50" rows="5"><?php echo $row_rsEdit['js']; ?></textarea>          </td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right" valign="top">Css:</td>
            <td><textarea name="css" cols="50" rows="5"><?php echo $row_rsEdit['css']; ?></textarea>          </td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap">&nbsp;</td>
            <td><input type="submit" value="Update record"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form2">
        <input type="hidden" name="template_id" value="<?php echo $row_rsEdit['template_id']; ?>">
    </form>
      <?php } // Show if recordset not empty ?><p>&nbsp;</p>
    <p>&nbsp; </p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsEdit);
?>
