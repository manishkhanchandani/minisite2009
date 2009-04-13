<?php require_once('../../Connections/conn.php'); ?>
<?php
$colname_rsBids = "-1";
if (isset($_GET['product_id'])) {
  $colname_rsBids = (get_magic_quotes_gpc()) ? $_GET['product_id'] : addslashes($_GET['product_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsBids = sprintf("SELECT * FROM auction_bids WHERE product_id = %s ORDER BY bid_amount DESC", $colname_rsBids);
$rsBids = mysql_query($query_rsBids, $conn) or die(mysql_error());
$row_rsBids = mysql_fetch_assoc($rsBids);
$totalRows_rsBids = mysql_num_rows($rsBids);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Bids</title>
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
<h1>Bids </h1>
<?php if ($totalRows_rsBids > 0) { // Show if recordset not empty ?>
  <table border="1">
    <tr>
      <td><strong>User Id </strong></td>
      <td><strong>Bid Amount </strong></td>
      <td><strong>Bid Date </strong></td>
      <td><strong>Is Winner </strong></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsBids['user_id']; ?></td>
        <td><?php echo $row_rsBids['bid_amount']; ?></td>
        <td><?php echo $row_rsBids['bid_date']; ?></td>
        <td><?php echo $row_rsBids['is_winner']; ?></td>
      </tr>
      <?php } while ($row_rsBids = mysql_fetch_assoc($rsBids)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsBids == 0) { // Show if recordset empty ?>
  <p>No Bid Found. </p>
  <?php } // Show if recordset empty ?><p>&nbsp;</p>
<!-- InstanceEndEditable -->
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsBids);
?>
