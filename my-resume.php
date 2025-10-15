<?php
session_start();
error_reporting(0);

include('includes/config.php');
include('function.inc.php');

//verifying Session
if(strlen($_SESSION['id'])==0)
  { 
header('location:emp-login.php');
}
else{
// echo $_SESSION['id'];
    // print_r($_FILES["resume"]["name"]); die;
if(isset($_POST['update']))
{
//getting resume
// $img=$_FILES["image"]["name"];
$uid=$_SESSION['id'];
$resume=$_FILES["resume"]["name"];
// get the image extension
$extension = substr($resume,strlen($resume)-4,strlen($resume));
// allowed extensions
$allowed_extensions = array(".pdf",".docx",".doc");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid Resume format. Only pdf / docx/ doc format allowed');</script>";
}
else
{
//rename the image file
$resumename=md5($resume).time().$extension;
// Code for move image into directory
move_uploaded_file($_FILES["resume"]["tmp_name"],"Jobseekersresumes/".$resumename);

$sql="update  tbljobseekers set Resume=:resumename where id=:uid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->bindParam(':resumename',$resumename,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Your resume has been updated")</script>';
    echo "<script>window.location.href ='my-resume.php'</script>";

}

}
}
?>
<!doctype html>

<html>

<head>

    <meta charset="utf-8">
    <title>My Resume</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/dashboard.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
                <h3 class="pb-3 dasboard_heading">Upload Resume</h3>
                <div class="dashboard_body_cards">
                    <div class="dashboard_body_intro">
                        <h4 class="profile_heading">My Resume</h4>
                        <form method="post" action="my-resume.php" enctype="multipart/form-data">
                            <label class="file">
                                Drop a file or click to select one
                                <input type="file" name="resume" >
                                <button type="button" class="remove-button"><span class="material-symbols-outlined"> delete </span></button>
                            </label>
                            <input type="submit" name="update" class="tcc_btn ">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var fileInputs = document.querySelectorAll('input[type="file"]');

        fileInputs.forEach(function(fileInput) {
            fileInput.addEventListener('change', function() {
                var files = this.files;
                var parentElement = this.parentElement;

                if (files.length > 0) {
                    // Create a remove button
                    var removeButton = document.createElement('button');
                    //removeButton.textContent = 'Remove';
                    removeButton.className = 'remove-button'; // Add the "remove-button" class
                    // Create a <span> element
                    var spanElement = document.createElement('span');
                    // Add the class "material-symbols-outlined" to the <span> element
                    spanElement.classList.add('material-symbols-outlined');

                    // You can set content or attributes for the <span> here, if needed
                    // For example:
                    spanElement.textContent = 'close';

                    // Append the <span> element to the <button> element
                    removeButton.appendChild(spanElement);

                    // Add an event listener to the remove button to handle file removal
                    removeButton.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent the default behavior (file selection dialog)
                        event.stopPropagation(); // Stop event propagation

                        // Remove the file and the remove button
                        parentElement.removeChild(removeButton);
                        this.value = null;
                        parentElement.innerHTML = 'Drop a file or click to select one' +
                            '<input type="file" multiple>';
                        // Reattach the change event listener to the new file input
                        fileInput = parentElement.querySelector('input[type="file"]');
                        fileInput.addEventListener('change', fileInputChangeHandler);
                    });

                    // Remove the existing input and add the remove button
                    parentElement.innerHTML = files[0].name + '<br>' +
                        '<span class="sml">' +
                        'type: ' + files[0].type + ', ' +
                        Math.round(files[0].size / 1024) + ' KB</span>';
                    parentElement.appendChild(removeButton);
                    // Show the remove button
                    removeButton.style.display = 'block';

                    // Remove the change event listener from the previous file input
                    fileInput.removeEventListener('change', fileInputChangeHandler);
                }
            });

            fileInput.addEventListener('focus', function() {
                this.parentElement.classList.add('focus');
            });

            fileInput.addEventListener('blur', function() {
                this.parentElement.classList.remove('focus');
            });

            // Function to handle the file input change event
            function fileInputChangeHandler() {
                var files = this.files;
                var parentElement = this.parentElement;

                if (files.length > 0) {
                    // Create a remove button
                    var removeButton = document.createElement('button');
                    //removeButton.textContent = 'Remove';
                    removeButton.className = 'remove-button'; // Add the "remove-button" class
                    // Create a <span> element
                    var spanElement = document.createElement('span');
                    // Add the class "material-symbols-outlined" to the <span> element
                    spanElement.classList.add('material-symbols-outlined');

                    // You can set content or attributes for the <span> here, if needed
                    // For example:
                    spanElement.textContent = 'close';

                    // Append the <span> element to the <button> element
                    removeButton.appendChild(spanElement);

                    // Add an event listener to the remove button to handle file removal
                    removeButton.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent the default behavior (file selection dialog)
                        event.stopPropagation(); // Stop event propagation

                        // Remove the file and the remove button
                        parentElement.removeChild(removeButton);
                        this.value = null;
                        parentElement.innerHTML = 'Drop a file or click to select one' +
                            '<input type="file" multiple>';
                        // Reattach the change event listener to the new file input
                        fileInput = parentElement.querySelector('input[type="file"]');
                        fileInput.addEventListener('change', fileInputChangeHandler);
                    });

                    // Remove the existing input and add the remove button
                    parentElement.innerHTML = files[0].name + '<br>' +
                        '<span class="sml">' +
                        'type: ' + files[0].type + ', ' +
                        Math.round(files[0].size / 1024) + ' KB</span>';
                    parentElement.appendChild(removeButton);
                    // Show the remove button
                    removeButton.style.display = 'block';

                    // Remove the change event listener from the previous file input
                    fileInput.removeEventListener('change', fileInputChangeHandler);
                }
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
</script> -->