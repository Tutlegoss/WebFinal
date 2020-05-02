<?php require_once("../inc/header.inc.php"); 
if(isset($_POST['search'])){
	$fil=$_POST['search'];
	header("Location: search.php?filter=$fil"); 
}

?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>
			
			<div class="col-12 col-lg-10 mt-3 mb-3">
				<h3 class="mt-3 ml-3 text-center"> 
					Hypothetical Website for CS 44106 - WP2 at Kent State University taught by Dr A. Guercio
				</h3>
				<table class="table table-striped mt-3" id="about-us">
					<thead>
						<tr>
							<th scope="col">Name</th>
							<th scope="col">Contribution</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Landen Marchand</td>
							<td>
								<ul>
									<li>Bootstrap Theme and Site Design</li>
									<li>Home Page</li>
									<li>Navigation</li>
									<li>About Us</li>
									<li>Browse Travel Images</li>
									<li>Browse Posts / Users</li>
									<li>Display Single Country/City</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>Brandon Jacobs</td>
							<td>
								<ul>
									<li>Display Single Post</li>
									<li>Display Single Travel Image</li>
									<li>Display Simple Search</li>
									<li>Display Search Results </li>
									<li>Registration page</li>
									<li>Sign in page</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>Michael Partridge</td>
							<td>
								<ul>
									<li>Add To Favorites</li>
									<li>View Favorites</li>
									<li>Advanced Search</li>
									<li>Display Single User</li>
								</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php require_once("../inc/footer.inc.php"); ?>