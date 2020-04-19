


<?php
ob_start();
//require_once("../inc/header.inc.php");
//include("../inc/leftPanel.inc.php");
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

<main class="container">
	<div class="row">
<div class="col-lg-6 modal-photos">
<?php
require_once('../inc/dbconnect.php');
if(isset($_POST['search'])){
		$fil=$_POST['search'];
		header("Location: Search.php?filter=$fil"); 
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
echo "<h5>&nbsp&nbsp&nbsp&nbsp By ".$reu['FirstName']."  ".$reu['LastName']."</h5><br>";
echo '<a href="#" style="background-color:white; border-color:white"  class="btn btn-primary" data-toggle="modal" data-target=".popup"><img src="../img/small/'. $img['Path'].'" alt="" class="img-reponsive"/></a>';
	
echo "<p>".$row['Description']."</p>"; 
?>

</div>

<div class="modal fade popup"  role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:500px height:500px">
    <div class="modal-content">
      <?php echo '<p>
	'.$row['Title'].' By '.$reu["FirstName"].' '.$reu["LastName"].'</p>';?>
      <?php 
	<img width="300px" height="200px" id="image" src="../img/medium/'. $img['Path'].'" alt="" class="img-reponsive"/>';?>
    </div>
  </div>
</div>












<aside class="container right-align">
<br><br><br>
	<div class="col-lg-6">
	<button class="panel-heading">&hearts; Add to Favorites List</button></div>
	<br><br><br><br>
	<div class="col-lg-6">
	<div class="panel panel-info">
	<div class="panel-heading">Rating</div>
	<?php

	
	$sql4="Select * from travelimagerating where ImageID=$_ID";
	$rate=mysqli_query($conn,$sql4);
	if(!$rate){
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	$rating=mysqli_fetch_array($rate);
	//the number of votes in not listed in the tables
	echo "<br><p style='color:red;'>.number_format($rating['Rating'],1)."</p><br></div>";
	
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
	


	echo "<p>City: ".$second."</p>";
	echo "<p>Latitude: ";
	echo $row['Latitude'];
	echo "</p><p>Longitude   ";
	echo $row['Longitude'];
	echo "</p>";

//require_once("../inc/footer.inc.php"); 
?>
</div></div></div>
</aside>
</main>



























