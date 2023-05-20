<?php $active = 'Orders'; ?>

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
                                <a class="breadcrumb">My Orders</a>
                            </div>
                        </div>
                    </div>
                    <h1 class="h2 Heading">My Orders</h1>
                </div>
            </div>
            <div class="row AccountPanel">
                @include('inc.account-left')
                <div class="col s12 l9">
                    <div class="RightBlock">
                        <div class="row">
                            <div class="col s12">

                                @if($order_id==0)
                                <div class="ListBlock Acc-ProBlock">
                                    <div class="row">

                                        <div class="col s8 m6 l7">
                                            No order found.
                                        </div>
                                    </div>
                                </div>
                                @else
                                @php
                                $order_arr = DB::table('order_details')
                                ->Join('order', 'order.id', '=', 'order_details.order_id')
                                ->Join('order_status', 'order_status.order_status_id', '=', 'order.order_status_id')
                                ->whereIn('order.id',$order_id)
                                ->orderBy('order.id','desc')
                                ->get();

                                @endphp

                                @foreach($order_arr as $order)

                                <div class="ListBlock Acc-ProBlock">
                                    <div class="row">

                                        <div class="col s8 m6 l7">
                                            <div class="FProText">
                                                <h4 class="h6 m0"><a href="#">{{$order->title}}</a></h4>
                                                <span class="price">{{$order->currency}} {{$order->amount}}/-</span>
                                                <span class="odate"><strong>Order Date:</strong>{{date('d M, Y', strtotime($order->date))}}</span><br>
                                                @if($order->status_name=='Purchased')
                                                <span class="odate orange-text"><strong>Order Purchased</strong></span>
                                                @endif
                                                @if($order->status_name=='Cancelled')
                                                <span class="odate red-text"><strong>Order Cancelled</strong></span>
                                                @endif
                                                @if($order->status_name=='Fullfilled')
                                                <span class="odate green-text"><strong>Order Fullfilled</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col s12 m4 l3 right-align">
                                            @if($order->status_name=='Purchased' || $order->status_name=='Fullfilled')
                                            <a href="{{url('/download-invoice/'.$order->id)}}" class="btn btn-main1">Download Invoice</a>
                                            @endif
                                            <a href="{{url('/order-detail/'.$order->id)}}" class="btn btn-main">View Order</a>
                                            @if($order->status_name=='Purchased' && $order->payment_status==1)
                                            <a href="{{url('/upload-documents')}}" class="btn btn-main1">Upload Documents</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
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