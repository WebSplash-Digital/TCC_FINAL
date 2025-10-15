<?php
session_start();

//Database Configuration File
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signin']))
{
    // Getting username/ email and password
    $uname=$_POST['emailmbile'];
    $password=md5($_POST['password']);

    // Fetch data from database on the basis of username/email and password
    $sql ="SELECT id,FullName,Password FROM tbljobseekers WHERE (EmailId=:usname)";

    $query= $dbh-> prepare($sql);
    $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0)
    {

        foreach ($results as $row) {
            $dbhashpass=$row->Password;
            $_SESSION['jsid']=$row->id;
            $_SESSION['jsfname']=$row->FullName;

            //shop session

            $_SESSION['login']=$_POST['emailmbile'];
            $_SESSION['id']=$row->id;
            $_SESSION['username']=$row->FullName;

            $uip=$_SERVER['REMOTE_ADDR'];
            $status=1;
           $sql1 = "insert into userlog(`userEmail`,`userip`,`status`) values('".$_SESSION['login']."','','$status')";
           $query= $dbh-> prepare($sql1);
           $query-> execute();;
           // $log= mysqli_query($con,$sql);
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        }
 
        //verifying Password
        if ($password==$dbhashpass) {
            echo "<script type='text/javascript'> document.location ='my-profile.php'; </script>";
        } 
        else 
        {
            echo "<script>alert('Wrong Password');</script>";
            echo "<script type='text/javascript'> document.location ='logout.php'; </script>";
        }
    }
    //if username or email not found in database
    else
    {
        echo "<script>alert('User not registered with us');</script>";
    }
     
}
?>

<!doctype html>

<html>
<head>
    <title>JobSeeker SignIn | Job Portal</title>
    <link href="css/custom.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/color.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>

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
 <style type="text/css">
</style>
  </head>
<body class="theme-style-1">

    <!--WRAPPER START-->

    <div id="wrapper"> 

    <?php include_once('includes/head_new.php');
// $row = getTopBanner('shop-page');
 ?>
      <!--HEADER END--> 

      <section id="inner-banner">
        <div class="container">
          <h1>Login To Your Account</h1>
        </div>
      </section>

      <!--MAIN START-->

      <div id="main" > 
        <!--SIGNUP SECTION START-->

        <section class="signup-section" style="background:#FFF!important;">
          <div class="container">
            <div class="holder">
              <div class="thumb"><img src="images/account.png" alt="img"></div>
              <form method="post" name="emplsignin">
                <div class="input-box"> <i class="fa fa-user"></i>
                  <input type="text" placeholder="Email-Id or Registered Mobile Number" name="emailmbile"  autocomplete="off" required>
                </div>
                <div class="input-box"> <i class="fa fa-unlock"></i>
                  <input type="password" class="form-control" name="password" required placeholder="Password">
                </div>
                <div class="input-box">
                  <input type="submit" value="Sign in" name="signin">
                </div>
                <a href="forgot-password.php" class="login">Forgot your Password</a> <b>OR</b>
                <div class="login-social">
                  <em>You Don't have an Account? <a href="sign-up.php">SIGN UP NOW</a></em> 
                </div>
              </form>
              <a href="index.php"><i class="fa fa-home" aria-hidden="true" style="font-size: 30px;padding-top: 10px"></i>  Back Home!!!
              </a>
            </div>
          </div>
        </section>

        <!--SIGNUP SECTION END-->
      </div>

      <!--MAIN END--> 

      <!--FOOTER START-->
      <?php include_once('includes/foot.php');?>
      <!--FOOTER END--> 

    </div>

    <script src="js/jquery-1.11.3.min.js"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/owl.carousel.min.js"></script> 
    <script src="js/jquery.velocity.min.js"></script> 
    <script src="js/jquery.kenburnsy.js"></script> 
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 
    <script src="js/jquery.noconflict.js"></script> 
    <script src="js/theme-scripts.js"></script> 
    <script src="js/form.js"></script> 
    <script src="js/custom.js"></script>

</body>

</html>
