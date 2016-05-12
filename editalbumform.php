<?php	
	echo("	<form action=\"editalbum.php?aid=$aid\" method=\"post\">
			<fieldset>
			
			<label>Album Title:</label><input type=\"text\" name=\"albumtitle\"/><br/><br/>
			
			<label>Date Created (YYYY-MM-DD):</label><input type=\"text\" name=\"datecyr\" size=\"3\"/>
			<label>-</label><input type=\"text\" name=\"datecmonth\" size=\"3\"/>
			<label>-</label><input type=\"text\" name=\"datecday\" size=\"3\"/>
			<br/><br/>
			
			<label>Date Modified (YYYY-MM-DD):</label><input type=\"text\" name=\"datemodyr\" size=\"3\"/>
			<label>-</label><input type=\"text\" name=\"datemodmonth\" size=\"3\"/>
			<label>-</label><input type=\"text\" name=\"datemodday\" size=\"3\"/>
			<br/><br/>");
	
	require("dbinfo.config.inc");
	$mysqliform=new mysqli($host, $username, $password, $database);
	$resultform=$mysqliform->query("SELECT url, caption FROM Photos");
	echo("<label>Coverphoto:</label>
		<select name = \"coverphoto\">
		<option value=\"\"></option>");
	while($infoform=$resultform->fetch_row()){
		echo("<option value=\"$infoform[0]\">$infoform[1]</option>");}
	echo("</select><br/><br/>
			<input type=\"submit\" value=\"Update!\" name=\"submit\"/>
			<input type=\"reset\" value=\"Reset\" name=\"submit\"/>
			<a href=\"editalbum.php?action=delete&amp;aid=$aid\">
			<button type=\"button\">
			Delete</button></a>
			</fieldset>
			</form><br/><br/>
			");
	$mysqliform->close();
?>