<?php require_once("../inc/header.inc.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>
			
			<div class="col-12 col-lg-10 mt-3" id="imgFilter">
				<h2 class="text-center"> 
					Travel Images Filter
				</h2>
				<div class="row justify-content-center">
					<form class="form-inline text-center" id="filter" action="javascript:void(0);" method="GET">
					
						<div class="col-4">
							<label for="city">Continent: </label>
							<select class="form-control" id="continent" name="continent">
								<option selected disabled value="">Continent</option>
								<?php foreach ($continentNames as $cn) { ?>
									<option id="G" value="<?php echo $cn['ContinentCode']; ?>"> <?php echo $cn['ContinentName']; ?> </option>
								<?php } ?>
							</select>
						</div>		
						
						<div class="col-4">
							<label for="country">Country: </label>
							<select class="form-control justify-content-center" id="country" name="country">
								<option selected disabled value="">Country</option>
								<?php foreach ($countryNames as $cn) { ?>
									<option value="<?php echo $cn['ISO']; ?>"> <?php echo $cn['CountryName']; ?> </option>
								<?php } ?>
							</select>
						</div>

						<div class="col-4 text-center">
							<input class="btn btnArt filterBtn" id="btn1" type="submit" value="Filter"><br>
							<input type="checkbox" class="" id="cb1" name="No Filter" value="No Filter"><span class="ml-1">No Filter</span>
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		var isChecked = false;
		$('input[type="checkbox"]').click(function() {
			if($(this).prop("checked") == true) {
				$("#btn1").val("No Filter");
				isChecked = true;
			}
			else {
				$("#btn1").val("Filter");
				isChecked = false;
			}
		});
	
		$("#continent").change(function() {
			if($("#continent option:selected").text() != "")
				$("#btn1").removeAttr("disabled");
			
		});
		$("#city").change(function() {
			if($("#city option:selected").text() != "")
				$("#btn1").removeAttr("disabled");
			
		});
		
		$("#btn1").click(function() {
			var country = "";
			var continent = "";
			var URL       = "../inc/ImageFilter.php";
			if(isChecked) {
				country = "ALL";
				continent = "ALL"	
			}
			else {
				country   = $('#country').val();
				continent = $('#continent').val();
			}
			var param     = "country=" + country + "&continent=" + continent;
			$('#empty').remove();
			$('#displayImgs').remove();
			$('#country').val('');
			$('#continent').val('');
			

			if(country == null && continent == null) {
				$('#imgFilter').append('<h3 class="mt-3 text-center" id="empty">' + "Please select a value for Continent and/or Country OR choose No Filter checkbox" + "</h3>");
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
					$('#imgFilter').append('<ul class="mt-5 mb-3 list-inline text-center" id="displayImgs"> </ul>');
					for(var i = 0; i < data.length; ++i) {
						$('#displayImgs').append('<li class="mb-2 list-inline-item px-2">' +
						                         '<a href="single_image.php?id=' + data[i].ImageID + '" class="img-responsive">' +
												 '<img class="imgSize" src="../img/square-medium/' + data[i].Path + '" alt="' + data[i].Title + '">' + 
												 '<h6 class="text-center">' + data[i].Title + '</h6>' +
												 '</a></li>');
					}
					$('#imgFilter').append('</ul>');
					if(data.length == 0)
						$('#imgFilter').append('<h3 class="mt-3 text-center" id="empty">' + "Sorry, no results for selection. Try again." + "</h3>");

				}
			});
		});	
		
		<?php 
			if(isset($_GET['CC'])) {
		?>
				$('#continent>option:eq(<?php echo $_GET['CC']; ?>)').prop('selected',true);
				$("#btn1").trigger("click");
		<?php } ?>
	</script>
<?php require_once("../inc/footer.inc.php"); ?>