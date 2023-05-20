<?php
ob_start();
$active = 'About Us';
?>
@include('inc.html')

<head>
    <title>{!! $meta->meta_title !!}</title>
    <meta name="keywords" content="{!! $meta->meta_keywords !!}">
    <meta name="description" content="{!! $meta->meta_description !!}">
    @include('inc.header')
    <section class="inner-banner about">
        <div class="parallax-container">
            <div class="section">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="{{url('/')}}" class="breadcrumb">Home</a>
                                <a href="{{url('/privacy-policy')}}" class="breadcrumb">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="{{asset('resources/assets/uploads/cms/'.$meta->text_4)}}" alt="{{$meta->meta_title}}"></div>
        </div>
    </section>
    <section class="Home pt20px">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h1 class="h3 Heading">{{$data->title}}</h1>
                    {!!$data->description!!}
                </div>
            </div>
        </div>
    </section>
    @include('inc.footer')