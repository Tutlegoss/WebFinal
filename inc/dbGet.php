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
	
	function getContinentNames() {
		global $conn;
		try {
			if(!($sql_continents = $conn->prepare("SELECT   ContinentName 
												   FROM     geocontinents
												   ORDER BY ContinentName"))) {
				write2Error_Log("SELECT ContinentName in function getContinentNames()");
				return;
			}
			
			$sql_continents->execute();
			$res_continents = $sql_continents->get_result();
			
			while($row_continents = $res_continents->fetch_assoc()) {
				$returned_Data[] = $row_continents['ContinentName'];
			}
			
			return $returned_Data;
		}
		catch(Exception $e) {
			write2Error_Log("getContinentNames(): " . $e);
		}
	}
	
	function getCountryNames() {
		global $conn;
		try {
			if(!($sql_countries = $conn->prepare("SELECT   CountryName 
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
				$returned_Data[] = $row_countries['CountryName'];
			}
			
			return $returned_Data;
		}
		catch(Exception $e) {
			write2Error_Log("getCountryNames(): " . $e);
		}
	}
	
	function getCityNames() {
		global $conn;
		try {
			if(!($sql_cities = $conn->prepare("SELECT   AsciiName 
											   FROM     travelimagedetails JOIN geocities
											   ON       CityCode = GeoNameID
											   GROUP BY CityCode
											   ORDER BY AsciiName"))) {
				write2Error_Log("SELECT AsciiName FROM geocities");
				return;
			}
			
			$sql_cities->execute();
			$res_cities = $sql_cities->get_result();
			
			while($row_cities = $res_cities->fetch_assoc()) {
				$returned_Data[] = $row_cities['AsciiName'];
			}
			
			return $returned_Data;
		}
		catch(Exception $e) {
			write2Error_Log("getCityNames(): " . $e);
		}
	}