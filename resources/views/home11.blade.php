@extends('layouts.app')
@section('metasection','Find a Mentor | Connecting Consultant & Digital Experts | Expertbells')
@section('twittertitle','Find a Mentor | Connecting Consultant & Digital Experts | Expertbells')
@section('twitterimage','https://www.expertbells.com/uploads/testimonial/2023-03-137356316testi-img.webp')
@section('twitterimagealt','Consultant & Digital Experts')
@section('twitterdescription','Improve your skills and reach your personal goals with the world class mentors. Find a right mentor and consultant for your startups and entrepreneurs. Start your journey today!')
@section('content')
    <main class="HomePage">
        <section class="HearderSec Home">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="MBox mt-5 pt-5 text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <span class="h5 fw-normal">{{ $bannercms->heading }}</span>
                                    <h1 class="mb-4">{{ $bannercms->title }}</h1>
                                    {!! $bannercms->description !!}
                                    <a href="{{ route('experts') }}" class="btn btn-thm btn-lg">Browse Mentor
                                        <!--<img src="{{ asset('frontend/img/arrow.svg') }}" class="ms-3" width="30" height="30">-->
                                    </a>
                                </div>
                            </div>
                            <div id="carouselSlide" class="carousel VideoBox slide wow zoomIn" data-bs-ride="carousel">
                                @foreach ($banners as $item)
                                <div class="carousel-item h-100 w-100 {{$loop->iteration==1?'active':''}}">
                                    @if ($item->type == 'image')
                                        <x-image-box>
                                            <x-slot:image>{{ $item->image }}</x-slot>
                                            <x-slot:path>/uploads/banner/</x-slot>
                                            <x-slot:alt>{{ $item->title ?? '' }}</x-slot>
                                        </x-image-box>
                                    @endif
                                    @if ($item->type == 'youtube')
                                        <!-- <button class="playbtn play"><span></span></button> -->
                                        @php
                                            $arr = explode('=', $item->title);
                                        @endphp
                                        <div class="youtube-player" data-id="{{ $arr[1] ?? '' }}"></div>
                                    @endif
                                    @if ($item->type == 'video')
                                        <!-- <button class="playbtn play"><span></span></button> -->
                                        <video id="PVideo" autoplay muted loop playsinline preload="metadata">
                                            <source src="{{ asset('/uploads/banner/' . $item->image) }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>
                                @endforeach
                                @if($banners->count()>1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselSlide" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselSlide" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($findexperts->count() > 0)
            <section class="ConnectSec">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-xl-9 col-lg-11 wow slideInDown">
                            <h2 class="h1 thm">{{ $findexpertcms->title }}</h2>
                            {!! $findexpertcms->description !!}
                        </div>
                        <div class="col-lg-6 col-xl-5 wow slideIn">
                            <ul class="step m-0 ps-3 mt-5">
                                @foreach ($findexperts as $item)
                                    <li class="mb-4">
                                        <x-image-box>
                                            <x-slot:image>{{ $item->image }}</x-slot>
                                                <x-slot:path>/uploads/findexpertstep/</x-slot>
                                                    <x-slot:alt>{{ $item->title ?? '' }}</x-slot>
                                                        <x-slot:width>32</x-slot>
                                                            <x-slot:height>32</x-slot>
                                                                <x-slot:class>me-3 mt-2</x-slot>
                                        </x-image-box>
                                        <div>
                                            <h4 class="mb-0 h3">{{ $item->title ?? '' }}</h4>
                                            {!! $item->description !!}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="text-center text-lg-start mb-4"><a href="{{ route('experts') }}" class="btn btn-thm3 btn-lg">Browse Mentor</a></div>
                        </div>
                        <div class="col-lg-6 col-xl-7 text-lg-end text-center wow slideIn">
                            <x-image-box>
                                <x-slot:image>{{ $findexpertcms->image }}</x-slot>
                                    <x-slot:path>/uploads/cms/</x-slot>
                                        <x-slot:alt>{{ $findexpertcms->title ?? '' }}</x-slot>
                                            <x-slot:width>600</x-slot>
                                                <x-slot:height>650</x-slot>
                                                    <x-slot:class>mimg</x-slot>
                            </x-image-box>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- @if ($findexperts->count() > 0)
        <section class="TabSec d-none">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center wow slideInDown">
                        <h2 class="Heading h2">{{ $findexpertcms->title }}</h2>
                        {!! $findexpertcms->description !!}
                    </div>
                </div>
                <div class="row justify-content-center mt-5 wow slideIn">
                    <div class="col-12 col-md-6 order-md-last">
                        <div class="steps-text">
                            @foreach ($findexperts as $item)
                                <div class="StepsMenu">
                                    <div class="text">
                                        <div class="w-100">
                                            <span class="TitleS">{{ $item->title ?? '' }}</span>
                                            <span class="Scon">{!! $item->description !!}</span>
                                        </div>
                                    </div>
                                    <picture>
                                        <source srcset="img/step1.webp" type="image/webp">
                                        <img loading="lazy" src="img/step1.jpg" alt="steps" width="380" height="480" class="d-md-none">
                                    </picture>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-none d-md-block">
                        <div class="steps">
                            @foreach ($findexperts as $item)
                                <x-image-box>
                                    <x-slot:image>{{ $item->image }}</x-slot>
                                        <x-slot:path>/uploads/findexpertstep/</x-slot>
                                            <x-slot:alt>{{ $item->title ?? '' }}</x-slot>
                                                <x-slot:width>380</x-slot>
                                                    <x-slot:height>480</x-slot>
                                </x-image-box>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif --}}

        @if ($experts->count() > 0)
            <section class="Sec2">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 200" fill="#fff"><polygon points="1600 200 1600 0 0 0 0 200 799.7 0.07 1600 200" /></svg> -->
                <div class="container">
                    <div class="row wow slideInDown">
                        <div class="col-12">
                            <h2 class="h1 thm">{{ $expertcms->title }}
                                <!--Top Rated Mentors-->
                            </h2>
                            <h3 class="h5 thm fw-normal">{!! $expertcms->description !!}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="owl-carousel ExpertsC">
                                @foreach ($experts as $expert)
                                    <div class="item">
                                        <div class="card ExpBlock verify">
                                            @if ($expert->top_expert == 1)
                                                <small class="TopExp"><span class="text-warning">&#9733;</span> Top
                                                    Expert</small>
                                            @endif
                                            @if(!$expert->defaultcharges) 
                                            <small class="NotAvl text-danger">Not Available</small>
                                            @endif
                                            <a href="{{ route('experts', ['alias' => $expert->user_id]) }}"
                                                class="card-header">
                                                <x-image-box>
                                                    <x-slot:image>{{ $expert->profile }}</x-slot>
                                                        <x-slot:path>/uploads/expert/</x-slot>
                                                            <x-slot:alt>{{ $expert->name ?? '' }}
                                                                {{ !empty($expert->expertise->title) ? $expert->expertise->title : '' }}
                                                                </x-slot>
                                                                <x-slot:width>380</x-slot>
                                                                    <x-slot:height>480</x-slot>
                                                </x-image-box>
                                            </a>
                                            <a href="{{ route('experts', ['alias' => $expert->user_id]) }}"
                                                class="card-body">
                                                <div>
                                                    @if (!empty($expert->expertise))
                                                        @foreach ($expert->expertise as $expertise)
                                                        @if (!empty($expertise->expertiseinfo) && $loop->iteration < 3)
                                                        <small class="bg-warning rounded-1 d-inline-block text-black mb-2">                                                            
                                                            {{ $expertise->expertiseinfo->title }}                                                            
                                                        </small>
                                                        @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="ExpCon">
                                                    <h3 class="m-0">{{ $expert->name ?? '' }}</h3>
                                                    <small class="text-white fw-lighter">
                                                        @if (!empty($expert->roles))
                                                            @foreach ($expert->roles as $roles)
                                                                @if (!empty($roles->roleinfo) && $loop->iteration < 3)
                                                                    {{ $roles->roleinfo->title }}
                                                                    {{ $loop->iteration < 1 ? ', ' : '' }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        {{ $expert->compnay_name && count($expert->expertise) > 0 ? ', ' . $expert->compnay_name : $expert->compnay_name }}
                                                    </small>
                                                </div>
                                                <div class="h5 text-white price fw-normal m-0">
                                                    @if($expert->defaultcharges)
                                                    <i class="fal fa-rupee-sign fw-normal h6 m-0"></i>
                                                        @if($expert->defaultcharges->charges > 0 )
                                                            {{ round(($expert->defaultcharges->charges) + ($expert->defaultcharges->charges * $expert->service_charges) / 100) }}/-
                                                        @else
                                                        {{ round(($expert->charge) + ($expert->charge * $expert->service_charges) / 100) }}/-
                                                        @endif                                                        
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center text-lg-end mt-4"><a href="{{ route('experts') }}" class="h5 thm4">View
                                    More <i class="fal fa-long-arrow-right"></i></a></div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($findexpertcategories->count() > 0)
            <section class="Sec7">
                <div class="container">
                    <div class="row wow slideInDown">
                        <div class="col-12 mb-5">
                            <h2 class="h1 thm">{{ $findexpertcategorycms->title }}</h2>
                            {!! $findexpertcategorycms->description !!}
                        </div>
                    </div>
                    <div class="row wow slideIn">
                        @foreach ($findexpertcategories as $item)
                            <div class="col-lg-3 col-6 mb-4">
                                <div class="card mx-lg-4 text-center">
                                    <div class="card-body">
                                        <h3 class="h4">{{ $item->title ?? '' }}</h3>
                                        {{-- <p>{{ $item->short ?? '' }}</p> --}}
                                        @foreach ($item->expertise as $exp)
                                        <a href="{{route('expertcategory',$item->alias)}}/{{$exp->alias??''}}" class="bg-secondary rounded-1 p-1 d-inline-block text-black mb-2">
                                            <small>{{ $exp->title ?? '' }}</small>
                                        </a>
                                        @endforeach
                                        <br>
                                        <a href="{{route('expertcategory',$item->alias)}}" class="thm4 d-inline-block mt-3">Know more</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center text-lg-end mt-4"><a href="{{ route('experts') }}" class="h5 thm4">View More <i
                                class="fal fa-long-arrow-right"></i></a></div>
                </div>
            </section>
        @endif

        {{-- @if ($featureds->count() > 0)
        <section class="Sec6 d-none">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="Heading h2">{{ $featuredcms->title }}</h2>
                        {!! $featuredcms->description !!}
                    </div>
                    <div class="col-12">
                        <div class="owl-carousel">
                            @foreach ($featureds as $item)
                                @php 
                                    $image = $item->image;
                                    $path = '/uploads/featured/';
                                    $width = 220;
                                    $height = 90;
                                    $alt ='';
                                @endphp
                                @if (in_array(checkimagetype($image), ['SVG']) && file_exists(public_path($path . $image)))
                                    <img loading="lazy" src="{{ asset($path . $image) }}" class="{{$class ?? ''}}" id="{{ $id ?? '' }}" alt="{{ $alt }}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
                                @elseif (in_array(checkimagetype($image), ['WEBP']) && file_exists(public_path($path . $image)))
                                    <picture class="{{$pictureclass ?? ''}}">
                                        <img loading="lazy" src="{{ asset($path . $image) }}" class="{{$class ?? ''}}" id="{{ $id ?? '' }}" alt="{{ $alt }}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
                                    </picture>
                                @elseif(file_exists(public_path($path . $image . '.webp')))
                                    <picture class="{{$pictureclass ?? ''}}">
                                        <source srcset="{{ asset($path . $image . '.webp') }}" type="image/webp">
                                        <img loading="lazy" src="{{ asset($path . 'jpg/'. $image . '.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
                                    </picture>
                                @elseif(file_exists(public_path($path . 'jpg/' . $image . '.jpg')))
                                    <picture class="{{$pictureclass ?? ''}}">
                                        <source srcset="{{ asset($path . $image . '.webp') }}" type="image/webp">
                                        <img loading="lazy" src="{{ asset($path . 'jpg/'. $image . '.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
                                    </picture>
                                @else
                                    <picture>
                                        <source srcset="{{ asset('frontend/image/no-img.webp') }}" type="image/webp">
                                        <img loading="lazy" src="{{ asset('frontend/image/no-img.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
                                    </picture>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif --}}

        @if ($testimonials->count() > 0)
            <section class="Testimonial">
                <div class="container">
                    <div class="row wow slideInDown">
                        <div class="col-12">
                            <h2 class="h1 thm">{{ $testimonialscms->title }}</h2>
                            {!! $videoscms->description !!}
                        </div>
                    </div>
                    <div class="owl-carousel Testi mt-2 wow slideIn">
                        @foreach ($testimonials as $testimonial)
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <div class="img mb-3">
                                        <x-image-box>
                                            <x-slot:image>{{ $testimonial->image }}</x-slot>
                                                <x-slot:path>/uploads/testimonial/</x-slot>
                                                    <x-slot:alt>{{ $testimonial->name ?? '' }}</x-slot>
                                                        <x-slot:width>600</x-slot>
                                                            <x-slot:height>650</x-slot>
                                                                <x-slot:class>mimg</x-slot>
                                        </x-image-box>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ps-md-5">
                                        {{-- <h3 class="h2">{{$testimonial->name}}</h3> --}}
                                        {!! $testimonial->description !!}
                                        <div class="Name mt-5">
                                            <h4 class="h3 thm4">{{ $testimonial->name }}</h4>
                                            {{-- <p>CEO, AB Pvt. Ltd.</p> --}}
                                            <span class="star" title="star"
                                                data-title="{{ $testimonial->rating }}"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="AreMentor Home">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-7 wow slideIn">
                        <h2 class="h1 thm">{{ TwoColor($expertcategorycms->title)[0] ?? '' }} <span
                                class="thm4">{{ TwoColor($expertcategorycms->title)[1] ?? '' }}</span></h2>
                        {!! $expertcategorycms->description !!}
                        <a href="{{ route('becomeanexpert') }}" class="btn btn-thm4 btn-lg mt-4 mb-4">Become an Mentor</a>
                    </div>
                    <div class="col-12 col-lg-5 d-sm-flex d-none wow slideIn">
                        <div class="row">
                            <div class="col-6 ExpertBox UpExp">
                                <div class="DivBox">
                                    @foreach ($expertcategories as $item)
                                        <x-image-box>
                                            <x-slot:image>{{ $item->image }}</x-slot>
                                                <x-slot:path>/uploads/homecategory/</x-slot>
                                                    <x-slot:alt>{{ $item->title ?? '' }}</x-slot>
                                                        <x-slot:width>600</x-slot>
                                                            <x-slot:height>650</x-slot>
                                                                <x-slot:class>mimg</x-slot>
                                        </x-image-box>
                                    @endforeach
                                </div>
                                <div class="DivBox">
                                    @foreach ($expertcategories as $item)
                                        <x-image-box>
                                            <x-slot:image>{{ $item->image }}</x-slot>
                                                <x-slot:path>/uploads/homecategory/</x-slot>
                                                    <x-slot:alt>{{ $item->title ?? '' }}</x-slot>
                                                        <x-slot:width>600</x-slot>
                                                            <x-slot:height>650</x-slot>
                                                                <x-slot:class>mimg</x-slot>
                                        </x-image-box>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-6 ExpertBox DownExp">
                                <div class="DivBox">
                                    @foreach ($expertcategories as $ditem)
                                        <x-image-box>
                                            <x-slot:image>{{ $ditem->image }}</x-slot>
                                                <x-slot:path>/uploads/homecategory/</x-slot>
                                                    <x-slot:alt>{{ $ditem->title ?? '' }}</x-slot>
                                                        <x-slot:width>600</x-slot>
                                                            <x-slot:height>650</x-slot>
                                                                <x-slot:class>mimg</x-slot>
                                        </x-image-box>
                                    @endforeach
                                </div>
                                <div class="DivBox">
                                    @foreach ($expertcategories as $ditem)
                                        <x-image-box>
                                            <x-slot:image>{{ $ditem->image }}</x-slot>
                                                <x-slot:path>/uploads/homecategory/</x-slot>
                                                    <x-slot:alt>{{ $ditem->title ?? '' }}</x-slot>
                                                        <x-slot:width>600</x-slot>
                                                            <x-slot:height>650</x-slot>
                                                                <x-slot:class>mimg</x-slot>
                                        </x-image-box>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($videos->count() > 0)
            <section class="VideoG Sec3 ">
                <div class="container">
                    <div class="row align-items-center wow slideInDown">
                        <div class="col-lg-12">
                            <h2 class="h1 thm">{{ $videoscms->title }}</h2>
                            {!! $videoscms->description !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="owl-carousel VideoSec wow slideInUp">
                                @foreach ($videos as $video)
                                    @php
                                        $arr = explode('=', $video->video_url);
                                    @endphp
                                    <div class="item">
                                        <div class="card">
                                            <div class="card-header">
                                                @if ($video->video_type == 1)
                                                    <div class="youtube-player" data-id="{{ $arr[1] ?? '' }}"></div>
                                                    <a href="" class="playVideo"></a>
                                                @endif
                                            </div>
                                            <a href="" class="card-body">
                                                <h3>{{ $video->title }}</h3>
                                                <small class="text-secondary me-3"><i class="far fa-user thm"></i>
                                                    {{ $video->expert->name ?? '' }}</small>
                                                @if (!empty($video->industries))
                                                    <small class="text-secondary">
                                                        <i class="far fa-tag thm"></i>
                                                        @foreach (json_decode($video->industries) as $industry)
                                                            @php $industry = \App\Models\Industry::find($industry); @endphp
                                                            {{ $industry->title ?? '' }} {{ !$loop->last ? '+' : '' }}
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
                    <div class="text-center"><a href="{{ url('videos') }}" class="btn btn-thm2">View All Videos <i
                                class="fal fa-arrow-right"></i></a></div>
                </div>
            </section>
        @endif

        @if ($faqs->count() > 0)
            <section class="FAQs">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 text-center wow slideInDown">
                            <span class="h4 fw-bold thm">{{ $faqscms->heading }}</span>
                            <h2 class="h1 thm">{{ $faqscms->title }}</h2>
                            {{-- <h3 class="h5 text-secondary fw-normal">Have questions ? We're here to help you.</h3> --}}
                            {!! $faqscms->description !!}
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="accordion accordion-flush Faqs" id="Faqs">
                                @foreach ($faqs as $faq)
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="Pay{{ $loop->iteration }}">
                                            <button class="accordion-button {{ $loop->iteration == 1 ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#Faqs{{ $loop->iteration }}" aria-expanded="true"
                                                aria-controls="Faqs1">{{ $faq->title }}</button>
                                        </div>
                                        <div id="Faqs{{ $loop->iteration }}"
                                            class="accordion-collapse collapse {{ $loop->iteration == 1 ? 'show' : '' }}"
                                            aria-labelledby="Pay1" data-bs-parent="#Faqs">
                                            <div class="accordion-body">{!! $faq->description !!}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- <section class="Sec4 d-none bgthm">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="MBox mt-5 pt-5 text-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <span class="h5 fw-normal">{{ $bannercms->heading }}</span>
                                <h1 class="mb-4">{{ $bannercms->title }}</h1>
                                {!! $bannercms->description !!}
                                <a href="{{ route('experts') }}" class="btn btn-thm btn-lg">Browse Mentor
                                    <!--<img src="{{ asset('frontend/img/arrow.svg') }}" class="ms-3" alt="arrow" width="30" height="30">-->
                                </a>
                            </div>
                        </div>
                        <div id="carouselSlide" class="carousel VideoBox slide wow zoomIn" data-bs-ride="carousel">
                            @foreach ($banners as $item)
                            <div class="carousel-item h-100 w-100 lh-0 {{$loop->iteration==1?'active':''}}">
                                @if ($item->type == 'image')
                                    <x-image-box>
                                        <x-slot:image>{{ $item->image }}</x-slot>
                                        <x-slot:path>/uploads/banner/</x-slot>
                                        <x-slot:alt>{{ $item->title ?? '' }}</x-slot>
                                    </x-image-box>
                                @endif
                                @if ($item->type == 'youtube')
                                    <!-- <button class="playbtn play"><span></span></button> -->
                                    @php
                                        $arr = explode('=', $item->title);
                                    @endphp
                                    <div class="youtube-player" data-id="{{ $arr[1] ?? '' }}"></div>
                                @endif
                                @if ($item->type == 'video')
                                    <!-- <button class="playbtn play"><span></span></button> -->
                                    <video id="PVideo" autoplay muted loop playsinline preload="metadata">
                                        <source src="{{ asset('/uploads/banner/' . $item->image) }}" type="video/mp4">
                                    </video>
                                @endif
                            </div>
                            @endforeach
                            @if($banners->count()>1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSlide" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselSlide" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($findexperts->count() > 0)
        <section class="ConnectSec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-9 col-lg-11 wow slideInDown">
                        <h2 class="h1 thm">{{ $findexpertcms->title }}</h2>
                        {!! $findexpertcms->description !!}
                    </div>
                    <div class="col-lg-6 col-xl-5 wow slideIn">
                        <ul class="step m-0 ps-3 mt-md-5 mt-4">
                            @foreach ($findexperts as $item)
                                <li class="mb-md-4 mb-2">
                                    <x-image-box>
                                        <x-slot:image>{{ $item->image }}</x-slot>
                                            <x-slot:path>/uploads/findexpertstep/</x-slot>
                                                <x-slot:alt>{{ $item->title ?? '' }}</x-slot>
                                                    <x-slot:width>32</x-slot>
                                                        <x-slot:height>32</x-slot>
                                                            <x-slot:class>me-3 mt-2</x-slot>
                                    </x-image-box>
                                    <div>
                                        <h4 class="mb-0 h3">{{ $item->title ?? '' }}</h4>
                                        {!! $item->description !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-center text-lg-start mb-4"><a href="{{ route('experts') }}" class="btn btn-thm3 btn-lg">Browse Mentor</a></div>
                    </div>
                    <div class="col-lg-6 col-xl-7 text-lg-end text-center wow slideIn">
                        <x-image-box>
                            <x-slot:image>{{ $findexpertcms->image }}</x-slot>
                                <x-slot:path>/uploads/cms/</x-slot>
                                    <x-slot:alt>{{ $findexpertcms->title ?? '' }}</x-slot>
                                        <x-slot:width>600</x-slot>
                                            <x-slot:height>650</x-slot>
                                                <x-slot:class>mimg</x-slot>
                        </x-image-box>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- @if ($findexperts->count() > 0)
    <section class="TabSec d-none">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center wow slideInDown">
                    <h2 class="Heading h2">{{ $findexpertcms->title }}</h2>
                    {!! $findexpertcms->description !!}
                </div>
            </div>
            <div class="row justify-content-center mt-5 wow slideIn">
                <div class="col-12 col-md-6 order-md-last">
                    <div class="steps-text">
                        @foreach ($findexperts as $item)
                            <div class="StepsMenu">
                                <div class="text">
                                    <div class="w-100">
                                        <span class="TitleS">{{ $item->title ?? '' }}</span>
                                        <span class="Scon">{!! $item->description !!}</span>
                                    </div>
                                </div>
                                <picture>
                                    <source srcset="img/step1.webp" type="image/webp">
                                    <img loading="lazy" src="img/step1.jpg" alt="steps" width="380" height="480" class="d-md-none">
                                </picture>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-6 d-none d-md-block">
                    <div class="steps">
                        @foreach ($findexperts as $item)
                            <x-image-box>
                                <x-slot:image>{{ $item->image }}</x-slot>
                                    <x-slot:path>/uploads/findexpertstep/</x-slot>
                                        <x-slot:alt>{{ $item->title ?? '' }}</x-slot>
                                            <x-slot:width>380</x-slot>
                                                <x-slot:height>480</x-slot>
                            </x-image-box>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif --}}

    

    {{-- <section class="Sec4 d-none bgthm">
    <div class="container">
        <div class="row justify-content-center wow zoomIn">
            <div class="col-lg-9 col-md-10 text-center">
                <h2 class="Heading h2 mb-4">{{$youexpert->heading}}</h2>
                <h3 class="text-white mb-4">{{$youexpert->title}}</h3>
                {!! $youexpert->description !!}
                <a href="{{url('become-an-expert')}}" class="btn btn-thm btn-lg">Become an Expert <img
                        src="{{ asset('frontend/img/arrow.svg') }}" alt="arrow" class="ms-3" width="30"
                        height="30"></a>
            </div>
        </div>
    </div>
    </section> --}}

    {{-- <section class="Sec5 d-none">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 678.11" fill="#f9f5ef"><path d="M0,310.08s136.21-124.85,346-80c316.49,67.63,334-128,568-190,206.83-54.82,371.57,40,488,40,67.74,0,198-80,198-80V678.19H0Z" /></svg>
        @if ($blogs->count() > 0)
        <div class="container">
            <div class="row justify-content-center wow slideInDown">
                <div class="col-lg-9 col-md-10 text-center">
                    <h2 class="Heading h2">{{$blogcms->title}}</h2>
                    {!! $blogcms->description !!}
                </div>
            </div>
            <div class="row mt-4 wow slideInUp">
                @foreach ($blogs as $item)
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
                                <span><i class="far fa-calendar-alt thm"></i> {{dateformat($item->post_date)}}</span>
                                
                            </div>
                            <p>{{$item->short_description}}</p>
                        </a>
                    </div>
                </div>
                @endforeach
                <div class="col-12 text-center"><a href="{{url('/blog')}}" class="btn btn-thm2">View All Blog <i class="fal fa-arrow-right"></i></a></div>
            </div>
        </div>
        @endif
        <x-newsletter/>
    </section> --}}

    <section class="Sec5 pt-0">
        <x-newsletter />
    </section>
</main>
@endsection
@push('css')
<title>Find a Mentor | Connecting Consultant & Digital Experts | Expertbells</title>
<meta name="description" content="Improve your skills and reach your personal goals with the world class mentors. Find a right mentor and consultant for your startups and entrepreneurs. Start your journey today!">
<meta name="keywords" content="Mentor, consultant, Consulting mentors, Find a mentor, Find a consultant, mentoring">
<link rel="stylesheet" href="{{asset('frontend/css/index.min.css')}}">
@endpush

@push('js')
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" onload="this.rel='stylesheet'" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous">
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" onload="this.rel='stylesheet'" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous">
<!-- <link rel="preload" as="style" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" onload="this.rel='stylesheet'"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.compat.min.css" integrity="sha512-b42SanD3pNHoihKwgABd18JUZ2g9j423/frxIP5/gtYgfBz/0nDHGdY/3hi+3JwhSckM3JLklQ/T6tJmV7mZEw==" crossorigin="anonymous" referrerpolicy="no-referrer">

<!-- <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" onload="this.rel='stylesheet'" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer">
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<!-- <script defer src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>new WOW().init();</script>
<!-- <script src="{{ asset('frontend/js/jquery.carouselTicker.js') }}"></script> -->
<script>
$(document).ready(function() {
    // $(".vertical-up").carouselTicker({
    //     mode: "vertical",
    //     direction: "prev"
    // });
    // $(".vertical-down").carouselTicker({
    //     mode: "vertical",
    //     direction: "next"
    // });
    // $('.steps').slick({slidesToShow:1,slidesToScroll:1,arrows:false,fade:false,vertical:true,asNavFor:'.steps-text',autoplay:true,autoplaySpeed:3000});
    // $('.steps-text').slick({slidesToShow:3,slidesToScroll:1,vertical:true,asNavFor:'.steps',centerMode:false,focusOnSelect:true,prevArrow:".thumb-prev",nextArrow:".thumb-next"});
    // $(".Sec1 .owl-carousel").owlCarousel({animateOut:"fadeOut",animateIn:"fadeIn",items:1,margin:60,loop:true,dots:true,nav:false,navText:['<i class="fal fa-chevron-left"></i>','<i class="fal fa-chevron-right"></i>'],autoplay:true,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true});
    $(".ExpertsC").owlCarousel({items:4,margin:30,loop:false,dots:false,nav:false,navText:['<i class="far fa-chevron-left"></i>', '<i class="far fa-chevron-right"></i>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1,margin:15},350:{items:1,margin:15},460:{items:2,margin:15},600:{items:2},768:{items:3},992:{items:3},1200:{items:4},1600:{items:4}}});
    $(".VideoSec").owlCarousel({items:3,margin:30,center:false,loop:true,dots:true,nav:false,navText:['<span></span>', '<span></span>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},350:{items:1},575:{items:2},768:{items:2},992:{items:3},1200:{items:3},1600:{items:3}}});
    $(".Testi").owlCarousel({items:1,margin:20,center:false,loop:true,dots:true,nav:false,navText:['<span></span>', '<span></span>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true});
    $(".Sec4 .owl-carousel").owlCarousel({items:4,margin:15,loop:false,dots:false,nav:false,navText:['<i class="fal fa-chevron-left"></i>', '<i class="fal fa-chevron-right"></i>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},350:{items:2},460:{items:2},600:{items:2},768:{items:3},992:{items:3},1200:{items:4},1600:{items:4}}});
    $(".Sec5 .owl-carousel").owlCarousel({items:2,margin:30,loop:false,dots:false,nav:true,navText:['<i class="fal fa-chevron-left"></i>', '<i class="fal fa-chevron-right"></i>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},350:{items:1},460:{items:1},600:{items:2},768:{items:2},992:{items:2},1200:{items:2},1600:{items:2}}});
    $(".Sec6 .owl-carousel").owlCarousel({items:7,margin:30,loop:false,dots:false,nav:false,navText:['<i class="far fa-chevron-left"></i>', '<i class="far fa-chevron-right"></i>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:2},350:{items:3},460:{items:4},600:{items:4},768:{items:5},992:{items:5},1200:{items:6},1600:{items:6}}});
    var ctrlVideo = document.getElementById("PVideo");
    $('.playbtn').click();
    // ctrlVideo.play();
    $('.playbtn').click(function() {
        // alert();
        if ($('.playbtn').hasClass("play")){ctrlVideo.play();
            $('.playbtn').removeClass("play");
        } else{ctrlVideo.pause();
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
        thumbNode.src = '//i.ytimg.com/vi/ID/sddefault.jpg'.replace(
            'ID',videoId
        );
        thumbNode.alt = "Youtube Voideo";
        thumbNode.loading = "lazy";
        div.appendChild(thumbNode);
        var playButton = document.createElement('div');
        playButton.setAttribute('class', 'play');
        div.appendChild(playButton);
        div.onclick = function(){labnolIframe(this);
        };
        playerElements[n].appendChild(div);
    }
}
document.addEventListener('DOMContentLoaded', initYouTubeVideos);

// $(document).ready(function() {
//     setTimeout(function() {
//         // alert();
//         document.querySelector(".VideoBox").querySelector(".play").click();
//         // document.querySelector(".VideoBox").querySelector("button.ytp-button").click();
//     }, 1000);
// });
</script>
@endpush
