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


    <!-- @if(Session::has('success_msg'))

<div class="green alert_box" id="alert_box">
{{ Session::get('success_msg') }}
        <span class="close" id="alert_close">&#10005;</span>
    </div>
@endif -->


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
                        <h3 class="h5 mcolor1 mt0 fw-500">Add Billing Details</h3>
                        <div class="CartBox">



                            <div class="CartCall">
                                <form class="ShippingP" action="{{url('add-ship-detail')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <!-- <div class="col s12">
                                            <div class="input-field"><input type="text" name="fname" id="fname" class="inputtext" required><label for="fname" class="inputlabel">Company's Name</label></div>
                                        </div> -->
                                        <div class="col s12">
                                            <div class="input-field"><input type="text" name="name" id="fname" class="inputtext" required>
                                                @if ($errors->has('name')) <div id="CategoryName-error" class="error">{{ $errors->first('name') }} </div> @endif
                                                <label for="fname" class="inputlabel">Full Name</label>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="number" name="phone" id="contactno1" class="inputtext" maxlength="10" required>
                                                @if ($errors->has('phone')) <div id="CategoryName-error" class="error">{{ $errors->first('phone') }} </div> @endif
                                                <label for="contactno1" class="inputlabel d-none">Contact Number</label>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="text" name="email" id="email" class="inputtext" required>
                                                @if ($errors->has('email')) <div id="CategoryName-error" class="error">{{ $errors->first('email') }} </div> @endif
                                                <label for="email" class="inputlabel">Email ID</label>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="text" name="business" id="bmane" class="inputtext"><label for="bmane" class="inputlabel">Business Name</label></div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="text" name="gst" id="gstno" class="inputtext"><label for="gstno" class="inputlabel">GST Number</label></div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field"><textarea class="materialize-textarea" name="address" id="address" required></textarea><label for="address" class="inputlabel">Address</label></div>
                                        </div>
                                        <div class="col s12 l6">
                                            <!-- <div class="input-field"><input type="text" name="state" id="state" class="inputtext" required><label for="state" class="inputlabel">State</label></div> -->
                                            <div class="input-field">
                                                <select name="state" id="state" onchange="get_city()" required>
                                                    <option value="">Select State</option>
                                                    @foreach($states as $i)
                                                    <option value="{{$i->id}}">{{$i->name}}</option>
                                                    @endforeach
                                                </select>
                                                <label>State</label>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <!-- <div class="input-field"><input type="text" name="city" id="city" class="inputtext" required><label for="city" class="inputlabel">City/ District/ Town</label></div> -->
                                            <div class="input-field">
                                                <select name="city" id="cities" required>
                                                    <option value="">Select City</option>
                                                </select>
                                                <label>City</label>
                                            </div>
                                        </div>

                                        <div class="col s12">
                                            <p><label class="check"><input type="checkbox" class="filled-in" checked="checked"><span>Same as Bill Address <a href="#" class="mcolor">Add Bill Address</a></span></label></p>
                                        </div>
                                        <div class="col s12"><a href="{{url('/shipping-details')}}" class="btn btn-main1 left">Cancel</a><button type="submit" class="btn btn-main1 right">Save and Deliver here</button></div>

                                    </div>
                                </form>
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
                                        <div><span>Order Total</span><span><i class="icofont-rupee"></i> <?php echo (str_replace(',', '', Cart::subtotal()) + 26) - (70 + 69); ?></span></div>
                                    </div>
                                    <a href="{{ url('shipping-details') }}" class="btn btn-main">Place Order</a>
                                </div>
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

    <script>
        function get_city() {

            var x = document.getElementById('state').value;

            fetch('http://127.0.0.1/Laravel/expertbells/get-cities/' + x)
                .then(response => response.json())
                .then(data => {
                    var i;
                    var y = '<option value="">Select City</option>';
                    for (i = 0; i < data.length; i++) {



                        y += '<option value = "' + data[i].id + '" >' + data[i].name + '</option>';
                    }
                    $('#cities').html(y);
                    $('select').formSelect();
                });


        }
    </script>