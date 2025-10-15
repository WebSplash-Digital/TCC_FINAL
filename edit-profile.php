<?php
session_start();
error_reporting(0);

include('includes/config.php');
include('function.inc.php');

if (strlen($_SESSION['id']==0)) {
    header('location:logout.php');
  }
  else
  {

    // print_r($_POST['submit']); die;
      if(isset($_POST['submit']))
      {

        // print_r($_POST['FullName']); die;


       
          $FullName=$_POST['FullName'];
          $EmailId=$_POST['EmailId'];
          $ContactNumber=$_POST['ContactNumber'];
          $address=$_POST['address'];
          $suburb=$_POST['suburb'];
          $city=$_POST['city'];
          $state=$_POST['state'];
          $pincode=$_POST['pincode'];
          $AboutMe=$_POST['AboutMe'];
          $workExperience=$_POST['workExperience'];
          $qualification=$_POST['qualification'];
          $linkedIn=$_POST['linkedIn'];
          $twitter=$_POST['twitter'];
          $facebook=$_POST['facebook'];
          $editid=$_SESSION['id'];

        //   $ProfilePic=$_FILES["ProfilePic"]["name"];
          $target_dir = "images/user-profile/";
          $pre = date("his");
          if(isset($_FILES["ProfilePic"]["name"])) {
          $target_file = $target_dir . basename($pre."-".$_FILES["ProfilePic"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //   echo $target_dir;
        //   echo $target_file;
        //   echo $imageFileType;
           if (move_uploaded_file($_FILES["ProfilePic"]["tmp_name"], $target_file)) {
              $img_url1 = $pre."-".htmlspecialchars( basename( $_FILES["ProfilePic"]["name"]));
             // echo  htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } 
          }else {
              $img_url1  = '';
          }
        //   echo $img_url1; die;
          $sql="UPDATE `tbljobseekers` SET `FullName`='$FullName',`EmailId`='$EmailId',`ContactNumber`='$ContactNumber',`AboutMe`='$AboutMe',`ProfilePic`='$img_url1',`address`='$address',`suburb`='$suburb',`state`='$state',`city`='$city',`pincode`='$pincode',`workExperience`='$workExperience',`qualification`='$qualification',`linkedIn`='$linkedIn',`twitter`='$twitter',`facebook`='$facebook' WHERE `id`='$editid'";
          $query=$dbh->prepare($sql);

        //   echo $sql; die;
        //   $query->bindParam(':category',$category,PDO::PARAM_STR);
        //   $query->bindParam(':description',$description,PDO::PARAM_STR);
        //   $query->bindParam(':editid',$editid,PDO::PARAM_STR);
          $query->execute();
          echo '<script>alert("Profile Updated successfully .")</script>';
      }
  
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
                <h3 class="pb-3 dasboard_heading">Edit Profile</h3>
                <div class="dashboard_body_cards">
                <form action="edit-profile.php" method="POST" id="jobMyProfile" enctype="multipart/form-data" class="">
                    <div class="dashboard_body_intro">
                    <?php

                        // echo $_SESSION['id'];
                        $userDeatils = getUserDetailsByyUserId($_SESSION['id']);

                        ?>
                        <h4 class="profile_heading">My Profile</h4>
                        <div class="profile-picture-upload">
                            <?php if($userDeatils[0]->ProfilePic!=""){?>
                                <img src="images/user-profile/<?php echo $data[0]->ProfilePic; ?>" alt="Profile picture preview" class="imagePreview">
                                <button class="action-button mode-upload">Upload Image</button>
                                <input type="file" class="hidden" name="ProfilePic" value="<?php echo $data[0]->ProfilePic; ?>" accept=".png, .jpg, .jpeg" max-size="5242880" />
                            <?php }else{ ?>
                                <img src="" alt="Profile picture preview" class="imagePreview">
                                <button class="action-button mode-upload">Upload Image</button>
                                <input type="file" class="hidden" name="ProfilePic" accept=".png, .jpg, .jpeg" max-size="5242880" />
                            <?php } ?>
                        </div>
                        

                        <!-- Profile Form -->
                       
                            <div class="row pt-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="FullName" placeholder="First Name" value="<?php  echo $userDeatils[0]->FullName;?>">
                                            <label for="floatingInput">Full Name</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Last Name" value="<?php  echo $userDeatils[0]->name;?>">
                                            <label for="floatingInput">Last Name</label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" name="EmailId" placeholder="name@example.com" value="<?php echo $userDeatils[0]->EmailId; ?>">
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="tel" class="form-control" id="phone" name="ContactNumber" placeholder="Mobile" value="<?php echo $userDeatils[0]->ContactNumber; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="address" value="<?php echo $userDeatils[0]->address; ?>" placeholder="Address">
                                            <label for="floatingInput">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="suburb" placeholder="Suburb" value="<?php echo $userDeatils[0]->suburb; ?>">
                                            <label for="floatingInput">Suburb</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="city" value="<?php echo $userDeatils[0]->city; ?>" placeholder="City">
                                            <label for="floatingInput">City</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="state" value="<?php echo $userDeatils[0]->state; ?>" placeholder="State">
                                            <label for="floatingInput">State</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" name="pincode" value="<?php echo $userDeatils[0]->pincode; ?>" placeholder="Post Code">
                                            <label for="floatingInput">Post Code</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="workExperience" placeholder="Work Experience" value="<?php echo $userDeatils[0]->workExperience; ?>">
                                            <label for="floatingInput">Work Experience</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="qualification" value="<?php echo $userDeatils[0]->qualification; ?>" placeholder="Qualification">
                                            <label for="floatingInput">Qualification</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <textarea maxlength="300" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="AboutMe" style="height: 100px"><?php echo $userDeatils[0]->AboutMe; ?></textarea>
                                            <label for="floatingTextarea2">About</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="profile_heading pt-5">Social Links</h4>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="url" class="form-control" id="floatingInput" name="linkedIn" value="https://linkedin.com/" placeholder="Linkedin">
                                        <label for="floatingInput">Linkedin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="url" class="form-control" id="floatingInput" name="twitter " value="https://twitter .com/" placeholder="Twitter">
                                        <label for="floatingInput">Twitter</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="url" class="form-control" id="floatingInput" name="facebook" value="https://facebook.com/" placeholder="Facebook">
                                        <label for="floatingInput">Facebook</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <!-- <input type="button" class="tcc_btn mt-4" name="submit" value="Save Profile" id=""> -->
                                <button type="submit" class="tcc_btn mt-4" name="submit">
                                                    Update Profile
                                                </button>
                            </div>
                        
                    </div>
                </form>
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
    let fileInput = document.querySelector("input[name='ProfilePic']");
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
        } else {
            if (fileInput.files && fileInput.files.length > 0) {
                fileReader.readAsDataURL(fileInput.files[0]);
                fileReader.onload = (e) => {
                    picturePreview.src = e.target.result;
                    setActionButtonMode("remove");
                }
            }
        }
    }

    refreshImagePreview();
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