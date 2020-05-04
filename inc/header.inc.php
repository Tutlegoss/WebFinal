<?php
	if(!isset($_SESSION)) 
			session_start();
	if(isset($_POST['search'])){
		$fil=$_POST['search'];
		header("Location: search.php?filter=$fil");
	}	
	
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Web Final Art Store</title>
	<meta charset="utf-8">
	<meta name="description" content="Web Final for Kent State - Stark">
	<meta name="keywords" content="meta description, Web, Final, Art, Kent, State, Stark">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/inc/bootstrap-4.4.1-dist/css/bootstrap.min.css">
	<link href="/inc/fontawesome-free-5.12.1-web/css/all.css" rel="stylesheet"/> 
	<script src="/inc/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js"></script>
	<script src="/inc/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/css/site.css">
	<link rel="stylesheet" href="/css/captions.css">
	<link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">  

</head>

<body>
<div class="content">
	<header>
		<nav class="navbar navbar-expand">
		  <div class="navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
			<?php
			if(isset($_SESSION["signedin"])==1){
				if(isset($_SESSION["usertype"])=="Admin"){
				echo '	<li class="nav-item">
				<a class="nav-link" href="/pages/tudupdate.php">Edit Users</a>
			  		</li>';	
				}}
				?>
			  <li class="nav-item">
				<a class="nav-link" href="#">View Favorites List</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#"><?php if(isset($_SESSION["user"])) echo $_SESSION["user"] . "'s"; else echo "My"; ?> Account</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="/pages/signup.php">Register</a>
			  </li>
			  <li class="nav-item">
				<?php if(isset($_SESSION["signedin"])==1){
				  echo '<a class="nav-link" href="/pages/logoff.php">Log off</a>';
			  }else{
				echo '<a class="nav-link" href="/pages/signin.php">Login</a>';
			  }?>
			  </li>
			</ul>
		  </div>
		</nav>
		<?php
		if(isset($_SESSION["signedin"])==1){
		echo '<nav class="navbar navbar-expand" style="margin-bottom: 5px">';
		echo '<div class="navbar-collapse" id="navbarNav">';
		echo '<ul class="navbar-nav ml-auto">';
			echo '<li class ="nav-item">';
			echo '<a class="nav-link" href="#">Welcome '.$_SESSION["user"].' </a>';
			echo'</li>';
			echo'</ul>';
		echo '</div>';
		echo '</nav>';
		}
		?>
		<nav class="navbar navbar-expand-834" style="margin-top: -18px">
			<a class="navbar-brand" href="/"><img src="/img/Travel_Logo.jpg" alt="Art Pallet Logo"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"
					aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle naviation">
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav nav nav-pills mr-auto mt-0">	
					<li class="nav-item">
						<a class="nav-link mr-2" href="/">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link mr-2" href="/pages/AboutUs.php">About Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link mr-2" href="#">Advanced Search</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle nav-item btnArt" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Browse</a>
						<div class="dropdown-menu navDrop" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="/pages/Posts.php">Posts</a>
							<a class="dropdown-item" href="/pages/Images.php">Images</a>
							<a class="dropdown-item" href="/pages/Users.php">Users</a> 
						</div>
					</li> 
				</ul>
				<form action="" class="form-inline ml-auto mr-2" method="post" >
					<label for="search"></label>
					<input class="form-control" name="search" id="search" type="search"  placeholder="Search" aria-label="Search">
					<button class="btn btnArt" type="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>  
		</nav>
		<div class="mx-auto mt-3" id="adH"><a href="https://www.trivago.com/"></a></div>
	</header>
