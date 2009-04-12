<?php require_once('../../Connections/conn.php'); ?>
<?php 
ob_start();
$ADODB_CACHE_DIR = '../ADODB_cache'; 
?>
<!-- #BeginLibraryItem "/Library/config.lbi" -->
<?php
// adodb connection
include('../../includes/adodb/adodb-exceptions.inc.php'); # load code common to ADOdb
include('../../includes/adodb/adodb.inc.php'); # load code common to ADOdb 
try { 
	include_once('../../Connections/connection.php');
	$dbFrameWork = &ADONewConnection('mysql');  # create a connection 
	$dbFrameWork->Connect($hostname_conn,$username_conn,$password_conn,$database_conn);# connect to MySQL, framework db
} catch (exception $e) { 
	ob_end_clean();
	echo 'Loading in 15 seconds. If page does not refresh in 5 seconds, please refresh manually.<meta http-equiv="refresh" content="15">';
	exit;
} 

function __autoload($classname) {
	include("../../Classes/{$classname}.php");
}
spl_autoload_register('spl_autoload');
if (function_exists('__autoload')) {
	spl_autoload_register('__autoload');
}
$Common = new Common($dbFrameWork);
?>
<!-- #EndLibraryItem -->
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	if(!trim($_POST['product_name'])) {
		$error = "Please fill the title.";
		unset($_POST["MM_insert"]);
	}
	$_POST['product_description'] = $_POST['richEdit'];
	$_POST['get4price'] = str_replace(",","", $_POST['get4price']);
	$_POST['get4price'] = str_replace("$","", $_POST['get4price']);
	$_POST['get4price'] = trim(str_replace(" ","", $_POST['get4price']));
	$_POST['bidfee'] = str_replace(",","", $_POST['bidfee']);
	$_POST['bidfee'] = str_replace("$","", $_POST['bidfee']);
	$_POST['bidfee'] = trim(str_replace(" ","", $_POST['bidfee']));
	$_POST['maxbidprice'] = str_replace(",","", $_POST['maxbidprice']);
	$_POST['maxbidprice'] = str_replace("$","", $_POST['maxbidprice']);
	$_POST['maxbidprice'] = trim(str_replace(" ","", $_POST['maxbidprice']));
	$_POST['product_price'] = str_replace(",","", $_POST['product_price']);
	$_POST['product_price'] = str_replace("$","", $_POST['product_price']);
	$_POST['product_price'] = trim(str_replace(" ","", $_POST['product_price']));
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO product (id, user_id, concept_id, product_name, product_description, product_price, product_start_date, product_end_date, created, status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['concept_id'], "int"),
                       GetSQLValueString($_POST['product_name'], "text"),
                       GetSQLValueString($_POST['product_description'], "text"),
                       GetSQLValueString($_POST['product_price'], "double"),
                       GetSQLValueString($_POST['product_start_date'], "date"),
                       GetSQLValueString($_POST['product_end_date'], "date"),
                       GetSQLValueString($_POST['created'], "date"),
                       GetSQLValueString($_POST['status'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$productId = mysql_insert_id();
	$insertSQL = sprintf("INSERT INTO auction_item_settings (id, concept_id, product_id, get4price, maxbidprice, bidfee, maxnumofbids) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['concept_id'], "int"),
                       GetSQLValueString($productId, "int"),
                       GetSQLValueString($_POST['get4price'], "double"),
                       GetSQLValueString($_POST['maxbidprice'], "double"),
                       GetSQLValueString($_POST['bidfee'], "double"),
                       GetSQLValueString($_POST['maxnumofbids'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
  $insertSQL = sprintf("INSERT INTO product_cat_rel (product_id, id, concept_id, category_id) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($productId, "int"),
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['concept_id'], "int"),
                       GetSQLValueString($_POST['category_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
    require_once('HTTP/Upload.php');
	$upload = new HTTP_Upload("en");
	$files = $upload->getFiles();
	if($files) {
		foreach($files as $file){
			if ($file->upload['error']) {
				throw new Exception($file->getMessage());
			}
			$file->setName("uniq");
			
			$real = $file->getProp("real");
			$ext = $file->getProp("ext");
			$size = $file->getProp("size");
			$filetype = $file->getProp("type");
			$name = $file->getProp("name");
			
			// creating path
			$path = "../uploadDir/normal";
			if(!is_dir($path)) {
				mkdir($path, 0777);
				chmod($path, 0777);
			}	
			$thumbmed = "../uploadDir/medium";
			if(!is_dir($thumbmed)) {
				mkdir($thumbmed, 0777);
				chmod($thumbmed, 0777);
			}	
			$thumbsm = "../uploadDir/small";
			if(!is_dir($thumbsm)) {
				mkdir($thumbsm, 0777);
				chmod($thumbsm, 0777);
			}	
			$record['filepath']  = "auction4cause/uploadDir";	
			$record['id'] = $_POST['id'];	
			$record['concept_id'] = $_POST['concept_id'];	
			$record['user_id'] = $_POST['user_id'];		
			$record['created'] = date('Y-m-d H:i:s');
			$record['product_id'] = $productId;			
			$dest_name = $file->moveTo($path);
			if (PEAR::isError($dest_name)) {
				throw new Exception($dest_name->getMessage());	
			}
			$inValidExtensions = array('jpg','gif','bmp','jpeg','png');
			if(in_array($ext, $inValidExtensions)) {	
				// create thumbnail and store
				$record['filename']  = $name;
				$record['filerealname']  = $real;
				$record['filesize']  = $size;
				$record['fileext']  = $ext;
				$record['filetype']  = $filetype;
				$uid = $Common->phpinsert('product_images', 'file_id', $record);
				
				// create thumbnail and store
				$Common->buildThumbnail($path."/".$name, 200, 200, $format=$ext, $thumbmed."/".$name);
				$Common->buildThumbnail($path."/".$name, 100, 100, $format=$ext, $thumbsm."/".$name);
				static $inc=0; $inc++;
				if($inc==1) {
					$sql = "update product set comments = '".$name."' WHERE product_id = '".$productId."'";
					mysql_query($sql) or die('error in updating '.__LINE__.' due to '.mysql_error());
				}
				$success = 1;
			} 
		}
	}
	header("Location: products_confirm.php");
	exit;
}
$colname_rsSite = "-1";
if (isset($_GET['id'])) {
  $colname_rsSite = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsSite = sprintf("SELECT * FROM prebuilt_1 WHERE id = %s", $colname_rsSite);
$rsSite = mysql_query($query_rsSite, $conn) or die(mysql_error());
$row_rsSite = mysql_fetch_assoc($rsSite);
$totalRows_rsSite = mysql_num_rows($rsSite);

$colname_rsConcept = "-1";
if (isset($_GET['id'])) {
  $colname_rsConcept = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsConcept = sprintf("SELECT * FROM prebuilt_2_concepts as a INNER JOIN prebuilt_concepts as b ON a.concept_id = b.concept_id WHERE a.id = '%s' AND b.concept = 'auction4cause'", $colname_rsConcept);
$rsConcept = mysql_query($query_rsConcept, $conn) or die(mysql_error());
$row_rsConcept = mysql_fetch_assoc($rsConcept);
$totalRows_rsConcept = mysql_num_rows($rsConcept);
?>
<?php
$mod_Products = new mod_Products($dbFrameWork, $Common);			
$mod_Products->treeSelectBox($row_rsSite['id'], 0, $row_rsConcept['concept_id']);
$categorySelBox .= $mod_Products->treeSelectBox;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Product Management</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->



<script language="javascript" src="../../includes/richedit/richedit.js" type="text/javascript"></script>

<script src="../../js/jquery.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../js/datetimepicker/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script src="../../js/datetimepicker/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>
<script src="../../js/datetimepicker/jquery.timePicker.js" type="text/javascript"></script>
<link href="../../js/datetimepicker/jquery.timePicker.css" rel="stylesheet" type="text/css" />

<script src="../../js/multiupload/jquery.form.js" type="text/javascript" language="javascript"></script>
<script src="../../js/multiupload/jquery.MetaData.js" type="text/javascript" language="javascript"></script>
<script src="../../js/multiupload/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>
<script src="../../js/multiupload/jquery.blockUI.js" type="text/javascript" language="javascript"></script>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body, td, th, p, div, select, input, button, submit {
	font-family: Verdana;
	font-size: 11px;
}
-->
</style>
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<h1>Product Management</h1>
<?php if ($totalRows_rsSite == 0) { // Show if recordset empty ?>
	<p>Site Id is Incorrect</p>
<?php } // Show if recordset empty ?>

<?php if ($totalRows_rsSite > 0) { // Show if recordset not empty ?>
	<?php if ($totalRows_rsConcept == 0) { // Show if recordset empty ?>
		<p>Concept Does not exist</p>
	<?php } // Show if recordset empty ?>
	
	  
	<?php if ($totalRows_rsConcept > 0) { // Show if recordset not empty ?>
		<h3>Add Product Information      </h3>
		<?php echo $error; ?>
		<form method="post" name="form1" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" onSubmit="rtoStore()">
          <table border="0" cellpadding="5" cellspacing="0">
            <tr valign="baseline">
              <td nowrap align="right"><strong>Product Title:</strong></td>
              <td><input type="text" name="product_name" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right" valign="top"><strong>Product Description:</strong></td>
              <td>
<script language="JavaScript"> <!--
var editor1 = new EDITOR();
editor1.iconPath = "../../includes/richedit/icons";
editor1.create("");
//--> 
</script>
			  <input name="product_description" type="hidden" />              </td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><strong>Product Retail Price:</strong></td>
              <td><input type="text" name="product_price" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><strong>Product Start Date:</strong></td>
              <td><input type="text" name="product_start_date" id="product_start_date" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><strong>Product End Date:</strong></td>
              <td><input type="text" name="product_end_date" id="product_end_date" value="" size="32"></td>
            </tr>
          </table>
          <br />
          <table border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td align="right" valign="top"><strong>Get 4 Price: </strong></td>
              <td valign="top"><input name="get4price" type="text" id="get4price" /></td>
              <td valign="top"><strong>The highest unduplicated                    bid wins...your bid can be no higher than the &quot;Get4&quot; price.</strong></td>
            </tr>
            <tr>
              <td align="right" valign="top"><strong>Maximum Bid Price: </strong></td>
              <td valign="top"><input name="maxbidprice" type="text" id="maxbidprice" /></td>
              <td valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top"><strong>Bid Fee: </strong></td>
              <td valign="top"><input name="bidfee" type="text" id="bidfee" /></td>
              <td valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top"><strong>Maximum Number of Bids: </strong></td>
              <td valign="top"><input name="maxnumofbids" type="text" id="maxnumofbids" /></td>
              <td valign="top">&nbsp;</td>
            </tr>
          </table>
          <br />
          <table border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td align="right" valign="top"><strong>Product Image:</strong></td>
              <td valign="top"><input type="file" name="userfile[]" class="multi" />&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top"><strong>Product Category: </strong></td>
              <td valign="top"><select name="category_id">
								<?php echo $categorySelBox; ?>
							  </select>
              &nbsp;<a href="#">Manage Category </a></td>
            </tr>
          </table>
          <p>
            <input type="hidden" name="id" value="<?php echo $row_rsSite['id']; ?>">
            <input type="hidden" name="user_id" value="0">
            <input type="hidden" name="concept_id" value="<?php echo $row_rsConcept['concept_id']; ?>">
            <input type="hidden" name="created" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="status" value="1">
            <input type="hidden" name="MM_insert" value="form1">
            <input name="comments" type="hidden" id="comments" />
            <input name="submit" type="submit" value="Insert record" />
          </p>
		</form>
<script language="javascript">
	jQuery(function($){
		$("#product_start_date").datepicker();
		$("#product_end_date").datepicker();
	});	
</script>
          <?php } // Show if recordset not empty ?>
<?php } // Show if recordset not empty ?>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsSite);

mysql_free_result($rsConcept);
?>
