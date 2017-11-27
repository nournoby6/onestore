<?php
	session_start();
	if (!isset($_SESSION["login"]))
	{
		$_SESSION['login']=0;
		$_SESSION['page']='index.php';
	}

	$_SESSION['start']=0;

	if (!(isset($_SESSION['item'])))
	{
		$_SESSION['item']=0;
	}
	// $_SESSION['item']=0;
	$_SESSION['prev_page']=$_SERVER['PHP_SELF'];

	// echo $_SESSION['login'];
	require '../account/db.php';



?>


<!DOCTYPE html>
<html>
	<head>
		<title>
			
		</title>
		<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
		<!-- top -->
		<div id="top">
				<div class="top-left">
					<ul>
						<li><a href=""><img src="../img/phone.png" alt="phone: ">+88 01755-123456</a></li>
						<li><a href=""><img src="../img/mail.png" alt="mail: ">example@gmail.com</a></li>
						<li><a href=""><img src="../img/location.png" alt="location: ">Talaimari, Rajshahi</a></li>
					</ul>
				</div>
				<div class="top-right">
					<ul>
						<?php 
								if($_SESSION['login']==0)
								{
									echo "<li id='navlist'><a href=''><img src='../img/user.png' alt='user: '>My Account</a>";
								}
								else
								{
									echo "<li id='navlist'><a href=''><img src='../img/user.png' alt='user: '>".
									$_SESSION['first_name']." ".$_SESSION['last_name']."</a>";
								}
							?>
							<ul id="sub-navlist">							
								<?php
									if($_SESSION['login']==0)
									{	
										echo " <li><a href='account/login.php'>Login</a></li> ";									
										echo " <li><a href='account/register.php'>Register</a></li> ";
										
									}
									else
									{
										echo " <li><a href='account/account.php'>Your account</a></li> ";
										echo " <li><a href='account/order.php'>Your Order</a></li> ";
										echo " <li><a href='account/logout.php'>Logout</a></li> ";
									}

								?>
								
							</ul>
						</li>
					</ul>
				</div>
		</div>


		<!-- header -->
		<div id="site-header">
				<!-- logo -->
				<div id="logo">
					<a href="../index.php"><img src="../img/logo.png" alt="store-logo">
					<h1>ne-Store</h1>
					</a>
				</div>

				<!-- search and cart -->
				<div id="search">
					<form action="../search.php" method="GET" autocomplete="off">
						<input type="text" name="search_item" placeholder="search...">
						<input type="submit" name="search" value="search">
					</form>
				</div>

				<!-- cart -->
				<div id="cart">
					<a href="viewcart.php">
						<p><?php echo "Item ".$_SESSION['item'];?></p>
						<img src="../img/cart.png" alt="cart">
					</a>
				</div>
		</div>
				

				<!-- main-nav -->
				<nav id="main-navigation">
					<ul>
						<li><a href="../desktop.php">Desktop</a></li>
						<li id="navlist"><a href="../laptop.php">Lapotop</a>
							<ul id="sub-navlist">
								<li><a href="">Asus</a></li>
								<li><a href="">Acer</a></li>
								<li><a href="">Dell</a></li>
							</ul>
						</li>
						<li><a href="">Mobile</a></li>
						<li><a href="">Component</a></li>
						<li><a href="">Networking</a></li>
						<li><a href="">Accessories</a></li>
					</ul>
				</nav>


			<!-- site-main -->
					<!-- hero-section -->
					<div class="hero">
						<div class="hero-content">
							
						</div>
					</div>


	<?php 
		if($_SESSION['login']==0)
		{
			header('location: ../account/login.php');
		}
		else
		{

//should active *****************************************************************************************
		$uid = $_SESSION['id'];
		$uemail = $_SESSION['email'];


			$sql = "INSERT INTO orders (uid, uemail, orderdate)"
			."VALUES('$uid', '$uemail', CURDATE())";

			if($con->query($sql))
				echo 'Successfully insert in orders';
			else{
				echo 'NOT insert in orders';	
			}

//***insert the cart items**********************************************************************************************

			
				$result = $con->query("SELECT * FROM orders WHERE uid='$uid'");
      			$order = $result->fetch_assoc();

      			$oid = $order['oid'];


		foreach ($_SESSION['cart'] as $key){	

					if($key!=$_SESSION['cart'][0])
					{
						foreach($key as $k=>$v)
						{
							$product[$k] = $v;
						}

			$sql = "INSERT INTO orderDetails (pid, model, quantity, unit_price, total_price, oid, uid)"
			."VALUES('$product[pid]','$product[model]', '$product[quantity]', '$product[unit_price]', '$product[total_price]', '$oid', '$uid')";


					if($con->query($sql)){
						echo 'Successfully insert in orderDetails';
					}
					
					else{
						echo 'NOT insert in orderDetails';	
					}
					

					}
					
			}





// After the insertion cart session should be unset*******************************************


			unset($_SESSION['cart']);
			unset($_SESSION['item']);

//**********************************************************************************************

			header('location: ../account/order.php');

		}

		



	 ?>


</body>
</html>