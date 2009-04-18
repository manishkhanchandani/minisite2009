<?php require_once('../Connections/conn.php'); ?>
<?php
header('Content-Type: text/xml');
$first = max(0, intval($_GET['first']) - 1);
$last  = max($first + 1, intval($_GET['last']) - 1);
$length = $last - $first + 1;


$maxRows_rsView = $length;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colalbum_rsView = "%";
if (isset($_GET['album_id'])) {
  $colalbum_rsView = (get_magic_quotes_gpc()) ? $_GET['album_id'] : addslashes($_GET['album_id']);
}
$colname_rsView = "-1";
if (isset($_GET['ID'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['ID'] : addslashes($_GET['ID']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM files WHERE id = %s and album_id like '%s'", $colname_rsView,$colalbum_rsView);
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


if ($totalRows_rsView > 0) { // Show if recordset not empty 
	do {
		$selected[] = "photoalbum/uploadDir/".$row_rsView['filepath']."/small/".$row_rsView['filename'];
	} while ($row_rsView = mysql_fetch_assoc($rsView)); 
} // Show if recordset not empty 
$total = $totalRows_rsView;

echo '<data>';

// Return total number of images so the callback
// can set the size of the carousel.
echo '  <total>' . $total . '</total>';
if($selected) {
foreach ($selected as $img) {
    echo '  <image>' . $img . '</image>';
}
}
echo '</data>';

mysql_free_result($rsView);
?>