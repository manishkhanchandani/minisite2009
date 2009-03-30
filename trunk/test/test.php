<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/user.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../includes/sitetemplate/<?php echo $ID; ?>_css.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../includes/sitetemplate/<?php echo $ID; ?>_js.js"></script>
</head>

<body>
<?php
$pattern = array("[[SITENAME]]", "[[PAGEHEADING]]");
$replace   = array($SITENAME, $PAGEHEADING);
$head = @file_get_contents("includes/sitetemplate/".$ID."_head.php");
$head = str_replace($pattern, $replace, $head);
echo $head;
?>
<!-- InstanceBeginEditable name="EditRegion3" -->
<p>body</p>
<!-- InstanceEndEditable -->
<?php
$foot = @file_get_contents("includes/sitetemplate/".$ID."_foot.php");
$foot = str_replace($pattern, $replace, $foot);
echo $foot;
?>
</body>
<!-- InstanceEnd --></html>
