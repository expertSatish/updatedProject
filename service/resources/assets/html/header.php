<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1, minimum-scale=.5, maximum-scale=5">
<link rel="icon" href="images/favicon.png" type="image/x-icon">
<link rel="apple-touch-icon" href="images/favicon.png">
<meta name="theme-color" content="#f3a430">
<link rel="stylesheet" type="text/css" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css" media="all">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons" media="all">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" media="all">
<link rel="stylesheet" type="text/css" href="css/materialize.css" media="screen,projection">
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen,projection">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<script>function goBack() { window.history.back(); }</script>
</head>

<body class="scrollspy" id="top">
    <main>
        <header>
            <div class="HeadTop">
                <div class="container">
                    <div class="row">
                        <div class="col s12 l2">&nbsp;</div>
                        <div class="col s12 l8">
                            <ul class="m0">
                                <li><i class="icofont-phone"></i> <a href="tel:+919149175204">(+91) 914 917 5204</a>
                                </li>
                                <li><i class="icofont-email"></i> <a href="mailto:expertbellsconsulting@gmail.com">expertbellsconsulting@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col s12 l2">
                            <ul class="m0">
                                <li><a title="Home" <?php if($active=='Sign Up' )echo"class='hover'";?> href="signup.php">Sign Up</a></li>
                                <li><a title="About Us" <?php if($active=='login' )echo"class='hover'";?> href="login.php">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-main">
                <nav role="navigation" class="pushpin-demo-nav pin-top" data-target="menu">
                    <div class="MobileTop">
                        <div class="container">
                            <div class="row">
                                <div class="col m1 s2"><a href="#" data-target="nav-mobile"title="Expert Bells Mobile Menu" class="sidenav-trigger m-menu"><i class="material-icons menu-ico">menu</i></a></div>
                                <div class="col m7 s6"><a href="index.php" id="logo-container" class="brand-logo"><img src="images/logom.png" class="sticky-logo" alt="Expert Bells"></a></div>
                                <div class="col s4 right-align">
                                    <a href="#" data-target="contact-no" class="sidenav-trigger"><i class="material-icons">phone</i></a>
                                    <a href="#" data-target="emailmo" title="Email" class="sidenav-trigger"><i class="material-icons">email</i></a>
                                </div>
                            </div>
                        </div>
                        <div id="nav-mobile" class="sidenav">
                            <div class="sidenavTop">
                                <div class="row valign-wrapper">
                                    <div class="col s8"><a href="index.php" id="logo-container" class="brand-logo"><img src="images/logom.png" class="sticky-logo" alt="Expert Bells"></a></div>
                                    <div class="col s4 right-align lh0"><a class="CMenu"><i class="material-icons white-text">arrow_forward</i></a></div>
                                </div>
                            </div>
                            <ul class="m0">
                                <!-- <li><a title="Home" <?php if($active=='Home' )echo"class='hover'";?> href="index.php">Home</a></li> -->
                                <li><a title="Start Business" <?php if($active=='Start Business')echo"class='hover'";?> href=" service.php">Start Business</a></li>
                                <li><a title="Registration & License" <?php if($active=='Registration & License')echo"class='hover'";?> href=" service.php">Registration & License</a></li>
                                <li><a title="Tax & Compliance" <?php if($active=='Tax & Compliance')echo"class='hover'";?> href=" service.php">Tax & Compliance</a></li>
                                <li><a title="Trademark & Copyright" <?php if($active=='Trademark & Copyright')echo"class='hover'";?> href=" service.php">Trademark & Copyright</a></li>
                                <li><a title="E-Commerce" <?php if($active=='E-Commerce' )echo"class='hover'";?> href="service.php">E-Commerce</a></li>
                                <li><a title="Contact Us" <?php if($active=='Contact Us' )echo"class='hover'";?> href="contact-us.php">Contact Us</a></li>
                                <!-- <li><a title="Aircraft" class="dropdown-trigger <?php if($active=='Aircrafts')echo'hover';?>" data-target="aircraftsm">Aircraft <i class="icofont-thin-down right"></i></a>
                                <ul id="aircraftsm" class="dropdown-content full-width">
                                    <li><a href="cessna152.php" title="Cessna 152">Cessna 152</a></li>
                                    <li><a href="piper-seneca.php" title="Piper Seneca">Piper Seneca</a></li>
                                    <li><a href="robinson-r44.php" title="Robinson R44">Robinson R44</a></li>
                                    <li><a href="simulator.php" title="Simulator">Simulator</a></li>
                                </ul>
                            </li> -->
                            </ul>
                        </div>
                        <div id="contact-no" class="sidenav">
                            <p class="font-size-16px center">Contact No.<br><a href="tel:+919149175204">(+91) 914 917 5204</a></p>
                        </div>
                        <div id="emailmo" class="sidenav">
                            <p class="font-size-16px center">Email ID<br><a href="mailto:expertbellsconsulting@gmail.com">expertbellsconsulting@gmail.com</a>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="container">
                        <div class="nav-wrapper row valign-wrapper">
                            <div class="col s12 l2">
                                <div class="brand-logo logo t-hidd m-hidd"><a href="index.php"><img src="images/logo.png"></a></div>
                            </div>
                            <div class="col s12 l9">
                                <ul class="hide-on-med-and-down">
                                    <!-- <li><a title="Home" <?php if($active=='Home' )echo"class='hover'";?> href="index.php">Home</a></li> -->
                                    <li><a title="Start Business" class="menu-dropdown <?php if($active=='Start Business')echo'hover';?>" href="service.php" data-target="StartBusiness">Start Business <i class="icofont-thin-down right"></i></a>
                                        <div id="StartBusiness" class="dropdown-content full-width">
                                            <div class="row">
                                                <div class="col s6 m6">
                                                    <h6>Business Registration </h6>
                                                    <ul class="float-none w100">
                                                        <li><a href="#" title="Public Limited Company Registration">Public Limited Company Registration</a></li>
                                                        <li><a href="#" title="Private Limited Company Registration">Private Limited Company Registration</a></li>
                                                        <li><a href="#" title="One Person Company Registration">One Person Company Registration</a></li>
                                                        <li><a href="#" title="Limited Liability Partnership">Limited Liability Partnership</a></li>
                                                        <li><a href="#" title="Partnership Firm">Partnership Firm</a></li>
                                                        <li><a href="#" title="Sole Proprietorship">Sole Proprietorship</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col s6 m6">
                                                    <h6>Special Entity </h6>
                                                    <ul class="float-none w100">
                                                        <li><a href="#" title="MSME Registration">MSME Registration</a>
                                                        </li>
                                                        <li><a href="#" title="Nidhi Company Registration">Nidhi Company Registration</a></li>
                                                        <li><a href="#" title="Section 8 Company Registration">Section 8 Company Registration</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a title="Registration & License" class="menu-dropdown <?php if($active=='Registration & License')echo'hover';?>" href="service.php" data-target="RegistrationLicense">Registration & License <i class="icofont-thin-down right"></i></a>
                                        <div id="RegistrationLicense" class="dropdown-content full-width">
                                            <div class="row">
                                                <div class="col s6 m6">
                                                    <h6>Business Registration </h6>
                                                    <ul class="float-none w100">
                                                        <li><a href="#" title="Public Limited Company Registration">Public Limited Company Registration</a></li>
                                                        <li><a href="#" title="Private Limited Company Registration">Private Limited Company Registration</a></li>
                                                        <li><a href="#" title="One Person Company Registration"> One Person Company Registration</a></li>
                                                        <li><a href="#" title="Limited Liability Partnership">Limited Liability Partnership</a></li>
                                                        <li><a href="#" title="Partnership Firm">Partnership Firm</a></li>
                                                        <li><a href="#" title="Sole Proprietorship">Sole Proprietorship</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col s6 m6">
                                                    <h6>Special Entity </h6>
                                                    <ul class="float-none w100">
                                                        <li><a href="#" title="MSME Registration">MSME Registration</a></li>
                                                        <li><a href="#" title="Nidhi Company Registration">Nidhi Company Registration</a></li>
                                                        <li><a href="#" title="Section 8 Company Registration">Section 8 Company Registration</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>    
                                        </li>
                                    <li><a title="Tax & Compliance" <?php if($active=='Tax & Compliance')echo"class='hover'";?> href=" service.php">Tax & Compliance</a></li>
                                    <li><a title="Trademark & Copyright" <?php if($active=='Trademark & Copyright')echo"class='hover'";?> href=" service.php">Trademark & Copyright</a></li>
                                    <li><a title="E-Commerce" <?php if($active=='E-Commerce')echo"class='hover'";?> href=" service.php">E-Commerce</a></li>
                                    <li><a title="Contact Us" <?php if($active=='Contact Us')echo"class='hover'";?> href=" contact-us.php">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col s12 l1">
                                <ul class="cart">
                                    <li><a href="cart.php"><img src="images/top-icon5.png" alt="Cart"><span class="CartCount">0</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div id="menu" class="block sticky">