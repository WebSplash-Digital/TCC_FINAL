<?php
session_start();
// include('includes/dbconnection.php');

include('shop_include/config.php');

if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
}
else
{
require_once('shop_include/config.php');	
if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	$productpricebd=$_POST['productpricebd'];
	$productdescription=$_POST['productDescription'];
	$productscharge=$_POST['productShippingcharge'];
	$productavailability=$_POST['productAvailability'];
	$productimage1=$_FILES["productimage1"]["name"];
	$productimage2=$_FILES["productimage2"]["name"];
	$productimage3=$_FILES["productimage3"]["name"];
	
	if (isset($_POST['bestseller'])) {
		$bestseller = 1;
	}  else { $bestseller= 0; }
	if (isset($_POST['new_arrival'])) {
		$new_arrival= 1;
	} else { $new_arrival= 0; }
	if (isset($_POST['popularity'])) {
		$popularity = 1;
	} else {
		$popularity = 0;
	}
	//for getting product id
	$query=mysqli_query($con,"select max(id) as pid from products");
	$result=mysqli_fetch_array($query);
	 $productid=$result['pid']+1;
	$dir="productimages/$productid";
	if(!is_dir($dir)){
		
		mkdir("productimages/".$productid);
	}

	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productid/".$_FILES["productimage1"]["name"]);
	move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productid/".$_FILES["productimage2"]["name"]);
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productid/".$_FILES["productimage3"]["name"]);
$sql = "insert into products(category,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount, bestseller, new_arrival,popularity) values('$category',:productname,:productcompany,'$productprice',:productdescription,'$productscharge','$productavailability','".$productimage1."','".$productimage2."','".$productimage3."','$productpricebd', '$bestseller','$new_arrival','$popularity')";
// $sql=mysqli_query($con,$sql);
// $query=mysqli_query($con,$sql);
$query = $dbh->prepare($sql);
// $query = $con->prepare($sql);
$query->bindParam(':productname', $productname, PDO::PARAM_STR);
$query->bindParam(':productcompany', $productcompany, PDO::PARAM_STR);
$query->bindParam(':productdescription', $productdescription, PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Product Inserted Successfully !!";

if(mysqli_errno($con) > 0) {
	echo mysqli_error($con);

}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin| Insert Product</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="css/custom.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
    bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>

    <script>
    function getSubcat(val) {
        $.ajax({
            type: "POST",
            url: "get_subcat.php",
            data: 'cat_id=' + val,
            success: function(data) {
                $("#subcategory").html(data);
            }
        });
    }

    function selectCountry(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
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
                                <h3>Insert Product</h3>
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

                                <form class="form-horizontal row-fluid" name="insertproduct" method="post"
                                    enctype="multipart/form-data">

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Category</label>
                                        <div class="controls">
                                            <select name="category" class="span8 tip" required>
                                                <option value="">Select Category</option>
                                                <?php $query=mysqli_query($con,"select * from category");
														while($row=mysqli_fetch_array($query))
														{?>

                                                <option value="<?php echo $row['id'];?>">
                                                    <?php echo $row['categoryName'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>





                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Name</label>
                                        <div class="controls">
                                            <input type="text" name="productName" placeholder="Enter Product Name"
                                                class="span8 tip" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Company</label>
                                        <div class="controls">
                                            <input type="text" name="productCompany"
                                                placeholder="Enter Product Comapny Name" class="span8 tip" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Price Before
                                            Discount</label>
                                        <div class="controls">
                                            <input type="text" name="productpricebd" placeholder="Enter Product Price"
                                                class="span8 tip" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Price After
                                            Discount(Selling Price)</label>
                                        <div class="controls">
                                            <input type="text" name="productprice" placeholder="Enter Product Price"
                                                class="span8 tip" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Description</label>
                                        <div class="controls">
                                            <textarea name="productDescription" placeholder="Enter Product Description"
                                                rows="6" class="span8 tip"></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Shipping Charge</label>
                                        <div class="controls">
                                            <input type="text" name="productShippingcharge"
                                                placeholder="Enter Product Shipping Charge" class="span8 tip" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Availability</label>
                                        <div class="controls">
                                            <select name="productAvailability" id="productAvailability"
                                                class="span8 tip" required>
                                                <option value="">Select</option>
                                                <option value="In Stock">In Stock</option>
                                                <option value="Out of Stock">Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Image1</label>
                                        <div class="controls">
                                            <input type="file" name="productimage1" id="productimage1" value=""
                                                class="span8 tip" accept="image/png, image/jpg, image/jpeg"
                                                onchange="ValidateSingleInput(this);" required>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Image2</label>
                                        <div class="controls">
                                            <input type="file" name="productimage2" class="span8 tip"
                                                accept="image/png, image/jpg, image/jpeg"
                                                onchange="ValidateSingleInput(this);" required>
                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Image3</label>
                                        <div class="controls">
                                            <input type="file" name="productimage3" class="span8 tip"
                                                accept="image/png, image/jpg, image/jpeg"
                                                onchange="ValidateSingleInput(this);">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Filter </label>
                                        <div class="controls">
                                            <span style="margin:1px">
                                                <label for="bestseller" class="lab">
                                                    <input type="checkbox" name="bestseller" id="bestseller"> BestSeller
                                                </label>
                                            </span>
                                            <span style="margin:1px"><label for="new_arrival" class="lab">
                                                    <input type="checkbox" name="new_arrival" id="new_arrival"> New
                                                    Arrival</label>
                                            </span>
                                            <span style="margin:1px"><label for="popularity" class="lab">
                                                    <input type="checkbox" name="popularity" id="popularity"> Popularity
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" name="submit" class="btn">Insert</button>
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