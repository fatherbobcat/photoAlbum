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
		<h1>Edit Photos</h1>
		<p>Hi! Welcom admin! <br/><br/>
		If you are able to view this page, it means that you have been given permission <br/> 
		by the webmaster to edit the site as you see fit.<br/><br/>
		Fill out the form below to edit the photo. <br/><br/>
		You can enter only a few of the fields if you do not want to edit everything, however, if no<br/>
		fields are entered, naturally nothing will be modified. </p>
		</div>");
		
		$pid=$_GET['pid'];
		$aid=$_GET['aid'];
		
		//if user has not submitted form/deleted yet
		if((!isset($_POST['submit']))&&(!isset($_GET['action']))){
			require("dbinfo.config.inc");
			$mysqli=new mysqli($host, $username, $password, $database);
			$result=$mysqli->query("SELECT * FROM Photos WHERE pid=$pid");
			$info=$result->fetch_row();
			echo("<p><img src=\"$info[1]\" alt=\"$info[2]\" width=\"300\" height=\"200\" class=\"photothumbnail\"/><br/>
			<strong>Caption:</strong> $info[1]<br/>
			<strong>Date Taken:</strong> $info[3]<br/>
			</p>");
			require("editphotoform.php");	
			$mysqli->close();
		}else{ 
	
			if(isset($_GET['action'])){
			require("dbinfo.config.inc");
			$mysqlidelete=new mysqli($host, $username, $password, $database);
			$querydelete="DELETE FROM PhotoinAlbumlog WHERE aid=$aid AND pid=$pid";
			$resultdelete=$mysqlidelete->query($querydelete);
			echo("<p><br/><br/>You have successfully deleted the photo from the album!</p>");
			$mysqlidelete->close();
			//if the user wants to edit the album
			}else
			if(isset($_POST['submit'])){
				$caption= strip_tags($_POST['caption']);
				$datetyr=strip_tags($_POST['datetyr']);
				$datetmonth=strip_tags($_POST['datetmonth']);
				$datetday=strip_tags($_POST['datetday']);
				$copytoalbum=$_POST['copytoalbum'];
				
				//updating title
				if(trim($caption)==""){
					echo("<p class=\"wrongpass\">WARNING: You haven't entered anything for album title.</p>");
				}else{ 
				require("dbinfo.config.inc");
				$mysqliupdate=new mysqli($host, $username, $password, $database);
				$queryupdate="UPDATE Photos SET caption=\"$caption\" WHERE pid=$pid";
				$resultupdate=$mysqliupdate->query($queryupdate);}
				
				//updating date created
				if(!preg_match("/^[1][0-9]{3}|[2][0][0-1][0-9]$/", $datetyr)){
					
					echo("<p class=\"wrongpass\"> WARNING: Year taken is incorrect, it has to be from 1000-2019.</p>");
				}else{
					if(!preg_match("/^[1][0-2]$|^[0][0-9]$/", $datetmonth)){
						
						echo("<p class=\"wrongpass\"> WARNING: Month taken is incorrect, it has to be from 01-12.</p>");
						}else{
							if(!preg_match("/^[0][1-9]|[1-2][0-9]$|^[3][0-1]$/", $datetday)){
								
								echo("<p class=\"wrongpass\"> WARNING: Date taken is incorrect, it has to be from 01-31.</p>");
								}else{
									require("dbinfo.config.inc");
									$mysqliupdatedc=new mysqli($host, $username, $password, $database);
									$queryupdatedc="UPDATE Photos SET date='$datetyr-$datetmonth-$datetday' WHERE pid=$pid";
									$resultupdatedc=$mysqliupdatedc->query($queryupdatedc);}
						}
				}		
				
				//copying photo
				if($copytoalbum==""){
					echo("<p class=\"wrongpass\"> WARNING: Photo was not copied anywhere.</p>");
				}else{	
					require("dbinfo.config.inc");
					$mysqliupdatecp=new mysqli($host, $username, $password, $database);
					$resultupdatecp=$mysqliupdatecp->query("SELECT * FROM PhotoinAlbumlog WHERE pid=$pid AND aid=$copytoalbum");
					if(!($info=$resultupdatecp->fetch_row())){
					$queryupdatecp="INSERT INTO PhotoinAlbumlog VALUES($copytoalbum, $pid)";
					$resultupdatecp1=$mysqliupdatecp->query($queryupdatecp);}
				}
				
				echo("<p><br/><br/>You have successfully updated the album<br/>
				Click <a href=\"editphoto.php?pid=$pid&amp;aid=$aid\">here</a> if you want to edit it again.</p>");
				
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