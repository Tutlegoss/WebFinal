<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/1462a14240.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
</head>
<body>
<script>
	var DisplayingAscending;
	var DisplayingDescending;
</script>
<?php
include_once('dbConnect.php');
//For testing purposes, let's creat a fake favorits list for posts and images.
//$_SESSION['favposts'] = [4, 5, 6];//This is an array of post ids.

//search the propper $_SESSION array for the id given, then unset that key in the $_SESSION array.
//Check to see if the $_GET['ToBeDeleted'] array is set and not empty.
if(isset($_GET['PostsToBeDeleted']) && !empty($_GET['PostsToBeDeleted'])) {
	foreach($_GET['PostsToBeDeleted'] as $x) {
		//search the $_SESSION['favposts'] for $x
		$key = array_search($x, $_SESSION['favposts']);
		unset($_SESSION['favposts'][$key]);
		$_GET['ToBeDeleted'] = array();
		//unset($_GET['PostsToBeDeleted']);//This is an array, so this might not work. I might need a for loop.
	}
}

echo "<button type='button' id='ascendingbutton'>Ascending</button>";
echo "<button type='button' id='descendingbutton'>Descending</button>";
echo "<h2>Favorite Posts</h2>";
echo "<div id='favposts'>";
//search the database for the relevant into and print it here.
//first check to see if the list of favorite posts is empty
if(isset($_SESSION['favposts']) && !empty($_SESSION['favposts'])) {
$x = implode(',', $_SESSION['favposts']);
$sql = "SELECT PostID, Title FROM travelpost WHERE PostID IN ($x)";
$result = mysqli_query($conn, $sql);
echo "<form method='GET' action=''>";
while($row = mysqli_fetch_array($result)) {
?>
<input type="checkbox" name="PostsToBeDeleted[]" value="<?php echo $row['PostID']; ?>" /><a href="DisplaySinglePost.php?posid=<?php echo $row['PostID']; ?>"><?php echo $row['Title']; ?></a><br>
<?php
};
echo "<input type='submit' value='Delete Selected' />";
echo "</form>";
echo "</div>";
}
echo "<div id='favpostsascending'><form id='PostsAscendingForm' method='GET' action=''></form></div>";
echo "<div id='favpostsdescending'><form id='PostsDescendingForm' method='GET' action=''></form></div>";
?>

<script><!-- Do I need the script tags? -->
$(function() {
	$("#ascendingbutton").on("click", function() {
		$("#favposts").hide();
		$("#favpostsascending").show();
		$("#favpostsdescending").hide();
		if(DisplayingAscending != 2) {//if the ascending order is not already displayed...
		//$("#favimages").css("display", "none");
		<?php
		if(isset($_SESSION['favposts']) && !empty($_SESSION['favposts'])) {
			$x = implode(',', $_SESSION['favposts']);
			$sql = "SELECT PostID, Title FROM travelpost WHERE PostID IN ($x) ORDER BY Title ASC";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result)) {
		?>
		var g = $('<input>', {
			type: 'checkbox',
			name: 'PostsToBeDeleted[]',
			value: '<?php echo $row["PostID"] ?>'
		});
		var a = $('<a>', {
			href: 'Part02_SinglePost.php?posid=<?php echo $row["PostID"]; ?>',
			text: '<?php echo $row["Title"]; ?>'
		});
		var b = $('<br>');
		$("#PostsAscendingForm").append(g);
		$("#PostsAscendingForm").append(a, b);
		<?php
		};
		}
		?>
		//Now for the delete button
		var h = $('<input>', {
			type: 'submit',
			value: 'Delete Selected'
		});
		$("#PostsAscendingForm").append(h);
		DisplayingAscending = 2;
		}
	});
	//Now do it for the descending button
	$("#descendingbutton").on("click", function() {
		$("#favposts").hide();
		$("#favpostsascending").hide();
		$("#favpostsdescending").show();
		if(DisplayingDescending != 3) {//if the ascending order is not already displayed...
		//$("#favimages").css("display", "none");
		<?php
		if(isset($_SESSION['favposts']) && !empty($_SESSION['favposts'])) {
			$x = implode(',', $_SESSION['favposts']);
			$sql = "SELECT PostID, Title FROM travelpost WHERE PostID IN ($x) ORDER BY Title DESC";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result)) {
		?>
		var g = $('<input>', {
			type: 'checkbox',
			name: 'PostsToBeDeleted[]',
			value: '<?php echo $row["PostID"] ?>'
		});
		var a = $('<a>', {
			href: 'Part02_SinglePost.php?posid=<?php echo $row["PostID"]; ?>',
			text: '<?php echo $row["Title"]; ?>'
		});
		var b = $('<br>');
		$("#PostsDescendingForm").append(g);
		$("#PostsDescendingForm").append(a, b);
		<?php
		};
		}
		?>
		//Now for the delete button
		var h = $('<input>', {
			type: 'submit',
			value: 'Delete Selected'
		});
		$("#PostsDescendingForm").append(h);
		DisplayingDescending = 3;
		}
	});
});
</script>
<?php
$x = implode(',', $_SESSION['favposts']);
echo $x;
?>