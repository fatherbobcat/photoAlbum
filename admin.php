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
		<span class="other"><a href="albums.php">Photos</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span id="current"><a href="admin.php">Admin</a></span></h4>
		
	<?php 
	//if the user is logged in, allow them to create photo/albums
	if(isset($_SESSION['user'])){
	echo("<div id=\"disclaimer\">
	<h1>Admin Page</h1>
	<p>Hi! Welcom admin! <br/><br/>
	If you are able to view this page, it means that you have been given permission <br/> 
	by the webmaster to edit the site as you see fit.<br/><br/>
	To <strong>edit or delete photos</strong>, go to each photo album and click the edit button on each photo. <br/>
	To <strong>edit or delte albums </strong>, go to the album page and click on the edit button. <br/>
	If you want to <strong>add photos, or photo albums</strong>, fill out the form below. <br/><br/>
	Note: The date modified and created will be defaulted to the <strong>current date</strong>, <br/>
	you can change it in the photo albums page. The caption is set to the <strong>name of your file</strong>,<br/>
	you can change it in the photo albums page. In addition, you can only upload supported image files<br/>
	jpeg, bmp or png. </p>
	</div>");
	
	$displayform=true;
		
		//user wants to create new album
		if(isset($_POST['newalbum'])){
			
			$albumtitle=strip_tags($_POST['newalbumtitle']);
			$pid = $_POST['coverphoto'];
			$date=Date("Y-m-d");
			
			//user has entered something for album title
			if(trim($albumtitle)!=""){
				$displayform=false;
				require("dbinfo.config.inc");
				$mysqli=new mysqli($host, $username, $password, $database);
				$result=$mysqli->query("SELECT url FROM Photos WHERE pid=\"$pid\"");
				$info=$result->fetch_row();
				$coverphoto=$info[0];
				$query="INSERT INTO PhotoAlbums VALUES(0,\"$albumtitle\",\"$date\",\"$date\",\"$coverphoto\")";
				$result2=$mysqli->query($query);
				$mysqli->close();
				echo("<h3><strong>Congratulations! Your Album has been created!</strong></h3>
				<p><br/><br/>Click <a href=\"admin.php\">here</a> to go back and add another album/ photo.<br/><br/>
				Click <a href=\"albums.php\">here</a> to see your new album.</p>");
				
			//user has not entered something for album title
			}else{
			echo("<p class=\"wrongpass\">WARNING: You did not enter an album name.</p>");
			}
		
		//user wants to upload a photo
		}else if(isset($_POST['uploadphoto'])){
			$filetype = $_FILES['file']['type'];
			
			//if the file is not of the correct filetype
			if(($_FILES['file']['type']!="image/jpeg")&&($_FILES['file']['type']!="image/bmp")&&($_FILES['file']['type']!="image/png")){
				echo("<p class=\"wrongpass\"> WARNING: The type of the file uploaded was incorrect.</p>");
			}else{ //if filetype is correct
				$displayform=false;
				$caption=$_FILES['file']['name'];
				$date=Date("Y-m-d");
				move_uploaded_file($_FILES['file']['tmp_name'], "Images/".$_FILES['file']['name']);
				$url = "Images/".$_FILES['file']['name'];
				$albumin = $_POST['inalbum'];
				require("dbinfo.config.inc");
				$mysqli1=new mysqli($host, $username, $password, $database);
				$result=$mysqli1->query("SELECT MAX(pid) FROM Photos");
				$info=$result->fetch_row();
				$pid=$info[0]+1;
				$query="INSERT INTO Photos VALUES($pid,\"$url\",\"$caption\",\"$date\")";
				$result1=$mysqli1->query($query);
				$query1="INSERT INTO PhotoinAlbumlog VALUES($albumin,$pid)";
				$result2=$mysqli1->query($query1);
				$mysqli1->close();
				echo("<p>You have successfully uploaded your photo!<br/><br/><br/>
					<img src=\"$url\" alt=\"$caption\"/>
					<br/><br/>Click <a href=\"admin.php\">here</a> to go back and add another album/ photo.</p>");
			}
		}
		
		if($displayform==true){
		require("createalbumform.php");
		require("createphotoform.php");}
	
		echo("</div>");	
			
	}else{
	//if user is not logged in, do not allow access
		echo("<p><br/><br/>
			<img src=\"cry.jpeg\" alt=\"crying girl\"/><br/><br/>
			Sorry, you are not authorized to view this page.</p>
			</div>");
	}
	
	?>
		
		
	
</body>
</html>