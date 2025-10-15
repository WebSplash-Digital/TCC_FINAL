<?php
session_start();
include('shop_include/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
}
else
{
	
	if(isset($_POST['submit']))
	{
		$adminid=$_SESSION['jpaid'];
      	$AName=$_POST['adminname'];
      	$MobileNumber=$_POST['mobilenumber'];
      	$email=$_POST['email'];

      	$sql=mysqli_query($con,"UPDATE `tbladmin` SET `AdminName`='$AName',`MobileNumber`='$MobileNumber',`Email`='$email' WHERE `ID`='$adminid'");

		$sql1=mysqli_query($con,"UPDATE `admin` SET `AdminName`='$AName',`MobileNumber`='$MobileNumber',`Email`='$email' WHERE `id`='$adminid'");

		$_SESSION['msg']="Profile Updated !!";
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Edit Profile</title>
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

						<div class="module">
							<div class="module-head">
								<h3>Edit Profile</h3>
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
								<?php
			                        $username = $_SESSION['alogin']; 

			                        $query=mysqli_query($con,"SELECT * from admin where username='$username'");
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{             
			                     ?>
								<form class="form-horizontal row-fluid" name="admin" method="post">
									<div class="control-group">
										<label class="control-label" for="basicinput">Admin Name</label>
										<div class="controls">
											<input type="text" placeholder="Enter Admin Name" name="adminname" value="<?php echo htmlentities($row['AdminName']);?>" class="span8 tip" required>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="basicinput">User Name</label>
										<div class="controls">
											<input type="text" placeholder="Enter User Name"  name="username" value="<?php echo htmlentities($row['username']);?>" class="span8 tip" readonly="true">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="basicinput">Contact Number</label>
										<div class="controls">
											<input type="text" placeholder="Enter Mobile Number"  name="mobilenumber" value="<?php echo htmlentities($row['MobileNumber']);?>" class="span8 tip" required>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="basicinput">Email</label>
										<div class="controls">
											<input type="text" placeholder="Enter Email"  name="email"  value="<?php echo htmlentities($row['Email']);?>" class="span8 tip" required>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<button type="submit" name="submit" class="btn">Update</button>
										</div>
									</div>
								</form>
							<?php } ?>
							</div>
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
		});
	</script>
</body>
<?php } ?>