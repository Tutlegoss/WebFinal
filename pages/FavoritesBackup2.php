<?php
session_start();
include_once('dbConnect.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
if(isset($_GET['PostsToBeDeleted']) && !empty($_GET['PostsToBeDeleted'])) {
	//There are items to be deleted, so delete them
	foreach($_GET['PostsToBeDeleted'] as $y) {
		//search the $_SESSION['favposts'] for $y
		$key = array_search($y, $_SESSION['favposts']);
		unset($_SESSION['favposts'][$key]);
	}
}
if(isset($_GET['ImagesToBeDeleted']) && !empty($_GET['ImagesToBeDeleted'])) {
	//There are items to be deleted, so delete them
	foreach($_GET['ImagesToBeDeleted'] as $y) {
		//search the $_SESSION['favimages'] for $y
		$key = array_search($y, $_SESSION['favimages']);
		unset($_SESSION['favimages'][$key]);
	}
}
?>

<form method="GET" action="">
	<input type="text" name="DisplayOrder" value="1" style="display: none;">
	<input id="AscendingButton" type="submit" value="Ascending">
</form>
<form method="GET" action="">
	<input type="text" name="DisplayOrder" value="2" style="display: none;">
	<input id="DescendingButton" type="submit" value="Descending">
</form>

<?php
//print_r($_GET['PostsToBeDeleted']);//This may not work if the array is empty
//I think I'll fetch the favposts data from the database here.
if(isset($_SESSION['favposts']) && !empty($_SESSION['favposts'])) {
	$x = implode(',', $_SESSION['favposts']);
	if(isset($_GET['DisplayOrder']) && !empty($_GET['DisplayOrder']) && $_GET['DisplayOrder'] == 1) {
		$sql = "SELECT PostID, Title FROM travelpost WHERE PostID IN ($x) ORDER BY Title ASC";
	}
	else if(isset($_GET['DisplayOrder']) && !empty($_GET['DisplayOrder']) && $_GET['DisplayOrder'] == 2) {
		$sql = "SELECT PostID, Title FROM travelpost WHERE PostID IN ($x) ORDER BY Title DESC";
	}
	else {
		$sql = "SELECT PostID, Title FROM travelpost WHERE PostID IN ($x)";
	}
	$result = mysqli_query($conn, $sql);
	//while($row = mysqli_fetch_array($result)) {
	echo "<form method='GET' action=''>";
	if(isset($_SESSION['favposts']) && !empty($_SESSION['favposts'])) {
		//At least one item exists in the $_SESSION['favposts'] array.
		//REMEMBER THAT YOU PROBABLY ALREADY DID THIS PART IN Favorites.php!
		while($row = mysqli_fetch_array($result)) {
			echo "<input type='checkbox' name='PostsToBeDeleted[]' value=$row[PostID]><a href='#'>" . $row['Title'] . "</a><br>";
		}
		echo "<input type='submit' value='Delete Selected'>";
	}
	echo "</form>";
}
echo "<br><br>";

//Now print the favimages list
if(isset($_SESSION['favimages']) && !empty($_SESSION['favimages'])) {
	$x = implode(',', $_SESSION['favimages']);
	if(isset($_GET['DisplayOrder']) && !empty($_GET['DisplayOrder']) && $_GET['DisplayOrder'] == 1) {
		$sql = "SELECT ImageID, Path, Title FROM travelimage NATURAL JOIN travelimagedetails WHERE ImageID IN ($x) ORDER BY Title ASC";
	}
	else if(isset($_GET['DisplayOrder']) && !empty($_GET['DisplayOrder']) && $_GET['DisplayOrder'] == 2) {
		$sql = "SELECT ImageID, Path, Title FROM travelimage NATURAL JOIN travelimagedetails WHERE ImageID IN ($x) ORDER BY Title DESC";
	}
	else {
		$sql = "SELECT ImageID, Path, Title FROM travelimage NATURAL JOIN travelimagedetails WHERE ImageID IN ($x)";
	}
	$result = mysqli_query($conn, $sql);
	//while($row = mysqli_fetch_array($result)) {
	echo "<form method='GET' action=''>";
	//REMEMBER THAT YOU PROBABLY ALREADY DID THIS PART IN Favorites.php!
	while($row = mysqli_fetch_array($result)) {
		echo "<input type='checkbox' name='ImagesToBeDeleted[]' value=$row[ImageID]>" . $row['Title'] . "<br>" . "<a href='#'><img src='images/thumb/$row[Path]'></a><br><br>";
	}
	echo "<input type='submit' value='Delete Selected'>";
	echo "</form>";
}
echo "<br><br>";
?>
</form>
</body>
</html>