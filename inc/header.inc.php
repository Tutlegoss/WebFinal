<?php
	if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === "/")
		$dir = "./";
	else
		$dir = "../";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Start php session so session variables are available -->
	<?php 
		if(!isset($_SESSION)) 
			session_start(); 
		ob_start();
	?>
	<title>Web Final Art Store</title>
	<meta charset="utf-8">
	<meta name="description" content="Web Final for Kent State - Stark">
	<meta name="keywords" content="meta description, Web, Final, Art, Kent, State, Stark">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?php echo $dir; ?>inc/bootstrap-4.4.1-dist/css/bootstrap.min.css">
	<link href="<?php echo $dir; ?>inc/fontawesome-free-5.12.1-web/css/all.css" rel="stylesheet"/> 
	<script src="<?php echo $dir; ?>inc/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js"></script>
	<script src="<?php echo $dir; ?>inc/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo $dir; ?>css/site.css">
	<link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet"> 

</head>

<body>
<div class="content">
	<header>
		<nav class="navbar navbar-expand">
		  <div class="navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item">
				<a class="nav-link" href="#">View Favorites List</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">My Account</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Register</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Login</a>
			  </li>
			</ul>
		  </div>
		</nav>
		<nav class="navbar navbar-expand-834" style="margin-top: -18px">
			<a class="navbar-brand" href="localhost/C-S/index.php"><img src="<?php echo $dir; ?>img/artLogo.png" alt="Art Pallet Logo"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"
					aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle naviation">
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav nav nav-pills mr-auto mt-0">	
					<li class="nav-item">
						<a class="nav-link mr-2" href="#">Home</a>
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
							<a class="dropdown-item" href="#">Posts</a>
							<a class="dropdown-item" href="#">Images</a>
							<a class="dropdown-item" href="#">Users</a> 
						</div>
					</li> 
				</ul>
				<form action="" class="form-inline  ml-auto mr-2" method="GET" >
					<label for="search"></label>
					<input class="form-control" name="search" id="search" type="search"  placeholder="Search" aria-label="Search">
					<button class="btn btn-primary my-sm-0 btnKent" type="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>  
		</nav>
	</header>