<?php require_once($dir . "inc/dbGet.php"); ?>
	<div class="col-12 col-lg-2">
		<div class="row">
			<div class="col-4 col-lg-12 pb-3 sidePanel">
				<div class="card mt-3">
					<div class="card-header text-center">
						Continents
					</div>
					<ul class="list-group list-group-flush ml-1">
						<?php 
							$continentNames = getContinentNames();
							foreach($continentNames as $cn)
								echo "<li class='list-group-item'>
										  <a href=#> $cn </a>
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
					<ul class="list-group list-group-flush ml-1">
						<?php 
							$countryNames = getCountryNames();
							foreach($countryNames as $cn)
								echo "<li class='list-group-item'>
										  <a href=#> $cn </a>
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
					<ul class="list-group list-group-flush ml-1">
						<?php 
							$cityNames = getCityNames();
							foreach($cityNames as $cn)
								echo "<li class='list-group-item'>
										  <a href=#> $cn </a>
									  </li>";
						?>					
					</ul>
				</div>
			</div>
		</div>
	</div>