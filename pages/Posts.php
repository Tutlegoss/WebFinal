<?php require_once("../inc/header.inc.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>

			<div class="col-12 col-lg-10 mt-3 mb-3" id="post">
				<h1 class="text-center mb-3"> 
					Full List of Posts
				</h1>
				
				<?php
					$posts = getPostList(); 
					foreach($posts as $p) {
						echo '<div class="row justify-content-center">
								  <h2>
									  <a href="single_post.php?id=' . $p['PostID'] . '">
										  <span>' . $p['Title'] . '</span>
									  </a>
								  </h2>
							  </div>';
					}
				?>
				</div>
			</div>			
		</div>
	</div>

<?php require_once("../inc/footer.inc.php"); ?>