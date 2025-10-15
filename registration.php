<?php
session_start();

error_reporting(0);
//include('shop_includes/config.php');
include('includes/config.php');
// Code user Registration
if(isset($_POST['submit']))
{

	$fname=$_POST['fullname'];
	$emaill=$_POST['emailid'];
	$cnumber=$_POST['contactno'];
	$hashedpass=md5($_POST['password']);
	$isactive=1;
// Query for validation of  email-id
$ret="SELECT * FROM  tbljobseekers where (EmailId=:uemail)";
$queryt = $dbh -> prepare($ret);
$queryt->bindParam(':uemail',$email,PDO::PARAM_STR);
// $queryt->bindParam(':cnumber',$contactno,PDO::PARAM_STR);
$queryt -> execute();
$results = $queryt -> fetchAll(PDO::FETCH_OBJ);
if($queryt -> rowCount() == 0)
{
    // echo $queryt -> rowCount(); die;
// Query for Insertion
$isactive=1;


// $sql1="INSERT INTO users(`name`,`email`,`contactno`,`password`,`user_role`) VALUES(:fname,:emaill,:cnumber,:hashedpass,'0')";
// $query1 = $dbh->prepare($sql1);

// // Binding Post Values
// $query1->bindParam(':fname',$fname,PDO::PARAM_STR);
// $query1->bindParam(':emaill',$emaill,PDO::PARAM_STR);
// $query1->bindParam(':cnumber',$cnumber,PDO::PARAM_STR);
// $query1->bindParam(':hashedpass',$hashedpass,PDO::PARAM_STR);
// //$query1->bindParam(':ProfilePicname',$ProfilePicname,PDO::PARAM_STR);
// $query1->execute();


//$sql="INSERT INTO tbljobseekers(`FullName`,`EmailId`,`ContactNumber`,`Password`, `IsActive`) VALUES('$fname','$emaill','$cnumber','$hashedpass', '".$isactive."')";
$sql = "INSERT INTO `tbljobseekers` (`FullName`, `EmailId`, `ContactNumber`, `Password`, `IsActive`) VALUES ('$fname','$emaill','$cnumber','$hashedpass', '".$isactive."')";

//echo $sql; die;
$query = $dbh->prepare($sql);


// Binding Post Values
// $query->bindParam(':fname',$fname,PDO::PARAM_STR);
// $query->bindParam(':emaill',$emaill,PDO::PARAM_STR);
// $query->bindParam(':cnumber',$cnumber,PDO::PARAM_STR);
// $query->bindParam(':hashedpass',$hashedpass,PDO::PARAM_STR);
//$query->bindParam(':ProfilePicname',$ProfilePicname,PDO::PARAM_STR);
//$query->bindParam(':isactive',$isactive,PDO::PARAM_STR);
//$query->bindParam(':resumename',$resumename,PDO::PARAM_STR);
// $query->bindParam(':user_id',$lastInsertId,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
}

/*
$sql = "insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')";
$query=mysqli_query($con,$sql); */
//die(mysqli_error($con));
	if($lastInsertId >0 ) {

		echo "<script>alert('You are successfully register');</script>";

        $sql = "SELECT FullName as fname, tbljobseekers.id as uid FROM tbljobseekers WHERE EmailId='$emaill' AND Password='$hashedpass' ";
       // echo $sql; die;
   
       // $result=mysqli_query($con,$sql);
		$query = $dbh->prepare($sql);
		$num = $query->execute();
		$results = $query -> fetchAll(PDO::FETCH_OBJ);
		//print_r($results);die;
//end
// echo "<br>".$sql;
// die();
//$num=mysqli_fetch_array($result);

 //echo '=====>'.$num;die;
 //error_reporting(E_ALL);
if($num>0)
{
    // $extra="my-cart.php";
    $_SESSION['login']=$_POST['emailid'];
    $_SESSION['id']=$results[0]->uid;
    $_SESSION['username']= $results[0]->fname;


    $uip=$_SERVER['REMOTE_ADDR'];
    $status=1;
    $log="insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')";
    $query = $dbh->prepare($log);
	$query->execute();
	$host=$_SERVER['HTTP_HOST'];
	echo "<script>document.location ='index.php';</script>";
	//header("location:".$host."/index.php");
	//header("Location: https://www.geeksforgeeks.org");
    // //echo $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');die;
    // //header("location:http://$host$uri/$extra");
    // // if($referrer == '' || (basename($referrer) == 'logout.php')) {
    // //     $referrer = "index.php";
    // // } 
	// $referrer = "index.php";
    // header("location:$referrer");
    //exit();

}
else
{
    // $extra="login.php";
    $email=$_POST['emailid'];
    $uip=$_SERVER['REMOTE_ADDR'];
    $status=0;
    $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
    $_SESSION['errmsg']="Invalid email id or Password";
    exit();

}
	} else {
		echo "<script>alert('Not register something went worng');</script>";
	}
}



?>


<!doctype html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TCC - Sign Up</title>



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
                <div class="reg_form_container">
                    <h3>create new account</h3>
                    <p>Sign up today & you'll be able to:</p>
                    <ul class="register_list">
                        <!-- <li>Speed your way through the checkout</li>
                        <li>Track your orders easily</li>
                        <li>Keep a record of all your purchases</li> -->
                        <li>Apply for jobs</li>
                        <li>Shop online</li>
                        <li>Easy account management</li>
                    </ul>
                <form class="register-form outer-top-xs" role="form" method="post" name="register"
                                onSubmit="return valid();">
                                <div class="form-group">
                                    <label class="info-title" for="fullname">Full Name <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input"
                                        id="fullname" name="fullname" required="required">
                                </div>


                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">Email Address
                                        <span>*</span></label>
                                    <input type="email" class="form-control unicase-form-control text-input" id="email"
                                        onBlur="userAvailability()" name="emailid" required>
                                    <span id="user-availability-status1" style="font-size:12px;"></span>
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="contactno">Contact No. <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input"
                                        id="contactno" name="contactno" maxlength="10" required>
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="password">Password <span>*</span></label>
                                    <input type="password" class="form-control unicase-form-control text-input"
                                        id="password" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="confirmpassword">Confirm Password
                                        <span>*</span></label>
                                    <input type="password" class="form-control unicase-form-control text-input"
                                        id="confirmpassword" name="confirmpassword" required>
                                </div>


                                <button type="submit" name="submit"
                                    class="reg_btn" id="submit">Sign Up</button>
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