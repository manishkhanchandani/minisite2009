<?php
session_start();
$_SESSION['user_id']=1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Cool Black by Free CSS Templates</title>
<meta name="keywords" content="" />
<meta name="Cool Black" content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<!-- start header -->
<div id="header">
	<div id="logo">
		<h1><a href="#"><span>Xoriant</span> Solutions</a></h1>
		<p>Designed By Manish Khanchandani</p>
	</div>
</div>
	<div id="menu">
		<ul id="main">
			<li class="current_page_item"><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>">Homepage</a></li>
			<?php if($_SESSION['user_id']) { ?>
				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=change">Change Password</a></li>
				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=logout">Logout</a></li>			
			<?php } else { ?>
				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=register">Register</a></li>
				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=login">Login</a></li>	
				<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>&p=users&action=forgot">Forgot Password</a></li>				
			<?php } ?>
		</ul>
	</div>
	
<!-- end header -->
<div id="wrapper">
	<!-- start page -->
	<div id="page">
		<div id="sidebar1" class="sidebar">
			<ul>
				<li>
					<h2>Modules</h2>
					<ul>
						<?php echo $MENU; ?>
					</ul>
				</li>
			</ul>
		</div>
		<!-- start content -->
		[[BODY]
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end page -->
</div>
<div id="footer">
	<p class="copyright">copyright </p>
	<p class="link"><a href="#">Privacy Policy</a>&nbsp;&#8226;&nbsp;<a href="#">Terms of Use</a></p>
</div>
</body>
</html>
