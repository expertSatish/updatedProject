<?php
session_start();
ob_start();
$active='My Account';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Wishlist : Expert Bells</title>
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
                                <a class="breadcrumb">My Wishlist</a>
                            </div>
                        </div>
                    </div>
                    <h1 class="h2 Heading">My Wishlist</h1>
                </div>
            </div>
            <div class="row AccountPanel">
                <div class="col s12 l3">
                    <div class="MyAccountMenu">
                        <span class='dropdown-trigger' data-target='dropdown1'><i class="material-icons menu-ico">menu</i> My Account Menu</span>
                        <ul class="LeftPanel dropdown-content" id="dropdown1">
                            <li><a href="my-account.php"><i class="icofont-dashboard"></i> Dashboard</a></li>
                            <li><a href="order.php"><i class="icofont-inbox"></i> My Orders</a></li>
                            <li><a href="account-setting.php"><i class="icofont-business-man"></i> Account Settings</a></li>
                            <li><a href="wishlist.php" class="active"><i class="icofont-heart-alt"></i> My Wishlist</a></li>
                            <li><a href=""><i class="icofont-power"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
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