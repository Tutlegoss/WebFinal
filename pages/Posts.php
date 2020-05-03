<?php require_once("../inc/header.inc.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>

			<div class="col-12 col-lg-10 mt-3 mb-3" id="post">
				<table class="table">
					<tr class="text-center">
						<th colspan="3"><h1>Full List of Posts</h1></td>
					</tr>
					<?php 
						$newPost = getPostList(); 
						
						foreach($newPost as $p) {
							echo 	'<tr>
										<td class="" style="font-size: 1.5rem;">
											<a href="./Single_Post.php?id=' . $p['PostID'] . '">
												<span>' . $p['Title'] . '</span>
											</a>
										</td>
										<td id="msg">'
											. substr($p['Message'],0,200) . "..." .
										'</td>
										<td class="">'
											. explode(' ',trim($p['PostTime']))[0] .
										'</td>
									 </tr>'; 
						}				
					?> 						
				</table>
			</div>			
		</div>
	</div>

<?php require_once("../inc/footer.inc.php"); ?>