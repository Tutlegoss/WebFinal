<?php require_once("../inc/header.inc.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>

			<div class="col-12 col-lg-10 mt-3 mb-3" id="countryCity">
				<?php 
					if(isset($_GET['city'])) {
						$data = getCityInfo($_GET['city']);
						$fileName = explode(' ',$data['AsciiName'])[0];
						$Lon = $data['Longitude'];
						$Lat = $data['Latitude'];
						echo $Lon;
						echo $Lat;
						
						echo "<h2>$data[AsciiName]</h2>";
						echo '<div class=" mt-3 mx-auto" id="map"></div>';
						/*echo '<img src="../img/Maps/'.$fileName.'.PNG" alt="'.$data['AsciiName'].'">';*/
						echo '<div class="row justify-content-center">
						      <div class="col-6">
							  <div class="card mt-3 mx-auto">
								  <table class="table mb-0"> 
									  <tr class="card-header">
										  <td class="text-white" colspan="3">'.$data['AsciiName'].' Details</td>
									  </tr>
									  <tr>
										  <th scope="row">Country:</th>
										  <td>'.$data['CountryName'].'</td>
									  </tr>
									  <tr>
										  <th scope="row">Population:</th>
										  <td>'.$data['Population'].'</td>
									  </tr>	
									  <tr>
										  <th scope="row">Elevation:</th>
										  <td>'.$data['Elevation'].' m</td>
									  </tr>
								  </table>
							  </div>
							  </div>
							  </div>';
					}
					else if(isset($_GET['country'])) {
						$data = getCountryInfo($_GET['country']);
						$fileName = str_replace(' ','',$data['CountryName']);

						echo "<h2>$data[CountryName]</h2>";
						echo '<img src="../img/Flag/'.$fileName.'.jpg" alt="'.$data['CountryName'].'">';
						echo '<div class="row justify-content-center">
						          <div class="col-10">
						              <p class="mt-3" id="countryDesc">';
									      if($data['CountryDescription'] != "")
											  echo $data['CountryDescription'];
										  else
											  echo "Country description not available.";
					    echo          '</p>
								  </div>
						      </div>';
						echo '<div class="row justify-content-center">
						      <div class="col-6">
							  <div class="card mx-auto">
								  <table class="table mb-0"> 
									  <tr class="card-header">
										  <td class="text-white" colspan="3">'.$data['CountryName'].' Details</td>
									  </tr>
									  <tr>
										  <th scope="row">Capital:</th>
										  <td>'.$data['Capital'].'</td>
									  </tr>
									  <tr>
										  <th scope="row">Population:</th>
										  <td>'.$data['Population'].'</td>
									  </tr>	
									  <tr>
										  <th scope="row">Area:</th>
										  <td>'.$data['Area'].' km<sup>2</sup></td>
									  </tr>
									  <tr>
										  <th scope="row">Currency Code:</th>
										  <td>'.$data['CurrencyCode'].'</td>
									  </tr>
								  </table>
							  </div>
							  </div>
							  </div>';
					}
				?>
			</div>
		</div>
	</div>
	
	<script>
		// Initialize and add the map
		function initMap() {
			// The location of Uluru
			var uluru = {lat: <?php $Lat ?>, lng: <?php $Lon ?>};
			// The map, centered at Uluru
			var map = new google.maps.Map(
			  document.getElementById('map'), {zoom: 4, center: uluru});
			// The marker, positioned at Uluru
			var marker = new google.maps.Marker({position: uluru, map: map});
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-H4WR3-88f0pf20bOl_k3rhRCrPC7_tQ&callback=initMap"
        type="text/javascript">
	</script>

<?php require_once("../inc/footer.inc.php"); ?>