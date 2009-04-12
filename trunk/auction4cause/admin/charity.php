<?php require_once('../../Connections/conn.php'); ?>
<?php
if($_GET['did']) {
  $sql = "UPDATE auction_charities SET deleted = 1 WHERE charity_id = '".$_GET['did']."'";
  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($sql, $conn) or die(mysql_error());
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO auction_charities (id, concept_id, charity_name, charity_site, charity_url, charity_description) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['concept_id'], "int"),
                       GetSQLValueString($_POST['charity_name'], "text"),
                       GetSQLValueString($_POST['charity_site'], "text"),
                       GetSQLValueString($_POST['charity_url'], "text"),
                       GetSQLValueString($_POST['charity_description'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE auction_charities SET charity_name=%s, charity_site=%s, charity_url=%s, charity_description=%s WHERE charity_id=%s",
                       GetSQLValueString($_POST['charity_name'], "text"),
                       GetSQLValueString($_POST['charity_site'], "text"),
                       GetSQLValueString($_POST['charity_url'], "text"),
                       GetSQLValueString($_POST['charity_description'], "text"),
                       GetSQLValueString($_POST['charity_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

$colname_rsSite = "-1";
if (isset($_GET['id'])) {
  $colname_rsSite = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsSite = sprintf("SELECT * FROM prebuilt_1 WHERE id = %s", $colname_rsSite);
$rsSite = mysql_query($query_rsSite, $conn) or die(mysql_error());
$row_rsSite = mysql_fetch_assoc($rsSite);
$totalRows_rsSite = mysql_num_rows($rsSite);

$colname_rsConcept = "-1";
if (isset($_GET['id'])) {
  $colname_rsConcept = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsConcept = sprintf("SELECT * FROM prebuilt_2_concepts as a INNER JOIN prebuilt_concepts as b ON a.concept_id = b.concept_id WHERE a.id = '%s' AND b.concept = 'auction4cause'", $colname_rsConcept);
$rsConcept = mysql_query($query_rsConcept, $conn) or die(mysql_error());
$row_rsConcept = mysql_fetch_assoc($rsConcept);
$totalRows_rsConcept = mysql_num_rows($rsConcept);

$colname_rsEdit = "-1";
if (isset($_GET['charity_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['charity_id'] : addslashes($_GET['charity_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM auction_charities WHERE charity_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

$id = $row_rsSite['id'];
$cid = $row_rsConcept['concept_id'];

$colname_rsView = "-1";
if (isset($id)) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $id : addslashes($id);
}
$colconcept_rsView = "-1";
if (isset($cid)) {
  $colconcept_rsView = (get_magic_quotes_gpc()) ? $cid : addslashes($cid);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM auction_charities WHERE id = %s and concept_id = '%s' and deleted = 0", $colname_rsView,$colconcept_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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
<h1>Charity Management</h1>
<?php if ($totalRows_rsSite == 0) { // Show if recordset empty ?>
	<p>Site Id is Incorrect</p>
<?php } // Show if recordset empty ?>

<?php if ($totalRows_rsSite > 0) { // Show if recordset not empty ?>
	<?php if ($totalRows_rsConcept == 0) { // Show if recordset empty ?>
		<p>Concept Does not exist</p>
	<?php } // Show if recordset empty ?>
	
	  
	<?php if ($totalRows_rsConcept > 0) { // Show if recordset not empty ?>
        <h3>Add New Charity    </h3>
        <form action="charity.php?id=<?php echo $row_rsSite['id']; ?>" method="post" name="form1" onsubmit="MM_validateForm('charity_name','','R');return document.MM_returnValue">
          <table>
            <tr valign="baseline">
              <td nowrap align="right"><strong>Charity Name:</strong></td>
              <td><input type="text" name="charity_name" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right"><strong>Charity Site Url:</strong></td>
              <td><input name="charity_site" type="text" id="charity_site" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><strong>Charity Image Url:</strong></td>
              <td><input type="text" name="charity_url" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right" valign="top"><strong>Charity Description:</strong></td>
              <td><textarea name="charity_description" cols="50" rows="5"></textarea>              </td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">&nbsp;</td>
              <td><input type="submit" value="Insert record"></td>
            </tr>
          </table>
          <input type="hidden" name="id" value="<?php echo $row_rsSite['id']; ?>">
          <input type="hidden" name="concept_id" value="<?php echo $row_rsConcept['concept_id']; ?>">
          <input type="hidden" name="MM_insert" value="form1">
    </form>
        <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
          <h3>View Charities </h3>
          <table border="1">
            <tr>
              <td valign="top"><strong>Name</strong></td>
              <td valign="top"><strong>Image</strong></td>
              <td valign="top"><strong>Charity Description </strong></td>
              <td valign="top"><strong>Edit </strong></td>
              <td valign="top"><strong>Delete</strong></td>
            </tr>
            <?php do { ?>
              <tr>
                <td valign="top"><a href="<?php echo $row_rsView['charity_site']; ?>#"><?php echo $row_rsView['charity_name']; ?></a></td>
                <td valign="top"><img src="<?php echo $row_rsView['charity_url']; ?>" /></td>
                <td valign="top"><?php echo $row_rsView['charity_description']; ?></td>
                <td valign="top"><a href="charity.php?id=<?php echo $row_rsSite['id']; ?>&charity_id=<?php echo $row_rsView['charity_id']; ?>#edit">Edit</a></td>
                <td valign="top"><a href="charity.php?id=<?php echo $row_rsSite['id']; ?>&did=<?php echo $row_rsView['charity_id']; ?>">Delete</a></td>
              </tr>
              <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
          </table>
            <?php } // Show if recordset not empty ?>
          <?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
          <h3>Edit Charity<a name="edit"></a></h3>
          <form method="post" name="form2" action="charity.php?id=<?php echo $row_rsSite['id']; ?>">
            <table>
              <tr valign="baseline">
                <td align="right" valign="top" nowrap><strong>Charity Name:</strong></td>
                <td valign="top"><input type="text" name="charity_name" value="<?php echo $row_rsEdit['charity_name']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td align="right" valign="top" nowrap><strong>Charity Site:</strong></td>
                <td valign="top"><input type="text" name="charity_site" value="<?php echo $row_rsEdit['charity_site']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td align="right" valign="top" nowrap><strong>Charity Url:</strong></td>
                <td valign="top"><input type="text" name="charity_url" value="<?php echo $row_rsEdit['charity_url']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td align="right" valign="top" nowrap><strong>Charity Description:</strong></td>
                <td valign="top"><textarea name="charity_description" cols="50" rows="5"><?php echo $row_rsEdit['charity_description']; ?></textarea></td>
              </tr>
              <tr valign="baseline">
                <td align="right" valign="top" nowrap>&nbsp;</td>
                <td valign="top"><input type="submit" value="Update record"></td>
              </tr>
            </table>
            <input type="hidden" name="MM_update" value="form2">
            <input type="hidden" name="charity_id" value="<?php echo $row_rsEdit['charity_id']; ?>">
                  </form>
          <?php } // Show if recordset not empty ?>
        <?php } // Show if recordset not empty ?>
<?php } // Show if recordset not empty ?>
</body>
</html>
<?php
mysql_free_result($rsEdit);

mysql_free_result($rsView);

mysql_free_result($rsSite);

mysql_free_result($rsConcept);
?>
