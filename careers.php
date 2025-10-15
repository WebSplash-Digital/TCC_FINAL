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

  <title>TCC - Career</title>

  

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
     $row = getTopBanner('careers');
    ?>
    <!--HEADER END-->

  

  <!--INNER BANNER START-->

<section id="inner-banner" class="bgimgservices bgimgcareers" style="background-image: url('images/banners/<?=$row[0]->banner_img?>');">
  <div class="img-background-overlay"></div>
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="service-head">
      <div class="headerText">
        <h1 class="banner-title">Careers Opportunities at TCC</h1>    
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

    <section class="">
      <div class="container-fluid aboutbanner">
        <div class="row">
          <div class="col-md-12 col-sm-6 colaboutinfo">
            <p class="careerhead">Careers Opportunities at TCC</p>
            <h2 class="network">We are a Cellular Network Company in Tonga</h2>
            <p class="careerdet">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo tertastd.<br/><br/>
            Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
            Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.   Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <button type="button" class="btn btn-career btn2-round-lg btn2-lg" >KNOW MORE</button>
          </div>
          <div class="col-md-12 col-sm-6 colaboutinfo">
            <p class="careerPara"><i class="fa fa-bullhorn career-icon" aria-hidden="true"></i> <span class="careername"> Chief Marketing Officer</span></p>
            <p class="careerdet">To advance business development opportunities; strategic planning, plan and execute marketing..</p>
            <p class="careerhead">Closing Date: 17 March 2023</p>
            <button type="button" class="btn btn-careadmore btn2-round-lg btn2-lg" >Read More</button>
            <hr/>
            <p><i class="fa fa-bullhorn career-icon" aria-hidden="true"></i> <span class="careername"> Customer Service</span></p>
            <p class="careerdet">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem porttitor at.</p>
            <p class="careerhead">Closing Date: 17 March 2023</p>
            <button type="button" class="btn btn-careadmore btn2-round-lg btn2-lg" >Read More</button>
            <hr/>
            <p><i class="fa fa-list career-icon" aria-hidden="true"></i> <span class="careername"> Jobs</span></p>
            <button type="button" class="btn btn-careadmore btn2-round-lg btn2-lg" onclick="window.location.href='job-listing.php';">View all jobs</button>
            <hr/>
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

<script type="text/javascript">
   $(document).ready(function() {
      $('.progress .progress-bar').css("width",
                function() {
                    return $(this).attr("aria-valuenow") + "%";
                }
        )
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

</body>

</html>
