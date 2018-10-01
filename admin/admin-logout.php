<?php
	session_start();

	$_SESSION['adminlogin']=0;
	session_destroy();

	header("location: admin-login.php");

?>