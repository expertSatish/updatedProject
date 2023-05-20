<?php $active = 'Review & Ratings'; ?>

@include('inc.html')

<head>
    <title>Home : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/cart.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/frontend/css/my-account.css')}}" media="screen,projection">
    @include('inc.header')

    <section class="Home MyAccount pt10px grey lighten-5">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="breadcrumb-bg bnone position-r">
                        <div class="row">
                            <div class="col s12">
                                <a href="{{url('')}}" class="breadcrumb">Home</a>
                                <a href="{{ url('my-account') }}" class="breadcrumb">My Account</a>
                                <a class="breadcrumb">Review & Ratings</a>
                            </div>
                        </div>
                    </div>
                    <h1 class="h2 Heading">Review & Ratings</h1>
                </div>
            </div>
            <div class="row AccountPanel">
                @include('inc.account-left')
                <div class="col s12 l9">
                    <div class="RightBlock">
                        <div class="ViewBlock">
                            <div class="ViewContent">
                                <form class="ReviewForm" action="{{url('add-review')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col s12">
                                            <h6 class="m0 black-text h5">Be the first to review</h6>
                                            <p class="mt0 fs13">Your email address will not be published. Required fields are marked *</p>
                                        </div>
                                        <div class="col s12 m7">
                                            <label class="fw-600 fs13 black-text">Your Rating</label><br>
                                            <div class="rating mt10px">
                                                <input type="radio" value="5" name="rating" id="rating-5">
                                                <label for="rating-5"></label>
                                                <input type="radio" value="4" name="rating" id="rating-4">
                                                <label for="rating-4"></label>
                                                <input type="radio" value="3" name="rating" id="rating-3">
                                                <label for="rating-3"></label>
                                                <input type="radio" value="2" name="rating" id="rating-2">
                                                <label for="rating-2"></label>
                                                <input type="radio" value="1" name="rating" id="rating-1">
                                                <label for="rating-1"></label>
                                                <div class="emoji-wrapper">
                                                    <div class="emoji">
                                                        <img src="{{asset('resources/assets/frontend/images/rating.svg')}}" alet="rating" class="rating-0">
                                                        <img src="{{asset('resources/assets/frontend/images/rating1.svg')}}" alet="rating">
                                                        <img src="{{asset('resources/assets/frontend/images/rating2.svg')}}" alet="rating">
                                                        <img src="{{asset('resources/assets/frontend/images/rating3.svg')}}" alet="rating">
                                                        <img src="{{asset('resources/assets/frontend/images/rating4.svg')}}" alet="rating">
                                                        <img src="{{asset('resources/assets/frontend/images/rating5.svg')}}" alet="rating">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s6 m7">
                                            <div class="input-field"><input type="text" value="{{old('name')}}" name="name" id="name"><label for="name">Name *</label></div>
                                        </div>
                                        <div class="col s6 m7">
                                            <div class="input-field"><input type="email" name="email" value="{{old('email')}}"  id="email"><label for="email">Email ID *</label></div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field"><textarea name="message" class="materialize-textarea" maxlength="300" data-length="300" id="message">{{old('message')}}</textarea><label for="message">Message</label></div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field"><input type="file" name="image"></div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field"><button type="submit" class="btn btn-main">Submit</button></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @foreach($lists as $list)
                            <div class="ViewContent ReviewBlock">
                                <p class="m0 mb5px fw-900">{{$list->title}}</p>
                                <p class="mt0 fs13">{{$list->content}}</p>
                                <span class="stars m0">@for($A=1;$A<=5;$A++) {!!($A<=$list->rating)?'&#9733;':'<span>&#9733;</span>'!!} @endfor</span>
                                <span class="grey-text fs12 right">{{date('l d M, Y',strtotime($list->created_at))}}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
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