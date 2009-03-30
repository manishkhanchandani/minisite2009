<?php require_once('../Connections/conn.php'); ?><?php

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
<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>Step 5: Set FTP and DB Details for &quot;<?php echo $row_rsKeyword['keyword']; ?>&quot;</h1>
<form id="form1" name="form1" method="POST" action="">
  <table border="1" cellpadding="5" cellspacing="1">
    <tr>
      <th align="right">Sitename:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Site Url: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Site Email: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Site FTP Host: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Site FTP User: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Site FTP Password: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Site FTP Dir: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Mysql Host: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Mysql DB: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Mysql User: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Mysql Password: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">&nbsp;</th>
      <td><input type="submit" name="Submit" value="Publish" /></td>
    </tr>
  </table>
  
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsKeyword);
?>
