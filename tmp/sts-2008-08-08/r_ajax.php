<?php

header('Content-type: text/html; charset=ISO-8859-2');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

$txt = urlencode(trim(strip_tags($_GET[txt])));

?>

  <object id="Player" height="100" width="320" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=7,0,0,0">
   <param name="URL" value="example_2.php?txt=<?php echo $txt; ?>">
   <param name="FileName" value="example_2.php?txt=<?php echo $txt; ?>">
   <param name="TransparentAtStart" value="-1">
   <param name="AutoStart" value="true">
   <param name="AnimationatStart" value="1">
   <param name="ShowControls" value="1">
   <param name="enablecontextmenu" value="1">
   <param name="autoSize" value="true">
   <param name="displaySize" value="1">
   <param name="Volume" value="100">
   <param name="uiMode" value="mini">
   <param name="enablecontextmenu" value="0"> 
   <embed src="example_2.php?txt=<?php echo $txt; ?>" type="application/x-mplayer2" pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/MediaPlayer/" width="320" height="100" autostart="1" showcontrols="1" showstatusbar="1" showdisplay="1" autorewind="1" enablecontextmenu="1" loop="1" volume="100"></embed>
  </object>