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

  <title>TCC - Plans</title>

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

   <?php include_once('includes/head_new.php');?>
  <!--HEADER END--> 

  

  <!--INNER BANNER START-->

<section id="inner-banner" class="bgimgservices bgimgsingleplan">
  <div class="img-background-overlay"></div>
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="service-head">
      <div class="headerText singlePlanHeader">
        <h1 class="banner-title">Mobile Plans</h1>   
        <p class="customSeparator"><span></span></p> 
        <h3>Tonga's no.1 network provider</h3>
        <p class="colredtxt">Choose from the best Mobile Plans</p>
      </div>
      </div>
    </div>
  </div>
  </div>
</section>

<div class="clearfix clear"></div>
  <!--INNER BANNER END--> 


  <!--MAIN START-->
  <?php $plan_id =  (isset($_GET['plan_id']) && $_GET['plan_id'] !='')?$_GET['plan_id']:1;
        $plan =  getPlanMst($plan_id); 
        $catid = $plan[0]->category;
  ?>
  <div id="main"> 

    <section class="blogs-list single-plan">
      <div class="container">
        <div class="row">
          
          <div class="col-md-3 col-sm-12 blogSidebar single-plan-sidebar">
            <div class="recentPostSec">
              <div class="accordion" id="accordionExample">
              <?php        $category =  getCategory();
              foreach($category as $cat) {
              $id = $cat->id;
              $cat->categoryName;
              $results = getAllPlans($id);
              if(count($results) > 0) {
              ?>
              <div >
                <div  id="heading<?=$id?>">
                 
                  <a class="collapsed category plan" data-toggle="collapse" data-target="#collapse<?=$id?>" aria-expanded="<?php if($catid == $cat->id) { echo 'false';} else { echo 'false';}?>" aria-controls="collapse<?=$id?>" style="font-size:18px">
                  <i aria-hidden="true" class="fa fa-angle-double-right"></i> <?php echo $cat->categoryName ?>
              </a>
                </div>
              <div id="collapse<?=$id?>" class="collapse <?php  if($catid == $cat->id) { echo '';} else { echo '';} ?>" aria-labelledby="heading<?=$id?>" data-parent="#accordionExample">
              <ul class="recentPostList">
              <?php
              foreach($results as $row) { ?>
                <li>
                  
                  <div class="postTitle" ><a class="plan" href="#main" data-id="<?=$row->id?>" style="font-size:15px" > <?=$row->plan_title?></a></div>
                 
                </li>
                <?php } ?>
                </ul>
                </div>
                </div>
              <?php } } ?>
              </div>
            </div>
          </div>
          <div class="col-md-9 col-sm-12 single-plan-details">
            <h6 class="ourNewstitle"><i class="fa fa-mobile-phone blogsIcon singlePlanIcon" aria-hidden="true"></i> Prepaid</h6>
          
            <h2 class="topStoreiesHeading" id="planname"><?=$plan[0]->plan_title?></h2>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 singlePlan">
                <div class="plandetails">

                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <?php if(isset($plan[0]->banner2) && $plan[0]->banner2 !='' ) { ?>
                       <li data-target="#myCarousel" data-slide-to="1"></li>
                        <?php } 
                          if(isset($plan[0]->banner3) && $plan[0]->banner3 !='' ) {
                          ?>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <?php } ?>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">

                        <div class="item active">
                          <img id="banner1" src="images/banners/<?=$plan[0]->banner1?>" alt="" style="width:100%;">
                        </div>
                        <?php if(isset($plan[0]->banner2) && $plan[0]->banner2 !='' ) { ?>
                        <div class="item">
                          <img id="banner2" src="images/banners/<?=$plan[0]->banner2?>" alt="" style="width:100%;">
                        </div>
                          <?php } 
                          if(isset($plan[0]->banner3) && $plan[0]->banner3 !='' ) {
                          ?>
                        <div class="item">
                          <img id="banner3" src="images/banners/<?=$plan[0]->banner3?>" alt="" style="width:100%;">
                        </div>
                        <?php } ?>
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <!-- <i class="fa fa-arrow-left" aria-hidden="true"></i> -->
                        <span class="glyphicon glyphicon-chevron-left fa fa-arrow-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right fa fa-arrow-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                  </div>
                   <div id="plan_desc">
                  	<p><?=$plan[0]->plan_desc?></p>
                     </div> 
<!--
                  <hr>

                  <div class="planFeatureList">
                    <ul>
                      <li><i class="fa fa-star-o"></i> Step 1: Call *120#</li>
                      <li><i class="fa fa-star-o"></i> Step 2: Select option 1 - Prepaid Plans</li>
                      <li><i class="fa fa-star-o"></i> Step 3: Select 1 & Enjoy</li>
                    </ul>
                  </div> -->

                </div>
              </div>

            </div>
          </div>
          
        </div>
      <?php  
              $plan_details= getPlanDetails($plan_id );
							$cnt=1;
							foreach($plan_details as $row)
							{
								//echo "<br>".$cnt;
								if($row->sub_id == 1) {
									$header[] = $row->plan_option;
								}
								$sub[$row->sub_id] = $row->sub_id;
								$values[$row->plan_option][$row->sub_id] = $row->plan_value;
								$cnt++;
							} 
                ?>
        <div class="planTableList" id="planTableList">
          <table class="table">
            <thead id="plan_head">
              <tr>
                <?php
              foreach($header as $k => $v) {
								echo "<th>$v</th>";	
							} ?>
               
              </tr>
            </thead>
            <tbody id="plan_body">
              
                <?php 
              foreach($sub as $k => $v) {
								echo "<tr>";	
								 foreach($header as  $hk => $hv) {
									//echo "<td>".$hk."</td>";	
									//$k -- $hk --  $hv ----
									echo "<td> ".$values[$hv][$v]."</td>";	
								}
								 echo "</tr>";	
								
							}?>
             
            </tbody>
          </table>  
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
<script>
$(document).ready(function(){
  $(".plan").click(function(){
   var plan_id =  $(this).attr("data-id") ;
   // alert("The paragraph was clicked."+plan_id);
   console.log("Before");

    $.ajax({
            type: "POST",
            url: 'get_plan_ajax.php',
            dataType: 'json',
            data: {id:plan_id},
            success: function(data)
            {
              console.log("Returned");
              $("#planname").text(data.plan_name);
              $("#plan_desc").html(data.description);
              $("#plan_head").html(data.plan_head);
              $("#plan_body").html(data.plan_body);
              $("#banner1").attr("src", data.banner1);
              $("#banner2").attr("src", data.banner2);
              $("#banner3").attr("src", data.banner3);
           }
  });
  console.log("End");

});
});
</script>
</body>

</html>
