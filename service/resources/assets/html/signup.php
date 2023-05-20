<?php
session_start();
ob_start();
$active='Login';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php include('header.php'); ?>
    <section class="Home Login">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="Blocks w60 left-align">
                        <h1 class="h4 Heading">Sign Up </h1>
                        <form action="my-account.php">
                            <div class="row">
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="first_name" type="text" class="validate">
                                        <label for="first_name">First Name</label>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="last_name" type="text" class="validate">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input type="text" class="validate">
                                        <label for="phone">Phone No.</label>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="email" type="email" class="validate">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="password" type="password" class="validate">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="c_password" type="password" class="validate">
                                        <label for="c_password">Confirm Password</label>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <label class="check"><input type="checkbox" class="filled-in" checked="checked"><span>I agree with terms of use and privacy</span></label>
                                    <button class="btn btn-main mt20px waves-effect waves-light" type="submit">Sign Up</button>
                                </div>
                                <div class="col s12 center">
                                    <h6 class="mt20px">Returning Customer? <a href="login.php"> Login in <i class="fa fa-long-arrow-right"></i></a></h6>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>