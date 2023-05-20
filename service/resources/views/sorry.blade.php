<?php
ob_start();
$active = 'About Us';
?>
@include('inc.html')
<head>
    <title>Sorry : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
    @include('inc.header')
    <section class="inner-banner about">
        <div class="parallax-container">
            <div class="section">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="{{url('/')}}" class="breadcrumb">Home</a>
                                <a href="" class="breadcrumb">Sorry</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="https://thumbs.dreamstime.com/b/failed-banner-template-ribbon-label-sign-177646739.jpg" style="width: 100px!important;" alt="Sorry"></div>
        </div>
    </section>

    <section class="Home grey lighten-4">
        <div class="container">
            <div class="row">
                <div class="col s12 center">
                    <h3 class="h2 Heading">{{$message}}</h3>
                </div>
            </div>
            
        </div>
    </section>



    @include('inc.footer')
   