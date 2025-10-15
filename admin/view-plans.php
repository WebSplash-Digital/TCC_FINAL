<?php
session_start();
error_reporting(0);
include('shop_include/config.php');

if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
}
else
{
	date_default_timezone_set('Asia/Kolkata');// change according timezone
	$currentTime = date( 'd-m-Y h:i:s A', time () );

	if(isset($_GET['del']) && $_GET['del'] == 'delete') {
		mysqli_query($con,"delete from plan_mst where id = '".$_GET['id']."'");
		mysqli_query($con,"delete from plan_details where plan_id = '".$_GET['id']."'");
		header('location:view-plans.php?id='.$_GET['id']);
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Category</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
<?php include('shop_include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
			<?php include('shop_include/sidebar.php');?>				
				<div class="span9">
					<div class="content">
                        <!--
						<div class="module">
							<div class="module-head">
								<h3>Category</h3>
							</div>
							<div class="module-body">
								<?php if(isset($_POST['submit']))
								{?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								<?php } ?>
								<?php if(isset($_GET['del']))
								{?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
								</div>
								<?php } ?>
								<br/>
								<form class="form-horizontal row-fluid" name="Category" method="post">
									<div class="control-group">
										<label class="control-label" for="basicinput">Category Name</label>
										<div class="controls">
											<input type="text" placeholder="Enter category Name"  name="category" class="span8 tip" required>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="basicinput">Description</label>
										<div class="controls">
											<textarea class="span8" name="description" rows="5"></textarea>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<button type="submit" name="submit" class="btn">Create</button>
										</div>
									</div>
								</form>
							</div>
						</div>  -->
						<div class="module">
							<div class="module-head">
							<h3 style="display: inline">View plans</h3> <span style="float: right !important;"><a href="make-a-plan.php"  style="color:#FFF;"><button class="btn btn-default" style="background:grey;">Make A New Plan</<button></a>
			
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Feature</th>
											<th>Status</th>
											<th>Creation date</th>
										<!--	<th>Last Updated</th> -->
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

									<?php $query=mysqli_query($con,"select * from plan_mst");
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{
									?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['plan_title']);?></td>
											<td> <?php echo ($row['status']) ? "Active" : "InActive"; ;?></td>
											<td> <?php echo htmlentities($row['created_at']);?></td>
											<td>
											<a href="edit-plan_mst.php?id=<?php echo $row['id']?>&del=edit" ><i class="icon-edit"></i></a>
											<a href="view-plans.php?id=<?php echo $row['id']?>" ><i class="icon-list" title="View Plan Details"></i></a>
											<!-- <a href="view-plans.php?id=< ?php echo $row['id']?>&del=edit" ><i class="icon-edit"></i></a> -->
											<a href="view-plans.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a> 
											<!-- <a href="edit-plan.php?id=< ?php echo $row['id']?>" ><i class="icon-edit"></i></a> 
											<a href="edit-plan.php?id=< ?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a>  --></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
							<hr>
							<?php
                            if(isset($_GET['id'])) {
							$query=mysqli_query($con,"SELECT * FROM plan_details where plan_id = ".$_GET['id']);
							$cnt=1;
							while($row=mysqli_fetch_array($query))
							{
								//echo "<br>".$cnt;
								if($row['sub_id'] == 1) {
									$header[] = $row['plan_option'];
								}
								$sub[$row['sub_id']] = $row['sub_id'];
								$values[$row['plan_option']][$row['sub_id']] = $row['plan_value'];
								$id[$row['plan_option']][$row['sub_id']] = $row['id'];
								$cnt++;
							}
							?>
							 <form class="form-horizontal row-fluid" name="category" action="edit-plan-details.php" method="post" > 
							 <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-responsive table-bordered table-striped display" width="100%">
									<thead>
										<tr>
							
							<?php
							foreach($header as $k => $v) {
								echo "<th> $v</th>";	
							}
							echo "</tr></thead>";
							foreach($sub as $k => $v) {
								//echo "<tr><td>$k -> $v</td></tr>";	
								echo "<tr>";	
								 foreach($header as  $hk => $hv) {
									//echo "<td>".$hk."</td>";	
									//$k -- $hk --  $hv ----
									if(isset($_GET['del']) && $_GET['del'] == 'edit') {
										echo "<td><input type='text' name='option[]' value='".$values[$hv][$v]."' size='10'>";	
										echo "<input type='hidden' name='id[]' value='".$id[$hv][$v]."' size='4'></td>";	
										
									} else {
									echo "<td> ".$values[$hv][$v]."</td>";	
									}
								}
								 echo "</tr>";	
								
							}
							//echo "<pre>";
							//print_r($values);
							//echo "</pre>";
							if(isset($_GET['del']) &&  $_GET['del'] == 'edit') {
									echo ' <tfoot><tr><th colspan="4"><center><button type="submit" name= "s1"  class="btn btn-default" style="background:grey;color:#FFF">Edit Plan</button></center></td></th> <tfoot></form>';
									
							} 
							echo "</table>";
                        }
							?>

							<hr>
						</div>
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

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
</body>
<?php } ?>