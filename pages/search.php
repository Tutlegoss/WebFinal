<?php
ob_start();
require_once("../inc/header.inc.php");
$order='';
function Highlight($text_highlight,$text_match){
	
	$str=explode(" ",$text_highlight);
	foreach($str as $value){
	if(($value==$text_match)||stripos($value,$text_match)!==false){
	echo '<span style="background-color:yellow">'.$value.'</span>';
	echo " ";
	}else{
	echo $value;
	echo " ";
	}
	}
}

function assignment(){
	
	echo "was clicked";
	
}

?>


<script type='text/javascript'>
	function checkThist(x){ 
		if(x==0){
		document.getElementById("titletxt").style.display='block';
		document.getElementById("messtxt").style.display='none';
		}else
		document.getElementById("titletxt").style.display='none';
		return;
	}
	function checkThism(x){ 
		if(x==0){
		document.getElementById("messtxt").style.display='block';
		document.getElementById("titletxt").style.display='none';
		}else
		document.getElementById("messtxt").style.display='none';
		return;
	}
	function checkThise(){ 
		
		document.getElementById("messtxt").style.display='none';
		document.getElementById("titletxt").style.display='none';
		
		return;
	}

	
		</script>




<main class="container-fluid">
	<div class="row">
<?php include("../inc/leftPanel.inc.php");?>
<div class="col-xl-8">
<h1>Search Results</h1>	
<section id="radio-custom">
	<form action="" method="get">
	<input type="radio" onclick="checkThist(0)" id="title" name="title" value="" />Filter by title<br>
	<div id="titletxt" style="display:none">
		<input name="filtert" type="text" id="filtert"><br>
	</div>
	<input type="radio" onclick="checkThism(0)" id="message" name="message" value="" />Filter by message<br>
	<div id="messtxt" style="display:none">
		<input name="filterm" type="text" id="filterm"><br>
	</div>
	<input type="radio" name="empty" onclick="checkThise()" id="message" name="message" />Show all posts<br>
	
	<input  type="submit" value="Filter">
	</form>
	<form action="" method="post">
		<input type="hidden" value="Asc" name="Asc">
		<input type="submit" value="Ascending" name="Asc" id="Asc">
	</form>
	<form action="" method="post">
		<input type="hidden"  value="Des" name="Des">
		<input type="submit"  value="Descending" name="Des" id="Des">
	</form>
</section>
<?php

require_once('../inc/dbconnect.php');

if(isset($_POST['Asc'])){
	$order="A";
}else{
	if(isset($_POST['Des'])){
		$order="D";
	}
}
echo "order is ".$order." done";
$sql="";

if(isset($_POST['search'])){
		$fil=$_POST['search'];
		header("Location: search.php?filter=$fil"); 
	}
if(isset($_POST['filtert'])!=""){
	$fil=$_POST['filtert'];
	header("Location: search.php?filtert=$fil"); 
}
if(isset($_POST['filterm'])!=""){
	$fil=$_POST['filterm'];
	header("Location: search.php?filterm=$fil"); 
}

$bool=0;
if(isset($_GET['filter'])){
	if($_GET['filter']!=""){
	$bool=1;
	$Gfil=$_GET['filter'];
	if($order=="A"){
		$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID Where travelpost.Title Like '%$Gfil%' or Message Like '%$Gfil%' order by travelpost.Title ASC";
	}else{if($order=="D"){
		$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID Where travelpost.Title Like '%$Gfil%' or Message Like '%$Gfil%' order by travelpost.Title DESC";
	}else{
		$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID Where travelpost.Title Like '%$Gfil%' or Message Like '%$Gfil%'";
	}}
	$results=mysqli_query($conn,$sql);
		if(!$results){
			printf("Error1:%s\n", mysqli_error($conn));
			exit();
		}
		$check="";
		while($row=mysqli_fetch_array($results)){
			if($check!=$row['Title']){
			$id=$row['PostID'];
			echo "<h3 style='color:blue'><a href='Single_Post.php?id=$id'>".$row['Title']."</a></h3><br>";
			echo '<img src="../img/thumb/'. $row['Path'].'" alt="" class="img-reponsive"/><br>';
			echo "<p>".Highlight($row['Message'],$Gfil)."</p><br>";
			}
			$check=$row['Title'];
		}
	}
}

	if(isset($_GET['filtert'])){
	
	$filtt=$_GET['filtert'];
	if($_GET['filtert']!=""){
	
	$bool=1;
	if($order=="A"){
		$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID Where travelpost.Title Like '%$filtt%' order by travelpost.Title ASC";
	}else{if($order=="D"){
		$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID Where travelpost.Title Like '%$filtt%' order by travelpost.Title DESC";
	}else{
		$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID Where travelpost.Title Like '%$filtt%'";
	}}
	
	$results=mysqli_query($conn,$sql);
		if(mysqli_num_rows($results)>0){
		if(!$results){
			printf("Error1:%s\n", mysqli_error($conn));
			exit();
		}
		$check="";
		while($row=mysqli_fetch_array($results)){
			if($check!=$row['Title']){
			$id=$row['PostID'];
			echo "<h3 style='color:blue'><a href='Single_Post.php?id=$id'>".$row['Title']."</a></h3><br>";
			echo '<img src="../img/thumb/'. $row['Path'].'" alt="" class="img-reponsive"/><br>';
			echo "<p>".$row['Message']."</p><br>";
		}
		$check=$row['Title'];
		}
	}
	}}
	if(isset($_GET['filterm'])){
		$filtm=$_GET['filterm'];
		if($_GET['filterm']!=""){
		$bool=1;
		if($order=="A"){
			$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID Where travelpost.Message Like '%$filtm%' order by travelpost.Title ASC";
		}else{if($order=="D"){
			$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID Where travelpost.Message Like '%$filtm%' order by travelpost.Title DESC";
		}else{
			$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID Where travelpost.Message Like '%$filtm%'";
		}}
		
		$results=mysqli_query($conn,$sql);
		if(!$results){
			printf("Error2:%s\n", mysqli_error($conn));
			exit();
		}
		$check="";
		while($row=mysqli_fetch_array($results)){
		
			if($check!=$row['Title']){
			$id=$row['PostID'];
			echo "<h3 style='color:blue'><a href='Single_Post.php?id=$id'>".$row['Title']."</a></h3><br>";
			echo '<img src="../img/thumb/'. $row['Path'].'" alt="" class="img-reponsive"/><br>';
			echo "<p>".Highlight($row['Message'],$filtm)."</p><br>";	
			}
			$check=$row['Title'];
	}
	}
	}
if($bool==0){
	if($order=="A"){
		$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID order by Title ASC";
	}else{if($order=="D"){
		$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID order by Title DESC";
	}else{
		$sql="Select * from travelpost inner join travelimage on travelpost.UID=travelimage.UID";
	}}
$results=mysqli_query($conn,$sql);
if(!$results){
	printf("Error4:%s\n", mysqli_error($conn));
	exit();
}
$check="";
while($row=mysqli_fetch_array($results)){
	if($check!=$row['Title']){
	$id=$row['PostID'];
	$check=$row['Title'];
	echo "<h3 style='color:blue'><a href='Single_Post.php?id=$id'>".$row['Title']."</a></h3><br>";
	echo '<img src="../img/thumb/'. $row['Path'].'" alt="" class="img-reponsive"/><br>';
	echo "<p>".$row['Message']."</p><br>";
	}
	$check=$row['Title'];
}
}


?>
</div></div></main>
<?php require_once("../inc/footer.inc.php");?>
