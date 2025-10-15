<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Poppins&display=swap" rel="stylesheet">
<header id="header">

    <div class="container-fluid">
        <div class="navbar navbar-inverse navbar-fixed-top row" role="navigation">
            <div class="container nav_top_flex">
                <div class="navbar-header col-sm-6">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?= BASE_URL ?>index.php">
                            <img src="<?= BASE_URL ?>images/logo.png" class="tccclogo ">
                            <!-- width="228" height="42" -->
                        </a>
                        <button type="button" class="navbar-toggle collapsed" id="scrollToTop" data-toggle="collapse" data-target="#navbarrr" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                </div>
                <div class="col-sm-2 colsearch desktop">
                    <form id="search-form" class="navbar-form" role="search" method="GET" action="search.php" onsubmit="return validateForm()">
                        <div class="input-group">
                            <i class="header_search_icon" aria-hidden="true" id="search"><svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#999999">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0392 15.6244C18.2714 14.084 19.0082 12.1301 19.0082 10.0041C19.0082 5.03127 14.9769 1 10.0041 1C5.03127 1 1 5.03127 1 10.0041C1 14.9769 5.03127 19.0082 10.0041 19.0082C12.1301 19.0082 14.084 18.2714 15.6244 17.0392L21.2921 22.707C21.6828 23.0977 22.3163 23.0977 22.707 22.707C23.0977 22.3163 23.0977 21.6828 22.707 21.2921L17.0392 15.6244ZM10.0041 17.0173C6.1308 17.0173 2.99087 13.8774 2.99087 10.0041C2.99087 6.1308 6.1308 2.99087 10.0041 2.99087C13.8774 2.99087 17.0173 6.1308 17.0173 10.0041C17.0173 13.8774 13.8774 17.0173 10.0041 17.0173Z" fill="#999999"></path>
                                    </g>
                                </svg></i>
                            <input type="text" placeholder="Search" name="srch-term" id="srch-term">

                        </div>
                    </form>
                </div>
                <div class=" navbar-collapse col-sm-4  iconlist desktop" id="navbarr">
                    <ul class="nav navbar-nav ">
                        <?php if (strlen($_SESSION['login'])) {  ?>
                            <li class="headnav"><a href="<?= BASE_URL ?>logout.php">
                                    <span><i class="" aria-hidden="true"><svg width="22px" height="22px" viewBox="0 0 8.4666669 8.4666669" id="svg8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg" fill="#999999">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <defs id="defs2"></defs>
                                                    <g id="layer1" transform="translate(0,-288.53332)">
                                                        <path d="M 15.996094 1.0039062 C 11.589664 1.0039062 8.0019573 4.5916469 8.0019531 8.9980469 C 8.0019557 11.774941 9.4291681 14.22817 11.585938 15.664062 C 5.4606227 17.55205 0.99608756 23.262484 0.99609375 30 A 1.0001 1.0001 0 0 0 2 31.003906 L 30 31.003906 A 1.0001 1.0001 0 0 0 30.996094 30 C 30.9961 23.263163 26.534518 17.552631 20.410156 15.664062 C 22.569029 14.228159 23.998044 11.774891 23.998047 8.9980469 C 23.998043 4.5916469 20.402524 1.0039062 15.996094 1.0039062 z M 15.996094 2.9960938 C 19.321645 2.9960938 21.998044 5.6725162 21.998047 8.9980469 C 21.998044 12.323615 19.321645 15 15.996094 15 C 12.670543 15 10.001956 12.323615 10.001953 8.9980469 C 10.001956 5.6725162 12.670543 2.9960938 15.996094 2.9960938 z M 15.996094 17 C 22.834013 17 28.271717 22.305487 28.804688 29.003906 L 3.1972656 29.003906 C 3.7302358 22.305487 9.1581737 17 15.996094 17 z " id="path935" style="color:#999999;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:medium;line-height:normal;font-family:sans-serif;font-variant-ligatures:normal;font-variant-position:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-alternates:normal;font-feature-settings:normal;text-indent:0;text-align:start;text-decoration:none;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#999999;letter-spacing:normal;word-spacing:normal;text-transform:none;writing-mode:lr-tb;direction:ltr;text-orientation:mixed;dominant-baseline:auto;baseline-shift:baseline;text-anchor:start;white-space:normal;shape-padding:0;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#999999;solid-opacity:1;vector-effect:none;fill:#999999;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1.99999988;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke fill markers;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" transform="matrix(0.26458333,0,0,0.26458333,0,288.53332)"></path>
                                                    </g>
                                                </g>
                                            </svg></i></span>
                                    <span class="iconname">Logout</span></a>
                            </li>
                        <?php } else { ?>
                            <li class="headnav"><a href="<?= BASE_URL ?>login.php">
                                    <span><i class="" aria-hidden="true"><svg width="22px" height="22px" viewBox="0 0 8.4666669 8.4666669" id="svg8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg" fill="#999999">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <defs id="defs2"></defs>
                                                    <g id="layer1" transform="translate(0,-288.53332)">
                                                        <path d="M 15.996094 1.0039062 C 11.589664 1.0039062 8.0019573 4.5916469 8.0019531 8.9980469 C 8.0019557 11.774941 9.4291681 14.22817 11.585938 15.664062 C 5.4606227 17.55205 0.99608756 23.262484 0.99609375 30 A 1.0001 1.0001 0 0 0 2 31.003906 L 30 31.003906 A 1.0001 1.0001 0 0 0 30.996094 30 C 30.9961 23.263163 26.534518 17.552631 20.410156 15.664062 C 22.569029 14.228159 23.998044 11.774891 23.998047 8.9980469 C 23.998043 4.5916469 20.402524 1.0039062 15.996094 1.0039062 z M 15.996094 2.9960938 C 19.321645 2.9960938 21.998044 5.6725162 21.998047 8.9980469 C 21.998044 12.323615 19.321645 15 15.996094 15 C 12.670543 15 10.001956 12.323615 10.001953 8.9980469 C 10.001956 5.6725162 12.670543 2.9960938 15.996094 2.9960938 z M 15.996094 17 C 22.834013 17 28.271717 22.305487 28.804688 29.003906 L 3.1972656 29.003906 C 3.7302358 22.305487 9.1581737 17 15.996094 17 z " id="path935" style="color:#999999;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:medium;line-height:normal;font-family:sans-serif;font-variant-ligatures:normal;font-variant-position:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-alternates:normal;font-feature-settings:normal;text-indent:0;text-align:start;text-decoration:none;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#999999;letter-spacing:normal;word-spacing:normal;text-transform:none;writing-mode:lr-tb;direction:ltr;text-orientation:mixed;dominant-baseline:auto;baseline-shift:baseline;text-anchor:start;white-space:normal;shape-padding:0;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#999999;solid-opacity:1;vector-effect:none;fill:#999999;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1.99999988;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke fill markers;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" transform="matrix(0.26458333,0,0,0.26458333,0,288.53332)"></path>
                                                    </g>
                                                </g>
                                            </svg></i></span>
                                    <span class="iconname">Login</span></a>
                            </li>
                        <?php } ?>
                        <li class="headnav">
                            <a href="<?= BASE_URL ?>my-wishlist.php">
                                <span><i class="" aria-hidden="true"><svg fill="#999999" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="m1692.48 910.647-732.762 687.36-731.182-685.779c-154.616-156.875-154.616-412.122 0-568.997 74.542-75.558 173.704-117.233 279.304-117.233h.113c105.487 0 204.65 41.675 279.078 117.233l.113.113c74.767 75.783 116.103 176.865 116.103 284.385h112.941c0-107.52 41.224-208.602 116.104-284.498 74.428-75.558 173.59-117.233 279.19-117.233h.113c105.487 0 204.763 41.675 279.19 117.233 154.617 156.875 154.617 412.122 1.695 567.416m78.833-646.701c-95.887-97.355-223.737-150.89-359.718-150.89h-.113c-136.094 0-263.83 53.535-359.604 150.777-37.61 38.061-68.443 80.979-92.16 127.398-23.718-46.42-54.664-89.337-92.16-127.285-95.774-97.355-223.51-150.89-359.605-150.89h-.113c-135.981 0-263.83 53.535-359.83 150.89-197.648 200.696-197.648 526.983 1.694 729.035l810.014 759.868L1771.313 991.4c197.647-200.47 197.647-526.758 0-727.454" fill-rule="evenodd"></path>
                                            </g>
                                        </svg></i></span>
                                <span class="iconname">Wishlist</span></a>
                        </li>
                        <li class="headnav"> <a href="<?= BASE_URL ?>my-cart.php">
                                <span><i class="" aria-hidden="true"><svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <rect width="24" height="24" fill="white"></rect>
                                                <path d="M9 9H6.84713C6.35829 9 5.9411 9.35341 5.86073 9.8356L4.19407 19.8356C4.09248 20.4451 4.56252 21 5.18046 21H18.8195C19.4375 21 19.9075 20.4451 19.8059 19.8356L18.1393 9.8356C18.0589 9.35341 17.6417 9 17.1529 9H15M9 9H15M9 9C8.66667 7.66667 8 3 12 3C16 3 15.3333 7.66667 15 9" stroke="#999999" stroke-linejoin="round"></path>
                                            </g>
                                        </svg></i></span>
                                <span class="iconname">Cart</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="navbar navbar-inverse naavbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header navbar-responsive">
                    <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarrr" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> -->
                </div>
                <div id="navbar" class="navbar-collapse collapse navdiv">
                    <ul class="nav navbar-nav navul">
                        <li class=""><a href="<?= BASE_URL ?>index.php">HOME</a></li>
                        <li><a href="<?= BASE_URL ?>services.php">SERVICES</a></li>
                        <li><a href="<?= BASE_URL ?>shop-page.php">SHOP</a></li>
                        <li><a href="<?= BASE_URL ?>promotions.php">PROMOS</a></li>
                        <li><a href="<?= BASE_URL ?>careers.php">CAREERS</a></li>
                        <li class="dropdown">
                            <a href="<?= BASE_URL ?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">HELP <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= BASE_URL ?>#">KALIANET USAGE</a></li>
                                <li><a href="<?= BASE_URL ?>faq.php">FAQs</a></li>
                                <li><a href="<?= BASE_URL ?>#">WEB MAIL</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="<?= BASE_URL ?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ABOUT <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= BASE_URL ?>about-us.php">ABOUT US</a></li>
                                <li><a href="<?= BASE_URL ?>latest-news.php">LATEST NEWS</a></li>
                            </ul>
                        </li>
                        <li><a href="<?=BASE_URL?>contact-page.php">CONTACT</a></li>
                        <?php if (strlen($_SESSION['login'])) {  ?>
                            <li class="dropdown">
                                <a href="<?= BASE_URL ?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MYACCOUNT <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php
                                    if ($_SESSION['user_role'] == 1) { ?>
                                        <li><a href="<?= BASE_URL ?>my-profile.php">My Profile</a></li>
                                        <li><a href="<?= BASE_URL ?>profile.php">Edit Profile</a></li>
                                        <li><a href="<?= BASE_URL ?>applied-jobs.php">Applied Jobs</a></li>
                                    <?php } ?>
                                    <li><a href="<?= BASE_URL ?>order-history.php">Orders</a></li>
                                    <li><a href="<?= BASE_URL ?>my-wishlist.php">Wishlist</a></li>
                                    <li><a href="<?= BASE_URL ?>change-password.php">Change Password</a></li>
                                    <li><a href="<?= BASE_URL ?>logout.php">Log off</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                    <!--- serch section --->
                    
                </div>



                <div id="navbarrr" class="collapse">
                    <div class="col-sm-3 colsearch">
                        <form id="search-form" class="navbar-form" role="search" method="GET" action="search.php" onsubmit="return validateForm()">
                            <div class="input-group">
                                <i class="header_search_icon" aria-hidden="true" id="search"><svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#999999">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0392 15.6244C18.2714 14.084 19.0082 12.1301 19.0082 10.0041C19.0082 5.03127 14.9769 1 10.0041 1C5.03127 1 1 5.03127 1 10.0041C1 14.9769 5.03127 19.0082 10.0041 19.0082C12.1301 19.0082 14.084 18.2714 15.6244 17.0392L21.2921 22.707C21.6828 23.0977 22.3163 23.0977 22.707 22.707C23.0977 22.3163 23.0977 21.6828 22.707 21.2921L17.0392 15.6244ZM10.0041 17.0173C6.1308 17.0173 2.99087 13.8774 2.99087 10.0041C2.99087 6.1308 6.1308 2.99087 10.0041 2.99087C13.8774 2.99087 17.0173 6.1308 17.0173 10.0041C17.0173 13.8774 13.8774 17.0173 10.0041 17.0173Z" fill="#999999"></path>
                                        </g>
                                    </svg></i>
                                <input type="text" placeholder="Search" name="srch-term" id="srch-term">

                            </div>
                        </form>
                    </div>
                    <div class="navbar-collapse  navdiv">
                        <ul class="nav navbar-nav navul">
                            <li class=""><a href="<?= BASE_URL ?>index.php">HOME</a></li>
                            <li><a href="<?= BASE_URL ?>services.php">SERVICES</a></li>
                            <li><a href="<?= BASE_URL ?>shop-page.php">SHOP</a></li>
                            <li><a href="<?= BASE_URL ?>promotions.php">PROMOS</a></li>
                            <li><a href="<?= BASE_URL ?>careers.php">CAREERS</a></li>
                            <li class="dropdown">
                                <a href="<?= BASE_URL ?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">HELP <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= BASE_URL ?>#">KALIANET USAGE</a></li>
                                    <li><a href="<?= BASE_URL ?>faq.php">FAQs</a></li>
                                    <li><a href="<?= BASE_URL ?>#">WEB MAIL</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="<?= BASE_URL ?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ABOUT <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= BASE_URL ?>about-us.php">ABOUT US</a></li>
                                    <li><a href="<?= BASE_URL ?>latest-news.php">LATEST NEWS</a></li>
                                </ul>
                            </li>
                            <?php if (strlen($_SESSION['login'])) {  ?>
                                <li class="dropdown">
                                    <a href="<?= BASE_URL ?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MYACCOUNT <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        if ($_SESSION['user_role'] == 1) { ?>
                                            <li><a href="<?= BASE_URL ?>my-profile.php">My Profile</a></li>
                                            <li><a href="<?= BASE_URL ?>profile.php">Edit Profile</a></li>
                                            <li><a href="<?= BASE_URL ?>applied-jobs.php">Applied Jobs</a></li>
                                        <?php } ?>
                                        <li><a href="<?= BASE_URL ?>order-history.php">Orders</a></li>
                                        <li><a href="<?= BASE_URL ?>my-wishlist.php">Wishlist</a></li>
                                        <li><a href="<?= BASE_URL ?>change-password.php">Change Password</a></li>
                                        <li><a href="<?= BASE_URL ?>logout.php">Log off</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class=" navbar-collapse col-sm-5  iconlist" id="navbarr">
                        <ul class="nav navbar-nav ">
                            <?php if (strlen($_SESSION['login'])) {  ?>
                                <li class="headnav"><a href="<?= BASE_URL ?>logout.php">
                                        <span><i class="" aria-hidden="true"><svg width="22px" height="22px" viewBox="0 0 8.4666669 8.4666669" id="svg8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg" fill="#999999">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <defs id="defs2"></defs>
                                                        <g id="layer1" transform="translate(0,-288.53332)">
                                                            <path d="M 15.996094 1.0039062 C 11.589664 1.0039062 8.0019573 4.5916469 8.0019531 8.9980469 C 8.0019557 11.774941 9.4291681 14.22817 11.585938 15.664062 C 5.4606227 17.55205 0.99608756 23.262484 0.99609375 30 A 1.0001 1.0001 0 0 0 2 31.003906 L 30 31.003906 A 1.0001 1.0001 0 0 0 30.996094 30 C 30.9961 23.263163 26.534518 17.552631 20.410156 15.664062 C 22.569029 14.228159 23.998044 11.774891 23.998047 8.9980469 C 23.998043 4.5916469 20.402524 1.0039062 15.996094 1.0039062 z M 15.996094 2.9960938 C 19.321645 2.9960938 21.998044 5.6725162 21.998047 8.9980469 C 21.998044 12.323615 19.321645 15 15.996094 15 C 12.670543 15 10.001956 12.323615 10.001953 8.9980469 C 10.001956 5.6725162 12.670543 2.9960938 15.996094 2.9960938 z M 15.996094 17 C 22.834013 17 28.271717 22.305487 28.804688 29.003906 L 3.1972656 29.003906 C 3.7302358 22.305487 9.1581737 17 15.996094 17 z " id="path935" style="color:#999999;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:medium;line-height:normal;font-family:sans-serif;font-variant-ligatures:normal;font-variant-position:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-alternates:normal;font-feature-settings:normal;text-indent:0;text-align:start;text-decoration:none;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#999999;letter-spacing:normal;word-spacing:normal;text-transform:none;writing-mode:lr-tb;direction:ltr;text-orientation:mixed;dominant-baseline:auto;baseline-shift:baseline;text-anchor:start;white-space:normal;shape-padding:0;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#999999;solid-opacity:1;vector-effect:none;fill:#999999;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1.99999988;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke fill markers;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" transform="matrix(0.26458333,0,0,0.26458333,0,288.53332)"></path>
                                                        </g>
                                                    </g>
                                                </svg></i></span>
                                        <span class="iconname">Logout</span></a>
                                </li>
                            <?php } else { ?>
                                <li class="headnav"><a href="<?= BASE_URL ?>login.php">
                                        <span><i class="" aria-hidden="true"><svg width="22px" height="22px" viewBox="0 0 8.4666669 8.4666669" id="svg8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg" fill="#999999">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <defs id="defs2"></defs>
                                                        <g id="layer1" transform="translate(0,-288.53332)">
                                                            <path d="M 15.996094 1.0039062 C 11.589664 1.0039062 8.0019573 4.5916469 8.0019531 8.9980469 C 8.0019557 11.774941 9.4291681 14.22817 11.585938 15.664062 C 5.4606227 17.55205 0.99608756 23.262484 0.99609375 30 A 1.0001 1.0001 0 0 0 2 31.003906 L 30 31.003906 A 1.0001 1.0001 0 0 0 30.996094 30 C 30.9961 23.263163 26.534518 17.552631 20.410156 15.664062 C 22.569029 14.228159 23.998044 11.774891 23.998047 8.9980469 C 23.998043 4.5916469 20.402524 1.0039062 15.996094 1.0039062 z M 15.996094 2.9960938 C 19.321645 2.9960938 21.998044 5.6725162 21.998047 8.9980469 C 21.998044 12.323615 19.321645 15 15.996094 15 C 12.670543 15 10.001956 12.323615 10.001953 8.9980469 C 10.001956 5.6725162 12.670543 2.9960938 15.996094 2.9960938 z M 15.996094 17 C 22.834013 17 28.271717 22.305487 28.804688 29.003906 L 3.1972656 29.003906 C 3.7302358 22.305487 9.1581737 17 15.996094 17 z " id="path935" style="color:#999999;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:medium;line-height:normal;font-family:sans-serif;font-variant-ligatures:normal;font-variant-position:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-alternates:normal;font-feature-settings:normal;text-indent:0;text-align:start;text-decoration:none;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#999999;letter-spacing:normal;word-spacing:normal;text-transform:none;writing-mode:lr-tb;direction:ltr;text-orientation:mixed;dominant-baseline:auto;baseline-shift:baseline;text-anchor:start;white-space:normal;shape-padding:0;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#999999;solid-opacity:1;vector-effect:none;fill:#999999;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1.99999988;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke fill markers;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" transform="matrix(0.26458333,0,0,0.26458333,0,288.53332)"></path>
                                                        </g>
                                                    </g>
                                                </svg></i></span>
                                        <span class="iconname">Login</span></a>
                                </li>
                            <?php } ?>
                            <li class="headnav">
                                <a href="<?= BASE_URL ?>my-wishlist.php">
                                    <span><i class="" aria-hidden="true"><svg fill="#999999" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="m1692.48 910.647-732.762 687.36-731.182-685.779c-154.616-156.875-154.616-412.122 0-568.997 74.542-75.558 173.704-117.233 279.304-117.233h.113c105.487 0 204.65 41.675 279.078 117.233l.113.113c74.767 75.783 116.103 176.865 116.103 284.385h112.941c0-107.52 41.224-208.602 116.104-284.498 74.428-75.558 173.59-117.233 279.19-117.233h.113c105.487 0 204.763 41.675 279.19 117.233 154.617 156.875 154.617 412.122 1.695 567.416m78.833-646.701c-95.887-97.355-223.737-150.89-359.718-150.89h-.113c-136.094 0-263.83 53.535-359.604 150.777-37.61 38.061-68.443 80.979-92.16 127.398-23.718-46.42-54.664-89.337-92.16-127.285-95.774-97.355-223.51-150.89-359.605-150.89h-.113c-135.981 0-263.83 53.535-359.83 150.89-197.648 200.696-197.648 526.983 1.694 729.035l810.014 759.868L1771.313 991.4c197.647-200.47 197.647-526.758 0-727.454" fill-rule="evenodd"></path>
                                                </g>
                                            </svg></i></span>
                                    <span class="iconname">Wishlist</span></a>
                            </li>
                            <li class="headnav"> <a href="<?= BASE_URL ?>my-cart.php">
                                    <span><i class="" aria-hidden="true"><svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <rect width="24" height="24" fill="white"></rect>
                                                    <path d="M9 9H6.84713C6.35829 9 5.9411 9.35341 5.86073 9.8356L4.19407 19.8356C4.09248 20.4451 4.56252 21 5.18046 21H18.8195C19.4375 21 19.9075 20.4451 19.8059 19.8356L18.1393 9.8356C18.0589 9.35341 17.6417 9 17.1529 9H15M9 9H15M9 9C8.66667 7.66667 8 3 12 3C16 3 15.3333 7.66667 15 9" stroke="#999999" stroke-linejoin="round"></path>
                                                </g>
                                            </svg></i></span>
                                    <span class="iconname">Cart</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>

    <!-- </div> -->

    <!--NAVIGATION END-->

    <!-- </div> -->


</header>
<script>
    const scrollButton = document.getElementById('scrollToTop');

    scrollButton.addEventListener('click', () => {
        // Scroll to the top of the page
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // For smooth scrolling effect
        });
    });
</script>