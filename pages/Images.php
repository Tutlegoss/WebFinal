<?php require_once("../inc/header.inc.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>
			
			<div class="col-12 col-lg-10 mt-3" id="imgFilter">
				<h2 class="ml-3 text-center"> 
					Travel Images Filter
				</h2>
				<div class="row justify-content-center">
					<form class="form-inline text-center" id="filter" action="javascript:void(0);" method="GET">
						<div class="col-4">
							<label for="country">Country: </label>
							<select class="form-control justify-content-center" id="country" name="country">
								<option selected disabled value="">Country</option>
								<?php foreach ($countryNames as $cn) { ?>
									<option value="<?php echo $cn['ISO']; ?>"> <?php echo $cn['CountryName']; ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4">
							<label for="city">City: </label>
							<select class="form-control" id="city" name="city">
								<option selected disabled value="">City</option>
								<?php foreach ($cityNames as $cn) { ?>
									<option value="<?php echo $cn['CityCode']; ?>"> <?php echo $cn['AsciiName']; ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4 text-center">
							<input class="btn btnArt" id="filterBtn" type="submit" value="Filter">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		$("#filterBtn").click(function() {
			var URL     = "../inc/ImageFilter.php";
			var country = $('#country').val();
			var city    = $('#city').val();
			var param   = "country=" + country + "&city=" + city;
			$('#empty').remove();
			$('#displayImgs').remove();
			$('#country').val('');
			$('#city').val('');
			console.log(param);
			if(country == null && city == null) {
				$('#imgFilter').append('<h3 class="mt-3 text-center" id="empty">' + "Please select a value for Country and/or City" + "</h3>");
				return;
			}
				
			$.ajax({ 
				url:      URL,
				data:     param,
				async:    true,
				type:     "GET",
				dataType: "json",
				
				success: function(data)
				{
					$('#imgFilter').append('<ul class="caption-style-2 mt-5 mb-3" id="displayImgs"> </ul>');
					for(var i = 0; i < data.length; ++i) {
						$('#displayImgs').append('<li class="mb-2 ml-1">' +
						                         '<a href="../img/square-medium/' + data[i].Path + '" class="img-responsive">' +
												 '<img class="imgSize" src="../img/square-medium/' + data[i].Path + '" alt="' + data[i].Title + '">' + 
												 '<h5 class="text-center">' + data[i].Title + '</h5>' +
												 '</a></li>');
					}

				}
			});
		});	
	</script>
<?php require_once("../inc/footer.inc.php"); ?>