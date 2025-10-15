<?php
session_start();
error_reporting(1);
require_once('shop_includes/config.php');
require_once('includes/config.php');
require_once('function.inc.php');

// include('includes/config.php');
// include('function.inc.php');

/******************UPDATE CART ITEAM*************************************** */

if($_POST['action'] == 'updateCart'){
	$productId = $_POST['productId'];
	$qty = $_POST['Qty'];
	$productPrice = "SELECT * FROM products WHERE id={$productId}";
	$result = mysqli_query($con,$productPrice);
	$rowData = mysqli_fetch_array($result);
    $amount = $qty*$rowData['productPrice'];
	$query = "update cart set qty=".$qty.",amount=".$amount." where user_id=".$_SESSION['id']." and product_id=".$productId;
     $update = mysqli_query($con,$query);
	 if($update){
		echo "updated";
		
	 }
	//echo $productId.'==>'.$qty;
}
/********************END UPDATE CART**************************************** */

/*************************REMOVE CART ITEAMS********************************* */
if($_POST['action'] == 'RemoveCart'){
	$productId = $_POST['productId'];
	$query = "DELETE from cart where user_id=".$_SESSION['id']." and product_id=".$productId;
	$deleted = mysqli_query($con,$query);
	if($deleted){
        echo 'deleted';
	}

}
/***********************END REMOVE CART ITEAM********************************* */
/********************* Remove wishlist Iteam***********************************/
if($_POST['action'] == 'RemoveWishlist'){
	$Id = $_POST['Id'];
	$query = "DELETE from wishlist where id=".$Id;
	$deleted = mysqli_query($con,$query);
	if($deleted){
        echo 'deleted';
	}
}
/*******************END wishlist Iteams*************************************** */
/*******************moveTocart *********************************************** */
if($_POST['action'] == 'moveTocart'){
	$productId = $_POST['productId'];
	$id = $_POST['id'];
	//delete iteam from cart
	$query = "DELETE from wishlist where id=".$id;
	$deleted = mysqli_query($con,$query);
	if($deleted){
			//Insert iteam in cart
	//get product deatils
	$productDeatils = getProductDetail($productId);
	$qty = 1;
	echo $query1 = "insert into cart(user_id,product_id,amount,qty) values('" . $_SESSION['id'] . "',".$productId.",".$productDeatils[0]->productPrice*$qty.",1)";
	mysqli_query($con,$query1);
	}
}
/***************************END ********************************************** */

/***********************SAVED ORDER******************************************** */
if($_POST['action'] == 'addOrder'){
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$ssuburb = $_POST['ssuburb'];
	$bcity = $_POST['bcity'];
	$state = $_POST['state']; 
	$bpcode = $_POST['bpcode'];
	$productList = getCartListByUserId($_SESSION['id']);
	$productListarray = [];
	$dataSaved = false;
	foreach($productList as  $productListid){
		$productListid->product_id;
		array_push($productListarray,$productListid->product_id);

	}
	//print_r($productListarray);die;
	$produtListstring = implode(',',$productListarray);
	$cartTotal = getCartTotal($_SESSION['id']);
	//print_r($cartTotal[0]->CartTotal);die;
	$cartNo = cartCount($_SESSION['id']);
	$totalAmount = $cartTotal[0]->CartTotal;  
	$qty = $cartNo[0]->CartiteamCount;
	$paymentMethod = 'COD';
	$orderStatus = 'Pending';
	$Shipping_name = $_POST['name'];
	$shipping_email = $_POST['email'];
	$shipping_phone = $_POST['phone'];
	$shipping_address = $_POST['address'];
	$shipping_shburb = $_POST['ssuburb'];
	$shipping_city = $_POST['bcity'];
	$shipping_state = $_POST['state'];
	$shipping_postalcode = $_POST['bpcode'];
	$invoiceId = 'Tcc-'.(rand(10,1000));
    $query1 = "insert into 
	orders(userId,
	productId,
	total_amount,
	quantity,
	invoiceId,
	paymentMethod,
	orderStatus,
	Shipping_name,
	shipping_email,
	shipping_phone,
	shipping_address,
	shipping_shburb,
	shipping_city,
	shipping_state,
	shipping_postcode) values(" . $_SESSION['id'] . ",
	'".$produtListstring."',
	".$totalAmount.",
	".$qty.",
	'".$invoiceId."',
	'".$paymentMethod."',
	'".$orderStatus."',
	'".$Shipping_name."',
	'".$shipping_email."',
	'".$shipping_phone ."',
	'".$shipping_address."',
	'".$shipping_shburb."',
	'".$shipping_city."',
	'".$shipping_state."',
	'".$shipping_postalcode."')";
	//die;
	mysqli_query($con,$query1);
	$last_id = $con->insert_id;
	foreach($productList as  $productListid){
		$productListid->product_id;
		$query  = "insert into order_details(user_id,order_id,product_id,Qty,Amount) values('" . $_SESSION['id'] . "','".$last_id."',".$productListid->product_id.",".$productListid->qty.",".$productListid->amount.")";
		$orderPlaced = mysqli_query($con,$query);
		if($orderPlaced){
			$_SESSION['orderId'] = $last_id;
			deleteAllCartDataByuserid($_SESSION['id']);
          echo  $dataSaved = true;
		}else{
			echo $dataSaved;
		} 
	} 
}
/*************************END SAVE ORDER*************************************** */

