@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="Sec5 pt-3 bg-white">
        <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
            @if(Request::segment(1)=='blogcategory')
            <li class="breadcrumb-item"><a href="{{url('/blog')}}">Blog</a></li>
            <li class="breadcrumb-item"><a aria-current="page">Blog Category</a></li>
            @elseif(Request::segment(1)=='blogarchive')
            <li class="breadcrumb-item"><a href="{{url('/blog')}}">Blog</a></li>
            <li class="breadcrumb-item"><a aria-current="page">Blog Archives</a></li>
            @else
            <li class="breadcrumb-item"><a aria-current="page">Blog</a></li>
            @endif
            
        </ol>
        <div class="row justify-content-center wow slideInDown">
            <div class="col-lg-9 col-md-10 text-center">
                <h2 class="Heading h1">{{$cms->title}}</h2>
                {!! $cms->description !!}
            </div>
        </div>
        <div class="row mt-4 wow bounceInUp">
            @if($lists->count()==0)
            <div class="col-md-12">
                <div class="card text-center">
                    <p class="mt-3">Sorry, we couldn`t find any results.</p>
                </div>
            </div>
            @endif

            @foreach ($lists as $item)
            <div class="col-md-6">
                <div class="card Blog">
                    <a href="{{route('blog',['alias'=>$item->alias])}}" class="card-header">
                        <x-image-box>
                            <x-slot:image>{{$item->image}}</x-slot>
                            <x-slot:path>/uploads/blog/</x-slot>
                            <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                            <x-slot:height>480</x-slot>
                            <x-slot:width>380</x-slot>
                        </x-image-box>
                    </a>
                    <a href="{{route('blog',['alias'=>$item->alias])}}" class="card-body">
                        <h3 class="h5">{{$item->title}}</h3>
                        <div class="admin">
                            <span class="me-4"><img src="{{asset('frontend/img/admin.svg')}}" class="me-1"> Admin</span> 
                            {{-- <span><img src="{{asset('frontend/img/comment.svg')}}"> Comments (2)</span> --}}
                            <span><i class="far fa-calendar-alt thm"></i> {{dateformat($item->post_date)}}</span>
                            
                        </div>
                        <p>{{$item->short_description}}</p>
                    </a>
                </div>
            </div>
            @endforeach 
            {{$lists->links()}}           
        </div>
    </section>
</main>  
@endsection
@push('css')
<title>Blog : Expert Bells</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<style type="text/css">body>main{overflow:inherit!important}</style>
@endpush
@push('js')
    
@endpush