@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">My Video</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-expert.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="pb-2 mb-3 border-bottom d-block d-md-flex justify-content-between">
                        <h3 class="m-0 h4">My Video</h3>
                        @if($videos->count()==0)
                        <a href="#videomodal" data-bs-toggle="modal" data-bs-type="addvideo" class="btn btn-thm4 m-0"><i class="fal fa-plus me-2"></i>Add a Demo Video</a>
                        @endif
                    </div>
                    <div class="row VideoBox">
                        @if($videos->count()==0)
                        <x-data-not-found data="Videos"/>
                        @endif
                        @foreach($videos as $video)
                        @php
                            $arr = explode('=',$video->video_url);
                        @endphp
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    {{-- {{route('expert.removevideo',['id'=>$video->id])}} --}}
                                    {{-- <a href="#DeleteModal" data-bs-toggle="modal" onclick="$('.removerecord').attr('href','{{route('expert.removevideo',['id'=>$video->id])}}');" class="RemoveVideo"><i class="fal fa-trash-alt"></i></a> --}}
                                    <a href="#videomodal" data-bs-toggle="modal" data-bs-id="{{$video->id}}" data-bs-type="editvideo" class="EditVideo"><i class="fas fa-pencil-alt"></i></a>
                                    @if($video->video_type==1)
                                        <div class="youtube-player" data-id="{{$arr[1] ?? ''}}"></div>
                                        <a data-fancybox="" class="playVideo" href="{{$video->video_url}}" data-title="{{$video->title}}"></a>
                                    @endif
                                    @if($video->video_type==2)
                                    <video>
                                        <source src="{{asset('uploads/expert/video/'.$video->video)}}" type="video/mp4" />
                                    </video>
                                    <div class="play"></div>
                                    <a data-fancybox="" class="playVideo" href="{{asset('uploads/expert/video/'.$video->video)}}" data-title="{{$video->title}}"></a>
                                    @endif
                                </div>
                                <a target="_blank" href="{{route('experts',['alias'=>$video->expert->user_id,'type'=>'videos','v'=>$video->video_id])}}" class="card-body">
                                    <h3>{{$video->title}}</h3>
                                    @if(!empty($video->industries))
                                    <small class="text-secondary">
                                        <i class="far fa-tag thm"></i> 
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
</main>
@endsection
@push('css')
<title>My Video : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<style type="text/css">
.VideoBox .card,.AddVideo .card{padding:0;overflow:hidden;box-shadow:0 0 16px rgb(var(--blackrgb)/.1)!important;border:none!important;border-radius:5px;margin:9px 0 20px}
.AddVideo .card{margin-top:0;padding:20px}
.AddVideo .card .form-control[type=file]{padding-left:12px}
.VideoBox .card>*{border-radius:0!important;border:none}
.VideoBox .card .card-header{position:relative;height:185px;line-height:0;padding:0;transition:all .5s}
.VideoBox .card .card-header .playVideo{position:absolute;height:100%;width:100%;left:0;top:0;z-index:4}
.VideoBox .card .card-header .play{height:72px;width:72px;left:50%;top:50%;transform:translateX(-50%) translatey(-50%);position:absolute;background:url('{{asset('frontend/img/play.svg')}}') no-repeat;cursor:pointer;z-index:2;}
.VideoBox .card .card-header video{width:100%;height:100%;object-fit:cover}
.VideoBox .card .card-body{text-align:center}
.VideoBox .card .card-body h3{font-size:18px!important;margin:0 0 5px;color:var(--thm3)!important;font-weight:500;display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:1}
.VideoBox .card img{width:100%;height:auto;border-radius:5px}
.VideoBox .card .video{position:relative;display:block;width:100%}
.VideoBox .card .video::after{position:absolute;content:'';z-index:9;top:0;left:0;height:100%;width:100%;background:rgb(var(--blackrgb)/0)}
.VideoBox .card:hover{transform:translateY(-3px);box-shadow:0 0 16px rgb(var(--blackrgb)/.2)!important}
.VideoBox .card:hover .card-body{background:rgb(var(--thmrgb)/.06)}
.VideoBox .card .RemoveVideo,.VideoBox .card .EditVideo{position:absolute;top:9px;right:-40px;height:35px;width:35px;border-radius:5px!important;background:#dc3545;color:var(--white);display:grid;place-items:center;box-shadow:0 3px 5px rgb(var(--blackrgb)/.2);z-index:5}
.VideoBox .card .EditVideo{background:#0c233b;top:49px}
.VideoBox .card:hover .RemoveVideo,.VideoBox .card:hover .EditVideo,.VideoBox .card:active .RemoveVideo,.VideoBox .card:active .EditVideo{right:9px}
.CustomerInfo textarea.form-control{height:99px;resize:none}
</style>
@endpush
@push('js')
<link rel="preload" as="style" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" onload="this.rel='stylesheet'" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
$('[data-bs-type]').on('click',function(e){
    let Modal = $(this).attr('data-bs-type');
    if(Modal=='addvideo'){
        $('.modal-content').html('<div class="text-center p-4"><i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i></div>');
       setTimeout(() => {
        $('.modal-content').load(@json(route('expert.addvideo')));
       }, 1000);
    }
    if(Modal=='editvideo'){
        let id = $(this).attr('data-bs-id');
        $('.modal-content').html('<div class="text-center p-4"><i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i></div>');
       setTimeout(() => {
        $('.modal-content').load(@json(route('expert.editvideo'))+'?id='+id);
       }, 1000);
    }    
});

</script>
<div class="modal fade" id="videomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center p-4">
                <i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i>
            </div>
        </div>
    </div>
</div>
@endpush