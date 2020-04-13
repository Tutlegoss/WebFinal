<?php
	if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === "/WebFinal/index.php")
		$dir = "./";
	else
		$dir = "../";
?>
</div>
	<footer class="container-fluid rounded-0 text-center">
		<div class="row">
			<div class="col">
				<p class="my-auto">This is obviously the footer</p>
			</div>
		</div>
	</footer>
	
	<!-- Bootstrap popper may not be needed??
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	-->
</body>
</html>
