<?php require_once('../Connections/conn.php'); ?>
<?php
$colname_rsCopy = "-1";
if (isset($_GET['id'])) {
  $colname_rsCopy = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsCopy = sprintf("SELECT * FROM prebuilt_1 WHERE id = %s", $colname_rsCopy);
$rsCopy = mysql_query($query_rsCopy, $conn) or die(mysql_error());
$row_rsCopy = mysql_fetch_assoc($rsCopy);
$totalRows_rsCopy = mysql_num_rows($rsCopy);
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
<style type="text/css">
<!--
body,td,th,textarea,select,input,button {
	font-family: Verdana;
	font-size: 11px;
}
-->
</style>
</head>

<body>
Copy Site
<form action="" method="post" name="form1" id="form1" onsubmit="MM_validateForm('keyword','','R');return document.MM_returnValue">
  <table border="1" cellspacing="1" cellpadding="5">
    <tr>
      <th align="right">Keyword: </th>
      <td><input name="keyword" type="text" id="keyword" value="copy<?php echo $row_rsCopy['keyword']; ?>" size="50" /></td>
    </tr>
    <tr>
      <th align="right">&nbsp;</th>
      <td><input type="submit" name="Submit" value="Go" /></td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
  </p>
</form>
</body>
</html>
<?php
mysql_free_result($rsCopy);
?>
