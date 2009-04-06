<?php
// user access
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
?>
<table width="100%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
	<td class="topSmallHead">Drag and Drop Images</td>
  </tr>
  <tr>
	<td><?php include($CONFIG['dirPath'].'/filehost/menu.php'); ?></td>
  </tr>
  <tr>
	<td>
      <p>
        <applet code="wjhk.jupload2.JUploadApplet" name="JUpload" archive="wjhk.jupload.jar" width="640" height="300" mayscript alt=""> 
    <param name="CODE" value="wjhk.jupload2.JUploadApplet" />
    <param name="ARCHIVE" value="wjhk.jupload.jar" />
    <param name="type"
value="application/x-java-applet;version=1.5" />
    <param name="scriptable" value="false" />
    <param name="postURL"
value="<?php echo $CONFIG['httpPath']."/filehost/dragndropupload.".URLPATH; ?>" />
    <param name="nbFilesPerRequest" value="4" />
    Java 1.5 or higher plugin required. 
        </applet>	
      </p>
    <p><a href="<?php echo $CONFIG['httpPath']."/filehost/index.".URLPATH; ?>/cache/2/">View Your Files</a> </p></td>
  </tr>
</table>