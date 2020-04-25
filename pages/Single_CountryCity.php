<?php require_once("../inc/header.inc.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>

			<div class="col-12 col-lg-10 mt-3 mb-3" id="countryCity">
				<?php 
					if(isset($_GET['city'])) {
						$data = getCityInfo($_GET['city']);
						$fileName = explode(' ',$data['AsciiName'])[0];
						echo "<h2>$data[AsciiName]</h2>";
						echo '<img class="" src="../img/Maps/'.$fileName.'.PNG" alt="'.$data['AsciiName'].'">';
						echo '<div class="row justify-content-center">
						      <div class="col-6">
							  <div class="card mt-3 mx-auto">
								  <table class="table mb-0">
									  <tbody>
										  <tr class="card-header">
											  <td class="post" colspan="3">'.$data['AsciiName'].' Details</td>
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
											  <td>'.$data['Elevation'].'m</td>
										  </tr>
									  </tbody>
								  </table>
							  </div>
							  </div>
							  </div>';
					}
				?>
			</div>
		</div>
	</div>
	
<?php require_once("../inc/footer.inc.php"); ?>