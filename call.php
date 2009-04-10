<?php
header('Content-Type: text/xml'); 
echo "<?xml version='1.0' encoding='utf-8' ?>
<Response>
	<Say voice='woman'>".urldecode($_GET['msg'])."</Say>
</Response>";
?>