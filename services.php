<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('function.inc.php');
?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>TCC - Services</title>




<!--BOOTSTRAP CSS-->

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

<!--CUSTOM CSS-->

<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" >

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

</head>



<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper"> 

   <!--HEADER START-->
    <?php include_once('includes/head_new.php');
    $row = getTopBanner('services');
    ?>
    <!--HEADER END--> 

  

  <!--INNER BANNER START-->

<section id="inner-banner" class="bgimgservices" style="background-image: url('images/banners/<?=$row[0]->banner_img?>');">
  <div class="img-background-overlay"></div>
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="service-head">
      <div class="headerText">
        <h1 class="banner-title">Services</h1>    
      </div>
      </div>
    </div>
  </div>
  </div>
</section>

<div class="clearfix clear"></div>
  <!--INNER BANNER END--> 


  <!--MAIN START-->

  <div id="main"> 

    <section class="services-list">
      <div class="container-fluid">
        <div class="row servicelistbox-mobile">

          <div class="col-md-6 col-sm-12 serviceBox text-center">
            <a href="plans-single.php?plan_id=3">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-phone.png" class="serviceImg" alt="">
            <h3>Mobile</h3>
            <p>Data, SMS & Voice Plans</p>
            </a>
          </div>
          <div class="col-md-6 col-sm-12 serviceBox text-center">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-landline.png" class="serviceImg" alt="">
            <h3>Landline</h3>
            <p>Data, SMS & Voice Plans</p>
          </div>
          <div class="col-md-6 col-sm-12 serviceBox text-center">
          <a href="plans-single.php?plan_id=20">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-broadband.png" class="serviceImg" alt="">
            <h3>Internet</h3>
            <p>Data, SMS & Voice Plans</p>
            </a>
          </div>
          <div class="col-md-6 col-sm-12 serviceBox text-center">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-phone.png" class="serviceImg" alt="">
            <h3>Fibre</h3>
            <p>Data, SMS & Voice Plans</p>
          </div>
          <div class="col-md-6 col-sm-12 serviceBox text-center">
          <a href="shop-page.php?cat_id=2">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-laptop.png" class="serviceImg" alt="">
            <h3>International</h3>
            <p>HP, Acer, Dell</p>
		</a>
          </div>

          
        </div>
      </div>
    </section>
    
    <section class="bglight serviceP">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="headings">
              <h6>TCC Plans</h6>
              <h2>Mobile</h2>

            </div>
            <div class="heading-underline"></div>
            <p>Et arcu eu ultricies pharetra, malesuada congue egestas venenatis pellentesque vitae massa aliquet quis velit elementum.</p>

            <p>Arcu erat turpis sed ullamcorper viverra amet, vel laoreet massa eu consequat ultricies accumsan, a magna morbi egestas augue proin sagittis.</p>

            <a href="plans-single.php?plan_id=3" class="learnmore-btn">
              <span>Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </a>

          </div>
          <div class="col-md-6">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/03/mobile.jpg" data-src="http://gauravb60.sg-host.com/wp-content/uploads/2023/03/mobile.jpg" class="" alt="" >
          </div>
        </div>
      </div>
    </section>

    <section class="serviceP">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="headings">
              <h6>TCC Plans</h6>
              <h2>Landlines</h2>

            </div>
            <div class="heading-underline"></div>
            <p>Et arcu eu ultricies pharetra, malesuada congue egestas venenatis pellentesque vitae massa aliquet quis velit elementum.</p>

            <p>Arcu erat turpis sed ullamcorper viverra amet, vel laoreet massa eu consequat ultricies accumsan, a magna morbi egestas augue proin sagittis.</p>

            <a href="#" class="learnmore-btn">
              <span>Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </a>

          </div>
          <div class="col-md-6">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/03/landline.jpg" class="" alt="" >
          </div>
        </div>
      </div>
    </section>

    <section class="bglight serviceP">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="headings">
              <h6>TCC Plans</h6>
              <h2>Internet</h2>

            </div>
            <div class="heading-underline"></div>
            <p>Et arcu eu ultricies pharetra, malesuada congue egestas venenatis pellentesque vitae massa aliquet quis velit elementum.</p>

            <p>Arcu erat turpis sed ullamcorper viverra amet, vel laoreet massa eu consequat ultricies accumsan, a magna morbi egestas augue proin sagittis.</p>

            <a href="plans-single.php?plan_id=20" class="learnmore-btn">
              <span>Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </a>

          </div>
          <div class="col-md-6">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/03/internet-2.jpg" class="" alt="" >
          </div>
        </div>
      </div>
    </section>

    <section class="serviceP">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="headings">
              <h6>TCC Plans</h6>
              <h2>Fibre</h2>

            </div>
            <div class="heading-underline"></div>
            <p>Et arcu eu ultricies pharetra, malesuada congue egestas venenatis pellentesque vitae massa aliquet quis velit elementum.</p>

            <p>Arcu erat turpis sed ullamcorper viverra amet, vel laoreet massa eu consequat ultricies accumsan, a magna morbi egestas augue proin sagittis.</p>

            <a href="#" class="learnmore-btn">
              <span>Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </a>

          </div>
          <div class="col-md-6">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/03/fibre.jpg" class="" alt="" >
          </div>
        </div>
      </div>
    </section>

    <section class="bglight serviceP">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="headings">
              <h6>TCC Plans</h6>
              <h2>International</h2>

            </div>
            <div class="heading-underline"></div>
            <p>Et arcu eu ultricies pharetra, malesuada congue egestas venenatis pellentesque vitae massa aliquet quis velit elementum.</p>

            <p>Arcu erat turpis sed ullamcorper viverra amet, vel laoreet massa eu consequat ultricies accumsan, a magna morbi egestas augue proin sagittis.</p>

            <a href="#" class="learnmore-btn">
              <span>Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </a>

          </div>
          <div class="col-md-6">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/03/international.jpg" class="" alt="" >
          </div>
        </div>
      </div>
    </section>

  </div>

  <!--MAIN END--> 


  <!--FOOTER START-->

 <?php include_once('includes/foot.php');?>

  <!--FOOTER END--> 

</div>

<!--WRAPPER END--> 



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

</body>

</html>
