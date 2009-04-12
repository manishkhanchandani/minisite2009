<?php
try {
	$body = $smarty->fetch('auction4cause/'.$_GET['action'].'.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('errorMessage.html');
} 
?>