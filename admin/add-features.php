<?php
session_start();
include('shop_include/config.php');


$latest_news_category = array(
    1 => 'Mobile',
    2 => 'Laptop',
    3 => 'Internet',
    4 => 'Broadband');
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
		$title = addslashes($_POST['feature_title']);
        $status = $_POST['status'];
        $query = "insert into plan_features(`feature_title`, `status`, `created_at`) values('$title',  '$status' , NOW()) ";
		$res =mysqli_query($con,$query);
		if($res ==1) {
			$_SESSION['msg']="News Created !!";
		}else  {
			echo "<br> Error".mysqli_error($con);
			$_SESSION['msg']="Failed to create a record !!";
		}
	}
	if(isset($_GET['del']))
	{
		mysqli_query($con,"delete from plan_features where id = '".$_GET['id']."'");
        $_SESSION['delmsg']="Category deleted !!";
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Latest News</title>
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
								<h3>Add Latest News</h3>
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
								<!-- <form class="form-horizontal row-fluid" name="category" action="" method="post" enctype="multipart/form-data"> -->
                                <form action="<?=$_SERVER['PHP_SELF']?>" method="post" >
								
								                                 <div class="control-group">
										<label class="control-label" for="basicinput">Feature Title</label>
										<div class="controls">
											<input type="text" placeholder="Enter News Title"  name="feature_title" class="span8 tip" required>
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="basicinput">Status</label>
										<div class="controls">
                                            <span style="margin:-1px">
                                        <label for="status0" class="lab">
                                        <input type="radio" name="status" id="status0" value="0" checked> In Active</label> </span>
                                        <span style="margin:1px">
                                        <label for="status1" class="lab">
									    <input type="radio" name="status" id="status1" value="1"> Active </label></span> 
										</div>
									</div>
                              
									
									<div class="control-group">
										<div class="controls">
											<button type="submit" name="submit" class="btn">Create</button>
										</div>
									</div>
								</form>
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
	<link media="all" rel="stylesheet" type="text/css"
      href="../shop_admin/shop_assets/plugins/simditor/styles/simditor.css"/>
<script src="../shop_admin/shop_assets/plugins/simditor/scripts/mobilecheck.js"></script>
<script src="../shop_admin/shop_assets/plugins/simditor/scripts/module.js"></script>
<script src="../shop_admin/shop_assets/plugins/simditor/scripts/uploader.js"></script>
<script src="../shop_admin/shop_assets/plugins/simditor/scripts/hotkeys.js"></script>
<script src="../shop_admin/shop_assets/plugins/simditor/scripts/simditor.js"></script>
<script>
    (function() {
        $(function() {
            var $preview, editor, mobileToolbar, toolbar, allowedTags;
            Simditor.locale = 'en-US';
            toolbar = ['title', 'bold','italic','underline','|','ol','ul','blockquote','table','link','|','image','hr','indent','outdent','alignment'];
            mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
            if (mobilecheck()) {
                toolbar = mobileToolbar;
            }
            allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
            editor = new Simditor({
                textarea: $('#pageContent'),
                placeholder: '',
                toolbar: toolbar,
                toolbarFloat: false,
                pasteImage: false,
                defaultImage: '../shop_admin/shop_assets/plugins/simditor/images/image.png',
                upload: false,
                allowedTags: allowedTags
            });
            $preview = $('#preview');
            if ($preview.length > 0) {
                return editor.on('valuechanged', function(e) {
                    return $preview.html(editor.getValue());
                });
            }
        });
    }).call(this);
</script>
</body>
<?php } ?>