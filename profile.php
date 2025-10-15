<?php
session_start();
//Database Configuration File
error_reporting(1);
include('includes/config.php');

//verifying Session
if(strlen($_SESSION['jsid'])==0 && strlen($_SESSION['login'])==0)
{ 
      header('location:logout.php');
}
else{
      if(isset($_POST['update']))
      {
          //Getting Post Values 
          $FullName=$_POST['fname'];  
          $aboutme=$_POST['aboutme'];  
          $address =$_POST['address']; 
          $state =$_POST['state']; 
          $city =$_POST['city']; 
          $pincode =$_POST['pincode']; 
          $dob = date("Y-m-d", strtotime($_POST['dob']));  
           //Getting User Id
          $uid=$_SESSION['jsid'];

          $id=$_SESSION['id'];

          $sql="update tbljobseekers set `FullName` =:fname, `AboutMe`=:aboutme,`address`=:address ,`state`=:state, `city`=:city, `pincode`=:pincode, `dob` =:dob where id=:uid";

          $query = $dbh->prepare($sql);

         
          try {
          // Binding Post Values
          $query->bindParam(':fname', $FullName, PDO::PARAM_STR);
          $query->bindParam(':uid', $uid, PDO::PARAM_STR);
          $query->bindParam(':aboutme',$aboutme,PDO::PARAM_STR);
          $query->bindParam(':address', $address, PDO::PARAM_STR);
          $query->bindParam(':pincode', $pincode, PDO::PARAM_STR);
          $query->bindParam(':state', $state, PDO::PARAM_STR);
          $query->bindParam(':city', $city, PDO::PARAM_STR);
          $query->bindParam(':dob', $dob, PDO::PARAM_STR); 
          $res = $query->execute();
        }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
 

    $sql1="update users set name=:fname, `billingAddress`=:address ,`billingState`=:state, `billingCity`=:city, `billingPincode`=:pincode, user_role='1' where id=:id";
    $query1 = $dbh->prepare($sql1);


        $query1->bindParam(':fname', $FullName, PDO::PARAM_STR);
        $query1->bindParam(':address', $address, PDO::PARAM_STR);
        $query1->bindParam(':pincode', $pincode, PDO::PARAM_STR);
        $query1->bindParam(':state', $state, PDO::PARAM_STR);
        $query1->bindParam(':city', $city, PDO::PARAM_STR);
              
        $query1->bindParam(':id', $uid, PDO::PARAM_STR);
        $query1->execute();
        $_SESSION['user_role'] = 1;
          echo '<script>alert("Account detail has been updated")</script>';
          echo "<script>window.location.href ='profile.php'</script>";
      }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User | Update Account Details</title>
<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/editor.css" type="text/css" rel="stylesheet"/>
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<style>
.resum-form input[type="date"] {
    float: left;
    width: 100%;
    height: 43px;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 0 20px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    margin: 0 0 28px 0;
    font: 400 14px/14px 'Montserrat', sans-serif;
    color: #666;
}
  </style>
</head>

<body class="theme-style-1">
<div id="wrapper"> 
<!--HEADER START-->
 <?php include('includes/head_new.php');?>
<!--HEADER END--> 

  
  <!--INNER BANNER START-->
  <section id="inner-banner">

    <div class="container">

      <h1><?php echo htmlentities(ucfirst($_SESSION['jsfname']));?> Account Details</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 

  

  <!--MAIN START-->

  <div id="main">
    <!--Signup FORM START-->
    <form name="" enctype="multipart/form-data" method="post">
    <section class="resum-form padd-tb">

      <div class="container">
    <!--Success and error message -->

     <?php if(@$error){ ?><div class="errorWrap">
        <strong>ERROR</strong> : <?php echo htmlentities($error);?></div><?php } ?>

        <?php if(@$msg){ ?><div class="succMsg">
        <strong>Success</strong> : <?php echo htmlentities($msg);?></div><?php } ?>

          <div class="row">
<?php
//Getting Employer Id
$uid=$_SESSION['jsid'];
// Fetching jobs
$sql = "SELECT * from  tbljobseekers  where id=:uid";
$query = $dbh->prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{


 ?>



<div class="col-md-6 col-sm-6">
<label>Full Name *</label>
<input type="text" name="fname" placeholder="Full Name" required autocomplete="off" value="<?php echo htmlentities($result->FullName)?>" />
</div>

<div class="col-md-6 col-sm-6">
<label>Your Email *</label>
<input type="email" name="emailid" readonly="true"  autocomplete="off" value="<?php echo htmlentities($result->EmailId)?>">
</div>

<div class="col-md-6 col-sm-6">
<label>Address *</label>
<input type="text" name="address" placeholder="Address" required autocomplete="off" value="<?php echo htmlentities($result->address)?>" />
</div>

<div class="col-md-6 col-sm-6">
<label>State *</label>
<input type="text" name="state"  placeholder="State Name" required  value="<?php echo htmlentities($result->state)?>">
</div>

<div class="col-md-6 col-sm-6">
<label>City *</label>
<input type="text" name="city" placeholder="City Name" required autocomplete="off" value="<?php echo htmlentities($result->city)?>" />
</div>

<div class="col-md-6 col-sm-6">
<label>Pincode *</label>
<input type="text" name="pincode" placeholder="Pincode" autocomplete="off" value="<?php echo htmlentities($result->pincode)?>">
</div>

<div class="col-md-6 col-sm-6">
<label>Contact Number</label>
<input type="text" name="contactnumber" autocomplete="off" value="<?php echo htmlentities($result->ContactNumber)?>" readonly="true" >
<label>Resume</label>
<img src="images/pdf.png" title="Click Here for View Resume">
 <?php if(!empty($result->Resume)){  ?>
<a href="Jobseekersresumes/<?php echo $result->Resume;?>" target="_blank">Click Here for View Resume</a>
<?php } ?>
<a href="resume.php?updateid=<?php echo $result->id;?>"> &nbsp; <?php echo $status = (empty($result->Resume)) ? "Upload Resume " : "Update Resume "; ?></a>
<hr />

 <br>
<?php if($result->ProfilePic!=""):?>
<img src="images/<?php echo $result->ProfilePic;?>" width="100" height="100" value="<?php  echo $result->ProfilePic;?>">
<br />
<?php endif; ?>
<p style="padding-top: 20px"><a href="change-profilepics.php">Change Profile Pic</a></p>
</div>

<div class="col-md-6 col-sm-6">

<label>Date of Birth</label>
 <input type="date" name="dob" id="dob"  autocomplete="off" value="<?php echo htmlentities($result->dob)?>">
</div>
 
<div class="col-md-6 col-sm-6">
<label>About Me</label>
 <input type="text" name="aboutme" required="true" autocomplete="off" value="<?php echo htmlentities($result->AboutMe)?>">
</div>

</div>
<?php 
}}
?>

            <div class="col-md-12">

              <div class="btn-col">

                <input type="submit" name="update" value="Update">

              </div>

            </div>

          </div>

    

      </div>

    </section>
    </form>
    <!--RESUME FORM END--> 

  </div>

  <!--MAIN END--> 

  

  <!--FOOTER START-->

  <?php include('includes/foot.php');?>
  <!--FOOTER END--> 

</div>


<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/jquery.velocity.min.js"></script> 
<script src="js/jquery.kenburnsy.js"></script> 
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="js/editor.js"></script> 
<script src="js/jquery.accordion.js"></script> 
<script src="js/jquery.noconflict.js"></script> 
<script src="js/theme-scripts.js"></script> 
<script src="js/custom.js"></script>
</body>
</html>
<?php }
?>