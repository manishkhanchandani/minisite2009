<?php
echo 'Redirecting. Wait....';
$id = $_GET['ID'];
unlink("db.php");
echo '<script language="javascript">
			location.href="index.php?ID='.$id.'";
		</script>'; 
exit;
?>