<?php
session_start();
ob_start();
$active='Home';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Taxes For Individuals & Businesses : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php include('header.php'); ?>
    <section class="blog pb0 pt20px Contact d-block">
        <div class="breadcrumb-main">
            <div class="breadcrumb-bg">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <a href="index.php" class="breadcrumb">Home</a>
                            <a href="#" class="breadcrumb">Online Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home TexeBlock Contact pt30px">
        <div class="container">
            <div class="center"><h2 class="h4 Heading">Online Payment</h2></div>
            <div class="row">
                <div class="col s12">
                    <div class="w70" data-aos="fade-right" data-aos-duration="900">
                        <div class="ContactForm">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="text" name="name" id="name" placeholder="" required=""><label for="name" class="active">Name*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="text" name="amount" id="amount" placeholder=""><label for="amount" class="active">Amount*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="email" name="email" id="email" placeholder="" required=""><label for="email" class="active">Email ID*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="number" name="contactno" id="contactno" maxlength="10" data-length="10" oninput="maxLengthCheck(this)" placeholder="" required=""><label for="contactno" class="active">Contact No.*</label></div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field"><textarea name="message" id="message" class="materialize-textarea" maxlength="300" data-length="300" placeholder="" required=""></textarea><label for="message" class="active">Message*</label></div>
                                    </div>
                                </div>
                                <div class="input-field center"><button type="submit" class="btn btn-main waves-effect waves-light">Pay Now</button></div>
                            </form>
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
    </script>