<?php
ob_start();
session_start();
include('shop_include/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
}
else
{
	date_default_timezone_set('Asia/Kolkata');// change according timezone
	$currentTime = date( 'd-m-Y h:i:s A', time () );
	if(isset($_POST['submit']))
	{
		$name = $_POST['option_name'];
		$value = $_POST['option_value'];
        $status = $_POST['status'];

        if(isset($_POST['id']) && $_POST['id']> 0 ) {
       echo "<br>Query:".     $sql =  "update config_options set  option_name = '$name', option_value ='$value', status = '$status', updated_at = NOW() where option_id = '".$_POST['id']."'";
            $result =mysqli_query($con, $sql);
            if($result ==1) {
                $_SESSION['msg']="Admin option Updated !!";
            } else  {
                echo "<br> Eror".mysqli_error($con);
                $_SESSION['msg']="Failed to update a Admin Option !!";
            }
        } else {
            $sql =  "insert into config_options(option_name ,option_value, status, created_at) values('$name','$value', 1, NOW())";
            $result =mysqli_query($con, $sql);
            if($result ==1) {
                $_SESSION['msg']="Admin option Created !!";
            }else  {
                echo "<br> Eror".mysqli_error($con);
                $_SESSION['msg']="Failed to create a Admin Option !!";
            }
        }
		//$_SESSION['msg']="New Admin Config Setting Created !!";
	}
	if(isset($_GET['del']) && ($_GET['del']== 'delete'))
	{
       
		mysqli_query($con,"delete from config_options where option_id = '".$_GET['id']."'");
        $_SESSION['delmsg']="Config Setting deleted !!";
	} elseif(isset($_GET['del']) && ($_GET['del']== 'edit'))
	{
       $query = "select * from config_options where option_id='".$_GET['id']."'";
        $result = mysqli_query($con, $query);
        $row=mysqli_fetch_array($result);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Config Admin</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="css/custom.css" rel="stylesheet">
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
								<h3>Config Admin</h3>
							</div>
							<div class="module-body">
								<?php if(isset($_POST['submit']))
								{?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								<?php
                                 header('Refresh: 3; URL=config_admin.php');
                                } 
                                if(isset($_GET['del']) && $_GET['del'] == 'del' )
								{?>								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
								</div>
								<?php
                                  header('Refresh: 3; URL=config_admin.php');
                                 } ?>
								<br/>
								<form class="form-horizontal row-fluid" name="Category" method="post">
									<div class="control-group">
										<label class="control-label" for="basicinput">Option Variable</label>
										<div class="controls">
											<input type="text" placeholder="Enter Variable Name"  name="option_name" class="span8 tip" required  
                                            <?php if(isset($_GET['del']) && ($_GET['del']== 'edit')) { ?>
                                        value="<?=$row['option_name']?>"
                                        <?php } ?>
                                            >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="basicinput">Option Value</label>
										<div class="controls">
                                        <input type="text" placeholder="Enter Variable Value"  name="option_value" 
                                        <?php if(isset($_GET['del']) && ($_GET['del']== 'edit')) { ?>
                                        value="<?=$row['option_value']?>" 
                                        <?php } ?>  required>
										</div>
									</div>

                                    <div class="control-group">
										<label class="control-label" for="basicinput">Status</label>
										<div class="controls">
                                            <span style="margin:-1px">
                                        <label for="status0" class="lab">
                                        <input type="radio" name="status" id="status0" value="0" <?php if(isset($_GET['del']) && ($_GET['del']== 'edit') && ($row['status'] == 0)) { ?> checked<?php } ?> required> Not Published</label> </span>
                                        <span style="margin:1px">
                                        <label for="status1" class="lab">
									    <input type="radio" name="status" id="status1" value="1"  <?php if(isset($_GET['del']) && ($_GET['del']== 'edit') && ($row['status'] == 1)) { ?> checked<?php } ?>>Active </label></span> 
										</div>
									</div>

									<div class="control-group">
										<div class="controls">
                                       <?php if(isset($_GET['del']) && ($_GET['del']== 'edit')) { ?>
                                        <input type="hidden" name="id" value="<?=$row['option_id']?>"> 
                                        <?php } ?>
											<button type="submit" name="submit" class="btn">Create</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="module">
							<div class="module-head">
								<h3>Manage Config Admin</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Config Variable</th>
											<th>Config Value</th>
											<th>Config Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

									<?php $query=mysqli_query($con,"select * from config_options");
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{
									?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['option_name']);?></td>
											<td><?php echo htmlentities($row['option_value']);?></td>
											<td> <?php echo htmlentities($row['status']);?></td>
											<td>
											<a href="config_admin.php?id=<?php echo $row['option_id']?>&del=edit" ><i class="icon-edit"></i></a>
											<a href="config_admin.php?id=<?php echo $row['option_id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
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
		} );
	</script>
</body>
<?php } ?>