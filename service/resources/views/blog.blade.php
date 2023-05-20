<?php
ob_start();
$active = 'Blog';
?>
@include('inc.html')

<head>
<title>{!! $meta->meta_title !!}</title>
<meta name="keywords" content="{!! $meta->meta_keywords !!}">
<meta name="description" content="{!! $meta->meta_description !!}">
<style>.shorttext{transition:all .5s;font-size:14px;margin:0;color:#333;display:-webkit-box;overflow:hidden!important;-webkit-box-orient:vertical;-webkit-line-clamp:3;height:95px!important}
.shorttext p{overflow:hidden!important}
.inner-banner>div.imgsec{min-height:380px;height:380px;}
.inner-banner>div.imgsec>img{object-fit:cover;height:100%!important;}
@media only screen and (max-width:992px){.inner-banner>div.imgsec{min-height:80px;height:auto;}}
@media only screen and (max-width:600px){.inner-banner>div.imgsec>img{width:136%!important;margin-left:-18%!important}}
</style>
@include('inc.meta.blog-meta')
@include('inc.header')
<section class="inner-banner about">
    <div class="imgsec"><img src="{{asset('resources/assets/uploads/cms/'.$meta->text_4)}}" alt="{{$meta->meta_title}}" class="w100"></div>
    <div class="breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <a href="{{url('/')}}" class="breadcrumb">Home</a>
                    <a href="{{url('/blog')}}" class="breadcrumb">Blog</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section class="inner-banner about">
    <div class="parallax-container">
        <div class="section">
            <div class="breadcrumb-bg">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <a href="{{url('/')}}" class="breadcrumb">Home</a>
                            <a href="{{url('/blog')}}" class="breadcrumb">Blog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="{{asset('resources/assets/uploads/cms/'.$meta->text_4)}}" alt="{{$meta->meta_title}}"></div>
    </div>
</section> -->
<section class="Home Blog Blog-listing pt30px">
    <div class="container">
        <div class="row">
            <div class="col s12 center">
                <h1 class="Heading1">Our <span class="mcolor2">Blog</span></h1>
            </div>
            @if(count($blog_post)>0)
            @foreach($blog_post as $i)
            <div class="col s12 l3">
                <div class="BlogBlock">
                    @if($i->post_image)
                    <div class="Img"><img src="{{asset('resources/assets/uploads/post/thumb/'.$i->post_image)}}" alt="{{$i->post_name}}"></div>
                    @else
                    <div class="Img">No Image Found</div>
                    @endif
                    <div class="Text">
                        <h2 class="h6"><a href="{{URL('/blog-detail/'.$i->post_alias)}}">{{$i->post_name}}</a></h2>
                        <div class="shorttext">{!!$i->post_short_desc!!}</div>
                        <a href="{{url('/blog-detail/'.$i->post_alias)}}" class="btn btn-main3">Read More <svg viewBox="0 0 15.61 11.54">
                                <polygon points="15.16 5.3 9.86 0 8.45 1.41 11.75 4.71 0 4.71 0 6.71 11.86 6.71 8.45 10.13 9.86 11.54 15.16 6.24 15.61 5.77 15.16 5.3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-12 center" style="padding-top:8%;">
                <strong class="h5">Sorry! No Data Found...</strong>
            </div>
            @endif

        </div>
    </div>
</section>
@include('inc.footer')