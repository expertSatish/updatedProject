<?php $active = Request::segment(2); ?>

@include('inc.html')

<head>
@php
$meta=DB::table('nav_category')->where('id','=',$id)->first();
if($meta->meta_title==null){
$meta->meta_title=$meta->title;
}
if($meta->meta_keywords==null){
$meta->meta_keywords=$meta->title;
}
if($meta->meta_description==null){
$meta->meta_description=$meta->title;
}
@endphp
<title>@if($meta->meta_title==null) {!! $meta->title !!} @else {!! $meta->meta_title !!}@endif</title>
<meta name="keywords" content="@if($meta->meta_keywords==null) {!! $meta->title !!} @else {!! $meta->meta_keywords !!}@endif">
<meta name="description" content="@if($meta->meta_description==null) {!! $meta->title !!} @else {!! $meta->meta_description !!}@endif">

<link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
<style type="text/css">
.youtube-player{position:relative;height:380px;overflow:hidden;max-width:100%;background:#000}
.youtube-player iframe{position:absolute;top:0;left:0;width:100%;height:100%;z-index:100;background:transparent}
.youtube-player img{object-fit:cover;display:block;left:0;bottom:0;margin:auto;max-width:100%;width:100%;position:absolute;right:0;top:0;border:none;height:auto;cursor:pointer;-webkit-transition:0.4s all;-moz-transition:0.4s all;transition:0.4s all}
.youtube-player img:hover{-webkit-filter:brightness(75%)}
.youtube-player .play{height:72px;width:72px;left:50%;top:50%;margin-left:-36px;margin-top:-36px;position:absolute;background:url('//i.imgur.com/TxzC70f.webp') no-repeat;cursor:pointer;z-index:9}
</style>
@include('inc.header')
@php
$banner = DB::table('nav_category')->where('id',$id)->first();
$banner_lists = DB::table('banner_list')->where('category_id',$id)->get();
$minprice = DB::table('pricing')->where('category_id',$id)->where('status',1)->orderby('amount','ASC')->first();
@endphp
<section class="inner-banner about Services">
    <div class="parallax-container">
        <div class="section pt60px pb60px">
            <div class="container">
                <div class="row d-flex">
                    <div class="col s12 l6">
                        <h1 class="h2 Heading black-text">{{$banner->banner_title}} <br><span class="mcolor">{{$banner->banner_text}}</span></h1>
                        <h5 class="fw600 black-text">{{ $banner->banner_text2 }}</h5>
                        <h5 class="fw600 black-text">{{ $banner->banner_text3 }}</h5>
                        @if(!empty($minprice)) 
                            
                            <h5 class="fw600 white-text"><span style="background:#0C233B;border-radius:5px;padding:5px 9px;display:inline-block">Starting at Rs. {{$minprice->amount}}/- <small class="grey-text text-lighten-1"><strike>{{!empty($minprice->striked_amount)? 'Rs. '.$minprice->striked_amount.' /-':''}}</strike></small> onwards</span></h5> 
                            
                        @endif
                        @if(!empty($banner->url))<a href="#wvideo" class="btn btn-main mt20px modal-trigger">Watch Video</a> @endif
                        <a href="#package" class="btn btn-main1 mt20px ml5px">View package</a>
                        <ul class="ul-list1">
                            @foreach($banner_lists as $banner_list)
                            <li>{{$banner_list->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col s12 l6">
                    </div>
                </div>
            </div>
            <div id="wvideo" class="modal customize">
                <div class="modal-content p0">
                    {!! Helper::youtube_preview($banner->url,315) !!}
                    <!-- <iframe width="100%" height="315" src="{{$banner->url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                </div>
                <a href="javascript:void(0);" class="modal-action modal-close red-text h5">&#10005;</a>
            </div>
            <div class="breadcrumb-bg">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <a href="{{url('/')}}" class="breadcrumb">Home</a>
                            <a href="{{url()->current()}}" class="breadcrumb">@php echo Request::segment(2) @endphp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($meta->banner_image!=null)
        <div class="parallax"><img src="{{asset('resources/assets/uploads/banner/'.$meta->banner_image)}}" alt="{{$banner->banner_title}} {{$banner->banner_text}}"></div>
        @endif
    </div>
</section>

<section class="Home pb0 grey lighten-4 sb-step scrollspy">
    <div class="container">
        <div class="row">
            <div class="col s12">
                @if(!empty($process_heading->title))
                <h2 class="h3 Heading">{{$process_heading->title}}</h2>
                @endif
                @if(!empty($process_heading->description))
                <p>{{$process_heading->description}}</p>
                @endif
                <div id="sb-step" class="owl-carousel">
                    @php
                    $process_lists = DB::table('process')->where('service_id',$id)->where('status',1)->get();
                    @endphp
                    @foreach($process_lists as $process)
                    <div class="item">
                        <div>
                            <figure class="sb-icon">
                                <img src="{{asset('resources/assets/uploads/process/'.$process->title)}}" alt="{{$process->alt}}">
                            </figure>
                            <div class="Text">
                                <h3 class="h6 mcolor1">{{$process->alt}}</h3>
                                <p class="fc text-justify">{{$process->type}} </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>



<section class="service_menu pushpin-demo-nav" data-target="serviceM">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul>
                    @if(!empty($banner->title))
                    <li><a href="#sectiona1">{{$banner->title}}</a></li>
                    @endif
                    @if(!empty($advantages_heading->tab))
                    <li><a href="#sectiona2">{{$advantages_heading->tab}}</a></li>
                    @endif
                    @if(!empty($documents_heading->tab))
                    <li><a href="#sectiona3">{{$documents_heading->tab}}</a></li>
                    @endif
                    @if(!empty($pre_requirement_heading->tab))
                    <li><a href="#sectiona4">{{$pre_requirement_heading->tab}}</a></li>
                    @endif
                    @if(!empty($annual_roc_heading->tab))
                    <li><a href="#sectiona5">{{$annual_roc_heading->tab}}</a></li>
                    @endif
                    @if(!empty($pricing_heading->tab))
                    <li><a href="#package">{{$pricing_heading->tab}}</a></li>
                    @endif
                    @if(!empty($faq_heading->tab))
                    <li><a href="#sectiona7">{{$faq_heading->tab}}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>
<div id="serviceM" class="block sticky">

    <section id="sectiona1" class="Home sb-step pb0 scrollspy">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <!--<h2 class="h3 Heading">{{$banner->title}}</h2>-->
                    {!! $banner->about !!}
                </div>
            </div>
        </div>
    </section>


    @php
    $advantages = DB::table('advantages')->where('service_id',$id)->where('status',1)->get();
    @endphp
    @if($advantages->count()>0)
    <section id="sectiona2" class="Home pb0 sb-step scrollspy">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    @if(!empty($advantages_heading->title))
                    <h2 class="h3 Heading">{{$advantages_heading->title}}</h2>
                    @endif
                    @if(!empty($advantages_heading->description))
                    <p>{{$advantages_heading->description}}</p>
                    @endif

                    <div id="sb-step2" class="owl-carousel">
                        @foreach($advantages as $adv)
                        <div class="item">
                            <div>
                                <figure class="sb-icon"><img src="{{asset('resources/assets/uploads/service-gallery/'.$adv->title)}}" alt="{{$adv->title}}"></figure>
                                <h3 class="h6 mcolor1">{{$adv->alt}}</h3>
                                <p class="fc text-justify">{{$adv->type}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @php
    $documents = DB::table('documents')->where('category_id',$id)->where('status',1)->get();
    @endphp
    @if(count($documents)>0)
    <section id="sectiona3" class="Home pb0 scrollspy">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    @if(!empty($documents_heading->title))
                    <h2 class="h3 Heading">{{$documents_heading->title}}</h2>
                    @endif
                    @if(!empty($documents_heading->description))
                    <p>{{$documents_heading->description}}</p>
                    @endif
                    <ol class="timeline">
                        @php
                        $documents = DB::table('documents')->where('category_id',$id)->where('status',1)->get();
                        @endphp
                        @foreach($documents as $doc)
                        <li>
                            <p class="font-weight-bold m0"> {{$doc->title}} </p>
                            <ul>
                                <li>{!! $doc->text !!}</li>
                            </ul>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>
    @endif
    @php
    $pr_requirements = DB::table('pr_requirements')->where('category_id',$id)->where('status',1)->get();
    @endphp
    @if(count($pr_requirements)>0)
    <section id="sectiona4" class="Home pb0 scrollspy">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    @if(!empty($pre_requirement_heading->title))
                    <h2 class="h3 Heading">{{$pre_requirement_heading->title}}</h2>
                    @endif
                    @if(!empty($pre_requirement_heading->description))
                    <p>{{$pre_requirement_heading->description}}</p>
                    @endif
                </div>
                <!--<div class="col s12 m7 l5">-->
                <div class="col s12">
                    <table class="table striped">
                        <tbody>
                            <tr style="background-color: #0C233B;">
                                @if(!empty($pre_requirment_list_heading))
                                <th style="color:#fff" class="center">{{$pre_requirment_list_heading->text_1}}</th>
                                <th style="color:#fff" class="center">{{$pre_requirment_list_heading->text_2}}</th>
                                @endif
                            </tr>
                            @foreach($pr_requirements as $req)
                            <tr>
                                <td>{{$req->title}}</td>
                                <td>{{$req->text}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @endif
    @php
    $annual_roc = DB::table('annual_roc')->where('category_id',$id)->where('status',1)->get();
    @endphp
    @if(count($annual_roc)>0)
    <section id="sectiona5" class="Home pb0 scrollspy">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    @if(!empty($annual_roc_heading->title))
                    <h2 class="h3 Heading">{{$annual_roc_heading->title}}</h2>
                    @endif
                    @if(!empty($annual_roc_heading->description))
                    {!! $annual_roc_heading->description !!}
                    @endif
                    <ul class="ul-list1">
                        @foreach($annual_roc as $anr)
                        <li>{!!$anr->text!!}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>
@php
$pricings = DB::table('pricing')->where('category_id',$id)->where('status',1)->get();
@endphp
@if(count($pricings)>0)
<section class="Home scrollspy" id="package">
    <div class="container">
        @if(!empty($pricing_heading->title))
        <h2 class="h3 Heading">{{$pricing_heading->title}}</h2>
        @endif
        @if(!empty($pricing_heading->description))
        <p>{{$pricing_heading->description}}</p>
        @endif

        <div class="row">
            @foreach($pricings as $prc)
            <div class="col s12 m4">
                <div class="plan-block @if($prc->top_selling==1) active @endif">
                    <div class="PlanTop">
                        <h3 class="h5">{{$prc->title}}</h3>
                        <div class="center">
                            <!-- <span>(Presumptive Basis 44AD/44ADA)</span> -->
                            <h4 class="fw-600 h1 m0 lh-n"><i class="icofont-rupee h5"></i>{{number_format($prc->amount)}}/-</h4>
                            <h5 class="fw-400 m0 lh-n"><strike class="grey-text text-lighten-2">{{!empty($prc->striked_amount)? 'Rs. '.$prc->striked_amount.' /-':''}}</strike></h5>
                            <span>{{$prc->text}}</span>
                        </div>
                    </div>
                    <div class="PlanMid">
                        <!-- <h4 class="mcolor1 h6 fw-600 m0 mb5px">Package Includes:</h4> -->
                        <ul>
                            @php
                            $pricing_list = DB::table('pricing_list')->where('pricing_id',$prc->id)->get();
                            @endphp
                            @if(count($pricing_list)>0)
                            @foreach($pricing_list as $prl)
                            <li>{{$prl->title}}</li>
                            @endforeach
                            @endif
                        </ul>
                    </div>

                    <form action="{{url('add-to-cart/'.base64_encode($prc->id))}}">
                        <input type="hidden" name="quantity" min="1" value="1">
                        <input type="hidden" name="name" value="{{$prc->title}}">
                        <input type="hidden" name="price" value="{{$prc->amount}}">
                        <div class="PlanBottom">
                            <button type="submit" class="btn btn-main">Buy Now</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@php
$faqs = DB::table('faq')->where('category_id',$id)->where('status',1)->get();
@endphp
@if(count($faqs)>0)
<section class="Home pt0 scrollspy" id="sectiona7">
    <div class="container">
        <div class="row">
            <div class="col s12">
                @if(!empty($faq_heading->title))
                <h2 class="h3 Heading">{{$faq_heading->title}}</h2>
                @endif
                @if(!empty($faq_heading->description))
                <p>{{$faq_heading->description}}</p>
                @endif
                <ul class="collapsible faqs">
                    @foreach($faqs as $key =>$faq)
                    <li @if($key==0) class="active" @endif>
                        <div class="collapsible-header">{{$faq->title}}</div>
                        <div class="collapsible-body"><span>{!! $faq->text !!}</span></div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endif
@include('inc.footer')
@include('inc.meta.service-script')
<!-- <script type="text/javascript" src="js/owl.carousel.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#sb-step").owlCarousel({
            items: 3,
            loop: false,
            dots: false,
            nav: true,
            responsiveClass: true,
            responsive: {
                250: {
                    items: 1
                },
                320: {
                    items: 1
                },
                460: {
                    items: 1
                },
                600: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                },
                1600: {
                    items: 4
                }
            }
        });
        $("#sb-step2").owlCarousel({
            items: 3,
            loop: false,
            dots: false,
            nav: true,
            responsiveClass: true,
            responsive: {
                250: {
                    items: 1
                },
                320: {
                    items: 1
                },
                460: {
                    items: 1
                },
                600: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                },
                1600: {
                    items: 4
                }
            }
        });
    });
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#Plans").owlCarousel({
            items: 5,
            loop: false,
            dots: false,
            nav: true,
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
                    items: 2
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
                1600: {
                    items: 5
                }
            }
        });
        $("#Blog").owlCarousel({
            items: 4,
            loop: false,
            dots: false,
            nav: true,
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
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                },
                1600: {
                    items: 4
                }
            }
        });
        $("#Clients").owlCarousel({
            items: 6,
            center: true,
            loop: true,
            dots: false,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                250: {
                    items: 1
                },
                320: {
                    items: 2
                },
                460: {
                    items: 2
                },
                600: {
                    items: 3.6
                },
                768: {
                    items: 4
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 6
                },
                1600: {
                    items: 6
                }
            }
        });
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
<script>
function labnolIframe(div) {
  var iframe = document.createElement('iframe');
  iframe.setAttribute(
    'src',
    'https://www.youtube.com/embed/' + div.dataset.id + '?autoplay=1&rel=0'
  );
  iframe.setAttribute('frameborder', '0');
  iframe.setAttribute('allowfullscreen', '1');
  iframe.setAttribute(
    'allow',
    'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture'
  );
  div.parentNode.replaceChild(iframe, div);
}
function initYouTubeVideos() {
  var playerElements = document.getElementsByClassName('youtube-player');
  for (var n = 0; n < playerElements.length; n++) {
    var videoId = playerElements[n].dataset.id;
    var div = document.createElement('div');
    div.setAttribute('data-id', videoId);
    var thumbNode = document.createElement('img');
    thumbNode.src = '//i.ytimg.com/vi/ID/hqdefault.jpg'.replace(
      'ID',
      videoId
    );
    thumbNode.alt = "Youtube Voideo";
    div.appendChild(thumbNode);
    var playButton = document.createElement('div');
    playButton.setAttribute('class', 'play');
    div.appendChild(playButton);
    div.onclick = function () {
      labnolIframe(this);
    };
    playerElements[n].appendChild(div);
  }
}
document.addEventListener('DOMContentLoaded', initYouTubeVideos);
</script>