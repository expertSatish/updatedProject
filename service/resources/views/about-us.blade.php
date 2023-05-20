<?php
ob_start();
$active = 'About Us';
?>
@include('inc.html')
<head>
    <title>{!! $meta->meta_title !!}</title>
    <meta name="keywords" content="{!! $meta->meta_keywords !!}">
    <meta name="description" content="{!! $meta->meta_description !!}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
    <style type="text/css">
        .TestSec .active{z-index:2}
        .TestSec .active .item .card{box-shadow:0 5px 12px rgb(0 0 0/.2)}
        .TestSec .active .item .card::after{opacity:1}
        .TestSec .active .item .card .text p{color:#000!important}
        .TestSec .active .item .card .nametext p{color:#666!important}
        .TestSec .active .item .card .nametext h4{color:#066531}
        .TestSec .card{border-radius:15px;position:relative;color:#000;border:none;width:calc(100% - 38px);margin:20px 12px;margin-left:auto;padding:20px;background:#fff;box-shadow:0 5px 12px rgb(0 0 0/.2);transition:all .5s}
        .TestSec .card::after{position:absolute;content:'';z-index:0;height:100%;width:100%;left:0;top:0;opacity:0;border-radius:15px 150px 15px 60px;background:linear-gradient(-45deg, rgb(220 220 220) 0, rgb(255 255 255) 75%);transition:all .5s}
        .TestSec .card>div{position:relative;z-index:1;}
        .TestSec .card>div.text{min-height:105px}
        .TestSec .card .img{width:99px;margin:-35px 0 0 -40px;height:99px;border-radius:50%;background:#eee;box-shadow:0 3px 8px rgb(0 0 0/.2);position:relative;overflow:hidden;transition:all .5s}
        .TestSec .card .img img{width:100%;min-height:100%; border-radius:50%; border:5px solid #fff}
        .TestSec .card .img::after{position:absolute;content:'';height:100%;width:100%;border-radius:50%;background:transparent;box-shadow:0 0 6px rgb(0 0 0/.4);z-index:-1}
        .TestSec .card .nametext{width:calc(100% - 80px);margin-left:auto;color:#000;text-align:left}
        .TestSec .card .nametext p{color:#888!important;transition:all .5s}
        .TestSec .card .text p,.TestSec .card .text p~*{font-size:15px!important;color:#000!important;line-height:170%!important;/*display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:5;*/transition:all .5s;background:none!important;margin:9px 0 0!important}
        .TestSec .owl-nav{position:static;margin:0 auto;height:auto;width:80px;transition:all .5s;display:flex;justify-content:space-between}
        .TestSec .owl-nav button.owl-next,.TestSec .owl-nav button.owl-prev{width:32px!important;height:32px!important;border-radius:50%!important;opacity:1!important;position:static!important;transition:all .5s}
        .TestSec .owl-nav button.owl-next span,.TestSec .owl-nav button.owl-prev span{line-height:32px;font-size:28px;margin-top:-6px}
        .TestSec .owl-nav button.owl-next:hover,.TestSec .owl-nav button.owl-prev:hover{box-shadow:0 4px 6px rgb(0 0 0/.4);opacity:1}
        @media  only screen and (max-width:600px){.TestSec .card>div.d-flex{display:block!important;}
        .TestSec .card,.TestSec .card .nametext{width:100%!important;text-align:center;}
        .TestSec .card .img{margin:-65px auto 12px}}
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
                                <a href="{{url('/about-us')}}" class="breadcrumb">About Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="{{asset('resources/assets/uploads/cms/'.$meta->text_4)}}" alt="{{$meta->meta_title}}"></div>
        </div>
    </section>

    <section class="Home grey lighten-4">
        <div class="container">
            <div class="row">
                <div class="col s12 center">
                    <h1 class="h2 Heading">{{$data->title}}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <div class="w80">
                        {!!$data->description!!}
                        <div class="w70">
                            <div class="iframe mt30px">
                                {!! preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe class=\"w-100\" height=\"300\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$data->image_alt) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="Home pb30px">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h3 class="h3 Heading">Team Expertbells</h3>
                </div>
            </div>
            <div class="row ProfileSec">
                @foreach($promoter as $i)
                <div class="col s12 l6">
                    <div class="Profile">
                        <span class="img"><img src="{{asset('/resources/assets/uploads/promoters/'.$i->image_url)}}" alt="{{$i->name}}"></span>
                        <span>{{$i->name}}</span>
                        <strong>{{$i->designation}}</strong>
                        {!!$i->description!!}
                        <ul class="icons">
                            @if($i->facebook_url)
                            <li><a href="{{$i->facebook_url}}" target="_blank"><i class="icofont-facebook"></i></a></li>
                            @endif
                            @if($i->instagram_url)
                            <li><a href="{{$i->instagram_url}}" target="_blank"><i class="icofont-instagram"></i></a></li>
                            @endif
                            @if($i->linkedin_url)
                            <li><a href="{{$i->linkedin_url}}" target="_blank"><i class="icofont-linkedin"></i></a></li>
                            @endif
                            @if($i->twitter_url)
                            <li><a href="{{$i->twitter_url}}" target="_blank"><i class="icofont-twitter"></i></a></li>
                            @endif
                            @if($i->youtube_url)
                            <li><a href="{{$i->youtube_url}}" target="_blank"><i class="icofont-youtube"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>



    @include('inc.testimonials')


    @include('inc.footer')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- <script type="text/javascript" src="js/owl.carousel.min.js"></script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#TestSec").owlCarousel({items:2,loop:true,dots:false,nav:true,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},320:{items:1},460:{items:1},600:{items:1},768:{items:1.2,center:true},992:{items:1.5,center:true},1200:{items:2},1600:{items:2}}});
            $("#Testimonial").owlCarousel({
                items: 5,
                center: true,
                loop: true,
                dots: true,
                nav: false,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    250: {
                        items: 1
                    },
                    320: {
                        items: 1
                    },
                    460: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                    1400: {
                        items: 5
                    }
                }
            });
        });
    </script>