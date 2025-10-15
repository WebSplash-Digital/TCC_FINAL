<?php
session_start();
include('shop_include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_GET['id'])  && isset($_GET['action'])  && $_GET['action'] == 'update') {
    $sql = "update `contact_details` set status = 0 where id = '".$_GET['id']."'"; 
    $query=mysqli_query($con,$sql);

} elseif(isset($_GET['id'])  && isset($_GET['action'])  && $_GET['action'] == 'delete') {
    $sql = "delete from  `contact_details` where id = '".$_GET['id']."'"; 
    $query=mysqli_query($con,$sql);
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Pending Orders</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
</head>
<body>
<?php include('shop_include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('shop_include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

	<div class="module">
							<div class="module-head">
								<h3>Contact Us Request</h3>
							</div>
							<div class="module-body table">
                                <?php if(isset($_GET['del'])) {?>
                                    <div class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                                    </div>
                                <?php } ?>
									<br />
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display table-responsive" >
									<thead>
										<tr>
											<th>#</th>
											<th> Name</th>
										<!--	<th width="50">Email </th>
											<th>Contact no</th> -->
											<th>Classification </th>
											<th>Message</th>
											<th>Reply</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
								
<tbody>
<?php 
$sql = "SELECT * FROM `contact_details`  order by id desc"; 
$query=mysqli_query($con,$sql);
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>										
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['contact_name']);?><br><?php echo htmlentities($row['contact_email']);?><br><?php echo htmlentities($row['contact_phone']);?>
                                        </td>
										<!--	<td><?php echo htmlentities($row['contact_email']);?></td>
											<td><?php echo htmlentities($row['contact_phone']);?></td> -->
											<td><?php echo htmlentities($row['contact_classification']);?></td>
											<td><?php echo htmlentities($row['contact_message']);?></td>
											<td><?php echo htmlentities($row['reply_msg']);?></td>
										    <td><?php echo htmlentities($row['created_at']);?></td>
											<td width="60"> 
                                            <a href="?id=<?php echo htmlentities($row['id']);?>&action=update" title="Mark as Read" ><i class="icon-pencil"></i></a>|  
                                            <!--<a href="?id=<?php echo htmlentities($row['id']);?>" title="Reply" target="_blank">-->
                                            <a class="reply" data-toggle="modal" href="#signupModal" data-id="<?php echo htmlentities($row['id']);?>" data-name="<?php echo htmlentities($row['contact_name']);?>">
                                            <i class="icon-reply"></i></a>|                                            <a href="?id=<?php echo htmlentities($row['id']);?>&action=delete" title="Delete" ><i class="icon-trash"></i></a>
											</td>
											</tr>

										<?php $cnt=$cnt+1; } ?>
										</tbody>
								</table>
							</div>
						</div>						

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->


    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reply to <span id="replyto"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea name="reply" cols="300" rows="4" id="reply">
</textarea>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" value="" id="id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="replybtn">Reply</button>
      </div>
    </div>
  </div>
</div>    
    
<?php include('shop_include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
    <script type="text/javascript">
  $(document).ready(function() {
    $(".reply").click(function() {
        var id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        $('#replyto').text(name);
        $('#id').val(id);
        $('#reply').val('');
    });   
    $("#replybtn").click(function() {
        var id = $('#id').val();
        var reply = $('#reply').val();
        $.ajax({
            type: "POST",
            url: 'contactus_reply_ajax.php',
            dataType: 'json',
            data: {id:id,reply:reply},
            success: function(data)
            {
                //alert("Response sent to the User");
                console.log("Success");
              $('#signupModal').modal('hide');
           }
       });
       $('#signupModal').modal('hide');
    });    
  });
  </script>
</body>
<?php } ?>