<?php
ob_start(); 
session_start();
error_reporting(0);
include('shop_include/config.php');
require_once('../includes/config.php');
require_once('../function.inc.php');

$latest_news_category = getCategoryList();

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
       
       /* -- */
    if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"] !='') {

      //  die("Image uploaded");
    $target_dir = "../images/latest-news/";
    $pre = date("his");
    $target_file = $target_dir . basename($pre."-".$_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
   
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
       // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
      //  echo "File is not an image.";
        $uploadOk = 0;
      }
   
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 2000000) {
   //   echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
     // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
		$img_url = "";
        $img = " ";
    //  echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {

      //  echo "<h1>#Filen - ".$_FILES["fileToUpload"]["tmp_name"]."</h1>";
      //  echo "<h1>@Filen -".$target_file."</h1>";
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		$img_url = $pre."-".htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
       // htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      $img = "  title_image = '$img_url', ";

      } else {
		$img = " ";
       // echo "Sorry, there was an error uploading your file.";
      }
    }
   
} else {
    $img = " ";
}
	   /* -- */
		$category =$_POST['category'];
		$title = addslashes($_POST['title']);
        $excerpt = addslashes($_POST['excerpt']);
		$description = addslashes($_POST['description']);
		//$image = $img_url;
        $status = $_POST['status'];
        $id =  $_POST['id'];
		try {	
			$query = "update latest_news set category ='$category', title =:title, excerpt = :excerpt,   description = :description, $img  status = $status, updated_at = NOW() where id = '$id'";
			$query = $dbh->prepare($query);
			$query->bindParam(':title', $title, PDO::PARAM_STR);
			$query->bindParam(':excerpt', $excerpt, PDO::PARAM_STR);
			$query->bindParam(':description', $description, PDO::PARAM_STR);
			$res = $query->execute();
			$_SESSION['msg']="News Updated !!";
		} catch (Exception $e) {
			$_SESSION['msg']="Failed to create a record !! . Error".$e->getMessage();
		}

	}
	if(isset($_GET['del']))
	{
		mysqli_query($con,"delete from latest_news where id = '".$_GET['id']."'");
        $_SESSION['delmsg']="News deleted !!";
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
								<h3>Edit Latest News</h3>
							</div>
							<div class="module-body">
								<?php if(isset($_POST['submit']))
								{?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								<?php header('Refresh: 3; URL=latest-news.php'); } 
								 if(isset($_GET['del']))
								{?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                                    <?php
                                    header('Refresh: 3; URL=latest-news.php'); ?>
								</div>
								<?php } ?>
								<br/>
								<!-- <form class="form-horizontal row-fluid" name="category" action="" method="post" enctype="multipart/form-data"> -->
                                <form action="edit-latest-news.php" method="post" enctype="multipart/form-data">
								<?php
                                if($_POST) {
                                    $id=intval($_POST['id']);
                                } else {
                                     $id=intval($_GET['id']);
                                }
                            $query=mysqli_query($con,"select * from latest_news where id='$id'");
                            while($row=mysqli_fetch_array($query))
                            {
                                ?>	
								<div class="control-group">
										<label class="control-label" for="basicinput">Category</label>
										<div class="controls">
											<select name="category" required>
                                            <option value="">Select Category</option>
                                                <?php
                                                
                                                foreach($latest_news_category as $k => $val) {?>
                                                <option value="<?php echo $val; ?>" <?php if($row['category'] ==$val ) { echo "selected";}?>><?php echo $val; ?></option>
                                                <?php } ?>
                                            </select>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="basicinput">Title</label>
										<div class="controls">
											<input type="text" placeholder="Enter News Title"  name="title" class="span8 tip" value="<?=$row['title']?>" required>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="basicinput">Excerpt</label>
										<div class="controls">
											<input type="text" placeholder="Enter News Excerpt"  name="excerpt" class="span8 tip"  value="<?=$row['excerpt']?>" required>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="basicinput">Description</label>
										<div class="controls">
											<textarea class="span8" name="description" rows="5" id="pageContent"><?=htmlentities($row['description'])?></textarea>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="basicinput">Status</label>
										<div class="controls">
                                            <span style="margin:1px">
                                        <label for="status0" class="lab">
                                        <input type="radio" name="status" id="status0" value="0" <?php if($row['status'] == 0 ) { echo "checked";}?>> Not Published</label> </span>
                                        <span style="margin:1px">
                                        <label for="status1" class="lab">
									    <input type="radio" name="status" id="status1" value="1" <?php if($row['status'] == 1 ) { echo "checked";}?>>  Published </label></span> 
										</div>
									</div>
                              
									<div class="control-group">
                                        
										<label class="control-label" for="basicinput">Image</label>
										<div class="controls">
                                        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/png, image/jpg, image/jpeg" onchange="ValidateSingleInput(this);">
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
                                            <input type="hidden" name="id" value="<?=$row['id']?>">
											<button type="submit" name="submit" class="btn" id="submitBtn" style="background:darkblue;color:#FFF;">Update</button>
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

			var _URL = window.URL || window.webkitURL;		
			$("#fileToUpload").change(function(e) {
				var image, file;
				if ((file = this.files[0])) {
					image = new Image();
					image.onload = function() {
						//alert("The image width is " +this.width + " and image height is " + this.height);
						// 800 * 300
						if((this.width > 750 && this.width< 850) && (this.height > 275 && this.height< 325)) {
							$('#submitBtn').removeAttr('disabled');
						} else {
							$("#fileToUpload").val();
							$("#submitBtn").prop('disabled', true);
							alert("Invalid Image Size \n Upload the image of 800 * 300 PX ");
						}
					};
					image.src = _URL.createObjectURL(file);
				}
			});
        });
    }).call(this);
</script>
<!-- validation of file upload--->
<script>
    var _validFileExtensions = [".png", ".jpg", ".jpeg"];

    function ValidateSingleInput(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() ==
                        sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("File is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }
    </script>
    <!-- validation of file upload end--->
</body>
<?php } ?>