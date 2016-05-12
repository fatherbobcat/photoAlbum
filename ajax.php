<?php
	$aid=$_GET['aid'];
	$pid=$_GET['pid'];
	$name=$_GET['funct'];
	
	if($name=="n"){
	require("dbinfo.config.inc");
	$mysqli=new mysqli($host, $username, $password, $database);
	$result=$mysqli->query("SELECT pid FROM PhotoinAlbumlog WHERE pid>$pid AND aid=$aid ORDER BY pid ASC LIMIT 1");
	$num = $result->num_rows;
	$info=$result->fetch_row();
		$newpid=$info[0];
	}else{
	require("dbinfo.config.inc");
	$mysqliprev=new mysqli($host, $username, $password, $database);
	$resultprev=$mysqliprev->query("SELECT pid FROM PhotoinAlbumlog WHERE pid<$pid AND aid=$aid ORDER BY pid DESC LIMIT 1");
	$num = $resultprev->num_rows;
	$infoprev=$resultprev->fetch_row();
		$newpid=$infoprev[0];
	}
	if($num!=0){
		
		//$info=$result->fetch_row();
		//$newpid=$info[0];
		//$mysqli->close();
		
		$mysqli2=new mysqli($host, $username, $password, $database);
		$result2=$mysqli2->query("SELECT * FROM Photos WHERE pid=$newpid");
		$info2=$result2->fetch_row();
		echo("var aid = \"$aid\"; var url=\"".$info2[1]."\"; var caption=\"".$info2[2]."\"; var date=\"".$info2[3]."\"; var pid=\"".$info2[0]."\";");
	}
?>