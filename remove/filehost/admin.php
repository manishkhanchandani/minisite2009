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
$max = 25; if($CONFIG['query']['max']) $max = $CONFIG['query']['max'];
$page = 0; if($CONFIG['query']['page']) $page = $CONFIG['query']['page'];
$start = $page*$max;
$qstring = "";
$currentPage = $CONFIG['httpPath']."/filehost/admin.".URLPATH;
$sql = "select * from mo_files order by file_id desc";
$files = $table->getRecords($sql, $start, $max, 0);
$totalRows = $files['total'];
$pagination = $table->pagination($start, $page, $max, $totalRows, $currentPage, $qstring);
?>
<table width="100%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
	<td class="topSmallHead">Administrator</td>
  </tr>
  <tr>
	<td><?php if($totalRows>0) { ?><table width="100%"  border="0" cellspacing="0" cellpadding="5">
      <tr valign="top">
        <td><strong>File</strong></td>
        <td><strong>File Real Name </strong></td>
        <td><strong>Size</strong></td>
        <td><strong>Delete</strong></td>
      </tr>
	  <?php foreach($files['records'] as $key => $rsfile) { 
	  $qstring = "did/".$rsfile['file_id']."/";
	  ?>
      <tr valign="top">
        <td><?php echo "<a href='".$CONFIG['httpPath']."/filehost/download.php?filename=".urlencode($rsfile['file_realname'])."&file=files/".$rsfile['file_name']."'>Download</a>"; ?></td>
        <td><?php echo $rsfile['file_realname']; ?>&nbsp;</td>
        <td><?php echo $rsfile['file_size']; ?>&nbsp;</td>
        <td><a href="<?php echo $CONFIG['httpPath']."/filehost/delete.".URLPATH."/".$qstring; ?>" onClick="str=confirm('Do you really want to delete this file?'); if(str) return true; else return false;">Delete</a>&nbsp;</td>
      </tr>
      <tr valign="top">
        <td colspan="4">File Location: <?php echo $CONFIG['httpPath']."/filehost/download.php?filename=".urlencode($rsfile['file_realname'])."&file=files/".$rsfile['file_name']; ?></td>
        </tr>
	  <?php } ?>
    </table>
<?php echo $pagination; ?>
<?php } else {
	echo 'No Files found.';
}
?>
	</td>
  </tr>
</table>
