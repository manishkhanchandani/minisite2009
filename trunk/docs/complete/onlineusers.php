<?php
$fp = fopen("includes/work/onlineusers.txt", "a");
$string = $_COOKIE['user_id']." ".time()."
";
fwrite($fp, $string);
fclose($fp);
$body = $smarty->fetch("onlineusers.html");
echo $body;
exit;
?>