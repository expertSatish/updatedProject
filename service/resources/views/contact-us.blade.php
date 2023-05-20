<?php $active = 'Account Setting'; ?>

@include('inc.html')

<head>
    <title>{!! $meta->meta_title !!}</title>
    <meta name="keywords" content="{!! $meta->meta_keywords !!}">
    <meta name="description" content="{!! $meta->meta_description !!}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/cart.css')}}"> -->
    @include('inc.header')


    <section class="inner-banner contact">
        <div class="parallax-container">
            <div class="section">
                <div class="container center">
                    <h1 class="lh-n h2 m0 mb20px fw-600">{{$data->title}}</h1>
                </div>
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="{{url('/')}}" class="breadcrumb">Home</a>
                                <a href="{{url('/contact-us')}}" class="breadcrumb">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="{{asset('/resources/assets/uploads/cms/'.$meta->text_4)}}" alt="{{$meta->meta_title}}"></div>
        </div>
    </section>
    <section class="Home Contact">
        <div class="container">
            <div class="margin_top">
                <div class="row">
                    <div class="col s12 l4">
                        <div class="contact_box "> <a href="tel:{{$data->text_4}}">
                                <figure><i class="fa fa-phone mcolor"></i></figure>
                                <h5 class="black-text"> Phone </h5>
                                <p class="mcolor1"> {{$data->text_4}} </p>
                            </a></div>
                    </div>
                    <div class="col s12 l4">
                        <div class="contact_box"> <a href="mailto:{{$data->text_3}}">
                                <figure><i class="fa fa-envelope mcolor"></i></figure>
                                <h5 class="black-text"> Want to know more? </h5>
                                <p class="mcolor1"> {{$data->text_3}} </p>
                            </a></div>
                    </div>
                    <div class="col s12 l4">
                        <div class="contact_box mob"> <a target="_blank" href="whatsapp://send?text=Hi, I would like to get more information..!&amp;phone={{$data->text_5}}">
                                <figure><i class="fa fa-whatsapp mcolor"></i></figure>
                                <h5 class="black-text"> Whatsapp </h5>
                                <p class="mcolor1"> {{$data->text_5}} </p>
                            </a>
                        </div>
                        <div class="contact_box des"> <a target="_blank" href="https://api.whatsapp.com/send?phone={{$data->text_5}}&amp;text=Hi, I would like to get more information..">
                                <figure><i class="fa fa-whatsapp mcolor"></i></figure>
                                <h5 class="black-text"> Whatsapp </h5>
                                <p class="mcolor1"> {{$data->text_5}} </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l7 lh0 push-l5">
                    <div class="img"><img src="{{asset('resources/assets/frontend/images/contact.svg')}}" alt="{{$data->text_1}}" class="w100"></div>
                </div>
                <div class="col s12 l5 pull-l7">
                    <div class="ContactForm">
                        <form action="{{ route('add-contact') }}" method="post">
                            @csrf
                            <div class="input-field"><input type="text" name="name" id="name" placeholder="" required><label for="name" class="active">Name*</label></div>
                            <div class="input-field"><input type="email" name="email" id="email" placeholder="" required><label for="email" class="active">Email ID*</label></div>
                            <div class="input-field"><input type="number" name="phone" id="contactno" maxlength="10" data-length="10" oninput="maxLengthCheck(this)" placeholder=""><label for="contactno" class="active">Contact No.*</label></div>
                            <div class="input-field"><input type="text" name="subject" id="subject" placeholder="" required><label for="subject" class="active">Subject*</label></div>
                            <div class="input-field"><textarea name="message" id="message" class="materialize-textarea" maxlength="300" data-length="300" placeholder=""></textarea><label for="message" class="active">Message*</label></div>
                            <div class="input-field"><button type="submit" class="btn btn-main waves-effect waves-light">Submit</button></div>
                        </form>
                    </div>
                    <div class="ContactInfo">
                        <h4 class="h5 mt0 white-text">{{$data->text_1}}</h4>
                        <ul class="con-info">
                            <li><i class="icofont-map-pins"></i>{{$data->text_2}}</li>
                            <li><i class="icofont-map-pins"></i> {{$data->text_6}}</li>
                            <!-- <li><i class="icofont-envelope"></i> <a href="mailto:contact@falconaviation.in">contact@falconaviation.in</a></li>
                            <li><i class="icofont-web"></i> <a href="http://www.falconaviation.in">www.falconaviation.in</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home p0 lh0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14197.346927008988!2d77.9828959600397!3d27.177151486957115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397477590bd6f4eb%3A0x4ada8cabe479c78!2sExpertbells%20Consulting%20Private%20Limited%20%7C%20GST%20Consultant%20in%20Agra%7C%20Company%20Registration%20Advisor%20in%20Agra%20%7C!5e0!3m2!1sen!2sin!4v1621513033056!5m2!1sen!2sin" style="height:350px!important;; border:none;" class="w100" allowfullscreen="" loading="lazy"></iframe>
    </section>

    @include('inc.footer')


    <!-- <script type="text/javascript" src="js/owl.carousel.min.js"></script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#sb-step").owlCarousel({
                items: 3,
                loop: false,
                dots: false,
                nav: true,
                responsiveClass: true,
                responsive: {
                    250: {
                        items: 1
                    },
                    320: {
                        items: 1
                    },
                    460: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    },
                    1600: {
                        items: 4
                    }
                }
            });
            $("#sb-step2").owlCarousel({
                items: 3,
                loop: false,
                dots: false,
                nav: true,
                responsiveClass: true,
                responsive: {
                    250: {
                        items: 1
                    },
                    320: {
                        items: 1
                    },
                    460: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    },
                    1600: {
                        items: 4
                    }
                }
            });
        });
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#Plans").owlCarousel({
                items: 5,
                loop: false,
                dots: false,
                nav: true,
                responsiveClass: true,
                responsive: {
                    250: {
                        items: 1
                    },
                    320: {
                        items: 1
                    },
                    460: {
                        items: 2
                    },
                    600: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                    1600: {
                        items: 5
                    }
                }
            });
            $("#Blog").owlCarousel({
                items: 4,
                loop: false,
                dots: false,
                nav: true,
                responsiveClass: true,
                responsive: {
                    250: {
                        items: 1
                    },
                    320: {
                        items: 1
                    },
                    460: {
                        items: 2
                    },
                    600: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 3
                    },
                    1600: {
                        items: 4
                    }
                }
            });
            $("#Clients").owlCarousel({
                items: 6,
                center: true,
                loop: true,
                dots: false,
                nav: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    250: {
                        items: 1
                    },
                    320: {
                        items: 2
                    },
                    460: {
                        items: 2
                    },
                    600: {
                        items: 3.6
                    },
                    768: {
                        items: 4
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 6
                    },
                    1600: {
                        items: 6
                    }
                }
            });
            $("#Testimonial").owlCarousel({
                items: 5,
                center: true,
                loop: true,
                dots: true,
                nav: false,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    250: {
                        items: 1
                    },
                    320: {
                        items: 1
                    },
                    460: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                    1400: {
                        items: 5
                    }
                }
            });
        });
    </script>

    <script>
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
        }
        (function($) {
            $(function() {
                $(document).ready(function() {
                    $('#pass-icon').click(function() {
                        if ($(this).hasClass('fa-eye')) {
                            $(this).removeClass('fa-eye');
                            $(this).addClass('fa-eye-slash');
                            $('.opass').attr('type', 'password');
                        } else {
                            $(this).removeClass('fa-eye-slash');
                            $(this).addClass('fa-eye');
                            $('.opass').attr('type', 'text');
                        }
                    });
                    $('#npass-icon').click(function() {
                        if ($(this).hasClass('fa-eye')) {
                            $(this).removeClass('fa-eye');
                            $(this).addClass('fa-eye-slash');
                            $('.pass').attr('type', 'password');
                        } else {
                            $(this).removeClass('fa-eye-slash');
                            $(this).addClass('fa-eye');
                            $('.pass').attr('type', 'text');
                        }
                    });
                    $('#cpass-icon').click(function() {
                        if ($(this).hasClass('fa-eye')) {
                            $(this).removeClass('fa-eye');
                            $(this).addClass('fa-eye-slash');
                            $('.cpass').attr('type', 'password');
                        } else {
                            $(this).removeClass('fa-eye-slash');
                            $(this).addClass('fa-eye');
                            $('.cpass').attr('type', 'text');
                        }
                    });
                });
            });
        })(jQuery);
    </script>