<?php
ob_start();
$active = 'service';
?>
@include('inc.html')

<head>
<title>{!! $meta->meta_title !!}</title>
<meta name="keywords" content="{!! $meta->meta_keywords !!}">
<meta name="description" content="{!! $meta->meta_description !!}">
<style>.shorttext{transition:all .5s;font-size:14px;margin:0;color:#333;display:-webkit-box;overflow:hidden!important;-webkit-box-orient:vertical;-webkit-line-clamp:3;height:95px!important}
.shorttext p{overflow:hidden!important}</style>
<style>
/* width */
::-webkit-scrollbar{width: 5px;}
/* Track */
::-webkit-scrollbar-track{background: #f1f1f1;}
/* Handle */
::-webkit-scrollbar-thumb{background: #602169;}
/* Handle on hover */
::-webkit-scrollbar-thumb:hover{background: #602169;}
</style>
@include('inc.header')
<section class="inner-banner about">
    <div class="parallax-container">
        <div class="section">
            <div class="breadcrumb-bg">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <a href="{{url('/')}}" class="breadcrumb">Home</a>
                            <a href="{{url('/blog')}}" class="breadcrumb">{{$meta->text_1}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="{{asset('resources/assets/uploads/cms/'.$meta->text_4)}}" alt="{{$meta->meta_title}}"></div>
    </div>
</section>
<style>
    .linkcard ul{margin:0;}
    .linkcard ul li a{font-size:13px; color:#666;}
    .linkcard ul li a h2{font-size:18px!important; color:#000!important; margin:0 0 6px!important;}
    .linkcard ul li ul li{margin:0!important}
</style>
<section class="Home Blog Blog-listing pt30px">
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1 class="Heading1">Our <span class="mcolor2">Services</span></h1>
            </div>
            @if(count($services)>0)
            <div class="row">
                <div class="col s12 m6">
                    <div class="linkcard card">
                        <div class="card-content" style="overflow-y: auto;max-height: 500px;">
                            {!! $Result !!}
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="linkcard card">
                        <div class="card-content" style="overflow-y: auto;max-height: 500px;">
                            {!! $Result2 !!}
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-12 center" style="padding-top:8%;">
                <strong class="h5">Sorry! No Data Found...</strong>
            </div>
            @endif

        </div>
    </div>
</section>
@include('inc.footer')