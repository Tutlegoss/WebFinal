<?php require_once("./inc/header.inc.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<?php include("./inc/leftPanel.inc.php"); ?>
			
			<div class="col-12 col-lg-10 no-padding mt-3">
				<div id="carouselSwitch" class="carousel slide carousel-fade" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="./img/art.jpg" class="d-block w-100 carousel-height" alt="...">
							<div class="carousel-caption d-none d-md-block">
								<h5 class="captionBkgnd">First slide label</h5>
								<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
							</div>
						</div>
						<div class="carousel-item">
							<img src="./img/Australia.jpg" class="d-block w-100 carousel-height" alt="...">
						</div>
						<div class="carousel-item">
							<img src="./img/art.jpg" class="d-block w-100 carousel-height" alt="...">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselSwitch" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					</a>
					<a class="carousel-control-next" href="#carouselSwitch" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
					</a>
				</div>
			</div>
		</div>
	</div>

<?php require_once("./inc/footer.inc.php"); ?>