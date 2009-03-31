<?php require_once('../Connections/conn.php'); ?>
<?php
$colname_rsPreview = "-1";
if (isset($_GET['template_id'])) {
  $colname_rsPreview = (get_magic_quotes_gpc()) ? $_GET['template_id'] : addslashes($_GET['template_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsPreview = sprintf("SELECT * FROM templates WHERE template_id = %s", $colname_rsPreview);
$rsPreview = mysql_query($query_rsPreview, $conn) or die(mysql_error());
$row_rsPreview = mysql_fetch_assoc($rsPreview);
$totalRows_rsPreview = mysql_num_rows($rsPreview);
?>
<?php
$body = $row_rsPreview['template'];
$tmp = explode("[[BODY]]", $body);
$HEADER = $tmp[0];
$FOOTER = $tmp[1];
$CSS = $row_rsPreview['css'];
$JS = $row_rsPreview['js'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/user.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Template Preview</title>
<!-- InstanceEndEditable -->
<?php if($CSS) { ?>
<style type="text/css">
<?php echo $CSS; ?>
</style>
<?php } else {
@include('../Templates/CSS.php');
} 
?>
<?php if($JS) { ?>
<script language="javascript">
<?php echo $JS; ?>
</script>
<?php } else {
@include('../Templates/JS.php');
} 
?>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<?php if($HEADER) { ?>
<?php echo $HEADER; ?>
<?php } else {
@include('../Templates/HEADER.php');
} 
?>
<!-- InstanceBeginEditable name="EditRegion3" -->
<p>body </p>
<!-- InstanceEndEditable -->
<?php if($FOOTER) { ?>
<?php echo $FOOTER; ?>
<?php } else {
@include('../Templates/FOOTER.php');
} 
?>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsPreview);
?>
