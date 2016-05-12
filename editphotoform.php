<?php	
	echo("	<form action=\"editphoto.php?pid=$pid&amp;aid=$aid\" method=\"post\">
			<fieldset>
			
			<label>Photo Caption:</label><input type=\"text\" name=\"caption\"/><br/><br/>
			
			<label>Date Taken (YYYY-MM-DD):</label><input type=\"text\" name=\"datetyr\" size=\"3\"/>
			<label>-</label><input type=\"text\" name=\"datetmonth\" size=\"3\"/>
			<label>-</label><input type=\"text\" name=\"datetday\" size=\"3\"/>
			<br/><br/>");
	
	require("dbinfo.config.inc");
	$mysqliform=new mysqli($host, $username, $password, $database);
	$resultform=$mysqliform->query("SELECT aid, title FROM PhotoAlbums");
	echo("<label>Copy to Album:</label>
		<select name = \"copytoalbum\">
		<option value=\"\"></option>");
	while($infoform=$resultform->fetch_row()){
		echo("<option value=\"$infoform[0]\">$infoform[1]</option>");}
	echo("</select><br/><br/>
			<input type=\"submit\" value=\"Update!\" name=\"submit\"/>
			<input type=\"reset\" value=\"Reset\" name=\"submit\"/>
			<a href=\"editphoto.php?action=delete&amp;pid=$pid&amp;aid=$aid\">
			<button type=\"button\">
			Delete</button></a>
			</fieldset>
			</form><br/><br/>
			");
	$mysqliform->close();
?>