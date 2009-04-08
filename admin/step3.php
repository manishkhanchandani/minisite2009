<?php require_once('../Connections/conn.php'); ?>
<?php
$colname_rsView = "-1";
if (isset($_GET['id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM prebuilt_3_settings WHERE id = %s", $colname_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

// creating array for choosen keyword
$ids = array();
if($totalRows_rsView) {
	do {
		$ids[] = $row_rsView['setting_id'];
	} while ($row_rsView = mysql_fetch_assoc($rsView));
}
if($_POST['MM_Insert']==1) {
	$array1 = $ids;
	$array2 = $_POST['settings'];
	if(!$array2) $array2 = array();
	$result = array_diff($array1, $array2);
	if($result) {
		foreach($result as $value) {
			$sql = "delete from prebuilt_3_settings WHERE `id` = '".$_GET['id']."' and `setting_id` = '".$value."'";
			mysql_query($sql) or die('error '.__LINE__);
			$key = array_search($value, $ids); 			
			array_splice($ids, $key, 1);
		}
	}
	$result = array_diff($array2, $array1);
	if($result) {
		$sql = "insert into prebuilt_3_settings (`id`, `setting_id`) VALUES ";
		foreach($result as $value) {
			$sql .= "('".$_GET['id']."', '".$value."'), ";
			array_push($ids, $value);
		}
		$sql = substr($sql, 0, -2);
		mysql_query($sql) or die('error '.__LINE__);
	}
	header("Location: step4.php?id=".$_GET['id']);
	exit;
}
?>
<?php
$colname_rsKeyword = "-1";
if (isset($_GET['id'])) {
  $colname_rsKeyword = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsKeyword = sprintf("SELECT * FROM prebuilt_1 WHERE id = %s", $colname_rsKeyword);
$rsKeyword = mysql_query($query_rsKeyword, $conn) or die(mysql_error());
$row_rsKeyword = mysql_fetch_assoc($rsKeyword);
$totalRows_rsKeyword = mysql_num_rows($rsKeyword);

$colname_rsConcepts = "-1";
if (isset($_GET['id'])) {
  $colname_rsConcepts = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsConcepts = sprintf("SELECT * FROM prebuilt_2_concepts as a INNER JOIN prebuilt_concepts as b ON a.concept_id = b.concept_id WHERE a.id = '%s'", $colname_rsConcepts);
$rsConcepts = mysql_query($query_rsConcepts, $conn) or die(mysql_error());
$row_rsConcepts = mysql_fetch_assoc($rsConcepts);
$totalRows_rsConcepts = mysql_num_rows($rsConcepts);

if($totalRows_rsConcepts>0) {
	do {
		$arrConcepts[] = $row_rsConcepts;
		$arrCID[] = $row_rsConcepts['concept_id'];
	} while ($row_rsConcepts = mysql_fetch_assoc($rsConcepts));
	$cid = implode(',',$arrCID);
}

$colname_rsSettings = "-1";
if (isset($cid)) {
  $colname_rsSettings = (get_magic_quotes_gpc()) ? $cid : addslashes($cid);
}
mysql_select_db($database_conn, $conn);
$query_rsSettings = sprintf("SELECT * FROM prebuilt_concepts_settings WHERE concept_id IN (%s)", $colname_rsSettings);
$rsSettings = mysql_query($query_rsSettings, $conn) or die(mysql_error());
$row_rsSettings = mysql_fetch_assoc($rsSettings);
$totalRows_rsSettings = mysql_num_rows($rsSettings);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Step 3: Settings</title>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>

<style type="text/css">
<!--
body,td,th,textarea,select,input,button {
	font-family: Verdana;
	font-size: 11px;
}
-->
</style>
</head>

<body>
<h1>Step3: Choosing Concepts Settings for &quot;<?php echo $row_rsKeyword['keyword']; ?>&quot;</h1>
<?php 
	if ($totalRows_rsSettings > 0) { 
		do { 
			$settings[$row_rsSettings['concept_id']][$row_rsSettings['setting_id']] = $row_rsSettings;
		} while ($row_rsSettings = mysql_fetch_assoc($rsSettings)); 
	} 
?>
<?php if(!$arrConcepts) {
	echo 'No Concept found.';
} else { ?>
<form id="form1" name="form1" method="post" action="">

<ol>
<?php foreach($arrConcepts as $row_rsConcepts) { ?>
    <li><h3><?php echo ucwords($row_rsConcepts['concept']); ?></h3>
	    <ul>
			<?php if($settings[$row_rsConcepts['concept_id']]) { ?>
				<?php foreach($settings[$row_rsConcepts['concept_id']] as $k=>$v) { ?>					
					<?php 
						switch($v['inputtype']) {
							case 'radio':
							?>
								<li><input type="radio" name="settings[0]" value="<?php echo $k; ?>" <?php if(in_array($k,$ids)) echo ' checked'; ?> /> <?php echo $v['setting_label']; ?> </li>
							<?php
								break;
							case 'checkbox':
							?>
								<li><input type="checkbox" name="settings[<?php echo $k; ?>]" value="<?php echo $k; ?>" <?php if(in_array($k,$ids)) echo ' checked'; ?> /> <?php echo $v['setting_label']; ?></li>
							<?php
								break;
						}
							?>
				<?php } ?>
			<?php } else { ?>
				<li>Default Settings</li>
			<?php } ?>
	    </ul>
    </li>
  <?php } ?>
</ol>
<input type="submit" name="Submit" value="Go To Step 4" />
<input name="Submit2" type="button" onclick="MM_goToURL('parent','step2.php?id=<?php echo $_GET['id']; ?>');return document.MM_returnValue" value="Go To Step 2" />
<input name="Submit3" type="button" onclick="MM_goToURL('parent','step1.php');return document.MM_returnValue" value="Go To Step 1" />
<input name="MM_Insert" type="hidden" id="MM_Insert" value="1" />
</form>
<?php } ?>
</body>
</html>
<?php
mysql_free_result($rsKeyword);

mysql_free_result($rsConcepts);

mysql_free_result($rsSettings);

mysql_free_result($rsView);
?>
