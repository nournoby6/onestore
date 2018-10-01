<?php
	// Database connection
	
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'store';

	$con = new mysqli($host, $user, $pass, $db) or die($mysqli->error);


function process_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}





?>