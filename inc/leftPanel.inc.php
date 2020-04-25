<?php require_once($dir . "inc/dbGet.php"); ?>
	<div class="col-12 col-lg-2" id="left">
		<div class="row">
			<div class="col-4 col-lg-12 pb-3 sidePanel">
				<div class="card mt-3">
					<div class="card-header text-center">
						Continents
					</div>
					<ul class="list-group list-group-flush">
						<?php 
							$continentNames = getContinentNames();
							foreach($continentNames as $cn)
								echo "<li class='list-group-item'>
										  <a href=#> $cn[ContinentName] </a>
									  </li>";
						?>					
					</ul>
				</div>
			</div>
			<div class="col-4 col-lg-12 pb-3 sidePanel">
				<div class="card mt-3">
					<div class="card-header text-center">
						Countries
					</div>
					<ul class="list-group list-group-flush">
						<?php 
							$countryNames = getCountryNames();
							foreach($countryNames as $cn)
								echo "<li class='list-group-item'>
										  <a href='".$dir."pages/Single_CountryCity.php?country=$cn[ISO]'> $cn[CountryName] </a>
									  </li>";
						?>					
					</ul>
				</div>
			</div>
			<div class="col-4 col-lg-12 pb-3 sidePanel">
				<div class="card mt-3">
					<div class="card-header text-center">
						Cities
					</div>
					<ul class="list-group list-group-flush">
						<?php 
							$cityNames = getCityNames();
							foreach($cityNames as $cn)
								echo "<li class='list-group-item'>
										  <a href='".$dir."pages/Single_CountryCity.php?city=$cn[CityCode]'> $cn[AsciiName] </a>
									  </li>";
						?>					
					</ul>
				</div>
			</div>
		</div>
	</div>