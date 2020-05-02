<?php
ob_start();
require_once("../inc/header.inc.php");
require_once('../inc/dbconnect.php');

function validateEm($email) {
    $pattern = '/^[\-0-9a-zA-Z\.\+_]+@[\-0-9a-zA-Z\.\+_]+\.[a-zA-Z\.]{2,5}$/';
    if ( preg_match($pattern, $email) ) {
      return true;
    }
    return false;
 }

 function validatePW($password) {
    $pattern = "/^.{8,30}$/";
    if ( preg_match($pattern, $password) ) {
      return true;
    }
    return false;
 }


		if ( mysqli_connect_errno() ) {
    			printf("Connect failed: %s\n", mysqli_connect_error());
		}
		
		if(isset($_POST['create'])) {
			$user = $_POST['user'];
			$password = $_POST['password'];
            $email = $_POST['email'];
            
			$rand=mt_rand();
			$sql="select ID from Accounts";
			$results= mysqli_query($conn,$sql);
			if (!$results) {
					printf("Error 0: %s\n", mysqli_error($conn));
				 exit();
			}
			$resultarray=array();
			while($row=mysqli_fetch_array($results)){
				$resultarray[]=$row;
			}
			$bool=0;
			while($bool==0){
				$bool=1;
				foreach($resultarray as $row){
					if($rand==$row){
						$rand=mt_rand();
						$bool=0;
					}
				}
			}
			$error="";
			if(validateEm($email)===false){
				$error='<p class="red">Your email is invalid. Please try again.</p>';
			}

			if(validatePW($password)===false){
				$error= $error . '<p class="red">Your Password is invalid. Must be 8 characters or more.</p>'; 
			}

			if($error!=""){
				echo '<p class="red">'.$error.'</p>';
			}else{

				$hash=password_hash($password,PASSWORD_BCRYPT);
                
				$sql1 =$conn->prepare("INSERT INTO Accounts ".
				"(User, Password,ID,Email) "."VALUES ".
				"(?,?,?,?)");
		
				$sql1->bind_param("ssis",$user,$hash,$rand,$email);
				$retval=$sql1->execute();
				if(false===$retval){
					printf("error 1:%s\n", mysqli_error($conn));
				}
				if(! $retval ) {
					die('This account cannot be created. Please try again later.');
				}

				header("/signin.php");		
			}
		}

?>
        
	<div class="container-fluid">
		<div class="row">
			<?php include("../inc/leftPanel.inc.php"); ?>
			
			<div class="col-12 col-lg-10 mt-3 mb-3">
				<div class="container d-flex">
					<div class="row justify-content-center align-self-center mx-auto">
						<div class="col-9">
							<h3> Create your account</h3>
							<hr>
							<p> Please enter your username, your email, and password </p>
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
									   <td width = "200" >Email Address</td>
									   <td>
										  <input name = "email" type = "text" id = "email" placeholder="@mail.com">
									   </td></tr>
								 
									<tr>
									   <td width = "200">Password</td>
									   <td>
										  <input name = "password" type = "password" id = "password" placeholder="8-30 Chars">
									   </td></tr>

									<tr>
									   <td width = "200"> </td>
									   <td>
										  <input class="btn btnArt" name = "create" type = "submit" id = "create"  value = "Create account">
									   </td>
									</tr>		
								</table> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php require_once("../inc/footer.inc.php");?>