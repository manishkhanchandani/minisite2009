<?php require_once('../Connections/conn.php'); ?>
<?php
$colname_rsView = "-1";
if (isset($_GET['id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM prebuilt_2_concepts WHERE id = %s", $colname_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

// creating array for choosen keyword
$ids = array();
if($totalRows_rsView) {
	do {
		$ids[] = $row_rsView['concept_id'];
		$homepage[$row_rsView['id']][$row_rsView['concept_id']] = $row_rsView['homepage'];
		$displayname[$row_rsView['id']][$row_rsView['concept_id']] = $row_rsView['displayname'];
	} while ($row_rsView = mysql_fetch_assoc($rsView));
}
if($_POST['MM_Insert']==1) {
	$array1 = $ids;
	$array2 = $_POST['concept_id'];
	if($_POST['concept_id']) {
		foreach($_POST['concept_id'] as $value) {
			$sql = "update prebuilt_2_concepts set homepage = '".$_POST['homepage'][$value]."', displayname = '".addslashes(stripslashes(trim($_POST['displayname'][$value])))."' WHERE `id` = '".$_GET['id']."' and `concept_id` = '".$value."'";
			mysql_query($sql) or die('error '.__LINE__);
		}
	}
	if(!$array2) $array2 = array();
	$result = array_diff($array1, $array2);
	if($result) {
		foreach($result as $value) {
			$sql = "delete from prebuilt_2_concepts WHERE `id` = '".$_GET['id']."' and `concept_id` = '".$value."'";
			mysql_query($sql) or die('error '.__LINE__);
			$key = array_search($value, $ids); 			
			array_splice($ids, $key, 1);
		}
	}
	$result = array_diff($array2, $array1);
	if($result) {
		$sql = "insert into prebuilt_2_concepts (`id`, `concept_id`, `homepage`) VALUES ";
		foreach($result as $value) {
			$sql .= "('".$_GET['id']."', '".$value."', '".$_POST['homepage'][$value]."'), ";
			array_push($ids, $value);
		}
		$sql = substr($sql, 0, -2);
		mysql_query($sql) or die('error '.__LINE__);
	}
	header("Location: step3.php?id=".$_GET['id']);
	exit;
}

$colname_rsKeyword = "-1";
if (isset($_GET['id'])) {
  $colname_rsKeyword = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsKeyword = sprintf("SELECT * FROM prebuilt_1 WHERE id = %s", $colname_rsKeyword);
$rsKeyword = mysql_query($query_rsKeyword, $conn) or die(mysql_error());
$row_rsKeyword = mysql_fetch_assoc($rsKeyword);
$totalRows_rsKeyword = mysql_num_rows($rsKeyword);

mysql_select_db($database_conn, $conn);
$query_rsConcepts = "SELECT * FROM prebuilt_concepts ORDER BY concept ASC";
$rsConcepts = mysql_query($query_rsConcepts, $conn) or die(mysql_error());
$row_rsConcepts = mysql_fetch_assoc($rsConcepts);
$totalRows_rsConcepts = mysql_num_rows($rsConcepts);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>Step2: Choosing Concepts for &quot;<?php echo $row_rsKeyword['keyword']; ?>&quot; </h1>
<form id="form1" name="form1" method="post" action="">
  <table border="1">
    <tr>
      <td>&nbsp;</td>
      <td><strong>Concept</strong></td>
      <td><strong>Homepage</strong></td>
      <td><strong>Display Name</strong> </td>
      <td><strong>Link For Creating Templates </strong></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><input name="concept_id[<?php echo $row_rsConcepts['concept_id']; ?>]" type="checkbox" id="concept_id_<?php echo $row_rsConcepts['concept_id']; ?>" value="<?php echo $row_rsConcepts['concept_id']; ?>" <?php if(in_array($row_rsConcepts['concept_id'],$ids)) echo ' checked'; ?> /></td>
        <td><?php echo ucwords($row_rsConcepts['concept']); ?></td>
        <td><input name="homepage[<?php echo $row_rsConcepts['concept_id']; ?>]" type="radio" value="1" <?php if($homepage[$row_rsKeyword['id']][$row_rsConcepts['concept_id']]==1) echo 'checked'; ?> />
          Yes 
            <input name="homepage[<?php echo $row_rsConcepts['concept_id']; ?>]" type="radio" value="0" <?php if($homepage[$row_rsKeyword['id']][$row_rsConcepts['concept_id']]==0) echo 'checked'; ?> />
          No </td>
        <td><input name="displayname[<?php echo $row_rsConcepts['concept_id']; ?>]" type="text" id="displayname_<?php echo $row_rsConcepts['concept_id']; ?>" value="<?php echo $displayname[$row_rsKeyword['id']][$row_rsConcepts['concept_id']]; ?>" size="30" /></td>
        <td>&lt;?php echo HTTPPATH; ?&gt;/index.php?p=<?php echo $row_rsConcepts['concept']; ?>&amp;ID= <?php echo $row_rsConcepts['concept_id']; ?></td>
      </tr>
      <?php } while ($row_rsConcepts = mysql_fetch_assoc($rsConcepts)); ?>
  </table>
  <p>
    <input type="submit" name="Submit" value="Go To Step 3" />
    <input name="MM_Insert" type="hidden" id="MM_Insert" value="1" />
  </p>
</form>
</body>
</html>
<?php
mysql_free_result($rsKeyword);

mysql_free_result($rsConcepts);

mysql_free_result($rsView);
?>
