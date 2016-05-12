<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>My Photo Album</title>
	<link rel="stylesheet" type="text/css" href="style.css" title="My Photo Album Styles"/>
	<script type = "text/javascript" src="photoalbum.js"></script>
</head>

<body>
	<div id ="header">
		<img src="title.bmp" alt="title"/>

		<?php
		$page = "albums.php";
		require("loginsystem.php");
		?>
		
	</div>

	<div id="body">
		<br/>
		<h4><span class ="other"><a href="index.php">Home</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span id="current"><a href="albums.php">Photos</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="other"><a href="admin.php">Admin</a></span></h4>
		
		<?php
		$aid = $_GET['aid'];
		$pid = $_GET['pid'];
		echo("<p class = \"hidden\" id=\"pid_store\">$pid</p>");
		echo("<p class = \"hidden\" id=\"aid_store\">$aid</p>");
		require("dbinfo.config.inc");
		$mysqli=new mysqli($host, $username, $password, $database);
		$result=$mysqli->query("SELECT * FROM Photos WHERE pid=$pid");
		$info=$result->fetch_row();
		echo("<p><br/><br/>
		<img id=\"viewing\" src=\"$info[1]\" alt=\"$info[2]\"/><br/><br/>
		<em id=\"viewingcap\">$info[2]</em><br/><br/>
		<em id=\"viewingdate\">Date taken: $info[3]</em>
		<br/><br/>
		<button id=\"prev\" type=\"button\">Previous</button>&nbsp;&nbsp;
		<button id=\"next\" type=\"button\">Next</button> <br/><br/>
		<a href=\"photos.php?aid=$aid\"><button type=\"button\">Go Back to Album</button></a> 
		<a href=\"albums.php\"><button type=\"button\">Go Back to Albums Database</button></a></p>");
		$mysqli->close();
		?>
		

	</div>

	
	
</body>

</html>