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
$currentPage = $CONFIG['httpPath']."/imagehost/admin.".URLPATH;
$sql = "select * from mo_images order by image_id desc";
$images = $table->getRecords($sql, $start, $max, 0);
$totalRows = $images['total'];
$pagination = $table->pagination($start, $page, $max, $totalRows, $currentPage, $qstring);
?>
<table width="100%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
	<td class="topSmallHead">Administrator</td>
  </tr>
  <tr>
	<td><?php if($totalRows>0) { ?><table width="100%"  border="0" cellspacing="0" cellpadding="5">
      <tr valign="top">
        <td><strong>Image</strong></td>
        <td><strong>Image Real Name </strong></td>
        <td><strong>Height</strong></td>
        <td><strong>Width</strong></td>
        <td><strong>Size</strong></td>
        <td><strong>Delete</strong></td>
      </tr>
	  <?php foreach($images['records'] as $key => $rsImage) { 
	  $qstring = "did/".$rsImage['image_id']."/";
	  ?>
      <tr valign="top">
        <td rowspan="2"><img src="<?php echo $CONFIG['httpPath']."/imagehost/images70x70/".$rsImage['image_name']; ?>"></td>
        <td><?php echo $rsImage['image_realname']; ?>&nbsp;</td>
        <td><?php echo $rsImage['image_height']; ?>&nbsp;</td>
        <td><?php echo $rsImage['image_width']; ?>&nbsp;</td>
        <td><?php echo $rsImage['image_size']; ?>&nbsp;</td>
        <td><a href="<?php echo $CONFIG['httpPath']."/imagehost/delete.".URLPATH."/page/".$page."/max/".$max."/".$qstring; ?>" onClick="str=confirm('Do you really want to delete this image?'); if(str) return true; else return false;">Delete</a>&nbsp;</td>
      </tr>
      <tr valign="top">
        <td colspan="5"><?php echo $error = "Image Url:<a href='".$CONFIG['httpPath']."/imagehost/images/".$rsImage['image_name']."' target='_blank'>".$CONFIG['httpPath']."/imagehost/images/".$rsImage['image_name']."</a> <br>Thumbnail (450x450) Url:<a href='".$CONFIG['httpPath']."/imagehost/images450x450/".$rsImage['image_name']."' target='_blank'>".$CONFIG['httpPath']."/imagehost/images450x450/".$rsImage['image_name']."</a> <br>Thumbnail (70x70) Url:<a href='".$CONFIG['httpPath']."/imagehost/images70x70/".$rsImage['image_name']."' target='_blank'>".$CONFIG['httpPath']."/imagehost/images70x70/".$rsImage['image_name']."</a>"; ?>&nbsp;</td>
        </tr>
	  <?php } ?>
    </table>
<?php echo $pagination; ?>
<?php } else {
	echo 'No Image found.';
}
?>
	</td>
  </tr>
</table>
