<?php
$string = '<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn = "'.$row_rsSite['db_host'].'";
$database_conn = "'.$row_rsSite['db_database'].'";
$username_conn = "'.$row_rsSite['db_user'].'";
$password_conn = "'.$row_rsSite['db_pass'].'";
$conn = mysql_connect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_conn, $conn) or die("could not select db");
?>';
$fp = fopen("../Connections/conn.php", "w");
fwrite($fp, $string);
fclose($fp);
?>