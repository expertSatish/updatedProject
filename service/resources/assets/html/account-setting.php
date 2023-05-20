<?php
session_start();
ob_start();
$active='Account Setting';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account Setting : Expert Bells</title>
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
                                <a class="breadcrumb">Account Setting</a>
                            </div>
                        </div>
                    </div>
                    <h1 class="h2 Heading">Account Setting</h1>
                </div>
            </div>
            <div class="row AccountPanel">
                <?php include('account-left.php'); ?>
                <div class="col s12 l9">
                    <div class="RightBlock">
                        <div class="row">
                            <div class="col s12">
                                <div class="ListBlock grey lighten-5"><h4 class="h5 fw-600 m0">Personl Details</h4></div>
                                <div class="ListBlock">
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="text" name="fname" id="fname" value="Avdhesh Kumar" class="inputtext" required><label for="fname" class="inputlabel">Full Name</label></div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="number" name="contactno" id="contactno1" value="9899965076" class="inputtext" maxlength="10" oninput="maxLengthCheck(this)" required><label for="contactno1" class="inputlabel d-none">Contact Number</label></div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="text" class="inputtext datepicker" name="date" id="date" value="Jun 16, 2020" required><label for="date" class="inputlabel d-none">Date of Birth</label></div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field row mt10px">
                                                <div class="col s3"><span>Gender *</span></div>
                                                <div class="col s9">
                                                    <div class="radio-btn">
                                                        <div class="radio-btn-main">
                                                            <input type="radio" name="radio" id="radio1" class="inputtext" checked>
                                                            <label for="radio1"><i class="icofont-business-man-alt-2"></i> Male</label>
                                                        </div>
                                                        <div class="radio-btn-main">
                                                            <input type="radio" name="radio" id="radio2" class="inputtext">
                                                            <label for="radio2"><i class="icofont-girl-alt"></i> Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ListBlock grey lighten-5"><h4 class="h5 fw-600 m0">Change Password</h4></div>
                                <div class="ListBlock">
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <div class="mb20px">
                                                <div class="input-field passw">
                                                    <input type="password" name="opass" id="opass" value="password" class="opass inputtext" required><label for="opass" class="inputlabel">Current Password</label><i id="pass-icon" class="mt10px fa fa-eye-slash"></i>
                                                </div>
                                            </div>
                                            <div class="mb20px">
                                                <div class="input-field passw">
                                                    <input type="password" name="npass" id="npass" value="password" class="pass inputtext" required><label for="npass" class="inputlabel">New Password</label><i id="npass-icon" class="mt10px fa fa-eye-slash"></i>
                                                </div>
                                            </div>
                                            <div class="mb20px">
                                                <div class="input-field passw">
                                                    <input type="password" name="cpass" id="cpass" value="password" class="cpass inputtext" required><label for="cpass" class="inputlabel">Confirm Password</label><i id="cpass-icon" class="mt10px fa fa-eye-slash"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <h5 class="m0 mcolor1 h6 fw-600">Subscription</h5>
                                            <label class="check"><input type="checkbox" class="filled-in" checked="checked"><span>I agree with Newsletter/ Subscription</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="ListBlock grey lighten-5 center"><button type="submit" class="btn btn-main">Save</button></div>
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