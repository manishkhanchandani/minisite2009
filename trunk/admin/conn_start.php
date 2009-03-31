<?php
$string = '<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn = "'.$row_rsKeyword['dbhost'].'";
$database_conn = "'.$row_rsKeyword['db'].'";
$username_conn = "'.$row_rsKeyword['dbuser'].'";
$password_conn = "'.$row_rsKeyword['dbpassword'].'";
$conn = mysql_connect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_conn, $conn) or die("could not select db");
?>';
$fp = fopen("../Connections/conn.php", "w");
fwrite($fp, $string);
fclose($fp);

$string = '<?php
$hostname_conn = "'.$row_rsKeyword['dbhost'].'";
$database_conn = "'.$row_rsKeyword['db'].'";
$username_conn = "'.$row_rsKeyword['dbuser'].'";
$password_conn = "'.$row_rsKeyword['dbpassword'].'";
?>';
$fp = fopen("../Connections/connection.php", "w");
fwrite($fp, $string);
fclose($fp);
?>