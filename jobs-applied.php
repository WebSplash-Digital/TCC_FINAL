<?php
session_start();
error_reporting(0);

include('includes/config.php');
include('function.inc.php');

if (strlen($_SESSION['id']==0)) {
    header('location:logout.php');
}
?>
<!doctype html>

<html>

<head>

    <meta charset="utf-8">
    <title>Edit Profile</title>
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
                <?php include_once('includes/job-dashboard-menu.php');
                ?>
            </div>
            <div class="col-lg-8 tcc_dashboard_body">
                <h3 class="pb-3 dasboard_heading">Applied Jobs</h3>
                <div class="dashboard_body_cards">
                    <div class="dashboard_body_intro">
                        <div class="recent_jobs">
                            <?php
                             $jobList = getRecentAppliedJobCurrentUser($_SESSION['id']);
                             foreach ($jobList as $job) {
                                ?>
                                <!---JOB CARD START-->
                            <div class="job_card">
                                <div class="circular_img">
                                    <img src="images/425700813a883deabb9647ab78f55f041677211293.jpg" alt="">
                                </div>

                                <div class="jobdetails">
                                    <?php
                                    $jobDetails = getJobDetailsByJobid($job->JobId);
                                    // print_r($jobDetails);
                                    ?>
                                    <h3><?php echo $jobDetails[0]->jobTitle; ?>  <span class="job_status" ><?php if(!empty($job->Status)){echo $job->Status;}else{ echo "In Process"; } ?></span></h3>
                                    <?php
                                    $jobDescription = $jobDetails[0]->jobDescription;
                                    $jobDescription = strip_tags($jobDescription); // Remove HTML tags
                                    $words = explode(" ", $jobDescription);
                                    $shortenedDescription = implode(" ", array_slice($words, 0, 15));
                                    echo "<p>$shortenedDescription</p>";
                                    ?>

                                    <div class="job_meta">
                                        <ul>
                                            <li><span class="material-symbols-outlined job_meta_icon"> work </span><?php echo $jobDetails[0]->jobCategory; ?></li>
                                            <li><span class="material-symbols-outlined job_meta_icon"> near_me </span><?php echo $jobDetails[0]->jobLocation; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="job_action">
                                    <div class="list-container">
                                        <button class="more-button" aria-label="Menu Button">
                                            <div class="menu-icon-wrapper">
                                                <div class="menu-icon-line half first"></div>
                                                <div class="menu-icon-line"></div>
                                                <div class="menu-icon-line half last"></div>
                                            </div>
                                        </button>
                                        <ul class="more-button-list">
                                            <li class="more-button-list-item">
                                                <span class="material-symbols-outlined"> visibility </span>
                                                <span><a href="jobs-details.php?jid=<?php echo $job->JobId;?>">View Job</a></span>
                                            </li>
                                            <li class="more-button-list-item">
                                                <span class="material-symbols-outlined"> delete </span>
                                                <span>Delete</span>
                                            </li>

                                            </d>
                                    </div>

                                </div>
                            </div>
                            <!---END JOB CARD--->
                                <?php

                             }
                            ?>
                           
                          

                        </div>

                    </div>
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