<?php
	require_once($dir . "inc/dbconnect.php");
	
	function write2Error_Log($error) 
	{
		global $dir;
		$file     = $dir . "err/Error_Log.txt";
		$content  = file_get_contents($file);
		$content .= $error . "\n";
		file_put_contents($file, $content);
	}

/* Functions for leftPanel.inc.php */	
	function getContinentNames() {
		global $conn;
		try {
			if(!($sql_continents = $conn->prepare("SELECT   ContinentName, ContinentCode 
												   FROM     geocontinents
												   ORDER BY ContinentName"))) {
				write2Error_Log("SELECT ContinentName in function getContinentNames()");
				return;
			}
			
			$sql_continents->execute();
			$res_continents = $sql_continents->get_result();
			
			while($row_continents = $res_continents->fetch_assoc()) {
				$returned_Data[] = $row_continents;
			}
			$sql_continents->close();
			return $returned_Data;
		}
		catch(Exception $e) {
			write2Error_Log("getContinentNames(): " . $e);
		}
	}
	
	function getCountryNames() {
		global $conn;
		try {
			if(!($sql_countries = $conn->prepare("SELECT   CountryName, ISO 
												  FROM     travelimagedetails JOIN geocountries
												  ON       CountryCodeISO = ISO
												  GROUP BY CountryCodeISO
												  ORDER BY CountryName"))) {
				write2Error_Log("SELECT CountryName in function getCountryNames()");
				return;
			}
			
			$sql_countries->execute();
			$res_countries = $sql_countries->get_result();

			while($row_countries = $res_countries->fetch_assoc()) {
				$returned_Data[] = $row_countries;
			}
			$sql_countries->close();
			return $returned_Data;
		}
		catch(Exception $e) {
			write2Error_Log("getCountryNames(): " . $e);
		}
	}
	
	function getCityNames() {
		global $conn;
		try {
			if(!($sql_cities = $conn->prepare("SELECT   AsciiName, CityCode
											   FROM     travelimagedetails JOIN geocities
											   ON       CityCode = GeoNameID
											   GROUP BY CityCode
											   ORDER BY AsciiName"))) {
				write2Error_Log("SELECT AsciiName in function getCityNames()");
				return;
			}
			
			$sql_cities->execute();
			$res_cities = $sql_cities->get_result();
			
			while($row_cities = $res_cities->fetch_assoc()) {
				$returned_Data[] = $row_cities;
			}
			$sql_cities->close();
			return $returned_Data;
		}
		catch(Exception $e) {
			write2Error_Log("getCityNames(): " . $e);
		}
	}

/* Functions for /index.php */	
	function getTopRated()
	{
		global $conn;
		try {
			if(!($sql_rated = $conn->prepare("SELECT   ImageID, AVG(Rating), COUNT(Rating)
				                              FROM     travelimagerating
										      GROUP BY ImageID
											  ORDER BY AVG(Rating) DESC"))) {
				write2Error_Log("SELECT ImageID, AVG(Rating), COUNT(Rating) in function getTopRated()");
				return;
			}
			
			$sql_rated->execute();
			$res_rated = $sql_rated->get_result();

			for($i = 0; $i < 10; ++$i) 
				$returned_Data[] = $res_rated->fetch_assoc();
			$sql_rated->close();
			return $returned_Data;			
		}
		catch (Exception $e) {
			write2Error_Log("getTopRated(): " . $e);
		}
	}
	
	function getImageName($ImageID)
	{
		global $conn;
		try {
			if(!($sql_img = $conn->prepare("SELECT Path, Title
				                            FROM   travelimage JOIN travelimagedetails
											ON     travelimage.ImageID = travelimagedetails.ImageID
										    WHERE  travelimage.ImageID = $ImageID"))) {
				write2Error_Log("SELECT Path, Title in function getImageName()");
				return;
			}
			
			$sql_img->execute();
			$res_img = $sql_img->get_result();
			$sql_img->close();
			return $res_img->fetch_assoc();
		}
		catch (Exception $e) {
			write2Error_Log("getImageName(): " . $e);
		}		
	}
	
	function getNewAdditions()
	{
		global $conn;
		try {
			if(!($sql_new = $conn->prepare("SELECT   Path, ImageID
				                            FROM     travelimage
										    ORDER BY ImageID DESC"))) {
				write2Error_Log("SELECT Path, ImageID in function getNewAdditions()");
				return;
			}
			
			$sql_new->execute();
			$res_new = $sql_new->get_result();

			for($i = 0; $i < 10; ++$i) 
				$returned_Data[] = $res_new->fetch_assoc();
			$sql_new->close();
			return $returned_Data;			
		}
		catch (Exception $e) {
			write2Error_Log("getTopRated(): " . $e);
		}
	}
	
/* Function for Posts.php */
	function getPostList()
	{
		global $conn;
		try {
			if(!($sql_posts = $conn->prepare("SELECT   PostID, Title 
			                                  FROM     travelpost 
											  ORDER BY Title ASC"))) {
				write2Error_Log("SELECT PostID, Title in function getPostList()");
				return;
			}
			
			$sql_posts->execute();
			$res_posts = $sql_posts->get_result();
			
			while($row_posts = $res_posts->fetch_assoc()) {
				$returned_Data[] = $row_posts;
			}
			$sql_posts->close();
			return $returned_Data;			
		}
		catch (Exception $e) {
			write2Error_Log("getPostList(): " . $e);
		}		
	}
	
/* Function for User.php */
	function getUserList()
	{
		global $conn;
		try {
			if(!($sql_users = $conn->prepare("SELECT   FirstName, LastName, UID
			                                  FROM     traveluserdetails 
											  ORDER BY LastName ASC, FirstName ASC"))) {
				write2Error_Log("SELECT FirstName, LastName, UID in function getUserList()");
				return;
			}
			
			$sql_users->execute();
			$res_users = $sql_users->get_result();
			
			while($row_users = $res_users->fetch_assoc()) {
				$returned_Data[] = $row_users;
			}
			$sql_users->close();
			return $returned_Data;			
		}
		catch (Exception $e) {
			write2Error_Log("getUserList(): " . $e);
		}		
	}