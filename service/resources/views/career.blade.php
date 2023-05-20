<?php
ob_start();
$active = 'About Us';
?>
@include('inc.html')

<head>
    <title>{!! $meta->meta_title !!}</title>
    <meta name="keywords" content="{!! $meta->meta_keywords !!}">
    <meta name="description" content="{!! $meta->meta_description !!}">
    @include('inc.header')
    <section class="inner-banner about">
        <div class="parallax-container">
            <div class="section">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="{{url('/')}}" class="breadcrumb">Home</a>
                                <a href="{{url('/career')}}" class="breadcrumb">Career</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="{{asset('resources/assets/uploads/cms/'.$meta->text_4)}}" alt="{{$meta->meta_title}}"></div>
        </div>
    </section>
    <section class="Home">
        <div class="container">
            <div class="row valign-wrapper">
                <div class="col s12 m6">
                    <img src="{{asset('resources/assets/uploads/cms/'.$data->image)}}"  class="w100"  alt="{{$data->title}}">
                </div>
                <div class="col s12 m6">
                    <h1 class="h3 Heading">{{$data->title}}</h1>
                    {!!$data->description!!}
                    <a href="#Careers" class="btn btn-main mt10px modal-trigger">Send Your Resume</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Structure -->
    <div id="Careers" class="modal customize">
        <div class="modal-content">
            <div class="center">
                <h4 class="h5 Heading mb10px">Send Your Resume</h4>
            </div>
            <form method="POST" action="{{url('/career-enquiry-save')}}" enctype="multipart/form-data" id="contactform" class="ConForm" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col s12 l6">
                        <div class="input-field">
                            <input id="first_name" name="name" type="text" class="validate" required="">
                            <label for="first_name">Full Name</label>
                        </div>
                    </div>
                    <div class="col s12 l6">
                        <div class="input-field">
                            <input id="email" type="email" name="email" class="validate" required="">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="col s12 l6">
                        <div class="input-field">
                            <input id="contactno" type="text" name="phone" class="validate" required="">
                            <label for="contactno">Phone No.</label>
                        </div>
                    </div>
                    <div class="col s12 l6">
                        <div class="input-field">
                            <input id="subject" type="text" name="subject" class="validate" required="">
                            <label for="subject">Subject</label>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field"><textarea id="textarea1" class="materialize-textarea" name="message" required=""></textarea>
                            <label for="textarea1">Message</label>
                        </div>
                        <div class="file-field input-field">
                            <div class="btn btn-main"><span>File</span>
                                <input type="file" name="file" required="">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="file">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col s12 center">
                        <button type="submit" class="btn btn-main">Submit</button> &nbsp; <button type="reset" class="btn btn-main1">Reset</button>
                    </div>
                </div>
            </form>
        </div>
        <a href="javascript:void(0);" class="modal-action modal-close h5">&#10005;</a>
    </div>

    <section class="Home grey lighten-4 pb30px">
        <div class="container">
            <div class="row valign-wrapper">
                <div class="col s12 l4">
                    <div class="Blocks white">
                        <img class="responsive-img" src="{{asset('resources/assets/uploads/cms/'.$we_are_friendly->image)}}" alt="{{$we_are_friendly->title}}" width="100">
                        <h5>{{$we_are_friendly->title}}</h5>
                        {!!$we_are_friendly->description!!}
                    </div>
                </div>
                <div class="col s12 l4">
                    <div class="Blocks white">
                        <img class="responsive-img" src="{{asset('resources/assets/uploads/cms/'.$on_time_payment->image)}}" alt="{{$on_time_payment->title}}" width="100">
                        <h5>{{$on_time_payment->title}}</h5>
                        {!!$on_time_payment->description!!}
                    </div>
                </div>
                <div class="col s12 l4">
                    <div class="Blocks white">
                        <img class="responsive-img" src="{{asset('resources/assets/uploads/cms/'.$on_time_growth->image)}}" alt="{{$on_time_growth->title}}" width="100">
                        <h5>{{$on_time_growth->title}}</h5>
                        {!!$on_time_growth->description!!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('inc.footer')