<?php
	$link = mysqli_connect('localhost', 'root', '');
	if ($link) {
		echo "Connect OK","<br>";
	}
	else {
		echo "No";
	}
	$db = "MySiteDB";
	$query = "CREATE DATABASE $db";

	$create_db = mysqli_query($link, $query);
	if ($create_db){
		echo "DB create OK","<br>";
	}
	else {
		echo "DB not create";
	}
?>