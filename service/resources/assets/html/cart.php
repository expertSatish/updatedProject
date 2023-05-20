<?php
session_start();
ob_start();
$active='Cart';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cart : Expert Bells</title>
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
                            <a href="#" class="breadcrumb">Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="CartBlock">
                        <h3 class="h5 mcolor1 mt0 fw-500">My Cart</h3>
                        <div class="CartBox">
                            <div class="CartCall">
                                <div class="row">
                                    <div class="col s6"><h6>1 item Added</h6></div>
                                    <div class="col s6"><h6>Total: <i class="icofont-rupee"></i> 999</h6></div>
                                </div>
                                <div class="ItemBlock">
                                    <div class="ItemHead">
                                        <div class="row">
                                            <div class="col s12 l3">
                                                <div class="Img"><img src="images/careers.jpg"></div>
                                            </div>
                                            <div class="col s12 l9">
                                                <h4 class="h5"><a href="#">Advanced Return</a></h4>
                                                <span><strong>category plan:</strong> Advanced Return </span>
                                                <!-- <span>Matte Finishing | Blue Colour | 10x2x3 cm</span> -->
                                                <span class="paglist">Income Tax Return Filing, Professionals Income, Rent Income, Other Source Income, Deductions, 26AS Reconsilation</span>
                                                <h3 class="h6 m0 Price"><i class="icofont-rupee"></i> 299</h3>
                                                <div class="row valign-wrapper mt30px">
                                                    <div class="col s12 m6">
                                                        <div class="input-field">
                                                            <input type="text" name="qty" id="qty" class="number" value="1">
                                                            <input type="button" onclick="decrement_quantity()" value="-" class="value-button decrease" field="quantity">
                                                            <input type="button" onclick="increment_val()" value="+" class="value-button decrease" field="quantity">
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6 QRight">
                                                        <span>Ship on Thuesday, 22 March 2020</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ItemFoot">
                                        <div class="row">
                                            <div class="col s12 m6"><span><strong>Production Mode: </strong></span></div>
                                            <div class="col s12 m6"><a href="#" class="Remove"><i class="icofont-trash"></i> Remove</a><a href="#" class="Edit"><i class="icofont-pencil"></i> Edit</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ItemBlock">
                                    <div class="ItemHead">
                                        <div class="row">
                                            <div class="col s12 l3">
                                                <div class="Img"><img src="images/careers.jpg"></div>
                                            </div>
                                            <div class="col s12 l9">
                                                <h4 class="h5"><a href="#">Advanced Return</a></h4>
                                                <span><strong>category plan:</strong> Advanced Return </span>
                                                <!-- <span>Matte Finishing | Blue Colour | 10x2x3 cm</span> -->
                                                <span class="paglist">Income Tax Return Filing, Professionals Income, Rent Income, Other Source Income, Deductions, 26AS Reconsilation</span>
                                                <h3 class="h6 m0 Price"><i class="icofont-rupee"></i> 299</h3>
                                                <div class="row valign-wrapper mt30px">
                                                    <div class="col s12 m6">
                                                        <div class="input-field">
                                                            <input type="text" name="qty" id="qty" class="number" value="1">
                                                            <input type="button" onclick="decrement_quantity()" value="-" class="value-button decrease" field="quantity">
                                                            <input type="button" onclick="increment_val()" value="+" class="value-button decrease" field="quantity">
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6 QRight">
                                                        <span>Ship on Thuesday, 22 March 2020</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ItemFoot">
                                        <div class="row">
                                            <div class="col s12 m6"><span><strong>Production Mode: </strong></span></div>
                                            <div class="col s12 m6"><a href="#" class="Remove"><i class="icofont-trash"></i> Remove</a><a href="#" class="Edit"><i class="icofont-pencil"></i> Edit</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ItemBlock">
                                    <div class="ItemHead">
                                        <div class="row">
                                            <div class="col s12 l3">
                                                <div class="Img"><img src="images/careers.jpg"></div>
                                            </div>
                                            <div class="col s12 l9">
                                                <h4 class="h5"><a href="#">Advanced Return</a></h4>
                                                <span><strong>category plan:</strong> Advanced Return </span>
                                                <!-- <span>Matte Finishing | Blue Colour | 10x2x3 cm</span> -->
                                                <span class="paglist">Income Tax Return Filing, Professionals Income, Rent Income, Other Source Income, Deductions, 26AS Reconsilation</span>
                                                <h3 class="h6 m0 Price"><i class="icofont-rupee"></i> 299</h3>
                                                <div class="row valign-wrapper mt30px">
                                                    <div class="col s12 m6">
                                                        <div class="input-field">
                                                            <input type="text" name="qty" id="qty" class="number" value="1">
                                                            <input type="button" onclick="decrement_quantity()" value="-" class="value-button decrease" field="quantity">
                                                            <input type="button" onclick="increment_val()" value="+" class="value-button decrease" field="quantity">
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6 QRight">
                                                        <span>Ship on Thuesday, 22 March 2020</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ItemFoot">
                                        <div class="row">
                                            <div class="col s12 m6"><span><strong>Production Mode: </strong></span></div>
                                            <div class="col s12 m6"><a href="#" class="Remove"><i class="icofont-trash"></i> Remove</a><a href="#" class="Edit"><i class="icofont-pencil"></i> Edit</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="CartCall">
                                <div>
                                    <!-- <div class="TopSteps">
                                        <span class="active"><span>Cart</span></span>
                                        <span><span>Billing Details</span></span>
                                        <span><span>Payment</span></span>
                                    </div> -->
                                    <ul class="track" data-track-steps="3">
                                        <li class="done tooltipped" data-position="bottom" data-tooltip="My Cart">
                                            <span>Cart</span>
                                        </li>
                                        <li class="tooltipped" data-position="bottom" data-tooltip="Billing Details">
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
                                    <a href="shipping-details.php" class="btn btn-main">Place Order</a>
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
        function increment_val(){
            var da=$("#qty").val();
            var newQuantity = parseInt(da)+1;
            $("#qty").val(newQuantity);
        } 
        function decrement_quantity(){
            var da=$("#qty").val();
            var inputQuantityElement = $("#qty");
            if($(inputQuantityElement).val() > 1) {
                var newQuantity = parseInt(da)-1;
                $("#qty").val(newQuantity);
            }
        }
    </script>