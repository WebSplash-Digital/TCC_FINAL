<?php
session_start();
error_reporting(0);
include('shop_includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>Track Orders</title>
	    <link rel="stylesheet" href="shop_assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="shop_assets/css/main.css">
	    <link rel="stylesheet" href="shop_assets/css/green.css">
	    <link rel="stylesheet" href="shop_assets/css/owl.carousel.css">
		<link rel="stylesheet" href="shop_assets/css/owl.transitions.css">
		<link href="shop_assets/css/lightbox.css" rel="stylesheet">
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
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="shop_assets/images/favicon.ico">
	</head>
    <body class="cnt-home">
	
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<?php include('shop_includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?php include('shop_includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('shop_includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

</header>
<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Track your orders</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="track-order-page inner-bottom-sm">
			<div class="row">
				<div class="col-md-12">
	<h2>Track your Order</h2>
	<span class="title-tag inner-top-vs">Please enter your Order ID in the box below and press Enter. This was given to you on your receipt and in the confirmation email you should have received. </span>
	<form class="register-form outer-top-xs" role="form" method="post" action="order-details.php">
		<div class="form-group">
		    <label class="info-title" for="exampleOrderId1">Order ID</label>
		    <input type="text" class="form-control unicase-form-control text-input" name="orderid" id="exampleOrderId1" >
		</div>
	  	<div class="form-group">
		    <label class="info-title" for="exampleBillingEmail1">Registered Email</label>
		    <input type="email" class="form-control unicase-form-control text-input" name="email" id="exampleBillingEmail1" >
		</div>
	  	<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Track</button>
	</form>	
</div>			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div> 

<?php echo include('shop_includes/brands-slider.php'); ?>
</div>
</div>
<?php include('shop_includes/footer.php');?>
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
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->

	

</body>
</html>