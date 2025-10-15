<?php
session_start();
error_reporting(0);
  $url = $_SERVER['REQUEST_URI'];
  $urliSegment = explode('/',$url);
  

include('includes/config.php');
include('function.inc.php');
if(!isset($_SESSION['id'])){
    header("Location: ".BASE_URL."/login.php");
 }

$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$orderid = $uriSegments[3]; //returns bar
// echo $orderid;
$orderDetails = getConfirmationDeatils($orderid);
 //print_r($orderDetails);
// echo $orderDetails[0]->id;

?>
<!doctype html>

<html>

<head>

    <meta charset="utf-8">
    <title>Shop - My Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/dashboard.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>./css/header.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>./css/dashboard.css">
</head>
<!--HEADER START-->
<?php include_once('includes/head_new.php');
?>
<!--HEADER END-->

<body class="theme-style-1">
    <a class="btn btn-primary d-block d-lg-none m-2" data-bs-toggle="offcanvas" href="#offcanvasSidebar" role="button" aria-controls="offcanvasExample">
        Show Profile Menu
    </a>

    <div class="container mt-5">
        <div class="row tcc_dashboard">
            <div class="col-md-4 tcc_sidebar">
                <?php include_once('includes/shop-dashboard-menu.php');
                ?>
            </div>
            <div class="col-lg-8 tcc_dashboard_body my_orders">

                <h3 class="pb-3 dasboard_heading">Order Details</h3>
                <div class="dashboard_body_cards">
                    <div class="order_snapshot">
                        <h3 class="subtitle_text">Order#<?php echo $orderDetails[0]->id; ?></h3>
                        <a href="#">Track Order</a>
                    </div>
                    <div class="order_info">
                        <ul>
                            <li>
                                <p>Order No:</p>
                                <span>#<?php echo $orderDetails[0]->id; ?></span>
                            </li>
                            <li>
                                <p>Order Date</p>
                                <span><?php echo $orderDetails[0]->orderDate; ?></span>
                            </li>
                            <li>
                                <p>Status</p>
                                <span><?php echo $orderDetails[0]->orderStatus; ?></span>
                            </li>
                            <li>
                                <p>Amount</p>
                                <span>$<?php echo $orderDetails[0]->total_amount+20+10; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="dashboard_body_cards">
                    <?php
                  
                     $orderData = getOrderDetailsById($urliSegment[3]);
                     //print_r($orderDetails);
                    ?>
                    <h3 class="subtitle_text mb-5">Order Items <span>(<?php echo count($orderDetails)?>)</span></h3>
                    <?php  
                    foreach ($orderData as $productList){
                        
                        ?>
                           <div class="detailed_order_info">
                        <div class="wishlist_wrapper">
                        <?php
                                  $productDeatils = getProductDetail($productList->product_id);
                                  //print_r($productDeatils[0]->productName);
                                ?> 
                            <img src="<?php echo BASE_URL?>/admin/productimages/<?php echo $productList->product_id.'/'.$productDeatils[0]->productImage1;?>" alt="">
                            <div class="order_info_wrapper">
                               
                                <p><?php echo $productDeatils[0]->productName;?></p>
                                <p>QTY: <span><?php echo $productList->Qty;?></span></p>
                            </div>
                        </div>
                        <p class="order_item_price">$ <?php echo $productList->Amount;?></p>
                    </div>
                        <?php
                    }
                    ?>
                    
                   
                </div>
                <div class="dashboard_body_cards">
                    <h3 class="subtitle_text mb-5">Order Total</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            Subtotal
                            <span class="">$<?php echo $orderDetails[0]->total_amount; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            Tax
                            <span class="">$20</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            Shipping
                            <span class="">$10</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold p-3">
                            Total
                            <span class="fw-bold">$<?php echo $orderDetails[0]->total_amount+20+10; ?></span>
                        </li>
                    </ul>

                </div>
                <?php
                //print_r($orderDetails[0]);die;
                ?>
                <div class="dashboard_body_cards">
                    <h3 class="subtitle_text mb-5">Billing & Shipping Details</h3>
                    <div class="shipiing_wrapper">
                        <div class="shipping_details">
                            <h3>Billing Address:</h3>
                            <p><?php echo $orderDetails[0]->Shipping_name;?> <br><?php echo $orderDetails[0]->shipping_postcode?> <?php echo $orderDetails[0]->shipping_address ?>, <?php echo $orderDetails[0]->shipping_shburb ?>, <?php echo $orderDetails[0]->shipping_city ?>,<?php echo $orderDetails[0]->shipping_state ?></p>
                        </div>
                        <div class="shipping_details">
                            <h3>Shipping Address:</h3>
                            <p><?php echo $orderDetails[0]->Shipping_name;?> <br><?php echo $orderDetails[0]->shipping_postcode?> <?php echo $orderDetails[0]->shipping_address ?>, <?php echo $orderDetails[0]->shipping_shburb ?>, <?php echo $orderDetails[0]->shipping_city ?>,<?php echo $orderDetails[0]->shipping_state ?></p>
                        </div>
                        <div class="shipping_details">
                            <h3>Shipping Method:</h3>
                            <p>Standard Shipping</p>
                            <h3>Payment Method:</h3>
                            <p>Debit Mastercard</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
    const input = document.querySelector("#phone");
    window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
    });
