<?php require_once("../inc/header.inc.php"); 
if(isset($_POST['search'])){
	$fil=$_POST['search'];
	header("Location: search.php?filter=$fil"); 
}

?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>
			<div class="col-12 col-lg-10 mt-3 mb-3">
				<?php 
					//use a while loop to loop while we are still able to fetch results.
					//perhaps we could fetch the results into an array, and then measure the length of the array.
					//while($row = mysqli_fetch_array($result)) {
					//	echo "<option value=" . $row['CityCode'] . ">" . $row['geocities.AsciiName'] . "</option>";
					//};
				?>
				<!-- I don't think you can have a radio button outside of a form element. So if the radio is insideof form, -->

				<button id="PostsButton" type="button">Find Post</button>
				<form>
					<label>Post Name:</label><input type="text" name="Post" /><br>
					<input type="submit" /><br><br>
				</form>

				<button id="ImagesButton" type="button">Find Images</button>
				<form method="GET" action="">
					<label>Image Title:</label><input type="text" name="Image" /><br>
					<label>City: </label><select name="City">
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
					<label>Country: </label><select name="Country">
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
						$presql = "SELECT ImageID, Path, Title, CityCode, travelimagedetails.CountryCodeISO, AsciiName, CountryName FROM (travelimage NATURAL JOIN travelimagedetails), geocities, geocountries WHERE CityCode = geocities.GeoNameID AND geocities.CountryCodeISO = geocountries.ISO";
						$sql;
						if(isset($_GET['Image'])&& !empty($_GET['Image'])) {
							if(isset($_GET['City'])&& !empty($_GET['City']) && $_GET['City'] != "Choose") {//Do I need the quotes?
								if(isset($_GET['Country'])&& !empty($_GET['Country']) && $_GET['Country'] != "Choose") {
									//then all 3 input fields have been filled out
									$sql = "SELECT * FROM $presql AS pencil WHERE Title = $_GET[Image] AND AsciiName = $_GET[City] AND CountryName = $_GET[Country]";
								}
								else
									//only Image and City have been selected
									$sql = "SELECT * FROM $presql AS pencil WHERE Title = $_GET[Image] AND AsciiName = $_GET[City]";
							}
							else {
								//if Country is selected but not city, then Image and Country are both selected in this case
								if(isset($_GET['Country'])) {
									$sql = "SELECT * FROM $presql AS pencil WHERE Title = $_GET[Image] AND CountryName = $_GET[Country]";
								}
								//else only Image is selected, so act accordingly.
								$sql = "SELECT * FROM $presql AS pencil WHERE Title = $_GET[Image]";
							}
						}
						else {
							//Image is not selected, so we see if City is selected and if so see if Country is selected
							if(isset($_GET['City']) && !empty($_GET['City']) && $_GET['City'] != "Choose") {
								//Image is not set, but City is. Now see if Country is set.
								if(isset($_GET['Country']) && !empty($_GET['Country']) && $_GET['Country'] != "Choose") {
									//Image is not set, but City and Country are
									$sql = "SELECT * FROM $presql AS pencil WHERE AsciiName = $_GET[City] AND CountryName = $_GET[Country]";
								}
								else {
									//Neither Image nor Country is set. Only City is set.
									$sql = "SELECT * FROM $presql AS pencil WHERE AsciiName = $_GET[City]";
								}
							}
							else {
								//Neither Image nor City are set. See if Country is set.
								if(isset($_GET['Country'])) {
									//Only Country is set
									$sql = "SELECT * FROM $presql AS pencil WHERE CountryName = $_GET[Country]";
								}
							}
						}
						if(isset($sql) && !empty($sql)) {
							echo "The query is " . $sql . "<br>";
							$result = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($result)) {
								echo $row['ImageID'] . "<br>";
							};
						}
					?>
				</div>
				<div id="ascending"></div>
				<div id="descending"></div>
				<button id="testbutton" type="button">press me</button>
			</div>
		</div>
	</div>
	
	<script>
	$(function() {
		$("#testbutton").on("click", function() {
			<?php
			$sql = "SELECT * FROM travelimage";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			?>
			//we now have to make a paragraph and echo our php variable in it and then append it to
			//some div
			var a = $('<a>', {
				text: '<?php echo $row['ImageID']; ?>'
			});
			$("#dog").append(a);
		});
	});
	</script>
<?php require_once("../inc/footer.inc.php"); ?>