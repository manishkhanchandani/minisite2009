<?php
try {
	$result = $Common->getConceptHomePageSettings($ID);	
	$smarty->assign('result', $result);
	if($result['concepts']) {
		foreach($result['concepts'] as $key=>$value) {
			$var = ucfirst($value['concept']);
			$classVar = "mod_$var";
			$class = new $classVar($dbFrameWork, $Common);
			$conceptId = $value['concept_id'];
			if($value['selfhomepage']==1){
				header("Location: index.php?ID=".$ID."&p=".$value['concept']."/index");
				exit;
			}
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