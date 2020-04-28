<?php
include_once('dbConnect.php');
//use a while loop to loop while we are still able to fetch results.
//perhaps we could fetch the results into an array, and then measure the length of the array.
//while($row = mysqli_fetch_array($result)) {
//	echo "<option value=" . $row['CityCode'] . ">" . $row['geocities.AsciiName'] . "</option>";
//};
?>
<!-- I don't think you can have a radio button outside of a form element. So if the radio is insideof form, -->
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/1462a14240.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<link rel="stylesheet" href="styles.css" />
</head>
<body>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

<button id="AscendingButton" type="button">Ascending</button>
<button id="DescendingButton" type="button">DescendingButton</button>

<form>
<input id="radiobutton1" type="radio" name="radio" value="1"><label id="PostLabel">Post Name:</label><input id="PostInput" type="text" name="Post" /><br>
<input id="radiobutton2" type="radio" name="radio" value="2"><label>Image Title:</label><input class="ImageSearchForm" type="text" name="Image" /><br>
<label class="ImageSearchForm">City: </label><select class="ImageSearchForm" name="City">
<option>Choose</option>
<?php
$sql = "SELECT Distinct(AsciiName) FROM geocities, travelimagedetails WHERE GeoNameID = CityCode ORDER BY AsciiName ASC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)) {
	echo "<option>" . $row['AsciiName'] . "</option>";
};
//$sql = "SELECT ImageID, Path, Title, CityCode, travelimagedetails.CountryCodeISO, AsciiName FROM (travelimage NATURAL JOIN travelimagedetails), geocities WHERE CityCode = GeoNameID";
echo "</select><br>";
?>
<label class="ImageSearchForm">Country: </label><select class="ImageSearchForm" name="Country">
<option>Choose</option>
<?php
$sql = "SELECT Distinct(CountryName) FROM geocountries, travelimagedetails WHERE geocountries.ISO = travelimagedetails.CountryCodeISO ORDER BY CountryName ASC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)) {
	echo "<option>" . $row['CountryName'] . "</option>";
};
?>
</select><br>
<input type="submit" />
</form>

<div id="unordered">
<?php
//If the user is searching for posts...
//else...
$presql = "SELECT ImageID, Path, Title, CityCode, travelimagedetails.CountryCodeISO, AsciiName, CountryName FROM (travelimage NATURAL JOIN travelimagedetails), geocities, geocountries WHERE CityCode = geocities.GeoNameID AND geocities.CountryCodeISO = geocountries.ISO";
if(isset($_GET['Image'])&& !empty($_GET['Image'])) {
	if(isset($_GET['City'])&& !empty($_GET['City']) && $_GET['City'] != "Choose") {//Do I need the quotes?
		if(isset($_GET['Country'])&& !empty($_GET['Country']) && $_GET['Country'] != "Choose") {
			//then all 3 input fields have been filled out
			$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_GET[Image]' AND AsciiName = '$_GET[City]' AND CountryName = '$_GET[Country]'";
		}
		else
			//only Image and City have been selected
			$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_GET[Image]' AND AsciiName = '$_GET[City]'";
	}
	else {
		//if Country is selected but not city, then Image and Country are both selected in this case
		if(isset($_GET['Country'])) {
			$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_GET[Image]' AND CountryName = '$_GET[Country]'";
		}
		//else only Image is selected, so act accordingly.
		$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_GET[Image]'";
	}
}
else {
	//Image is not selected, so we see if City is selected and if so see if Country is selected
	if(isset($_GET['City']) && !empty($_GET['City']) && $_GET['City'] != "Choose") {
		//Image is not set, but City is. Now see if Country is set.
		if(isset($_GET['Country']) && !empty($_GET['Country']) && $_GET['Country'] != "Choose") {
			//Image is not set, but City and Country are
			$sql = "SELECT * FROM ($presql) AS pencil WHERE AsciiName = '$_GET[City]' AND CountryName = '$_GET[Country]'";
		}
		else {
			//Neither Image nor Country is set. Only City is set.
			$sql = "SELECT * FROM ($presql) AS pencil WHERE AsciiName = '$_GET[City]'";
		}
	}
	else {
		//Neither Image nor City are set. See if Country is set.
		if(isset($_GET['Country'])) {
			//Only Country is set
			$sql = "SELECT * FROM ($presql) AS pencil WHERE CountryName = '$_GET[Country]'";
		}
		else
			$sql = "";
	}
}
if(isset($sql) && !empty($sql)) {
	echo "The query is " . $sql . "<br>";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)) {
		echo "<a href='#'>" . $row['Title'] . "</a><br>";
	};
}
?>
</div>
<div id="ascending"></div>
<div id="descending"></div>

