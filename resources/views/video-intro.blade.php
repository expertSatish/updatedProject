@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="pt-3 Sec3 {{$videos->count()==0?'mb-5':''}} bg-white Home">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                @if(!empty(request('check')))
                <li class="breadcrumb-item"><a href="{{route('experts')}}">Experts</a></li>
                <li class="breadcrumb-item"><a href="{{route('experts',['alias'=>$experts->user_id])}}">{{$experts->name}} (Expert)</a></li>
                @else
                <li class="breadcrumb-item"><a href="{{route('videos')}}">Videos</a></li>
                @endif
                <li class="breadcrumb-item"><a aria-current="page">Video Detail</a></li>
            </ol>
            <div class="row justify-content-center wow slideInDown">
                <div class="col-xl-9 col-lg-10 col-md-11 text-center">
                    <h2 class="thm1 mb-3">{{$info->title ?? ''}}</h2>
                    <div class="card MainVideo">
                        <div class="card-header">
                            @if($info->video_type==1)
                            @php
                                if(str_contains($info->video_url,'v=')){
                                    $arr = explode('=',$info->video_url);
                                }else{
                                    $arr = explode('/',$info->video_url);
                                }
                            @endphp
                            <div class="youtube-player" data-id="{{end($arr) ?? ''}}"></div>
                            <!-- <a data-fancybox="" class="playVideo" href="{{$info->video_url}}" title="Video Gallery"></a> -->
                            @endif
                            @if($info->video_type==2)
                                <video controls="true" autoplay loop>
                                    <source src="{{asset('uploads/expert/video/'.$info->video)}}" type="video/mp4" />
                                </video>
                                <div class="play"></div>
                                {{-- <a data-fancybox="" class="playVideo" href="{{asset('uploads/expert/video/'.$info->video)}}" data-title="{{$info->title}}"></a> --}}
                            @endif
                        </div>
                    </div>
                    <div class="row text-start">
                        <div class="col-md-6 mb-3">
                            <div id="social-links" class="d-flex align-items-center">
                                <strong class="me-2">Share</strong>
                                {!! Share::currentPage()->facebook()->twitter()->linkedin()->telegram()->reddit()->whatsapp(); !!}
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end text-center mb-3"><h3 class="h5"><i class="fal fa-eye me-2"></i>{{viewcounts(count($info->clicks) ?? 0)}} views</h3></div>
                        <div class="col-12">
                            {!! $info->description ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($videos->count() > 0)
    <section class="Sec3">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 783.89" fill="#fff"><path d="M0,783.89S26.21,629,236,673.89c316.5,67.61,242.5-92,468-180.07,235.51-92,311.49,38,449.22-6.8C1251.61,455,1231,287.83,1412,303.83c67.48,6,188-80,188-80V0H0Z"/></svg>
        <div class="container">
            <div class="row justify-content-center wow slideInDown">
                <div class="col-lg-9 col-md-10 text-center">
                    <h2 class="Heading h1">Recommended Videos</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel VideoSec wow bounceInUp">
                        @foreach($videos as $video)
                        @php
                            $arr = explode('=',$video->video_url);
                        @endphp
                        <div class="item">
                            <div class="card">
                                <div class="card-header">
                                    @if($video->video_type==1)
                                    <div class="youtube-player" data-id="{{$arr[1] ?? ''}}"></div>
                                    @endif
                                    @if($video->video_type==2)
                                    <video autoplay>
                                        <source src="{{asset('uploads/expert/video/'.$video->video)}}" type="video/mp4" />
                                    </video>
                                    <div class="play"></div>
                                    @endif
                                    <a href="{{route('experts',['alias'=>$video->expert->user_id,'type'=>'videos','v'=>$video->video_id])}}" class="playVideo"></a>
                                </div>
                                <a href="{{route('experts',['alias'=>$video->expert->user_id,'type'=>'videos','v'=>$video->video_id])}}" class="card-body">
                                    <h3>{{$video->title ?? ''}}</h3>
                                    <small class="text-secondary me-3"><i class="far fa-user thm"></i> {{$experts->name ?? ''}}</small>
                                    @if(!empty($video->industries))
                                    <small class="text-secondary"><i class="far fa-tag thm"></i> 
                                        @foreach(json_decode($video->industries) as $industry)
                                            @php $industry = \App\Models\Industry::find($industry); @endphp
                                            {{$industry->title ?? ''}} {{!$loop->last?'+':''}}
                                        @endforeach 
                                    </small>
                                    @endif
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</main>
@endsection
@push('css')
<title>Video Detail : Expert Bells</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" onload="this.rel='stylesheet'" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<style type="text/css">
.Sec3 .card.MainVideo{box-shadow:0 0 15px rgb(var(--blackrgb)/.3)!important}
.Sec3 .card.MainVideo .card-header{height:550px!important}
.Sec3 .card.MainVideo .card-header video{box-shadow:0 9px 5px rgb(var(--blackrgb)/.2);background:var(--white)!important}
.swsi>div{display:flex}
#social-links ul{margin:0;margin-left:9px;padding:0}
#social-links ul li{display:inline-block;margin:0}
#social-links ul li:first-child,.swsi>div>div:first-child{display:inline-block;margin:0}
#social-links ul li a,.swsi>div a{border-radius:50%;padding-left:0;display:inline-block;text-align:center}
#social-links ul li a i,#social-links ul li a span,.swsi>div a i{border-radius:50%;width:33px;height:33px;font-size:16px;color:var(--white)!important;position:relative;line-height:33px;border:1px solid var(--white);text-align:center;display:inline-block;transition:all .5s}
#social-links ul li a span,.swsi>div a span.swsi-share-label{font-size:16px;display:block}
#social-links ul li a i:after,#social-links ul li a span:after{display:none}
#social-links ul li a .fa,.swsi>div a .fa{color:var(--white)}
#social-links ul li a .fa-facebook,#social-links ul li a .fa-facebook-f,.swsi>div a .fa-facebook,.swsi>div a .fa-facebook-f,#social-links ul li a .fa-facebook-square{background:#3b5998}
#social-links ul li a .fa-twitter,.swsi>div a .fa-twitter{background:#00acee}
#social-links ul li a .fa-telegram,.swsi>div a .fa-telegram{background:#0088cc}
#social-links ul li a .fa-linkedin,#social-links ul li a .fa-linkedin-in,.swsi>div a .fa-linkedin,.swsi>div a .fa-linkedin-in{background:#0e76a8}
#social-links ul li a .fa-pinterest,#social-links ul li a .fa-pinterest-p,.swsi>div a .fa-pinterest,.swsi>div a .fa-pinterest-p{background:#E60023}
#social-links ul li a .fa-whatsapp,.swsi>div a .fa-whatsapp{background:#25D366}
#social-links ul li a .fa-reddit,.swsi>div a .fa-reddit,.icons li a .fa-reddit-alien,#social-links ul li a .fa-reddit-alien,.swsi>div a .fa-reddit-alien{background:#ff4500}
#social-links ul li a .fa-instagram,.swsi>div a .fa-instagram{background:#f09433;background:-moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);background:-webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);background:linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 )}
#social-links ul li a:hover i,#social-links ul li a:hover span,.swsi>div a:hover i{border-color:transparent;transform:rotate(360deg);box-shadow:0 3px 8px rgb(var(--blackrgb)/.2)}

.VideoSec .card .card-header video{width:100%!important;height:100%!important;object-fit:cover}
.VideoSec .card .card-header .play{height:72px;width:72px;left:50%;top:50%;transform:translateX(-50%) translatey(-50%);position:absolute;background:url('{{asset('frontend/img/play.svg')}}') no-repeat;cursor:pointer;z-index:2;}

</style>
@endpush
@push('js')
<!-- <link rel="preload" as="style" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" onload="this.rel='stylesheet'" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script> -->

<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" onload="this.rel='stylesheet'" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".VideoSec").owlCarousel({items:3,margin:30,center:false,loop:true,dots:true,nav:false,navText:['<span></span>','<span></span>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},350:{items:1},575:{items:2},768:{items:2},992:{items:3},1200:{items:3},1600:{items:3}}});
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
setTimeout(function() {
    jQuery('.youtube-player .play').trigger('click');
}, 500);
setTimeout(function() {
    jQuery('.html5-video-player .ytp-button').trigger('click');
}, 2500);
document.addEventListener('DOMContentLoaded', initYouTubeVideos);
</script>
@endpush