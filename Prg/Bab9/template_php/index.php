<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Site</title>

	<style type="text/css">
	#header{
		background: black;
		padding: 2px;
	}
	#header ul > li{
		display: inline;
		list-style-type: none;
		padding-right: 10px;
	}
	#header li a{
		color: white;
		text-decoration: none;
		padding: 5px;
	}
	#header li > a:hover{
		background: white;
		color: black;
	}
	#content{
		background: #EBEBEB;
		min-height: 450px;
		padding: 10px;
	}
	#footer{
		background: black;
		padding: 5px;
		color: white;
		text-align: center;
	}
	</style>
</head>
<body>
	<div id="header">
		<ul>
			<li style="color: white;font-size: 25px;font-weight: bold">My Site &raquo;</li>
			<li><a href="index.php?page=home">Home</a></li>
			<li><a href="index.php?page=berita">Berita</a></li>
			<li><a href="index.php?page=tentang">Tentang Kami</a></li>
		</ul>
	</div>
	
	<div id="content">
		<?php include "config.php"; // Load file config.php ?>
	</div>
	
	<div id="footer">
		Copyright &copy; My Notes Code
	</div>
</body>
</html>
