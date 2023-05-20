<?php $active = 'Upload Documents'; ?>

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
                                <a href="{{url('/')}}" class="breadcrumb">Home</a>
                                <a href="{{ url('/my-account') }}" class="breadcrumb">My Account</a>
                                <a class="breadcrumb">Upload Documents</a>
                            </div>
                        </div>
                    </div>
                    <h1 class="h2 Heading">Upload Documents</h1>
                </div>
            </div>
            <div class="row AccountPanel">
                @include('inc.account-left')
                <div class="col s12 l9">
                    <div class="RightBlock">
                        <div class="row">
                            <div class="col s12">
                                <div class="ListBlock grey lighten-5">
                                    <h4 class="h5 fw-600 m0">Personal Documents</h4>
                                </div>
                                <form action="{{url('/user-documents-save')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="ListBlock">
                                        <div class="row">
                                            <div class="col s12">
                                                <h4 class="m0 mcolor1 h6">Uploaded Document</h4>
                                                <div class="row">
                                                    @if(count($user_documents)>0)
                                                    @foreach($user_documents as $i)
                                                    <div class="col s12 l3 Documents">
                                                        <div class="Img">
                                                            @if(pathinfo($i->document, PATHINFO_EXTENSION)=='jpg' || pathinfo($i->document, PATHINFO_EXTENSION)=='png' || pathinfo($i->document, PATHINFO_EXTENSION)=='jpeg')
                                                            <img src="{{asset('/resources/assets/uploads/user-documents/'.$i->document)}}" width="150px" height="150px" alt="">
                                                            <span><a class="tooltipped" data-position="top" data-tooltip="Delete Document" href="{{url('/document-delete/'.$i->id)}}"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></span>
                                                            @if($i->status==0)
                                                            <label class="yellow">@if($i->document_name==null)Document @else {{$i->document_name}} @endif Under Verification</label>
                                                            @endif
                                                            @if($i->status==1)
                                                            <label class="green">@if($i->document_name==null)Document @else {{$i->document_name}} @endif Verified</label>
                                                            @endif
                                                            @if($i->status==2)
                                                            <label class="red">@if($i->document_name==null)Document @else {{$i->document_name}} @endif Rejected</label>
                                                            @endif
                                                            <span class="plusicon">
                                                                @if($i->document_name==null)
                                                                <a class="modal-trigger tooltipped" data-position="top" data-tooltip="Document title" href="#Modal4" onclick="getid({{$i->id}});"><i class="fa fa-plus"></i></a>
                                                                @else
                                                                <a class="modal-trigger tooltipped" data-position="top" data-tooltip="Document title" href="#Modal4" onclick="getid({{$i->id}});"><i class="fa fa-pencil"></i></a>
                                                                @endif
                                                            </span>
                                                            @else
                                                            <a href="{{asset('/resources/assets/uploads/user-documents/'.$i->document)}}" target="_blank"><img src="{{asset('resources/assets/frontend/images/unnamed.png')}}" alt=""></a>
                                                            @if($i->status==0)
                                                            <label class="yellow">@if($i->document_name==null)Document @else {{$i->document_name}} @endif Under Verification</label>
                                                            @endif
                                                            @if($i->status==1)
                                                            <label class="green">@if($i->document_name==null)Document @else {{$i->document_name}} @endif Verified</label>
                                                            @endif
                                                            @if($i->status==2)
                                                            <label class="red">@if($i->document_name==null)Document @else {{$i->document_name}} @endif Rejected</label>
                                                            @endif
                                                            <span class="plusicon">
                                                                @if($i->document_name==null)
                                                                <a class="modal-trigger tooltipped" data-position="top" data-tooltip="Document title" href="#Modal4" onclick="getid({{$i->id}});"><i class="fa fa-plus"></i></a>
                                                                @else
                                                                <a class="modal-trigger tooltipped" data-position="top" data-tooltip="Document title" href="#Modal4" onclick="getid({{$i->id}});"><i class="fa fa-pencil"></i></a>
                                                                @endif
                                                            </span>
                                                            <span><a class="tooltipped" data-position="top" data-tooltip="Delete Document" href="{{url('/document-delete/'.$i->id)}}"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                    <div class="col s12 l3">
                                                        <div class="file-field input-field mt0 mb20px">
                                                            <div class="btn">
                                                                <span>
                                                                    <i class="icofont-upload-alt"></i>
                                                                    Files to Upload
                                                                </span>
                                                                <input type="file" multiple name="document[]">
                                                            </div>
                                                            <div class="file-path-wrapper">
                                                                <input class="file-path validate" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col s12 l6">
                                                <h4 class="m0 mcolor1 h6">Pan Card</h4>
                                                <div class="row">
                                                    <div class="col s12 l8">
                                                        <div class="file-field input-field mt0 mb20px">
                                                            <div class="btn">
                                                                <span>
                                                                    <i class="icofont-upload-alt"></i>
                                                                    Files to Upload
                                                                </span>
                                                                <input type="file" name="pan">
                                                            </div>
                                                            <div class="file-path-wrapper">
                                                                <input class="file-path validate" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 l4 Documents">
                                                        <div class="Img">
                                                            @if(!empty($user->document))
                                                            <a href="{{asset('/resources/assets/uploads/user-documents/'.$user->pan)}}" target="_blank">Document</a>
                                                            @else
                                                            No Document Attached
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="ListBlock grey lighten-5 center"><button type="submit" class="btn btn-main">Upload</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-----Modal--------->
    <!-- Modal Structure -->
    <div id="Modal4" class="modal customize myac">
        <div class="modal-content" style="margin-top: 15%;">
            <form action="{{url('/user-documents-update')}}" method="post">
                @csrf
                <h6 class="center">Document name</h6>
                <div class="input-field">
                    <label>Document Name</label>
                    <input type="text" name="document_name" placeholder="Document Name" required>
                    <span id="fetch_id"></span>

                    <center style="margin-top: 3%;">
                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            Submit
                        </button>
                    </center>
                </div>

            </form>
        </div>
        <a href="javascript:void(0);" class="modal-action modal-close red-text h5">&#10005;</a>
    </div>


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
    <script>
        function getid(x) {
            document.getElementById('fetch_id').innerHTML = '<input type ="hidden" name ="id" value="' + x + '" >';
        }
    </script>