</script>
<script>
    let picturePreview = document.querySelector(".imagePreview");
    let actionButton = document.querySelector(".action-button");
    let fileInput = document.querySelector("input[name='fileInput']");
    let fileReader = new FileReader();

    const DEFAULT_IMAGE_SRC = "https://www.drupal.org/files/profile_default.png";

    actionButton.addEventListener("click", (event) => {
        if (picturePreview.src !== DEFAULT_IMAGE_SRC) {
            resetImage();
        } else {
            fileInput.click();
        }
        event.preventDefault(); // Prevent the default behavior of the button
    });

    fileInput.addEventListener("change", () => {
        if (fileInput.files && fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];
            const maxFileSize = 5242880; // 5MB

            if (allowedTypes.includes(selectedFile.type) && selectedFile.size <= maxFileSize) {
                refreshImagePreview();
            } else {
                alert("Please select a PNG or JPG file that is no larger than 5MB.");
                fileInput.value = ""; // Clear the file input
            }
        }
    });

    function resetImage() {
        setActionButtonMode("upload");
        picturePreview.src = DEFAULT_IMAGE_SRC;
        fileInput.value = "";
    }

    function setActionButtonMode(mode) {
        let modes = {
            "upload": function() {
                actionButton.innerText = "Upload Image";
                actionButton.classList.remove("mode-remove");
                actionButton.classList.add("mode-upload");
            },
            "remove": function() {
                actionButton.innerText = "Remove Image";
                actionButton.classList.remove("mode-upload");
                actionButton.classList.add("mode-remove");
            }
        }
        return (modes[mode]) ? modes[mode]() : console.error("unknown mode");
    }

    function refreshImagePreview() {
        if (picturePreview.src !== DEFAULT_IMAGE_SRC) {
            picturePreview.src = DEFAULT_IMAGE_SRC;
        }

        if (fileInput.files && fileInput.files.length > 0) {
            fileReader.readAsDataURL(fileInput.files[0]);
            fileReader.onload = (e) => {
                picturePreview.src = e.target.result;
                setActionButtonMode("remove");
            }
        }
    }

    refreshImagePreview();
</script>


<script>
    // Get all elements with the class "more-button"
    var buttons = document.querySelectorAll('.more-button');

    // Add a click event listener to each button
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Find the parent list container for this button
            var container = button.closest('.list-container');

            // Close all open menus
            document.querySelectorAll('.list-container.active').forEach(function(openContainer) {
                if (openContainer !== container) {
                    openContainer.classList.remove('active');
                }
            });

            // Toggle the "active" class for the specific container
            if (container) {
                container.classList.toggle('active');
            }
        });
    });
</script>
<script>
    var myOffcanvas = document.getElementById('offcanvasSidebar')
    var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)

    /*
    var btnToggle = document.getElementById('btnOffcanvasToggle')

    btnToggle.addEventListener('click', function (event) {
    	bsOffcanvas.toggle();
    });
    */


    // Define our viewportWidth variable
    var viewportWidth;

    // Set/update the viewportWidth value
    var setViewportWidth = function() {
        viewportWidth = window.innerWidth || document.documentElement.clientWidth;
    }

    // Log the viewport width into the console
    var logWidth = function() {
        if (viewportWidth < 1024) {
            myOffcanvas.classList.add('offcanvas', 'offcanvas-start');
        } else {
            myOffcanvas.classList.remove('offcanvas', 'offcanvas-start');
            myOffcanvas.style.visibility = 'visible';
        }
    }

    // Set our initial width and log it
    setViewportWidth();
    logWidth();

    // On resize events, recalculate and log
    window.addEventListener('resize', function() {
        setViewportWidth();
        logWidth();
    }, false);
</script>