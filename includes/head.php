<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<header id="header"> 

    <!--BURGER NAVIGATION SECTION START-->

    <!--BURGER NAVIGATION SECTION END-->

    <!-- <div class="container">  -->

      <!--NAVIGATION START-->

      <!-- <div class="navigation-col"> -->

        <div class="navbar navbar-inverse navbar-fixed-top row" role="navigation">  
  
          <div class="navbar-header col-sm-4 ">
            <div class="navbar-header">
              <a class="navbar-brand" href="<?=BASE_URL?>index.php">
                <img src="<?=BASE_URL?>images/logo.png" class="tccclogo">
                <!-- width="228" height="42" -->
              </a>
            </div>
          </div>
          <div class="col-sm-3 colsearch">
            <form id="search-form" class="navbar-form" role="search" method="GET" action="search.php" onsubmit="return validateForm()"  >
              <div class="input-group">
                <i class="fa fa-search search" aria-hidden="true" id="search"></i>
                <input type="text" placeholder="Search" name="srch-term" id="srch-term"> 
              </div>
            </form>
          <script type="text/javascript">
              function validateForm() {
                if(document.getElementById("srch-term").value == '') {
                return false;
                }else {
                  document.getElementById("search-form").submit();
                } 
              }
          </script>
          </div>
          <div class=" navbar-collapse col-sm-5  iconlist">
            <ul class="nav navbar-nav ">
            <?php if(strlen($_SESSION['login'])) {  ?>
              <li class="headnav"><a href="<?=BASE_URL?>logout.php">
                <span><i class="fa fa-user-o iconsize" aria-hidden="true"></i></span>
                <span class="iconname">LOG OUT</span></a>
              </li>
              <?php } else { ?>
              <li class="headnav"><a href="<?=BASE_URL?>login.php">
                <span><i class="fa fa-user-o iconsize" aria-hidden="true"></i></span>
                <span class="iconname">LOG IN</span></a>
              </li>
              <?php } ?>
              <li class="headnav"> 
                <a href="<?=BASE_URL?>my-wishlist.php">
                <span><i class="fa fa-heart-o iconsize" aria-hidden="true"></i></span>
                <span class="iconname">WISHLIST</span></a>
              </li>
              <li class="headnav"> <a href="<?=BASE_URL?>my-cart.php">

                <span><i class="fa fa-shopping-bag iconsize" aria-hidden="true"></i></span>
                <span class="iconname">CART</span></a>
              </li>
              <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li> -->
            </ul>
          </div>
        </div>


      <div class="navbar navbar-inverse navbar-static-top" role="navigation"> 
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse navdiv">
        <ul class="nav navbar-nav navul">
          <li class=""><a href="<?=BASE_URL?>index.php">HOME</a></li>
          <li><a href="<?=BASE_URL?>services.php">SERVICES</a></li>
          <li><a href="<?=BASE_URL?>shop-page.php">SHOP</a></li>
          <li><a href="<?=BASE_URL?>promotions.php">PROMOS</a></li>
          <li><a href="<?=BASE_URL?>careers.php">CAREERS</a></li>
          <li class="dropdown"> 
            <a href="<?=BASE_URL?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">HELP <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?=BASE_URL?>#">KALIANET USAGE</a></li>
              <li><a href="<?=BASE_URL?>faq.php">FAQs</a></li>
              <li><a href="<?=BASE_URL?>#">WEB MAIL</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="<?=BASE_URL?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ABOUT <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?=BASE_URL?>about-us.php">ABOUT US</a></li>
              <li><a href="<?=BASE_URL?>latest-news.php">LATEST NEWS</a></li>
            </ul>
          </li>
          <li><a href="<?=BASE_URL?>contact-page.php">CONTACT</a></li>

          <?php if(strlen($_SESSION['login'])) {  ?>
          <li class="dropdown">
            <a href="<?=BASE_URL?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MYACCOUNT <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <?php 
                  if($_SESSION['user_role'] == 1) { ?>
                    <li><a href="<?=BASE_URL?>my-profile.php">My Profile</a></li>
                    <li><a href="<?=BASE_URL?>profile.php">Edit Profile</a></li>
                    <li><a href="<?=BASE_URL?>applied-jobs.php">Applied Jobs</a></li>
                    <?php } ?>
                    <li><a href="<?=BASE_URL?>order-history.php">Orders</a></li>
                    <li><a href="<?=BASE_URL?>my-wishlist.php">Wishlist</a></li>
                    <li><a href="<?=BASE_URL?>change-password.php">Change Password</a></li>
                    <li><a href="<?=BASE_URL?>logout.php">Log off</a></li>
            </ul>
          </li>
          <?php } ?>
        </ul>

      </div>
      <!--/.nav-collapse -->
      </div>

      <!-- </div> -->

      <!--NAVIGATION END--> 

    <!-- </div> -->  
  </header>
  