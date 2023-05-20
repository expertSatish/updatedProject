<?php $active = Request::segment(2); ?>

@include('inc.html')

<head>
    <title>Home : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/cart.css')}}">
    @include('inc.header')


    <form method="post" action="{{ url('/payment') }}">
        {{csrf_field()}}
        <section class="Home grey lighten-4 pt20px">
            <div class="breadcrumb-main">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="index.php" class="breadcrumb">Home</a>
                                <a href="{{url('cart-detail')}}" class="breadcrumb">Cart</a>
                                <a href="{{url('shipping-details')}}" class="breadcrumb">Billing Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <div class="CartBlock">
                            <h3 class="h5 mcolor1 mt0 fw-500">Select Billing Address</h3>
                            <div class="CartBox">


                                <div class="CartCall">
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <div class="Add-Address" onclick="location.href='<?php echo url('add-shipping-details'); ?>';">
                                                <div class="center">
                                                    <img src="{{asset('resources/assets/frontend/images/address-img.svg') }}" alt="{{Helper::ProjectName()}}">
                                                    <span>Add new address</span>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $address = DB::table('user_address')->where('user_id',Auth::user()->id)->get();
                                        @endphp
                                        @foreach($address as $add)
                                        <div class="col s12 l6">
                                            <div class="adBlok">
                                                <input type="radio" id="address{!! $add->id !!}" name="address_id" value="{!! $add->id !!}" @if($address->count()==1) checked @endif>
                                                <div class="Add-Address Added">
                                                    <div>
                                                        <h3 class="h5 m0 fw-600">Address {{$loop->iteration}} </h3>
                                                        <span>{{$add->name}}</span>
                                                        <p><span>{!! $add->address !!}</span></p>
                                                        <span><strong>Mobile No.</strong> (+91)-{{$add->phone}}</span>
                                                        <a href="{{url('/remove-shipping-detail/'.$add->id)}}" class="Remove"><i class="icofont-trash"></i> Remove</a> &nbsp; <a href="{{url('edit-shipping-detail/'.$add->id)}}" class="Edit"><i class="icofont-pencil"></i> Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach


                                    </div>
                                </div>
                                <div class="CartCall">
                                    <div>
                                        <!-- <div class="TopSteps">
                                        <span class="active"><span>Cart</span></span>
                                        <span><span>Billing Details</span></span>
                                        <span><span>Payment</span></span>
                                    </div> -->
                                        <ul class="track" data-track-steps="3">
                                            <li class="done tooltipped" data-position="bottom" data-tooltip="My Cart">
                                                <span>Cart</span>
                                            </li>
                                            <li class="done tooltipped" data-position="bottom" data-tooltip="Billing Details">
                                                <span>Billing Details</span>
                                            </li>
                                            <li class="tooltipped" data-position="bottom" data-tooltip="Payment">
                                                <span>Payment</span>
                                            </li>
                                        </ul>
                                        <h4 class="h6">Price Details</h4>
                                        <div class="PriceDetails">
                                            @php
                                            $gst_amount=Session::get('gst_amount');
                                            @endphp
                                            <div><span>Total</span><span><i class="icofont-rupee"></i> {{$subtotal=Cart::subtotal()}}</span></div>
                                            <!-- <div><span>Coupon Discount</span><span class="green-text"><i class="icofont-rupee"></i>0</span></div> -->
                                            @if($gst_amount)
                                            <div><span>GST</span><span><i class="icofont-rupee"></i>{{$gst_amount}}</span></div>
                                            @endif
                                            <!-- <div><span>Delivery</span><span><i class="icofont-rupee"></i> 80</span></div> -->
                                            <!-- <div><span class="FreeDel">Free Delivery</span><span>For order above <i class="icofont-rupee"></i>5000</span></div> -->
                                            <div><span class="FreeDel"></span><span></span></div>
                                        </div>
                                        <div class="PriceTotal">
                                            <div><span>Order Total</span><span><i class="icofont-rupee"></i> <?php echo (str_replace(',', '', Cart::subtotal()) + $gst_amount); ?></span></div>
                                        </div>
                                        <button type="submit" class="btn btn-main">Place Order</button>
                                    </div>
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