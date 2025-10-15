<?php
session_start();
error_reporting(0);
include('shop_include/config.php');
require_once('../includes/config.php');
require_once('../function.inc.php');
error_reporting(0);

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
      
		$target_dir = "../images/banners/";
		$pre = date("his");
		if(isset($_FILES["fileToUpload1"]["name"])) {
		$target_file = $target_dir . basename($pre."-".$_FILES["fileToUpload1"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		 if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file)) {
			$img_url1 = $pre."-".htmlspecialchars( basename( $_FILES["fileToUpload1"]["name"]));
		   // echo  htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
		  } 
		}else {
			$img_url1  = '';
		}
		if(isset($_FILES["fileToUpload2"]["name"])) {
			$target_file = $target_dir . basename($pre."-".$_FILES["fileToUpload2"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			 if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) {
				$img_url2 = $pre."-".htmlspecialchars( basename( $_FILES["fileToUpload2"]["name"]));
			   // echo  htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
			  } 
			}else {
				$img_url2  = '';
			}
				if(isset($_FILES["fileToUpload3"]["name"])) {
				$target_file = $target_dir . basename($pre."-".$_FILES["fileToUpload3"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
				 if (move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_file)) {
					$img_url3 = $pre."-".htmlspecialchars( basename( $_FILES["fileToUpload3"]["name"]));
				   // echo  htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
				  } 
				} else {
					$img_url3  = '';
				}
		$title = addslashes($_POST['plan_title']);
		$category = addslashes($_POST['category']);
		$plan_desc = addslashes($_POST['plan_desc']);
        $status = $_POST['status'];
        $features = implode("," ,$_POST['features']);
		if (isset($_POST['home_flag'])) {
		$home_flag = 1;
		} else {
			$home_flag = 0;
		}
        $query = "insert into plan_mst (`plan_title`, `category` , `plan_desc`,`features`, home_flag,  `banner1`, `banner2`, `banner3`,status, created_at) values(:title, '".$category."', :plan_desc,'$features','$home_flag', '$img_url1', '$img_url2', '$img_url3', '".$status."', NOW()) ";
		//$res =mysqli_query($con,$query);

		try {
		$query = $dbh->prepare($query);
		$query->bindParam(':title', $title, PDO::PARAM_STR);
		$query->bindParam(':plan_desc', $plan_desc, PDO::PARAM_STR);
		$res = $query->execute();
		$pid = $dbh->lastInsertId();
		$_SESSION['msg']="New Plan Created !!";
           // $pid = mysqli_insert_id($con);
            header('location:make-a-plan2.php?plan_id='.$pid.'&col=3');
	} catch(Exception $e) {
		$e->getMessage();
		echo "<br> Error-".$e->getMessage(); 
			$_SESSION['msg']="Failed to create a record !! <br>Error-".$e->getMessage(); 
	}
	/*
		if($id > 0) {
			$_SESSION['msg']="New Plan Created !!";
           // $pid = mysqli_insert_id($con);
            header('location:make-a-plan2.php?plan_id='.$pid.'&col=3');

		}else  {
			echo "<br> Error"; print_r($query->errorInfo());
			$_SESSION['msg']="Failed to create a record !!";
		} */
	}
	if(isset($_GET['del']))
	{
		mysqli_query($con,"delete from plans where id = '".$_GET['id']."'");
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
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>

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
                                <h3>Make A Plan</h3>
                            </div>
                            <div class="module-body">
                                <?php if(isset($_POST['submit']))
								{?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Well done!</strong>
                                    <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                                </div>
                                <?php } ?>
                                <?php if(isset($_GET['del']))
								{?>
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Oh snap!</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                                </div>
                                <?php } ?>
                                <br />

                                <!-- <form class="form-horizontal row-fluid" name="category" action="" method="post" enctype="multipart/form-data"> -->
                                <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Category</label>
                                        <div class="controls">
                                            <select name="category" required>
                                                <option value="">Select Category</option>
                                                <?php
												$category = getCategoryList();
                                                foreach($category as $k => $val) {?>
                                                <option value="<?php echo $k; ?>"><?php echo $val; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Plan Title</label>
                                        <div class="controls">
                                            <input type="text" placeholder="Enter Plan Title" name="plan_title"
                                                class="span8 tip" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Description</label>
                                        <div class="controls">
                                            <textarea class="span8" name="plan_desc" rows="5" id="pageContent"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Features</label>
                                        <div class="controls">
                                            <select name="features[]" multiple required>
                                                <option value="">Select Features</option>
                                                <?php
                                                $query=mysqli_query($con,"select * from plan_features");
                                                $cnt=1;
                                                while($row=mysqli_fetch_array($query))
                                                { ?>
                                                <option value="<?php echo $row['id']; ?>">
                                                    <?php echo htmlentities($row['feature_title']);?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Check to display on Home
                                            Page</label>
                                        <div class="controls">
                                            <input type="checkbox" name="home_flag" id="home_flag">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Banner1</label>
                                        <div class="controls">
                                            <input type="file" name="fileToUpload1" id="fileToUpload1"
                                                accept="image/png, image/jpg, image/jpeg"
                                                onchange="ValidateSingleInput(this);">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Banner2</label>
                                        <div class="controls">
                                            <input type="file" name="fileToUpload2" id="fileToUpload2"
                                                accept="image/png, image/jpg, image/jpeg"
                                                onchange="ValidateSingleInput(this);">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Banner3</label>
                                        <div class="controls">
                                            <input type="file" name="fileToUpload3" id="fileToUpload3"
                                                accept="image/png, image/jpg, image/jpeg"
                                                onchange="ValidateSingleInput(this);">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Status</label>
                                        <div class="controls">
                                            <label for="status0" class="lab">
                                                <input type="radio" name="status" id="status0" value="0" checked>
                                                InActive</label>
                                            <label for="status1" class="lab">
                                                <input type="radio" name="status" id="status1" value="1"> Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls"><br>
                                            <button type="submit" name="submit" class="btn"
                                                style="background:blue;color:#FFF;">Next</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->

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
    <link media="all" rel="stylesheet" type="text/css"
        href="../shop_admin/shop_assets/plugins/simditor/styles/simditor.css" />
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
            toolbar = ['title', 'bold', 'italic', 'underline', '|', 'ol', 'ul', 'blockquote', 'table',
                'link', '|', 'image', 'hr', 'indent', 'outdent', 'alignment'
            ];
            mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
            if (mobilecheck()) {
                toolbar = mobileToolbar;
            }
            allowedTags = ['br', 'span', 'a', 'img', 'b', 'strong', 'i', 'strike', 'u', 'font', 'p', 'ul',
                'ol', 'li', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'hr', 'table'
            ];
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