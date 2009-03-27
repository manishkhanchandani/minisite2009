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
  $insertSQL = sprintf("INSERT INTO forms (form_name, category) VALUES (%s, %s)",
                       GetSQLValueString($_POST['form_name'], "text"),
                       GetSQLValueString($_POST['category'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "forms.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE forms SET form_name=%s, category=%s WHERE form_id=%s",
                       GetSQLValueString($_POST['form_name'], "text"),
                       GetSQLValueString($_POST['category'], "text"),
                       GetSQLValueString($_POST['form_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "forms.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$maxRows_rsView = 10;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM forms ORDER BY form_name ASC";
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
if (isset($_GET['form_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['form_id'] : addslashes($_GET['form_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM forms WHERE form_id = %s", $colname_rsEdit);
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Form Management</title>
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
</head>

<body>
<h1>Form Management</h1>
<p><a href="forms.php?view=1">View Form</a> | <a href="forms.php">Add Form</a> </p>
<?php if(!($_GET['view']==1 || $_GET['form_id'])) { ?>
<h3>Add Form</h3>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" onsubmit="MM_validateForm('form_name','','R');return document.MM_returnValue">
  <table>
    <tr valign="baseline">
      <td nowrap align="right">Form Name:</td>
      <td><input type="text" name="form_name" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Category Type: </td>
      <td><select name="category" id="category">
        <option value="None" selected="selected">None</option>
        <option value="Single">Single</option>
        <option value="Multiple">Multiple</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<?php } ?>
<?php if($_GET['view']==1) { ?>
  <h3>View Forms </h3>
<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
  <table border="1">
    <tr>
      <td><strong>Form ID </strong></td>
      <td><strong>Form Name </strong></td>
      <td><strong>Category Type </strong></td>
      <td><strong>Edit</strong></td>
      <td><strong>Fields</strong></td>
      <td><strong>Category</strong></td>
      <td><strong>Publish</strong></td>
      <td><strong>Delete</strong></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsView['form_id']; ?></td>
        <td><?php echo $row_rsView['form_name']; ?></td>
        <td><?php echo $row_rsView['category']; ?></td>
        <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?form_id=<?php echo $row_rsView['form_id']; ?>#edit">Edit</a></td>
        <td><a href="fields.php?form_id=<?php echo $row_rsView['form_id']; ?>&view=1">Fields</a></td>
        <td>Category</td>
        <td>Publish</td>
        <td>&nbsp;</td>
      </tr>
      <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
      </table>
  <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></p>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?>
  
  <?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
  <p>No Form Record Found.</p>
    <?php } // Show if recordset empty ?><?php } ?>
<?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
  <h3>Edit Forms<a name="edit" id="edit"></a></h3>
  <form action="<?php echo $editFormAction; ?>" method="POST" name="form2" id="form2" onsubmit="MM_validateForm('form_name','','R');return document.MM_returnValue">
    <table>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Form Name:</td>
        <td><input name="form_name" type="text" id="form_name" value="<?php echo $row_rsEdit['form_name']; ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Category Type: </td>
        <td><select name="category" id="category">
          <option value="None" <?php if (!(strcmp("None", $row_rsEdit['category']))) {echo "selected=\"selected\"";} ?>>None</option>
          <option value="Single" <?php if (!(strcmp("Single", $row_rsEdit['category']))) {echo "selected=\"selected\"";} ?>>Single</option>
<option value="Multiple" <?php if (!(strcmp("Multiple", $row_rsEdit['category']))) {echo "selected=\"selected\"";} ?>>Multiple</option>
          </select>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input name="submit" type="submit" value="Update" />
        <input name="form_id" type="hidden" id="form_id" value="<?php echo $row_rsEdit['form_id']; ?>" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form2">
  </form>
  <?php } // Show if recordset not empty ?><p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsEdit);
?>
