<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>My Photo Album</title>
	<link rel="stylesheet" type="text/css" href="style.css" title="My Photo Album Styles"/>
	<script type = "text/javascript" src="home.js"></script>
</head>

<body>
	<div id ="header">
		<img src="title.bmp" alt="title"/>

		<?php
		$page = "index.php";
		require("loginsystem.php");
		?>
		
	</div>

	<div id="body">
		<br/>
		<h4><span id ="current"><a href="index.php">Home</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="other"><a href="albums.php">Photos</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="other"><a href="admin.php">Admin</a></span></h4>
		
		<img src="Images/Cornell01.jpg" alt="cornelldusk" height="300" width="220"/>
		<img src="Images/Misc01.bmp" alt="expo" height="300" width="220"/>
		<img src="Images/Misc02.bmp" alt="sichuan" height="300" width="220"/>
	</div>

	<p><br/>Welcome to my online photo album database!<br/><br/>
	Here you can view the photos that I have taken from Spring Break, at Cornell University, before coming
	to Cornell... etc... <br/><br/>
	You will be able to browse my photos by album, and search for individual photos by the photo caption. If 
	you are my friend, and have the password to the website, you can login and add photos/ albums to the 
	database.<br/><br/>
	Feel free to look around! And check back for updates!<br/><br/>
	Cheers!
	</p>
	
</body>

</html>