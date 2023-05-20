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
                        <h3 class="h5 mcolor1 mt0 fw-500">Edit Billing Details</h3>
                        <div class="CartBox">



                            <div class="CartCall">
                                <form class="ShippingP" action="{{url('edit-ship-detail/'.$data->id)}}" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <!-- <div class="col s12">
                                            <div class="input-field"><input type="text" name="fname" id="fname" class="inputtext" required><label for="fname" class="inputlabel">Company's Name</label></div>
                                        </div> -->
                                        <div class="col s12">
                                            <div class="input-field"><input type="text" name="name" value="{{$data->name}}" id="fname" class="inputtext" required>
                                                @if ($errors->has('name')) <div id="CategoryName-error" class="error">{{ $errors->first('name') }} </div> @endif
                                                <label for="fname" class="inputlabel">Full Name</label>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="number" name="phone" id="contactno1" value="{{$data->phone}}" class="inputtext" maxlength="10" required>
                                                @if ($errors->has('phone')) <div id="CategoryName-error" class="error">{{ $errors->first('phone') }} </div> @endif
                                                <label for="contactno1" class="inputlabel d-none">Contact Number</label>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="text" name="email" id="email" value="{{$data->email}}" class="inputtext" required>
                                                @if ($errors->has('email')) <div id="CategoryName-error" class="error">{{ $errors->first('email') }} </div> @endif
                                                <label for="email" class="inputlabel">Email ID</label>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="text" name="business" id="bmane" value="{{$data->business}}" class="inputtext"><label for="bmane" class="inputlabel">Business Name</label></div>
                                        </div>
                                        <div class="col s12 l6">
                                            <div class="input-field"><input type="text" name="gst" id="gstno" value="{{$data->gst}}" class="inputtext"><label for="gstno" class="inputlabel">GST Number</label></div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field"><textarea class="materialize-textarea" name="address" id="data" required>{!!$data->address!!}</textarea><label for="data" class="inputlabel">Address</label></div>
                                        </div>
                                        <div class="col s12 l6">
                                            <!-- <div class="input-field"><input type="text" name="state" id="state" class="inputtext" required><label for="state" class="inputlabel">State</label></div> -->
                                            <div class="input-field">
                                                <select name="state" id="state" onchange="get_city(this.value)" required>
                                                    <option value="">Select State</option>
                                                    @foreach($states as $i)
                                                    <option value="{{$i->id}}" @if($data->state==$i->id) selected @endif>{{$i->name}}</option>
                                                    @endforeach
                                                </select>
                                                <label>State</label>
                                            </div>
                                        </div>
                                        <div class="col s12 l6">
                                            <!-- <div class="input-field"><input type="text" name="city" id="city" class="inputtext" required><label for="city" class="inputlabel">City/ District/ Town</label></div> -->
                                            <div class="input-field">
                                                <select name="city" id="cities" required>

                                                </select>
                                                <label>City</label>
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            <p><label class="check"><input type="checkbox" class="filled-in" checked="checked"><span>Same as Bill Address <a href="#" class="mcolor">Add Bill Address</a></span></label></p>
                                        </div>
                                        <div class="col s12"><button type="submit" class="btn btn-main1 right">Save and Deliver here</button></div>
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
            get_city("{{$data->state}}");
        });

        function get_city(x) {


            fetch("{{url('get-cities/')}}/"+ x)
                .then(response => response.json())
                .then(data => {
                    var i;
                    var y = '<option value="">Select City</option>';
                    for (i = 0; i < data.length; i++) {

                        var select = '';

                        if (data[i].id == '{{$data->city}}') {
                            select = 'selected';
                        }

                        y += '<option value = "' + data[i].id + '" ' + select + '>' + data[i].name + '</option>';
                    }
                    $('#cities').html(y);
                    $('select').formSelect();
                });


        }
    </script>