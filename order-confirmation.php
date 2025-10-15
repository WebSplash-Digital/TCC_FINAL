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
    <div class="container text-center  p-5 mt-4">
        <div class="row align-items-center">
            <div class="col">
                <img src="./images/tcc_success.svg" alt="">
                <h3 class="dasboard_heading pt-3">Thank You! Your order has been received.</h3>
            </div>
        </div>
        <div class="dashboard_body_cards mt-5">
            <?php
            $orderConfirmation = getConfirmationDeatils($_SESSION['orderId']);

            ?>
            <div class="table-responsive">
                <table class="table order_table confirm_order_table">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Invoice No:</th>
                            <th scope="col">Price</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">#<?php echo $orderConfirmation[0]->id; ?></th>
                            <td><?php echo $orderConfirmation[0]->invoiceId; ?></td>
                            <td>$<?php echo $orderConfirmation[0]->total_amount+20+10; ?></td>
                            <td><?php echo ucfirst($orderConfirmation[0]->payment_status); ?></td>
                            <td><?php echo $orderConfirmation[0]->paymentMethod; ?></td>
                            <td><?php echo $orderConfirmation[0]->orderStatus; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="dashboard_body_cards mt-5">
            <div class="cart_summary">
                <h3 class="subtitle_text">Order Summary</h3>
                <?php
                $orderDetails = getOrderDetailsById($_SESSION['orderId']);
                //print_r($orderDetails);
                foreach ($orderDetails as $productList){
                   
                    $getProductName = getProductDetail($productList->product_id);
                    //print_r($productList);
                    

                ?>
                     
                    <ul class="list-group list-group-flush mt-4 mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <span class="checkout_pdt_wrap"><?php echo $getProductName[0]->productName;?><span class="ms-3"><span class="material-symbols-outlined checkout_times"> close </span><?php echo $productList->Qty;?> </span></span>
                            <span class="">$<?php echo $productList->Amount?></span>
                        </li>
                    </ul>
                <?php
                }
                ?>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        Subtotal
                        <?php
                          $orderTotal = getOrdertTotal($_SESSION['id'],$_SESSION['orderId']);
                         
                        ?>
                        <span class="">$<?php echo $orderTotal[0]->OrderTotal;?></span>
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
                        <span class="fw-   bold price_text">$<?php echo $orderTotal[0]->OrderTotal+20+10;?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>