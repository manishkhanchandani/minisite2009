<?php require_once('../../Connections/conn.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

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

$id = $row_rsSite['id'];
$cid = $row_rsConcept['concept_id'];

$maxRows_rsView = 10;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colbonus_rsView = "0";
if (isset($_GET['bonus'])) {
  $colbonus_rsView = (get_magic_quotes_gpc()) ? $_GET['bonus'] : addslashes($_GET['bonus']);
}
$colfreebid_rsView = "0";
if (isset($_GET['freebid'])) {
  $colfreebid_rsView = (get_magic_quotes_gpc()) ? $_GET['freebid'] : addslashes($_GET['freebid']);
}
$colid_rsView = "-1";
if (isset($id)) {
  $colid_rsView = (get_magic_quotes_gpc()) ? $id : addslashes($id);
}
$colconcept_rsView = "-1";
if (isset($cid)) {
  $colconcept_rsView = (get_magic_quotes_gpc()) ? $cid : addslashes($cid);
}
$colstatus_rsView = "1";
if (isset($_GET['status'])) {
  $colstatus_rsView = (get_magic_quotes_gpc()) ? $_GET['status'] : addslashes($_GET['status']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT a.product_id, a.id, a.concept_id, a.product_name, a.product_price, a.comments, a.product_end_date, a.product_start_date, b.get4price, b.maxbidprice, b.bidfee, b.maxnumofbids, b.charityamtperc, b.bonus, b.freebid FROM product as a LEFT JOIN auction_item_settings as b ON a.product_id = b.product_id  WHERE b.bonus = '%s' AND b.freebid = '%s' AND a.id = '%s' AND a.concept_id = '%s' AND a.status = '%s' ORDER BY product_end_date ASC", $colbonus_rsView,$colfreebid_rsView,$colid_rsView,$colconcept_rsView,$colstatus_rsView);
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
<title>Untitled Document</title>
</head>

<body>
<h1>View Products</h1>
<form id="form1" name="form1" method="get" action="">
Status:
<select name="status" id="status">
  <option value="1" <?php if (!(strcmp(1, $colstatus_rsView))) {echo "selected=\"selected\"";} ?>>Active</option>
  <option value="0" <?php if (!(strcmp(0, $colstatus_rsView))) {echo "selected=\"selected\"";} ?>>Inactive</option>
  <option value="2" <?php if (!(strcmp(2, $colstatus_rsView))) {echo "selected=\"selected\"";} ?>>Completed</option>
  </select> 
  Is Bonus Auction: 
  <select name="bonus" id="bonus">
    <option value="1" <?php if (!(strcmp(1, $colbonus_rsView))) {echo "selected=\"selected\"";} ?>>Yes</option>
<option value="0" <?php if (!(strcmp(0, $colbonus_rsView))) {echo "selected=\"selected\"";} ?>>No</option>
  </select> 
  Is Free Auction: 
  <select name="freebid" id="freebid">
    <option value="1" <?php if (!(strcmp(1, $colfreebid_rsView))) {echo "selected=\"selected\"";} ?>>Yes</option>
    <option value="0" <?php if (!(strcmp(0, $colfreebid_rsView))) {echo "selected=\"selected\"";} ?>>No</option>
  </select>
  <input type="submit" name="Submit" value="Search" />
  <input name="id" type="hidden" id="id" value="<?php echo $row_rsSite['id']; ?>" />
</form>

<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
  <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?>
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
  </p>
  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top"><strong>Image</strong></td>
      <td valign="top"><strong>Details</strong></td>
      <td valign="top"><strong>Action</strong></td>
    </tr>
      <?php do { ?>
    <tr>
        <td valign="top"><img src="../uploadDir/small/<?php echo $row_rsView['comments']; ?>" /></td>
        <td valign="top"><p><strong>Name:</strong> <?php echo $row_rsView['product_name']; ?><br />
            <strong>Start Date:</strong> <?php echo $row_rsView['product_start_date']; ?><br />
            <strong>End Date:</strong> <?php echo $row_rsView['product_end_date']; ?><br />
            <strong>Get4price: </strong><?php echo $row_rsView['get4price']; ?><br />
            <strong>Maxbidprice: </strong><?php echo $row_rsView['maxbidprice']; ?><br />
            <strong>Bidfee: </strong><?php echo $row_rsView['bidfee']; ?><br />
            <strong>Maxnumofbids:</strong> <?php echo $row_rsView['maxnumofbids']; ?><br />
            <strong>Is Bonus: </strong><?php echo $row_rsView['bonus']; ?><br />
            <strong>Is Free:</strong>        <?php echo $row_rsView['freebid']; ?><br />
            <strong>Charity Amt Percentage:</strong> <?php echo $row_rsView['charityamtperc']; ?></p>
        </td>
        <td valign="top"><p><a href="products_edit.php?product_id=<?php echo $row_rsView['product_id']; ?>">Edit</a></p>
        <p><a href="products_viewbids.php?product_id=<?php echo $row_rsView['product_id']; ?>">View Bids</a> </p></td>
    </tr>
        <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
  <p>No Product Found. </p>
  <?php } // Show if recordset empty ?><p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsSite);

mysql_free_result($rsConcept);

mysql_free_result($rsView);
?>
