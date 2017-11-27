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
		<link rel="stylesheet" href="../css/order.css">


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
										echo " <li><a href='../account/login.php'>Login</a></li> ";									
										echo " <li><a href='../account/register.php'>Register</a></li> ";
										
									}
									else
									{
										echo " <li><a href='../account/account.php'>Your account</a></li> ";
										echo " <li><a href='../account/order.php'>Your Order</a></li> ";
										echo " <li><a href='../account/logout.php'>Logout</a></li> ";
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
					<a href="../checkout/viewcart.php">
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



<div class="cart-container">


 <ul class="cart-heading cart-ul">
	<li class='list0 heading'>Model</li>
	<li class='list1 heading'>Quantity</li>
	<li class='list1 heading'>Unit Price</li>
	<li class='list1 heading'>Sum</li>
</ul>



		<?php 

			$sum=0;
			$uid = $_SESSION['id'];
			$result = $con->query("SELECT * FROM orderDetails WHERE uid='$uid'");
      		
      		if($result->num_rows == 0)
      		{
      			echo 'You haven\'t made any order';
      		}
      		else
      		{
      			while($order = $result->fetch_assoc())
      			{
      				echo "<ul>";
      			foreach($order as $k=>$v)
							{	
								if($k!='id' && $k!='pid' && $k!='oid' && $k!='uid')
								{
									if($k=='model')
									{
										echo "<li class="."list0>$v</li>";		
									}
									else{
											echo "<li class="."list1>".$v."</li>";
									}
								}								
							}
							echo "</ul><br>";
					}

				$result = $con->query("SELECT SUM(total_price) as sum FROM orderDetails WHERE uid='$uid'"); 
				$row = $result->fetch_assoc(); 
				$sum = $row['sum'];  			
      		}

?>

</div>

			<div class='cart-container-total'>
				<ul class="cart-total">
				 	<li class='list-total'>Total</li>
				 	<li class="list-price"><?php if($sum>0) echo $sum; else echo '0';?></li>
				 </ul>
			</div>


</body>
</html>			