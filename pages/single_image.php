


<?php
ob_start();
require_once("../inc/header.inc.php");

?>


<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>


<style>
h1{
	padding:25px;
}
a{
	padding:25px;	
}
#image{
	width:200px;
	margin:20px;
}

</style>

<main class="container-fluid">
	<div class="row">
	<?php include("../inc/leftPanel.inc.php");?>
<div class="col-xl-8 modal-photos">
<?php
require_once('../inc/dbconnect.php');
if(isset($_POST['search'])){
		$fil=$_POST['search'];
		header("Location: search.php?filter=$fil"); 
	}
$_ID="";
if(isset($_GET['id'])){
	$_ID=$_GET['id'];
}
if($_ID==""){header("location: error.php");}

$sql="Select * from travelimagedetails where ImageID=$_ID";

$results=mysqli_query($conn,$sql);
if(!$results){
	printf("Error: %s\n", mysqli_error($conn));
	exit();
}
$row=mysqli_fetch_array($results);

echo "<h1>". $row['Title']."</h1><br>";


$sql2="Select * from travelimage where ImageID=$_ID";
	$r_image=mysqli_query($conn,$sql2);
	if(!$r_image){
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
$img=mysqli_fetch_array($r_image);
$uid=$img['UID'];
$sql9="Select * from traveluserdetails where UID=$uid";
	$r_u=mysqli_query($conn,$sql9);
	if(!$r_u){
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
$reu=mysqli_fetch_array($r_u);

echo '<aside class="container right-align">
	<div class="col-lg-6" style="float:right">
	&nbsp&nbsp&nbsp&nbsp<button class="panel-heading">&hearts; Add to Favorites List</button></div>
	<br><br><br><br>
	<div class="col-lg-6" style="float:right">
	<div class="panel panel-info">
	<div class="panel-heading" style="right-align">&nbsp&nbsp&nbsp&nbspRating </div>';

	
	$sql4="Select * from travelimagerating where ImageID=$_ID";
	$rate=mysqli_query($conn,$sql4);
	if(!$rate){
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	$rating=mysqli_fetch_array($rate);

	echo "<p style='color:red; text-align:left;'>&nbsp&nbsp&nbsp&nbsp".number_format($rating['Rating'],1)."</p><br></div>";
	
	echo "<div class='col-lg-6'>
	<div class='panel panel-info'>
	<div style='background-color:white;' class='panel-heading'>Image Details</div>";
	echo "<p>Country:";
	$cci="sl-Latn-";
	$cci.=$row['CountryCodeISO'];
	$cci.="-nedis";
	echo Locale::getDisplayRegion($cci, 'en');
	echo "</p>";
	$second="";
	$latLong=$row['Latitude'].','.$row['Longitude'];
	//echo "<p>City: ".$second."</p>";
	echo "<p>Latitude: ";
	echo $row['Latitude'];
	echo "</p><p>Longitude:   ";
	echo $row['Longitude'];
	echo "</p>";
	echo '</div></div></div></aside>';

echo "<h5>&nbsp&nbsp&nbsp&nbsp By ".$reu['FirstName']."  ".$reu['LastName']."</h5><br>";
echo '<a href="#" style="background-color:white; border-color:white"  class="btn btn-primary" data-toggle="modal" data-target=".popup"><img src="../img/small/'. $img['Path'].'" alt="" class="img-reponsive"/></a>';
	
echo "<p>".$row['Description']."</p>"; 












?>

<div class="row">
	<div class="col-12" id="reviews">
		<h2>Reviews</h2>
		<?php 
			$reviews = getReviews($_GET['id']); 
			
			foreach($reviews as $r)
			{
				echo '<div class="row mt-5">
					      <div class"col-12">'; 
						      echo "<h6 class='ml-2 mr-2 ' id='nameReview'>$r[FirstName] $r[LastName]</h6>";
							  echo '<p class="ml-2 mr-2">';
							  $planes = $r['Rating'];
							  $rem = 5 - $planes;
							  while($planes-- > 0) {
							      echo '<i class="fas fa-plane yellow ml-1"></i>';
						      }
							  while($rem-- > 0) {
								  echo '<i class="fas fa-plane black ml-1"></i>';
							  }
							  echo '</p>';
							
							  echo "<p class='ml-2 mr-4' id='review'>$r[Review]</p>";
							  echo "<p class='ml-2 mr-2' id='time'>$r[ReviewTime]";
                              if(isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "Admin") {							  
							      echo "<button class='btn btnArt ml-3' id='deleteReview' type='button'>Delete</button>";
							  }
							  echo "</p>";
				echo     '</div>
				      </div>';
				
			}
		?>
	</div>
</div>
</div>

<div class="modal fade popup"  role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:500px height:500px">
    <div class="modal-content">
      <?php echo '<p>
	'.$row['Title'].' By '.$reu["FirstName"].' '.$reu["LastName"].'</p>';?>
      <?php
	echo '<img width="300px" height="200px" id="image" src="../img/medium/'. $img['Path'].'" alt="" class="img-reponsive"/>';?>
    </div>
  </div>
</div>
</main>
<?php require_once("../inc/footer.inc.php");?>
