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
		$page = "albums.php";
		require("loginsystem.php");
		?>
		
	</div>

	<div id="body">
		<br/>
		<h4><span class ="other"><a href="index.php">Home</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span id="current"><a href="albums.php">Photos</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="other"><a href="admin.php">Admin</a></span></h4>
		
		<div id="disclaimer">
			<?php
			$aid = $_GET['aid'];
			require("dbinfo.config.inc");
			$mysqli=new mysqli($host, $username, $password, $database);
			$result=$mysqli->query("SELECT * FROM PhotoAlbums WHERE aid=$aid");
			$info=$result->fetch_row();
			echo("<h1>Photo Album: $info[1] </h1>
			<p><strong>Date Created:</strong> $info[2]<br/>
			<strong>Date Modified:</strong> $info[3]<br/><br/>
			You are now viewing all the photos in photo album \"$info[1]\"<br/><br/>
			Click on the photo that you want to view to view a bigger version of it!<br/><br/>
			Or click <a href=\"albums.php\">here</a> to go back to the albums page.<br/><br/>
			Enjoy! And come back often for updates!<br/><br/></p>");
			$mysqli->close();
			?>
		</div>
		
		<?php
		require("dbinfo.config.inc");
		$mysqlia=new mysqli($host, $username, $password, $database);
		$resulta=$mysqlia->query("SELECT pid, url, caption FROM (Photos NATURAL JOIN PhotoinAlbumlog)NATURAL JOIN PhotoAlbums AS P
		WHERE aid=$aid ORDER BY pid");
		while($infoa=$resulta->fetch_row()){
		echo("<div class=\"albumdisplay\">
			<a href=\"largephoto.php?pid=$infoa[0]&amp;aid=$aid\">
			<img src=\"".$infoa[1]."\" alt=\"".$infoa[2]."\" width=\"300\" height=\"200\" class=\"photothumbnail\"/></a>");
		if(isset($_SESSION['user'])){
			echo("<br/><br/><a href=\"editphoto.php?pid=$infoa[0]&amp;aid=$aid\"><button type=\"button\">Edit Photo</button></a>");}
			echo("</div>");
		}
		echo("<p id=\"backbutton\"><a href=\"albums.php\"><button type=\"button\">Go Back to Albums Database</button></a></p>");
		$mysqlia->close();
		
		?>
		
		
		

	</div>

	
	
</body>

</html>