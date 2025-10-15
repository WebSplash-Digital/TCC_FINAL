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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<!--HEADER START-->
<?php include_once('includes/head_new.php');
?>
<!--HEADER END-->

<body class="theme-style-1">
    <div class="container text-center  p-5">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="dasboard_heading">Shopping Cart</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="dashboard_body_cards">
                    <?php
                    $productList = getCartListByUserId($_SESSION['id']);
                   
                    if(count($productList)>0){
                        foreach ($productList as $product) {
                            // print_r($product->qty);
                        ?>
                            <!---Start product -->
                            <?php
                            $productDetails = getProductDetail($product->product_id);
                            ?>
                            <div class="detailed_order_info">
                                <div class="wishlist_wrapper">
                                    <img src="admin/productimages/<?php echo $product->product_id . '/' . $productDetails[0]->productImage1; ?>" alt="">
                                    <div class="order_info_wrapper">
    
                                        <p><?php echo $productDetails[0]->productName; ?></p>
                                        <div class="quantity_container">
                                            <p>QTY:</p>
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
    
                            <!---END Product -->
                        <?php
    
                        }
                    }else{
                        ?>
                         <p class="cartempty">Your Cart is empty </p>
                        <?php
                    }
                    
                    ?>
                </div>
                
                <div class="update_wrapper">
                    <a href="">Continue Shopping</a>
                </div>
            </div>
            <?php
            if(count($productList)>0){
                ?>
                 <div class="col-lg-4 col-sm-12">
                <div class="dashboard_body_cards">
                    <div class="cart_summary">
                        <h3 class="subtitle_text">Order Summary</h3>
                        <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="Promo Code" aria-label="PROMO CODE">
                            <button class="btn btn-outline-secondary" type="button" id="promoCode">Apply</button>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                Subtotal
                                <?php
                                $cartTotal = getCartTotal($_SESSION['id']);

                                ?>
                                <span class="">$<?php echo $cartTotal[0]->CartTotal; ?></span>
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
                                <?php
                                $total = $cartTotal[0]->CartTotal + 20 + 10;
                                ?>
                                Total
                                <span class="fw-bold price_text">$<?php echo $total; ?></span>
                            </li>
                        </ul>
                        <a href="shop-checkout.php">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
                <?php
            }
            
            ?>
           
        </div>
    </div>

</body>
