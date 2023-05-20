<?php
ob_start();
$active = 'About Us';
?>
@include('inc.html')

<head>
    @php
    $meta=DB::table('page_section')->where('id',50)->first();
    @endphp

    <title>{!! $meta->meta_title !!}</title>
    <meta name="keywords" content="{!! $meta->meta_keywords !!}">
    <meta name="description" content="{!! $meta->meta_description !!}">
    <style type="text/css">
        .TestimonialIn .img{width:80px;height:80px;border-radius:50%;overflow:hidden;margin-bottom:15px}
        .TestimonialIn .img>img{height:100%!important;width:100%!important;object-fit:cover}
    </style>
    @include('inc.header')
    <section class="inner-banner about">
        <div class="parallax-container">
            <div class="section">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="{{url('/')}}" class="breadcrumb">Home</a>
                                <a href="{{url('/testimonial-list')}}" class="breadcrumb">Testimonials</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img class="lazyload" data-src="{{asset('resources/assets/uploads/cms/'.$page_section->text_4)}}" alt="{{$meta->meta_title}}"></div>
        </div>
    </section>
    <section class="Home pb30px">
        <div class="container">
            <div class="row" style="display:flex;flex-wrap:wrap">
                <div class="col s12">
                    <h1 class="h3 Heading">{{$page_section->page_name}}</h1>
                </div>
                @foreach($testimonials as $i)
                <div class="col s12 m6">
                    <div class="TestimonialIn">
                        <!-- <span class="h1 lh-n mcolor1">"</span> -->
                        <div class="img"><img class="lazyload" data-src="{{asset('resources/assets/uploads/testimonials/'.$i->image)}}" alt="{{$i->title}}"></div>
                        <p class=" mt0">{!!$i->content!!}</p>
                        <div class="right">
                            <h4 class="h6 fw-600 m0 lh-n mcolor1">{{$i->title}}</h4>
                            <p class="m0 fs12 lh-n grey-text">{{$i->designation}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- <div class="col s12 m6">
                    <div class="TestimonialIn">
                        <span class="h1 lh-n mcolor1">"</span>
                        <div class="img"><img src="images/test-img.jpg"></div>
                        <p class=" mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        <div class="right">
                            <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                            <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="TestimonialIn">
                        <span class="h1 lh-n mcolor1">"</span>
                        <div class="img"><img src="images/test-img.jpg"></div>
                        <p class=" mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        <div class="right">
                            <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                            <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="TestimonialIn">
                        <span class="h1 lh-n mcolor1">"</span>
                        <div class="img"><img src="images/test-img.jpg"></div>
                        <p class=" mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        <div class="right">
                            <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                            <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="TestimonialIn">
                        <span class="h1 lh-n mcolor1">"</span>
                        <div class="img"><img src="images/test-img.jpg"></div>
                        <p class=" mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        <div class="right">
                            <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                            <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="TestimonialIn">
                        <span class="h1 lh-n mcolor1">"</span>
                        <div class="img"><img src="images/test-img.jpg"></div>
                        <p class=" mt0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        <div class="right">
                            <h4 class="h6 fw-600 m0 lh-n mcolor1">Robert Smith</h4>
                            <p class="m0 fs12 lh-n grey-text">Director (www)</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    @include('inc.footer')