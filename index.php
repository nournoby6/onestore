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
					<h2><span>Feature Product</span></h2>
				</div>
			
			<div class=feature-wrapper>
		
			
			<?php 

				$result = $con->query("SELECT * FROM products ORDER BY pid DESC");

			while($row = $result->fetch_assoc()) 
			{
				echo "<div class='feature-box'>";
					echo "<a href='#'>";
						echo "<h2>".$row['model']."</h2>";
						echo "<img src="."data:image/jpg;base64,".base64_encode($row['thumbnail'])." />";
						echo "<h4>".substr($row['heading'],0, 60)."...</h4>";
					echo "</a>";					
						echo "<p class='old-price'>".$row['old_price']."</p>";
						echo "<p class='price'>". $row['new_price']. " BDT</p>";
						
						echo "<span><a href=checkout/cart.php?action=add&cart_product=".$row['pid'];

						echo ">Add to Cart</a></span>";

				echo "</div>";


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







				<!-- <div class="feature-box">
					<a href="#">
						<h2>Model</h2>
						<img src="img/DELL-INSPIRON-5378.jpg
						" alt="DELL-INSPIRON-5378">
						<h4>Dell Inspiron n5378 7th Gen i5 13.3" Touch Laptop...</h4>
					</a>	
						<p class="price">65000 BDT</p>					
					<span><a href="">Add to Cart</a></span>
				</div>
				<div class="feature-box">
					<a href="#">
						<h2>Model</h2>
						<img src="img/gaminglaptop.jpg" alt="gaminglaptop">
					
						<h4>Asus G701VIK 17.3" Core i7 512GB SSD With Graphics...</h4>
					</a>
					<p class="price">375500 BDT</p>
					<span><a href="">Add to Cart</a></span>
				</div>
				<div class="feature-box">
					<a href="#">
						<h2>Model</h2>
						<img src="img/Apple-MacBook-Air.jpg" alt="Apple-MacBook-Air">
					
						<h4>Apple Macbook Air 11.6 inch Core i5, 4GB Ram, 256GB SSD...</h4>
					</a>
					<p class="price">95000 BDT</p>
					<span><a href="">Add to Cart</a></span>
				</div>
				<div class="feature-box">
					<a href="#">
						<h2>Model</h2>
						<img src="img/Acer-Aspire-E5.jpg" alt="Acer-Aspire-E5">
					
						<h4>Acer Aspire E5-575 7th Gen Core i3 15.6" Intel Core i3-7100U Processor...</h4>
					</a>
					<p class="price">33000 BDT</p>
					<span><a href="">Add to Cart</a></span>
				</div>
				<div class="feature-box">
					<a href="#">
						<h2>Model</h2>
						<img src="img/acer-swift3.jpg" alt="acer-swift3">
					
						<h4>Acer Swift SF314-51 7th Gen i5 14" Ultrabook with 512GB SSD...</h4>
					</a>
					<p class="price">59000 BDT</p>
					<span><a href="">Add to Cart</a></span>
				</div> -->


				
			</div>
		</div>
	

			<!-- site footer -->
		<footer id="site-footer">
			<!-- <a href=""><img src="img/arrow-up.png" alt=""></a> -->
			<span>E-Store<br />Copyright &copy; 2017-2020</span>
		</footer>
	</body>
</html>














