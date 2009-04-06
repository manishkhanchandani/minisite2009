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

$sql = "select * from mo_images where image_id = '".$CONFIG['query']['did']."'";
$images = $table->getRecords($sql, 0, 1, 0);
$totalRows = $images['total'];

$imagepath = $CONFIG['dirPath']."/imagehost/images/".$images['records'][0]['image_name'];
$table->deleteImages($imagepath);
$imagepath = $CONFIG['dirPath']."/imagehost/images450x450/".$images['records'][0]['image_name'];
$table->deleteImages($imagepath);
$imagepath = $CONFIG['dirPath']."/imagehost/images70x70/".$images['records'][0]['image_name'];
$table->deleteImages($imagepath);

$table->delete("mo_images", "image_id", $CONFIG['query']['did']);

$path = $CONFIG['httpPath'].'/imagehost/admin.'.URLPATH.'/page/'.$CONFIG['query']['page'].'/max/'.$CONFIG['query']['max'].'/';
echo '<script language="javascript">
location.href="'.$path.'";
</script>
<meta http-equiv="refresh" content="0;URL='.$path.'">';
//header("Location: ".$path);
exit;
?>