<?php
session_start();
ob_start();
$active='Login';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php include('header.php'); ?>
    <section class="Home Login">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="Blocks w50 left-align">
                        <div class="p10px">
                        <h1 class="h4 Heading">Login </h1>
                        <form action="my-account.php">
                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="email" type="text" class="validate">
                                        <label for="email">Email ID</label>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="password" type="password" class="validate">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <button class="btn btn-main mt20px waves-effect waves-light" type="submit">Log in</button>
                                </div>
                                <div class="col s12 center">
                                    <h6 class="center-align">New Customer? <a href="signup.php">Sign up <i class="fa fa-long-arrow-right"></i></a></h6>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>