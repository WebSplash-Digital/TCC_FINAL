<?php
session_start();
error_reporting(1);
include('shop_includes/config.php');
include('function.inc.php');

if(isset($_POST['action']) && $_POST['action']=="add"){
   // echo "<br> Post ";
	$id=intval($_POST['id']);
	$response = 'fail';
	if(isset($_SESSION['cart'][$id])){
     
	//	$_SESSION['cart'][$id]['quantity']++;
	//echo $_SESSION['cart'][$id]['quantity'].'<br>';
		$_SESSION['cart'][$id]['quantity'] = $_SESSION['cart'][$id]['quantity'] + $_POST['qty'];
		echo $response = 'success';
		//print_r($_SESSION['cart'][$id]['quantity']);
		//echo "<script>alert('Product has been added to the cart')</script>";
		//	echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
		
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => $_POST['qty'], "price" => $row_p['productPrice']);
            //echo "<br> Added New Product to Cart ";
					echo "<script>alert('Product has been added to the cart')</script>";
	//	echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
		}else{
			$message="Product ID is invalid";
		}
	}

}
?>