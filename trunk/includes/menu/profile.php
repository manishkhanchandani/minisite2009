<?php if($_GET['uid']) { ?>
<li>
	<h2><?php echo $_GET['uid']; ?>'s Detail</h2>
	<ul>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=main&uid=<?php echo $_GET['uid']; ?>">Main</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=friends&uid=<?php echo $_GET['uid']; ?>">Friends</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=general&uid=<?php echo $_GET['uid']; ?>">General</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=social&uid=<?php echo $_GET['uid']; ?>">Social</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=contact&uid=<?php echo $_GET['uid']; ?>">Contact</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=professional&uid=<?php echo $_GET['uid']; ?>">Professional</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=personal&uid=<?php echo $_GET['uid']; ?>">Personal</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=scrapbook&uid=<?php echo $_GET['uid']; ?>">Scrapbook</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=testimonials&uid=<?php echo $_GET['uid']; ?>">Testimonials</a></li>
	</ul>
</li>
<?php } ?>
<li>
	<h2>Profile</h2>
	<ul>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=edit&sub=general">Browse Profiles</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=edit&sub=social">Search Profiles</a></li>
	</ul>
</li>
<li>
	<h2>My Profile</h2>
	<ul>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=main">Main</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=friends">Friends</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=general">General</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=social">Social</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=contact">Contact</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=professional">Professional</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=personal">Personal</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=scrapbook">Scrapbook</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=view&sub=testimonials">Testimonials</a></li>
	</ul>
</li>
<li>
	<h2>Edit Profile</h2>
	<ul>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=edit&sub=general">General</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=edit&sub=social">Social</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=edit&sub=contact">Contact</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=edit&sub=professional">Professional</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=edit&sub=personal">Personal</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=edit&sub=photo">Photo</a></li>
		<li><a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo ID; ?>&p=profile&action=edit&sub=friends">Friends</a></li>
	</ul>
</li>