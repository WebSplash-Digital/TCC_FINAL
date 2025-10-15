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

                <h3 class="pb-3 dasboard_heading">Payment History</h3>

               
                <div class="dashboard_body_cards">
                    <div class="table-responsive">
                        <table class="table order_table">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">#1548</th>
                                    <td>24/08/2023</td>
                                    <td>$870.00</td>
                                    <td>Completed</td>
                                    <td><a href="shop-order-details.php"><span class="material-symbols-outlined"> visibility </span></a></td>
                                </tr>
                               
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</body>




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