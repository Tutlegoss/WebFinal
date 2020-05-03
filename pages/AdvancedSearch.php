<?php
require_once("../inc/header.inc.php");
require_once('../inc/dbconnect.php');

if(isset($_GET['DisplayOrder']) && !empty($_GET['DisplayOrder'])) {
	$_SESSION['DisplayOrder'] = $_GET['DisplayOrder'];
}
//find out if radio is set and if it equals 1 or 2
if(isset($_GET['radio']) && !empty($_GET['radio'])) {
	//radio is set
	$_SESSION['radio'] = $_GET['radio'];
	if($_GET['radio'] == 1) {
		//set SESSION['Post']
		$_SESSION['Post'] = $_GET['Post'];
	}
	else {
		//GET[radio] must equal 2
		if(isset($_GET['Image']) && !empty($_GET['Image'])) {
			$_SESSION['Image'] = $_GET['Image'];
		}
		if(isset($_GET['City']) && !empty($_GET['City'])) {
			$_SESSION['City'] = $_GET['City'];
		}
		if(isset($_GET['Country']) && !empty($_GET['Country'])) {
			$_SESSION['Country'] = $_GET['Country'];
		}
	}
}
if(isset($_GET['DisplayOrder']) && !empty($_GET['DisplayOrder'])) {
	$_SESSION['DisplayOrder'] = $_GET['DisplayOrder'];
	echo "At this point, the SESSION[DisplayOrder] variable aught to be 2 (I think)" . "<br>";
}
//At this point, what about the $sql variable?
if(isset($_SESSION['radio']) && !empty($_SESSION['radio']) && $_SESSION['radio'] == 1) {
	//we know that we are displaying posts
	$sql = "SELECT PostID, Title FROM travelpost WHERE Title LIKE '%$_SESSION[Post]%'";
}
else if(isset($_SESSION['radio']) && !empty($_SESSION['radio']) && $_SESSION['radio'] == 2) {
	//we know we are displaying images
	$presql = "SELECT ImageID, Path, Title, CityCode, travelimagedetails.CountryCodeISO, AsciiName, CountryName FROM (travelimage NATURAL JOIN travelimagedetails), geocities, geocountries WHERE CityCode = geocities.GeoNameID AND geocities.CountryCodeISO = geocountries.ISO";
	if(isset($_SESSION['Image'])&& !empty($_SESSION['Image'])) {
		if(isset($_SESSION['City'])&& !empty($_SESSION['City']) && $_SESSION['City'] != "Choose") {//Do I need the quotes?
			if(isset($_SESSION['Country'])&& !empty($_SESSION['Country']) && $_SESSION['Country'] != "Choose") {
				//then all 3 input fields have been filled out
				$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_SESSION[Image]' AND AsciiName = '$_SESSION[City]' AND CountryName = '$_SESSION[Country]'";
			}
			else
				//only Image and City have been selected
				$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_SESSION[Image]' AND AsciiName = '$_SESSION[City]'";
		}
		else {
			//if Country is selected but not city, then Image and Country are both selected in this case
			if(isset($_SESSION['Country'])) {
				$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_SESSION[Image]' AND CountryName = '$_SESSION[Country]'";
			}
			//else only Image is selected, so act accordingly.
			$sql = "SELECT * FROM ($presql) AS pencil WHERE Title = '$_SESSION[Image]'";
		}
	}
	else {
		//Image is not selected, so we see if City is selected and if so see if Country is selected
		if(isset($_SESSION['City']) && !empty($_SESSION['City']) && $_SESSION['City'] != "Choose") {
			//Image is not set, but City is. Now see if Country is set.
			if(isset($_SESSION['Country']) && !empty($_SESSION['Country']) && $_SESSION['Country'] != "Choose") {
				//Image is not set, but City and Country are
				$sql = "SELECT * FROM ($presql) AS pencil WHERE AsciiName = '$_SESSION[City]' AND CountryName = '$_SESSION[Country]'";
			}
			else {
				//Neither Image nor Country is set. Only City is set.
				$sql = "SELECT * FROM ($presql) AS pencil WHERE AsciiName = '$_SESSION[City]'";
			}
		}
		else {
			//Neither Image nor City are set. See if Country is set.
			if(isset($_SESSION['Country'])) {
				//Only Country is set
				$sql = "SELECT * FROM ($presql) AS pencil WHERE CountryName = '$_SESSION[Country]'";
			}
			else
				$sql = "";
		}
	}
}
if(isset($sql)) {
	echo $sql . "<br>";
}
//At this point, $sql is set, though I think it could be ""
if(isset($sql) && !empty($sql)) {
	if(isset($_SESSION['radio']) && !empty($_SESSION['radio']) && $_SESSION['radio'] == 1) {
		if(isset($_SESSION['DisplayOrder']) && !empty($_SESSION['DisplayOrder']) && $_SESSION['DisplayOrder'] == 1) {
			//DisplayOrder equals 1
			$ultimatesql = "($sql) ORDER BY Title ASC";
		}
		else if(isset($_SESSION['DisplayOrder']) && !empty($_SESSION['DisplayOrder']) && $_SESSION['DisplayOrder'] == 2) {
			//DisplayOrder equals 2
			$ultimatesql = "($sql) ORDER BY Title DESC";
		}
		else {
			//DisplayOrder is not set
			$ultimatesql = $sql;
		}
	}
	else if(isset($_SESSION['radio']) && !empty($_SESSION['radio']) && $_SESSION['radio'] == 2) {
		//we are displaying images
		if(isset($_SESSION['DisplayOrder']) && !empty($_SESSION['DisplayOrder']) && $_SESSION['DisplayOrder'] == 1) {
			//DisplayOrder equals 1
			$ultimatesql = "($sql) ORDER BY Title ASC";
		}
		else if(isset($_SESSION['DisplayOrder']) && !empty($_SESSION['DisplayOrder']) && $_SESSION['DisplayOrder'] == 2) {
			//DisplayOrder equals 2
			$ultimatesql = "($sql) ORDER BY Title DESC";
		}
	}
}
?>
	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>
			
			<div class="col-12 col-lg-10 mt-3 mb-3">
				<div class="container d-flex">
					<div class="row justify-content-center align-self-center mx-auto">
						<form method="GET" action="">
							<input type="text" name="DisplayOrder" value="1" style="display: none;">
							<input id="AscendingButton" type="submit" value="Ascending">
						</form>
						<form method="GET" action="">
							<input type="text" name="DisplayOrder" value="2" style="display: none;">
							<input id="DescendingButton" type="submit" value="Descending">
						</form>

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

						<?php
						//$sql = "";
						echo $ultimatesql . "<br>";
						if(isset($_SESSION['radio']) && !empty($_SESSION['radio']) && $_SESSION['radio'] == 1) {
							//we know we are searching for posts
							echo "I think the ultimatesql variable is " . $ultimatesql . "<br>";
							$result = mysqli_query($conn, $ultimatesql);
							while($row = mysqli_fetch_array($result)) {
								echo $row['Title'] . "<br>";
							};
							$sql = "";
						}
						//else, if the user is searching for images...
						else if(isset($_SESSION['radio']) && !empty($_SESSION['radio']) && $_SESSION['radio'] == 2){
							//we know we are searching for images
							//echo "The query is " . $sql . "<br>";
							$result = mysqli_query($conn, $ultimatesql);
							while($row = mysqli_fetch_array($result)) {
								echo "<a href='#'>" . $row['Title'] . "</a><br>" . "<a href='#'><img src='images/thumb/$row[Path]'></a><br><br>";
							};
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
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
	//Now add the code for the ascending/descending buttons
	$("#AscendingButton").on("click", function() {
		$_SESSION['DisplayOrder'] = 1;
		//Now redirect us to the same page
		location.href='http://localhost/Web2Final/AdvancedSearchBackup.php';
	});
	$("#AscendingButton").on("click", function() {
		$_SESSION['DisplayOrder'] = 2;
		//Now redirect us to the same page
		location.href='http://localhost/Web2Final/AdvancedSearchBackup.php';
	});
});
</script>

<?php require_once("../inc/footer.inc.php");?>
