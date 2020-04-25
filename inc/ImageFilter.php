<?php 
	require_once("dbconnect.php");

	function filter()
	{
		global $conn;
		try {
			if($_GET['country'] == 'ALL' && $_GET['continent'] == 'ALL') {
				if(!($sql_images = $conn->prepare("SELECT   Title, Path, travelimagedetails.ImageID as ImageID 
												   FROM     travelimagedetails JOIN travelimage
                                                   WHERE    travelimagedetails.ImageID = travelimage.ImageID
												   ORDER BY Title ASC"))) {
					echo "Prepare failed: (" . $conn->errno . ")" . $conn->error;
					return;
				}
			}
			else if($_GET['country'] != 'null' && $_GET['continent'] == 'null') {
				if(!($sql_images = $conn->prepare("SELECT   Title, Path, travelimagedetails.ImageID as ImageID 
												   FROM     travelimagedetails JOIN travelimage
                                                   WHERE CountryCodeISO = ? AND travelimagedetails.ImageID = travelimage.ImageID"))) {
					echo "Prepare failed: (" . $conn->errno . ")" . $conn->error;
					return;
				}
				$sql_images->bind_param("s", $_GET['country']);
			}
			else if($_GET['continent'] != 'null' && $_GET['country'] == 'null') {
				if(!($sql_images = $conn->prepare("SELECT Title, Path, travelimagedetails.ImageID as ImageID
				                                   FROM   (geocountries JOIN travelimagedetails) JOIN travelimage
												   WHERE  Continent = ?
												     AND  ISO = CountryCodeISO
													 AND travelimagedetails.ImageID = travelimage.ImageID"))) {
					echo "Prepare failed: (" . $conn->errno . ")" . $conn->error;
					return;
				}
				$sql_images->bind_param("s", $_GET['continent']);
			}
			else {
				if(!($sql_images = $conn->prepare("SELECT Title, Path, travelimagedetails.ImageID as ImageID
				                                   FROM   (geocountries JOIN travelimagedetails) JOIN travelimage
												   WHERE  Continent = ? AND ISO = ?
													 AND ISO = CountryCodeISO AND travelimagedetails.ImageID = travelimage.ImageID"))) {
					echo "Prepare failed: (" . $conn->errno . ")" . $conn->error;
					return;
				}
				$sql_images->bind_param("ss",  $_GET['continent'], $_GET['country'],);
			}

			$sql_images->execute();
			$sql_image = $sql_images->get_result();
			$rowArray = array();
			while ($row = $sql_image->fetch_assoc())
				$rowArray[] = $row;
			echo json_encode($rowArray);
		} catch (Exception $e) {
			die("ImageFilter.php: " . $e);
		}
	}		
	
	exit(filter());
