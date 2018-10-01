<?php
	session_start();
	if (!isset($_SESSION["adminLogin"]))
	{
		$_SESSION['adminLogin']=0;
		header("location: admin-login.php");
	}

?>

<?php
	
	require 'db.php';

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard-store</title>

		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

	<style type="text/css">
    .img-small {
        width: 50px;
        height: 50px;
    }
    table {
    	/*border-collapse: collapse;*/
    	margin-left: 100px;
	}

	table, th, td {
	    border: 1px solid black;
	}
    th{
    	width: 100%;
    }
    .col-name{
    	width: 100%;
    	background: #DDD;
    }

    </style>





	</head>
<body>
	<div class="wrapper">

		<?php include 'sidebar.php';?>
		
		<div class="jumbotron">
				<h1 class="text-center">All the Products are Shown</h1>
			</div>




			<div class="row">
				<div class="col-lg-10 col-md-10">


		<div class="container-fluid text-center">
			
			
			<div class="feature-wrapper row">
			
			<table>
			<div class="row">
				<tr>
					<th class="col-2 col-name">PID</th>
					<th class="col-3 col-name">Model</th>
					<th class="col-2 col-name">Image</th>
					<th class="col-2 col-name">Price</th>
					<th class="col-2 col-name">Stock</th>
					<th class="col-2 col-name">Category</th>
				
				</tr>
			</div>
			<?php 

			$result = $con->query("SELECT * FROM products ORDER BY pid ASC");

			while($row = $result->fetch_assoc()) 
			{
				?>
			<tr>	
				<td class='col-2'>
					<?php echo $row['pid']; ?>
				</td>
				<td class='col-2'>
						<?php echo $row['model']; ?>
				</td>
				<td class='col-2'>
					<?php echo "<img class='img-small' src="."data:image/jpg;base64,".base64_encode($row['thumbnail'])." />"; ?>
				</td>		
				<td class='col-2'>
					<?php echo $row['new_price']; ?>
				</td>
				<td class='col-2'>
					<?php echo $row['stock']; ?>
				</td>
				<td class='col-2'>
					<?php echo $row['category']; ?>
				</td>
			</tr>
			<?php } ?>

			</table>

	


		 <div class="row">
		 	<div class="col-1">
		 		<?php echo $row['model']?>;
		 	</div>
		 	<div class="col-2">
		 		
		 	</div>
		 	<div class="col-2">
		 		
		 	</div>
		 </div>
		 
		 </div>

					
			</div>
		</div>
	

</body>
</html>
