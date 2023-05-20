<?php
session_start();
ob_start();
$active='Review & Ratings';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Review & Ratings : Expert Bells</title>
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
                                <a class="breadcrumb">Review & Ratings</a>
                            </div>
                        </div>
                    </div>
                    <h1 class="h2 Heading">Review & Ratings</h1>
                </div>
            </div>
            <div class="row AccountPanel">
                <?php include('account-left.php'); ?>
                <div class="col s12 l9">
                    <div class="RightBlock">
                        <div class="ViewBlock">
                            <div class="ViewContent">
                                <form class="ReviewForm" action="" method="post">
                                    <div class="row">
                                        <div class="col s12">
                                            <h6 class="m0 black-text h5">Be the first to review "Product Name"</h6>
                                            <p class="mt0 fs13">Your email address will not be published. Required fields are marked *</p>
                                        </div>
                                        <div class="col s12 m7">
                                            <label class="fw-600 fs13 black-text">Your Rating</label><br>
                                            <div class="rating mt10px">
                                                <input type="radio" name="rating" id="rating-5">
                                                <label for="rating-5"></label>
                                                <input type="radio" name="rating" id="rating-4">
                                                <label for="rating-4"></label>
                                                <input type="radio" name="rating" id="rating-3">
                                                <label for="rating-3"></label>
                                                <input type="radio" name="rating" id="rating-2">
                                                <label for="rating-2"></label>
                                                <input type="radio" name="rating" id="rating-1">
                                                <label for="rating-1"></label>
                                                <div class="emoji-wrapper">
                                                    <div class="emoji">
                                                        <img src="images/rating.svg" class="rating-0">
                                                        <img src="images/rating1.svg">
                                                        <img src="images/rating2.svg">
                                                        <img src="images/rating3.svg">
                                                        <img src="images/rating4.svg">
                                                        <img src="images/rating5.svg">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m7">
                                            <div class="input-field"><input type="text" name="name" id="name" required><label for="name">Name *</label></div>
                                        </div>
                                        <div class="col s12 m7">
                                            <div class="input-field"><input type="email" name="email" id="email" required><label for="email">Email ID *</label></div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field"><textarea name="message" class="materialize-textarea" maxlength="300" data-length="300" id="message" required></textarea><label for="message">Message</label></div>
                                        </div>
                                        <div class="col s12"><div class="input-field"><button type="submit" class="btn btn-main">Submit</button></div></div>
                                    </div>
                                </form>
                            </div>
                            <div class="ViewContent ReviewBlock">
                                <p class="m0 mb5px fw-900">Balloon Features</p>
                                <p class="mt0 fs13">very happy with the product, however it's very delicate.. if you could include usage instructions it would make it perfect.</p>
                                <span class="stars m0">&#9733;&#9733;&#9733;&#9733;<span>&#9733;</span></span>
                                <span class="grey-text fs12 right">Monday, Jul 26, 2019</span>
                            </div>
                            <div class="ViewContent ReviewBlock">
                                <p class="m0 mb5px fw-900">Balloon Features</p>
                                <p class="mt0 fs13">very happy with the product, however it's very delicate.. if you could include usage instructions it would make it perfect.</p>
                                <span class="stars m0">&#9733;&#9733;&#9733;&#9733;<span>&#9733;</span></span>
                                <span class="grey-text fs12 right">Monday, Jul 26, 2019</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>
    <script>
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
              object.value = object.value.slice(0, object.maxLength)
        }
        (function($) {
            $(function() {
                $(document).ready(function(){
                    $('#pass-icon').click(function(){
                        if ($(this).hasClass('fa-eye')){
                            $(this).removeClass('fa-eye');
                            $(this).addClass('fa-eye-slash');
                            $('.opass').attr('type', 'password');
                        } else {
                            $(this).removeClass('fa-eye-slash');
                            $(this).addClass('fa-eye');
                            $('.opass').attr('type', 'text');
                        }
                    });
                    $('#npass-icon').click(function(){
                        if ($(this).hasClass('fa-eye')){
                            $(this).removeClass('fa-eye');
                            $(this).addClass('fa-eye-slash');
                            $('.pass').attr('type', 'password');
                        } else {
                            $(this).removeClass('fa-eye-slash');
                            $(this).addClass('fa-eye');
                            $('.pass').attr('type', 'text');
                        }
                    });
                    $('#cpass-icon').click(function(){
                        if ($(this).hasClass('fa-eye')){
                            $(this).removeClass('fa-eye');
                            $(this).addClass('fa-eye-slash');
                            $('.cpass').attr('type', 'password');
                        } else {
                            $(this).removeClass('fa-eye-slash');
                            $(this).addClass('fa-eye');
                            $('.cpass').attr('type', 'text');
                        }
                    });
                });
            });
        })(jQuery);
    </script>