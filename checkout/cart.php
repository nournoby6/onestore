<?php 
	session_start();
	require '../account/db.php';

	$_SESSION['cart'][0][0]='';
	
	if(!isset($_SESSION['sum_total']))
	{
		$_SESSION['sum_total']=0;
		$_SESSION['item']=0;
	}
?>

<?php  
// case "add":
if(isset($_GET['cart_product'])) 
	{
		$pid = $_GET['cart_product'];
		$product = $con->query("SELECT * FROM products WHERE pid=$pid ");
		$row = $product->fetch_assoc();
	}
if(isset($_GET['action'])) 
{
	$action = $_GET['action'];
}
if($action=='add'){

		// if(is_array($_SESSION['cart']))
	
			if(array_key_exists($row['pid'], $_SESSION['cart']))
			{
				{
				echo 'Yes<br>';
					
						$_SESSION['cart'][$row['pid']]['quantity'] +=1;
						$_SESSION['cart'][$row['pid']]['total_price'] += $row['new_price']; 
						$_SESSION['sum_total'] += $row['new_price'];
						$_SESSION['item']++;
				}
			}
			else
			{
				$_SESSION['cart'][$row['pid']] = array(
													'pid'=>$row['pid'],
													'model'=>$row['model'],
													// 'thumbnail'=>"data:image/jpg;base64,".base64_encode($row['thumbnail']),
													 'quantity'=>1,
													 'unit_price'=>$row['new_price'],
													 'total_price'=>$row['new_price']
												);
				$_SESSION['sum_total']+=$row['new_price'];
				$_SESSION['item']++;

			}
// To print all in the page
		// foreach ($_SESSION['cart'] as $key){	
		// 			# code...
		// 		echo '<br>';
		// 			if($key!=$_SESSION['cart'][0])
		// 			{
		// 				foreach($key as $k=>$v)
		// 				{
		// 					echo 'key: '.$k.' value: '.$v;
		// 					echo "<br>";
		// 				}
		// 				echo "<br>";
		// 			}
					
		// 		}

}
elseif($action=='remove'){
	if(is_array($_SESSION['cart'])){

		if(array_key_exists($row['pid'], $_SESSION['cart']))
		{
			$_SESSION['sum_total'] -= $_SESSION['cart'][$row['pid']]['total_price'];
			$_SESSION['item']-= $_SESSION['cart'][$row['pid']]['quantity'];
			unset($_SESSION['cart'][$row['pid']]);
			echo 'Remove one item';
		}
	}
}


// elseif($action=='update')
// {	
	// if(isset($_REQUEST['quantity']))
	// {
	// 	$quantity = $_REQUEST['quantity'];


	// 	$_SESSION['item'] -= $_SESSION['cart'][$row['pid']]['quantity'];
	// 	$_SESSION['sum_total'] -= $_SESSION['cart'][$row['pid']]['quantity'];


	// 	$_SESSION['cart'][$row['pid']]['quantity'] = $quantity;
	// 	$_SESSION['cart'][$row['pid']]['total_price'] = $_SESSION['cart'][$row['pid']]['unit_price'] * $quantity;

	// 	$_SESSION['item'] += $quantity;
	// 	$_SESSION['sum_total'] +=  $_SESSION['cart'][$row['pid']]['unit_price'] * $quantity;
	// }
	// 
	
// 	$get = $_GET['quantity'.$pid];

// 	echo "update";
// }

elseif($action=='removeall'){
	$_SESSION['sum_total']=0;
	$_SESSION['item']=0;
	unset($_SESSION['cart']);
	echo 'Remove all';
}
else{
	echo 'None';
}

echo '<br>';
echo 'total Price='.$_SESSION['sum_total'];


header('location: '.$_SESSION['prev_page']);


// session_unset();
		
?>

