<?php
session_start();
ob_start();
$active='Contact Us';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact Us : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php include('header.php'); ?>
    <!-- <section class="contact-header">
        <div class="container">
            <div class="mb-5 pb-3">
                <h1 class="h2 ">Contact us</h1>
                <p> Get in touch and let us know how we can help.</p>
            </div>
        </div>
    </section> -->
    <section class="inner-banner contact">
        <div class="parallax-container">
            <div class="section">
                <div class="container center">
                    <h1 class="lh-n h2 m0 mb20px fw-600">Contact Us</h1>
                    <ul class="breadcrumb-bg m0">
                        <li class="breadcrumb"><a href="index.php">Home</a></li>
                        <li class="breadcrumb"><a href="contact.php">About Us</a></li>
                    </ul>
                </div>
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="index.php" class="breadcrumb">Home</a>
                                <a href="#" class="breadcrumb">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="images/about_banner.jpg" alt="Contact Us"></div>
        </div>
    </section>
    <section class="Home Contact">
        <div class="container">
            <div class="margin_top">
                <div class="row">
                    <div class="col s12 l4">
                        <div class="contact_box "> <a href="tel:9149175204">
                            <figure><i class="fa fa-phone mcolor"></i></figure>
                            <h5 class="black-text"> Phone </h5>
                            <p class="mcolor1"> +91 9149175204 </p>
                        </a></div>
                    </div>
                    <div class="col s12 l4">
                        <div class="contact_box"> <a href="mailto:expertbellsconsulting@gmail.com">
                            <figure><i class="fa fa-envelope mcolor"></i></figure>
                            <h5 class="black-text"> Want to know more? </h5>
                            <p class="mcolor1"> expertbellsconsulting@gmail.com </p>
                        </a></div>
                    </div>
                    <div class="col s12 l4">
                        <div class="contact_box"> <a target="_blank" href="https://api.whatsapp.com/send/?phone=919149175204&text&app_absent=0">
                            <figure><i class="fa fa-whatsapp mcolor"></i></figure>
                            <h5 class="black-text"> Whatsapp </h5>
                            <p class="mcolor1"> +91 9149175204 </p>
                        </a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l7 lh0 push-l5 aos-init aos-animate" data-aos="fade-left" data-aos-duration="900">
                    <div class="img"><img src="images/contact.svg" class="w100"></div>
                </div>
                <div class="col s12 l5 pull-l7 aos-init aos-animate" data-aos="fade-right" data-aos-duration="900">
                    <div class="ContactForm">
                        <form action="" method="post">
                            <div class="input-field"><input type="text" name="name" id="name" placeholder="" required=""><label for="name" class="active">Name*</label></div>
                            <div class="input-field"><input type="email" name="email" id="email" placeholder="" required=""><label for="email" class="active">Email ID*</label></div>
                            <div class="input-field"><input type="number" name="contactno" id="contactno" maxlength="10" data-length="10" oninput="maxLengthCheck(this)" placeholder="" required=""><label for="contactno" class="active">Contact No.*</label></div>
                            <div class="input-field"><input type="text" name="subject" id="subject" placeholder="" required=""><label for="subject" class="active">Subject*</label></div>
                            <div class="input-field"><textarea name="message" id="message" class="materialize-textarea" maxlength="300" data-length="300" placeholder="" required=""></textarea><label for="message" class="active">Message*</label></div>
                            <div class="input-field"><button type="submit" class="btn btn-main waves-effect waves-light">Submit</button></div>
                        </form>
                    </div>
                    <div class="ContactInfo">
                        <h4 class="h5 mt0 white-text">Expert Bells Branches</h4>
                        <ul class="con-info">
                            <li><i class="icofont-map-pins"></i>6b Chanakya Puri, MG Road-2, Shahganj , Agra Uttar Pradesh, 282010.</li>
                            <li><i class="icofont-map-pins"></i> 369 Model Town, Vinoba Bihar, Jaipur, Rajasthan, 302017</li>
                            <!-- <li><i class="icofont-envelope"></i> <a href="mailto:contact@falconaviation.in">contact@falconaviation.in</a></li>
                            <li><i class="icofont-web"></i> <a href="http://www.falconaviation.in">www.falconaviation.in</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="Home Login">
        <div class="container">
            <div class="margin_top">
                <div class="row">
                    <div class="col s12 l4">
                        <div class="contact_box "> <a href="tel:9149175204">
                            <figure><i class="fa fa-phone mcolor1"></i></figure>
                            <h5 class="black-text"> Phone </h5>
                            <p class="mcolor1"> +91 9149175204 </p>
                        </a></div>
                    </div>
                    <div class="col s12 l4">
                        <div class="contact_box"> <a href="mailto:expertbellsconsulting@gmail.com">
                            <figure><i class="fa fa-envelope mcolor1"></i></figure>
                            <h5 class="black-text"> Want to know more? </h5>
                            <p class="mcolor1"> expertbellsconsulting@gmail.com </p>
                        </a></div>
                    </div>
                    <div class="col s12 l4">
                        <div class="contact_box"> <a target="_blank" href="https://api.whatsapp.com/send/?phone=919149175204&text&app_absent=0">
                            <figure><i class="fa fa-whatsapp mcolor1"></i></figure>
                            <h5 class="black-text"> Whatsapp </h5>
                            <p class="mcolor1"> +91 9149175204 </p>
                        </a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l4">
                    <h3 class="h4 Heading">Address</h3>
                    <ul class="con-info">
                        <li><i class="icofont-map-pins"></i>
                        <span>Expert Bells</span>
                        6b Chanakya Puri, MG Road-2, Shahganj , Agra Uttar Pradesh, 282010.</li>
                        <li><i class="icofont-map-pins"></i>
                        <span>Expert Bells</span>
                        369 Model Town, Vinoba Bihar, Jaipur, Rajasthan, 302017</li>
                    </ul>
                    <p>6b Chanakya Puri, MG Road-2, Shahganj , Agra Uttar Pradesh, 282010. </p>
                    <p>369 Model Town, Vinoba Bihar, Jaipur, Rajasthan, 302017 </p>
                </div>
                <div class="col s12 l8">
                    <div class="Blocks m0">
                        <h3 class="h4 Heading left-align">Have any query? </h3>
                        <form method="POST" action="" id="contactform" autocomplete="off" novalidate="novalidate">
                            <div class="row">
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="first_name" type="text" class="validate">
                                        <label for="first_name">First Name</label>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="last_name" type="text" class="validate">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input  type="text" class="validate">
                                        <label for="disabled">Phone No.</label>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="email" type="email" class="validate">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                                        <label for="textarea1">Message</label>
                                    </div>
                                    <div class="center"><button type="submit" class="btn btn-main mt30px">Submit</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <?php include('footer.php'); ?>