@extends('layouts.app')
@section('content')
<main>
    <section class="HearderSec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="MBox mt-5 pt-5 text-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <span class="h5 fw-normal">{{$banner->heading}}</span>
                                <h1 class="mb-3">{{$banner->title}}</h1>
                                {!! $banner->description !!}
                                <a href="{{url('expert-register')}}#s1" class="btn btn-thm btn-lg">Join as a Mentor <img src="{{asset('frontend/img/arrow.svg')}}" class="ms-3" width="30" height="30"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!empty($section2->title) && !empty($section2->description))
    <section class="Sec1">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5">
                    <h2 class="h1">{{ $section2->title }}</h2>
                </div>
                <div class="col-12 col-md-7">
                    <div class="ms-md-5">
                        {!! $section2->description !!}    
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if($threeicons->count() > 0)
    <section class="Sec2 py-5 Steps NoNum">
        <div class="container">
            <div class="row">
                @foreach ($threeicons as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <x-image-box>
                                <x-slot:image>{{$item->image}}</x-slot>
                                <x-slot:path>/uploads/threeicon/</x-slot>
                                <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                            </x-image-box>
                            <h3 class="h5 m-0">{{$item->title}}</h3>
                            <p>{{$item->description}}</p>
                        </div>
                    </div>
                </div> 
                @endforeach               
            </div>
        </div>
    </section>
    @endif
    <section class="Sec5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-10 text-center mb-4">
                    <h2 class="Heading h1">{{$section4->title}}</h2>
                    {!! $section4->description !!}
                </div>
            </div>
            <div class="row">
                @foreach ($mentors as $item)
                <div class="col-12 col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="h4 thm">{{$item->title}}</h3>
                            <p>{{$item->description}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @if(!empty($section5->title) && !empty($section5->description))
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5 order-md-last mb-3">
                    <div class="ms-md-5">
                        <x-image-box>
                            <x-slot:image>{{$section5->image}}</x-slot>
                            <x-slot:path>/uploads/cms/</x-slot>
                            <x-slot:alt>{{$section5->title ?? ''}}</x-slot>
                            <x-slot:class>w-100</x-slot>
                            <x-slot:height>480</x-slot>
                            <x-slot:width>380</x-slot>
                        </x-image-box>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <h2 class="h1 Heading">{{$section5->title}}</h2>
                    <div class="CmsPage">
                        {!! $section5->description !!}
                        <a href="{{url('expert-register')}}#s1" class="btn btn-thm4 btn-lg">Yes, I Join as a Mentor<img src="{{asset('frontend/img/arrow.svg')}}" class="ms-3" width="30" height="30"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="Sec2 py-5 Steps">
        <div class="container">
            <div class="text-center">
                <h2 class="h1 Heading">{{$callingcms->title}}</h2>
                {!! $callingcms->description !!}
            </div>
            <div class="row justify-content-center">
                @foreach ($callingprocess as $item)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <x-image-box>
                                <x-slot:image>{{$item->image}}</x-slot>
                                <x-slot:path>/uploads/callingprocess/</x-slot>
                                <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                            </x-image-box>
                            <h3 class="h4 mb-4">{{$item->title}}</h3>
                            {!! $item->description !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center"><a href="{{url('expert-register')}}#s1" class="btn btn-thm4 btn-lg">Join as a Mentor<img src="{{asset('frontend/img/arrow.svg')}}" class="ms-3" width="30" height="30"></a></div>
        </div>
    </section>
    <section class="Sec3 bg-white">
        <div class="Test mt-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 text-center">
                        <h2 class="Heading h1">{{$testimonialscms->title}}</h2>
                        {!! $testimonialscms->description !!}
                        <div class="owl-carousel Testi">
                            @foreach ($testimonials as $item)
                            <div class="item">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="img">
                                            <x-image-box>
                                                <x-slot:image>{{$item->image}}</x-slot>
                                                <x-slot:path>/uploads/testimonial/</x-slot>
                                                <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                                            </x-image-box>
                                        </span>
                                        <h3 class="h4 mt-3">{{$item->name}}</h3>
                                        <div class="text mb-3">{!! $item->description !!}</div>
                                        <span class="star" title="star" data-title="{{$item->rating}}"></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    
</main>
@endsection
@push('css')
<title>Become as a Mentor : {{project()}}</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<style type="text/css">
.Steps .row>div{counter-increment:slides-num;}
.Steps .card{background:none;border-radius:0;}
.Steps .card>*{border-radius:0;border:none;background:none;}
.Steps .card img{height:70px; width:auto;object-fit:contain;margin-bottom:20px;}
.Steps .card h3{color:var(--thm3);position:relative;}
.Steps .card h3:after{content:"0"counter(slides-num)".";position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;font-weight:600;font-size:72px;color:rgb(var(--blackrgb)/.05); transform:translateY(-100%); transition:all .5s;z-index:-1;}
.NoNum.Steps .card h3:after{display:none;}
.Steps .card p{font-size:15px;display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:2;margin-top:9px;}
.Sec5 .card{height:100%;background:rgb(var(--thmrgb)/.05); text-align:center;border-color:rgb(var(--thmrgb)/.08);}
.Sec5 .card p{margin:0;}
</style>
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" onload="this.rel='stylesheet'" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />

@endpush
@push('js')
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" onload="this.rel='stylesheet'" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
<link rel="preload" as="style" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" onload="this.rel='stylesheet'" />

<script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".Testi").owlCarousel({items:1,margin:0,center:false,loop:true,dots:true,nav:false,navText:['<span></span>','<span></span>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true});
});
$( document ).ready(function() {
    var ctrlVideo = document.getElementById("PVideo");
    $('.playbtn').click(function(){
        // alert();
        if ($('.playbtn').hasClass("play")){
            ctrlVideo.play();
            $('.playbtn').removeClass("play");
        } else {
            ctrlVideo.pause();
            $('.playbtn').addClass("play");
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
@endpush