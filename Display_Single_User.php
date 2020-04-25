<?php
//connect to the database
include_once('dbConnect.php');
//Now I think I write sql.
//if(isset($_GET['userid']) && !empty($_GET['userid'])) {
	//create the sql
	$_GET['userid'] = 5;
	$userid = $_GET['userid'];
	$sql = "SELECT * FROM traveluserdetails WHERE UID = $userid";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	echo "Name: " . $row['FirstName'] . " " . $row['LastName'] . "<br>";
	
	
	$sql = "SELECT PostID, UID, Title FROM travelpost WHERE UID = $userid";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)) {
		echo "<a href='#'>" . $row['Title'] . "</a><br>";//The link should take you to the appropriate page and the link should also include $_GET['userid']?
	};
	
	$sql = "SELECT ImageID, Path FROM travelimage WHERE UID = $userid";
	while($row = mysqli_fetch_array($result)) {
		
	}
//}
?>