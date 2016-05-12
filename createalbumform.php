<?php		
	echo("<p> <br/><br/>
		Fill out the form below to create a new Photo Album!</p>
		<form action=\"admin.php\" method=\"post\" enctype=\"multipart/form-data\" >
		<fieldset><legend>Create a New Album</legend><br/>
		<label>Album Title:</label><input type=\"text\" name=\"newalbumtitle\"/><br/><br/>");
	require("dbinfo.config.inc");
	$mysqli=new mysqli($host, $username, $password, $database);
	$result=$mysqli->query("SELECT pid, caption FROM Photos");
	echo("<label>Coverphoto:</label>
		<select name = \"coverphoto\">");
	while($info=$result->fetch_row()){
		echo("<option value=\"$info[0]\">$info[1]</option>");}
	echo("</select><br/><br/>
		<input type=\"submit\" name=\"newalbum\" value=\"Create!\"/>
		</fieldset>
		</form>");
?>