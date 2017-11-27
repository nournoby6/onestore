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
		<link rel="stylesheet" href="../css/viewcart.css">
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
					<a href="">
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


<div class="cart-container">


 <ul class="cart-heading cart-ul">
<li class='list0 '>Model</li>
<li class='list1 list2'>Quantity</li>
<li class='list1 '>Unit Price</li>
<li class='list1 '>Sum</li>
</ul>


				<?php 



				if($_SESSION['item']>0)
				{
					foreach ($_SESSION['cart'] as $key)
					{	
						$lin=0;
						
						if($key!=$_SESSION['cart'][0])
						{

						echo '<ul class="cart-ul">';

							foreach($key as $k=>$v)
							{	
								if($k=='pid')
								{
									$pid=$v;
									continue;
								}
								if($k=='quantity')
								{

									echo "<li class="."list$lin>";
								?>			

								<div class="cart-update">
									
<!-- 								<div class='button'>
								<form action="cart.php" method='GET'>
									<input type="text" name='quantiy<?php echo $pid;?>' value='<?php	echo "$v";?>' width=100px;>
									</form>	
										<a href="cart.php?action=update&cart_product=<?php echo $pid;?>">
											<img src="../img/icon-update.png" alt="">
										</a>
									</div> -->


									<!-- <form action="cart.php" method='GET'> -->
									<input type="text" name='quantiy<?php echo $pid;?>' value='<?php	echo "$v";?>' width=100px;>
									<!-- </form>	 -->
									
									<div class='button'>
									<?php 
										echo "<a href=cart.php?action=remove&cart_product=".$pid.">";
									 ?>
										<img src="../img/icon-remove.png" alt="">
									</a>
									</div>

									</div>
								
									<?php	
									// echo "$v</li>";
									echo "</li>";	
										

								}
								else{
									echo "<li class="."list$lin>".$v."</li>";
								}
								$lin=1;
							}
						echo '</ul>';
						}

					}
				}
		?>


			<div class='cart-container-total'>
				<ul class="cart-total">
				 	<li class='list-total'>Total</li>
				 	<li class="list-price"><?php if($_SESSION['item']>0) echo $_SESSION['sum_total']; else echo '0';?></li>
				 </ul>

			</div>
			<div class='cart-order'>
				<ul>
					<li><a href="../index.php">Continue shopping
						<img src="../img/logo.png" alt="">
					</a></li>
					<li><a href="checkout.php">Confirm order
						<img src="../img/cart.png" alt="">
					</a></li>
				</ul>		
			</div>
</div>

<footer id="site-footer">
			<!-- <a href=""><img src="img/arrow-up.png" alt=""></a> -->
			<span>E-Store<br />Copyright &copy; 2017-2020</span>
		</footer>

</body>
</html>