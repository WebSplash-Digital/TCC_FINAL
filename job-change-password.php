<?php
session_start();
error_reporting(0);

include('includes/config.php');
include('function.inc.php');

//verifying Session
if(strlen($_SESSION['jsid'])==0)
  { 
header('location:logout.php');
}
else{

if(isset($_POST['change']))
{

// print_r($_POST); die;

//Getting User Id
$uid=$_SESSION['id'];
// Getting Post Values
$currentpassword=md5($_POST['currentPassword']);

// echo $currentpassword; die;
$newpassword=$_POST['newPassword'];
$repeatNewPassword=$_POST['repeatNewPassword'];

if($newpassword==$repeatNewPassword){
//new password hasing 
// $options = ['cost' => 12];
$hashednewpass=md5($newpassword);

  // Fetch data from database on the basis of Employee session if
    $sql ="SELECT Password, EmailId FROM tbljobseekers WHERE (id=:uid )";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':uid', $uid, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach ($results as $row) {
$hashpass=$row->Password;
$emailid = $row->EmailId;
}

//if current password verfied new password wil be updated in the databse
if ($currentpassword==$hashpass) {
$sql="update  tbljobseekers set Password=:hashednewpass where id=:uid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query->bindParam(':hashednewpass',$hashednewpass,PDO::PARAM_STR);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();



//  if($res == 1) {
//     echo '<script>alert("Your password successully changed, Please login with New Password")</script>';
//     $_SESSION['jsid'] ='';
//     header("Location: login.php");
// die();
//  }
echo '<script>alert("Your password successully changed")</script>';

} else {
echo '<script>alert("Your current password is wrong")</script>';

}
}



}else{
    echo '<script>alert("Password is not match")</script>';
}
}
}

?>
<!doctype html>

<html>

<head>

    <meta charset="utf-8">
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/dashboard.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
</head>
<!--HEADER START-->
<?php include_once('includes/head_new.php');
?>
<!--HEADER END-->

<body class="theme-style-1">
    <a class="btn btn-primary d-block d-lg-none m-2" data-bs-toggle="offcanvas" href="#offcanvasSidebar" role="button" aria-controls="offcanvasExample">
        Show Profile Menu
    </a>

    <div class="container mt-5">
        <div class="row tcc_dashboard">
            <div class="col-md-4 tcc_sidebar">
                <?php include_once('includes/job-dashboard-menu.php');
                ?>
            </div>
            <div class="col-lg-8 tcc_dashboard_body">
                <h3 class="pb-3 dasboard_heading">Change Password</h3>
                <div class="dashboard_body_cards">
                    <div class="dashboard_body_intro">


                        <!-- Profile Form -->
                        <form action="job-change-password.php" method="POST" id="jobChangePawwsord" class="pt-2">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password">
                                            <label for="currentPassword">Current Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                                            <label for="newPassword">New Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="repeatNewPassword" name="repeatNewPassword" placeholder="Repeat New Password">
                                            <label for="repeatNewPassword">Repeat New Password</label>
                                        </div>
                                    </div>
                                </div>




                                <div class="d-grid gap-2">
                                    <input type="submit" class="tcc_btn mt-4" name="change" value="Update Password" id="">
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>


<script>
    var myOffcanvas = document.getElementById('offcanvasSidebar')
    var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)

    /*
    var btnToggle = document.getElementById('btnOffcanvasToggle')

    btnToggle.addEventListener('click', function (event) {
    	bsOffcanvas.toggle();
    });
    */


    // Define our viewportWidth variable
    var viewportWidth;

    // Set/update the viewportWidth value
    var setViewportWidth = function() {
        viewportWidth = window.innerWidth || document.documentElement.clientWidth;
    }

    // Log the viewport width into the console
    var logWidth = function() {
        if (viewportWidth < 1024) {
            myOffcanvas.classList.add('offcanvas', 'offcanvas-start');
        } else {
            myOffcanvas.classList.remove('offcanvas', 'offcanvas-start');
            myOffcanvas.style.visibility = 'visible';
        }
    }

    // Set our initial width and log it
    setViewportWidth();
    logWidth();

    // On resize events, recalculate and log
    window.addEventListener('resize', function() {
        setViewportWidth();
        logWidth();
    }, false);
</script>