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

  <title>TCC - Latest News Details</title>

 
  <!--BOOTSTRAP CSS-->

  <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">

  <!--CUSTOM CSS-->

  <link href="../css/custom.css" rel="stylesheet" type="text/css">
  <link href="../css/style.css" rel="stylesheet" >

  <!--COLOR CSS-->

  <link href="../css/color.css" rel="stylesheet" type="text/css">

  <!--RESPONSIVE CSS-->

  <link href="../css/responsive.css" rel="stylesheet" type="text/css">

  <!--OWL CAROUSEL CSS-->

  <link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">

  <!--FONTAWESOME CSS-->

  <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!--SCROLL FOR SIDEBAR NAVIGATION-->

  <link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">



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

   <?php include_once('includes/head_new.php');?>
  <!--HEADER END--> 

  

  <!--INNER BANNER START-->

<section id="inner-banner" class="bgimgservices bgimgnews">
  <div class="img-background-overlay"></div>
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="service-head">
      <div class="headerText">
        <h1 class="banner-title">Latest News</h1>    
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

    <section class="blogs-list">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-12">
            <!-- <h6 class="ourNewstitle"><i class="fa fa-newspaper-o blogsIcon" aria-hidden="true"></i> Our News</h6>

            <h2 class="topStoreiesHeading">Top Stories</h2> -->
            
            <div class="row">
              <div class="col-md-12 col-sm-12 blogLists">
              <?php
             
       if(isset($_GET['title'])) {
        //$title = str_replace("-"," ",strtolower($_GET['title']));
        $title = $_GET['title'];
        $sql="select * from latest_news where url like '$title' limit 1";
    } 
   // print_r($_GET);
  //  die("XXX".$_GET['title']);
   // die($sql);
        $query = $dbh -> prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt = count($results);
       // $cnt =0;
        if($cnt >0) {
        foreach($results as $row)
        {
        ?>
                <div class="blog">
                  <img width="100%" src="../images/latest-news/<?=$row->title_image?>" title="<?php echo substr($row->title,0,150);?>" alt="<?php echo substr($row->title,0,30);?>" >
                  <h3><?php echo $row->title;?></h3>
                  <p><?php echo $row->description;?> </p>
                 </div>
        <?php }
        } else {
           ?> <div class="blog">
                  <p>No records found. </p>
                </div>
       <?php } ?> 
              </div>
            </div>
          </div>
          
          
          <div class="col-md-4 col-sm-12 blogSidebar">
            <div class="recentPostSec">
              <h3>Recent Post</h3>
              <ul class="recentPostList">
                <?php    
                $sql="select * from latest_news where status = 1 order by id desc limit 10";
                $query = $dbh -> prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                foreach($results as $row)
                { ?>
                <li>
                  <a href="#">
                    <div class="postTitle"><?php echo substr($row->title,0,25);?></div>
                    <div class="postDate"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("d M Y", strtotime($row->created_at));?></div>
                  </a>
                </li>
                <?php } ?>
              </ul>
            </div> 
            <!--
            <div class="categoriesListSec">
              <h3>Categories</h3>
              <ul class="categoriesList">
                <li>
                  <a href="#">
                    <div><i class="fa fa-angle-right"></i><a href="?cat=Mobile"> Mobile</a></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div><i class="fa fa-angle-right"></i><a href="?cat=Laptop"> Laptop</a></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div><i class="fa fa-angle-right"></i> <a href="?cat=Internet">Internet</a></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div><i class="fa fa-angle-right"></i> <a href="?cat=Broadband">Broadband</a></div>
                  </a>
                </li>
              </ul>
            </div>
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
