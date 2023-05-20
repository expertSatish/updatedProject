<?php
ob_start();
$active = '';
?>
@include('inc.html')

<head>
    <title>Thankyou : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/frontend/css/my-account.css')}}" media="screen,projection">
    @include('inc.header')
    <section class="inner-banner about">
        <div class="parallax-container">
            <div class="section">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="{{url('/')}}" class="breadcrumb">Home</a>
                                <a href="" class="breadcrumb">Thankyou</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="https://www.varistor.in/wp-content/uploads/2019/04/Thankyou-Banner.png" style="width: 100px!important;" alt="Thankyou"></div>
        </div>
    </section>

    <section class="Home grey lighten-4">
        <div class="container">
            <div class="row">
                <div class="col s12 center">
                    <h3 class="h2 Heading" data-aos="fade-down" data-aos-duration="900">Thank you</h3>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                      <p>Thank you for your inquiry.<br>If you have any question.please contact us.</p>  
                </div>
            </div>
            
        </div>
    </section>



    @include('inc.footer')
   