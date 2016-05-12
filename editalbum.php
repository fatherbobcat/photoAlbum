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
		$page = "admin.php";
		require("loginsystem.php");
		?>
		
	</div>

	<div id="body">
	<br/>
		<h4><span class ="other"><a href="index.php">Home</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span id="current"><a href="albums.php">Photos</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="other"><a href="admin.php">Admin</a></span></h4>
		
	<?php 
	//if the correct user is accessing
	if(isset($_SESSION['user'])){
		echo("<div id=\"disclaimer\">
		<h1>Edit Albums</h1>
		<p>Hi! Welcom admin! <br/><br/>
		If you are able to view this page, it means that you have been given permission <br/> 
		by the webmaster to edit the site as you see fit.<br/><br/>
		Fill out the form below to edit the album. <br/><br/>
		You can enter only a few of the fields if you do not want to edit everything, however, if no<br/>
		fields are entered, naturally nothing will be modified. </p>
		</div>");
		
		$aid=$_GET['aid'];
		
		//if user has not submitted form/deleted yet
		if((!isset($_POST['submit']))&&(!isset($_GET['action']))){
			require("dbinfo.config.inc");
			$mysqli=new mysqli($host, $username, $password, $database);
			$result=$mysqli->query("SELECT * FROM PhotoAlbums WHERE aid=$aid");
			$info=$result->fetch_row();
			echo("<p><img src=\"$info[4]\" alt=\"$info[1]\" width=\"300\" height=\"200\" class=\"photothumbnail\"/><br/>
			<strong>Title:</strong> $info[1]<br/>
			<strong>Date Created:</strong> $info[2]<br/>
			<strong>Date Modified:</strong> $info[3]<br/>
			</p>");
			require("editalbumform.php");	
		}else{ 
			//if user wants to delete the photo
			if(isset($_GET['action'])){
			require("dbinfo.config.inc");
			$mysqlidelete=new mysqli($host, $username, $password, $database);
			$querydelete="DELETE FROM PhotoAlbums WHERE aid=$aid";
			$resultdelete=$mysqlidelete->query($querydelete);
			echo("<p><br/><br/>You have successfully deleted the album!</p>");
			
			//if the user wants to edit the album
			}else if(isset($_POST['submit'])){
				$albumtitle= strip_tags($_POST['albumtitle']);
				$datecyr=strip_tags($_POST['datecyr']);
				$datecmonth=strip_tags($_POST['datecmonth']);
				$datecday=strip_tags($_POST['datecday']);
				$datemodyr=strip_tags($_POST['datemodyr']);
				$datemodmonth=strip_tags($_POST['datemodmonth']);
				$datemodday=strip_tags($_POST['datemodday']);
				$coverphoto=$_POST['coverphoto'];
				
				//updating title
				if(trim($albumtitle)==""){
					echo("<p class=\"wrongpass\">WARNING: You haven't entered anything for album title.</p>");
				}else{ 
				require("dbinfo.config.inc");
				$mysqliupdate=new mysqli($host, $username, $password, $database);
				$queryupdate="UPDATE PhotoAlbums SET title=\"$albumtitle\" WHERE aid=$aid";
				$resultupdate=$mysqliupdate->query($queryupdate);}
				
				//updating date created
				if(!preg_match("/^[1][0-9]{3}|[2][0][0-1][0-9]$/", $datecyr)){
					
					echo("<p class=\"wrongpass\"> WARNING: Year Created is incorrect, it has to be from 1000-2019.</p>");
				}else{
					if(!preg_match("/^[1][0-2]$|^[0][0-9]$/", $datecmonth)){
						
						echo("<p class=\"wrongpass\"> WARNING: Month Created is incorrect, it has to be from 01-12.</p>");
						}else{
							if(!preg_match("/^[0][1-9]|[1-2][0-9]$|^[3][0-1]$/", $datecday)){
								
								echo("<p class=\"wrongpass\"> WARNING: Date Created is incorrect, it has to be from 01-31.</p>");
								}else{
									require("dbinfo.config.inc");
									$mysqliupdatedc=new mysqli($host, $username, $password, $database);
									$queryupdatedc="UPDATE PhotoAlbums SET created='$datecyr-$datecmonth-$datecday' WHERE aid=$aid";
									$resultupdatedc=$mysqliupdatedc->query($queryupdatedc);}
						}
				}		
				
				//update date modified
				if(!preg_match("/^[1][0-9]{3}|[2][0][0-1][0-9]$/", $datemodyr)){
					
					echo("<p class=\"wrongpass\"> WARNING: Year Modified is incorrect, it has to be from 1000-2019.</p>");
				}else{			
					if(!preg_match("/^[1][0-2]$|^[0][0-9]$/", $datemodmonth)){
						
						echo("<p class=\"wrongpass\"> WARNING: Month Modified is incorrect, it has to be from 01-12.</p>");
					}else{
						if(!preg_match("/^[0][1-9]|[1-2][0-9]$|^[3][0-1]$/", $datemodday)){
	
						echo("<p class=\"wrongpass\"> WARNING: Date Modified is incorrect, it has to be from 01-31.</p>");
						}else{
							require("dbinfo.config.inc");
							$mysqliupdatedm=new mysqli($host, $username, $password, $database);
							$queryupdatedm="UPDATE PhotoAlbums SET modified='$datemodyr-$datemodmonth-$datemodday' WHERE aid=$aid";
							$resultupdatedm=$mysqliupdatedm->query($queryupdatedm);}
					}	
				}
				
				//updating coverphoto
				if($coverphoto==""){
					echo("<p class=\"wrongpass\"> WARNING: No cover photo was selected.</p>");
				}else{	
					require("dbinfo.config.inc");
					$mysqliupdatecp=new mysqli($host, $username, $password, $database);
					$queryupdatecp="UPDATE PhotoAlbums SET coverphoto=\"$coverphoto\" WHERE aid=$aid";
					$resultupdatecp=$mysqliupdatecp->query($queryupdatecp);}
				
				echo("<p><br/><br/>You have successfully updated the album<br/>
				Click <a href=\"editalbum.php?&amp;aid=$aid\">here</a> if you want to edit it again.</p>");
				
			}
			
		}
	
	//if unauthorized user is accessing	
	}else{ echo("<div id=\"disclaimer\">
		<h1>WARNING</h1>
		<p>An WARNING has occured, please click on any of the tabs to be redirected.</p>");
		}
		
	echo("</div>");
	
	
	?>
		
		
	
</body>
</html>