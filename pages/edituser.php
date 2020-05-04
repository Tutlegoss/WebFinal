<?php
ob_start();
require_once("../inc/header.inc.php");
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>


<?php
$uid="";
if(isset($_GET["uid"])){
    $uid=$_GET["uid"];
}
require_once('../inc/dbconnect.php');
if(isset($_SESSION["signedin"])==1){
    if(isset($_SESSION["usertype"])=="Admin"){
        echo "is treu";
        if ( mysqli_connect_errno() ) {
            printf("Connect failed: %s\n", mysqli_connect_error());
    }

    if(isset($_POST["edit"])){
        echo $_POST["FirstName"];
        if($_POST["FirstName"]!=""){
            $fn=$_POST["FirstName"];
            $sql1=$conn->prepare("update traveluserdetails Set FirstName = ? where UID = $uid");
            $sql1->bind_param("s",$fn);
            $check=$sql1->execute();
				if(false===$check){
					printf("error1:%s\n", mysqli_error($conn));
			}
        }
        echo $_POST["LastName"];
        if($_POST["LastName"]!=""){
            $ln=$_POST["LastName"];
            echo "inputting";
            echo $ln;
            echo $uid;
            $sql1=$conn->prepare("update traveluserdetails Set LastName = ? where UID = '$uid'");
            $sql1->bind_param("s",$ln);
            $check=$sql1->execute();
				if(false===$check){
					printf("error2:%s\n", mysqli_error($conn));
			}
        }
        echo $_POST["Address"];
        if($_POST["Address"]!=""){
            $Ad=$_POST["Address"];
            $sql1=$conn->prepare("update traveluserdetails Set Address = ? where UID = $uid");
            $sql1->bind_param("s",$Ad);
            $check=$sql1->execute();
				if(false===$check){
					printf("error3:%s\n", mysqli_error($conn));
			}
        }
        echo $_POST["City"];
        if($_POST["City"]!=""){
            $ct=$_POST["City"];
            $sql1=$conn->prepare("update traveluserdetails Set City = ? where UID = $uid");
            $sql1->bind_param("s",$ct);
            $check=$sql1->execute();
				if(false===$check){
					printf("error4:%s\n", mysqli_error($conn));
			}
        }
        echo $_POST["Region"];
        if($_POST["Region"]!=""){
            $rg=$_POST["Region"];
            $sql1=$conn->prepare("update traveluserdetails Set Region = ? where UID = $uid");
            $sql1->bind_param("s",$rg);
            $check=$sql1->execute();
				if(false===$check){
					printf("error5:%s\n", mysqli_error($conn));
			}
        }
        echo $_POST["Country"];
        if($_POST["Country"]!=""){
            $cnty=$_POST["Country"];
            $sql1=$conn->prepare("update traveluserdetails Set Country = ? where UID = $uid");
            $sql1->bind_param("s",$cnty);
            $check=$sql1->execute();
				if(false===$check){
					printf("error6:%s\n", mysqli_error($conn));
			}
        }
        echo $_POST["Postal"];
        if($_POST["Postal"]!=""){
            $pt=$_POST["Postal"];
            $sql1=$conn->prepare("update traveluserdetails Set Postal= ? where UID = $uid");
            $sql1->bind_param("s",$pt);
            $check=$sql1->execute();
				if(false===$check){
					printf("error7:%s\n", mysqli_error($conn));
			}
        }
        echo $_POST["Phone"];
        if($_POST["Phone"]!=""){
            $pn=$_POST["Phone"];
            $sql1=$conn->prepare("update traveluserdetails Set Phone= ? where UID = $uid");
            $sql1->bind_param("s",$pn);
            $check=$sql1->execute();
				if(false===$check){
					printf("error8:%s\n", mysqli_error($conn));
			}
        }
        echo $_POST["Email"];
        if($_POST["Email"]!=""){
            $em=$_POST["Email"];
            $sql1=$conn->prepare("update traveluserdetails Set Email = ? where UID = $uid");
            $sql1->bind_param("s",$em);
            $check=$sql1->execute();
				if(false===$check){
					printf("error9:%s\n", mysqli_error($conn));
			}
        }
        echo $_POST["Privacy"];
        if($_POST["Privacy"]!=""){
            $py=$_POST["Privacy"];
            $sql1=$conn->prepare("update traveluserdetails Set Privacy = ? where UID = $uid");
            $sql1->bind_param("s",$py);
            $check=$sql1->execute();
				if(false===$check){
					printf("error10:%s\n", mysqli_error($conn));
			}
        }
    }







    if(isset($_GET["uid"])){
    $uid=$_GET["uid"];
    $sql=$conn->prepare("Select * from traveluserdetails where UID=?");
    $sql->bind_param("i",$uid);
        $result=$sql->execute();
    if (!$result) {
        printf("Error 0: %s\n", mysqli_error($conn));
        exit();
    }
    $row=$sql->get_result();
    $r=$row->fetch_assoc();
    $num=$row->num_rows;

    if($num<1){echo"<p>There were no rows to display</p>";
    }else{
        echo '<br><br><br>';
        echo '<div class="container d-flex" style="margin: -40px">';
        echo '<div class="row justify-content-center align-self-center mx-auto">';
        echo '<div class="col-12 col-md-8 col-lg-6">';
        echo '
        <form method = "post" id="edit">
						<table width = "400" border = "0" cellspacing = "1" cellpadding = "2">
							<tr>
							   <td width = "250">FirstName</td>
							   <td>
								  <input style="width: 500px" name = "FirstName" type = "text" id = "FirstName" placeholder="'.$r["FirstName"].' ">
							   </td></tr>
							<tr>
							   <td width = "200">LastName</td>
							   <td>
								  <input style="width: 500px" name = "LastName" type = "text" id = "LastName" placeholder="'.$r["LastName"].'">
							   </td></tr>

                               <tr>
							   <td width = "200">Address</td>
							   <td>
								  <input style="width: 500px" name = "Address" type = "text" id = "Address" placeholder="'.$r["Address"].'">
							   </td></tr>
                               <tr>
							   <td width = "200">City</td>
							   <td>
								  <input style="width: 500px" name = "City" type = "text" id = "City" placeholder="'.$r["City"].'">
                               </td></tr> 
                               <tr>
							   <td width = "200">Region</td>
							   <td>
								  <input style="width: 500px" name = "Region" type = "text" id = "Region" placeholder="'.$r["Region"].'">
							   </td></tr>

                               <tr>
							   <td width = "200">Country</td>
							   <td>
								  <input style="width: 500px" name = "Country" type = "text" id = "Country" placeholder="'.$r["Country"].'">
							   </td></tr>
                               <tr>
							   <td width = "200">Postal</td>
							   <td>
								  <input style="width: 500px" name = "Postal" type = "text" id = "Postal" placeholder="'.$r["Postal"].'">
							   </td></tr>
                               <tr>
							   <td width = "200">Phone</td>
							   <td>
								  <input style="width: 500px" name = "Phone" type = "text" id = "Address" placeholder="'.$r["Phone"].'">
							   </td></tr>
                               <tr>
							   <td width = "200">Email</td>
							   <td>
								  <input style="width: 500px" name = "Email" type = "text" id = "Email" placeholder="'.$r["Email"].'">
							   </td></tr>
                               <tr>
							   <td width = "200">Privacy</td>
							   <td>
								  <input style="width: 500px" name = "Privacy" type = "text" id = "Privacy" placeholder="'.$r["Privacy"].'">
							   </td></tr>
							<tr>
							   <td width = "200"> </td>
							   <td>
								  <input  name = "edit" type = "submit" id = "edit"  value = "Save">
							   </td>
							</tr>		
						</table> 
        ';
    }

    }
    }
}










