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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
</head>
<!--HEADER START-->
<?php include_once('includes/head_new.php');
?>
<!--HEADER END-->

<body class="theme-style-1">
    <div class="container text-center  p-5">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="dasboard_heading">Checkout</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="dashboard_body_cards">
                    <h3 class="subtitle_text">Billing Address</h3>
                    <form action="" method="POST" id="tccCheckout" class="pt-3">
                        <?php
                        $userDetails = getUserDetailsByyUserId($_SESSION['id']);
                        //print_r($userDetails[0]);
                        ?>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="bname" placeholder="Name" value="<?php echo $userDetails[0]->FullName; ?>">
                                        <label for="floatingInput">Name</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="beaddres" placeholder="name@example.com" value="<?php echo $userDetails[0]->EmailId; ?>">
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control" id="bphone" placeholder="Mobile" value="<?php echo $userDetails[0]->ContactNumber; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="baddress" placeholder="Address" value="<?php echo $userDetails[0]->address; ?>">
                                        <label for="floatingInput">Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="bsuburb" placeholder="Suburb" value="<?php echo $userDetails[0]->address; ?>">
                                        <label for="floatingInput">Suburb</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="bcity" placeholder="City" value="<?php echo $userDetails[0]->city; ?>">
                                        <label for="floatingInput">City</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="bstate" placeholder="State" value="<?php echo $userDetails[0]->state; ?>">
                                        <label for="floatingInput">State</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="bpcode" placeholder="Post Code" value="<?php echo $userDetails[0]->pincode; ?>">
                                        <label for="floatingInput">Post Code</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <input type="checkbox" id="useDifferentShippingAddress" class="checkbox" onclick="updateShippingAddresAsBillingAddress()">
                        <label for="useDifferentShippingAddress">Use different Shipping Address</label>
                        <div id="shippingAddressDiv" class="hidden_shipping">
                            <h3 class="subtitle_text mt-4 mb-4">Shipping Address</h3>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="sname" placeholder="Name">
                                            <label for="floatingInput">Name</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="seaddres" placeholder="name@example.com">
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="tel" class="form-control" id="sphone" placeholder="Mobile" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="saddress" placeholder="Address">
                                            <label for="floatingInput">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="ssuburb" placeholder="Suburb">
                                            <label for="floatingInput">Suburb</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="scity" placeholder="City">
                                            <label for="floatingInput">City</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="sstate" placeholder="State">
                                            <label for="floatingInput">State</label>
                                        </div>
                                       </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="spcode" placeholder="Post Code">
                                            <label for="floatingInput">Post Code</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 col-sm-12">
                <div class="dashboard_body_cards">
                    <div class="cart_summary">
                        <h3 class="subtitle_text">Order Summary</h3>
                        
                        <ul class="list-group list-group-flush mt-4 mb-4">
                        <?php
                           $productList = getCartListByUserId($_SESSION['id']);
                           foreach ($productList as $product) {
                            $productDetails = getProductDetail($product->product_id);
                             ?>
                             <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <span class="checkout_pdt_wrap"><?php echo $productDetails[0]->productName; ?><span class="ms-3"><span class="material-symbols-outlined checkout_times"> close </span> <?php echo $product->qty; ?></span></span>
                                <span class="">$<?php echo $product->amount; ?></span>
                            </li>
                            
                             <?php
                           }
                        ?>
                            
                        </ul>
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
                                <span class="fw-   bold price_text">$<?php echo $total; ?></span>
                            </li>
                        </ul>
                        <a href="#" onclick="placeOrder()">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
    //update shiiping address as billing address
    function updateShippingAddresAsBillingAddress() {
        $name = $('#bname').val();
        $email = $('#beaddres').val();
        $bphone = $('#bphone').val();
        $baddress = $('#baddress').val();
        $bsuburb = $('#bsuburb').val();
        $bcity = $('#bcity').val();
        $state = $('#bstate').val();
        $bpcode = $('#bpcode').val();
        //alert($name+'-'+$email+'-'+$bphone+'-'+$baddress+'-'+$bsuburb+'-'+$bcity+'-'+$state+'-'+$bpcode);
        $('#sname').val($name);
        $('#seaddres').val($email);
        $('#sphone').val($bphone);
        $('#saddress').val($baddress);
        $('#ssuburb').val($bsuburb);
        $('#scity').val($bcity);
        $('#sstate').val($state);
        $bpcode = $('#spcode').val($bpcode);
    }

//Saved order
    function placeOrder(){
        $name = $('#sname').val();
        $email = $('#seaddres').val();
        $bphone = $('#sphone').val();
        $baddress = $('#saddress').val();
        $bsuburb = $('#ssuburb').val();
        $bcity = $('#scity').val();
        $state = $('#sstate').val();
        $bpcode = $('#spcode').val();
        $.ajax({
            type: "POST",
            url: "product-details.php",
            data: {'action':'addOrder',
                'name':$name,
                'email':$email,
                'phone':$bphone,
                'address':$baddress,
                'ssuburb':$bsuburb,
                'bcity':$bcity,
                'state':$state,
                'bpcode':$bpcode},
           // dataType: "text",
            success: function(resultData) {
                alert('order place succesfully');
                  document.location ='order-confirmation.php';  
            }
        });
    }
    const input = document.querySelector("#phone");
    window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
    });
</script>
<script>
    const input1 = document.querySelector("#phone1");
    window.intlTelInput(input1, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkbox = document.getElementById("useDifferentShippingAddress");
        const shippingAddressDiv = document.getElementById("shippingAddressDiv");

        checkbox.addEventListener("change", function() {
            if (checkbox.checked) {
                shippingAddressDiv.style.display = "block";
            } else {
                shippingAddressDiv.style.display = "none";
            }
        });
    });
</script>