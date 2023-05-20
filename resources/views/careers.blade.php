@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="Sec2 pt-3 CmsPage bg-white">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
          <li class="breadcrumb-item"><a aria-current="page">Careers</a></li>
        </ol>
        <div class="row justify-content-center mb-3">
          <div class="col-lg-9 col-md-10 text-center">
            <h1 class="Heading">{{$cms->title}}</h1>
            {!! $cms->description !!}
          </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($lists as $item)
            <div class="col-lg-6 col-md-8">
                <div class="card CareerBox">
                  <a href="{{route('careers',['alias'=>$item->alias])}}" class="card-body">
                    <div>{{$item->title}} <span><strong>{{$item->department}} </strong> {{$item->location}}</span></div><i class="fal fa-arrow-right"></i>
                  </a>
                </div>
            </div>  
            @endforeach
        </div>
      </div>
    </section>
  </main>  
@endsection
@push('css')
<title>Careers : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
.CareerBox{margin-bottom:18px;background:rgb(var(--thmrgb)/.07)!important;box-shadow:0 0 12px rgb(var(--thmrgb)/.15);border:1px solid rgb(var(--thmrgb)/.05)!important;border-radius:0!important}
.CareerBox>.card-body{background:none;display:flex;align-items:center;justify-content:space-between;padding:.5rem 1rem}
.CareerBox>.card-body i{min-width:30px;font-size:22px;color:var(--thm);display:flex;justify-content:end}
.CareerBox>.card-body>div{font-size:18px}
.CareerBox>.card-body>div span{color:rgb(var(--blackrgb)/.7);font-weight:400;font-size:12px;display:block;margin-top:5px}
.CareerBox>.card-body>div span strong{color:var(--thm)!important;font-weight:500!important}
@media only screen and (max-width:575px){.CareerBox>.card-body>div, .CareerBox>.card-body>div span{display:block} 
.CareerBox>.card-body>div{width: calc(100% - 26px)}
.CareerBox>.card-body i{min-width:22px;font-size:18px}}
.bg-white{box-shadow:0 0 9px rgb(var(--blackrgb)/.1)}
</style>
@endpush
@push('js')
    
@endpush