if (isset($_GET['action']) && $_GET['action'] == "add") {
	    
	$id = intval($_GET['id']);
	if (isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id]['quantity']++;
  	} else {
		$sql_p = "SELECT * FROM products WHERE id={$id}";
		$query_p = mysqli_query($con, $sql_p);
		if (mysqli_num_rows($query_p) != 0) {
			$row_p = mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
			//echo "<script>alert('Product has been added to the cart')</script>";
			//echo "<script type='text/javascript'> document.location ='shop-cart.php'; </script>";
		} else {
			$message = "Product ID is invalid";
		}
	} 

	$pid = intval($_GET['id']);
} elseif (isset($_POST['action']) && $_POST['action'] == "add") {
	
	$id = intval($_POST['id']);
	// if (isset($_SESSION['cart'][$id])) {
	// 	echo 'ddd';
	// 	$_SESSION['cart'][$id]['quantity']++;
	// } else {
	// }
	    $sql_p = "SELECT * FROM products WHERE id={$id}";
		$query_p = mysqli_query($con, $sql_p); 
		if (mysqli_num_rows($query_p) != 0) {
			$row_p = mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']] = array("quantity" => $_POST['qty'], "price" => $row_p['productPrice']);
			//check iteam already added in cart
			$cartCheck = "select id as itesms from cart where product_id=".$_POST['id']." and user_id=".$_SESSION['id'];
			$checkount = mysqli_query($con,$cartCheck);
         
			if($checkount->num_rows<=0){
				mysqli_query($con, "insert into cart(user_id,product_id,amount,qty) values('" . $_SESSION['id'] . "',".$_POST['id'].",".$row_p['productPrice']*$_POST['qty'].",".$_POST['qty'].")");
				echo "<script>alert('Product has been added to the cart ')</script>";
				echo "<script type='text/javascript'> document.location ='shop-cart.php'; </script>";
			}else{
			 	echo "<script>alert('This iteam already added in cart ')</script>";
				echo "<script type='text/javascript'> document.location ='shop-cart.php'; </script>";
			}
			
		} else {
			$message = "Product ID is invalid";
		}


	$pid = intval($_POST['id']);
}
if (isset($_GET['pid'])) {
	$pid = intval($_GET['pid']);
}

