<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


$jobCategory=$_POST['jobCategory'];
$jobTitle=$_POST['jobTitle'];
$jobType=$_POST['jobType'];
$salaryPackage=$_POST['salaryPackage'];
$skillsRequired=$_POST['skillsRequired'];
$experience=$_POST['experience'];
$jobLocation=$_POST['jobLocation'];
$jobDescription=$_POST['jobDescription'];
$JobExpdate=$_POST['JobExpdate'];
$postinDate=date("d-m-y h:i:s");
// $updationDate=$_POST['updationDate'];
$isActive=$_POST['isActive'];


// $sql="insert into tblcategory(CategoryName,Description)values(:category,:description)";
$sql="INSERT INTO `tbljobs`(`employerId`, `jobCategory`, `jobTitle`, `jobType`, `salaryPackage`, `skillsRequired`, `experience`, `jobLocation`, `jobDescription`, `JobExpdate`, `postinDate`, `isActive`) VALUES ('1',:jobCategory,:jobTitle,:jobType,:salaryPackage,:skillsRequired,:experience,:jobLocation,:jobDescription,:JobExpdate,:postinDate,:isActive)";

$query=$dbh->prepare($sql);
$query->bindParam(':jobCategory',$jobCategory,PDO::PARAM_STR);
$query->bindParam(':jobTitle',$jobTitle,PDO::PARAM_STR);
$query->bindParam(':jobType',$jobType,PDO::PARAM_STR);
$query->bindParam(':salaryPackage',$salaryPackage,PDO::PARAM_STR);
$query->bindParam(':skillsRequired',$skillsRequired,PDO::PARAM_STR);
$query->bindParam(':experience',$experience,PDO::PARAM_STR);
$query->bindParam(':jobLocation',$jobLocation,PDO::PARAM_STR);
$query->bindParam(':jobDescription',$jobDescription,PDO::PARAM_STR);
$query->bindParam(':JobExpdate',$JobExpdate,PDO::PARAM_STR);
$query->bindParam(':postinDate',$postinDate,PDO::PARAM_STR);
// $query->bindParam(':updationDate',$updationDate,PDO::PARAM_STR);
$query->bindParam(':isActive',$isActive,PDO::PARAM_STR);


 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Job has been posted.")</script>';
    echo "<script>window.location.href ='manage-job-post.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!doctype html>
 <html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
 <title>Job Portal - Post Job</title>
<link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">

</head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
     

             <?php include_once('includes/sidebar.php');?>

          <?php include_once('includes/header.php');?>

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                
                    <!-- Register Forms -->
                    <h2 class="content-heading">Post Job</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Bootstrap Register -->
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Post Job</h3>
                                   
                                </div>
                                <div class="block-content">
                                   
                                    <form method="post">
                                        
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Job Category:</label>
                                            <div class="col-12">
                                            <select name="jobCategory" class="form-control">
                                                <option value="">Select Category</option>
                                                <?php
                                                include('shop_include/config.php');
                                                $sql = mysqli_query($con, "SELECT `id`,`CategoryName` FROM `tblcategory`");
                                                $row = mysqli_num_rows($sql);
                                                while ($row = mysqli_fetch_array($sql)){
                                                echo "<option value='". $row['CategoryName'] ."'>" .$row['CategoryName'] ."</option>" ;
                                                }
                                                ?>
                                            </select>
                                            <!-- <input type="text" class="form-control" value="" name="jobCategory" required="true"> -->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Job Title:</label>
                                            <div class="col-12">
                                                 <!-- <textarea class="form-control" rows="5" name="jobTitle" required="true"></textarea> -->
                                                 <input type="text" class="form-control" value="" name="jobTitle" required="true">  
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Job Type:</label>
                                            <div class="col-12">
                                                 <!-- <textarea class="form-control" rows="5" name="jobTitle" required="true"></textarea> -->
                                                 <!-- <input type="text" class="form-control" value="" name="jobType" required="true">   -->
                                                 <select name="jobType" id="jobType" class="form-control">
                                                    <option value="">Select Job Type</option>
                                                    <option value="Full Time">Full Time</option>
                                                    <option value="Part-Time">Part-Time</option>
                                                    <option value="Casual">Casual</option>
                                                    <option value="Fixed-term contract">Fixed-term contract</option>
                                                    <option value="Apprenticeship">Apprenticeship</option>
                                                    <option value="Traineeshipt">Traineeship</option>
                                                    <option value="Internship">Internship</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Salary Package:</label>
                                            <div class="col-12">
                                                 <!-- <textarea class="form-control" rows="5" name="salaryPackage" required="true"></textarea> -->
                                                 <input type="text" class="form-control" value="" name="salaryPackage" required="true">  
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Skills Required:</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" value="" name="skillsRequired" required="true">  
                                                 <!-- <textarea class="form-control" rows="5" name="skillsRequired" required="true"></textarea> -->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Experience:</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" value="" name="experience" required="true">  
                                                 <!-- <textarea class="form-control" rows="5" name="experience" required="true"></textarea> -->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Job Location:</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" value="" name="jobLocation" required="true">  
                                                 <!-- <textarea class="form-control" rows="5" name="jobLocation" required="true"></textarea> -->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Job Description:</label>
                                            <div class="col-12">
                                                 <textarea class="form-control" rows="5" name="jobDescription" required="true"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Job Expdate:</label>
                                            <div class="col-12">
                                                <input type="date" class="form-control" value="" name="JobExpdate" required="true">  
                                                 <!-- <textarea class="form-control" rows="5" name="JobExpdate" required="true"></textarea> -->
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-12" for="register1-email">Postin Date:</label>
                                            <div class="col-12">
                                                <input type="date" class="form-control" value="" name="postinDate" required="true">  
                                                <textarea class="form-control" rows="5" name="postinDate" required="true"></textarea> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Updation Date:</label>
                                            <div class="col-12">
                                                <input type="date" class="form-control" value="" name="updationDate" required="true">  
                                                 <textarea class="form-control" rows="5" name="updationDate" required="true"></textarea> 
                                            </div>
                                        </div> -->
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Is Active:</label>
                                            <div class="col-12">
                                            <input type="radio" id="yes" name="isActive" value="1">
                                            <label for="yes">Yes</label>&nbsp;&nbsp;
                                            <input type="radio" id="no" name="isActive" value="0">
                                            <label for="no">No</label>
                                            </div>
                                        </div>
                                    
                                      
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-alt-success" name="submit">
                                                    <i class="fa fa-plus mr-5"></i> Post Job
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- END Bootstrap Register -->
                        </div>
                        
                       </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

          <?php include_once('includes/footer.php');?>
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.appear.min.js"></script>
        <script src="assets/js/core/jquery.countTo.min.js"></script>
        <script src="assets/js/core/js.cookie.min.js"></script>
        <script src="assets/js/codebase.js"></script>
    </body>
</html>
<?php }  ?>