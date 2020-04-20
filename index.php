<?php require_once("./inc/header.inc.php"); 
if(isset($_POST['search'])){
	$fil=$_POST['search'];
	header("Location: ./pages/search.php?filter=$fil"); 
}?>
	<div class="container-fluid">
		<div class="row">
			<?php include("./inc/leftPanel.inc.php"); ?>
			
			<div class="col-12 col-lg-10 mt-3">
				<div id="carouselSwitch" class="carousel slide carousel-fade" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="./img/art.jpg" class="d-block w-100 carousel-height" alt="...">
							<div class="carousel-caption d-none d-md-block">
								<h5 class="captionBkgnd">First slide label</h5>
								<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
							</div>
						</div>
						<div class="carousel-item">
							<img src="./img/Australia.jpg" class="d-block w-100 carousel-height" alt="...">
						</div>
						<div class="carousel-item">
							<img src="./img/art.jpg" class="d-block w-100 carousel-height" alt="...">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselSwitch" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					</a>
					<a class="carousel-control-next" href="#carouselSwitch" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
					</a>
				</div>
				<div class="row mt-3 mb-3">
					<div class="col-6 mt-3">		
						<table class="table mb-0" id="indexRating">
							<tr class="text-center">
								<th colspan="2">Top 10 Images</td>
							</tr>

							<?php 
								$topImages = getTopRated(); 
								
								for($i = 0, $j = 1; $i < 10; $i += 2, $j += 2) { 
									$imageNameLeft  = getImageName($topImages[$i]['ImageID']);
									$imageNameRight = getImageName($topImages[$j]['ImageID']);
									echo 	"<tr>
												<td class='text-center'>
													$imageNameLeft[Title]
													<img src='./img/square-medium/$imageNameLeft[Path]' class='d-block m-auto'>
													Rating: " . round($topImages[$i]['AVG(Rating)'],1) .
											"	</td>
												<td class='text-center'>
													$imageNameRight[Title]
													<img src='./img/square-medium/$imageNameRight[Path]' class='d-block m-auto'>
													Rating: " . round($topImages[$j]['AVG(Rating)'],1) .
											"	</td>
											 </tr>"; 
								}				
							?> 					
						</table>	
					</div>
					<div class="col-6 mt-3">		
						<table class="table mb-0" id="newAdditions">
							<tr class="text-center">
								<th colspan="2">New Additions</td>
							</tr>
							<?php 
								$newImages = getNewAdditions(); 
								
								for($i = 0, $j = 1; $i < 10; $i += 2, $j += 2) { 
									$imageNameLeft  = getImageName($newImages[$i]['ImageID']);
									$imageNameRight = getImageName($newImages[$j]['ImageID']);
									echo 	"<tr>
												<td class='text-center'>
													$imageNameLeft[Title]
													<img src='./img/square-medium/$imageNameLeft[Path]' class='d-block m-auto'>
													<span style='color: #E8DDCB'>_</span>
												</td>
												<td class='text-center'>
													$imageNameRight[Title]
													<img src='./img/square-medium/$imageNameRight[Path]' class='d-block m-auto'>
													<span style='color: #E8DDCB'>_</span>
												</td>
											 </tr>"; 
								}				
							?> 					
						</table>	
					</div>
				</div>
			</div>
		</div>
	</div>

<?php require_once("./inc/footer.inc.php"); ?>
