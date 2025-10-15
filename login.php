<?php
session_start();
error_reporting(0);

include('shop_includes/config.php');
// include('includes/config.php');

// Code for User login
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $referrer = $_POST['referrer'];
   $password=md5($_POST['password']);
//$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");

//check login in different two tables
/*
   $sql = "SELECT FullName as name, Password as password ,id as jid
    FROM tbljobseekers 
    WHERE EmailId='$email' AND Password='$password' 
    UNION 
    SELECT name, password , id as uid
    FROM users 
    WHERE email='$email' AND password='$password'";
*/
//$sql = "SELECT FullName as fname, tbljobseekers.id as jid ,name, users.id as uid, users.user_role FROM tbljobseekers , users WHERE tbljobseekers.EmailId='$email' AND tbljobseekers.Password='$password' and email='$email' AND users.password='$password' and EmailId=email";
    $sql = "SELECT * from tbljobseekers where EmailId='".$email."'  and Password='".$password."'";
    $query=mysqli_query($con,$sql);
//end
// echo "<br>".$sql;
// die();
$num=mysqli_fetch_array($query);
//print_r($num);die;
if(count($num)>0)
{
    
$extra="my-cart.php";
$_SESSION['login']=$_POST['EmailId'];
$_SESSION['id']=$num['id'];
$_SESSION['username']= $num['FullName'];
$_SESSION['jsid'] = $num['id'];
$_SESSION['jsfname'] = $num['FullName'];
$_SESSION['user_role'] = 1;

$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
//header("location:http://$host$uri/$extra");
//echo (basename($referrer) == 'login.php');die;
if($referrer == '' || (basename($referrer) == 'logout.php')) {
    
	$referrer = "index.php";
} 
header("location:$referrer");
exit();

// if(isset($_SESSION['login'])){
// 	$_SESSION['login']=$_POST['email'];
// 	$_SESSION['id']=$num['id'];
// 	$_SESSION['username']=$num['name'];
//     if($_SESSION['login'] == true){

//         header('Location:my-cart.php');
//         header('Location:my-profile.php');
//         exit;
//     } else {
//         header('Location:login.php');
//         exit;
//     }
// }




}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Password";
exit();
}
          }


?>


<!doctype html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TCC - Shop</title>



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

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet'
        type='text/css'>

    <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

      <![endif]-->
    <script type="text/javascript">
    function valid() {
        if (document.register.password.value != document.register.confirmpassword.value) {
            alert("Password and Confirm Password Field do not match  !!");
            document.register.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>
    <script>
    function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "shop-check_availability.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status1").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
    </script>



</head>

<body class="theme-style-1">
    <div id="wrapper">

        <!--HEADER START-->
        <?php include_once('includes/head_new.php');
   // $row = getTopBanner('shop-page');
    ?>
        <!--HEADER END-->



        <!--INNER BANNER START-->

        <div class="clearfix clear"></div>
        <!--INNER BANNER END-->
        <!-- ============================================== HEADER : END ============================================== -->
        <!-- <div class="breadcrumb">
            <div class="container">
                <div class="breadcrumb-inner">
                    <ul class="list-inline list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li class='active'>Authentication</li>
                    </ul>
                </div>
            </div>
        </div> -->

        <div class="body-content outer-top-bd">
            <div class="tcc_container">
                <div class="login_form_container">
                    <h3 class="dasboard_heading">Sign In</h3>
                    <p>Hello, Welcome to your account.</p>
                    <div class="register_span"><span>Don’t have an account yet?</span><a href="registration.php"> Register here.</a></div>
                    <form class="register-form outer-top-xs" method="post">
                                <span style="color:red;">
                                    <?php
										echo htmlentities($_SESSION['errmsg']);
									?>
                                    <?php
										echo htmlentities($_SESSION['errmsg']="");
									?>
                                </span>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Email Address
                                        <span>*</span></label>
                                    <input type="email" name="email"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputPassword1">Password
                                        <span>*</span></label>
                                    <input type="password" name="password"
                                        class="form-control unicase-form-control text-input" id="exampleInputPassword1">
                                </div>
                                
                                <input type="hidden" name="referrer" value="<?=$_SERVER['HTTP_REFERER']?>">
                                <button type="submit" class="reg_btn"
                                    name="login">Login</button>
                                    <a href="shop-forgot-password.php" class="forgot-password">Forgot your
                                        Password?</a>
                            </form>
                </div>
            </div>
            
        </div>

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
    $(document).ready(function() {
        $(".changecolor").switchstylesheet({
            seperator: "color"
        });
        $('.show-theme-options').click(function() {
            $(this).parent().toggleClass('open');
            return false;
        });
    });

    $(window).bind("load", function() {
        $('.show-theme-options').delay(2000).trigger('click');
    });
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/63fdb6bf4247f20fefe30dd0/1gqbh3q1f';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
    </script>
    <!--End of Tawk.to Script-->


</body>

</html>