@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="pt-3 Sec3 bg-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 783.89" fill="#fff"><path d="M0,783.89S26.21,629,236,673.89c316.5,67.61,242.5-92,468-180.07,235.51-92,311.49,38,449.22-6.8C1251.61,455,1231,287.83,1412,303.83c67.48,6,188-80,188-80V0H0Z"/></svg>
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                @if(!empty($experts))
                <li class="breadcrumb-item"><a href="{{route('experts')}}">Experts</a></li>
                <li class="breadcrumb-item"><a href="{{route('experts',['alias'=>$experts->user_id])}}">{{$experts->name}} (Expert)</a></li>
                @endif
                <li class="breadcrumb-item"><a aria-current="page">Videos</a></li>
            </ol>
            @if(empty($experts))
            <div class="row justify-content-center wow slideInDown">
                <div class="col-lg-8 col-md-7 order-md-1">
                    {{-- <h2 class="Heading h1">Video Gallery</h2> --}}
                </div>
                <div class="col-lg-4 order-last order-md-2 col-md-5 text-end">
                    <input type="search" name="searchvideo" class="form-control SearchBox" placeholder="Search by name or keyword">
                </div>
                {{-- <div class="col-12 order-md-3"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p></div> --}}
            </div>
            @endif
            @if(!empty($experts))
            <div class="row justify-content-center wow slideInDown">
                <div class="col-lg-8 col-md-7 order-md-1">
                    <h2 class="Heading h1">Experts Videos</h2>
                    {{-- <p>These videos have been added by <b>{{$experts->name.' (Expert)' ?? 'expert'}}</b> only. Expertbells have nothing to do with this.</p> --}}
                </div>
                <div class="col-lg-4 order-last order-md-2 col-md-5 text-end"></div>
            </div>
            @endif
            @if(empty($experts))
            <div class="row Filter">
                <div class="col-12">
                    <div class="d-none flex-wrap">
                        <div class="dropdown FilterDrop">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Expertise <span></span></a>
                            <div class="dropdown-menu p-3">
                                <h3 class="text-u h6">Expertise</h3>
                                <input type="text" class="form-control SearchBox" placeholder="Search...">
                                <ul>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="exp2"><label class="form-check-label" for="exp2">Marketing Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="exp3"><label class="form-check-label" for="exp3">Business Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="exp4"><label class="form-check-label" for="exp4">Social Media Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="exp5"><label class="form-check-label" for="exp5">Digital Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="exp6"><label class="form-check-label" for="exp6">Business Development</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="exp7"><label class="form-check-label" for="exp7">Start-ups</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="exp8"><label class="form-check-label" for="exp8">Online Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="exp9"><label class="form-check-label" for="exp9">Strategic Planning</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="exp10"><label class="form-check-label" for="exp10">New Business Development</li>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown FilterDrop">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Role <span></span></a>
                            <div class="dropdown-menu p-3">
                                <h3 class="text-u h6">Role</h3>
                                <input type="text" class="form-control SearchBox" placeholder="Search...">
                                <ul>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role1"><label class="form-check-label" for="role1">All Experts</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role2"><label class="form-check-label" for="role2">Marketing Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role3"><label class="form-check-label" for="role3">Business Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role4"><label class="form-check-label" for="role4">Social Media Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role5"><label class="form-check-label" for="role5">Digital Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role6"><label class="form-check-label" for="role6">Business Development</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role7"><label class="form-check-label" for="role7">Start-ups</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role8"><label class="form-check-label" for="role8">Online Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role9"><label class="form-check-label" for="role9">Strategic Planning</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="role10"><label class="form-check-label" for="role10">New Business Development</li>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown FilterDrop">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tools <span></span></a>
                            <div class="dropdown-menu p-3">
                                <h3 class="text-u h6">Tools</h3>
                                <input type="text" class="form-control SearchBox" placeholder="Search...">
                                <ul>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool1"><label class="form-check-label" for="tool1">All Experts</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool2"><label class="form-check-label" for="tool2">Marketing Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool3"><label class="form-check-label" for="tool3">Business Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool4"><label class="form-check-label" for="tool4">Social Media Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool5"><label class="form-check-label" for="tool5">Digital Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool6"><label class="form-check-label" for="tool6">Business Development</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool7"><label class="form-check-label" for="tool7">Start-ups</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool8"><label class="form-check-label" for="tool8">Online Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool9"><label class="form-check-label" for="tool9">Strategic Planning</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="tool10"><label class="form-check-label" for="tool10">New Business Development</li>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown FilterDrop">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Skills <span></span></a>
                            <div class="dropdown-menu p-3">
                                <h3 class="text-u h6">Skills</h3>
                                <input type="text" class="form-control SearchBox" placeholder="Search...">
                                <ul>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill1"><label class="form-check-label" for="skill1">All Experts</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill2"><label class="form-check-label" for="skill2">Marketing Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill3"><label class="form-check-label" for="skill3">Business Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill4"><label class="form-check-label" for="skill4">Social Media Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill5"><label class="form-check-label" for="skill5">Digital Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill6"><label class="form-check-label" for="skill6">Business Development</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill7"><label class="form-check-label" for="skill7">Start-ups</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill8"><label class="form-check-label" for="skill8">Online Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill9"><label class="form-check-label" for="skill9">Strategic Planning</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="skill10"><label class="form-check-label" for="skill10">New Business Development</li>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown FilterDrop">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Industries <span></span></a>
                            <div class="dropdown-menu p-3">
                                <h3 class="text-u h6">Industries</h3>
                                <input type="text" class="form-control SearchBox" placeholder="Search...">
                                <ul>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind1"><label class="form-check-label" for="ind1">All Experts</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind2"><label class="form-check-label" for="ind2">Marketing Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind3"><label class="form-check-label" for="ind3">Business Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind4"><label class="form-check-label" for="ind4">Social Media Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind5"><label class="form-check-label" for="ind5">Digital Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind6"><label class="form-check-label" for="ind6">Business Development</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind7"><label class="form-check-label" for="ind7">Start-ups</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind8"><label class="form-check-label" for="ind8">Online Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind9"><label class="form-check-label" for="ind9">Strategic Planning</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="ind10"><label class="form-check-label" for="ind10">New Business Development</li>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown FilterDrop">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language <span></span></a>
                            <div class="dropdown-menu p-3">
                                <h3 class="text-u h6">Language</h3>
                                <input type="text" class="form-control SearchBox" placeholder="Search...">
                                <ul>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan1"><label class="form-check-label" for="lan1">All Experts</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan2"><label class="form-check-label" for="lan2">Marketing Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan3"><label class="form-check-label" for="lan3">Business Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan4"><label class="form-check-label" for="lan4">Social Media Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan5"><label class="form-check-label" for="lan5">Digital Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan6"><label class="form-check-label" for="lan6">Business Development</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan7"><label class="form-check-label" for="lan7">Start-ups</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan8"><label class="form-check-label" for="lan8">Online Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan9"><label class="form-check-label" for="lan9">Strategic Planning</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="lan10"><label class="form-check-label" for="lan10">New Business Development</li>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown FilterDrop">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sessions Blocks <span></span></a>
                            <div class="dropdown-menu p-3">
                                <h3 class="text-u h6">Sessions Blocks</h3>
                                <input type="text" class="form-control SearchBox" placeholder="Search...">
                                <ul>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess1"><label class="form-check-label" for="sess1">All Experts</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess2"><label class="form-check-label" for="sess2">Marketing Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess3"><label class="form-check-label" for="sess3">Business Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess4"><label class="form-check-label" for="sess4">Social Media Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess5"><label class="form-check-label" for="sess5">Digital Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess6"><label class="form-check-label" for="sess6">Business Development</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess7"><label class="form-check-label" for="sess7">Start-ups</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess8"><label class="form-check-label" for="sess8">Online Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess9"><label class="form-check-label" for="sess9">Strategic Planning</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="sess10"><label class="form-check-label" for="sess10">New Business Development</li>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown FilterDrop">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Times Available <span></span></a>
                            <div class="dropdown-menu p-3">
                                <h3 class="text-u h6">Times Available</h3>
                                <input type="text" class="form-control SearchBox" placeholder="Search...">
                                <ul>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime1"><label class="form-check-label" for="atime1">All Experts</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime2"><label class="form-check-label" for="atime2">Marketing Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime3"><label class="form-check-label" for="atime3">Business Strategy</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime4"><label class="form-check-label" for="atime4">Social Media Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime5"><label class="form-check-label" for="atime5">Digital Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime6"><label class="form-check-label" for="atime6">Business Development</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime7"><label class="form-check-label" for="atime7">Start-ups</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime8"><label class="form-check-label" for="atime8">Online Marketing</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime9"><label class="form-check-label" for="atime9">Strategic Planning</label></li>
                                    <li class="form-check"><input class="form-check-input" type="checkbox" id="atime10"><label class="form-check-label" for="atime10">New Business Development</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row databox">
                @if($videos->count()==0)
                <x-data-not-found data="Expert Videos"/>
                @endif
                @foreach($videos as $video)
                @php
                    if(str_contains($video->video_url,'v=')){
                        $arr = explode('=',$video->video_url);
                    }else{
                        $arr = explode('/',$video->video_url);
                    }
                @endphp
                @if(!empty($video->expert))
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            @if($video->video_type==1)
                            <div class="youtube-player" data-id="{{end($arr) ?? ''}}"></div>
                            @endif
                            @if($video->video_type==2)
                            <video>
                                <source src="{{asset('uploads/expert/video/'.$video->video)}}" type="video/mp4" />
                            </video>
                            <div class="play"></div>
                            @endif
                            <a href="{{route('experts',['alias'=>$video->expert->user_id,'type'=>'videos','v'=>$video->video_id,'check'=>Request::segment(2)])}}" class="playVideo"></a>
                        </div>
                        <a href="{{route('experts',['alias'=>$video->expert->user_id,'type'=>'videos','v'=>$video->video_id,'check'=>Request::segment(2)])}}" class="card-body">
                            <h3>{{$video->title ?? ''}}</h3>
                            <small class="text-secondary me-3"><i class="far fa-user thm"></i> {{$video->expert->name ?? ''}}</small>
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
                @endif
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Video : Expert Bells</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<style type="text/css">
.FilterDrop a{border-radius:30px!important;margin:0 0 0 auto;border:1px solid rgb(var(--blackrgb)/.2);padding:8px 20px;position:relative;min-width:50px;display:inline-flex;align-items:center}
.FilterDrop a{padding:5px 20px}
.FilterDrop a span{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:inline-flex; align-items:center; max-width:150px}
.FilterDrop a span:after{display:none}
.FilterDrop a.show{box-shadow:0 0 0 .25rem rgb(var(--thmrgb)/.25)!important;border:1px solid var(--thm)}
.FilterDrop a.show:before{position:absolute;content:'';right:0;left:0;margin:0 auto;bottom:-17px;z-index:9999;width:9px;height:9px;transform:rotate(45deg);background:var(--white)}
.FilterDrop .dropdown-menu{box-shadow:0 0 25px rgb(var(--blackrgb)/.2);border-color:rgb(var(--blackrgb)/.05);border-radius:15px;margin-top:9px!important}
.FilterDrop{margin:0 9px 9px 0}
.FilterDrop .dropdown-menu{min-width:350px}
.FilterDrop .dropdown-menu input.SearchBox{height:40px;font-size:16px;max-width:400px;background-color:rgb(var(--thmrgb)/.05)}
.FilterDrop .dropdown-menu ul{-webkit-column-count:2;-moz-column-count:2;column-count:2;grid-column-gap:20px;-webkit-column-gap:20px;-moz-column-gap:20px;column-gap:20px;padding:0;margin:15px 0 0}
/*.FilterDrop .dropdown-menu ul:first-child{margin-top:6rem!important}*/
@media only screen and (max-width:767px){.FilterDrop .dropdown-menu ul{-webkit-column-count:1;-moz-column-count:1;column-count:1;grid-column-gap:0;-webkit-column-gap:1;-moz-column-gap:1;column-gap:1;display:flex;flex-wrap:wrap;justify-content:space-between}}
.SelectExperts .dropdown-menu li,.FilterDrop .dropdown-menu li{padding:3px 20px; margin-bottom:1px; cursor:pointer;white-space:nowrap}
.FilterDrop .dropdown-menu li{padding:3px 0}
.FilterDrop .dropdown-toggle.selected{background:rgb(var(--thmrgb)/.1);border:1px solid rgb(var(--thmrgb)/.25)}
.FilterDrop .dropdown-toggle span:before{content:'\2022';padding:0 6px;font-size:9px}
.FilterDrop .dropdown-toggle span:empty:before{display:none}
input.SearchBox{padding-left:40px;height:48px;font-size:18px;margin:0;width:100%;background-image:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23666" viewBox="0 0 409.73 409.77"><path d="M878.4,589.6c-2.31-1.75-4.87-3.26-6.9-5.29q-59.18-59-118.22-118.18a33.48,33.48,0,0,1-2.94-4c-42.53,36-90.26,49.69-144,38.17-41.8-9-75-31.94-99.05-67.21-45.75-67.18-35.88-158.84,29.41-214.44,60.7-51.71,148.18-51.6,208.86-.32,34.69,29.32,54.24,67.13,57.35,112.54,3.1,45.21-11.15,85-41.18,119.46,1.18,1.23,2.22,2.38,3.32,3.48Q824.3,513,883.51,572.29c2,2,3.54,4.6,5.29,6.91v4l-6.4,6.4Zm-92-247.24c.37-79.5-64.38-145-144.82-145.17A144.41,144.41,0,0,0,496.4,341.9c-.26,79.83,63.72,144.69,144.69,145.25C720.59,487.7,786,422.34,786.39,342.36Z" transform="translate(-479.07 -179.83)"/></svg>');background-repeat:no-repeat;background-size:20px;background-position:9px;margin-bottom:9px}

.Sec3 .card .card-header video{width:100%!important;height:100%!important;object-fit:cover}
.Sec3 .card .card-header .play{height:72px;width:72px;left:50%;top:50%;transform:translateX(-50%) translatey(-50%);position:absolute;background:url('{{asset('frontend/img/play.svg')}}') no-repeat;cursor:pointer;z-index:2;}
</style>
@endpush
@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.FilterDrop .dropdown-menu').on('click', function(event){event.stopPropagation();});
        $('.FilterDrop .dropdown-menu input[type="checkbox"]').change(function(){
            var countCheckedCheckboxes = $('.FilterDrop .dropdown-menu input[type="checkbox"]').filter(':checked').length;
            $('.FilterDrop>.dropdown-toggle span').text(countCheckedCheckboxes);
            $('.FilterDrop>.dropdown-toggle').addClass("selected")
        });
    });
    $('.FilterDrop .SearchBox').on( "keyup", function() {
        val = $(this).val().toLowerCase();
        $(".FilterDrop ul li").each(function () {
            $(this).toggle($(this).text().toLowerCase().includes(val));
        });
    });
   
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

    $('input[name=searchvideo]').on('keyup',(e)=>{
        const text = e.target.value;
        $('.databox').html('<div class="text-center my-5"><i class="fad fa-spinner-third fa-spin fa-3x"></i></div>');
        $.ajax({
            data: {search:text,segment:"{{Request::segment(2)}}"},
            url: @json(route('videosearch')),
            method: 'GET',
            dataType: 'Json',
            cache: false,
            success: function(success) {
                $('.databox').html(success.html);
                initYouTubeVideos();
            }
        });
    });
    </script>
@endpush