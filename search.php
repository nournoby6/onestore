
<?php
	session_start();
	if (!isset($_SESSION["login"]))
	{
		$_SESSION['login']=0;
		$_SESSION['page']='index.php';
	}
	if (!(isset($_SESSION['item'])))
	{
		$_SESSION['item']=0;
	}

	$_SESSION['prev_page']=$_SERVER['PHP_SELF'];

	// echo $_SESSION['login'];
	require 'account/db.php';
?>


<!DOCTYPE html>
<html>
	<head>
		<title>
			
		</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<!-- top -->
		<div id="top">
				<div class="top-left">
					<ul>
						<li><a href=""><img src="img/phone.png" alt="phone: ">+88 01755-123456</a></li>
						<li><a href=""><img src="img/mail.png" alt="mail: ">example@gmail.com</a></li>
						<li><a href=""><img src="img/location.png" alt="location: ">Talaimari, Rajshahi</a></li>
					</ul>
				</div>
				<div class="top-right">
					<ul>
						<?php 
								if($_SESSION['login']==0)
								{
									echo "<li id='navlist'><a href=''><img src='img/user.png' alt='user: '>My Account</a>";
								}
								else
								{
									echo "<li id='navlist'><a href=''><img src='img/user.png' alt='user: '>".
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
					<a href="index.php"><img src="img/logo.png" alt="store-logo">
					<h1>ne-Store</h1>
					</a>
				</div>

				<!-- search and cart -->
				<div id="search">
					<form action="search.php" method="GET" autocomplete="off">
						<input type="text" name="search_item" placeholder="search...">
						<input type="submit" name="search" value="search">
					</form>
				</div>

				<!-- cart -->
				<div id="cart">
					<a href="checkout/viewcart.php">
						<p><?php echo "Item ".$_SESSION['item'];?></p>
						<img src="img/cart.png" alt="cart">
					</a>
				</div>
		</div>
				

				<!-- main-nav -->
				<nav id="main-navigation">
					<ul>
						<li><a href="desktop.php">Desktop</a></li>
						<li id="navlist"><a href="laptop.php">Lapotop</a>
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

					<!-- feature -->
		<div class="site-section">
				<div class="section-header">
					<h2>Search Results</h2>
				</div>



			<?php 
			if($_SERVER['REQUEST_METHOD'] == "GET")
			{
				if(!empty($_GET['search_item']))
					{
						$search_item = $_GET['search_item'];
						$result = $con->query("SELECT * FROM products WHERE heading LIKE '%".$search_item. "%'");
					}
					else{
						$result = $con->query("SELECT * FROM products");
					}
			
				if($result->num_rows> 0)
				{
					while($row = $result->fetch_assoc()) 
					{
						echo "<div class='feature-box'>";
							echo "<a href='#'>";
								echo "<h2>".$row['model']."</h2>";
								echo "<img src="."data:image/jpg;base64,".base64_encode($row['thumbnail'])." />";
								echo "<h4>".substr($row['heading'],0, 60)."...</h4>";
							echo "</a>";
								echo "<p class='old-price'>".$row['old_price']."</p>";
								echo "<p class='price'>".$row['new_price']." BDT</p>";
								
						echo "<span><a href=checkout/cart.php?action=add&cart_product=".$row['pid'];

						echo ">Add to Cart</a></span>";

						echo "</div>";


					}
				}
				else{
						echo "No match found with this name: ";
						echo $search_item;
					}
			}
				// <div class="feature-box">
				// 	<a href="#">
				// 		<h2>ASUS P2540UA-AB51</h2>
				// 		<img src="data:image/jpeg;base64,<?php echo base64_encode($row['thumbnail']); 
				// 		// <h4>HP X360 11-ab002tu Celeron Dual Core 11.6" Notebook...</h4>
				// 		<h4>ASUS P-Series P2540UA-AB51 business standard Laptop, 7th Gen Intel Core i5, 2.5GHz (3M Cache, up to 3.1GHz), FHD </h4>
				// 	</a>
				// 		<!-- <p class="old-price">32000 BDT</p> -->
				// 		<p class="price">30000 BDT</p>					
				// 	<span><a href="">Add to Cart</a></span>
				// </div>


		 ?>
