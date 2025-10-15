<?php
session_start();
error_reporting(0);

include('includes/config.php');
include('function.inc.php');

//print_r($getJobStatus);
?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">
<title>Job Portal || Home Page</title>
 
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--CUSTOM CSS-->

<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">

<!--BOOTSTRAP CSS-->

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

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
$row = getTopBanner('careers');?>
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
 <!--POPULAR JOB CATEGORIES END--> 
    <section class="popular-categories animated fadeInUp">
        <div class="container-fluid">
          <div class="clearfix">
            <center><h2>Explore Careers</h2>
             
            </center>

            <!-- <a href="#" class="btn-style-1">Explore All Jobs</a>  -->
          </div>
          <div class="row">
          <?php
          if (isset($_GET['page_no']) && $_GET['page_no']!="") {
            $page_no = $_GET['page_no'];
          } else {
            $page_no = 1;
          }
          // Formula for pagination
          $no_of_records_per_page = 5;
          $offset = ($page_no-1) * $no_of_records_per_page;
          $previous_page = $page_no - 1;
          $next_page = $page_no + 1;
          $adjacents = "2"; 
          $ret = "SELECT jobId FROM tbljobs";
          $query1 = $dbh -> prepare($ret);
          $query1->execute();
          $results1=$query1->fetchAll(PDO::FETCH_OBJ);
          $total_rows=$query1->rowCount();
          $total_no_of_pages = ceil($total_rows / $no_of_records_per_page);
            $second_last = $total_no_of_pages - 1; // total page minus 1
          $sql="SELECT tbljobs.*,tblemployers.CompnayLogo,tblemployers.CompnayName from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId LIMIT $offset, $no_of_records_per_page";
          $query = $dbh -> prepare($sql);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);

          $cnt=1;
          if($query->rowCount() > 0)
          {
            foreach($results as $row)
            {  ?>
            <div class="col-md-4 col-sm-8"  style="padding:10px;">
              <div class="card p-2"> 
                   <img src="employers/employerslogo/<?php echo $row->CompnayLogo;?>" alt="img" width="300" height="300">

                
                <p><a href="jobs-details.php?jid=<?php echo ($row->jobId);?>"><?php  echo htmlentities($row->jobTitle);?></a></p>
                
               <p class="text-center" style="font-size:15px!important;margin:0px!important;"> <i class="fa fa-map-marker"></i><?php  echo htmlentities($row->jobLocation);?></p>
            <p style="font-size: 15px!important;margin:0px!important;">
                 <i class="fa fa-calendar"></i> <?php  echo htmlentities(date("dS M, Y",strtotime($row->postinDate)));?> 
            </p>
                  <div>
                <!-- <strong class="price"><i class="fa fa-money"></i>$<?php  echo htmlentities($row->salaryPackage);?></strong>  -->
                <?php
                if(isset($_SESSION['jsid'])){
                  $getJobStatus = getAppliedJobStatusByUserId($row->jobId);
                  //print_r($getJobStatus);
                
                  if(isset($getJobStatus[0]->Status)){
                    ?>
                    <button  class="btn btn-primary">Applied</button>
                    <?php
                  }else{
                    ?>
                    <a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn btn-primary">Apply Now</a>
                    <?php
                  }
                }else{
                 ?>
                  <a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn btn-primary">Apply Now</a>
                 <?php
                }
               
                ?>
                
              
            </div>
              </div>
            </div>
             <?php }
             } ?>   
  
          </div>
        </div>
      </section>
    

    

    <!--RECENT JOB SECTION END--> 

    

    <!--CALL TO ACTION SECTION START-->

    <section class="call-action-section">

      <div class="container">

        <div class="text-box">

          <h2>Better Results with Standardized Hiring Process</h2>

          <p>Your quality of hire increases when you treat everyone fairly and equally. Having multiple recruiters

            working on your hiring is beneficial.</p>

        </div>

        <a href="sign-up.php" class="btn-get">Get Registered &amp; Try Now</a> </div>

    </section>

    <!--CALL TO ACTION SECTION END--> 

    



    



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

<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/63fdb6bf4247f20fefe30dd0/1gqbh3q1f';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->


<!-- support chat -->
<!-- Support Board -->
<script id="chat-init" src="https://cloud.board.support/account/js/init.js?id=311900347"></script>
</body>

</html>
