<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	background-color: #0000FF;
	margin: 0px;
	padding: 0px;
	font-family: Verdana;
	font-size: 11px;
}
td, th, table, p, select, input, textarea {
	font-family: Verdana;
	font-size: 11px;
}
a {
	text-decoration: none;
}
#mainBody {
	width: 800px;
	border: 1px solid #000000;
	margin-right: auto;
	margin-left: auto;
	margin-top:-25px;
}
#mainBody #mainHeader {
	background-color: #000000;
	text-align:center;
	padding-top:25px;
}
#mainBody #mainHeader h1 {
	font-size: 36px;
	font-weight: bold;
	color: #FFFFFF;
}
#mainBody #mainHeader p {
	font-size: 10px;
	color: #FFFFFF;
	text-align:center;
	margin-top: -20px;
	padding-bottom: 25px;
}
#mainBody #mainLower {
	background-color: #FFFFFF;
	margin-top: -20px;
	padding-bottom: 15px;
}
#mainBody #mainLower #mainNavigation {
	padding: 5px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #0000FF;
}
#mainBody #mainLower #mainContent {
	padding: 10px;
	min-height: 300px;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #0000FF;
}
-->
</style>
</head>

<body>
<div id="mainBody">
	<div id="mainHeader">
		<h1>News Site</h1>
		<p>News site is back</p>
	</div>
	<div id="mainLower">
		<div id="mainNavigation">
			<a href="<?php echo HTTPPATH; ?>/index.php?ID=<?php echo $ID; ?>">Home</a> | <a href="<?php echo HTTPPATH; ?>/index.php?p=news&ID=<?php echo $ID; ?>">News</a>		
		</div>
		<div id="mainContent">
			[[BODY]]
		</div>
		<div id="mainFooter">
			<p>Copyright 2009</p>
		</div>
	</div>
</div>
</body>
</html>
