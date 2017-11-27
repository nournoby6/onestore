<?php 
	require 'db.php';
?>

<?php
	session_start();
	if (!isset($_SESSION["login"]))
	{
		$_SESSION['login']=0;
		$_SESSION['page']='index.php';
	}

	// echo $_SESSION['login'];
?>

<?php

	// Declare and initialize all variable to empty
	$NO_ERROR = 1;
	$first_name_err = $last_name_err = $email_err = $pass_err = $repass_err = "";
	$first_name = $last_name = $email = $pass = $repass = $password = $hash = "";



	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		if (empty($_POST["firstname"])) {
    		$first_name_err = "First name is required";
    		$NO_ERROR = 0;
  		} 
  		else {
    			$first_name = $con->real_escape_string(process_input($_POST['firstname']));

    			// check if name only contains letters and whitespace
    				if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
      				$first_name_err = "Only letters and white space allowed";
      				$NO_ERROR = 0;
      			}
    		}

  		if (empty($_POST["lastname"])) {
    		$last_name_err = "Last name is required";
    		$NO_ERROR = 0;
  		} 
  		else {
    			$last_name = $con->real_escape_string(process_input($_POST['lastname']));

    			if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
      				$last_name_err = "Only letters and white space allowed"; 
      				$NO_ERROR = 0;
      			}
    		}
  		
  		
  		if (empty($_POST["email"])) {
    		$email_err = "Email is required";
    		$NO_ERROR = 0;
  		} 
  		else {
    			$email = $con->real_escape_string(process_input($_POST['email']));

    			// check if e-mail address is well-formed
    			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      				$email_err = "Invalid email format";
      				$NO_ERROR = 0; 
    			}
    			
    			$result = $con->query("SELECT * FROM users WHERE email='$email'");
				if($result->num_rows > 0){
					 $email_err = "user with this E-mail already exist!";
					 $NO_ERROR = 0;
				}
  			}

  		if (empty($_POST["pass"])) {
    		$pass_err = "Password is required";
    		$NO_ERROR = 0;
  		} 
  		else {
  				$pass = $_POST['pass'];
    		}
  		
  		if (empty($_POST["repass"])) {
    		$repass_err = "Password is required";
    		$NO_ERROR = 0;
  		} 
  		else {
    			$repass = $_POST["repass"];
    			
    			if(strcmp($pass, $repass))
  				{
  					$repass_err = "Password don't match";
  					$NO_ERROR = 0;
  				}
  				else{
  					$password = $repass;
  					$hash = password_hash($pass, PASSWORD_DEFAULT);
  				}
    		}


    		// Submit the data to the Database server
	if($NO_ERROR)
	{
		$sql = "INSERT INTO users (first_name, last_name, email, password, hash)"
		. "VALUES ('$first_name','$last_name','$email','$password', '$hash')";

		if( $con->query($sql))
		{
			$_SESSION['active'] = 0;
			$_SESSION['login'] = 1;
			$_SESSION['message']="Request Accepted";

	

// Added at 19/11/2017****************************************************************
      $result = $con->query("SELECT * FROM users WHERE email='$email'");
      $user = $result->fetch_assoc();


            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];


//*************************************************************************************

			// $to = $email;
			// $subject = 'Account varification';
			// $message_body = 'Hello '.$firs_tname.
			// ' please click the link to active your account:			
			// http://localhost/aOne/project/account/varify.php?email='.$email.'&hash='.$hash;
			
			// mail( $to, $subject, $message_body);

			// echo "submitted";
			echo "SUBMIT";
			header("location: ../index.php");
		
			// header("location: profile.php");
		}
		else
		{
			$failed = 'Registration Failed!';
			echo "data not submitted"; 
			// header("location: error.php");
		}
	}
}
//***************This function moved to db.ph************************//
// function process_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }

?>


<!DOCTYPE html>
<html>
	<head>
		<title>
			
		</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/register.css">
	</head>
	<body>
		
	<div class="login-box">
           <a href="../index.php"><img src="../img/logo.png" class="user" alt="user-logo"></a>
           <h2>One store Sign Up</h2>
           <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
              <fieldset class="form-fiedlset">
                <legend>Personalia:</legend>				
				  
				  <label for="firstname"><p>First Name</p></label>
				  	<input type="text" id="firstname" name="firstname" value="<?php echo $first_name;?>" placeholder="firstname">
				  <label for="lastname"><p>Last Name</p></label>
                  	<input type="text" id="lastname" name="lastname" value="<?php echo $last_name;?>" placeholder="lastname">
                  <label for="email"><p>Email</p></label>
                 	 <input type="text" id="email" name="email" value="<?php echo $email;?>" placeholder="Email">
                  <label for="pass"><p>Password</p></label>
                  	<input type="Password" id="pass" name="pass" placeholder="password">
                  <label for="repass"><p>Re-Password</p></label>
                  	<input type="Password" id="repass" name="repass" placeholder="password">
                  
                  <input type="submit" name="submit" value="Sign Up">
               </fieldset>
           </form>
            <span>Already have an account,<a href="login.php">Sign In</a></span>
        </div>

		<!-- To show the errors -->
        <div class="extra-side">
			<span class="error"><?php echo $first_name_err;?></span>
			<span class="error"><?php echo $last_name_err;?></span>
			<span class="error"><?php echo $email_err;?></span>
			<span class="error"><?php echo $pass_err;?></span>
			<span class="error"><?php echo $repass_err;?></span>
        </div>
	</body>
</html>