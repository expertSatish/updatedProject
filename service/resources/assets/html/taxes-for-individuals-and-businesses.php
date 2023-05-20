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
    <section class="inner-banner about Services">
        <div class="parallax-container">
            <div class="section pt60px pb60px">
                <div class="container">
                    <div class="row d-flex">
                        <div class="col s12 l6" data-aos="fade-down" data-aos-duration="900">
                            <h1 class="h2 Heading black-text">TDS RETURN <br><span class="mcolor">FILING</span></h1>
                            <h5 class="fw600 black-text">Get your TDS Filing done easily with our experts.</h5>
                            <ul class="ul-list1">
                                <li>Accurate Return Filing</li>
                                <li>Dedicated Tax Expert & Account Manager</li>
                                <li>Completely Hassle Free</li>
                            </ul>
                        </div>
                        <div class="col s12 l6">
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="index.php" class="breadcrumb">Home</a>
                                <a href="#" class="breadcrumb">TDS Return Filing</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="images/form-banner2.jpg" alt="Public Limited Company"></div>
        </div>
    </section>
    <section class="Home TexeBlock Contact">
        <div class="container">
            <div class="center"><h2 class="h3 Heading">Taxes for Individuals & Businesses</h2></div>
            <div class="row">
                <div class="col s12 l5">
                    <h3 class="m0 h4 mcolor1">File your income tax return in minutes online. Just upload documents</h3>
                    <p>IndiaFilings makes it easy for individuals and businesses to file their income tax return online. Just upload your Form 16 to get started.</p>
                    <h4 class="m0 h6 fw-600">Document required for income tax filing</h4>
                    <ul class="ul-list1">
                        <li>Form 16 (Taxpayers having salary income)</li>
                        <li>Bank Statements</li>
                        <li>Details of Investments (Optional)</li>
                        <li>Details of Insurance & Loans (Optional)</li>
                        <li>PAN Copy (Optional)</li>
                        <li>Aadhaar Copy (Optional)</li>
                    </ul>
                </div>
                <div class="col s12 l7">
                    <div data-aos="fade-right" data-aos-duration="900">
                        <div class="ContactForm">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="text" name="pan" id="pan" placeholder="" required=""><label for="pan" class="active">PAN*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="text" name="name" id="name" placeholder="" required=""><label for="name" class="active">Name*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="email" name="email" id="email" placeholder="" required=""><label for="email" class="active">Email ID*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="number" name="contactno" id="contactno" maxlength="10" data-length="10" oninput="maxLengthCheck(this)" placeholder="" required=""><label for="contactno" class="active">Contact No.*</label></div>
                                    </div>
                                    <div class="col s12">
                                        <label class="black-text">INCOME TAX DOCUMENTS</label>
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
                                    <div class="col s12">
                                        <div class="input-field"><textarea name="message" id="message" class="materialize-textarea" maxlength="300" data-length="300" placeholder="" required=""></textarea><label for="message" class="active">Message*</label></div>
                                    </div>
                                </div>
                                <div class="input-field center"><button type="submit" class="btn btn-main waves-effect waves-light">Submit</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="Home pt0">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h3 class="h2 Heading">FAQs</h3>
                    <ul class="collapsible faqs">
                        <li class="active" data-aos="fade-up" data-aos-duration="900">
                            <div class="collapsible-header">What are the pre-requisites for incorporation of Public Limited Company in India?</div>
                            <div class="collapsible-body"><span>There should be 7 Shareholders and 3 Directors with minimum Rs 5 Lac of paid-up share capital.</span></div>
                        </li>
                        <li data-aos="fade-up" data-aos-duration="900">
                            <div class="collapsible-header">What are the pre-requisites for incorporation of Public Limited Company in India?</div>
                            <div class="collapsible-body"><span>There should be 7 Shareholders and 3 Directors with minimum Rs 5 Lac of paid-up share capital.</span></div>
                        </li>
                        <li data-aos="fade-up" data-aos-duration="900">
                            <div class="collapsible-header">What are the pre-requisites for incorporation of Public Limited Company in India?</div>
                            <div class="collapsible-body"><span>There should be 7 Shareholders and 3 Directors with minimum Rs 5 Lac of paid-up share capital.</span></div>
                        </li>
                        <li data-aos="fade-up" data-aos-duration="900">
                            <div class="collapsible-header">What are the pre-requisites for incorporation of Public Limited Company in India?</div>
                            <div class="collapsible-body"><span>There should be 7 Shareholders and 3 Directors with minimum Rs 5 Lac of paid-up share capital.</span></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->
    <?php include('footer.php'); ?>
    <script>
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
              object.value = object.value.slice(0, object.maxLength)
        }
    </script>