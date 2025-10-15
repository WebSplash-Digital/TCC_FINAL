<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid']==0)) {
  header('location:logout.php');
}
else
{
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
        // $postinDate=$_POST['postinDate'];
        $updationDate=date("d-m-y h:i:s");
        $isActive=$_POST['isActive'];
        $editid=$_GET['editid'];

        $sql="update tbljobs set jobCategory=:jobCategory,jobTitle=:jobTitle,jobType=:jobType,salaryPackage=:salaryPackage,skillsRequired=:skillsRequired,experience=:experience,jobLocation=:jobLocation,jobDescription=:jobDescription,JobExpdate=:JobExpdate,updationDate=:updationDate,isActive=:isActive where jobId=:editid";
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
        // $query->bindParam(':postinDate',$postinDate,PDO::PARAM_STR);
        $query->bindParam(':updationDate',$updationDate,PDO::PARAM_STR);
        $query->bindParam(':isActive',$isActive,PDO::PARAM_STR);
        $query->bindParam(':editid',$editid,PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Job Updated successfully .")</script>';
        echo "<script>window.location.href ='manage-job-post.php'</script>";
    }

?>
<!doctype html>
<html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <title>Job Portal - Edit Category</title>
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
                    <h2 class="content-heading">Edit Category</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Bootstrap Register -->
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Edit Category</h3>
                                </div>
                                <div class="block-content">
                                    <form method="post">
                                    <?php
                                        $editid=$_GET['editid'];
                                        $sql="SELECT * from tbljobs where jobId=:editid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':editid',$editid,PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                            foreach($results as $row)
                                            {         
                                                
                                                // echo $row->jobCategory; 
                                     ?>  
                                        <div class="form-group row">
                                           <label class="col-12" for="register1-email">Job Category:</label>
                                           <div class="col-12">
                                           <!-- <select name="jobCategory" class="form-control">
                                               <option value="">Select Category</option>
                                               < ?php
                                               include('shop_include/config.php');
                                               $sql = mysqli_query($con, "SELECT `id`,`CategoryName` FROM `tblcategory`");
                                               $row = mysqli_num_rows($sql);
                                               while ($row = mysqli_fetch_array($sql)){
                                               echo "<option value='". $row['CategoryName'] ."' selected='selected'>" .$row['CategoryName'] ."</option>" ;
                                               }
                                               ?>
                                           </select> -->
                                           <select name="jobCategory" class="form-control"   required>
                                            <option value="<?php echo $row->jobCategory;?>"><?php echo $row->jobCategory; ?></option> 
                                        <?php 
                                        include('shop_include/config.php');

                                        $query=mysqli_query($con,"select * from tblcategory");
                                        while($rw=mysqli_fetch_array($query))
                                        {
                                            if($row->jobCategory==$rw['CategoryName'])
                                            {
                                                continue;
                                            }
                                            else{
                                            ?>

                                        <option value="<?php echo $rw['CategoryName'];?>"><?php echo $rw['CategoryName'];?></option>
                                        <?php }} ?>
                                        </select>
                                          

                                       
                                           <!-- <input type="text" class="form-control" value="" name="jobCategory" required="true"> -->
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Job Title:</label>
                                           <div class="col-12">
                                                <!-- <textarea class="form-control" rows="5" name="jobTitle" required="true"></textarea> -->
                                                <input type="text" class="form-control" value="<?php echo $row->jobTitle;?>" name="jobTitle" required="true">  
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Job Type:</label>
                                           <div class="col-12">
                                                <!-- <textarea class="form-control" rows="5" name="jobTitle" required="true"></textarea> -->
                                                <!-- <input type="text" class="form-control" value="" name="jobType" required="true">   -->
                                                <select name="jobType" id="jobType" class="form-control">
                                                   <option value="">Select Job Type</option>
                                                   <option value="Full Time" <?php if($row->jobType=='Full Time'){echo "selected";} ?> >Full Time</option>
                                                   <option value="Part-Time" <?php if($row->jobType=='Part-Time'){echo "selected";} ?> >Part-Time</option>
                                                   <option value="Casual" <?php if($row->jobType=='Casual'){echo "selected";} ?> >Casual</option>
                                                   <option value="Fixed-term contract" <?php if($row->jobType=='Fixed-term contract'){echo "selected";} ?> >Fixed-term contract</option>
                                                   <option value="Apprenticeship" <?php if($row->jobType=='Apprenticeship'){echo "selected";} ?> >Apprenticeship</option>
                                                   <option value="Traineeshipt" <?php if($row->jobType=='Traineeshipt'){echo "selected";} ?> >Traineeship</option>
                                                   <option value="Internship" <?php if($row->jobType=='Internship'){echo "selected";} ?> >Internship</option>
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Salary Package:</label>
                                           <div class="col-12">
                                                <!-- <textarea class="form-control" rows="5" name="salaryPackage" required="true"></textarea> -->
                                                <input type="text" class="form-control" value="<?php echo $row->salaryPackage;?>" name="salaryPackage" required="true">  
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Skills Required:</label>
                                           <div class="col-12">
                                               <input type="text" class="form-control" value="<?php echo $row->skillsRequired;?>" name="skillsRequired" required="true">  
                                                <!-- <textarea class="form-control" rows="5" name="skillsRequired" required="true"></textarea> -->
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Experience:</label>
                                           <div class="col-12">
                                               <input type="text" class="form-control" value="<?php echo $row->experience;?>" name="experience" required="true">  
                                                <!-- <textarea class="form-control" rows="5" name="experience" required="true"></textarea> -->
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Job Location:</label>
                                           <div class="col-12">
                                               <input type="text" class="form-control" value="<?php echo $row->jobLocation;?>" name="jobLocation" required="true">  
                                                <!-- <textarea class="form-control" rows="5" name="jobLocation" required="true"></textarea> -->
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Job Description:</label>
                                           <div class="col-12">
                                                <textarea class="form-control" rows="5" name="jobDescription" required="true"><?php echo $row->jobDescription;?></textarea>
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Job Expdate:</label>
                                           <div class="col-12">
                                               <input type="date" class="form-control" value="<?php echo $row->JobExpdate;?>" name="JobExpdate" required="true">  
                                                <!-- <textarea class="form-control" rows="5" name="JobExpdate" required="true"></textarea> -->
                                           </div>
                                       </div>
                                       <!-- <div class="form-group row">
                                           <label class="col-12" for="register1-email">Postin Date:</label>
                                           <div class="col-12">
                                               <input type="date" class="form-control" value="< ?php echo $row->postinDate;?>" name="postinDate" required="true">  
                                                 <textarea class="form-control" rows="5" name="postinDate" required="true"></textarea>
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Updation Date:</label>
                                           <div class="col-12">
                                               <input type="date" class="form-control" value="< ?php echo $row->updationDate;?>" name="updationDate" required="true">  
                                                <textarea class="form-control" rows="5" name="updationDate" required="true"></textarea>
                                           </div>
                                       </div> -->
                                       <div class="form-group row">
                                           <label class="col-12" for="register1-email">Is Active:</label>
                                           <div class="col-12">
                                           <input type="radio" id="yes" name="isActive" value="1" <?php if($row->isActive=='1'){echo "checked";} ?> >
                                           <label for="yes">Yes</label>&nbsp;&nbsp;
                                           <input type="radio" id="no" name="isActive" value="0" <?php if($row->isActive=='0'){echo "checked";} ?> >
                                           <label for="no">No</label>
                                           </div>
                                       </div>
                                        <?php $cnt=$cnt+1;}} ?> 
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-alt-success" name="submit">
                                                    <i class="fa fa-plus mr-5"></i> Update
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