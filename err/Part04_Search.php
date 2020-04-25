<!DOCTYPE html>

<html lang="en">
<head>
	<title>Assignment 2 PostList</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.min.css">
	<script src="./bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js"></script>
	<script src="./bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./assignment2_CSS.css">
	<link href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" rel="stylesheet"/> 

</head>
<body>

	<nav class="navbar navbar-dark bg-dark navbar-expand-850">
		<a class="navbar-brand text-secondary" href="#">Assign 2</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"
				aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle naviation"       >
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav nav mr-auto mt-2 mt-md-0">
				<li class="nav-item">
					<a class="nav-link ml-2 mr-3 active" href="./index.php">Home<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link mr-3 active" href="./AboutUs.php">About Us</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle nav-item active navbar-active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="./Part01_PostList.php">Post List (Part 1)</a>
						<a class="dropdown-item" href="./Part02_SinglePost.php?id=20">Single Post (Part 2)</a>
						<a class="dropdown-item" href="./Part03_SingleImage.php?id=53">Single Work (Part 3)</a> 
						<a class="dropdown-item" href="./Part04_Search.php">Search (Part 4)</a> 						
					</div>
				</li>  	  
			</ul>
			<form class="form-inline  ml-auto mr-2" action="./Part04_Search.php" method="get">
				<span class="ml-auto mr-3 text-white">Landen Marchand</span>
				<input class="form-control " type="search" name="title" placeholder="Search" aria-label="Search">
				<input class="btn btn-primary my-sm-0 ml-1" type="submit" value="Search Titles">
			</form>
		</div>  
	</nav>
	
	<div class="container">
		<div class="row mt-5 mb-4">
			<div class="col-12">
				<h1>Search Results</h1>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row mb-5">
			<div class="col-12">
				<form method="get" action="javascript:void(0);">
					<div class="searchArea">
						<div class="ml-2 mb-2">
							<div>
								<input class="mt-4" type="radio" id="title" name="searchOp" value="TITLE" 
									<?php 
										if (isset($_GET['title']))
											echo 'checked="checked"'
									?> >
								<label for="Filter by Title">Filter by Title:</label><br>
								<div class="dropDown">	
									<?php 
										if (isset($_GET['title']))
											echo '<input type="text" id="searchText" class="form-control ml-3 mb-2" style="width: 95%" value="'.$_GET['title'].'">';
									?>
								</div>
							</div>
							<div>
								<input type="radio" id="message" name="searchOp" value="MESSAGE">
								<label for="Filter by Message">Filter by Message:</label><br>
								<div class="dropDown"></div>
							</div>
							<div>
								<input type="radio" id="none" name="searchOp" value="No Filter (show all posts)">
								<label for="No Filter (show all posts)">No Filter (show all posts):</label><br>
							</div>
							<button class="btn btn-primary mt-2" id="filter" type="button">Filter</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div id="display">

			</div>
		</div>
	</div>

	<script>
		<?php 
			if (isset($_GET['title'])) {
		?>
				$(document).ready(function(){
					$("#filter").trigger("click");
				});
		<?php 
			}
		?>
		
		var titleORmessage = "TITLE";
		
		$('input:radio[name=searchOp]').change(function() {
			$('input:radio[name=searchOp]').each(function() {
				if (this.id != "none" && $(this).is(':checked')) {
					titleORmessage = this.value;
					$(this).siblings('.dropDown').append('<input type="text" id="searchText" class="form-control ml-3 mb-2" style="width: 95%" placeholder="' + this.value + '">');
				}
				else if (this.id == "none" && $(this).is(':checked'))
					titleORmessage = "";
				else
					$(this).siblings('.dropDown').empty();
			});
		});
		
		/* 
			Hit enter to Filter rather than the button itself:
			https://stackoverflow.com/questions/49029929/keyup-event-is-not-working-after-dynamic-generated-tr-element 
		*/
		$(document).on('keyup', '#searchText', function(e) {
			if(e.keyCode == 13)
			$("#filter").trigger("click");
		});
		
		$("#filter").click(function() {
			$('#display').empty();
			
			var url = "Search.php";
			var val = $('#searchText').val();
			if (document.getElementById('searchText'))
				var param = "search=" + val + "&in=" + titleORmessage;
			else
				var param = "search=&in=";
			
			var searchResults = [];
			$.ajax({ 
				url: "Search.php",
				data: param,
				async: true,
				type: "GET",
				dataType: "json",
				
				success: function(data)
				{
					for(var i = 0; i < data.length; ++i) {
						$('#display').append('<div class="col-12 mb-5">' + 
						                     '<h3><a href="./Part02_SinglePost.php?id=' + data[i].PostID + '">' + data[i].Title + '</a></h3>' + 
						                     '<p>' + data[i].Message + '</p></div>');
					}

					/*
						Highlight text that is case-insensitive
						https://stackoverflow.com/questions/3294576/javascript-highlight-substring-keeping-original-case-but-searching-in-case-inse
					*/
					if (titleORmessage === "MESSAGE" && val !== "") {
						var replacement = '<span class="bg-warning">' + val + '</span>';
						$('#display p').each(function() {
							reg = new RegExp(val, 'gi');
							var txt = $(this).text().replace(reg, function(str) {
																      return '<span class="bg-warning">' + str + '</span>'
																  });
							$(this).html(txt);
						});
					}
				}
			});
		});		

	</script>
 


</body>
</html>