<button id="testbutton" type="button">press me</button>
<script>
$(function() {
	$("#radiobutton1").on("click", function() {
		//$("#PostLabel").css("display", "none");
		$("#PostInput").css("display", "inline-block");
		$(".ImageSearchForm").css("display", "none");
	});
	$("#radiobutton2").on("click", function() {
		$("#PostInput").css("display", "none");
		$(".ImageSearchForm").css("display", "block");
	});
	//Now write the code for the ascending/descending buttons
	$("#AscendingButton").on("click", function() {
		<?php
		if(isset($DisplayOrder) && !empty($DisplayOrder)) {
			//we know that one of the info is being displayed in either ascending or desc
			if($DisplayOrder == 1) {
				//we know that we are displaying information in ascending order
				//we want to hide the other two divs and unhide our div, which may or may not be hidden
			?>
			<script>
				$("#unordered").css("visibility", "hidden");
				$("#descending").css("visibility", "hidden");
				$("#ascending").css("visibility", "visible");
			</script>
			<?php
				//Now figure out if we are displaying posts or images.
				if(isset($_GET['radio']) && !empty($_GET['radio'])) {
					//we know that $_GET['radio'] equals one or two. Figure out which one.
					if($_GET['radio'] == 1) {
						//we know we are currently displaying post data
						//determine the $sql variable value and query the database
						//if we are currently displaying posts...
						//else...
						$presql = "SELECT ImageID, Path, Title, CityCode, travelimagedetails.CountryCodeISO, AsciiName, CountryName FROM (travelimage NATURAL JOIN travelimagedetails), geocities, geocountries WHERE CityCode = geocities.GeoNameID AND geocities.CountryCodeISO = geocountries.ISO";
						if(isset($_GET['Image'])&& !empty($_GET['Image'])) {
							if(isset($_GET['City'])&& !empty($_GET['City']) && $_GET['City'] != "Choose") {//Do I need the quotes?
								if(isset($_GET['Country'])&& !empty($_GET['Country']) && $_GET['Country'] != "Choose") {
									//then all 3 input fields have been filled out
									$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_GET[Image]' AND AsciiName = '$_GET[City]' AND CountryName = '$_GET[Country]'";
								}
								else
									//only Image and City have been selected
									$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_GET[Image]' AND AsciiName = '$_GET[City]'";
							}
							else {
								//if Country is selected but not city, then Image and Country are both selected in this case
								if(isset($_GET['Country'])) {
									$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_GET[Image]' AND CountryName = '$_GET[Country]'";
								}
								//else only Image is selected, so act accordingly.
								$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_GET[Image]'";
							}
						}
						else {
							//Image is not selected, so we see if City is selected and if so see if Country is selected
							if(isset($_GET['City']) && !empty($_GET['City']) && $_GET['City'] != "Choose") {
								//Image is not set, but City is. Now see if Country is set.
								if(isset($_GET['Country']) && !empty($_GET['Country']) && $_GET['Country'] != "Choose") {
									//Image is not set, but City and Country are
									$sql = "SELECT * FROM ($presql) AS pencil WHERE AsciiName = '$_GET[City]' AND CountryName = '$_GET[Country]'";
								}
								else {
									//Neither Image nor Country is set. Only City is set.
									$sql = "SELECT * FROM ($presql) AS pencil WHERE AsciiName = '$_GET[City]'";
								}
							}
							else {
								//Neither Image nor City are set. See if Country is set.
								if(isset($_GET['Country'])) {
									//Only Country is set
									$sql = "SELECT * FROM ($presql) AS pencil WHERE CountryName = '$_GET[Country]'";
								}
								else
									$sql = "";
							}
						}
						
						//radio equals one, and we have our sql statement. We must now query the DB...
						if(isset($sql) && !empty($sql)) {
							echo "The query is " . $sql . "<br>";
							$result = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($result)) {
								echo "<a href='#'>" . $row['Title'] . "</a><br>";
							};
						}
					}
				}
			}
		}
		?>
	});
});
</script>
</body>
</html>