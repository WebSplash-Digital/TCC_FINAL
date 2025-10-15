<?php
session_start();
error_reporting(1);
include('includes/config.php');
include('function.inc.php');
?>
<!doctype html>

<html>

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>TCC - FAQ's</title>

  

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
 
</head>



<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper"> 

   <!--HEADER START-->
   <?php include_once('includes/head_new.php');
    $row = getTopBanner('faq');
    ?><!--HEADER END-->

  

  <!--INNER BANNER START-->

<section id="inner-banner" class="bgimgservices bgimgfaq" style="background-image: url('images/banners/<?=$row[0]->banner_img?>');">
  <div class="img-background-overlay"></div>
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="service-head">
        <div class="headerText">
          <h1 class="banner-title">FAQ's</h1>  
        </div>
      </div>
    </div>
    <div class="row text-center">
      <nav class="navbar ">
        <div class="nav nav-justified navbar-nav">
          <form class="navbar-form navbar-search" role="search">
            <div class="input-group">
              <input type="text" class="form-control search-txt" placeholder="Type your query here..">
              <div class="input-group-btn" >
                <button class="btn search-btn"  >
                <i class="fa fa-search fa-2x" aria-hidden="true" ></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>

  </div>
</section>

<div class="clearfix clear"></div>
  <!--INNER BANNER END--> 


  <!--MAIN START-->

  <div id="main"> 

    <section class="relatedheading">
      <div class="container ">
        <div class="row">
          <div class="col-md-12 col-sm-12 text-center">
            <p><i class="fa fa fa-question fa-5x contact-form-icon" style="width:110px;font-size: 75px;background-color: #C10000;color: #FFFFFF;" aria-hidden="true"></i>
            </p>
            <h2 class="related">Related Questions</h2>
          </div>
        </div> 
        <div class="row rqbtnmr">
          <div class="col-md-4">
            <a class="rqbtn" href="#Prepaid-Mobile"><i class="fa fa-mobile" aria-hidden="true"></i> Prepaid Mobile</a>
          </div>
          <div class="col-md-5">
            <a class="rqbtn" href="#Landline"><i class="fa fa-mobile" aria-hidden="true"></i> Prepaid Fixed Line / Landline</a>
          </div>
          <div class="col-md-3">
            <a class="rqbtn" href="#Datasim"><i class="fa fa-mobile" aria-hidden="true"></i> Datasim</a>
          </div>
        </div> 
      </div>
    </section>

    <!-- prepaid plan start-->

    <section class="faqdet" id="Prepaid-Mobile">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
           <h6 class="faqtitle"><i class="fa fa-mobile fa-2x contact-form-icon" style="background-color: #C10000;padding: 17px 30px;" aria-hidden="true"></i> FAQs</h6>
           <h2 class="related" >Prepaid Mobile</h2>
           </div>
        </div> 
      </div>

      <!------ prepaid mobile ---------->
      <div class="container">
        <div class="row">
          <div class="col-md-12" id="main">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php  $faq = getFAQ($var ='prepaid');
             if(isset($_GET['faqid'])) {
              $var = $_GET['faqid'];
            } else {
              $var = $faq[0]->id;
            }

              foreach($faq as $k => $row) {
              ?>
              <div class="panel panel-default">
                <div class="" role="tab" id="heading<?=$row->id?>">
                  <h4 class="panel-title">
                    <a role="button" class="faqtitlehead faqsheading" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$row->id?>" aria-expanded="" aria-controls="collapse<?=$row->id?>">
                    <?=$row->faq_title?> 
                      <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                    </a>

                  </h4>
                </div>
                <div id="collapse<?=$row->id?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?=$row->id?>">
                  <div class="panel-body faqans">
                    <p><?=$row->faq_description?></p>
                  </div>
                </div>
              </div>
              <?php } ?>
             </div>
          </div>
        </div>
      <div>
    </section>

    <!-- prepaid plans end -->

    <!-- prepaid plan and landline start-->

    <section class="faqdet" id="Landline">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
           <h6 class="faqtitle"><i class="fa fa-mobile fa-2x contact-form-icon" style="background-color: #C10000;padding: 17px 30px;" aria-hidden="true"></i> FAQs</h6>
           <h2 class="related" >Prepaid Fixed Line / Landline</h2>
           </div>
        </div> 
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-12" id="main">
            <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
            <?php  $faq = getFAQ($var ='landline');
            if(isset($_GET['faqid'])) {
              $var = $_GET['faqid'];
            } else {
              $var = $faq[0]->id;
            }
              foreach($faq as $k => $row) {
              ?>
              <div class="panel panel-default">
                <div class="" role="tab" id="heading<?=$row->id?>">
                  <h4 class="panel-title">
                    <a role="button" class="faqtitlehead faqsheading" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$row->id?>" aria-expanded="" aria-controls="collapse<?=$row->id?>">
                    <?=$row->faq_title?>
                      <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                    </a>

                  </h4>
                </div>
                <div id="collapse<?=$row->id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$row->id?>">
                  <div class="panel-body faqans">
                    <p><?=$row->faq_description?></p>
                  </div>
                </div>
              </div>
              <?php } ?>
              
            </div>
          </div>
        </div>
      <div>
    </section>

    <!-- prepaid plan and landline end -->


    <!-- Data sim start-->

    <section class="faqdet" id="Datasim">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
           <h6 class="faqtitle"><i class="fa fa-mobile fa-2x contact-form-icon" style="background-color: #C10000;padding: 17px 30px;" aria-hidden="true"></i> FAQs</h6>
           <h2 class="related">Datasim</h2>
           </div>
        </div> 
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-12" id="main">
            <div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
            <?php  $faq = getFAQ($var ='datasim');
            if(isset($_GET['faqid'])) {
              $var = $_GET['faqid'];
            } else {
              $var = $faq[0]->id;
            }
              foreach($faq as $k => $row) {
              ?>
              <div class="panel panel-default">
                <div class="" role="tab" id="heading<?=$row->id?>">
                  <h4 class="panel-title">
                    <a role="button" class=" faqtitlehead faqsheading" data-toggle="collapse" data-parent="#accordion3" href="#collapse<?=$row->id?>" aria-expanded="">
                    <?=$row->faq_title?>
                      <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                    </a>

                  </h4>
                </div>
                <div id="collapse<?=$row->id?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?=$row->id?>">
                  <div class="panel-body faqans">
                    <p><?=$row->faq_description?></p>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      <div>
    </section>

    <!-- datasim end -->

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
