<?php
session_start();
ob_start();
$active='Orders';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Orders : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="css/my-account.css">
    <?php include('header.php'); ?>
    <section class="Home MyAccount pt10px grey lighten-5">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="breadcrumb-bg bnone position-r">
                        <div class="row">
                            <div class="col s12">
                                <a href="index.php" class="breadcrumb">Home</a>
                                <a href="my-account.php" class="breadcrumb">My Account</a>
                                <a class="breadcrumb">My Orders</a>
                            </div>
                        </div>
                    </div>
                    <h1 class="h2 Heading">My Orders</h1>
                </div>
            </div>
            <div class="row AccountPanel">
                <?php include('account-left.php'); ?>
                <div class="col s12 l9">
                    <div class="RightBlock">
                        <div class="row">
                            <div class="col s12">
                                <div class="SecTop">
                                    <div class="ProSce">
                                        <div class="mbg1 p10px">
                                            <div class="row">
                                                <div class="col s6">
                                                    <p class="m0 white-text"><strong>Order ID:</strong> GNX00001</p>
                                                </div>
                                                <div class="col s6 right-align">
                                                    <p class="m0 white-text fw-600">12, May 2020</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ListBlock">
                                            <div class="row">
                                                <div class="col s12 m7">
                                                    <h4 class="h6 fw-600 mcolor">Shipping Address</h4>
                                                    <p class="fs14"><strong>Manish Kumar,</strong><br>
                                                    Rz C6 A 3rd Floor, Gali 0, New Delhi, Near By Icici Atm,<br>New Delhi Delhi - 110000<br>
                                                    Mobile No: +91 9876543210</p>
                                                </div>
                                                <div class="col s12 m5">
                                                    <h4 class="h6 fw-600 mcolor">Order Summary</h4>
                                                    <div class="row">
                                                        <div class="col s6"><p class="m0 fs14 black-text">Patment Mode</p></div>
                                                        <div class="col s6 right-align"><p class="m0 fs14 black-text">Online</p></div>
                                                        <div class="col s6"><p class="m0 fs14">Price (5 items)</p></div>
                                                        <div class="col s6 right-align"><p class="m0 fs14"><span class="price">AED 375.00</span></p></div>
                                                        <div class="col s6"><p class="m0 fs14">Delivery</p></div>
                                                        <div class="col s6 right-align"><p class="m0 fs14"><span class="price">AED 25.00</span></p></div>
                                                        <div class="col s6"><p class="m0 black-text fs16 fw-600">Total Amount</p></div>
                                                        <div class="col s6 right-align"><p class="m0 black-text fs16 fw-600">AED 400.00</p></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ListBlock">
                                            <div class="row">
                                                <div class="col s12">
                                                    <ul class="track mt0" data-track-steps="4">
                                                        <li class="done tooltipped" data-position="bottom" data-tooltip="Order Confirmed<br>Aug 20, 2020, 7:29 AM"><span>Order Confirmed<br>Aug 20, 2020, 7:29 AM</span></li>
                                                        <li class="done tooltipped" data-position="bottom" data-tooltip="Shipped<br>Aug 21, 2020, 4:29 AM"><span>Shipped<br>Aug 21, 2020, 4:29 AM</span></li>
                                                        <li class="done tooltipped" data-position="bottom" data-tooltip="Dispatched<br>Aug 22, 2020, 6:34 PM"><span>Dispatched<br>Aug 22, 2020, 4:34 PM</span></li>
                                                        <li class="tooltipped" data-position="bottom" data-tooltip="Delivered"><span>Delivered</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ListBlock Acc-ProBlock">
                                            <div class="row">
                                                <div class="col s4 m2">
                                                    <div class="FProImg"><a href="#"><img src="images/img3.jpg" alt=""></a></div>
                                                </div>
                                                <div class="col s8 m6 l7">
                                                    <div class="FProText">
                                                        <h4 class="h6 m0"><a href="#">Public Limited Company Registration</a></h4>
                                                        <span class="price">$ 99/-</span>
                                                        <span class="odate"><strong>Order Date:</strong> 22 jan, 2021</span>
                                                    </div>
                                                </div>
                                                <div class="col s12 m4 l3 right-align">
                                                    <p class="mb0 fs12 grey-text fw-400 mr10px">Your item has been delivered</p>
                                                    <a href="#" class="btn btn-main1">Cancel Order</a>
                                                    <a href="#" class="btn btn-main">Download Invoice</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>