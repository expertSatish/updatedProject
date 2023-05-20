<?php $active = 'Account Setting'; ?>


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

    <form method="POST" action="{{ route('update-account') }}">
        @csrf
        <section class="Home MyAccount pt10px grey lighten-5">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <div class="breadcrumb-bg bnone position-r">
                            <div class="row">
                                <div class="col s12">
                                    <a href="{{url('')}}" class="breadcrumb">Home</a>
                                    <a href="{{ url('my-account') }}" class="breadcrumb">My Account</a>
                                    <a class="breadcrumb">Account Setting</a>
                                </div>
                            </div>
                        </div>
                        <h1 class="h2 Heading">Account Setting</h1>
                    </div>
                </div>
                <div class="row AccountPanel">
                    @include('inc.account-left')
                    <div class="col s12 l9">
                        <div class="RightBlock">
                            <div class="row">
                                <div class="col s12">
                                    <div class="ListBlock grey lighten-5">
                                        <h4 class="h5 fw-600 m0">Personl Details</h4>

                                        <!-- @if(Session::has('success_msg'))

                                        <div class="green alert_box" id="alert_box">
                                            {{ Session::get('success_msg') }}
                                            <span class="close" id="alert_close">&#10005;</span>
                                        </div>
                                        @endif

                                        @if(Session::has('error_msg'))

                                        <div class="red alert_box" id="alert_box">
                                            {{ Session::get('error_msg') }}
                                            <span class="close" id="alert_close">&#10005;</span>
                                        </div>
                                        @endif -->



                                    </div>
                                    <div class="ListBlock">
                                        <div class="row">
                                            <div class="col s12 l6">
                                                <div class="input-field"><input type="text" name="first_name" id="first_name" value="{{$user->first_name}}" class="inputtext" required><label for="fname" class="inputlabel">First Name</label></div>
                                            </div>
                                            <div class="col s12 l6">
                                                <div class="input-field"><input type="text" name="last_name" id="last_name" value="{{$user->last_name}}" class="inputtext" required><label for="fname" class="inputlabel">Last Name</label></div>
                                            </div>
                                            <div class="col s12 l6">
                                                <div class="input-field"><input type="number" name="phone" id="contactno1" value="{{$user->phone}}" class="inputtext" maxlength="10" oninput="maxLengthCheck(this)" required><label for="contactno1" class="inputlabel d-none">Contact Number</label></div>
                                            </div>
                                            <div class="col s12 l6">
                                                <div class="input-field"><input type="text" class="inputtext datepicker" name="dob" id="date" value="{{$user->dob}}" required><label for="date" class="inputlabel d-none">Date of Birth</label></div>
                                            </div>
                                            <div class="col s12 l6">
                                                <div class="input-field row mt10px">
                                                    <div class="col s3"><span>Gender *</span></div>
                                                    <div class="col s9">
                                                        <div class="radio-btn">


                                                            @if(!empty($user->gender))

                                                            <div class="radio-btn-main">
                                                                <input type="radio" name="gender" value="male" id="radio1" class="inputtext" @php if($user->gender=='male') {echo 'checked';} @endphp >
                                                                <label for="radio1"><i class="icofont-business-man-alt-2"></i> Male</label>
                                                            </div>
                                                            <div class="radio-btn-main">
                                                                <input type="radio" name="gender" value="female" id="radio2" class="inputtext" @php if($user->gender=='female') {echo 'checked';} @endphp >
                                                                <label for="radio2"><i class="icofont-girl-alt"></i> Female</label>
                                                            </div>

                                                            @else

                                                            <div class="radio-btn-main">
                                                                <input type="radio" name="gender" value="male" id="radio1" class="inputtext">
                                                                <label for="radio1"><i class="icofont-business-man-alt-2"></i> Male</label>
                                                            </div>
                                                            <div class="radio-btn-main">
                                                                <input type="radio" name="gender" value="female" id="radio2" class="inputtext">
                                                                <label for="radio2"><i class="icofont-girl-alt"></i> Female</label>
                                                            </div>

                                                            @endif



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ListBlock grey lighten-5">
                                        <h4 class="h5 fw-600 m0">Change Password</h4>
                                    </div>
                                    <div class="ListBlock">
                                        <div class="row">
                                            <div class="col s12 l6">
                                                <div class="mb20px">
                                                    <div class="input-field passw">
                                                        <input type="password" name="old_password" id="opass" class="opass inputtext" autocomplete="current-password"><label for="opass" class="inputlabel">Current Password</label><i id="pass-icon" class="mt10px fa fa-eye-slash"></i>
                                                    </div>
                                                </div>
                                                <div class="mb20px">
                                                    <div class="input-field passw">
                                                        <input type="password" name="password" id="npass" class="pass inputtext" autocomplete="current-password"><label for="npass" class="inputlabel">New Password</label><i id="npass-icon" class="mt10px fa fa-eye-slash"></i>
                                                    </div>
                                                </div>
                                                <div class="mb20px">
                                                    <div class="input-field passw">
                                                        <input type="password" name="cpassword" id="cpass" class="cpass inputtext" autocomplete="current-password"><label for="cpass" class="inputlabel">Confirm Password</label><i id="cpass-icon" class="mt10px fa fa-eye-slash"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 l6">
                                                <h5 class="m0 mcolor1 h6 fw-600">Subscription</h5>
                                                <label class="check">
                                                    @if($user->subscription==1)
                                                    <input type="checkbox" name="subscription" value="0" class="filled-in" checked="checked"><span>I agree with Newsletter/ Subscription</span>
                                                    @else
                                                    <input type="checkbox" name="subscription" value="1" class="filled-in"><span>I agree with Newsletter/ Subscription</span>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ListBlock grey lighten-5 center"><button type="submit" class="btn btn-main">Save</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

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