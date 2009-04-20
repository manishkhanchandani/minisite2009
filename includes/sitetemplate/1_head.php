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
						<?php echo $MENU2; ?>
					</ul>
				</li>
			</ul>
		</div>
		<!-- start content -->
		