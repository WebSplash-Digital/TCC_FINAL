<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('includes/function.php');
if (strlen($_SESSION['jpaid']==0)) {
  header('location:logout.php');
  } else{

// Code for deleting product from cart
// if(isset($_GET['delid']))
// {
// $rid=intval($_GET['delid']);
// $sql="UPDATE `tblapplyjob` SET `Status`='[value-5]' WHERE ID=:rid";
// $query=$dbh->prepare($sql);
// $query->bindParam(':rid',$rid,PDO::PARAM_STR);
// $query->execute();
//  echo "<script>alert('Data deleted');</script>"; 
//   echo "<script>window.location.href = 'manage-category.php'</script>";     


// }

  ?>
<!doctype html>
<html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <title>Job Portal - Manage Category</title>

        <link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.min.css">

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
                    <h2 class="content-heading">Applied Job List</h2>

                   

                    <!-- Dynamic Table Full Pagination -->
                    <div class="block">
                        <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Applied Job List By Candidates</h3>
                                  
                                </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality initialized in js/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th> 
                                        <th class="d-none d-sm-table-cell">Job Title </th>
                                        <th>Candidate Name</th>
                                        <th>Applied Date</th>
                                        <th>Job Status</th>
                                        <!--<th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>-->
                                       </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql="SELECT * from tblapplyjob";
                                        $query = $dbh -> prepare($sql);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $row) 
                                        {         
                                            ?> 
                                    <tr>
                                    <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                        <td class="text-center"><?php echo getJobTitle($row->JobId);?></td>
                                        <td class="font-w600"><?php  echo getUserName($row->UserId);?></td>
                                        <td class="d-none d-sm-table-cell"><?php  echo htmlentities($row->Applydate);?></td>
                                        <!-- <td class="d-none d-sm-table-cell">< ?php  echo $row->Status;?></td> -->
                                        <!-- <td class="d-none d-sm-table-cell">
                                            <a href="applied-job-list.php?delid=< ?php echo ($row->ID);?>" onchange="updateJobStatus();">
                                                <img src="images/shortlist.png" alt="Girl in a jacket" width="20" height="20">
                                            </a>&nbsp;&nbsp;
                                            <a href="applied-job-list.php?delid=< ?php echo ($row->ID);?>" onclick="return confirm('Do you really want to Reject candidate?');">
                                                <img src="images/disapproval.png" alt="Girl in a jacket" width="20" height="20">
                                            </a>
                                        </td> -->
                                        <td class="d-none d-sm-table-cell"> 
                                            <select name="Status" id="Status-<?php echo $row->ID;?>" class="form-control" onchange="updateJobStatus('<?php echo ($row->ID);?>');">
                                                <option value="">Pending</option>
                                                <option value="Shortlisted" <?php if($row->Status == 'Shortlisted') { echo 'selected';}?>>Shortlisted</option>
                                                <option value="Rejected" <?php if($row->Status == 'Rejected') { echo 'selected';}?>>Rejected</option>
                                            </select>
                                        </td> 
                                        
                                         <!--<td class="d-none d-sm-table-cell"><a href="manage-category.php?delid=<?php echo ($row->id);?>" onclick="return confirm('Do you really want to Delete ?');"><i class="fa fa-trash fa-delete" aria-hidden="true"></i></a> || <a href="edit-category.php?editid=<?php echo htmlentities ($row->id);?>"><i class="fa fa-edit" aria-hidden="true"></i></a></td>--> 
                                    </tr>
                                    <?php $cnt=$cnt+1;}} ?> 
                                                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full Pagination -->

                    <!-- END Dynamic Table Simple -->
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

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/be_tables_datatables.js"></script>
        <script>
        function updateJobStatus(ID){
            var id = ID;
            var status = $('#Status-'+id).val();
            // alert(ID);
            // alert(status);

            $.ajax({url: "ajax.php",
                type:"POST", 
                data:{"status":status,"id":id},
                success: function(result){

                alert(result);
                window.location.href ='applied-job-list.php';
                
            }});
        }
        </script>
    </body>
</html>
<?php }  ?>