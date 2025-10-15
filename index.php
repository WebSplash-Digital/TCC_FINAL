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
  <title>TCC - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

  <!-- swiper slider -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.css">

  <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

      <![endif]-->


  </head>
  <body class="theme-style-1">

    <!--WRAPPER START-->
    <div id="wrapper"> 

    <!--HEADER START-->
    <?php include_once('includes/head_new.php');?>
    <!--HEADER END-->

    <!--BANNER START-->
    <div class="banner-outer">
      
      <!-- desktop view banner -->

      <div id="carousel-example-generic" class="carousel sl ide desktopview" data-ride="caro usel">
        <!-- Indicators -->
        <ol class="carousel-indicators  carousel-indicators-numbers">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active">01</li>
          <li data-target="#carousel-example-generic" data-slide-to="1">02</li>
          <li data-target="#carousel-example-generic" data-slide-to="2">03</li>
          <li data-target="#carousel-example-generic" data-slide-to="3">04</li>
          <!-- <li data-target="#carousel-example-generic" data-slide-to="4">05</li> -->
        </ol>
<?php 
$banner = getBanner();
?>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <?php
          $i = 0;
          foreach($banner as $row) {
          ?>
          <div class="item <?php if( $i == 0) { ?> active <?php } ?>">
            <img src="images/banners/<?=$row->banner_image_url;?>" class="imgslide">
            <div class="carousel-caption">
              <h3 class="h3"><?php echo $row->banner_title;?></h3>
              <p><?php echo $row->banner_desc;?></p>
              <div class="cardbtn">
                  <!-- <a href="<?=$row->banner_href_url;?>" target="_self" rel="" class="btn btn-detail">Buy Now </a> -->
                  <a href="<?=$row->banner_href_url;?>" target="_self" rel="" >
                     <div class="bdt-ps-button">
                        <div class="bdt-ps-button-text">Buy Now</div>
                        <div class="bdt-ps-button-wrapper">
                        <div class="bdt-ps-button-arrow"></div>
                        <div class="bdt-ps-button-border-circle"></div>
                        <div class="bdt-ps-button-mask-circle">
                           <div class="bdt-ps-button-small-circle"></div>
                        </div>
                        </div>
                     </div>
                  </a>
                </div>
            </div>
          </div>
          <?php $i++; } ?>
        </div>
      </div>  

    </div>

      
    </div>
    <!--BANNER END-->

    <!--MAIN START-->
    <div id="main">
      <!--POPULAR JOB CATEGORIES START-->
      <section class="popular-categories animated fadeInUp">
        <div class="container-fluid">
          <div class="clearfix">
            <center><h2>Latest Trending Devices</h2>
              <p>Get the best deals on all the latest devices on your wish list.</p>
            </center>

            <!-- <a href="#" class="btn-style-1">Explore All Jobs</a>  -->
          </div>
          <div class="row">
          <?php $products =  getShopProducts( '' , 1 );
          foreach($products as $dk => $data) {
          ?>
            <div class="col-md-3 col-sm-6 productcard" >
              <div class="card"> 
                <div class="btnprice">
                  <span class="price">T$<?=displayPrice($data->productPrice)?> </span>
                </div>
                <img src="admin/productimages/<?php echo $data->id;?>/<?php echo $data->productImage1;?>" alt="img" width="200" height="200">
                <h3 class="cardhead"><?=$data->productName?></h3>
                <div class="cardbtn">
                  <a href="product-details.php?pid=<?=$data->id?>" target="_self" rel="" class="btn-buynow">Buy Now </a>
                  
                </div>
              </div>
            </div>
             <?php } ?> 
           </div>
        </div>
      </section>
      <!--POPULAR JOB CATEGORIES END-->

      <!--RECENT JOB SECTION START-->
      <section class="recent-row padd-tb services-list animated fadeInUp">
         <div class="container-fluid">
          <div class="clearfix">
            <center><h2>Our Services</h2>
             <div class="elementskit-border-divider"></div>
            </center>
          </div>
          <div class="row">

          <div class="col-md-2 col-sm-12 serviceBox text-center">
            <a href="plans-single.php?plan_id=3">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-phone.png" class="serviceImg" alt="">
            <h3>Mobile</h3>
            <p>Data, SMS & Voice Plans</p>
          </a>
          </div>
          <div class="col-md-2 col-sm-12 serviceBox text-center">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-landline.png" class="serviceImg" alt="">
            <h3>Landline</h3>
            <p>Data, SMS & Voice Plans</p>
          </div>
          <div class="col-md-2 col-sm-12 serviceBox text-center">
          <a href="plans-single.php?plan_id=20">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-broadband.png" class="serviceImg" alt="">
            <h3>Internet</h3>
            <p>Data, SMS & Voice Plans</p>
          </a>
          </div>
          <div class="col-md-2 col-sm-12 serviceBox text-center">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-phone.png" class="serviceImg" alt="">
            <h3>Fibre</h3>
            <p>Data, SMS & Voice Plans</p>
          </div>
          <div class="col-md-2 col-sm-12 serviceBox text-center">
            <a href="shop-page.php?cat_id=2">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/homepage-laptop.png" class="serviceImg" alt="">
            <h3>International</h3>
            <p>HP, Acer, Dell</p>
          </a>
          </div>   
        </div>
        </div>
      </section>
      <!--RECENT JOB SECTION END-->

      <!--CALL TO ACTION SECTION START-->
      <div class="tcc_cta_container">
         <div class="tcc_cta">
            <h3>Widest Cellular Network in Tonga</h3>
            <a href="">Out Best Offer</a>
            <img src="images/Sim-Card.png" alt="">
         </div>
      </div>
      <!-- <section class="call-action-section animated fadeInUp">
        <div class="elementor-background-overlay"></div>
        <div class="container-fluid">
          <div class="row">
          <div class="col-sm-6 col-md-5 t1 text-box">
            <h2>Widest Cellular Network in Tonga</h2>
          </div>
          <div class="col-sm-3 col-md-5 t1 ekit-btn-wraper">
              <a href="plans-single.php?plan_id=5" class="elementskit-btn  whitespace--normal">
                Our Best offer
                <i class="fa fa-angle-right" aria-hidden="true"></i>
              </a>
          </div>
          <div class="col-sm-3 col-md-2 t2 elementor-widget-container simcard">
            <img decoding="async" width="120" height="105" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/Sim-Card.png" />
          </div>
          </div> 
        </div>
      </section> -->
      <!--CALL TO ACTION SECTION END-->

       <!--RECENT blog START-->
      <section class="popular-categories">
         <div class="container-fluid">
          <div class="clearfix">
            <center><h2 class="adslh">Choose From <br/>The Best ADSL Plans</h2>
             <p>Tonga’s no. 1 network provides the best mobile plans for you</p>
            </center>
          </div>
          <div class="row mobilerow-ultra20" >

          <div class="col-md-3 col-sm-12 adslbox">
            <div class="elementor-widget-container">
              <img src="images/Voice.jpg" class="adslimg" alt="">
            </div>
            <div class="subdiv">
              <h3>Voice</h3>
              <p>Molestie risus, tempor duis tempus diam ornare mauris ac odio bibendum lectus blandit senectus.</p>

            </div>
            <div class="elementor-button-wrapper">
              <a href="plans-single.php?plan_id=1" class="elementor-button-link elementor-button elementor-size-sm" role="button">Read More
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <div class="col-md-3 col-sm-12 adslbox">
            <div class="elementor-widget-container">
              <img src="images/blog1.jpg" class="adslimg" alt="">
            </div>
            <div class="subdiv">
              <h3>Super Data UNET</h3>
              <p>Mattis adipiscing etiam ac feugiat sed consequat a donec ultrices euismod elit mauris risus diam.</p>

            </div>
            <div class="elementor-button-wrapper">
              <a href="plans-single.php?plan_id=7" class="elementor-button-link elementor-button elementor-size-sm" role="button">Read More
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <div class="col-md-3 col-sm-12 adslbox">
            <div class="elementor-widget-container">
              <img src="images/Student.jpg" class="adslimg" alt="">
            </div>
            <div class="subdiv">
              <h3>Student Plans</h3>
              <p>Quisque eleifend at sed in arcu sit eu, facilisi orci sapien, sed placerat cursus blandit amet neque,</p>

            </div>
            <div class="elementor-button-wrapper">
              <a href="plans-single.php?plan_id=18" class="elementor-button-link elementor-button elementor-size-sm" role="button">Read More
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
         
        </div>
        </div>
      </section>
      <!--RECENT Blog END-->

      <!--preapaid plans SECTION START-->
      <section  class="sec6">
         <div class="container-fluid mb5 preapaidplans" >
         <div class="row" >
            <div class="col-md-12 text-center sec6-head" >
               <h2 class="h2-plan" >Most Popular Prepaid Plans</h2>
            </div>
         </div>
         <?php 
        $plans = getFeaturedPlans();
        $lowPrice = getLowPrice($plans);
        $features_list = getFeatureList();
         ?>
         <div class="row" >
            <div class="col-md-3 plan-card">
               <div class=" ">
                  <div class="card-body text-center">
                     <h3 class="h3-plan"><?=$plans[0]->plan_title?></h3>
                      <span class="elementskit-pricing-price" >
                     <sup class="currency">$</sup>
                     <span class="cur-price"><?=str_replace("$","",$lowPrice[$plans[0]->id])?></span>
                     <sub class="period">/Month</sub>
                     </span> 
                     <p class="currency-p">
                     <?php  $features = explode(",",$plans[0]->features); 
                     foreach($features as $feature) {
                      if (array_key_exists($feature,$features_list)){
                          echo $features_list[$feature]."<br>";
                      }
                     } ?>
                     </p>
                     <span class="m-4 ">
                     <a href="plans-single.php?plan_id=<?=$plans[0]->id?>" class="btn btn-plan">CHOOSE PLAN </a>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-3 plan-card">
               <div class=" ">
                  <div class="card-body text-center">
                     <h3 class="h3-plan"><?=$plans[1]->plan_title?></h3>
                     <span class="elementskit-pricing-price" >
                     <sup class="currency">$</sup>
                     <span class="cur-price"><?=str_replace("$","",$lowPrice[$plans[1]->id])?></span>
                     <sub class="period">/Month</sub>
                     </span> 
                     <p class="currency-p">  <?php  $features = explode(",",$plans[1]->features); 
                     foreach($features as $feature) {
                      if (array_key_exists($feature,$features_list)){
                          echo $features_list[$feature]."<br>";
                      }
                     } ?>
                     </p>
                     <span class="m-4 ">
                     <a href="plans-single.php?plan_id=<?=$plans[1]->id?>" class="btn btn-plan">CHOOSE PLAN </a>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-3 plan-card1"  >
               <div class=" " >
                  <div class="card-body text-center" >
                     <h3 class="h3-plan1"><?=$plans[2]->plan_title?></h3>
                     <span class="elementskit-pricing-price" >
                     <sup class="currency">$</sup>
                     <span class="cur-price"><?=str_replace("$","",$lowPrice[$plans[2]->id])?></span>
                     <sub class="period">/Month</sub>
                     </span>
                     <p class="currency-p">
                      <?php  $features = explode(",",$plans[2]->features); 
                     foreach($features as $feature) {
                      if (array_key_exists($feature,$features_list)){
                          echo $features_list[$feature]."<br>";
                      }
                     } ?>
                     </p>
                     <span class="m-4 ">
                     <a href="plans-single.php?plan_id=<?=$plans[2]->id?>" class="btn btn-plan">CHOOSE PLAN </a>                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-3 plan-card bordered">
               <div class=" " >
                  <div class="card-body text-center">
                     <h3 class="h3-plan"><?=$plans[3]->plan_title?> </h3>
                     <span class="elementskit-pricing-price" >
                     <sup class="currency">$</sup>
                     <span class="cur-price"><?=str_replace("$","",$lowPrice[$plans[3]->id])?></span>
                     <sub class="period">/Month</sub>
                     </span> 
                     <p class="currency-p">
                      <?php  $features = explode(",",$plans[3]->features); 
                     foreach($features as $feature) {
                      if (array_key_exists($feature,$features_list)){
                          echo $features_list[$feature]."<br>";
                      }
                     } ?>
                     </p>
                     <span class="m-4 ">
                     <a href="plans-single.php?plan_id=<?=$plans[3]->id?>" class="btn btn-plan">CHOOSE PLAN </a>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- preapaid plans end -->

      <!-- why choose tcc start -->
      <section  class="whychoose" >
         <div class="container-fluid whychoose_wrapper ">
         <div class="row whychooserow">
            <div class="col-md-8 whychoose-margin">
               <div class="row">
                  <h2 class="sec-why-head">Why Choose TCC </h2>
                  <div class="whychoosediv"></div>

               </div>
               <div class="row" >
                  <div class="col-md-1 box-body boxwhychose">
                     <i class="fa fa-flag-o fa-4x fawesome"  aria-hidden="true"></i>
                  </div>
                  <div class="col-md-5 box-body boxwhychose">
                     <h3 class="sec-why-head2" >Superior Network COVERAGE</h3>
                     <p class="sec-why-desc2">Write short info about the header</p>
                  </div>
                  <div class="col-md-1 box-body boxwhychose">
                     <i class="fa fa-phone fa-4x fawesome" aria-hidden="true"></i>                        
                  </div>
                  <div class="col-md-5 box-body boxwhychose">
                     <h3 class="sec-why-head2">24/7 FREE Customer Care</h3>
                     <p class="sec-why-desc2">Write short info about the header</p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-1 box-body boxwhychose">
                     <i class="fa fa-phone fa-4x fawesome"  aria-hidden="true"></i>
                  </div>
                  <div class="col-md-5 box-body boxwhychose">
                     <h3 class="sec-why-head2">Superior LANDLINE Service</h3>
                     <p class="sec-why-desc2">Write short info about the header</p>
                  </div>
                  <div class="col-md-1 box-body boxwhychose">
                     <i class="fa fa-life-ring  fa-4x fawesome"  aria-hidden="true"></i>
                  </div>
                  <div class="col-md-5 box-body boxwhychose">
                     <h3 class="sec-why-head2">It&#039;s THE COMMUNITY Support</h3>
                     <p class="sec-why-desc2">Write short info about the header</p>
                  </div>
               </div>
            </div>
            <div class="col-md-4 colwhychoose">
               <img class="whychooseimg" src="images/whychoose.jpg">
            </div>
         </div>
      </section>
      <!-- why choose tcc end -->

      <!--POPULAR promotion START-->
      <section class="popular-categories promotion">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-4 promo">
              <div class="clearfix">
                <h2>Latest Promotions</h2>
                <div class="elementskit-border-divider1"></div>
                <p>Dark & Bold background image on mouse hover with green heading icon and rounded button style</p>
              </div>
            </div>
            <div class="col-sm-8 promo">
              <div class="container swiper-container">
                <div class="swiper-wrapper">
                  <?php 
                  $promotion = getPromotion();
                  foreach($promotion as $promo) {
                  ?>
                  <div class="swiper-slide">
                    <a href="promotions-details.php?id=<?=$row->id?>">
                        <img src="images/promotions/<?=$promo->url?>" alt="<?=$promo->title?>">
                     </a>
                     <p class="swiper_caption"><?=$promo->title?></p>
                  </div>
                  <?php } ?>
                </div>
                
                <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--POPULAR promotion END-->

      <!-- connect to anywhere start -->
      <section class="sec5" >
         <div class="container m-5 sec5-bg" >
         <h2 class="section-title text-center sec5-head" >Connect from ANYWHERE <br>in the Kingdom</h2>
         <center><div class="elementskit-border-divider2 "></div></center>
         <p class="text-center sec5-desc" >With TCC's 4G LTE coverage, you can simply access the internet with these portable devices from anywhere in the Kingdom.</p>
         <div>
         <div class="text-center">
            <img class="imgconnectany" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/PocketWifiBlack.jpg">
         </div>
      </section>
      <!-- connect to anywhere end -->

      <!-- upto data start -->
      <section >
         <div class="container-fluid m-5 preapaidplans datasimdet" >
            <div class="row ">
               <div class="col-md-3 p-2 rounded" class="blk">
                  <div class=" btnstill btnstill-round-lg rounded" >
                     <i class="fa fa-light fa-globe fa-4x"></i> 
                     <div class="btn-explore" >4G data upto 150Mbps</div>
                  </div>
               </div>
               <div class="col-md-3 p-2 rounded">
                  <div  class=" btnstill btnstill-round-lg rounded" >
                     <i class="fa fa-tablet fa-4x" aria-hidden="true"></i></i> 
                     <div class="btn-explore" >connect upto 10 devices  </div>
                  </div>
               </div>
               <div class="col-md-3 p-2 rounded">
                  <div class=" btnstill btnstill-round-lg rounded" >
                     <i class="fa fa-battery-half fa-4x" aria-hidden="true"></i> 
                     <div class="btn-explore" >6 hours of battery life  </div>
                  </div>
               </div>
               <div class="col-md-3 p-2 rounded">
                  <div class=" btnstill btnstill-round-lg rounded" >
                     <i class="fa fa-globe fa-4x" aria-hidden="true"></i> 
                     <div class="btn-explore" >1 year warranty</div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row m-5 exp-btn explore_moblie_box">
            <div class="col-md-12 p-10 text-center ">
               <span class="m-4 ">
               <a href="plans-single.php?plan_id=22" type="button" class="btn btn2 btn2-danger btn2-round-lg btn2-lg explore-style-mobile" > EXPLORE NOW</a>
               </span>
            </div>
         </div>
      </section>
      <!-- upto data end -->

      <!-- one app for everything start -->
      <section class="">
         <div class="container-fluid everything" >
            <div class="row app-md-6">
               <div class="col-md-6 rounded">
                  <div class="crd sec7-box-bg" >
                     <div class="card-body text-bg-light">
                        <div class="row vertical-align">
                           <div class="col-md-9">
                              <h2 class="h2sec">One app for <span class="sec7-spn">everything</span></h2>
                              <p class="sec7-p">
                                 Scan the QR code, download TCC APP, and enjoy all the TCC services in just one super app.
                              </p>
                              <button class="callus" ><i class="fa fa-phone fa-phone-mob" aria-hidden="true"> CALL US</i></button>
                           </div>
                           <div><img class="img-qrcode" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/TCC.png"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 p-4 " >
                  <div class="crd sec7-box-bg">
                     <div class="card-body">
                        <div class="row vertical-align">
                           <div class="col-md-9">
                              <h2 class="h2sec">Widest Cellular Network in <span class="sec7-spn">Tonga</span></h2>
                              <p class="sec7-p">
                                 Scan the QR code, download TCC APP, and enjoy all the TCC services in just one super app.
                              </p>
                              <button class="callus" ><i class="fa fa-phone fa-phone-mob" aria-hidden="true"> CALL US</i></button>
                           </div>
                           <div class="col-xs-6 col-md-3">
                              <img src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/Sim-Card.png" height="140">
                           </div>
                        </div>
                     </div>
                  </div>
               </div> 
            </div>
         </div>
      </section>
      <!-- one app for everything start -->

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

    <!--OWL CAROUSEL JS--> 

    <script src="js/owl.carousel.min.js"></script> 

    <!--BANNER ZOOM OUT IN--> 

    <script src="js/jquery.velocity.min.js"></script> 
    <script src="js/jquery.kenburnsy.js"></script> 

    <!--SCROLL FOR SIDEBAR NAVIGATION--> 

    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 

    <!--CUSTOM JS--> 

    <script src="js/custom.js"></script>

    <!-- navbar -->
    <script type="text/javascript">
        $('.dropdown-toggle').click(function(e) {
          if ($(document).width() > 768) {
            e.preventDefault();

            var url = $(this).attr('href');

               
            if (url !== '#') {
            
              window.location.href = url;
            }

          }
        });
      </script>

      <!-- swiper slider -->

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.js"></script>
      <script>
      var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        centeredSlides: true,
        autoplay: 
        {
          delay: 2000,
        },
        loop: true,
        spaceBetween: 0,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 50,
    },
  },
      });
      </script>

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

 
    <!-- support chat -->
    <!-- Support Board -->
   <!-- <script id="chat-init" src="https://cloud.board.support/account/js/init.js?id=311900347"></script>-->
    </body>

</html>