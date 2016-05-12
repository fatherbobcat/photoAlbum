<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>My Photo Album</title>
	<link rel="stylesheet" type="text/css" href="style.css" title="My Photo Album Styles"/>
	
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
		<h4><span class ="other"><a href="index.php">Home</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span id="current"><a href="albums.php">Photos</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="other"><a href="admin.php">Admin</a></span></h4>
		
		<div id="disclaimer">
		<?php
		if(isset($_POST['caption'])){
		$caption = strip_tags($_POST['caption']);}
		else{$caption="";}
		echo("<h1>Search Results: </h1>
			<p>You are now viewing all the photos that match your search result of:<br/>
			<strong>\"$caption\"</strong><br/><br/>
			To go back to Albums, click <a href=\"albums.php\">here</a></p>");
		?>
		</div>
		<?php
		if(isset($_POST['caption'])){
		$caption = strip_tags($_POST['caption']);
		require("dbinfo.config.inc");
		$mysqli=new mysqli($host, $username, $password, $database);
		$result=$mysqli->query("SELECT pid, url, caption, aid FROM (Photos NATURAL JOIN PhotoinAlbumlog)NATURAL JOIN PhotoAlbums AS P
		GROUP BY pid HAVING caption LIKE \"%$caption%\"");
		while($info=$result->fetch_row()){
			echo("<div class=\"albumdisplay\">
			<a href=\"largephoto.php?pid=$info[0]&amp;aid=$info[3]\">
			<img src=\"".$info[1]."\" alt=\"".$info[2]."\" width=\"300\" height=\"200\" class=\"photothumbnail\"/></a>
			</div>");
		}
		$mysqli->close();
		}
		?>
	</div>

	
	
</body>

</html>