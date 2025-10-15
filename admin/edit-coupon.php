<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid']==0)) {
  header('location:logout.php');
}
else
{
    // print_r($_POST['coupon_name']); die;
    if(isset($_POST['submit']))
    {
    // print_r($_POST['coupon_name']); die;

        $coupon_name=$_POST['coupon_name'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        $discount=$_POST['discount'];
        $status=$_POST['status'];
        $editid=$_GET['editid'];
        $sql="UPDATE `coupon` SET `coupon_name`='$coupon_name',`start_date`='$start_date',`end_date`='$end_date',`discount`='$discount',`status`='$status' WHERE `id`='$editid'";
        $query=$dbh->prepare($sql);
        $query->execute();
        echo '<script>alert("Coupon Updated successfully .")</script>';
        echo "<script>window.location.href ='manage-coupon.php'</script>";

    }

?>
<!doctype html>
<html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <title>Job Portal - Edit Coupon</title>
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
                    <h2 class="content-heading">Edit Coupon</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Bootstrap Register -->
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Edit Coupon</h3>
                                </div>
                                <div class="block-content">
                                    <form method="post">
                                    <?php
                                        $editid=$_GET['editid'];
                                        $sql="SELECT * from coupon where id=:editid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':editid',$editid,PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                            foreach($results as $row)
                                            {              
                                     ?>  
                                        <div class="form-group row">
                                            <label class="col-12" for="coupon_name">Coupon Name:</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" value="<?php  echo htmlentities($row->coupon_name);?>" name="coupon_name" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="start_date">Start Date:</label>
                                            <div class="col-12">
                                                <input type="date" class="form-control" value="<?php  echo htmlentities($row->start_date);?>" name="start_date" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="end_date">End Date:</label>
                                            <div class="col-12">
                                                <input type="date" class="form-control" value="<?php  echo htmlentities($row->end_date);?>" name="end_date" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="discount">Discount:</label>
                                            <div class="col-12">
                                                <input type="number" class="form-control" value="<?php  echo htmlentities($row->discount);?>" name="discount" required="true">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="status">Status</label>
                                            <div class="controls">
                                                <span style="margin:-1px">
                                            <label for="status0" class="lab">
                                            <input type="radio" name="status" id="status0" value="0" <?php if($row->status == '0' ) { echo "checked";}?> > In Active</label> </span>
                                            <span style="margin:1px">
                                            <label for="status1" class="lab">
                                            <input type="radio" name="status" id="status1" value="1" <?php if($row->status == '1' ) { echo "checked";}?> > Active </label></span> 
										</div>
                                        <!-- <div class="control-group">
                                            <label class="control-label" for="basicinput">Status</label>
                                            <div class="controls">
                                             
                                                <input type="radio" name="status" id="status0" value="0" < ?php if($row['status'] == 0 ) { echo "checked";}?>>  <label for="status0" class="lab">InActive</label>
                                                <input type="radio" name="status" id="status1" value="1" < ?php if($row['status'] == 1 ) { echo "checked";}?>>   <label for="status1" class="lab">Active </label>
                                            </div>
                                        </div> -->
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