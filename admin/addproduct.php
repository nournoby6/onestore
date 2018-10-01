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
	
// **************	Declare and initialize variable to empty ********************//
	$productErron ="";

	if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		if (empty($_GET["model"])
				|| empty($_GET["price"]) || empty($_GET["stock"])
				|| empty($_GET["category"]) || empty($_GET["description"])
				|| empty($_GET["image"])) 
			{
    			$productError = "all the things are required";

  			}
  		else{
	  			$model = $_GET['model'];
	  			$price = $_GET['price'];
	  			$stock = $_GET['stock'];
	  			$category = $_GET['category'];
	  			$description = $_GET['description'];
	  			$image = $_GET['image'];
				$date = date("Y-m-d");

//  C:/Users/Nour Noby/Desktop/sign.png


				$sql = "INSERT INTO products (model, thumbnail, description, new_price, stock, date, category)"
				. "VALUES ('$model',LOAD_FILE('$image'),'$description','$price', '$stock', '$date', '$category')";

			 	if($con->query($sql)){
			 		$productError = "Successfully inserted";
				 }
			 	else
			 	{
			 		$productError = "Not inserted";
			 	}


			}



		}

/**********/ // INSERT INTO xx_BLOB(ID,IMAGE) VALUES(1,LOAD_FILE('E:/Images/jack.jpg'));



// ************************ FOR INSERT INTO TABLE ADMIN *********************
	// $first_name='marufa';
	// $last_name='zinnat';
	// $email='marufa@gmail.com';
	// $password='1234';
	// $hash= $hash = password_hash($password, PASSWORD_DEFAULT); 
	// $security_question='what is your password';
	// $answer='me';



	//	$sql = "INSERT INTO products (model, thumbnail, heading, new_price, stock, date, category)"
	//	. "VALUES ('$model',LOAD_FILE($image),'$heading','$price', '$stock', '$date', '$category')";

	// 	 if($con->query($sql)){
	// 	 	echo "Successfully inserted into admin";
	// 	 }
	// 	 else
	// 	 {
	// 	 	echo "Not inserted into admin";
	// 	 }
//******************************\ - - /******************************************

?>
<html>
	<head>
		<head>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Product Add</title>
		
		<!-- <link rel="stylesheet" href="css/style.css"> -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

	</head>
	</head>
	<body>
<div class="wrapper">
		
	<!-- 	<div class=" sidebar">
			<div class="sidebar-header">
				<h1>One store</h1>
			</div>
				<nav class="menu-bar">
					<ul>
						<li><a  href="addproduct.php">Add Product</a></li>
						<li><a  href="viewproduct.php">View Products</a></li>
						<li><a href="changepassword.php">Change Password</a></li>
					</ul>
				</nav>
		</div> -->



	<?php include 'sidebar.php';?>

		

		<div class="jumbotron">
				<h1 class="text-center">Add your products</h1>
			</div>



	<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<p class="text-secondary mb-5">All the field must be filled properly.</p>
					<span><p class="text-center text-success mb-5"><?php echo $productError?></p></span>
				</div>


		<div class="col-lg-12 col-md-12 ml-3 mr-5">
					
		<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
			<div class="form-group row">
				<label for="model" class="col-lg-2 col-form-label">Product Model</label>
    			<div class="col-lg-9">
      				<input type="text" class="form-control" id="model" name="model" placeholder="model">
    			</div>
		    </div>
			<div class="form-group row">
				<label for="price" class="col-lg-2 col-form-label">Product Price</label>
    			<div class="col-lg-9">
      				<input type="text" class="form-control" id="price" name="price" placeholder="price">
    			</div>
		    </div>
		    <div class="form-group row">
				<label for="stock" class="col-lg-2 col-form-label">Product Stock</label>
    			<div class="col-lg-9">
      				<input type="text" class="form-control" id="stock" name="stock" placeholder="stock">
    			</div>
		    </div> 
			<div class="form-group row">
				<label for="image" class="col-lg-2 col-form-label">Image Path</label>
    			<div class="col-lg-9">
      				<input type="text" class="form-control" id="image" name="image" placeholder="image path">
      				 <small class="form-text text-secondary">e.g.   C:/Users/user/Desktop/sign.png</small>
    			</div>
		    </div> 

		    <div class="form-group">
				<label for="category" class="col-form-label">Category</label>
				<select class="form-control col-lg-9" id="category" name="category">
				      <option value="">-select category-</option>
				      <option value="accessories">Accessories</option>
				      <option value="component">Component</option>
				      <option value="desktop">Desktop</option>
				      <option value="laptop">Laptop</option>
				      <option value="mobile">Mobile</option>
				      <option value="networking">Networking</option>
				 </select>

			</div> 

	
			<div class="form-group">
   		 			<label for="description">Product Description</label>
    				<textarea class="form-control col-lg-9" id="description" name="description" rows="3" placeholder="description"></textarea>
    		</div>	

			<button type="submit" value="addproduct" name="addproduct" class="btn btn-primary btn-lg">Add Product</button>

		</form>
		</div>

			</div>
	</div>



</div>	




		

	</body>
</html>