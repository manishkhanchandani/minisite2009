<?php
class mod_Youtube {
	
	private $cacheSecs = -300;
	private static $instance;
	
	public function __construct($dbFrameWork, $Common) {
		if(self::$instance) {
			return self::$instance;
		} else {
			self::$instance = $this;
			$this->dbFrameWork = $dbFrameWork;
			$this->Common = $Common;
		}
	}
	
	public function viewHomePage($ID, $data, $settings) {
		$keyword = $data['keyword'][0]['keyword'];
		// creating reference
		$reference = array();
		if($settings) {
			foreach($settings as $setting) {
				$reference[$setting['reference']] = 1;
			}
		}
		$result['content']=$this->displayVideo($keyword, $reference, $data);
		return $result;
	}
	
	public function displayVideo($keyword, $reference, $data) {
$string = '<!-- ++Begin Video Bar Wizard Generated Code++ -->
  <!--
  // Created with a Google AJAX Search Wizard
  // http://code.google.com/apis/ajaxsearch/wizards.html
  -->

  <!--
  // The Following div element will end up holding the actual videobar.
  // You can place this anywhere on your page.
  -->
  <div id="videoBar-bar">
    <span style="color:#676767;font-size:11px;margin:10px;padding:4px;">Loading...</span>
  </div>

  <!-- Ajax Search Api and Stylesheet
  // Note: If you are already using the AJAX Search API, then do not include it
  //       or its stylesheet again
  -->
  <script src="http://www.google.com/uds/api?file=uds.js&v=1.0&source=uds-vbw"
    type="text/javascript"></script>
  <style type="text/css">
    @import url("http://www.google.com/uds/css/gsearch.css");
  </style>

  <!-- Video Bar Code and Stylesheet -->
  <script type="text/javascript">
    window._uds_vbw_donotrepair = true;
  </script>
  <script src="http://www.google.com/uds/solutions/videobar/gsvideobar.js?mode=new"
    type="text/javascript"></script>
  <style type="text/css">
    @import url("http://www.google.com/uds/solutions/videobar/gsvideobar.css");
  </style>

  <style type="text/css">
    .playerInnerBox_gsvb .player_gsvb {
      width : 320px;
      height : 260px;
    }
  </style>
  <script type="text/javascript">
    function LoadVideoBar() {

    var videoBar;
    var options = {
        largeResultSet : ';
		if($reference['largeresultset']) {
$string .= '!false';
		} else { 
$string .= '!true';
		}
$string .= ',
        horizontal : true,
        autoExecuteList : {
          cycleTime : GSvideoBar.CYCLE_TIME_MEDIUM,
          cycleMode : GSvideoBar.CYCLE_MODE_LINEAR,
          executeList : ["'.$keyword.'"';
		  	if($reference['mostviewed']) { 
$string .= ',"ytfeed:most_viewed.this_week"';
			} 
			if($reference['toprated']) { 
$string .= ',"ytfeed:top_rated.this_week"';
			} 
			if($reference['featured']) { 
$string .= ',"ytfeed:recently_featured"';
			}
$string .= ']
        }
      }

    videoBar = new GSvideoBar(document.getElementById("videoBar-bar"),
                              GSvideoBar.PLAYER_ROOT_FLOATING,
                              options);
    }
    // arrange for this function to be called during body.onload
    // event processing
    GSearch.setOnLoadCallback(LoadVideoBar);
  </script>
<!-- ++End Video Bar Wizard Generated Code++ -->';
		return $string;
	}
}
?>