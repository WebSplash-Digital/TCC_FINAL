<?php
// session_start();
//error_reporting(E_ALL);

 
// include_once('function.inc.php');


?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="./css/header.css">
<!-- <link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/custom.css">
<link rel="stylesheet" href="./css/responsive.css">
<link rel="stylesheet" href="./css/bootstrap.css">
<link rel="stylesheet" href="./css/color.css"> -->
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<nav> 
    <ul class="menu">

        <li class="logo"><a href="#"><img src="./images/logo.png" alt=""></a></li>
        <li class="item"><a href="index.php">Home</a></li>
        <li class="item"><a href="<?php echo BASE_URL?>services.php">Services</a></li>
        <li class="item"><a href="<?php echo BASE_URL?>shop-page.php">Shop</a></li>
        <li class="item"><a href="<?php echo BASE_URL?>promotions.php">Promos</a></li>
        <li class="item"><a href="<?php echo BASE_URL?>careers.php">Careers</a></li>
        <li class="item has-submenu">
            <a tabindex="0">Help</a>
            <ul class="submenu">
                <li class="subitem"><a href="#">Kalianet Usage</a></li>
                <li class="subitem"><a href="<?php echo BASE_URL?>faq.php">FAQ</a></li>
                <li class="subitem"><a href="#">Web Mail</a></li>
            </ul>
        </li>

        <li class="item has-submenu">
            <a tabindex="0">About</a>
            <ul class="submenu">
                <li class="subitem"><a href="<?php echo BASE_URL?>about-us.php">About Us</a></li>
                <li class="subitem"><a href="<?php echo BASE_URL?>latest-news.php">Latest News</a></li>
            </ul>
        </li>
        <li class="item"><a href="<?php echo BASE_URL?>contact-page.php">Contact</a></li>
        <div class="menu_icons">
            <!-- <li class="item button tcc_search tcc_mob_li"><a href="#search"><span class="material-symbols-outlined">search</span></a></li> -->
            <li class="item button tcc_search tcc_mob_li"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><span class="material-symbols-outlined">search</span></a></li>
           
            <div class="offcanvas offcanvas-end" tabindex="-1" id="miniCart" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h3 class="offcanvas-title" id="offcanvasCartLabel">Cart</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mini_cart_body   ">
                    <?php
                        if(isset($_SESSION['id'])){

                            $productList = getCartListByUserId($_SESSION['id']);
                           
                            if(count($productList)>0){
                               
                                foreach ($productList as $product) {
                                    $productDetails = getProductDetail($product->product_id);
                                    ?>
                                        <!---Cart Iteam-->
                                <div class="detailed_order_info">
                                    <div class="wishlist_wrapper">
                                        <img src="admin/productimages/<?php echo $product->product_id . '/' . $productDetails[0]->productImage1;?>" alt="">
                                        <div class="order_info_wrapper">
                                            <p><?php echo $productDetails[0]->productName; ?></p>
                                            <div class="quantity_container">
                                                <p class="m-0">QTY:</p>
                                                <div class="qty-container">
                                                    <button class="qty-btn-minus btn-light" type="button"><i class="fa fa-minus"></i></button>
                                                    <input type="text" name="qty" value="<?php echo $product->qty; ?>" class="input-qty" />
                                                    <input type="hidden" name="pid" value="<?php echo $product->product_id; ?>" class="input-pid" />
                                                    <button class="qty-btn-plus btn-light" type="button"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart_actions">
                                        <p class="order_item_price">$ <?php echo $product->amount; ?></p>
                                        <a href="#" onclick="removeCartIteams(<?php echo $product->product_id;?>)"><span class="material-symbols-outlined"> delete </span> Remove</a>
                                    </div>
                                </div>
                                <!---End cart Iteam-->
                                
                                    <?php
                                }
                                ?>
                                <div class="mini_cart_bottom">
                        <ul class="list-group list-group-flush">
 
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold p-3">
                                Total
                                <?php
                                if(isset($_SESSION['id'])){
                                    $cartTotal = getCartTotal($_SESSION['id']);
                                    ?>
                                    <span class="fw-bold price_text">$<?php echo $cartTotal[0]->CartTotal; ?></span>
                                    <?php
                                    
                                }
                                ?>
                                
                            </li>
                        </ul>
                        <a href="<?php echo BASE_URL?>shop-cart.php" class="mini_cart_view">View Cart</a>
                        <a href="<?php echo BASE_URL?>shop-checkout.php" class="mini_cart_checkout">Checkout</a>

                    </div>
            
                                <?php
                            }else{
                                ?>
                                <p class="cartempty">Your Cart is empty </p>
                               <?php
                            }
                            }
                   // print_r($productList);
                    
                    
                    ?>
                   
                    
                </div>
            </div>

            <!-- My account menu start(currently it set to hidden, add condition and remove below  style="display: none;" ) -->
            <?php
            if ($_SESSION['id']) {
                $wishlistCount = getAllwishlistByUserId($_SESSION['id']);
                if(count($wishlistCount)>0){
                    $wcount = count($wishlistCount);   

                }else{
                    $wcount = 0;
                }
            ?>
                 <li class="item button tcc_mob_li"><a href="shop-whishlist.php" style="position: relative;"><span class="cart_bubble"><?php echo $wcount;?></span><span class="material-symbols-outlined">favorite</span></a></li>
                 <?php
                  $cartNo = cartCount($_SESSION['id']);
                 
                 ?>
            <li class="item button tcc_mob_li"><a href="#miniCart" class="mini_cart" data-bs-toggle="offcanvas"><span class="cart_bubble"><?php 
            if($cartNo[0]->CartiteamCount!=''){
                echo $cartNo[0]->CartiteamCount;
            }else{
                echo 0;
            }
          
            ?></span><span class="material-symbols-outlined">shopping_bag</span></a></li>
                <li class="item button">
                    <div class="sec-center">
                        <input class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
                        <label class="for-dropdown" for="dropdown">My Account<span class="material-symbols-outlined uil"> keyboard_arrow_down </span></label>
                        <div class="section-dropdown">
                            <a href="<?php echo BASE_URL?>job-dashboard.php"><span class="material-symbols-outlined"> work </span> <span>Job Dashboard</span></a>
                            <!--<input class="dropdown-sub" type="checkbox" id="dropdown-sub" name="dropdown-sub"/>
              <label class="for-dropdown-sub" for="dropdown-sub">Dropdown Sub <i class="uil uil-plus"></i></label>
               <div class="section-dropdown-sub"> 
                <a href="#">Dropdown Link <i class="uil uil-arrow-right"></i></a>
                <a href="#">Dropdown Link <i class="uil uil-arrow-right"></i></a>
              </div> -->
                            <a href="<?php echo BASE_URL?>shop-profile.php"><span class="material-symbols-outlined"> local_mall </span><span>Shop Dashboard</span></a>
                            <a href="<?php echo BASE_URL?>logout.php"><span class="material-symbols-outlined"> logout </span><span>Logout</span></a>
                        </div>
                    </div>
                </li>
                <!-- My account menu End -->

            <?php
            } else {
            ?>
                <li class="item button"><a href="<?php echo BASE_URL?>/login.php">Log In</a></li>
                <li class="item button secondary"><a href="<?php echo BASE_URL?>/registration.php">Sign Up</a></li>
            <?php
            }

            ?>


        </div>

        <li class="toggle"><a href="#"><i class="fas fa-bars"></i></a></li>
    </ul>
