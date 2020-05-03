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
							<a href="./pages/Images.php">
								<!-- https://earthchallenge2020.earthday.org/ -->
								<img src="./img/Earth.jpg" class="d-block w-100 carousel-height" alt="Explore">
								<div class="carousel-caption d-none d-sm-block">
									<h2>Explore the World</h2>
									<h3>Discover exotic places anywhere, anytime.</h3>
								</div>
							</a>
						</div>
						<div class="carousel-item">
							<a href="./pages/search.php?filter=''">
								<!-- https://www.smartertravel.com/least-visited-european-countries/ -->
								<img src="./img/BH.jpg" href="./pages/search.php?filter=''" class="d-block w-100 carousel-height" alt="Post">
								<div class="carousel-caption d-none d-sm-block captionBkgnd">
									<h2>Read Articles</h2>
									<h3>Read up on places before you visit.</h3>
								</div>
							</a>
						</div>
						<div class="carousel-item">
							<a href="./pages/single_image.php?id=3">
								<img src="./img/large/6592317633.jpg" href="./pages/single_image.php?id=3" class="d-block w-100 carousel-height" alt="...">
								<div class="carousel-caption d-none d-sm-block captionBkgnd">
									<h2>Rate and Review</h2>
									<h3>Tell the Internet about your experiences.</h3>
									<h6>Featured: Grace Presbyterian Church</h6>
								</div>
							</a>
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
					<div class="col-12 col-md-6 mt-3">		
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
												    <a href='./pages/single_image.php?id=".$topImages[$i]['ImageID']."'>
													    $imageNameLeft[Title]
													    <img src='./img/square-medium/$imageNameLeft[Path]' class='d-block m-auto'>
													</a>
													Rating: " . round($topImages[$i]['AVG(Rating)'],1) .
											"	</td>
												<td class='text-center'>
													<a href='./pages/single_image.php?id=".$topImages[$j]['ImageID']."'>
													    $imageNameRight[Title]
													    <img src='./img/square-medium/$imageNameRight[Path]' class='d-block m-auto'>
													</a>
													Rating: " . round($topImages[$j]['AVG(Rating)'],1) .
											"	</td>
											 </tr>"; 
								}				
							?> 			 					
						</table>	
					</div>
					<div class="col-12 col-md-6 mt-3">		
						<table class="table mb-0" id="newAdditions">
							<tr class="text-center">
								<th colspan="2">New Additions</td>
							</tr>
							<?php 
								$newPost = getNewAdditions(); 
								
								foreach($newPost as $p) {
									echo 	'<tr>
												<td class="text-center">
													<a href="./pages/single_post.php?id=' . $p['PostID'] . '">
														<span>' . $p['Title'] . '</span>
													</a>
												</td>
												<td class="">'
													. explode(' ',trim($p['PostTime']))[0] .
												'</td>
											 </tr>'; 
								}				
							?> 						
						</table>
						<table class="table mt-3 mb-0" id="newAdditions">
							<tr class="text-center">
								<th colspan="2">Two Most Recent Posts</td>
							</tr>
							<?php 
								$twoRecent = getTwoRatings(); 

								foreach($twoRecent as $p) {
									echo 	'<tr>
												<td class="text-center">
													<a href="./pages/single_image.php?id=' . $p['ImageID'] . '">
														<span>' . substr($p['Review'],0,100) . "..." . '</span>
													</a>
												</td>
												<td class="">'
													. explode(' ',trim($p['ReviewTime']))[0] .
												'</td>
											 </tr>'; 
								}				
							?> 						
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php require_once("./inc/footer.inc.php"); ?>