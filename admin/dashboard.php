<?php
	session_start();
	if (!isset($_SESSION["adminLogin"]))
	{
		$_SESSION['adminLogin']=0;
		header("location: admin-login.php");
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard-store</title>

		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

	</head>
<body>
	<div class="wrapper">

		<?php include 'sidebar.php';?>

			<div class="jumbotron">
				<h1 class="text-center">Welcome to the Dashboard</h1>
			</div>

	</div>
	

</body>
</html>
