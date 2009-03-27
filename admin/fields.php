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
  $insertSQL = sprintf("INSERT INTO fields (form_id, field_name, field_label, field_type, field_input, field_default, field_default_selected, field_validate, field_validate_required, field_validate_rule, field_validate_value, field_validate_error, field_search, field_search_label, field_search_type, field_search_default, field_search_default_selected, field_view_show, field_detail_show) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['form_id'], "int"),
                       GetSQLValueString($_POST['field_name'], "text"),
                       GetSQLValueString($_POST['field_label'], "text"),
                       GetSQLValueString($_POST['field_type'], "text"),
                       GetSQLValueString($_POST['field_input'], "text"),
                       GetSQLValueString($_POST['field_default'], "text"),
                       GetSQLValueString($_POST['field_default_selected'], "text"),
                       GetSQLValueString($_POST['field_validate'], "int"),
                       GetSQLValueString($_POST['field_validate_required'], "int"),
                       GetSQLValueString($_POST['field_validate_rule'], "text"),
                       GetSQLValueString($_POST['field_validate_value'], "text"),
                       GetSQLValueString($_POST['field_validate_error'], "text"),
                       GetSQLValueString($_POST['field_search'], "int"),
                       GetSQLValueString($_POST['field_search_label'], "text"),
                       GetSQLValueString($_POST['field_search_type'], "text"),
                       GetSQLValueString($_POST['field_search_default'], "text"),
                       GetSQLValueString($_POST['field_search_default_selected'], "text"),
                       GetSQLValueString($_POST['field_view_show'], "int"),
                       GetSQLValueString($_POST['field_detail_show'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "fields.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE fields SET field_name=%s, field_label=%s, field_type=%s, field_input=%s, field_default=%s, field_default_selected=%s, field_validate=%s, field_validate_required=%s, field_validate_rule=%s, field_validate_value=%s, field_validate_error=%s, field_search=%s, field_search_label=%s, field_search_type=%s, field_search_default=%s, field_search_default_selected=%s, field_view_show=%s, field_detail_show=%s WHERE field_id=%s",
                       GetSQLValueString($_POST['field_name'], "text"),
                       GetSQLValueString($_POST['field_label'], "text"),
                       GetSQLValueString($_POST['field_type'], "text"),
                       GetSQLValueString($_POST['field_input'], "text"),
                       GetSQLValueString($_POST['field_default'], "text"),
                       GetSQLValueString($_POST['field_default_selected'], "text"),
                       GetSQLValueString($_POST['field_validate'], "int"),
                       GetSQLValueString($_POST['field_validate_required'], "int"),
                       GetSQLValueString($_POST['field_validate_rule'], "text"),
                       GetSQLValueString($_POST['field_validate_value'], "text"),
                       GetSQLValueString($_POST['field_validate_error'], "text"),
                       GetSQLValueString($_POST['field_search'], "int"),
                       GetSQLValueString($_POST['field_search_label'], "text"),
                       GetSQLValueString($_POST['field_search_type'], "text"),
                       GetSQLValueString($_POST['field_search_default'], "text"),
                       GetSQLValueString($_POST['field_search_default_selected'], "text"),
                       GetSQLValueString($_POST['field_view_show'], "int"),
                       GetSQLValueString($_POST['field_detail_show'], "int"),
                       GetSQLValueString($_POST['field_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "fields.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsForm = "-1";
if (isset($_GET['form_id'])) {
  $colname_rsForm = (get_magic_quotes_gpc()) ? $_GET['form_id'] : addslashes($_GET['form_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsForm = sprintf("SELECT * FROM forms WHERE form_id = %s", $colname_rsForm);
$rsForm = mysql_query($query_rsForm, $conn) or die(mysql_error());
$row_rsForm = mysql_fetch_assoc($rsForm);
$totalRows_rsForm = mysql_num_rows($rsForm);

$colname_rsView = "-1";
if (isset($_GET['form_id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['form_id'] : addslashes($_GET['form_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM fields WHERE form_id = %s", $colname_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$colname_rsEdit = "-1";
if (isset($_GET['field_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['field_id'] : addslashes($_GET['field_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM fields WHERE field_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Field Management</title>
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
</head>

<body>
<h1>Field For Form: &quot;<?php echo $row_rsForm['form_name']; ?>&quot;</h1>
<p><a href="fields.php?form_id=<?php echo $_GET['form_id']; ?>">Add New Field</a> | <a href="fields.php?form_id=<?php echo $_GET['form_id']; ?>&view=1">View Fields</a> | <a href="forms.php?view=1">Back To Form </a></p>
<?php if(!($_GET['view']==1 || $_GET['field_id'])) { ?>
<h3>Add New Field </h3>
<form action="<?php echo $editFormAction; ?>&view=1" method="post" name="form1" onsubmit="MM_validateForm('field_name','','R');return document.MM_returnValue">
  <table>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Name:</strong></td>
      <td valign="top"><input type="text" name="field_name" size="32"></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Label:</strong></td>
      <td valign="top"><input type="text" name="field_label" value="" size="32"></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Type:</strong></td>
      <td valign="top"><select name="field_type">
        <option value="text" selected="selected">text</option>
        <option value="password">password</option>
        <option value="textarea">textarea</option>
        <option value="list">list</option>
        <option value="listmultiple">listmultiple</option>
        <option value="checkbox">checkbox</option>
        <option value="checkboxmultiple">checkboxmultiple</option>
        <option value="radio">radio</option>
        <option value="file">file</option>
        <option value="image">image</option>
        <option value="hidden">hidden</option>
      </select>      </td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Input:</strong></td>
      <td valign="top"><select name="field_input">
        <option value="fvc" selected="selected">fvc</option>
        <option value="fint">fint</option>
        <option value="ftext">ftext</option>
        <option value="ffloat">ffloat</option>
        <option value="fdate">fdate</option>
        <option value="fdatetime">fdatetime</option>
      </select>      </td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Field Default:</strong></td>
      <td valign="top"><textarea name="field_default" cols="50" rows="5"></textarea>      </td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Field Default Selected:</strong></td>
      <td valign="top"><textarea name="field_default_selected" cols="50" rows="5"></textarea>      </td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Validate:</strong></td>
      <td valign="top"><table>
        <tr>
          <td><input type="radio" name="field_validate" value="1" >
            Yes</td>
        </tr>
        <tr>
          <td><input name="field_validate" type="radio" value="0" checked="checked" >
            No</td>
        </tr>
      </table></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Validate Required:</strong></td>
      <td valign="top"><table>
        <tr>
          <td><input type="radio" name="field_validate_required" value="1" >
            Yes</td>
        </tr>
        <tr>
          <td><input name="field_validate_required" type="radio" value="0" checked="checked" >
            No</td>
        </tr>
      </table></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Validate Rule:</strong></td>
      <td valign="top"><select name="field_validate_rule">
        <option value="" selected="selected">any</option>
        <option value="number">number</option>
        <option value="email">email</option>
        <option value="sametext">sametext</option>
        <option value="regexp">regexp</option>
      </select>      </td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Validate Value:</strong></td>
      <td valign="top"><input type="text" name="field_validate_value" value="" size="32"></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Validate Error Message:</strong></td>
      <td valign="top"><textarea name="field_validate_error" cols="50" rows="5"></textarea></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Search:</strong></td>
      <td valign="top"><table>
        <tr>
          <td><input type="radio" name="field_search" value="1" >
            Yes</td>
        </tr>
        <tr>
          <td><input name="field_search" type="radio" value="0" checked="checked" >
            No</td>
        </tr>
      </table></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Search Label:</strong></td>
      <td valign="top"><input type="text" name="field_search_label" value="" size="32"></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Search Type:</strong></td>
      <td valign="top"><select name="field_search_type">
        <option value="text" selected="selected">text</option>
        <option value="list">list</option>
        <option value="listmultiple">listmultiple</option>
        <option value="checkbox">checkbox</option>
        <option value="checkboxmultiple">checkboxmultiple</option>
        <option value="radio">radio</option>
      </select>      </td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Field Search Default:</strong></td>
      <td valign="top"><textarea name="field_search_default" cols="50" rows="5"></textarea>      </td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Field Search Default Selected:</strong></td>
      <td valign="top"><textarea name="field_search_default_selected" cols="50" rows="5"></textarea>      </td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field View Show:</strong></td>
      <td valign="top"><table>
        <tr>
          <td><input name="field_view_show" type="radio" value="1" checked="checked" >
            Yes</td>
        </tr>
        <tr>
          <td><input type="radio" name="field_view_show" value="0" >
            No</td>
        </tr>
      </table></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><strong>Field Detail Show:</strong></td>
      <td valign="top"><table>
        <tr>
          <td><input name="field_detail_show" type="radio" value="1" checked="checked" >
            Yes</td>
        </tr>
        <tr>
          <td><input type="radio" name="field_detail_show" value="0" >
            No</td>
        </tr>
      </table></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap>&nbsp;</td>
      <td valign="top"><input type="submit" value="Insert record"></td>
      <td valign="top">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="form_id" value="<?php echo $row_rsForm['form_id']; ?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<?php } ?>
<?php if($_GET['view']==1) { ?>
  <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
    <h3>View Fields </h3>
    <table border="1">
      <tr>
        <td><strong>Delete</strong></td>
        <td><strong>Edit</strong></td>
        <td><strong>Field ID </strong></td>
        <td><strong>Field Name </strong></td>
        <td><strong>Field Label </strong></td>
        <td><strong>Field Type </strong></td>
        <td><strong>Field Input </strong></td>
        <td><strong>Field Default </strong></td>
        <td><strong>Field Default Selected </strong></td>
        <td><strong>Field Validate </strong></td>
        <td><strong>Field Validate Required </strong></td>
        <td><strong>Field Validate Rule </strong></td>
        <td><strong>Field Validate Value </strong></td>
        <td><strong>Field Validate Error </strong></td>
        <td><strong>Field Search </strong></td>
        <td><strong>Field Search Label </strong></td>
        <td><strong>Field Search Type </strong></td>
        <td><strong>Field Search Default </strong></td>
        <td><strong>Field Search Default Selected </strong></td>
        <td><strong>Field View Show </strong></td>
        <td><strong>Field Detail Show </strong></td>
      </tr>
      <?php do { ?>
        <tr>
          <td><a href="fields.php?form_id=<?php echo $_GET['form_id']; ?>&did=<?php echo $row_rsView['field_id']; ?>&view=1" onclick="GP_popupConfirmMsg('Are you sure you want to delete this record?');return document.MM_returnValue">Delete</a></td>
          <td><a href="fields.php?form_id=<?php echo $_GET['form_id']; ?>&field_id=<?php echo $row_rsView['field_id']; ?>">Edit</a></td>
          <td><?php echo $row_rsView['field_id']; ?></td>
          <td><?php echo $row_rsView['field_name']; ?></td>
          <td><?php echo $row_rsView['field_label']; ?></td>
          <td><?php echo $row_rsView['field_type']; ?></td>
          <td><?php echo $row_rsView['field_input']; ?></td>
          <td><?php echo $row_rsView['field_default']; ?></td>
          <td><?php echo $row_rsView['field_default_selected']; ?></td>
          <td><?php echo $row_rsView['field_validate']; ?></td>
          <td><?php echo $row_rsView['field_validate_required']; ?></td>
          <td><?php echo $row_rsView['field_validate_rule']; ?></td>
          <td><?php echo $row_rsView['field_validate_value']; ?></td>
          <td><?php echo $row_rsView['field_validate_error']; ?></td>
          <td><?php echo $row_rsView['field_search']; ?></td>
          <td><?php echo $row_rsView['field_search_label']; ?></td>
          <td><?php echo $row_rsView['field_search_type']; ?></td>
          <td><?php echo $row_rsView['field_search_default']; ?></td>
          <td><?php echo $row_rsView['field_search_default_selected']; ?></td>
          <td><?php echo $row_rsView['field_view_show']; ?></td>
          <td><?php echo $row_rsView['field_detail_show']; ?></td>
        </tr>
        <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
    </table>
    <?php } // Show if recordset not empty ?>
	
<?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
  <p>No Field Record Found. </p>
  <?php } // Show if recordset empty ?>
<?php } ?>  
<?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
  <h3>Edit Field</h3>
  <form action="<?php echo $editFormAction; ?>" method="POST" name="form2" id="form2" onsubmit="MM_validateForm('field_name','','R');return document.MM_returnValue">
    <table>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Name:</strong></td>
        <td valign="top"><input name="field_name" type="text" id="field_name" value="<?php echo $row_rsEdit['field_name']; ?>" size="32" /></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Label:</strong></td>
        <td valign="top"><input name="field_label" type="text" id="field_label" value="<?php echo $row_rsEdit['field_label']; ?>" size="32" /></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Type:</strong></td>
        <td valign="top"><select name="field_type" id="field_type">
          <option value="text" <?php if (!(strcmp("text", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>text</option>
          <option value="password" <?php if (!(strcmp("password", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>password</option>
          <option value="textarea" <?php if (!(strcmp("textarea", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>textarea</option>
          <option value="list" <?php if (!(strcmp("list", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>list</option>
          <option value="listmultiple" <?php if (!(strcmp("listmultiple", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>listmultiple</option>
          <option value="checkbox" <?php if (!(strcmp("checkbox", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>checkbox</option>
          <option value="checkboxmultiple" <?php if (!(strcmp("checkboxmultiple", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>checkboxmultiple</option>
          <option value="radio" <?php if (!(strcmp("radio", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>radio</option>
          <option value="file" <?php if (!(strcmp("file", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>file</option>
          <option value="image" <?php if (!(strcmp("image", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>image</option>
  <option value="hidden" <?php if (!(strcmp("hidden", $row_rsEdit['field_type']))) {echo "selected=\"selected\"";} ?>>hidden</option>
          </select>      </td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Input:</strong></td>
        <td valign="top"><select name="field_input" id="field_input">
          <option value="fvc" <?php if (!(strcmp("fvc", $row_rsEdit['field_input']))) {echo "selected=\"selected\"";} ?>>fvc</option>
          <option value="fint" <?php if (!(strcmp("fint", $row_rsEdit['field_input']))) {echo "selected=\"selected\"";} ?>>fint</option>
          <option value="ftext" <?php if (!(strcmp("ftext", $row_rsEdit['field_input']))) {echo "selected=\"selected\"";} ?>>ftext</option>
          <option value="ffloat" <?php if (!(strcmp("ffloat", $row_rsEdit['field_input']))) {echo "selected=\"selected\"";} ?>>ffloat</option>
          <option value="fdate" <?php if (!(strcmp("fdate", $row_rsEdit['field_input']))) {echo "selected=\"selected\"";} ?>>fdate</option>
  <option value="fdatetime" <?php if (!(strcmp("fdatetime", $row_rsEdit['field_input']))) {echo "selected=\"selected\"";} ?>>fdatetime</option>
          </select>      </td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top"><strong>Field Default:</strong></td>
        <td valign="top"><textarea name="field_default" cols="50" rows="5" id="field_default"><?php echo $row_rsEdit['field_default']; ?></textarea>      </td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top"><strong>Field Default Selected:</strong></td>
        <td valign="top"><textarea name="field_default_selected" cols="50" rows="5" id="field_default_selected"><?php echo $row_rsEdit['field_default_selected']; ?></textarea>      </td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Validate:</strong></td>
        <td valign="top"><table>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_validate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_validate" value="1" />
                Yes</td>
            </tr>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_validate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_validate" value="0" />
                No</td>
            </tr>
        </table></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Validate Required:</strong></td>
        <td valign="top"><table>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_validate_required'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_validate_required" value="1" />
                Yes</td>
            </tr>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_validate_required'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_validate_required" value="0" />
                No</td>
            </tr>
        </table></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Validate Rule:</strong></td>
        <td valign="top"><select name="field_validate_rule" id="field_validate_rule">
          <option value="" <?php if (!(strcmp("", $row_rsEdit['field_validate_rule']))) {echo "selected=\"selected\"";} ?>>any</option>
          <option value="number" <?php if (!(strcmp("number", $row_rsEdit['field_validate_rule']))) {echo "selected=\"selected\"";} ?>>number</option>
          <option value="email" <?php if (!(strcmp("email", $row_rsEdit['field_validate_rule']))) {echo "selected=\"selected\"";} ?>>email</option>
          <option value="sametext" <?php if (!(strcmp("sametext", $row_rsEdit['field_validate_rule']))) {echo "selected=\"selected\"";} ?>>sametext</option>
  <option value="regexp" <?php if (!(strcmp("regexp", $row_rsEdit['field_validate_rule']))) {echo "selected=\"selected\"";} ?>>regexp</option>
          </select>      </td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Validate Value:</strong></td>
        <td valign="top"><input name="field_validate_value" type="text" id="field_validate_value" value="<?php echo $row_rsEdit['field_validate_value']; ?>" size="32" /></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Validate Error Message:</strong></td>
        <td valign="top"><textarea name="field_validate_error" cols="50" rows="5" id="field_validate_error"><?php echo $row_rsEdit['field_validate_error']; ?></textarea></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Search:</strong></td>
        <td valign="top"><table>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_search'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_search" value="1" />
                Yes</td>
            </tr>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_search'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_search" value="0" />
                No</td>
            </tr>
        </table></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Search Label:</strong></td>
        <td valign="top"><input name="field_search_label" type="text" id="field_search_label" value="<?php echo $row_rsEdit['field_search_label']; ?>" size="32" /></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Search Type:</strong></td>
        <td valign="top"><select name="field_search_type" id="field_search_type">
          <option value="text" <?php if (!(strcmp("text", $row_rsEdit['field_search_type']))) {echo "selected=\"selected\"";} ?>>text</option>
          <option value="list" <?php if (!(strcmp("list", $row_rsEdit['field_search_type']))) {echo "selected=\"selected\"";} ?>>list</option>
          <option value="listmultiple" <?php if (!(strcmp("listmultiple", $row_rsEdit['field_search_type']))) {echo "selected=\"selected\"";} ?>>listmultiple</option>
          <option value="checkbox" <?php if (!(strcmp("checkbox", $row_rsEdit['field_search_type']))) {echo "selected=\"selected\"";} ?>>checkbox</option>
          <option value="checkboxmultiple" <?php if (!(strcmp("checkboxmultiple", $row_rsEdit['field_search_type']))) {echo "selected=\"selected\"";} ?>>checkboxmultiple</option>
  <option value="radio" <?php if (!(strcmp("radio", $row_rsEdit['field_search_type']))) {echo "selected=\"selected\"";} ?>>radio</option>
          </select>      </td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top"><strong>Field Search Default:</strong></td>
        <td valign="top"><textarea name="field_search_default" cols="50" rows="5" id="field_search_default"><?php echo $row_rsEdit['field_search_default']; ?></textarea>      </td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top"><strong>Field Search Default Selected:</strong></td>
        <td valign="top"><textarea name="field_search_default_selected" cols="50" rows="5" id="field_search_default_selected"><?php echo $row_rsEdit['field_search_default_selected']; ?></textarea>      </td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field View Show:</strong></td>
        <td valign="top"><table>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_view_show'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_view_show" value="1" />
                Yes</td>
            </tr>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_view_show'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_view_show" value="0" />
                No</td>
            </tr>
        </table></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap"><strong>Field Detail Show:</strong></td>
        <td valign="top"><table>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_detail_show'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_detail_show" value="1" />
                Yes</td>
            </tr>
            <tr>
              <td><input <?php if (!(strcmp($row_rsEdit['field_detail_show'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="field_detail_show" value="0" />
                No</td>
            </tr>
        </table></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap">&nbsp;</td>
        <td valign="top"><input name="submit" type="submit" value="Update" />
        <input name="field_id" type="hidden" id="field_id" value="<?php echo $row_rsEdit['field_id']; ?>" /></td>
        <td valign="top">&nbsp;</td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form2">
      </form>
  <?php } // Show if recordset not empty ?><p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($rsForm);

mysql_free_result($rsView);

mysql_free_result($rsEdit);
?>
