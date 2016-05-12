<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>My Photo Album</title>
	<link rel="stylesheet" type="text/css" href="style.css" title="My Photo Album Styles"/>
	<script type = "text/javascript" src="java.js"></script>
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
			<h1>Photo Albums:</h1>
			<p>Below are all the photo albums that I currently have on this website. =)<br/><br/>
			Click on the photo album that you want to view to view all the photos in that album!<br/><br/>
			If you want to search for a specific photo/ album, use the search form below!<br/><br/>
			Enjoy! And come back often for updates!<br/><br/>
			</p>
		
			<form action="search.php" method="post">
			<fieldset>
			<legend>Search for photos!</legend><br/>
			<label>Search for photo with caption:</label><input type="text" name="caption"/><br/><br/>
			<!--<label>Search for album with name:</label><input type="text" name="title"/><br/><br/>!-->
			<input type="submit" name="submit" value="Search!"/>
			</fieldset>
			</form>
		</div>
		
		<?php
		require("dbinfo.config.inc");
		$mysqli=new mysqli($host, $username, $password, $database);
		$result=$mysqli->query("SELECT aid, title, coverphoto FROM PhotoAlbums ORDER BY aid");
		while($info=$result->fetch_row()){
		echo("<div class=\"albumdisplay\">
		<a href=\"photos.php?aid=$info[0]\">
		<img src=\"$info[2]\" alt=\"$info[1]\" width=\"300\" height=\"200\" class=\"photothumbnail\"/></a>
		<br/><br/>
		<em>$info[1]</em>");
		if(isset($_SESSION['user'])){
		echo("<br/><br/><a href=\"editalbum.php?aid=$info[0]\"><button type=\"button\">Edit Album</button></a>");}
		echo("</div>");
		}
		$mysqli->close();
		?>
	
	
	</div>
</body>

</html>