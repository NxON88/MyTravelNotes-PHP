<?php
	$query = "CREATE USER 'admin'@'localhost'IDENTIFIED BY 'admin' WITH GRANT OPTION";
	$create_user = mysqli_query ($query);
?>