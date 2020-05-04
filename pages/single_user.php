<?php require_once("../inc/header.inc.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>

			<div class="col-12 col-lg-10 mt-3 mb-3">
				<?php 
					if(isset($_GET['id'])) {
						$data = getUserInfo($_GET['id']);

						echo "<h2 class='text-center'>$data[FirstName] $data[LastName]</h2>";
	
						echo '<div class="row justify-content-center" id="singleUser">
							  <div class="col-6">
							  <div class="card mx-auto">
								  <table class="table mb-0"> 
									  <tr>
										  <th scope="row">Address:</th>
										  <td>';
										  if($data['Privacy'] == 2)
											  echo "Hidden";
										  else
											  echo $data['Address'];
										  echo'</td>
									  </tr>
									  <tr>
										  <th scope="row">City:</th>
										  <td>'.$data['City'].'</td>
									  </tr>
									  <tr>
										  <th scope="row">Region:</th>
										  <td>'.$data['Region'].'</td>
									  </tr>
									  <tr>
										  <th scope="row">Country:</th>
										  <td>'.$data['Country'].'</td>
									  </tr>
									  <tr>
										  <th scope="row">Postal:</th>
										  <td>';
										  if($data['Privacy'] == 2)
											  echo "Hidden";
										  else
											  echo $data['Postal'];
										  echo'</td>
									  </tr>
									  <tr>
										  <th scope="row">Phone:</th>
										  <td>';
										  if($data['Privacy'] == 2)
											  echo "Hidden";
										  else
											  echo $data['Phone'];
										  echo'</td>
									  </tr>
									  <tr>
										  <th scope="row">Email:</th>
										  <td>'.$data['Email'].'</td>
									  </tr>
								  </table>
							  </div>
							  </div>
							  </div>';
					}
				?>
				<div class="row">
					<div class="col-12 mb-3">
						<div class="container-fluid">
						    <h2 class="text-center mt-5">Photo Contribution</h2>
							<div class="d-flex justify-content-center">
						<?php
							$photos = getUserPhotos($_GET['id']);
							
							echo '<ul class="mt-5 mb-3 list-inline text-center" id="displayImgs">';
							foreach($photos as $p) {
							    echo "<li class='mb-2 list-inline-item px-2'>
						                <a href='/pages/single_image.php?id=$p[ImageID]'' class='img-responsive'>
										<img class='imgSize' src='/img/square-medium/$p[Path]' alt='$p[Title]'> 
										<h5 class='text-center'>$p[Title]</h5>
										</a></li>";
							}
							echo '</ul>';
						?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mb-3">
						<div class="container-fluid">
						    <h2 class="text-center mt-5">Post Contribution</h2>
    						<?php
    							$posts = getUserPosts($_GET['id']);
    							
    							foreach($posts as $p) {
    								echo "<a href='/pages/Single_Post.php?id=$p[PostID]'><h3>$p[Title]</h3></a>
    									  <p class='mt-2'>".substr($p['Message'],0,450) . "..." . "</p>";
    							}
    						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php require_once("../inc/footer.inc.php"); ?>