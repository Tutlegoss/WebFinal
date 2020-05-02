<?php
ob_start();

if(isset($_SESSION["signedin"])==0){
    if(isset($_POST["user"]) && isset($_POST["password"])){
        if ( mysqli_connect_errno() ) {
            printf("Connect failed: %s\n", mysqli_connect_error());
    }
    $user=$_POST["user"];
    $Password=$_POST["password"];
    echo "user is";
    echo $user;
    $sql=$conn->prepare("Select * from Accounts where User=?");
    $sql->bind_param("s",$user);
    $result=$sql->execute();
    if (!$result) {
        printf("Error 0: %s\n", mysqli_error($conn));
     exit();
}

    $verify=0;
    $rows=$sql->get_result();
    $row=$rows->fetch_assoc();
    $num=$rows->num_rows;
    
    if($num==1){
        $hpw=$row["Password"];
        if(password_verify($Password, $hpw)){
            $verify=1;
        }
    }

    if($verify==1){
        $_SESSION["signedin"]=true;
        $_SESSION["user"]=$_POST["user"];
        $_SESSION["usertype"]=$_POST["type"];
        $_SESSION["userid"]=$row["ID"];
        header("Location: https://tutlegoss.com");

    }else{
        echo "<br>Your username or password is invalid. Please try again.</br>";



    }

    }
}else{header("Location: https://tutlegoss.com");}

require_once("../inc/header.inc.php");
?>


	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>
			
			<div class="col-12 col-lg-10 mt-3 mb-3">
				<div class="container d-flex">
					<div class="row justify-content-center align-self-center mx-auto">
						<div class="col-9">
							<h3> Sign in Below</h3>
							<hr>
							<p> Please enter your username, and password </p>
						</div>
						<div class="col-9">
							<form method = "post" id="forms">
								<table width = "400" border = "0" cellspacing = "1" cellpadding = "2">
									<tr>
									   <td width = "250">Username</td>
									   <td>
										  <input name = "user" type = "text" id = "user">
									   </td></tr>
								 
									<tr>
									   <td width = "200">Password</td>
									   <td>
										  <input name = "password" type = "text" id = "password">
									   </td></tr>

									<tr>
									   <td width = "200"> </td>
									   <td>
										  <input class="btn btnArt" name = "signin" type = "submit" id = "signin"  value = "Sign in">
									   </td>
									</tr>		
								</table> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
<?php require_once("../inc/footer.inc.php");?>