</nav>

<!-- Search Form -->
<div id="search">
    <span class="close">x</span>
    <form role="search" id="searchform" action="/search" method="get">
        <input value="" name="q" type="search" placeholder="type to searcb h" />
    </form>
</div>
<div class="offcanvas offcanvas_search offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">

  <div class="offcanvas-body search_body">
  <form role="search" id="searchform" action="/search" method="get">
        <input value="" name="search" class="search_input" type="search" placeholder="Type to search" />
    </form>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div> 
</div>




<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    const toggle = document.querySelector(".toggle");
    const menu = document.querySelector(".menu");
    const items = document.querySelectorAll(".item");

    /* Toggle mobile menu */
    function toggleMenu() {
        if (menu.classList.contains("active")) {
            menu.classList.remove("active");
            toggle.querySelector("a").innerHTML = "<i class='fas fa-bars'></i>";
        } else {
            menu.classList.add("active");
            toggle.querySelector("a").innerHTML = "<i class='fas fa-times'></i>";
        }
    }

    /* Activate Submenu */
    function toggleItem() {
        if (this.classList.contains("submenu-active")) {
            this.classList.remove("submenu-active");
        } else if (menu.querySelector(".submenu-active")) {
            menu.querySelector(".submenu-active").classList.remove("submenu-active");
            this.classList.add("submenu-active");
        } else {
            this.classList.add("submenu-active");
        }
    }

    /* Close Submenu From Anywhere */
    function closeSubmenu(e) {
        if (menu.querySelector(".submenu-active")) {
            let isClickInside = menu
                .querySelector(".submenu-active")
                .contains(e.target);

            if (!isClickInside && menu.querySelector(".submenu-active")) {
                menu.querySelector(".submenu-active").classList.remove("submenu-active");
            }
        }
    }
    /* Event Listeners */
    toggle.addEventListener("click", toggleMenu, false);
    for (let item of items) {
        if (item.querySelector(".submenu")) {
            item.addEventListener("click", toggleItem, false);
        }
        item.addEventListener("keypress", toggleItem, false);
    }
    document.addEventListener("click", closeSubmenu, false);
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchLink = document.querySelector('a[href="#search"]');
        var searchContainer = document.getElementById('search');
        var searchInput = document.querySelector('#search > form > input[type="search"]');
        var closeButton = document.querySelector('#search button.close');

        // Click event for the search link
        searchLink.addEventListener('click', function(event) {
            searchContainer.classList.add('open');
            searchInput.focus();
        });

        // Click and keyup events for the search container and close button
        searchContainer.addEventListener('click', function(event) {
            if (
                event.target === this ||
                event.target.className === 'close' ||
                event.keyCode === 27
            ) {
                searchContainer.classList.remove('open');
            }
        });

        closeButton.addEventListener('click', function(event) {
            searchContainer.classList.remove('open');
        });

        // Keyup event for the document to close the search on the 'Esc' key
        document.addEventListener('keyup', function(event) {
            if (event.keyCode === 27) {
                searchContainer.classList.remove('open');
            }
        });
    });
