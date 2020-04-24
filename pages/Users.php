<?php require_once("../inc/header.inc.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>

			<div class="col-12 col-lg-10 mt-3" id="post">
				<h1 class="ml-3 text-center"> 
					Full List of Users
				</h1>
				
				<?php
					$users = getUserList(); 
					foreach($users as $u) {
						echo '<div class="row justify-content-center">
								  <h2>
									  <a href="single_user.php?id=' . $u['UID'] . '">
										  <span>' . $u['FirstName'] . " " . $u['LastName'] . '</span>
									  </a>
								  </h2>
							  </div>';
					}
				?>
			</div>
		</div>
	</div>

<?php require_once("../inc/footer.inc.php"); ?>