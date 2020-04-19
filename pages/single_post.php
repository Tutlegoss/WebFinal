<?php
ob_start();
require_once("../inc/header.inc.php");
include("../inc/leftPanel.inc.php");

function makeLink($link, $image) {
   $newlink = '<a href="' . $link . '">';
   $newlink .= $image;
   $newlink .= '</a>';
   return $newlink;
}


?><style>
h1{
	padding:25px;
}

a{
	padding:25px;
	
}
</style>


<main class="content">
	<div class="row">
<div class="col-lg-6 >
<?php
require_once('../inc/dbconnect.php');
$_ID="";
if(isset($_POST['search'])){
		$fil=$_POST['search'];
		header("Location: Part04_Search.php?filter=$fil"); 
	}
if(isset($_GET['id'])){
	$_ID=$_GET['id'];
}
if($_ID==""){header("location: error.php");}
$sql="Select * from travelpost where PostID=$_ID";
 
$results=mysqli_query($conn,$sql);
if(!$results){
	printf("Error: %s\n", mysqli_error($conn));
	exit();
}

$row=mysqli_fetch_array($results);
echo "<h1>". $row['Title']."</h1><br>";
echo "<p>".$row['Message']."</p>"; 
?>
</div>
<br><br><br><br><br><br><br>
<aside class="container right-align">
	<div class="col-lg-6">
	<div class="panel panel-info">
	<div class="panel-heading">&hearts; Add to Favorites List</div></div>
	
	<div class="panel panel-info">
	<div class="panel-heading">Post Details</div>
	<p>Date: <?php 
		$date=date("M-d-Y",strtotime($row['PostTime']));
	echo $date."</p>";
	
	$sql1="Select * from traveluserdetails where UID=$_ID"; 
	$r_name=mysqli_query($conn,$sql1);
	if(!$r_name){
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	$rn=mysqli_fetch_array($r_name);
	echo "Posted by:&nbsp&nbsp&nbsp".$rn['FirstName']."&nbsp".$rn['LastName'];




?></div></div></div>
	
</aside>
</div></div>
<aside class="container">
	<div  class="col-xl-8">
	
	<h2>Travel images for this post</h2>
	<?php
	$sql2="Select ti.Path, ti.ImageID from travelimage as ti, travelpostimages as tpi where tpi.PostID=$_ID and tpi.ImageID=ti.ImageID";
	$r_image=mysqli_query($conn,$sql2);
	if(!$r_image){
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	echo "<table style='border-collapse: collapse; '>";
	while($img=mysqli_fetch_array($r_image)){
	$IID=$img['ImageID'];
	$_Link="single_image.php?id=$IID";
	echo "<td>";
	$image='<img src="../img/square-medium/'. $img['Path'].'" alt="" class="img-reponsive"/>';
	echo makeLink($_Link, $image);
	echo "<br>";
	
	$sql3="Select Title from travelimagedetails where ImageID=$IID";
	$r_title=mysqli_query($conn,$sql3);
	if(!$r_title){
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	$r_t=mysqli_fetch_array($r_title);
	echo $r_t['Title']; 
	echo "<br><button style='background-color:#509FFA; color:white;' type='button'>&#9432View</button>";
	echo "<button style='background-color:green; color:white;' type='button'>&hearts; Favorite</button>";	
	echo "</td>";
        
}
require_once("../inc/footer.inc.php");
?>
</main>
	
