<?php
session_start();
ob_start();
$active='Home';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Home : Expert Bells</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.css">
<?php include('header.php'); ?>
    <!-- <div class="main-slider">
        <div class="slider fullscreen">
            <ul class="slides">
                <li><img src="images/banner1.png" alt="">
					<div class="caption left-align" data-aos="fade-down" data-aos-duration="900">
                        <div>
                            <h1 class="mt0">Make Your Business<br><span>Compliance</span> Easy</h1>
                            <h6 class="mt30px h5 fw600">Taking Your Physical Business Into<br>The Online World ?</h6>
                            <a href="#" class="btn btn-main mt30px">Sign Up</a>
                        </div>
					</div>
				</li>
            </ul>
        </div>
    </div> -->
    <section class="Home MainSlider">
        <div class="container">
            <div class="row valign-wrapper">
                <div class="col s12 l5" data-aos="fade-down" data-aos-duration="900">
                    <h1 class="mt0">Make Your Business<br><span>Compliance</span> Easy</h1>
                    <h6 class="mt30px h5 fw600">Taking Your Physical Business Into<br>The Online World ?</h6>
                    <a href="#" class="btn btn-main mt30px">Sign Up</a>
                </div>
                <div class="col s12 l7">
                    <div class="BannerImg">
                        <span><span><span></span></span></span>
                        <div>
                            <div class="Text">
                                <h3 class="">Start-up <strong>Registration</strong></h3>
                                <h3 class="">Online Company <strong>Registration</strong></h3>
                                <h3 class="">GST <strong>Registration</strong></h3>
                                <h3 class="">Online Trademark <strong>Registration</strong></h3>
                                <h3 class="">Income Tax Return <strong>Filing</strong></h3>
                            </div>
                            <span><span><span></span></span></span>
                            <svg viewBox="0 0 47.11 40.68" class="LPinImage"><rect fill="#65256d" width="6.97" height="22.52"/><rect fill="#65256d" x="12.83" width="6.97" height="31.78"/><rect fill="#65256d" x="26.48" width="6.97" height="36.11"/><rect fill="#65256d" x="40.14" width="6.97" height="40.68"/></svg>
                            <img src="images/banner-img.svg" class="LPinImage1">
                            <img src="images/Laptop.png" class="w100">
                        </div>
                        <!-- <div class="coin"><img src="images/banner-coin.png"></div>
                        <img src="images/calculator.svg" class="calc"> -->
                        <!-- <img src="images/banner-table.svg" class="BannerT"> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home BannerBottom">
        <div class="container">
            <div class="row valign-wrapper">
                <div class="col s12" data-aos="fade-down" data-aos-duration="900">
                    <h3 class="h1 Heading">About Us</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book.<br><br>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book.</p>
                    <a href="about-us.php" class="btn btn-main3 mt10px">Read More <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                </div>
            </div>
        </div>
    </section>
    <section class="Home Plans pt0">
        <div class="container">
            <div class="row">
                <div class="col s12 center" data-aos="fade-down" data-aos-duration="900">
                    <h3 class="h1 Heading1">Our <span class="mcolor2">Plans</span></h3>
                    <div class="w70"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p></div>
                </div>
                <div class="col s12" data-aos="fade" data-aos-duration="900">
                    <div id="Plans" class="owl-carousel">
                        <div class="item">
                            <div>
                                <img src="images/Pimg.png">
                                <div class="Text">
                                    <h4 class="h6">Public Limited Company</h4>
                                    <p>Suitable for large scale businesses that require huge capital.</p>
                                    <p class="price">RS. <span>24999</span></p>
                                    <a href="service.php" class="btn btn-main3">View Plan <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div>
                                <img src="images/Pimg.png">
                                <div class="Text">
                                    <h4 class="h6">LLP Registration</h4>
                                    <p>Easy corporation and simple compliance formalities.</p>
                                    <p class="price">RS. <span>6499</span></p>
                                    <a href="service.php" class="btn btn-main3">View Plan <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div>
                                <img src="images/Pimg.png">
                                <div class="Text">
                                    <h4 class="h6">Trademark Registration</h4>
                                    <p>Get hassle-free Trademark registration</p>
                                    <p class="price">RS. <span>6499</span></p>
                                    <a href="service.php" class="btn btn-main3">View Plan <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div>
                                <img src="images/Pimg.png">
                                <div class="Text">
                                    <h4 class="h6">GST Registration</h4>
                                    <p>Get your business registered under GST.</p>
                                    <p class="price">RS. <span>1499</span></p>
                                    <a href="service.php" class="btn btn-main3">View Plan <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div>
                                <img src="images/Pimg.png">
                                <div class="Text">
                                    <h4 class="h6">Public Limited Company</h4>
                                    <p>Suitable for large scale businesses that require huge capital.</p>
                                    <p class="price">RS. <span>24999</span></p>
                                    <a href="service.php" class="btn btn-main3">View Plan <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home pt0">
        <div class="container">
            <div class="row">
                <div class="col s12 l6 right" data-aos="fade-left" data-aos-duration="900">
                    <h3 class="h1 Heading1 lh-n">Taxes for <span class="mcolor1">Individuals</span> & <span class="mcolor1">Businesses</span></h3>
                    <p class="h6">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <a href="taxes-for-individuals-and-businesses.php" class="btn btn-main3 mt10px">Read More <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                </div>
                <div class="col s12 l6 left" data-aos="fade-right" data-aos-duration="900">
                    <div class="TaxBlock w90">
                        <div class="img"><img src="images/Pimg.png"></div>
                        <div class="Text">
                            <h4 class="h6 m0">TAX FOR INDIVIDUALS</h4>
                            <p class="grey-text text-lighten">Get hassle-free Tax Individuals</p>
                        </div>
                        <div class="Price">
                            <p>RS. <span>6499</span></p>
                            <a href="taxes-for-individuals-and-businesses.php" class="btn btn-main3">Apply Now</a>
                        </div>
                    </div>
                    <div class="TaxBlock w90">
                        <div class="img"><img src="images/Pimg.png"></div>
                        <div class="Text">
                            <h4 class="h6 m0">TAX FOR INDIVIDUALS</h4>
                            <p class="grey-text text-lighten">Get hassle-free Tax Individuals</p>
                        </div>
                        <div class="Price">
                            <p>RS. <span>6499</span></p>
                            <a href="taxes-for-individuals-and-businesses.php" class="btn btn-main3">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home pt0">
        <div class="container">
            <div class="row">
                <div class="col s12 l5" data-aos="fade-right" data-aos-duration="900">
                    <h3 class="h1 Heading1 lh-n">Reasons why<br><span class="mcolor">customers choose us</span></h3>
                    <ul class="ul-list">
                        <li>No Hidden Charges</li>
                        <li>Confidential & Safe</li>
                        <li>Complete Satisfaction</li>
                        <li>Expert's Assistance</li>
                        <li>100+ Services</li>
                        <li>Fast Acting</li>
                    </ul>
                </div>
                <div class="col s12 l7" data-aos="fade-left" data-aos-duration="900">
                    <!-- <img src="images/HomeImg.svg" class="w100"> -->
                    <div class="ChooseImg">
                        <span></span>
                        <img src="images/ChooseImg.svg" style="z-index:3; position:relative;">
                        <img src="images/choose-bg-graph.svg" class="graph">
                        <svg class="MinGraph" viewBox="0 0 67.58 49.32">
                            <rect class="GraphBox" x="1.37" y="1.37" width="64.85" height="46.59" rx="3.4"/>
                            <path class="GraphLine" d="M534.54,1235c4.62,0,4.62-6.31,9.24-6.31s4.62-11.14,9.23-11.14,3.34,7.26,8,7.26,5.9-19,10.51-19,4.62,8.34,9.24,8.34,4.62-8.34,9.24-8.34" transform="translate(-528.46 -1192.92)"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home Blog pt0">
        <div class="container">
            <div class="row">
                <div class="col s12 center" data-aos="fade-down" data-aos-duration="900">
                    <h3 class="h1 Heading1">Our <span class="mcolor2">Blog</span></h3>
                </div>
                <div class="col s12" data-aos="fade" data-aos-duration="900">
                    <div id="Blog" class="owl-carousel">
                        <div class="item">
                            <div>
                                <div class="Img"><img src="images/img1.jpg"></div>
                                <div class="Text">
                                    <h4 class="h6"><a href="blog-details.php">Tax For Individuals</a></h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <a href="blog-details.php" class="btn btn-main3">Read More <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div>
                                <div class="Img"><img src="images/img2.jpg"></div>
                                <div class="Text">
                                    <h4 class="h6"><a href="blog-details.php">Tax For Individuals</a></h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <a href="blog-details.php" class="btn btn-main3">Read More <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div>
                                <div class="Img"><img src="images/img3.jpg"></div>
                                <div class="Text">
                                    <h4 class="h6"><a href="blog-details.php">Tax For Individuals</a></h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <a href="blog-details.php" class="btn btn-main3">Read More <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div>
                                <div class="Img"><img src="images/img1.jpg"></div>
                                <div class="Text">
                                    <h4 class="h6"><a href="blog-details.php">Tax For Individuals</a></h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <a href="blog-details.php" class="btn btn-main3">Read More <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home Clients pt0">
        <div class="row">
            <div class="col s12 center" data-aos="fade-down" data-aos-duration="900">
                <h3 class="h1 Heading1">Our <span class="mcolor1">Clients</span></h3>
            </div>
            <div class="col s12" data-aos="fade" data-aos-duration="900">
                <div id="Clients" class="owl-carousel">
                    <div class="item">
                        <div><img src="images/Clients-Img1.jpg"></div>
                    </div>
                    <div class="item">
                        <div><img src="images/Clients-Img2.jpg"></div>
                    </div>
                    <div class="item">
                        <div><img src="images/Clients-Img3.jpg"></div>
                    </div>
                    <div class="item">
                        <div><img src="images/Clients-Img4.jpg"></div>
                    </div>
                    <div class="item">
                        <div><img src="images/Clients-Img5.jpg"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home Testimonial pt0">
        <div class="container">
            <div class="row">
                <div class="col s12" data-aos="fade-down" data-aos-duration="900">
                    <h3 class="h1 Heading1">Our Customer <span class="mcolor">Reviews</span></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12" data-aos="fade" data-aos-duration="900">
                <div id="Testimonial" class="owl-carousel">
                    <div class="item">
                        <div>
                            <span class="h1 lh-n mcolor1">"</span>
                            <div class="img"><img src="images/test-img.jpg"></div>
                            <p class="fs13 mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                            <div class="right">
                                <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                                <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div>
                            <span class="h1 lh-n mcolor1">"</span>
                            <div class="img"><img src="images/test-img.jpg"></div>
                            <p class="fs13 mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                            <div class="right">
                                <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                                <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div>
                            <span class="h1 lh-n mcolor1">"</span>
                            <div class="img"><img src="images/test-img.jpg"></div>
                            <p class="fs13 mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                            <div class="right">
                                <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                                <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div>
                            <span class="h1 lh-n mcolor1">"</span>
                            <div class="img"><img src="images/test-img.jpg"></div>
                            <p class="fs13 mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                            <div class="right">
                                <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                                <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div>
                            <span class="h1 lh-n mcolor1">"</span>
                            <div class="img"><img src="images/test-img.jpg"></div>
                            <p class="fs13 mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                            <div class="right">
                                <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                                <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div>
                            <span class="h1 lh-n mcolor1">"</span>
                            <div class="img"><img src="images/test-img.jpg"></div>
                            <p class="fs13 mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                            <div class="right">
                                <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                                <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include('footer.php'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- <script type="text/javascript" src="js/owl.carousel.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#Plans").owlCarousel({items:5, loop:false, dots:false, nav:true, responsiveClass:true, responsive:{250:{items:1}, 320:{items:1}, 460:{items:2}, 600:{items:2}, 768:{items:3}, 992:{items:4}, 1200:{items:4}, 1600:{items:5}}});
        $("#Blog").owlCarousel({items:4, loop:false, dots:false, nav:true, responsiveClass:true, responsive:{250:{items:1}, 320:{items:1}, 460:{items:2}, 600:{items:2}, 768:{items:3}, 992:{items:3}, 1200:{items:3}, 1600:{items:4}}});
        $("#Clients").owlCarousel({items:6, center:true, loop:true, dots:false, nav:true, autoplay:true, autoplayTimeout:3000, autoplayHoverPause:true, responsiveClass:true, responsive:{250:{items:1}, 320:{items:2}, 460:{items:2}, 600:{items:3.6}, 768:{items:4}, 992:{items:4}, 1200:{items:6}, 1600:{items:6}}});
        $("#Testimonial").owlCarousel({items:5, center:true, loop:true, dots:true, nav:false, autoplay:true, autoplayTimeout:4000, autoplayHoverPause:true, responsiveClass:true, responsive:{250:{items:1}, 320:{items:1}, 460:{items:2}, 600:{items:3}, 768:{items:3}, 992:{items:4}, 1200:{items:4}, 1400:{items:5}}});
    });
</script>