<?php
try {
	$result = $Common->getConceptHomePageSettings($ID);	
	$smarty->assign('result', $result);
	if($result['concepts']) {
		foreach($result['concepts'] as $key=>$value) {
			$var = ucfirst($value['concept']);
			$classVar = "mod_$var";
			$class = new $classVar($dbFrameWork, $Common);	
			$box[$value['concept_id']] = $class->viewHomePage($ID, $result, $result['settings'][$value['concept_id']]);
		}
	}			
	$smarty->assign('box', $box);
	$body = $smarty->fetch('home.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('home.html');
}
?>