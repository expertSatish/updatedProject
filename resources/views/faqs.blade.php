@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"></div></section>
    <section class="pt-3 bg-white">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Find All Experts</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-10 text-center">
                    <h1 class="Heading">{{$cms->title}}</h1>
                    {!! $cms->description !!}
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="FaqTopBar mb-3">
                        <ul>
                            @foreach ($category as $item)
                            <li class="{{$activecategory->id==$item->id?'active':''}}">
                                <a href="{{route('faq',['category'=>$item->alias])}}" class="card">
                                    <x-image-box>
                                        <x-slot:image>{{$item->image}}</x-slot>
                                        <x-slot:path>/uploads/faq/</x-slot>
                                        <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                                        <x-slot:height>50</x-slot>
                                        <x-slot:width>50</x-slot>
                                    </x-image-box>
                                    <span>{{$item->title}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card LeftFAQs">
                        <div class="card-header">
                            <form action="" method="get">
                                @csrf
                                <div class="input-group">
                                    <input type="text" required="" autocomplete="off" name="search" placeholder="Search Here..." class="form-control">
                                    <button type="submit" class="btn bgthm text-white"><i class="fal fa-search"></i></button>
                                </div>
                          </form>
                        </div>
                        @if(count($activecategory->child) > 0)
                        <div class="card-body Leftpanel">
                            <ul>
                                @foreach($activecategory->child as $child)
                                <li class="{{$child->alias==Request::segment(3)?'active':''}}">
                                    <a href="{{route('faq',['category'=>$activecategory->alias,'child'=>$child->alias])}}">
                                        {{$child->title}}
                                        <i class="fal fa-chevron-right"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-9 CmsPage">
                    @if($lists->count() == 0)
                    <div class="col-md-12">
                        <div class="text-center">
                            <p class="mt-3">Sorry, we couldn`t find any results.</p>
                        </div>
                    </div>
                    @endif

                    @if($lists->count() > 0)
                    <div class="accordion accordion-flush Faqs" id="Faqs">
                        @foreach ($lists as $item)
                        <div class="accordion-item">
                            <div class="accordion-header" id="Pay1">
                                <button class="accordion-button {{$loop->iteration!=1?'collapsed':''}}" type="button" data-bs-toggle="collapse" data-bs-target="#Faqs{{$loop->iteration}}" aria-expanded="{{$loop->iteration!=1?'false':'true'}}" aria-controls="Faqs{{$loop->iteration}}">{{$item->title}}</button>
                            </div>
                            <div id="Faqs{{$loop->iteration}}" class="accordion-collapse collapse {{$loop->iteration==1?'show':''}} " aria-labelledby="Pay1" data-bs-parent="#Faqs">
                                <div class="accordion-body">
                                    {!! $item->description !!}
                                </div>
                            </div>
                        </div>  
                        @endforeach
                    </div>
                    {{$lists->links()}}
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>FAQs :Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
body>main,body section{overflow:inherit!important;}
.FaqTopBar ul{margin:0;padding:0;display:flex;flex-wrap:wrap;justify-content:center}
.FaqTopBar ul li{margin-right:15px;margin-bottom:15px}
.FaqTopBar ul li>*{border-color:rgb(var(--thmrgb)/.1)!important;background:rgb(var(--thmrgb)/.1);cursor:pointer;padding:.7rem 1rem;font-weight:600;max-width:220px;display:flex;align-items:center;line-height:130%;font-size:15px;flex-direction:row}
.FaqTopBar ul li>* img{height:40px!important;min-width:40px!important;width:40px;margin-right:12px;transition:all .5s}
.FaqTopBar ul li>*:hover,.FaqTopBar ul li.active>*{background:var(--thm1);color:var(--white)}
.FaqTopBar ul li>*:hover img,.FaqTopBar ul li.active>* img{filter:invert(1)}
.LeftFAQs{border:none;border-radius:0!important;box-shadow:0 0 12px rgb(var(--blackrgb)/.1);border:1px solid rgb(var(--blackrgb)/.1)!important;width:100%;position:sticky!important;top:65px}
.LeftFAQs>*{border-radius:0!important;}
.LeftFAQs .card-header{background:rgb(var(--blackrgb)/.08);border-color:rgb(var(--blackrgb)/.05)!important}
.LeftFAQs .input-group>*{border:none;background:var(--white)}
.accordion{box-shadow:0 0 9px rgb(var(--blackrgb)/.1);background:var(--black)!important}
.Leftpanel ul{padding:0;margin:0}
.Leftpanel ul li{border-bottom:1px solid rgb(var(--blackrgb)/.1)}
.Leftpanel ul li a{display:flex;align-items:center;justify-content:space-between;color:var(--black);width:auto;position:relative;padding:7px 0;font-size:15px;border-radius:8px;transition:all .5s}
.Leftpanel ul li:hover a{color:var(--thm)}
.Leftpanel ul li.active,.Leftpanel ul li:last-child{border:none}
.Leftpanel ul li.active a{background:var(--thm2);color:var(--black);box-shadow:0 9px 15px rgb(var(--blackrgb)/.2);margin-right:-9px;margin-left:-9px;padding:7px 9px}
.accordion-item{border-color:rgb(var(--blackrgb)/.1)!important}
.accordion-body p{color:var(--black)!important;font-size:14px!important; font-weight:400}
.accordion-header .accordion-button:not(.collapsed){background:var(--thm)!important}
.accordion-header .accordion-button{background:rgb(var(--thmrgb)/.1)!important;border-radius:0!important;color:var(--black)}
@media (max-width:767px){.FaqTopBar ul li>*{font-size:14px;padding:.5rem}
.FaqTopBar ul li>* img{margin-right:8px;height:32px!important;min-width:32px!important;width:32px;}
.FaqTopBar ul li{margin-right:8px;margin-bottom:8px}
}
</style> 
@endpush
@push('js')
    
@endpush