if (isset($_GET['pid']) && $_GET['action'] == "wishlist") {
	print_r($_GET['pid']); 
	print_r($_SESSION['id']);
	// print_r($_GET['action']); die;
	if (strlen($_SESSION['id']==0)) {
		header('location:logout.php');
	} else {
		mysqli_query($con, "insert into wishlist(userId,productId) values('" . $_SESSION['id'] . "','$pid')");
		
		echo "<script>alert('Product aaded in wishlist ')</script>";
		echo "<script type='text/javascript'> document.location ='shop-whishlist.php'; </script>";
		
	}
}
if (isset($_POST['submit'])) {

	$qty = 0;
	$price = 0;
	$value = $_POST['rating'];
	$name = $_POST['name'];
	$summary = $_POST['summary'];
	$review = $_POST['review'];
	$sql = "insert into `productreviews`(`productId`,`quality`,`price`,`value`,`name`,`summary`,`review`) values('$pid','$qty','$price','$value',:name,:summary,:review)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':summary', $summary, PDO::PARAM_STR);
	$query->bindParam(':review', $review, PDO::PARAM_STR);
	$query->execute();
	//die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">
	<title>Product Details</title>
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
	<link rel="stylesheet" href="shop_assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="shop_assets/css/main.css">
	<link rel="stylesheet" href="shop_assets/css/green.css">
	<link rel="stylesheet" href="shop_assets/css/owl.carousel.css">
	<link rel="stylesheet" href="shop_assets/css/owl.transitions.css">
	<link rel="stylesheet" href="shop_assets/css/lightbox.css">
	<link rel="stylesheet" href="shop_assets/css/animate.min.css">
	<link rel="stylesheet" href="shop_assets/css/rateit.css">
	<link rel="stylesheet" href="shop_assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="shop_assets/css/config.css">
	<link href="shop_assets/css/green.css" rel="alternate stylesheet" title="Green color">
	<link href="shop_assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
	<link href="shop_assets/css/red.css" rel="alternate stylesheet" title="Red color">
	<link href="shop_assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
	<link href="shop_assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
	<link rel="stylesheet" href="shop_assets/css/font-awesome.min.css">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="shop_assets/images/favicon.ico">
	<!-- New design-->
	<!--BOOTSTRAP CSS-->

	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

	<!--CUSTOM CSS-->

	<link href="css/custom.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/review.css" rel="stylesheet" type="text/css">
	<!--COLOR CSS-->

	<link href="css/color.css" rel="stylesheet" type="text/css">

	<!--RESPONSIVE CSS-->

	<link href="css/responsive.css" rel="stylesheet" type="text/css">

	<!--OWL CAROUSEL CSS-->

	<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">

	<!--FONTAWESOME CSS-->

	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!--SCROLL FOR SIDEBAR NAVIGATION-->

	<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">

	<!--GOOGLE FONTS-->
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

	<![endif]-->
	<style type="text/css">

	</style>
	<!-- New design-->
</head>

<body class="cnt-home">

	<div id="wrapper">

		<!--HEADER START-->
		<?php include_once('includes/head_new.php');
		//$row = getTopBanner('shop-page');
		?>
		<!--HEADER END-->
		<!--INNER BANNER START-->
		<!--
<section id="inner-banner" class="bgimgservices bgimgshop" style="background-image: url('images/banners/<?= $row[0]->banner_img ?>');
">
<div class="img-background-overlay"></div>
<div class="container">
<div class="row">
 <div class="col-md-12">
   <div class="service-head">
   <div class="headerText">
	 <h1 class="banner-title">Advertise Latest / Hero Product</h1>    
   </div>
   </div>
 </div>
</div>
</div>
</section>
-->
		<div class="clearfix clear"></div>
		<!-- ============================================== HEADER : END ============================================== -->
		<div class="breadcrumb">
			<div class="container">
				<div class="breadcrumb-inner">
					<?php
					$sql_bread = "select category.categoryName as catname,products.productName as pname from products join category on category.id=products.category where products.id='$pid'";
					$ret = mysqli_query($con, $sql_bread);
					while ($rw = mysqli_fetch_array($ret)) {

					?>


						<ul class="list-inline list-unstyled">
							<li><a href="shop.php">Home</a></li>
							<li><?php echo htmlentities($rw['catname']); ?></a></li>
							<li class='active'><?php echo htmlentities($rw['pname']); ?></li>
						</ul>
					<?php } ?>
				</div><!-- /.breadcrumb-inner -->
			</div><!-- /.container -->
		</div><!-- /.breadcrumb -->
		<div class="body-content outer-top-xs">
			<div class='container'>
				<div class='row single-product outer-bottom-sm '>
					<div class='col-md-3 sidebar'>
						<div class="sidebar-module-container">
							<!-- ==============================================CATEGORY============================================== -->
							<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
								<h3 class="section-title">Category</h3>
								<div class="sidebar-widget-body m-t-10">
									<div class="accordion">
										<?php //$sql=mysqli_query($con,"select id,categoryName  from category");
										//while($row=mysqli_fetch_array($sql))
										$category = getCategory('Y');
										foreach ($category as $row) {    ?>
											<div class="accordion-group">
												<div class="accordion-heading">
													<a href="shop-page.php?cat_id=<?php echo $row->id; ?>" class="accordion-toggle collapsed">
														<?php echo $row->categoryName; ?>
													</a>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<!-- ============================================== CATEGORY : END ============================================== --> <!-- ============================================== HOT DEALS ============================================== -->
							<div class="sidebar-widget hot-deals wow fadeInUp">
								<h3 class="section-title">hot deals</h3>
								<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">

									<?php
									$ret = mysqli_query($con, "select * from products where popularity = 1 order by rand() limit 4 ");
									while ($rws = mysqli_fetch_array($ret)) {
									?>
										<div class="item">
											<div class="products">
												<div class="hot-deal-wrapper">
													<div class="image">
														<img src="admin/productimages/<?php echo htmlentities($rws['id']); ?>/<?php echo htmlentities($rws['productImage1']); ?>" width="200" height="334" alt="">
													</div>

												</div><!-- /.hot-deal-wrapper -->

												<div class="product-info text-left m-t-20">
													<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($rws['id']); ?>"><?php echo htmlentities($rws['productName']); ?></a></h3>

													<?php
													$sql = "select count(*), avg(value) as avg from productreviews where productId=	'$pid'";
													//$rt=mysqli_query($con,"select * from productreviews where productId='$pid'");
													$rt = mysqli_query($con, $sql);
													$num = mysqli_num_rows($rt);
													$rs = mysqli_fetch_array($rt); {
														for ($i = 1; $i <= 5; $i++) {
															if ($i <= $rs[1]) {
																echo '<i class="fa fa-star" aria-hidden="true" style="color:#ffd12b"></i>';
															} else {
																echo '<i class="fa fa-star" aria-hidden="true"  style="color:lightgrey"></i>';
															}
														}
													}
													?>
													<div class="product-price">
														<span class="price">
															T$<?php echo htmlentities(displayPrice($rws['productPrice'])); ?>
														</span>
														<?php
														if ($rws['productPriceBeforeDiscount'] - $rws['productPrice'] > 0) { ?>
															<span class="price-before-discount">T$<?php echo htmlentities(displayPrice($rws['productPriceBeforeDiscount'])); ?></span>
														<?php } ?>
													</div><!-- /.product-price -->
												</div><!-- /.product-info -->
												<div class="cart clearfix animate-effect">
													<div class="action">
														<div class="add-cart-button btn-group">
															<?php if ($rws['productAvailability'] == 'In Stock') { ?>
																<a href="category.php?page=product&action=add&id=<?php echo $rws['id']; ?>">
																	<button class="btn btn-primary" type="button">Add to cart</button></a>
															<?php } else { ?>
																<div class="action" style="color:red">Out of Stock</div>
															<?php } ?>
														</div>
													</div><!-- /.action -->
												</div><!-- /.cart -->
											</div>
										</div>
									<?php } ?>
								</div><!-- /.sidebar-widget -->
							</div>
							<!-- ============================================== COLOR: END ============================================== -->
						</div>
					</div><!-- /.sidebar -->
					<?php
					$ret = mysqli_query($con, "select * from products where id='$pid'");
					while ($row = mysqli_fetch_array($ret)) {
					?>
						<div class='col-md-9'>
							<div class="row  wow fadeInUp">
								<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
									<div class="product-item-holder size-big single-product-gallery small-gallery">

										<div id="owl-single-product">

											<div class="single-product-gallery-item" id="slide1">
												<a data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']); ?>" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>">
													<img class="img-responsive" alt="" src="shop_assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="370" height="350" />
												</a>
											</div>
											<div class="single-product-gallery-item" id="slide1">
												<a data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']); ?>" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>">
													<img class="img-responsive" alt="" src="shop_assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="370" height="350" />
												</a>
											</div><!-- /.single-product-gallery-item -->

											<div class="single-product-gallery-item" id="slide2">
												<a data-lightbox="image-1" data-title="Gallery" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage2']); ?>">
													<img class="img-responsive" alt="" src="shop_assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage2']); ?>" />
												</a>
											</div><!-- /.single-product-gallery-item -->

											<div class="single-product-gallery-item" id="slide3">
												<a data-lightbox="image-1" data-title="Gallery" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage3']); ?>">
													<img class="img-responsive" alt="" src="shop_assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage3']); ?>" />
												</a>
											</div>

										</div><!-- /.single-product-slider -->


										<div class="single-product-gallery-thumbs gallery-thumbs">
											<div id="owl-single-product-thumbnails">
												<div class="item">
													<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
														<img class="img-responsive" alt="" src="shop_assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" />
													</a>
												</div>

												<div class="item">
													<a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide2">
														<img class="img-responsive" width="85" alt="" src="shop_assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage2']); ?>" />
													</a>
												</div>
												<div class="item">

													<a class="horizontal-thumb" data-target="#owl-single-product" data-slide="3" href="#slide3">
														<img class="img-responsive" width="85" alt="" src="shop_assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage3']); ?>" height="200" />
													</a>
												</div>
											</div><!-- /#owl-single-product-thumbnails -->
										</div>
									</div>
								</div>




								<div class='col-sm-6 col-md-7 product-info-block'>
									<div class="product-info">
										<h1 class="name"><?php echo htmlentities($row['productName']); ?></h1>
										<?php
										$sql = "select count(*), avg(value) as avg from productreviews where productId=	'$pid'";
										//$rt=mysqli_query($con,"select * from productreviews where productId='$pid'");
										$rt = mysqli_query($con, $sql);
										$num = mysqli_num_rows($rt);
										$rs = mysqli_fetch_array($rt); {
										?>
											<div class="rating-reviews m-t-20">
												<div class="row">
													<div class="col-sm-3">

														<?php for ($i = 1; $i <= 5; $i++) {

															if ($i <= $rs[1]) {
																echo '<i class="fa fa-star" aria-hidden="true" style="color:#ffd12b"></i>';
															} else {
											 					echo '<i class="fa fa-star" aria-hidden="true"  style="color:lightgrey"></i>';
															}
														} ?>


													</div>
													<div class="col-sm-8">
														<div class="reviews">
															<?php
															if ($rs[0] > 0) { ?>
																<a href="#" class="lnk">(<?php echo htmlentities($rs[0]); ?> Reviews)</a>
																<?php } else { ?>(No Reviews) <?php } ?>
														</div>
													</div>
												</div><!-- /.row -->
											</div><!-- /.rating-reviews -->
										<?php } ?>
										<div class="stock-container info-container m-t-10">
											<div class="row">
												<div class="col-sm-3">
													<div class="stock-box">
														<span class="label">Availability :</span>
													</div>
												</div>
												<div class="col-sm-9">
													<div class="stock-box">
														<span class="value"><?php echo htmlentities($row['productAvailability']); ?></span>
													</div>
												</div>
											</div><!-- /.row -->
										</div>

										<div class="stock-container info-container m-t-10">
											<div class="row">
												<div class="col-sm-3">
													<div class="stock-box">
														<span class="label">Product Brand :</span>
													</div>
												</div>
												<div class="col-sm-9">
													<div class="stock-box">
														<span class="value"><?php echo htmlentities($row['productCompany']); ?></span>
													</div>
												</div>
											</div><!-- /.row -->
										</div>


										<div class="stock-container info-container m-t-10">
											<div class="row">
												<div class="col-sm-3">
													<div class="stock-box">
														<span class="label">Shipping Charge :</span>
													</div>
												</div>
												<div class="col-sm-9">
													<div class="stock-box">
														<span class="value"><?php if ($row['shippingCharge'] == 0) {
																				echo "Free";
																			} else {
																				echo "T$" . htmlentities($row['shippingCharge']);
																			}

																			?></span>
													</div>
												</div>
											</div><!-- /.row -->
										</div>

										<div class="price-container info-container m-t-20">
											<div class="row">


												<div class="col-sm-6">
													<div class="price-box">
														<span class="price">T$<?php echo htmlentities($row['productPrice']); ?></span>
														<span class="price-strike">T$<?php echo htmlentities($row['productPriceBeforeDiscount']); ?></span>
													</div>
												</div>




												<div class="col-sm-6">
													<div class="favorite-button m-t-10 favuorite-res">
														<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="product-details.php?pid=<?php echo htmlentities($row['id']) ?>&&action=wishlist">
															<i class="fa fa-heart"></i>
														</a>

														</a>
													</div>
												</div>

											</div><!-- /.row -->
										</div><!-- /.price-container -->





										<form action="product-details.php?page=product" method="post">
											<div class="quantity-container info-container">
												<div class="row">

													<div class="col-sm-2">
														<span class="label">Qty :</span>
													</div>

													<div class="col-sm-2 qty-ressm">
														<div class="cart-quantity">
															<div class="quant-input">
																<div class="arrows">
																	<div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
																	<div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
																</div>
																<input type="text" value="1" name="qty">
																<input type="hidden" value="<?php echo $row['id']; ?>" name="id">
															</div>
														</div>
													</div>

													<div class="col-sm-7 col-sm-res">
														<?php if ($row['productAvailability'] == 'In Stock') { ?>
															<!--
										<a href="product-details.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a> -->
															<button type="submit" name="action" value="add" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART </button>
														<?php } else { ?>
															<div class="action" style="color:red">Out of Stock</div>
														<?php } ?>
													</div>


												</div><!-- /.row -->
											</div><!-- /.quantity-container -->
										</form>
										<div class="product-social-link m-t-20">
											<span class="social-label">Share :</span>
											<div class="social-icons">
												<ul class="list-inline">
													<li><a class="fa fa-facebook" href="http://facebook.com/transvelo"></a></li>
													<li><a class="fa fa-twitter" href="#"></a></li>
													<li><a class="fa fa-linkedin" href="#"></a></li>
													<li><a class="fa fa-rss" href="#"></a></li>
													<li><a class="fa fa-pinterest" href="#"></a></li>
												</ul><!-- /.social-icons -->
											</div>
										</div>




									</div><!-- /.product-info -->
								</div><!-- /.col-sm-7 -->
							</div><!-- /.row -->


							<div class="product-tabs inner-bottom-xs  wow fadeInUp">
								<div class="row">
									<div class="col-sm-3">
										<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
											<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
											<li><a data-toggle="tab" href="#review">REVIEW</a></li>
										</ul><!-- /.nav-tabs #product-tabs -->
									</div>
									<div class="col-sm-9">

										<div class="tab-content">

											<div id="description" class="tab-pane in active">
												<div class="product-tab">
													<p class="text"><?php echo $row['productDescription']; ?></p>
												</div>
											</div><!-- /.tab-pane -->

											<div id="review" class="tab-pane">
												<div class="product-tab">

													<div class="product-reviews">
														<h4 class="title">Customer Reviews</h4>
														<?php $qry = mysqli_query($con, "select * from productreviews where productId='$pid'");
														if (mysqli_num_rows($qry) > 0) {
															while ($rvw = mysqli_fetch_array($qry)) {
														?>

																<div class="reviews" style="border: solid 1px #000; padding-left: 2% ">
																	<div class="review">
																		<div class="review-title"><span class="summary"><?php echo htmlentities($rvw['summary']); ?></span><span class="date"><i class="fa fa-calendar"></i><span><?php echo htmlentities($rvw['reviewDate']); ?></span></span></div>

																		<div class="text">"<?php echo htmlentities($rvw['review']); ?>"</div>
																		<!-- <div class="text"><b>Quality :</b>  <?php echo htmlentities($rvw['quality']); ?> Star</div>
													<div class="text"><b>Price :</b>  <?php echo htmlentities($rvw['price']); ?> Star</div> -->
																		<div class="text"><b>Rating </b> <?php echo htmlentities($rvw['value']); ?>

																			<input class="rating" value="<?php echo htmlentities($rvw['value']); ?>">
																			Star
																		</div>
																		<div class="author m-t-15"><i class="fa fa-pencil-square-o"></i> <span class="name"><?php echo htmlentities($rvw['name']); ?></span></div>
																	</div>

																</div>
															<?php } ?><!-- /.reviews -->
														<?php } else { ?>
															<div class="reviews"> (No Reviews)
															</div>
														<?php } ?>
													</div><!-- /.product-reviews -->
													<?php
													if (strlen($_SESSION['login'])) {
														$sql = "SELECT *  FROM `orders` WHERE `userId` = '" . $_SESSION['id'] . "' and productId = '$pid'";
														$qry = mysqli_query($con, $sql);
														if (mysqli_num_rows($qry) > 0) { ?>
															<form role="form" class="cnt-form" name="review" method="post">
																<div class="product-add-review">
																	<h4 class="title">Write your own review</h4>
																	<div class="review-table">
																		<div class="table-responsive">
																			<label for="ratinginput" class="control-label">Rate the product:</label>
																			<input id="ratinginput" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2" style="font-size: 18px!important;}">
																			<script>
																				$("#ratinginput").rating();
																			</script>

																			<!-- /.table .table-bordered -->
																		</div><!-- /.table-responsive -->
																	</div><!-- /.review-table -->

																	<div class="review-form">
																		<div class="form-container">
																			<div class="row">
																				<div class="col-sm-12">
																					<div class="form-group">
																						<label for="exampleInputName">Your Name <span class="astk">*</span></label>
																						<input type="text" class="form-control txt" id="exampleInputName" placeholder="" name="name" required="required">
																					</div><!-- /.form-group -->
																					<div class="form-group">
																						<label for="exampleInputSummary">Summary <span class="astk">*</span></label>
																						<input type="text" class="form-control txt" id="exampleInputSummary" placeholder="" name="summary" required="required">
																					</div><!-- /.form-group -->

																					<div class="form-group">
																						<label for="exampleInputReview">Review <span class="astk">*</span></label>

																						<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="" name="review" required="required"></textarea>
																					</div><!-- /.form-group -->
																				</div>
																			</div><!-- /.row -->

																			<div class="action text-right">
																				<button name="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
																			</div><!-- /.action -->

															</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->
								<?php  }
													} ?>
									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->



							</div><!-- /.tab-content -->
						</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.product-tabs -->

		<?php $cid = $row['category'];
						$subcid = $row['subCategory'];
						$brand = $row['productCompany'];
						$pid = $row['id'];
					} ?>
		<!-- ============================================== UPSELL PRODUCTS ============================================== -->
		<section class="section featured-product wow fadeInUp">
			<h3 class="section-title">Related Products </h3>
			<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
				<?php
				//	$sql = "select * from products where subCategory='$subcid' and category='$cid'";
				$sql = "select * from products where productCompany='" . $brand . "' and category='$cid' and id != '" . $pid . "' limit 6";
				$qry = mysqli_query($con, $sql);
				$cnt = mysqli_num_rows($qry);
				if ($cnt == 0) {
					$sql = "select * from products where category='$cid' and id != '" . $pid . "' and (bestseller = 1 || new_arrival = 1 || popularity = 1) limit 6";
					$qry = mysqli_query($con, $sql);
				}

				while ($rw = mysqli_fetch_array($qry)) { ?>

					<div class="item item-carousel">
						<div class="products">
							<div class="product">
								<div class="product-image">
									<div class="image">
										<a href="product-details.php?pid=<?php echo htmlentities($rw['id']); ?>"><img src="shop_assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($rw['id']); ?>/<?php echo htmlentities($rw['productImage1']); ?>" width="150" height="240" alt=""></a>
									</div><!-- /.image -->


								</div><!-- /.product-image -->


								<div class="product-info text-left">
									<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($rw['id']); ?>"><?php echo htmlentities($rw['productName']); ?></a></h3>

									<?php $sql = "select count(*) as cnt, avg(value) as avg from productreviews where productId='" . $rw['id'] . "'";
									$rt = mysqli_query($con, $sql);
									$roww = $rt->fetch_row();
									$num = $roww[0]; {
									?> <div class="rating">
											<?php for ($i = 1; $i <= 5; $i++) {
												if ($i <= $roww[1]) {
													echo '<i class="fa fa-star" aria-hidden="true" style="color:#ffd12b"></i>';
												} else {
													echo '<i class="fa fa-star" aria-hidden="true"  style="color:lightgrey"></i>';
												}
											} ?>
										</div>
									<?php } ?>
									<div class="description"></div>

									<div class="product-price">
										<span class="price">
											T$<?php echo htmlentities($rw['productPrice']); ?> </span>
										<?php if ($rw['productPriceBeforeDiscount'] - $rw['productPrice'] > 0) { ?>
											<span class="price-before-discount">T$
												<?php echo htmlentities($rw['productPriceBeforeDiscount']); ?></span>
										<?php } ?>
									</div><!-- /.product-price -->

								</div><!-- /.product-info -->
								<div class="cart clearfix animate-effect">
									<div class="action">
										<ul class="list-unstyled">
											<li class="add-cart-button btn-group">
												<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
													<i class="fa fa-shopping-cart"></i>
												</button>
												<a href="product-details.php?page=product&action=add&id=<?php echo $rw['id']; ?>" class="lnk btn btn-primary">Add to cart</a>

											</li>


										</ul>
									</div><!-- /.action -->
								</div><!-- /.cart -->
							</div><!-- /.product -->

						</div><!-- /.products -->
					</div><!-- /.item -->
				<?php } ?>


			</div><!-- /.home-owl-carousel -->
		</section><!-- /.section -->


		<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

		</div><!-- /.col -->
		<div class="clearfix"></div>
	</div>
	</div>
	</div>
	<!--FOOTER START-->

	<?php include_once('includes/foot.php'); ?>

	<!--FOOTER END-->

	</div>

	<script src="shop_assets/js/jquery-1.11.1.min.js"></script>

	<script src="shop_assets/js/bootstrap.min.js"></script>

	<script src="shop_assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="shop_assets/js/owl.carousel.min.js"></script>

	<script src="shop_assets/js/echo.min.js"></script>
	<script src="shop_assets/js/jquery.easing-1.3.min.js"></script>
	<script src="shop_assets/js/bootstrap-slider.min.js"></script>
	<script src="shop_assets/js/jquery.rateit.min.js"></script>
	<script type="text/javascript" src="shop_assets/js/lightbox.min.js"></script>
	<script src="shop_assets/js/bootstrap-select.min.js"></script>
	<script src="shop_assets/js/wow.min.js"></script>
	<script src="shop_assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->

	<script src="switchstylesheet/switchstylesheet.js"></script>


	<!-- For demo purposes – can be removed on production : End -->
	<!--jQuery START-->

	<!--JQUERY MIN JS-->

	<script src="js/jquery-1.11.3.min.js"></script>

	<!--BOOTSTRAP JS-->

	<script src="js/bootstrap.min.js"></script>

	<!--Map Js-->

	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

	<!--OWL CAROUSEL JS-->

	<script src="js/owl.carousel.min.js"></script>

	<!--BANNER ZOOM OUT IN-->

	<script src="js/jquery.velocity.min.js"></script>

	<script src="js/jquery.kenburnsy.js"></script>

	<!--SCROLL FOR SIDEBAR NAVIGATION-->

	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

	<!--CUSTOM JS-->

	<script src="js/custom.js"></script>



	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API = Tawk_API || {},
			Tawk_LoadStart = new Date();
		(function() {
			var s1 = document.createElement("script"),
				s0 = document.getElementsByTagName("script")[0];
			s1.async = true;
			s1.src = 'https://embed.tawk.to/63fdb6bf4247f20fefe30dd0/1gqbh3q1f';
			s1.charset = 'UTF-8';
			s1.setAttribute('crossorigin', '*');
			s0.parentNode.insertBefore(s1, s0);
		})();
	</script>
	<!--End of Tawk.to Script-->



</body>

</html>