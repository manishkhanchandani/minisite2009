<?php
if($_POST) {
	file_put_contents("index.html", stripslashes($_POST['content']));
}
$c = file_get_contents("index.html");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>index.html</p>
<form id="form1" name="form1" method="post" action="">
  <p>
    <textarea name="content" cols="50" rows="20" id="content"><?php echo $c; ?></textarea>
</p>
  <p>
    <input type="submit" name="Submit" value="Add" />
</p>
</form>
<p>&nbsp;</p>
<p>&nbsp; </p>
</body>
</html>
