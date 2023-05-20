@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="Sec2 pt-3 CmsPage bg-white">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
          <li class="breadcrumb-item"><a aria-current="page">{{$cms->title}}</a></li>
        </ol>
        <div class="text-center"><h1 class="Heading">{{$cms->title}}</h1></div>
        <div class="row">
          <div class="col-12">{!! $cms->description !!}</div>
        </div>
      </div>
    </section>
  </main>  
@endsection
@push('css')
<title>Terms and Conditions : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
@endpush
@push('js')
    
@endpush