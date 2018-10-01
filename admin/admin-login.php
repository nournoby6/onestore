<?php 
  require 'db.php';

  // echo password_hash($pass, PASSWORD_DEFAULT);
?>

<?php
	session_start();
	if (!isset($_SESSION["adminlogin"]))
	{
		$_SESSION['adminlogin']=0;
		// $_SESSION['adminPage']='adminLogin.php';
	}

	// echo $_SESSION['login'];
?>

<?php

// **************	Declare and initialize variable to empty ********************//
	$result = $admin = $email_err = $password_err = $email_or_pass_err = "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if (empty($_POST["email"])) {
    		$email_err = "Email is required";

  		} 
  		else {
    			$email = $con->real_escape_string(process_input($_POST['email']));	
    			$result = $con->query("SELECT * FROM admin WHERE email='$email'");

    			if($result->num_rows == 0){
					$email_err = "User with this E-mail does not exist!";
				}
    		}

  		if (empty($_POST["password"])) {
    		$password_err = "Password is required";
  		} 
  		else {
  				$admin = $result->fetch_assoc();

  				$password = $_POST['password'];

    			if (!password_verify($password, $admin['hash'])) {
      				$password_err = "The password you have entered is incorrect";
      			}
      			else{
            	$_SESSION['aid'] = $admin['aid'];
      			$_SESSION['aemail'] = $admin['email'];
						$_SESSION['afirst_name'] = $admin['first_name'];
						$_SESSION['alast_name'] = $admin['last_name'];
						$_SESSION['adminLogin']=1;

					
                  header("location: dashboard.php");
                }
						    
      			}
    	}
	 


// ************************ FOR INSERT INTO TABLE ADMIN *********************
	// $first_name='marufa';
	// $last_name='zinnat';
	// $email='marufa@gmail.com';
	// $password='1234';
	// $hash= $hash = password_hash($password, PASSWORD_DEFAULT); 
	// $security_question='what is your password';
	// $answer='me';



	// 	$sql = "INSERT INTO admin (first_name, last_name, email, password, hash, security_question, answer)"
	// 	. "VALUES ('$first_name','$last_name','$email','$password', '$hash', '$security_question', '$answer')";

	// 	 if($con->query($sql)){
	// 	 	echo "Successfully inserted into admin";
	// 	 }
	// 	 else
	// 	 {
	// 	 	echo "Not inserted into admin";
	// 	 }
//******************************\ - - /******************************************

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Admin-Sign-In</title>
		
		<link rel="stylesheet" href="css/style.css">

		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

	</head>
<body>

<!-- 	<div class="heading">
		<h2>Admin Sign In</h2>
	</div>	 -->

	<div class="jumbotron outer-box mt-5">
	<div class="container-fluid">
		<h2 class="text-center mb-5 heading">Admin Sign In</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
			<div class="form-group">
				<label class="sr-only" for="email">email</label>
		      
		      <div class="input-group">
		        <div class="input-group-prepend">
		          <div class="input-group-text"><span class="fa fa-user icon"></span></div>
		        </div>
		        <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
		      </div>
		      <small class="error form-text text-danger">* <?php echo $email_err;?></small>
		    </div>
			
			<div class="form-group">
				<label class="sr-only" for="password">password</label>
		      
		      <div class="input-group">
		        <div class="input-group-prepend">
		          <div class="input-group-text"><span class="fa fa-lock icon"></span></div>
		        </div>
		        <input type="text" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
		      </div>
		      <small class="error form-text text-danger">* <?php echo $password_err;?></small>
		    </div>

		    <div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="check">
					<label for="check" class="form-check-label">Remember Me</label>
			</div>
	
			<button type="submit" value="adminSignin" class="btn btn-primary btn-lg btn-block">Sign In</button>

		</form>

	</div>
	</div>

</body>	
</html>