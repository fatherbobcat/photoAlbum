<?php 
	echo("<p><br/><br/><strong>Or</strong>, just upload a photo using the form from below! </p>
		<form action=\"admin.php\" method=\"post\" enctype=\"multipart/form-data\">
		<fieldset>
		<legend>Upload A Photo</legend><br/>
		<input type=\"file\" name=\"file\"/><br/><br/>");
	require("dbinfo.config.inc");
	$mysqli1=new mysqli($host, $username, $password, $database);
	$result1=$mysqli1->query("SELECT aid, title FROM PhotoAlbums");
	echo("<label>Add to Album:</label>
		<select name = \"inalbum\">");
		while($info1=$result1->fetch_row()){
			echo("<option value=\"$info1[0]\">$info1[1]</option>");}
			echo("</select><br/><br/>
				<input type=\"submit\" name=\"uploadphoto\" value=\"Upload!\"/>
				</fieldset>
				</form>");
	$mysqli1->close();
?>