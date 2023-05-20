@php $active = Request::segment(2); @endphp
@include('inc.html')
<head>
    <title>Home : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/cart.css')}}">
    @include('inc.header')
    <section class="Home grey lighten-4 pt20px">
        <div class="breadcrumb-main">
            <div class="breadcrumb-bg">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <a href="{{url('')}}" class="breadcrumb">Home</a>
                            <a href="{{url('cart-detail')}}" class="breadcrumb">Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="CartBlock">
                        @if(Cart::count()>0)
                        <h3 class="h5 mcolor1 mt0 fw-500">My Cart</h3>
                        <div class="CartBox">
                            <div class="CartCall">
                                <div class="row">
                                    <div class="col s6">
                                        <h6>{!! Cart::count() !!} item Added</h6>
                                    </div>
                                    <div class="col s6">
                                        <h6>Total: <i class="icofont-rupee"></i> {!! Cart::subtotal() !!}</h6>
                                    </div>
                                </div>
                                @php $cart=Cart::content(); @endphp
                                @foreach($cartItems as $item)
                                    @php
                                        $category_detail = DB::table('nav_category')
                                        ->leftJoin('pricing', 'nav_category.id', '=', 'pricing.category_id')
                                        ->select('nav_category.title as category')
                                        ->where('pricing.id', $item->id)
                                        ->first();
                                    @endphp


                                <div class="ItemBlock">
                                    <div class="ItemHead">
                                        <div class="row">

                                            <div class="col s12 l9">
                                                <h4 class="h5"><a href="#">{{$item->name}} </a></h4>
                                                <span><strong>Category Plan:</strong> {{$category_detail->category}}</span>
                                                <!-- <span>Matte Finishing | Blue Colour | 10x2x3 cm</span> -->
                                                <span>
                                                    @php
                                                    $pricing_lists = DB::table('pricing_list')->where('pricing_id', $item->id)->get();
                                                    foreach($pricing_lists as $pl)
                                                    {
                                                    echo $pl->title.', ';
                                                    }
                                                    @endphp


                                                </span>
                                                <h3 class="h6 m0 Price"><i class="icofont-rupee"></i> {{$item->price}}</h3>
                                                <div class="row valign-wrapper mt30px">
                                                    <div class="col s12 m6">
                                                        <div class="input-field">
                                                            <input type="text" name="qty" id="qty" class="number" value="{{$item->qty}}">
                                                            <input type="button" onclick="decrement_quantity()" value="-" class="value-button decrease" field="quantity">
                                                            <input type="button" onclick="increment_val()" value="+" class="value-button decrease" field="quantity">
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6 QRight">
                                                        <!-- <span>Ship on Thuesday, 22 March 2020</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ItemFoot">
                                        <div class="row">
                                            <div class="col s12 m6"><span><strong>&nbsp;</strong></span></div>
                                            <div class="col s12 m6"><a href="{{url('cart-product-remove/'.$item->rowId)}}" class="Remove"><i class="icofont-trash"></i> Remove</a></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach




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
                                        <li class="tooltipped" data-position="bottom" data-tooltip="Billing Details">
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
                                  
                                        <a href="{{ url('/shipping-details')}}" onclick="onCheckout()" class="btn btn-main">Place Order</a>
                                    
                                </div>
                            </div>
                        </div>
                        @else
                        <div style="text-align: center!important;">
                            <span><img src="{{asset('/resources/assets/frontend/images/empty-cart.png')}}" alt="cart"></span>
                        </div>
                        @endif
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
        function onCheckout() {
            var Items='';
            <?php 
                $A=1;
                foreach($cartItems as $item){
                $category_detail = DB::table('nav_category')
                            ->leftJoin('pricing', 'nav_category.id', '=', 'pricing.category_id')
                            ->select('nav_category.title as category')
                            ->where('pricing.id', $item->id)
                            ->first();
            ?>
                  
                Items +="{
                            item_name: '{!! $item->name !!}',
                            item_id: {!! $item->id !!},
                            price: {!! $item->price !!},
                            item_category: "{{$category_detail->category}}",
                            quantity:{!! $item->qty !!}
                          }";
                
              <?php if(Cart::count()!=$A){?> Items +=","; <?php }?>
            <?php $A++; } ?>
            dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
            dataLayer.push({
            event: "begin_checkout",
            ecommerce: {
              items: [Items]
            }
            
          });
        }
    </script>