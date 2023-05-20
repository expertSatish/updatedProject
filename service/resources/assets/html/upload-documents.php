<?php
session_start();
ob_start();
$active='Upload Documents';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Upload Documents : Expert Bells</title>
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
                                <a class="breadcrumb">Upload Documents</a>
                            </div>
                        </div>
                    </div>
                    <h1 class="h2 Heading">Upload Documents</h1>
                </div>
            </div>
            <div class="row AccountPanel">
                <?php include('account-left.php'); ?>
                <div class="col s12 l9">
                    <div class="RightBlock">
                        <div class="row">
                            <div class="col s12">
                                <div class="ListBlock grey lighten-5"><h4 class="h5 fw-600 m0">Personl Documents</h4></div>
                                <div class="ListBlock">
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <h4 class="m0 mcolor1 h6">Aadhar Card</h4>
                                            <div class="row">
                                                <div class="col s12 l8">
                                                    <div class="file-field input-field mt0 mb20px">
                                                        <div class="btn">
                                                            <span>
                                                                <i class="icofont-upload-alt"></i>
                                                                Files to Upload
                                                            </span>
                                                            <input type="file">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 l4 Documents">
                                                    <div class="Img">
                                                        <img src="images/legal.png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <h4 class="m0 mcolor1 h6">Pan Card</h4>
                                            <div class="row">
                                                <div class="col s12 l8">
                                                    <div class="file-field input-field mt0 mb20px">
                                                        <div class="btn">
                                                            <span>
                                                                <i class="icofont-upload-alt"></i>
                                                                Files to Upload
                                                            </span>
                                                            <input type="file">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 l4 Documents">
                                                    <div class="Img">
                                                        <img src="images/legal.png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="ListBlock grey lighten-5"><h4 class="h5 fw-600 m0">Change Password</h4></div>
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
                                    </div>
                                </div> -->
                                <div class="ListBlock grey lighten-5 center"><button type="submit" class="btn btn-main">Upload</button></div>
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