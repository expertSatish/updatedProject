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
                                            <a href="#" class="btn btn-main1">Cancel Order</a>
                                            <a href="#" class="btn btn-main">Download Invoice</a>
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
                                            <a href="#" class="btn btn-main1">Cancel Order</a>
                                            <a href="#" class="btn btn-main">Download Invoice</a>
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
    </section>
    <?php include('footer.php'); ?>