@extends('layouts.app')
@section('content')
<main>
    <section class="HearderSec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="MBox text-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <span class="h5 fw-normal">{{$banner->heading}}</span>
                                <h1 class="mb-3">{{$banner->title}}</h1>
                                {!! $banner->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="AboutSec Home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="Heading h1">{{$mission->title}}</h2>
                    <x-image-box>
                        <x-slot:image>{{$mission->image}}</x-slot>
                        <x-slot:path>/uploads/cms/</x-slot>
                        <x-slot:alt>{{$mission->title ?? ''}}</x-slot>
                        <x-slot:class>w-100 col-md-6 float-md-end ps-md-5</x-slot>
                        <x-slot:height>500</x-slot>
                        <x-slot:width>500</x-slot>
                    </x-image-box>
                    {!! $mission->description !!}
                </div>
            </div>
        </div>
    </section>
    <section class="AboutSec Home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="Heading h1">{{$vission->title}}</h2>
                    <x-image-box>
                        <x-slot:image>{{$vission->image}}</x-slot>
                        <x-slot:path>/uploads/cms/</x-slot>
                        <x-slot:alt>{{$vission->title ?? ''}}</x-slot>
                        <x-slot:class>w-100 col-md-6 float-md-start pe-md-5</x-slot>
                        <x-slot:height>500</x-slot>
                        <x-slot:width>500</x-slot>
                    </x-image-box>
                    {!! $vission->description !!}
                </div>
            </div>
        </div>
    </section>
    <section class="Sec5 AboutSec">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 678.11" fill="#f9f5ef"><path d="M0,310.08s136.21-124.85,346-80c316.49,67.63,334-128,568-190,206.83-54.82,371.57,40,488,40,67.74,0,198-80,198-80V678.19H0Z"></path></svg>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center"><h2 class="Heading h1">Amazing Team!</h2></div>
                @foreach ($teams as $item)
                <div class="col-xxl-3 col-lg-4 col-md-6">
                    <div class="card TeamBox">
                        <a href="#Profile" data-bs-team-id="{{$item->id}}" data-bs-toggle="modal" class="card-body text-center">
                            <x-image-box>
                                <x-slot:image>{{$item->image}}</x-slot>
                                <x-slot:path>/uploads/team/</x-slot>
                                <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                                <x-slot:height>480</x-slot>
                                <x-slot:width>380</x-slot>
                            </x-image-box>
                            <h3>{{$item->title}}</h3>
                            <p>{!! $item->designation !!}</p>
                            <span class="text-primary">More detail</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <x-newsletter/>
    </section>
</main>   
<div class="modal fade TeamsPopup" id="Profile" aria-hidden="true" aria-labelledby="ProfileLabel" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content teaminfo"></div>
    </div>
</div>
@endsection
@push('css')
<title>About Us : Expert Bells</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<style>.AboutSec img.w-100{max-width:300px}
.TeamBox{border-color:rgb(var(--blackrgb)/.08)!important;border-radius:9px!important;margin-top:60px}
.TeamBox>*{border-radius:9px!important}
.TeamBox img{height:110px;width:110px;border-radius:5px;object-fit:cover;margin:-45px auto 15px;/*display:flex;*/;background:var(--white);border-radius:50%}
.TeamBox h3{font-size:18px;color:var(--thm)}
.TeamBox p{font-size:14px;display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:2;margin:0;margin-top:9px}
.TeamBox span.text-primary{font-size:13px}
.TeamBox:hover{background:rgb(var(--thmrgb)/.06);box-shadow:0 5px 12px rgb(var(--thmrgb)/.2)}
.TeamsPopup .modal-content{overflow:inherit!important}
.TeamsPopup .modal-header{padding:.5rem 1rem;background:rgb(1 42 78)}
.TeamsPopup .modal-header .icons.iblack li a i{color:var(--white)}
.TeamsPopup .modal-header .icons.iblack li a i:after{border:1px solid var(--white)}
.TeamsPopup .modal-header .modal-title{font-weight:700;color:var(--white)}
.TeamsPopup .modal-header .modal-title>span{display:block;font-size:13px;font-weight:400}
.TeamsPopup .modal-body img{box-shadow:0 5px 9px rgb(1 42 78/.6);border:8px solid rgb(1 42 78/.1);margin:0 15px 0 0}</style>    
@endpush
@push('js')
<script>
$('[data-bs-team-id]').on('click',function(e){
    let teamid = $(this).attr('data-bs-team-id');
    $('.teaminfo').html('<div class="text-center my-5"><i class="fad fa-spinner-third fa-spin" style="font-size: 40px;"></i></div>');
    $('.teaminfo').load(@json(url('team-details'))+'?member='+teamid);
});
</script>
@endpush