<?php
if(!$_SESSION['user_id']) {
	$_SESSION['accessUrl'] = $_SERVER['REQUEST_URI'];
	$path = $CONFIG['httpPath'].'/users/login.'.URLPATH;
	echo '<script language="javascript">
	location.href="'.$path.'";
	</script>
	<meta http-equiv="refresh" content="0;URL='.$path.'">';
	//header("Location: ".$path);
	exit;
} 
if($_SESSION['status']<=100) {
	$_SESSION['accessUrl'] = $_SERVER['REQUEST_URI'];
	$path = $CONFIG['httpPath'].'/restrictaccess.'.URLPATH;
	echo '<script language="javascript">
	location.href="'.$path.'";
	</script>
	<meta http-equiv="refresh" content="0;URL='.$path.'">';
	//header("Location: ".$path);
	exit;
}
$table = new table($dbFrameWork);

$sql = "select * from mo_files where file_id = '".$CONFIG['query']['did']."'";
$files = $table->getRecords($sql, 0, 1, 0);
$totalRows = $files['total'];
if($totalRows>0) {
$filepath = $CONFIG['dirPath']."/filehost/files/".$files['records'][0]['file_name'];
$table->deleteFiles($filepath);

$table->delete("mo_files", "file_id", $CONFIG['query']['did']);
}
$path = $CONFIG['httpPath'].'/filehost/admin.'.URLPATH.'/cache/2/';
echo '<script language="javascript">
location.href="'.$path.'";
</script>
<meta http-equiv="refresh" content="0;URL='.$path.'">';
//header("Location: ".$path);
exit;
?>