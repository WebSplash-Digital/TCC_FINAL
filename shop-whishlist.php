<?php
session_start();
error_reporting(0);

include('includes/config.php');
include('function.inc.php');
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

                <h3 class="pb-3 dasboard_heading">My Wishlists</h3>
                <?php

                // echo $_SESSION['id'];
                $userDeatils = getAllwishlistByUserId($_SESSION['id']);
               // print_r($userDeatils);
                
                ?>
               
                <div class="dashboard_body_cards">
                    <div class="table-responsive">
                        <table class="table wishlist_table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if(count($userDeatils)>0){

                                }
                                  foreach($userDeatils as $wishlist){
                                    $productDetails = getProductDetail($wishlist->productId);
                                        ?>
                                        <tr>
                                    <!-- <th scope="row">#1548</th> -->
                                    <td>
                                        <div class="wishlist_wrapper">
                                            <img src="admin/productimages/<?php echo $wishlist->productId . '/' . $productDetails[0]->productImage1; ?>" alt="">
                                            <p><?php echo $productDetails[0]->productName; ?></p>
                                        </div>
                                        </td>
                                    <td>T$<?php echo $productDetails[0]->productPrice; ?></td>
                                    <td>Out of stock</td>
                                    <td>
                                    <div class="wishlist_actions">
                                            <a href="#" onclick="moveToCart(<?php echo $wishlist->productId;?>,<?php echo $wishlist->id;?>)"><span class="material-symbols-outlined"> shopping_cart </span>Add to cart</a>
                                            <a href="#" onclick="removeWishlist(<?php echo $wishlist->id;?>)"><span class="material-symbols-outlined"> delete </span> Remove</a>
                                        </div>  
                                    </td>
                                </tr>
                                        <?php
                                  }   
                                ?>
                            </tbody>
                        </table> 
                        <?php
                        if(count($userDeatils)<= 0){
                            ?>
                         <p class="cartempty">Your Wishlist is empty </p>
                        <?php
                        }
                        ?>
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

    //Move to cart
    function moveToCart(pid,id){
       
        $.ajax({
            type: "POST",
            url: "product-details.php",
            data: {'action':'moveTocart','productId':pid,'id':id},
           // dataType: "text",
            success: function(resultData) {
                alert('Iteam has been move to cart');
                document.location ='shop-cart.php';
              
                
            }
        });

    }
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