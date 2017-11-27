<?php 
  require 'db.php';

  // echo password_hash($pass, PASSWORD_DEFAULT);
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

	// Declare and initialize variable to empty
	$result = $user = $email_err = $password_err = $email_or_pass_err = "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if (empty($_POST["email"])) {
    		$email_err = "Email is required";
  		} 
  		else {
    			$email = $con->real_escape_string(process_input($_POST['email']));	
    			$result = $con->query("SELECT * FROM users WHERE email='$email'");

    			if($result->num_rows == 0){
					$email_err = "User with this E-mail does not exist!";
				}
    		}

  		if (empty($_POST["password"])) {
    		$password_err = "Password is required";
  		} 
  		else {
  				$user = $result->fetch_assoc();

  				$password = $_POST['password'];

    			if (!password_verify($password, $user['hash'])) {
      				$password_err = "The password you have entered is incorrect";
      			}
      			else{
            $_SESSION['id'] = $user['id'];
      			$_SESSION['email'] = $user['email'];
						$_SESSION['first_name'] = $user['first_name'];
						$_SESSION['last_name'] = $user['last_name'];
						$_SESSION['active'] = $user['active'];
						$_SESSION['login']=1;

                if(isset($_SESSION['prev_page'])){
                  header("location: ".$_SESSION['prev_page']);
                }
                else{
                  header("location: ../index.php");
                }
						    
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
		<link rel="stylesheet" href="../css/login.css">
	</head>
	<body>


		 <div class="login-box">
           <a href="../index.php"><img src="../img/logo.png" class="user" alt="user-logo"></a>
           <h2>One store Sign In</h2>
           <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
              <fieldset class="form-fiedlset">
                <legend>Personal Info</legend>
                  <label for="email"><p>Email</p></label>                  
                    <input type="text" id="email" name="email" placeholder="Email">
                    <span class="error">* <?php echo $email_err;?></span>
						<br><br>

                  <label for="password"><p>Password</p></label>
                    <input type="Password" id="password" name="password" placeholder="password">
                  	<span class="error">* <?php echo $password_err;?></span>
                  	<br><br>

                  <input type="submit" name="submit" value="Sign In">
                  
                  <p><a href="#">Forgot Password</a></p>
               </fieldset>
           </form>
            <span>Haven't an account,<a href="register.php">Register</a></span>
        </div>
	</body>
</html>