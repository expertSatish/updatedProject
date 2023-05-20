<?php
session_start();
ob_start();
$active='My Account';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Account : Expert Bells</title>
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
                                <a class="breadcrumb">My Account</a>
                            </div>
                        </div>
                    </div>
                    <h1 class="h2 Heading">My Account</h1>
                </div>
            </div>
            <div class="row AccountPanel">
                <?php include('account-left.php'); ?>
                <div class="col s12 l9">
                    <div class="RightBlock">
                        <div class="row">
                            <div class="col s12 l4">
                                <div class="ListBlock">
                                    <div class="ListText">
                                        <i class="icofont-inbox"></i>
                                        <div>
                                            <h3 class="m0 fs18">My Orders</h3>
                                            <span>(9) <a href="order.php">View More</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 l4">
                                <div class="ListBlock">
                                    <div class="ListText">
                                        <i class="icofont-business-man"></i>
                                        <div>
                                            <h3 class="m0 fs18">Account Settings</h3>
                                            <span><a href="account-setting.php">View More</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col s12 l4">
                                <div class="ListBlock">
                                    <div class="ListText">
                                        <i class="icofont-heart-alt"></i>
                                        <div>
                                            <h3 class="m0 fs18">My Wishlist</h3>
                                            <span>(9) <a href="wishlist.php">View More</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>