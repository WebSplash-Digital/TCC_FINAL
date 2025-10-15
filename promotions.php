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

  <title>TCC - Promotions</title>

  

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
     $row = getTopBanner('promotions');
    ?>
    <!--HEADER END-->

  

  <!--INNER BANNER START-->

<section id="inner-banner" class="bgimgservices bgimgpramotions" style="background-image: url('images/banners/<?=$row[0]->banner_img?>');">
  <div class="img-background-overlay"></div>
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="service-head">
      <div class="headerText">
        <h1 class="banner-title">Promotions</h1>    
      </div>
      </div>
    </div>
  </div>
  </div>
</section>

<div class="clearfix clear"></div>
  <!--INNER BANNER END--> 

<?php
$id = $_GET['id'];
$promotion = getPromotion();

?>
  <!--MAIN START-->

  <div id="main"> 

    <section class="promos-list">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 text-center">
            <p><i class="fa fa-bullhorn" aria-hidden="true"></i></p>
            <h6>Our Current</h6>
            <h2>Promotions</h2>
            <p class="promotext">Browse through the vast selection of the best promotions for each month here. Tab on one of the promotions below to view its full details.</p>
          </div>
        </div>  
      </div>

      <div class="container promocon">
        <div class="row">
          <?php 
          foreach($promotion as $k => $row ) { ?>
        <div class="col-sm-12 col-md-4 col-xl-4 promosimgbox">
          <a href="promotions-details.php?id=<?=$row->id?>">
            <img width="100%" src="images/promotions/<?=$row->url?>" title="<?=$row->title?>" alt="<?=$row->title?>">
            <h3><?=$row->title?></h3>
          </a>
          </div>
          <?php } ?>
          <!-- 
          <div class="col-md-4 col-sm-12 promosimgbox">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/elementor/thumbs/MMT1-q2e3lkqleq2805tul0hagjrkqct8mapm9vajtzz4es.png" title="MMT1" alt="MMT1">
            <h3>MMT1</h3>
            <p>Special Promo</p>
          </div>
          <div class="col-md-4 col-sm-12 promosimgbox">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/elementor/thumbs/Creative-2-q3kkwc42tdvm8hpug8ieb66yhwwlx5al9mslujqeqc.png" title="MMT1" alt="MMT1">
            <h3>Weekly Cash Draw</h3>
            <p>Special Promo</p>
          </div>
          <div class="col-md-4 col-sm-12 promosimgbox">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/elementor/thumbs/Screenshot-2020-11-06-at-11.56.39-AM-q3kl1l1mz329243et06eqcilwd1dwb4mzlx7b5y9zo.png" title="MMT1" alt="MMT1">
            <h3>Students SIM Plans</h3>
            <p>Special Promo</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-12 promosimgbox">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/elementor/thumbs/MMT3-q2e3mbzwwx3jcuq95u9gyuvxyj2vtipu1m7mr0upec.png" title="MMT1" alt="MMT1">
            <h3>MMT3</h3>
            <p>Special Promo</p>
          </div>
          <div class="col-md-4 col-sm-12 promosimgbox">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/elementor/thumbs/super-data-q3ksmvmc1z6iol4bymyf6vsbog0aw733kachieqivo.jpg" title="MMT1" alt="MMT1">
            <h3>Super Data UNet Vibe</h3>
            <p>Special Promo</p>
          </div>
          <div class="col-md-4 col-sm-12 promosimgbox">
            <img width="100%" src="http://gauravb60.sg-host.com/wp-content/uploads/elementor/thumbs/MMT2-q2e3lyu698liub9daokozy7hn4vqtr9lbt2u15e7tg.png" title="MMT1" alt="MMT1">
            <h3>MMT2</h3>
            <p>Special Promo</p>
          </div> -->
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
