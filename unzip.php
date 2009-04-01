<?php
echo 'Unzipping. Wait....';
$id = $_GET['ID'];
ini_set("memory_limit","500M");
ini_set("max_execution_time","-1");
include('Zip.php');        // imports
$obj = new Archive_Zip($id.'.zip'); // name of zip file
$obj->extract();
echo '<script language="javascript">
			location.href="db.php?ID='.$id.'";
		</script>'; 
exit;
?>