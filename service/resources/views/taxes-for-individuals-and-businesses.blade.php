<?php
ob_start();
$active = 'Home';


?>
@include('inc.html')
<head>
    <title>{!! $taxes->meta_title !!}</title>
    <meta name="keywords" content="{!! $taxes->meta_keywords !!}">
    <meta name="description" content="{!! $taxes->meta_description !!}">

    @include('inc.header')
    <section class="inner-banner about Services">
        <div class="parallax-container">
            <div class="section pt60px pb60px">
                <div class="container">
                    <div class="row d-flex">
                        <div class="col s12 l6">
                            <h1 class="h2 Heading black-text">{{$taxes->banner_title}}</h1>
                            <!-- <h1 class="h2 Heading black-text">TDS RETURN <br><span class="mcolor">FILING</span></h1> -->
                            <h5 class="fw600 black-text">{!!$taxes->banner_text!!}</h5>
                            @foreach($taxes_list1 as $i)
                            <ul class="ul-list1">
                                <li>{{$i->title}}</li>
                            </ul>
                            @endforeach
                        </div>
                        <div class="col s12 l6">
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="{{url('/')}}" class="breadcrumb">Home</a>
                                <a href="" class="breadcrumb">TDS Return Filing</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($taxes->banner_image!=NULL)
            <div class="parallax"><img src="{{asset('resources/assets/uploads/banner/'.$taxes->banner_image)}}" alt="{{$taxes->banner_title}}"></div>
            @else
            <div class="parallax"><img src="{{asset('resources/assets/frontend/images/about_banner.jpg')}}" alt="{{$taxes->banner_title}}"></div>
            @endif
        </div>
    </section>
    <section class="Home TexeBlock Contact">
        <div class="container">
            <div class="center">
                <h2 class="h3 Heading">{{$taxes->title}}</h2>
            </div>
            <div class="row">
                <div class="col s12 l5">
                    {!! $taxes->about !!}
                    <h4 class="m0 h6 fw-600">{{$taxes->list_title}}</h4>
                    <ul class="ul-list1">
                        @foreach($taxes_list2 as $i)
                        <li>{{$i->title}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col s12 l7">
                    <div data-aos="fade-right" data-aos-duration="900">
                        <div class="ContactForm">
                            <form action="{{url('/control-panel/tax-enquiry-save')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="text" name="pan" id="pan" placeholder="" required=""><label for="pan" class="active">PAN*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="text" name="name" id="name" placeholder="" required=""><label for="name" class="active">Name*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="email" name="email" id="email" placeholder="" required=""><label for="email" class="active">Email ID*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="number" name="phone" id="contactno" maxlength="10" data-length="10" oninput="maxLengthCheck(this)" placeholder="" required=""><label for="contactno" class="active">Contact No.*</label></div>
                                    </div>
                                    <div class="col s12">
                                        <label class="black-text">INCOME TAX DOCUMENTS</label><span style="font-size: 12px;color:red;"> (Documents support PDF, PNG, JPG, JPEG Only)</span>
                                        <div class="file-field input-field mt0 mb20px">
                                            <div class="btn">
                                                <span>
                                                    <i class="icofont-upload-alt"></i>
                                                    Files to Upload
                                                </span>
                                                <input type="file" name="document[]" multiple>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field"><textarea name="message" id="message" class="materialize-textarea" maxlength="300" data-length="300" placeholder="" required=""></textarea><label for="message" class="active">Message*</label></div>
                                    </div>
                                </div>
                                <div class="input-field center"><button type="submit" class="btn btn-main waves-effect waves-light">Submit</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="Home pt0">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h3 class="h2 Heading">FAQs</h3>
                    <ul class="collapsible faqs">
                        <li class="active" data-aos="fade-up" data-aos-duration="900">
                            <div class="collapsible-header">What are the pre-requisites for incorporation of Public Limited Company in India?</div>
                            <div class="collapsible-body"><span>There should be 7 Shareholders and 3 Directors with minimum Rs 5 Lac of paid-up share capital.</span></div>
                        </li>
                        <li data-aos="fade-up" data-aos-duration="900">
                            <div class="collapsible-header">What are the pre-requisites for incorporation of Public Limited Company in India?</div>
                            <div class="collapsible-body"><span>There should be 7 Shareholders and 3 Directors with minimum Rs 5 Lac of paid-up share capital.</span></div>
                        </li>
                        <li data-aos="fade-up" data-aos-duration="900">
                            <div class="collapsible-header">What are the pre-requisites for incorporation of Public Limited Company in India?</div>
                            <div class="collapsible-body"><span>There should be 7 Shareholders and 3 Directors with minimum Rs 5 Lac of paid-up share capital.</span></div>
                        </li>
                        <li data-aos="fade-up" data-aos-duration="900">
                            <div class="collapsible-header">What are the pre-requisites for incorporation of Public Limited Company in India?</div>
                            <div class="collapsible-body"><span>There should be 7 Shareholders and 3 Directors with minimum Rs 5 Lac of paid-up share capital.</span></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->
    @include('inc.footer')
    <script>
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
        }
    </script>