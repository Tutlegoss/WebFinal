<?php 
	require_once("dbconnect.php");

	function filter()
	{
		global $conn;
		try {	
			$sql = "SELECT   travelimagedetails.ImageID as ImageID, Title, Path 
                    FROM     travelimagedetails JOIN travelimage
                    WHERE "; 
			if($_GET['country'] != 'null' && $_GET['city'] == 'null') {
				if(!($sql_images = $conn->prepare($sql . "CountryCodeISO = ? AND travelimagedetails.ImageID = travelimage.ImageID"))) {
					echo "Prepare failed: (" . $conn->errno . ")" . $conn->error;
					return;
				}
				$sql_images->bind_param("s", $_GET['country']);
			}
			else if($_GET['city'] != 'null' && $_GET['country'] == 'null') {
				if(!($sql_images = $conn->prepare($sql . "CityCode = ? AND travelimagedetails.ImageID = travelimage.ImageID"))) {
					echo "Prepare failed: (" . $conn->errno . ")" . $conn->error;
					return;
				}
				$sql_images->bind_param("i", $_GET['city']);
			}
			else {
				if(!($sql_images = $conn->prepare($sql . "CityCode = ? AND CountryCodeISO = ? AND travelimagedetails.ImageID = travelimage.ImageID"))) {
					echo "Prepare failed: (" . $conn->errno . ")" . $conn->error;
					return;
				}
				$sql_images->bind_param("is",  $_GET['city'], $_GET['country'],);
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
