<?php require_once('../../Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsSites = "SELECT * FROM prebuilt_1 ORDER BY keyword ASC";
$rsSites = mysql_query($query_rsSites, $conn) or die(mysql_error());
$row_rsSites = mysql_fetch_assoc($rsSites);
$totalRows_rsSites = mysql_num_rows($rsSites);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Manage Application</title>
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
<h1>Manage Application</h1>
<?php if ($totalRows_rsSites > 0) { // Show if recordset not empty ?>
  <fieldset>
    <legend><strong>View Site Details</strong></legend>
  <?php do { ?>
    <p><strong>Site Keyword:</strong> <?php echo $row_rsSites['keyword']; ?></p>
    <p><strong>Site Url: </strong><?php echo $row_rsSites['siteurl']; ?></p>
    <p><strong>Site Email:</strong> <?php echo $row_rsSites['siteemail']; ?></p>
    <p><a href="#">Edit</a> | <a href="settings.php?id=<?php echo $row_rsSites['id']; ?>">Settings</a> | <a href="charity.php?id=<?php echo $row_rsSites['id']; ?>">Manage Charity</a> | <a href="products.php?id=<?php echo $row_rsSites['id']; ?>">Add Products</a> | </p>
    <p>&nbsp;</p>
    <?php } while ($row_rsSites = mysql_fetch_assoc($rsSites)); ?>
      </fieldset>
  <?php } // Show if recordset not empty ?><p>&nbsp;</p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsSites);
?>
