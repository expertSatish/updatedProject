<?php
session_start();
ob_start();
$active='Billing Details';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Billing Details : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/cart.css">
    <?php include('header.php'); ?>
    <section class="Home grey lighten-4 pt20px">
        <div class="breadcrumb-main">
            <div class="breadcrumb-bg">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <a href="index.php" class="breadcrumb">Home</a>
                            <a href="cart.php" class="breadcrumb">Cart</a>
                            <a href="#" class="breadcrumb">Billing Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="CartBlock">
                        <h3 class="h5 mcolor1 mt0 fw-500">Select Billing Address</h3>
                        <div class="CartBox">
                            <div class="CartCall">
                                <div class="row">
                                    <div class="col s12 l6">
                                        <div class="Add-Address" onclick="location.href='add-shipping-details.php';">
                                            <div class="center">
                                                <img src="images/address-img.svg">
                                                <span>Add new address</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="Add-Address Added selected">
                                            <div>
                                                <h3 class="h5 m0 fw-600">Address 1</h3>
                                                <span>Sam Web Studio</span>
                                                <p><span>2161/T-6, Office No: 3B, 1st Floor, Guru Arjun Nagar, Patel Nagar Main Road, Patel Nagar Main Road</span>
                                                New Delhi-110008, IN</p>
                                                <span><strong>Mobile No.</strong> (+91)-989 898 9898</span>
                                                <a href="#" class="Remove"><i class="icofont-trash"></i> Remove</a> &nbsp; <a href="add-shipping-details.php" class="Edit"><i class="icofont-pencil"></i> Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="Add-Address Added">
                                            <div>
                                                <h3 class="h5 m0 fw-600">Address 1</h3>
                                                <span>Sam Web Studio</span>
                                                <p><span>2161/T-6, Office No: 3B, 1st Floor, Guru Arjun Nagar, Patel Nagar Main Road</span>
                                                New Delhi-110008, IN</p>
                                                <span><strong>Mobile No.</strong> (+91)-989 898 9898</span>
                                                <a href="#" class="Remove"><i class="icofont-trash"></i> Remove</a> &nbsp; <a href="add-shipping-details.php" class="Edit"><i class="icofont-pencil"></i> Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="Add-Address Added">
                                            <div>
                                                <h3 class="h5 m0 fw-600">Address 1</h3>
                                                <span>Sam Web Studio</span>
                                                <p><span>2161/T-6, Office No: 3B, 1st Floor, Guru Arjun Nagar, Patel Nagar Main Road</span>
                                                New Delhi-110008, IN</p>
                                                <span><strong>Mobile No.</strong> (+91)-989 898 9898</span>
                                                <a href="#" class="Remove"><i class="icofont-trash"></i> Remove</a> &nbsp; <a href="add-shipping-details.php" class="Edit"><i class="icofont-pencil"></i> Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="CartCall">
                                <div>
                                    <!-- <div class="TopSteps">
                                        <span class="active"><span>Cart</span></span>
                                        <span class="active"><span>Billing Details</span></span>
                                        <span><span>Payment</span></span>
                                    </div> -->
                                    <ul class="track" data-track-steps="3">
                                        <li class="done tooltipped" data-position="bottom" data-tooltip="My Cart">
                                            <span>Cart</span>
                                        </li>
                                        <li class="done tooltipped" data-position="bottom" data-tooltip="Billing Details">
                                            <span>Billing Details</span>
                                        </li>
                                        <li class="tooltipped" data-position="bottom" data-tooltip="Payment">
                                            <span>Payment</span>
                                        </li>
                                    </ul>
                                    <h4 class="h6">Price Details</h4>
                                    <div class="PriceDetails">
                                        <div><span>Total</span><span><i class="icofont-rupee"></i> 999</span></div>
                                        <div><span>Discount</span><span>-<i class="icofont-rupee"></i> 70</span></div>
                                        <div><span>IGST</span><span><i class="icofont-rupee"></i> 26</span></div>
                                        <div><span>Coupon Discount</span><span class="green-text"><i class="icofont-rupee"></i> 69</span></div>
                                        <!-- <div><span>Delivery</span><span><i class="icofont-rupee"></i> 80</span></div> -->
                                        <!-- <div><span class="FreeDel">Free Delivery</span><span>For order above <i class="icofont-rupee"></i>5000</span></div> -->
                                        <div><span class="FreeDel"></span><span></span></div>
                                    </div>
                                    <div class="PriceTotal">
                                        <div><span>Order Total</span><span><i class="icofont-rupee"></i> 1299</span></div>
                                    </div>
                                    <a href="payment.php" class="btn btn-main">Place Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>
    <script type="text/javascript">
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
              object.value = object.value.slice(0, object.maxLength)
        }
        $(document).ready(function(){
            $('.Added').click(function(){
                if ($(this).hasClass('selected')){
                    $(this).addClass('selected');
                } else {
                    $('.Added').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
        });
    </script>