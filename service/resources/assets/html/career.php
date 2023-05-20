<?php
session_start();
ob_start();
$active='About Us';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Career : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php include('header.php'); ?>
    <section class="inner-banner about">
        <div class="parallax-container">
            <div class="section">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="index.php" class="breadcrumb">Home</a>
                                <a href="#" class="breadcrumb">Career</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="images/career-banner.jpg" alt="career"></div>
        </div>
    </section>
    <section class="Home">
        <div class="container">
            <div class="row valign-wrapper">
                <div class="col s12 m6">
                    <img src="images/careers.jpg" class="w100" alt="careers">
                </div>
                <div class="col s12 m6">
                    <h1 class="h3 Heading">Careers</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a href="#Careers" class="btn btn-main mt10px modal-trigger">Send Your Resume</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Structure -->
    <div id="Careers" class="modal customize">
        <div class="modal-content">
            <div class="center"><h4 class="h5 Heading mb10px">Send Your Resume</h4></div>
            <form method="POST" action="" id="contactform" class="ConForm" autocomplete="off" novalidate="novalidate">
                <div class="row">
                    <div class="col s12 l6">
                        <div class="input-field"><input id="first_name" type="text" class="validate"><label for="first_name">First Name</label></div>
                    </div>
                    <div class="col s12 l6">
                        <div class="input-field"><input id="email" type="email" class="validate"><label for="email">Email</label></div>
                    </div>
                    <div class="col s12 l6">
                        <div class="input-field"><input id="contactno" type="text" class="validate"><label for="contactno">Phone No.</label></div>
                    </div>
                    <div class="col s12 l6">
                        <div class="input-field"><input id="subject" type="text" class="validate"><label for="subject">Subject</label></div>
                    </div>
                    <div class="col s12">
                        <div class="input-field"><textarea id="textarea1" class="materialize-textarea"></textarea><label for="textarea1">Message</label></div>
                        <div class="file-field input-field">
                            <div class="btn btn-main"><span>File</span><input type="file"></div>
                            <div class="file-path-wrapper"><input class="file-path validate" type="text"></div>
                        </div>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col s12 center">
                        <button type="submit" class="btn btn-main">Submit</button> &nbsp; <button type="reset" class="btn btn-main1">Reset</button>
                    </div>
                </div>
            </form>
        </div>
        <a href="javascript:void(0);" class="modal-action modal-close h5">&#10005;</a>
    </div>

    <section class="Home grey lighten-4 pb30px">
        <div class="container">
            <div class="row valign-wrapper">
                <div class="col s12 l4">
                    <div class="Blocks white" data-aos="fade-up" data-aos-duration="900">
                        <img class="responsive-img" src="images/friendly.svg" width="100">
                        <h5>WE ARE FRIENDLY</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                  <div class="col s12 l4">
                    <div class="Blocks white" data-aos="fade-up" data-aos-duration="900">
                        <img class="responsive-img" src="images/ontime-payment.svg" width="100">
                        <h5>ONTIME PAYMENT</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                  <div class="col s12 l4">
                    <div class="Blocks white" data-aos="fade-up" data-aos-duration="900">
                        <img class="responsive-img" src="images/growth.svg" width="100">
                        <h5>ONTIME GROWTH</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>