<?php
session_start();
ob_start();
$active='Billing Details';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Successful : Expert Bells</title>
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
                            <a href="#" class="breadcrumb">Payment Successful</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="CartBlock">
                        <h3 class="h5 mcolor1 mt0 fw-500">Payment Successful</h3>
                        <div class="CartBox">
                            <div class="CartCall">
                                <div class="center">
                                    <h3 class="green-text m0 fw-900">Thank You!</h3>
                                    <p>thank you for placing order with us</p><br>
                                </div>
                                <div class="ItemBlock">
                                    <div class="ItemHead">
                                        <div class="row">
                                            <div class="col s12 l3">
                                                <div class="Img"><img src="images/careers.jpg"></div>
                                            </div>
                                            <div class="col s12 l9">
                                                <h4 class="h5"><a href="#">Advanced Return</a></h4>
                                                <span><strong>category:</strong> Package </span>
                                                <!-- <span>Matte Finishing | Blue Colour | 10x2x3 cm</span> -->
                                                <span><strong>Order ID:</strong> EXB0001</span>
                                                <h3 class="h6 m0 Price"><i class="icofont-rupee"></i> 299</h3>
                                                <div class="row valign-wrapper mt10px">
                                                    <div class="col s12">
                                                        <span>Ship on Thuesday, 22 March 2020</span>
                                                        <span class="green-text"><strong>Your Order Delivery</strong> on Monday, 26 March 2020</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ItemFoot">
                                        <div class="row">
                                            <div class="col s12 m6"><span><strong>Payment Mode: </strong> Net Banking</span></div>
                                            <div class="col s12 m6"><!-- <a href="#" class="Remove"><i class="icofont-trash"></i> Remove</a><a href="#" class="Edit"><i class="icofont-pencil"></i> Edit</a> --></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="CartCall">
                                <div>
                                    <!-- <div class="TopSteps">
                                        <span class="active"><span>Cart</span></span>
                                        <span class="active"><span>Billing Details</span></span>
                                        <span class="active"><span>Payment</span></span>
                                    </div> -->
                                    <ul class="track" data-track-steps="3">
                                        <li class="done tooltipped" data-position="bottom" data-tooltip="My Cart">
                                            <span>Cart</span>
                                        </li>
                                        <li class="done tooltipped" data-position="bottom" data-tooltip="Billing Details">
                                            <span>Billing Details</span>
                                        </li>
                                        <li class="done tooltipped" data-position="bottom" data-tooltip="Payment">
                                            <span>Payment</span>
                                        </li>
                                    </ul>
                                    <h4 class="h6">Price Details</h4>
                                    <div class="PriceDetails">
                                        <div><span>Total</span><span><i class="icofont-rupee"></i> 999</span></div>
                                        <div><span>Discount</span><span>-<i class="icofont-rupee"></i> 70</span></div>
                                        <div><span>IGST</span><span><i class="icofont-rupee"></i> 26</span></div>
                                        <div><span>Coupon Discount</span><span class="green-text"><i class="icofont-rupee"></i> 69</span></div>
                                        <!-- <div><span>Delivery</span><span><i class="icofont-rupee"></i> 80</span></div>
                                        <div><span class="FreeDel">Free Delivery</span><span>For order above <i class="icofont-rupee"></i>5000</span></div> -->
                                        <div><span class="FreeDel"></span><span></span></div>
                                    </div>
                                    <div class="PriceTotal">
                                        <div><span>Order Total</span><span><i class="icofont-rupee"></i> 1299</span></div>
                                    </div>
                                    <a href="#" class="btn btn-main">Place Order</a>
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
        // $(document).ready(function(){
        //     $('.Added').click(function(){
        //         if ($(this).hasClass('selected')){
        //             $(this).addClass('selected');
        //         } else {
        //             $('.Added').removeClass('selected');
        //             $(this).addClass('selected');
        //         }
        //     });
        // });
    </script>