<?php $active = Request::segment(2); ?>

@include('inc.html')

<head>
    @php
    $meta=DB::table('page_section')->where('id',51)->first();
    @endphp
    <title>{!! $meta->meta_title !!}</title>
    <meta name="keywords" content="{!! $meta->meta_keywords !!}">
    <meta name="description" content="{!! $meta->meta_description !!}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/cart.css')}}">
    @include('inc.header')




    <form method="post" action="{{ url('/payment-success') }}">
        @csrf
        <section class="Home grey lighten-4 pt20px">
            <div class="breadcrumb-main">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="index.php" class="breadcrumb">Home</a>
                                <a href="{{url('/cart-detail')}}" class="breadcrumb">Cart</a>
                                <a href="{{url('/shipping-details')}}" class="breadcrumb">Billing Details</a>
                                <a class="breadcrumb">Payment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <div class="CartBlock">
                            <h3 class="h5 mcolor1 mt0 fw-500 promocode">
                                Payment
                                <div>
                                    @if(empty(Session::get('coupan')))
                                    <div>
                                        <input type="text" name="name" id="name" placeholder="Enter Coupon">
                                        <button type="button" id="coupon" class="btn">Coupon Code</button>
                                    </div>
                                    @else
                                    <div>
                                        <button type="button" class="btn green"><i class="fa fa-check"></i> Coupon Applied</button>
                                    </div>
                                    <a href="{{url('coupon-cancel')}}" class="red-text fs12">Click here to remove the applied coupon</a>

                                    @endif


                                </div>
                            </h3>
                            <div class="CartBox">
                                <div class="CartCall Payment">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="Add-Address Added selected">
                                                <div>
                                                    <!-- <h3 class="h5 m0 fw-600">Shipping Address</h3> -->

                                                    @php
                                                    $address_id= Session::get('address_id');
                                                    $add = DB::table('user_address')->where('id',$address_id)->first();
                                                    @endphp

                                                    <span>{{$add->name}} </span>
                                                    <p><span>{!! $add->address !!}</span></p>
                                                    <span><strong>Mobile No.</strong> (+91)-{{$add->phone}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12">
                                            <h3 class="h5 mt0 fw-500">Select Payment Options</h3>
                                            <hr>
                                        </div>

                                        <div class="col s6 offset-l3">

                                            <img src="{{asset('resources/assets/frontend/images/online-payment.svg') }}" class="w50"><br>
                                            <button type="button" onclick="PaymenProcess();" class="btn mb30px pay-btn">Pay Online</button>
                                        </div>

                                        <!-- <div class="col s6">
                                        <img src="images/cod-img.svg" class="w50"><br>
                                        <button class="btn mb30px pay-btn">Cash on Delivery</button>
                                    </div> -->
                                    </div>
                                </div>

                                <div class="CartCall">
                                    <div>

                                        <ul class="track" data-track-steps="3">
                                            <li class="done tooltipped" data-position="bottom" data-tooltip="My Cart">
                                                <span>Cart</span>
                                            </li>
                                            <li class="done tooltipped" data-position="bottom" data-tooltip="Billing Details">
                                                <span>Billing Details</span>
                                            </li>
                                            <li class="done tooltipped" data-position="bottom" data-tooltip="Payment">
                                                <span>Payment</span>
                                            </li>
                                        </ul>
                                        <h4 class="h6">Price Details</h4>
                                        <div class="PriceDetails">
                                            @php
                                            $gst_amount=Session::get('gst_amount');
                                            @endphp
                                            <div><span>Amount</span><span><i class="icofont-rupee"></i> {{$subtotal=floatval(str_replace(",","",Cart::subtotal()))}}</span></div>

                                            @php
                                            $CoupanAmount = 0 ;
                                            $total = $subtotal;
                                            @endphp

                                            @if(!empty(Session::get('coupan')))

                                            <div><span>Coupon Discount ({{Session::get('coupan_percentage')}}%) </span><span class="green-text"><i class="icofont-minus"></i> {{$CoupanAmount = ($subtotal *Session::get('coupan_percentage'))/100}} </span></div>

                                            <hr>

                                            <div><span>Sub Total</span><span><i class="icofont-rupee"></i> {{$total = $subtotal - $CoupanAmount}}</span></div>

                                            @endif




                                            @if($gst_amount)
                                            <div><span>GST</span><span class="green-text"><i class="icofont-plus"></i> {{$gst_amount}}</span></div>
                                            @endif

                                            <div><span class="FreeDel"></span><span></span></div>

                                        </div>
                                        <div class="PriceTotal">
                                            <div><span>Order Total</span><span><i class="icofont-rupee"></i> {{$total+$gst_amount}}</span></div>
                                        </div>

                                        <!-- <a href="{{ url('shipping-details') }}" class="btn btn-main">Place Order</a> -->




                                        <input type="hidden" name="address_id" value="{{Session::get('address_id')}}">
                                        <input type="hidden" name="subtotal" value="{{$subtotal}}">
                                        <input type="hidden" name="discount" value="0">
                                        <input type="hidden" name="igst" value="{{$gst_amount}}">
                                        <input type="hidden" name="counpon" value="{{$CoupanAmount}}">
                                        <input type="hidden" name="total" value="{{$total+$gst_amount}}">

                                        <!-- <button type="button" onclick="PaymenProcess()" class="btn btn-main">Pay Online</button> -->

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



    <form action="#" id="payment_form" method="post">
        @csrf
        <input type="hidden" id="udf5" name="udf5" value="" />
        <input type="hidden" id="surl" name="surl" value="" />
        <input type="hidden" id="key" name="key" placeholder="Merchant Key" value="HymH2saI" />
        <input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="YRucf3Dt0E" />
        <input type="hidden" id="txnid" name="txnid" id="txnid" placeholder="Transaction ID" value="" />
        <input type="hidden" id="amount" name="amount" placeholder="Amount" value="" />
        <input type="hidden" id="pinfo" name="pinfo" placeholder="Product Info" value="" />
        <input type="hidden" id="fname" name="fname" placeholder="First Name" value="" />
        <input type="hidden" id="email" name="email" placeholder="Email ID" value="" />
        <input type="hidden" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="" />
        <input type="hidden" id="hash" name="hash" placeholder="Hash" value="" />
        <input type="submit" style="display: none;" value="Pay" onclick="launchBOLT();" />
    </form>

    <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt- color="e34524" bolt-logo="http://samwebstudio.co.in/expertbells/beta/resources/assets/frontend/images/logo.png"></script>



    <script>
        $("#coupon").click(function() {
            var URL = "{{url('/coupon-check')}}";
            var name = $('#name').val();
            $.get(URL, {
                name: name
            }, function(response) {
                var Ret = response.split('^');
                if (Ret[1] == 0) {
                    toastr.error('Oops! coupon does`t match.');
                } else {
                    window.location.reload();
                }
            });
        });




        function PaymenProcess() {
            var AddressId = $('input[name=address_id]').val();
            var Total = $('input[name=total]').val();
            var Discount = $('input[name=discount]').val();
            var Gst = $('input[name=igst]').val();
            var Counpon = $('input[name=counpon]').val();
            var Subtotal = $('input[name=subtotal]').val();

            var URL = "{{url('payment-success')}}";

            $.get(URL, {
                address_id: AddressId,
                total: Total,
                discount: Discount,
                igst: Gst,
                counpon: Counpon,
                subtotal: Subtotal

            }, function(data) {

                var Ret = data.split('^');

                $('#amount').val(Ret[2]);
                $('#pinfo').val(Ret[3]);
                $('#fname').val(Ret[4]);
                $('#mobile').val(Ret[5]);
                $('#email').val(Ret[6]);
                $('#surl').val(Ret[7]);

                $('#txnid').val(Ret[8]);

                $('#orderId').val(Ret[1]);

                GenerateHash();

                setTimeout(function() {

                    launchBOLT();



                }, 1000);

            });


        }




        function GenerateHash() {
            $.ajax({
                url: "{{url('generate-hash')}}",
                type: 'get',
                data: {
                    key: $('#key').val(),
                    salt: $('#salt').val(),
                    txnid: $('#txnid').val(),
                    amount: $('#amount').val(),
                    pinfo: $('#pinfo').val(),
                    fname: $('#fname').val(),
                    email: $('#email').val(),
                    mobile: $('#mobile').val(),
                    udf5: $('#udf5').val()
                },

                success: function(json) {


                    $('#hash').val(json);

                }
            });
        }


        function launchBOLT() {


            bolt.launch({
                key: $('#key').val(),
                txnid: $('#txnid').val(),
                hash: $('#hash').val(),
                amount: $('#amount').val(),
                firstname: $('#fname').val(),
                email: $('#email').val(),
                phone: $('#mobile').val(),
                productinfo: $('#pinfo').val(),
                udf5: $('#udf5').val(),
                surl: $('#surl').val(),
                furl: $('#surl').val(),
                mode: 'dropout'
            }, {
                responseHandler: function(BOLT) {
                    console.log(BOLT.response.txnStatus);

                    if (BOLT.response.txnStatus != 'CANCEL') {

                        //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
                        var fr = '<form action=\"' + $('#surl').val() + '\" method=\"get\">' +
                            '<input type=hidden name=_token value={{csrf_token()}}>' +
                            '<input type=\"hidden\" name=\"key\" value=\"' + BOLT.response.key + '\" />' +
                            '<input type=\"hidden\" name=\"salt\" value=\"' + $('#salt').val() + '\" />' +
                            '<input type=\"hidden\" name=\"txnid\" value=\"' + BOLT.response.txnid + '\" />' +
                            '<input type=\"hidden\" name=\"amount\" value=\"' + BOLT.response.amount + '\" />' +
                            '<input type=\"hidden\" name=\"productinfo\" value=\"' + BOLT.response.productinfo + '\" />' +
                            '<input type=\"hidden\" name=\"firstname\" value=\"' + BOLT.response.firstname + '\" />' +
                            '<input type=\"hidden\" name=\"email\" value=\"' + BOLT.response.email + '\" />' +
                            '<input type=\"hidden\" name=\"udf5\" value=\"' + BOLT.response.udf5 + '\" />' +
                            '<input type=\"hidden\" name=\"mihpayid\" value=\"' + BOLT.response.mihpayid + '\" />' +
                            '<input type=\"hidden\" name=\"status\" value=\"' + BOLT.response.status + '\" />' +
                            '<input type=\"hidden\" name=\"hash\" value=\"' + BOLT.response.hash + '\" />' +
                            '</form>';
                        var form = jQuery(fr);
                        jQuery('body').append(form);
                        form.submit();
                    }
                },
                catchException: function(BOLT) {
                    alert(BOLT.message);
                }
            });
        }
    </script>