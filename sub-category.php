<?php
session_start();
error_reporting(0);
include('shop_includes/config.php');
$cid=intval($_GET['scid']);
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
								echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
		}else{
			$message="Product ID is invalid";
		}
	}
}
// COde for Wishlist
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','".$_GET['pid']."')");
echo "<script>alert('Product aaded in wishlist');</script>";
header('location:my-wishlist.php');

}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>TCC - Shop</title>
	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="shop_assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="shop_assets/css/main.css">
	    <link rel="stylesheet" href="shop_assets/css/green.css">
	    <link rel="stylesheet" href="shop_assets/css/owl.carousel.css">
		<link rel="stylesheet" href="shop_assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="shop_assets/css/owl.theme.css">-->
		<link href="shop_assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="shop_assets/css/animate.min.css">
		<link rel="stylesheet" href="shop_assets/css/rateit.css">
		<link rel="stylesheet" href="shop_assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="shop_assets/css/config.css">

		<link href="shop_assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="shop_assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="shop_assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="shop_assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="shop_assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="shop_assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="shop_assets/images/favicon.ico">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="shop_assets/js/html5shiv.js"></script>
			<script src="shop_assets/js/respond.min.js"></script>
		<![endif]-->
<!--BOOTSTRAP CSS-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <!--CUSTOM CSS-->
  <link href="css/custom.css" rel="stylesheet" type="text/css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
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
	</head>
    <body class="theme-style-1">
	
	<div id="wrapper"> 

<!--HEADER START-->
 <?php include_once('includes/head_new.php');
// $row = getTopBanner('shop-page');
 ?>
 <!--HEADER END-->



<!--INNER BANNER START-->
<!--
<section id="inner-banner" class="bgimgservices bgimgshop" style="background-image: url('images/banners/<?php //echo $row[0]->banner_img?>');
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

<div class="clearfix clear"></div>-->
<!-- ============================================== HEADER : END ============================================== -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row outer-bottom-sm'>
			<div class='col-md-3 sidebar'  style="width:20%!important;">
	            <!-- ================================== TOP NAVIGATION ================================== -->
<!-- ================================== TOP NAVIGATION : END ================================== -->	            <div class="sidebar-module-container">
	            	<h3 class="section-title">shop by</h3>
	            	<div class="sidebar-filter">
		            	<!-- ============================================== SIDEBAR CATEGORY ============================================== -->
<div class="sidebar-widget wow fadeInUp outer-bottom-xs ">
	<div class="widget-header m-t-20">
		<h4 class="widget-title">Category</h4>
	</div>
	<div class="sidebar-widget-body m-t-10">
	         <?php $sql=mysqli_query($con,"select id,categoryName  from category");
while($row=mysqli_fetch_array($sql))
{
    ?>
		<div class="accordion">
	    	<div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="category.php?cid=<?php echo $row['id'];?>"  class="accordion-toggle collapsed">
	                   <?php echo $row['categoryName'];?>
	                </a>
	            </div>  
	        </div>
	    </div>
	    <?php } ?>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->



    
<!-- ============================================== COLOR: END ============================================== -->

	            	</div><!-- /.sidebar-filter -->
	            </div><!-- /.sidebar-module-container -->
            </div><!-- /.sidebar -->
			<div class='col-md-9'>
					<!-- ========================================== SECTION – HERO ========================================= -->

	<div id="category" class="category-carousel hidden-xs">
		<div class="item">	
			<div class="image">
				<img src="shop_assets/images/banners/cat-banner-2.jpg" alt="" class="img-responsive">
			</div>
			<div class="container-fluid">
				<div class="caption vertical-top text-left">
					<div class="big-text">
						<br />
					</div>

					       <?php $sql=mysqli_query($con,"select subcategory  from subcategory where id='$cid'");
while($row=mysqli_fetch_array($sql))
{
    ?>

					<div class="excerpt hidden-sm hidden-md">
						<?php echo htmlentities($row['subcategory']);?>
					</div>
			<?php } ?>
			
				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div>
</div>

				<div class="search-result-container">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product  inner-top-vs">
								<div class="row">									
			<?php
$ret=mysqli_query($con,"select * from products where subCategory='$cid'");
$num=mysqli_num_rows($ret);
if($num>0)
{
while ($row=mysqli_fetch_array($ret)) 
{?>							
		<div class="col-sm-6 col-md-4 wow fadeInUp">
			<div class="products">				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="shop_assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="" width="200" height="300"></a>
			</div><!-- /.image -->			                      		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					Rs. <?php echo htmlentities($row['productPrice']);?>			</span>
										     <span class="price-before-discount">Rs. <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
						<?php if($row['productAvailability']=='In Stock'){?>
										<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<a href="category.php?page=product&action=add&id=<?php echo $row['id']; ?>">
							<button class="btn btn-primary" type="button">Add to cart</button></a>
								<?php } else {?>
							<div class="action" style="color:red">Out of Stock</div>
					<?php } ?>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div>
			</div>
		</div>
	  <?php } } else {?>
	
		<div class="col-sm-6 col-md-4 wow fadeInUp"> <h3>No Product Found</h3>
		</div>
		
<?php } ?>	
		
	
		
		
	
		
	
		
	
		
										</div><!-- /.row -->
							</div><!-- /.category-product -->
						
						</div><!-- /.tab-pane -->
						
				

				</div><!-- /.search-result-container -->

			</div><!-- /.col -->
		</div></div>
		
</div>
</div>
<?php include_once('includes/foot.php');?>
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
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/63fdb6bf4247f20fefe30dd0/1gqbh3q1f';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

	

</body>
</html>