<?php
ob_start();
require_once("../inc/header.inc.php");
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>


<?php


require_once('../inc/dbconnect.php');


if(isset($_SESSION["signedin"])==1){
    if(isset($_SESSION["usertype"])){
        $c=$_SESSION["usertype"];
        
        
        if($c=="Admin"){
        if ( mysqli_connect_errno() ) {
            printf("Connect failed: %s\n", mysqli_connect_error());
    }
    $sql="Select * from traveluserdetails";
    $result=mysqli_query($conn,$sql);
    if (!$result) {
        printf("Error 0: %s\n", mysqli_error($conn));
        exit();
    }
    $resultarray=array();
    
    while($row=mysqli_fetch_array($result)){
        $resultarray[]=$row;
    }
    echo '<div class="container d-flex" style="margin: -40px">';
    echo '<div class="row justify-content-center align-self-center mx-auto">';
    echo '<div class="col-12 col-md-8 col-lg-6">';
    echo '<br>';
    echo '<table align=justify style="top:1000px">';
    echo '<td>';
    foreach($resultarray as $row){
        echo '<tr><th><a href="/pages/edituser.php?uid='.$row["UID"].'">edit</a></th><th align=left style="padding: 36px;">'.$row["FirstName"].'</th><th align=left>'.$row["LastName"].'</th><th align=left>'.$row["Address"].'</th><th align=left>'.$row["City"].'</th><th align=left>'.$row["Region"].'</th><th align=left>'.$row["Country"].'</th><th align=left>'.$row["Postal"].'</th><th align=left>'.$row["Phone"].'</th><th align=left>'.$row["Email"].'</th><th align=left>'.$row["Privacy"].'</th></tr>';
    }
    echo '</td></table></div></div></div>';
    
    }else{
        header("Location: https://tutlegoss.com");
    }
}
}else{
    header("Location: https://tutlegoss.com");

}


?>















<?php require_once("../inc/footer.inc.php");?>





