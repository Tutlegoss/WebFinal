<?php
	require_once("dbconfig.php");

	$conn = new mysqli($servername, $username, $password, $database);

	if(!$conn)
		die("Count not connect: " . mysqli_error($conn));