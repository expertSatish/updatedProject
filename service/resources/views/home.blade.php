<?php $active = Request::segment(2); ?>


@include('inc.html')

<head>
<title>{!! $meta->meta_title !!}</title>
<meta name="keywords" content="{!! $meta->meta_keywords !!}">
<meta name="description" content="{!! $meta->meta_description !!}">
<style>.shorttext{transition:all .5s;font-size:14px;margin:0;color:#333;display:-webkit-box;overflow:hidden!important;-webkit-box-orient:vertical;-webkit-line-clamp:3;height:95px!important}
.shorttext p{overflow:hidden!important}
.quicki{position:relative!important;right:-5px!important}
/*.TestSec .item{padding-bottom:30px;transition:all .5s}
.TestSec .active .item{transform:scale(1.2);opacity:1}*/
.TestSec .active{z-index:2}
.TestSec .active .item .card{box-shadow:0 5px 12px rgb(0 0 0/.2)}
.TestSec .active .item .card::after{opacity:1}
.TestSec .active .item .card .text p{color:#000!important}
.TestSec .active .item .card .nametext p{color:#666!important}
.TestSec .active .item .card .nametext h4{color:#066531}
.TestSec .card{border-radius:15px;position:relative;color:#000;border:none;width:calc(100% - 38px);margin:20px 12px;margin-top:50px;margin-left:auto;padding:20px;background:#fff;box-shadow:0 5px 12px rgb(0 0 0/.2);transition:all .5s}
.TestSec .card::after{position:absolute;content:'';z-index:0;height:100%;width:100%;left:0;top:0;opacity:0;border-radius:15px 150px 15px 60px;background:linear-gradient(-45deg, rgb(220 220 220) 0, rgb(255 255 255) 75%);transition:all .5s}
.TestSec .card>div{position:relative;z-index:1}
.TestSec .card>div.text{min-height:105px}
.TestSec .card .img{width:99px;margin:-35px 0 0 -40px;height:99px;border-radius:50%;background:#eee;box-shadow:0 3px 8px rgb(0 0 0/.2);position:relative;overflow:hidden;transition:all .5s}
.TestSec .card .img img{width:100%;min-height:100%;border-radius:50%;border:5px solid #fff}
.TestSec .card .img::after{position:absolute;content:'';height:100%;width:100%;border-radius:50%;background:transparent;box-shadow:0 0 6px rgb(0 0 0/.4);z-index:-1}
.TestSec .card .nametext{width:calc(100% - 80px);margin-left:auto;color:#000;text-align:left}
.TestSec .card .nametext p{color:#888!important;transition:all .5s}
.TestSec .card .text p,.TestSec .card .text p~*{font-size:15px!important;color:#000!important;line-height:170%!important;/*display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:5;*/transition:all .5s;background:none!important;margin:9px 0 0!important}
.TestSec .owl-nav{position:static;margin:0 auto;height:auto;width:80px;transition:all .5s;display:flex;justify-content:space-between}
.TestSec .owl-nav button.owl-next,.TestSec .owl-nav button.owl-prev{width:32px!important;height:32px!important;border-radius:50%!important;opacity:1!important;position:static!important;transition:all .5s}
.TestSec .owl-nav button.owl-next span,.TestSec .owl-nav button.owl-prev span{line-height:32px;font-size:28px;margin-top:-6px}
.TestSec .owl-nav button.owl-next:hover,.TestSec .owl-nav button.owl-prev:hover{box-shadow:0 4px 6px rgb(0 0 0/.4);opacity:1}
@media only screen and (max-width:600px){.TestSec .card>div.d-flex{display:block!important}
.TestSec .card,.TestSec .card .nametext{width:100%!important;text-align:center}
.TestSec .card .img{margin:-65px auto 12px}}
</style>
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" onload="this.rel='stylesheet'" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@include(' inc.header') @php $Slider=DB::table('sliders')->where(['main_heading'=>0,'status'=>1])->get();

$TopSlider = DB::table('sliders')->where(['main_heading'=>1,'status'=>1])->first();

@endphp

<section class="Home MainSlider">
    <div class="container">
        <div class="row valign-wrapper">
            <div class="col s12 l5">
                @php
                $str = $TopSlider->img_alt ?? '';
                $data = Helper::TwoColor($str);
                $data_1 = $data[0];
                $data_2 = $data[1];
                @endphp

                @if(!empty($TopSlider))

                {{-- <h1 class="mt0">{!! Helper::TwoColorHeading($TopSlider->img_alt) !!}</h1> --}}
                <h1 class="mt0">{{$data_1}} <span class="mcolor">{{$data_2}}</span></h1>
                <h2 class="mt30px h5 fw600">{{$TopSlider->image}}</h2>
                <div><a href="{{url('signup')}}" class="btn btn-main mt30px">Sign Up</a> <a href="#" id="sqcontact" class="btn btn-main1 mt30px quicki">Get Started Now!</a></div>

                @endif

            </div>
            <div class="col s12 l7">
                <div class="BannerImg">
                    <span><span><span></span></span></span>
                    <div>
                        <div class="Text">
                            @foreach($Slider as $Ro)

                            <h3>{{$Ro->img_alt}} <strong>{{$Ro->image}}</strong></h3>

                            @endforeach


                        </div>
                        <span><span><span></span></span></span>
                        <svg viewBox="0 0 47.11 40.68" class="LPinImage">
                            <rect fill="#65256d" width="6.97" height="22.52" />
                            <rect fill="#65256d" x="12.83" width="6.97" height="31.78" />
                            <rect fill="#65256d" x="26.48" width="6.97" height="36.11" />
                            <rect fill="#65256d" x="40.14" width="6.97" height="40.68" />
                        </svg>
                        <img class="LPinImage1 lazyload" data-src="{{asset('resources/assets/frontend/images/banner-img.svg')}}" src="{{asset('resources/assets/frontend/images/banner-img.svg')}}" alt="{{$meta->meta_title}}" width="450" height="424">
                        <img class="w100 lazyload" data-src="{{asset('resources/assets/frontend/images/Laptop.webp')}}" src="{{asset('resources/assets/frontend/images/Laptop.webp')}}" alt="{{$meta->meta_title}}" width="700" height="625">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- All Section -->
@if(!empty($AboutUs->short_description))
<section class="Home BannerBottom">
    <div class="container">
        <div class="row valign-wrapper">
            <div class="col s12">
                <h3 class="h1 Heading">{{$data1}} <span class="mcolor">{{$data2}}</span></h3>
                {!! $AboutUs->short_description !!}
                <a href="{!! url('about-us') !!}" class="btn btn-main3 mt10px">Read More <svg viewBox="0 0 15.61 11.54">
                        <polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3" />
                    </svg></a>
            </div>
        </div>
    </div>
</section>

@endif


@if(count($price)>0)
<section class="Home Plans pt0">
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h3 class="h1 Heading1">{{$plan1}}<span class="mcolor2">{{$plan2}}</span></h3>
                <div class="w70">
                    {!!$plan_heading->description!!}
                </div>
            </div>
            <div class="col s12">
                <div id="Plans" class="owl-carousel">
                    @foreach($price as $i)
                    <div class="item">
                        <div>
                            <img class="lazyload" data-src="{{asset('resources/assets/frontend/images/Pimg.png')}}" alt="{{$meta->meta_title}}" height="70" width="70">
                            <div class="Text">
                                <h4 class="h6">{{$i['data']->title}}</h4>
                                <p>{{$i['data']->banner_text2}}</p>
                                @if($i['amount']!=null)
                                <p class="price">{{$i['currency']}}<span>{{$i['amount']}}</span></p>
                                @endif
                                <a href="{{url($i['data']->alias)}}" class="btn btn-main3">View Plan <svg viewBox="0 0 15.61 11.54">
                                        <polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif



@if(count($taxes)>0)
<section class="Home pt0">
    <div class="container">
        <div class="row">
            @if(!empty($tax->home_description))
            <div class="col s12 l6 right">
                {!!$tax->home_description!!}
                <a href="{{url('/tax-detail/'.$tax->alias)}}" class="btn btn-main3 mt10px">Read More <svg viewBox="0 0 15.61 11.54">
                        <polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3" />
                    </svg></a>
            </div>
            @endif
            <div class="col s12 l6 left">
                @foreach($taxes as $tax)
                <div class="TaxBlock w90">
                    <div class="img"><img class="lazyload" data-src="{{asset('resources/assets/frontend/images/Pimg.png')}}" alt="{{$meta->meta_title}}" height="70" width="70"></div>
                    <div class="Text">
                        <h4 class="h6 m0">{{$tax->title}}</h4>
                        <p class=" grey-text text-lighten">{{$tax->heading}}</p>
                    </div>
                    <div class="Price">
                        <p>{{$tax->currency}} <span>{{$tax->price}}</span></p>
                        <a href="{{url('/tax-detail/'.$tax->alias)}}" class="btn btn-main3">Apply Now</a>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
</section>
@endif


@php $ArrData = DB::table('why_choose_us')->where(['status'=>1])->get(); @endphp


@if(count($ArrData)>0)
<section class="Home pt0">
    <div class="container">
        <div class="row">
            <div class="col s12 l5">
                <h3 class="h1 Heading1 lh-n">{{$reason_heading1}} <span class="mcolor">{{$reason_heading2}}</span></h3>
                <ul class="ul-list">
                    @foreach($ArrData as $Roes) <li>{!! $Roes->alt !!}</li> @endforeach
                </ul>
            </div>
            <div class="col s12 l7">
                <div class="ChooseImg">
                    <span></span>
                    <img class="lazyload w100" data-src="{{asset('resources/assets/frontend/images/ChooseImg.svg')}}" alt="{{$meta->meta_title}}" style="z-index:3; position:relative;" height="305" width="700">
                    <img class="graph lazyload" data-src="{{asset('resources/assets/frontend/images/choose-bg-graph.svg')}}" height="170" width="275" alt="{{$meta->meta_title}}">
                    <svg class="MinGraph" viewBox="0 0 67.58 49.32">
                        <rect class="GraphBox" x="1.37" y="1.37" width="64.85" height="46.59" rx="3.4" />
                        <path class="GraphLine" d="M534.54,1235c4.62,0,4.62-6.31,9.24-6.31s4.62-11.14,9.23-11.14,3.34,7.26,8,7.26,5.9-19,10.51-19,4.62,8.34,9.24,8.34,4.62-8.34,9.24-8.34" transform="translate(-528.46 -1192.92)" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

@endif


@if(count($blog_post)>0)
<section class="Home Blog pt0">
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                @php
                $str = $blog_heading->title;
                $data = Helper::TwoColor($str);
                $blog_heading1 = $data[0];
                $blog_heading2 = $data[1];
                @endphp
                <h3 class="h1 Heading1">{{$blog_heading1}} <span class="mcolor2">{{$blog_heading2}}</span></h3>
            </div>
            <div class="col s12">
                <div id="Blog" class="owl-carousel">
                    @if(count($blog_post)>0)
                    @foreach($blog_post as $i)
                    <div class="item">
                        <div>
                            <div class="Img"><img class="lazyload" data-src="{{asset('resources/assets/uploads/post/thumb/'.$i->post_image)}}" alt="{{$i->post_name}}" height="383" width="200" ></div>
                            <div class="Text">
                                <h4 class="h6"><a href="{{URL('/blog-detail/'.$i->post_alias)}}">{{$i->post_name}}</a></h4>
                                <div class="shorttext">{!! $i->post_short_desc !!}</div>
                                <div><a href="{{url('/blog-detail/'.$i->post_alias)}}" class="btn btn-main3">Read More <svg viewBox="0 0 15.61 11.54"><polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3"/></svg></a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="center"><a href="{!! url('blog') !!}" class="btn btn-main mt10px">View All Blogs</a></div>
            </div>
        </div>
    </div>
    </div>
</section>
@endif


@php $ArrData2 = DB::table('gallery')->where(['status'=>1])->get(); @endphp

@if(count($ArrData2)>0)
<section class="Home Clients pt0">
    <div class="row">
        <div class="col s12 center">
            @php
            $str = $client_heading->title;
            $data = Helper::TwoColor($str);
            $client_heading1 = $data[0];
            $client_heading2 = $data[1];
            @endphp
            <h3 class="h1 Heading1">{{$client_heading1}} <span class="mcolor1">{{$client_heading2}}</span></h3>
        </div>
        <div class="col s12">
            <div id="Clients" class="owl-carousel">

                @foreach($ArrData2 as $Rows)

                <div class="item">
                    <div><img class="lazyload" data-src="{{asset('resources/assets/uploads/gallery/'.$Rows->title)}}" alt="{{$meta->meta_title}}" height="70" width="70" ></div>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</section>

@endif


@include('inc.testimonials')


@include('inc.footer')
<!-- OwlCarousel2 CSS -->
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" onload="this.rel='stylesheet'" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#Plans").owlCarousel({items:5,loop:false,dots:false,nav:true,responsiveClass:true,responsive:{250:{items:1},320:{items:1},460:{items:2},600:{items:2},768:{items:3},992:{items:4},1200:{items:4},1600:{items:5}}});
        $("#Blog").owlCarousel({items:4,loop:false,dots:false,nav:true,responsiveClass:true,responsive:{250:{items:1},320:{items:1},460:{items:2},600:{items:2},768:{items:3},992:{items:3},1200:{items:4},1600:{items:5}}});
        $("#Clients").owlCarousel({items:6,center:true,loop:true,dots:false,nav:true,autoplay:true,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},320:{items:2},460:{items:2},600:{items:3.6},768:{items:4},992:{items:4},1200:{items:6},1600:{items:6}}});
        $("#Testimonial").owlCarousel({items:5,center:true,loop:true,dots:true,nav:false,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},320:{items:1},460:{items:1},600:{items:2},768:{items:3},992:{items:4},1200:{items:4},1400:{items:5}}});
        $("#TestSec").owlCarousel({items:2,loop:true,dots:false,nav:true,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},320:{items:1},460:{items:1},600:{items:1},768:{items:1.2,center:true},992:{items:1.5,center:true},1200:{items:2},1600:{items:2}}});
        $('#sqcontact').click(function() {
            $(".qform").addClass("pull")
        });
    });
</script>