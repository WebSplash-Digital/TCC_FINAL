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
  <link rel="stylesheet" type="text/css" href="
https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.css">

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

     <!--INNER BANNER START-->

<section id="inner-banner" class="bgimgservices bgimgfaq" style="background-image: url('images/banners/<?=$row[0]->banner_img?>');">
  <div class="img-background-overlay"></div>
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="service-head">
        <div class="headerText">
          <h4 class="banner-title1">Try another search</h4>  
        </div>
      </div>
    </div>
    <div class="row text-center">
      <nav class="navbar ">
        <div class="nav nav-justified navbar-nav">
          <form id="search-form" class="navbar-form navbar-search" role="search" method="GET" action="search.php" >
            <div class="input-group">
              <input type="text" class="form-control search-txt" placeholder="Search" name="srch-term" id="srch-term" required>
              <div class="input-group-btn" >
                <button  type="submit" class="btn search-btn" id="search">
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
      <!--POPULAR JOB CATEGORIES START-->
      <section class="popular-categories animated fadeInUp">
        <div class="container-fluid">
          <div class="clearfix">
            <center><h2 class="serachresult_nm"> Search result for '<?=$_GET['srch-term']?>' </h2>
              <!-- <p>< ?=$_GET['srch-term']?></p> -->
            </center>

            <!-- <a href="#" class="btn-style-1">Explore All Jobs</a>  -->
          </div>
          <div class="row">
          <?php
          if(isset($_GET['srch-term']) && $_GET['srch-term'] != '') {
            $search_keyword =  strtolower($_GET['srch-term']);
            $search_array = explode(" ",$search_keyword );
            $categoryArr =getCategory();
            foreach($categoryArr as $row) {
                $category[] = strtolower($row->categoryName);
            }

            $result=array_intersect($category,$search_array);
// echo "<pre>";
// print_r($result);
// echo "</pre>";
/*
            if(count($result) > 0) {
             //  $cat = implode("', '", $category);
                $sql ="SELECT id , productName as title,  'product' as type FROM `products` WHERE (productName LIKE '%$search_keyword%' || `productDescription` LIKE '%$search_keyword%') 

            } else {
  */          // search from Product

           $sql ="SELECT id , productName as title, 'product' as type FROM `products` WHERE (productName LIKE '%$search_keyword%' || `productDescription` LIKE '%$search_keyword%')
            union    

            SELECT id , faq_title as title, 'faq' as type FROM `faq_mst` where (faq_title LIKE '%$search_keyword%' || faq_description LIKE '%$search_keyword%')
            union 

            SELECT url as id , title as title, 'news' as type FROM `latest_news` where (title LIKE '%$search_keyword%' ||  description LIKE '%$search_keyword%' )
            union 

            SELECT url as id , title as title, 'promotions' as type FROM `promotions` where (title LIKE '%$search_keyword%' ||  description LIKE '%$search_keyword%' )
             union 

            SELECT id,  plan_title as title,'plan' as type FROM `plan_mst` where (plan_title LIKE '%$search_keyword%' || plan_desc LIKE '%$search_keyword%')
            union 

            SELECT jobId as id, jobTitle as title, 'job' as type FROM `tbljobs` where  (jobTitle LIKE '%$search_keyword%' || jobDescription LIKE '%$search_keyword%')";
//}
//echo "Query :".    $sql ;
           
/*
            search if matches Category -- Display data by category

            products
            first search productName, if not exist than productDescription

            tbljobs
            jobTitle, jobDescription

SELECT * FROM `tbljobs6+  s` where  (plan_title  LIKE '%$search_keyword%' || jobDescription LIKE '%mobile%');
jobCategory 
  jobTitle
skillsRequired  
jobDescription

            faq_mst
            first search title, if not exist than description

            latest_news
            first search title, if not exist than description

            orders
            search for order by no

            plan_mst
            first search title, if not exist than description

*/
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = count($results);

    $sql1 ="SELECT id,productImage1 FROM `products` WHERE (productName LIKE '%$search_keyword%' || `productDescription` LIKE '%$search_keyword%')";

    $query1 = $dbh -> prepare($sql1);

    $query1->execute();
    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

    $cnt1 = count($results1);


                // print_r($results1); die();
    if( $cnt > 0) {
    foreach($results as $data) {

      if( $cnt1 > 0) {
    foreach($results1 as $data1) {
        ?>
        <div class="searchboxdes">
          <!-- <p style="text<?=$data->title?>-align:left;margin-left:200px;font-size:15px;"> -->
           <img src="<?=BASE_URL?>shop_admin/productimages/<?=$data1->id?>/<?=$data1->productImage1?>" width=100px height=100px> 
            <h4><?=$data->title?></h4>
            <!-- <h5 class="limited-text">< ?=$data->description?></h5> -->
            <h5>
              <?php
              if($data->type == 'product') { 
               

                echo "<a href='product-details.php?pid=".$data->id."'>Click Here</a>";}
              elseif($data->type == 'faq')  { echo "<a href='faq.php'>Click Here</a>";}
              elseif($data->type == 'news') { echo "<a href='news-details/".$data->id."'>Click Here</a>";}
              elseif($data->type == 'promotions') { echo "<a href='promotions.php'>Click Here</a>";}
              elseif($data->type == 'plan') { echo "<a href='plans-single.php?plan_id=".$data->id."'>Click Here</a>";}
              elseif($data->type == 'job') { echo "<a href='jobs-details.php?jid=".$data->id."'>Click Here</a>";}
              ?>
           </h5>

    </div>
        <?php

        }
      }
    }
} else {
    ?>
    <div class="card">No record found!! 
    </div>
    <?php
}
} else {
    ?>
    <div class="card">No keyword to search!! 
    </div>
    <?php
}
?>
           </div>
        </div>
      </section>
      <!--POPULAR JOB CATEGORIES END-->



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
   $(document).ready(function() {
    
    $("#srch-term").click(function() {
    //  alert("Clicked");
      var search_term = $("#srch-term").val();
      if(search_term == '') {
         return false;
      } else {
       //  alert("Search Noew");
         $("#search-form").submit();
      }
   });

    
</script>
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

    <!-- serach script start -->
      <script type="text/javascript">
        function validateForm() {
          if(document.getElementById("srch-term").value == '') {
            return false;
          }else {
            document.getElementById("search-form").submit();
          } 
        }

      </script>
    <!-- serach script end -->


    <!-- support chat -->
    <!-- Support Board -->
   <!-- <script id="chat-init" src="https://cloud.board.support/account/js/init.js?id=311900347"></script>-->
    </body>

</html>
