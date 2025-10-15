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
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>TCC - Contact</title>
      <!--BOOTSTRAP CSS-->
      <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

      <!--CUSTOM CSS-->
      <link href="css/custom.css" rel="stylesheet" type="text/css">
      <link href="css/style.css" rel="stylesheet" type="text/css">

      <!--COLOR CSS-->
      <link href="css/color.css" rel="stylesheet" type="text/css">

      <!--RESPONSIVE CSS-->
      <link href="css/responsive.css" rel="stylesheet" type="text/css">

      <!--OWL CAROUSEL CSS-->
      <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">

      <!--FONTAWESOME CSS-->
      <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

      <!--SCROLL FOR SIDEBAR NAVIGATION-->
      <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">

      <!--GOOGLE FONTS-->
      <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
      
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="theme-style-1">
      <!--WRAPPER START-->
      <div id="wrapper">
         <!--HEADER START-->
         <?php include_once('includes/head_new.php');
          $row = getTopBanner('contact-page');
         ?>
         <!--HEADER END--> 
         <!--INNER BANNER START-->
         <section  class="sec6 contact-us-bg bgimgservices" style="background-image: url('images/banners/<?=$row[0]->banner_img?>');">
            <div class="img-background-overlay"></div>
            <div class="container-fluid ">
               <div class="row">
                  <div class="col-sm-12 contact-us-padd">
                     <h1 class="contact-title text-center">Welcome to TCC Support</h1>
                  </div>
               </div>
               <div class="row text-center">
                  <nav class="navbar ">
                     <div class="nav nav-justified navbar-nav">
                        <form class="navbar-form navbar-search" role="search">
                           <div class="input-group">
                              <input type="text" class="form-control search-txt" placeholder="Type your query here..">
                              <div class="input-group-btn" >
                                 <button class="btn search-btn"  >
                                 <i class="fa fa-search fa-2x" aria-hidden="true" ></i>
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </nav>
               </div>
            </div>
         </section>
         <?php
            if(isset($_POST['submit'])) {
                $sql="insert into contact_details(`contact_name`, `contact_email`, `contact_phone`, `contact_classification`, `contact_message`, `status`, `created_at`) values(:contact_name,:contact_email,:contact_phone,:contact_classification,:contact_message,'1', NOW())";
                $query = $dbh->prepare($sql);
                // Binding Post Values
                $query->bindParam(':contact_name', $_POST['Name'], PDO::PARAM_STR);
                $query->bindParam(':contact_email', $_POST['Email'], PDO::PARAM_STR);
                $query->bindParam(':contact_phone',$_POST['phone'],PDO::PARAM_STR);
                $query->bindParam(':contact_classification',$_POST['classification'],PDO::PARAM_STR);
                $query->bindParam(':contact_message',$_POST['message'],PDO::PARAM_STR);
                $query->execute();
            
                // Send an email
                // Receipt to Sender
                $subject = "We have received your request";
                $message = "Dear ".$_POST['Name'].",\n\n your request has been forwarded to the concern department. you will hear us very soon. \n\n Regards TCC Mobile";
                $message = "<html><body>".$message."</body></html>";
                sendMail($_POST['Name'], $_POST['Email'], $subject, $message);
                // Mail to the concerned dept
                $subject = "Request";
                $message = "Dear ".$_POST['Name'].",\n\n Name : ".$_POST['Name']." \nName : ".$_POST['Name']." \nEmail : ".$_POST['Email']." \nPhone : ".$_POST['phone']." \nType : ".$_POST['classification']."\nMessage : ".$_POST['message']." \n \n\n Regards TCC Mobile";
                $message = "<html><body>".$message."</body></html>";
                sendMail('freeman','freeman.rodrigues@gmail.com', $subject, $message);
                 
                ?>
                <section style="background-color:#0B0984;" >
                <div class="container p-10 m-5">
                  <div class="card text-center " style="border: none;">
         <p style="font-size:18px;color:#FFF;"> Your message is forwarded to the concerned team. you will recieved the response shortly</p>
                  </div>
            </div>
            </section >
         <?php
            } else {
            ?>
         <div class="clearfix clear"></div>
         <!--INNER BANNER END--> 
         <!---  Connect with us -->
         <section  class="">
            <div class="container-fluid mb5 connectwith" >
               <div class="row text-center contact-form-conct">
                  <h1 class="contact-form-conct-h1">Connect with us</h1>
               </div>
             
               <div class="col-md-4" >
                  <div class="cardconnect text-center bordered rounded ">
                     <div  class="contact-form-icon-pd"><i class="fa fa-phone fa-3x contact-form-icon" style="width: 75px;" aria-hidden="true"></i></i>
                     </div>
                     <div class="cont-head-space">
                        <h4 class="cont-h4">Phone</h4>
                        <p class="contact-us-description">We are here to assist you 24/7.</p>
                     </div>
                     <span class="m-4 ">
                     <button type="button" class="btn btn-contact btn2-round-lg btn2-lg" >Call Us</button>
                     </span>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="cardconnect text-center bordered ">
                     <div class="contact-form-icon-pd"><i class="fa fa-envelope fa-3x contact-form-icon" aria-hidden="true" ></i>
                     </div>
                     <div class="cont-head-space">
                        <h4 class="cont-h4">Email</h4>
                        <p class="contact-us-description">Any queries? Simply write to us.</p>
                     </div>
                     <span class="m-4 ">
                     <button type="button" class="btn btn-contact btn2-round-lg btn2-lg" >Email Us</button>
                     </span>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="cardconnect text-center bordered ">
                     <div class="contact-form-icon-pd"><i class="fa fa-map-marker fa-3x contact-form-icon" style="width: 75px;" aria-hidden="true"></i>
                     </div>
                     <div class="cont-head-space">
                        <h4 class="cont-h4">Store Locations</h4>
                        <p class="contact-us-description">Find your nearest TCC store.</p>
                        <span class="m-4 ">
                     </div>
                     <button type="button" class="btn btn-contact btn2-round-lg btn2-lg" >Find Us</button>
                     </span>
                  </div>
               </div>
            </div>
            <div class="center-block text-center " >
               <div class="row text-center contact-us-carebtn">
                  <div class="col-md-3 m-4 carediv" >
                     <button type="button" class="btn btn2-contact btn2-round-lg btn2-lg" >Chat with TCC Care</button>
                  </div>
                  <div class="col-md-3 m-4">
                     <button type="button" class="btn btn22-contact btn2-round-lg btn2-lg" ><i class="fa fa-headphones" aria-hidden="true"></i> Click Here</button>
                  </div>
               </div>
            </div>
      </div>
      </section>
      <!---  Connect with us -->
      <div class="clearfix clear"></div>
      <div class="container-fluid bgcontactimg">
      <div class="clearfix contact-form-talk" >
            <center><h2 class="contact-us-frm-heading">We're Ready, Let's Talk.</h2>
             <div class="elementskit-border-divider"></div>
             <p class="contact-us-frm-desc">If you have any questions, please feel free to get in touch with us, we’ll get back to you shortly.</p>
            </center>
          </div>
         <div class="row contact-row contact-form-margin"  >
            <div class="col-sm-12 contactform">
               <div class="card text-center contact-form-crd">
                  <div class="form-box contact-us-form-sz" >
                     <form action="" method="post">
                        <div class="form-group contact-frm-space" >
                           <input class="form-control form-control-input" id="name" type="text" name="Name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group contact-frm-space" >
                           <input class="form-control form-control-input" id="email" type="email" name="Email" placeholder="Email Address" required>
                        </div>
                        <div class="form-group contact-frm-space" >
                           <input class="form-control form-control-input" id="phone" type="text" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="form-group contact-frm-space" >
                           <select class="form-control" id="classification" name="classification" required>
                              <option value="" class="placeholder" disabled="" selected="selected">I need help with</option>
                              <option value="Mobile">Mobile</option>
                              <option value="Landline">Landline</option>
                              <option value="Internet">Internet</option>
                              <option value="Fibre">Fibre</option>
                              <option value="International">International</option>
                              <option value="Orders">Orders</option>
                              <option value="Products">Products</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <textarea class="form-control" id="message" name="message" placeholder="Message" required rows="8" ></textarea>
                        </div>
                        <input class="btn btn-primary contact-frm-btn" type="submit" name = "submit" value="Send Message" />
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!---  usefullinks -->
      <section  class="useful-links">
         <div class="container-fluid mb5 connectwith" >
            <div class="vl"></div>
            <div class="row text-center contact-useful-links" >
               <h1 class="contact-useful-links-head">Useful Links</h1>
            </div>
            <div class="row text-center contact-useful-links"  >
            </div>
            <div class="col-md-4">
               <div class="card text-center crd-brder" >
                  <div  class="contact-form-icon-pd"><i class="fa fa-phone fa-3x contact-form-icon" style="width: 75px;" aria-hidden="true"></i></i>
                  </div>
                  <div class="cont-head-space">
                     <h4 class="cont-h4">Prepaid Plans</h4>
                     <p class="contact-us-description">Look for our latest plans.</p>
                  </div>
                  <span class="m-4 ">
                  <button type="button" class="btn btn-contact btn2-round-lg btn2-lg" >Apply here</button>
                  </span>
               </div>
            </div>
            <div class="col-md-4">
               <div class="card text-center crd-brder" >
                  <div  class="contact-form-icon-pd"><i class="fa fa-envelope fa-3x contact-form-icon" aria-hidden="true"></i>
                  </div>
                  <div class="cont-head-space">
                     <h4 class="cont-h4">FAQ's</h4>
                     <p class="contact-us-description">Most questions can be answered here.</p>
                  </div>
                  <span class="m-4 ">
                  <button type="button" class="btn btn-contact btn2-round-lg btn2-lg" >Go To FAQ's</button>
                  </span>
               </div>
            </div>
            <div class="col-md-4">
               <div class="card text-center crd-brder" >
                  <div  class="contact-form-icon-pd"><i class="fa fa-envelope fa-3x contact-form-icon" aria-hidden="true"></i>
                  </div>
                  <div class="cont-head-space">
                     <h4 class="cont-h4">Best Offer</h4>
                     <p class="contact-us-description">Search for our current promotions.</p>
                     <span class="m-4 ">
                  </div>
                  <button type="button" class="btn btn-contact btn2-round-lg btn2-lg" >Find Offer</button>
                  </span>
               </div>
            </div>
         </div>
         </div>
      </section>
      <!---  usefullinks -->
      <?php } ?>
      <!--MAIN END--> 
      <!--FOOTER START-->
      <?php include_once('includes/foot.php');?>
      <!--FOOTER END--> 
      </div>
      <!--WRAPPER END--> 
      <!--jQuery START--> 
      <!--JQUERY MIN JS--> 
      <script src="js/jquery-1.11.3.min.js"></script> 
      <!--BOOTSTRAP JS--> 
      <script src="js/bootstrap.min.js"></script> 
      <!--Map Js--> 
      <script src="http://maps.google.com/maps/api/js?sensor=false"></script> 
      <!--OWL CAROUSEL JS--> 
      <script src="js/owl.carousel.min.js"></script> 
      <!--BANNER ZOOM OUT IN--> 
      <script src="js/jquery.velocity.min.js"></script> 
      <script src="js/jquery.kenburnsy.js"></script> 
      <!--SCROLL FOR SIDEBAR NAVIGATION--> 
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 
      <!--CUSTOM JS--> 
      <script src="js/custom.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/63fdb6bf4247f20fefe30dd0/1gqbh3q1f';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
   </body>
</html>