</script>
<script>
    //Remove cart iteam from cart
    function removeCartIteams($pid){ 
        $.ajax({
            type: "POST",
            url: "product-details.php",
            data: {'action':'RemoveCart','productId':$pid},
           // dataType: "text",
            success: function(resultData) {
                alert('Cart Iteam has been Removed');
                 document.location ='shop-cart.php';
              
                
            }
        });
    }
    //Remove from wishlist
    function removeWishlist($id){
        $.ajax({
            type: "POST",
            url: "product-details.php",
            data: {'action':'RemoveWishlist','Id':$id},
           // dataType: "text",
            success: function(resultData) {
                alert('Wishlist  Iteam has been Removed');
                document.location ='shop-whishlist.php';
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        var buttonPlus = $(".qty-btn-plus");
        var buttonMinus = $(".qty-btn-minus");

        var maxAllowedValue = 15;

        buttonPlus.click(function() {
            var $n = $(this)
                .parent(".qty-container")
                .find(".input-qty");

            var $pid = $(this).parent(".qty-container").find(".input-pid");

            var currentValue = Number($n.val());
            var productId = Number($pid.val());
            if (currentValue < maxAllowedValue) {
                $n.val(currentValue + 1);
            }

            updateCartValue(productId, currentValue + 1);
        });

        buttonMinus.click(function() {  
            var $n = $(this)
                .parent(".qty-container")    
                .find(".input-qty");
            var $pid = $(this).parent(".qty-container").find(".input-pid");
            var productId = Number($pid.val());
            var currentValue = Number($n.val());
            var currentValue = Number($n.val());
            if (currentValue > 1) {
                $n.val(currentValue - 1);
            }
            updateCartValue(productId, currentValue - 1);
        });

        // // Set the initial value to 1
        //$(".input-qty").val(1);
    }); 

    //Update cart iteam
    function updateCartValue(pid, Qty) {

        $productId = pid;
        $quantity = Qty;
        $.ajax({
            type: "POST",
            url: "product-details.php",
            data: {'action':'updateCart','productId':$productId,'Qty':$quantity},
           // dataType: "text",
            success: function(resultData) {
                alert('Cart has been updated');
                document.location ='shop-cart.php';
              
                
            }
        });
    }

    
</script>