<?php
ob_start();
$active = '';
?>
@include('inc.html')

<head>
    <title>Thankyou : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/frontend/css/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/frontend/css/my-account.css')}}" media="screen,projection">
    @include('inc.header')
    <section class="inner-banner about">
        <div class="parallax-container">
            <div class="section">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <a href="{{url('/')}}" class="breadcrumb">Home</a>
                                <a href="" class="breadcrumb">Thankyou</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="https://www.varistor.in/wp-content/uploads/2019/04/Thankyou-Banner.png" style="width: 100px!important;" alt="Thankyou"></div>
        </div>
    </section>

    <section class="Home grey lighten-4">
        <div class="container">
            <div class="row">
                <div class="col s12 center">
                    <h3 class="h2 Heading">{{$message}}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                      <p>Thankyou for your purchasing.<br>If you have any question.please contact us.</p>  
                </div>
            </div>
            @php
                $order = DB::table('order')->join('order_status', 'order_status.order_status_id','order.order_status_id')->where('order.transaction_id',$transaction_id)->first();
                $order_detail = DB::table('order_details')->where('order_id',$order->id)->get();
                $number_of_products = count($order_detail);
            @endphp
            <div class="RightBlock">
                        <div class="row">
                            <div class="col s12">
                                <div class="SecTop">
                                    <div class="ProSce">
                                        <div class="mbg1 p10px">
                                            <div class="row">
                                                <div class="col s6">
                                                    <p class="m0 white-text"><strong>Order ID:</strong>{{$order->transaction_id}}</p>
                                                </div>
                                                <div class="col s6 right-align">
                                                    <p class="m0 white-text fw-600">Dated : {{date('d-m-Y', strtotime($order->date))}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ListBlock">
                                            <div class="row">
                                                <div class="col s12 m7">
                                                    <h4 class="h6 fw-600 mcolor">Shipping Address</h4>
                                                    <p class="fs14"><strong>{{$order->name}}</strong><br>
                                                        {{$order->address}},<br>
                                                        Contact No:- {{$order->phone}},<br>
                                                        Email id:- {{$order->email}}
                                                    </p>
                                                </div>
                                                <div class="col s12 m5">
                                                    <h4 class="h6 fw-600 mcolor">Order Summary</h4>
                                                    <div class="row">
                                                        <div class="col s6">
                                                            <p class="m0 fs14 black-text">Order Status</p>
                                                        </div>
                                                        <div class="col s6 right-align">
                                                            <p class="m0 fs14 black-text">{{$order->status_name}}</p>
                                                        </div>
                                                        <div class="col s6">
                                                            <p class="m0 fs14 black-text">Payment Status</p>
                                                        </div>
                                                        <div class="col s6 right-align">
                                                            @if($order->payment_status==0)
                                                            <p class="m0 fs14 black-text">Pending</p>
                                                            @endif
                                                            @if($order->payment_status==1)
                                                            <p class="m0 fs14 black-text">Confirmed</p>
                                                            @endif
                                                            @if($order->payment_status==2)
                                                            <p class="m0 fs14 black-text">Failed</p>
                                                            @endif
                                                            @if($order->payment_status==3)
                                                            <p class="m0 fs14 black-text">Returned</p>
                                                            @endif
                                                        </div>
                                                        <div class="col s6">
                                                            <p class="m0 fs14 black-text">Payment Mode</p>
                                                        </div>
                                                        <div class="col s6 right-align">
                                                            <p class="m0 fs14 black-text">Online</p>
                                                        </div>
                                                        <div class="col s6">
                                                            <p class="m0 fs14">Price ({{$number_of_products}} items)</p>
                                                        </div>
                                                        <div class="col s6 right-align">
                                                            <p class="m0 fs14"><span class="price">{{$order->currency}} {{$order->subtotal}}</span></p>
                                                        </div>
                                                        <div class="col s6">
                                                            <p class="m0 fs14">GST</p>
                                                        </div>
                                                        <div class="col s6 right-align">
                                                            <p class="m0 fs14"><span class="price">{{$order->currency}} {{$order->igst}}</span></p>
                                                        </div>
                                                        <div class="col s6">
                                                            <p class="m0 black-text fs16 fw-600">Total Amount</p>
                                                        </div>
                                                        <div class="col s6 right-align">
                                                            <p class="m0 black-text fs16 fw-600">{{$order->currency}} {{$order->total}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ListBlock">
                                            <div class="row">
                                                <div class="col s12">
                                                    <ul class="track mt0" data-track-steps="2">
                                                        @if($order->status_name=='Purchased')
                                                        <li class="done "><span>Purchased<br>{{date('d-m-Y H:i A', strtotime($order->date))}}</span></li>
                                                        <!-- <li class="done tooltipped" data-position="bottom" data-tooltip="Shipped<br>Aug 21, 2020, 4:29 AM"><span>Shipped<br>Aug 21, 2020, 4:29 AM</span></li>
                                                        <li class="done tooltipped" data-position="bottom" data-tooltip="Dispatched<br>Aug 22, 2020, 6:34 PM"><span>Dispatched<br>Aug 22, 2020, 4:34 PM</span></li> -->
                                                        <li class=""><span>Fullfilled<br>{{date('d-m-Y H:i A', strtotime($order->date))}}</span></li>
                                                        @endif
                                                        @if($order->status_name=='Fullfilled')
                                                        <li class="done "><span>Purchased<br>{{date('d-m-Y H:i A', strtotime($order->date))}}</span></li>
                                                        <li class="done " ><span>Fullfilled<br>{{date('d-m-Y H:i A', strtotime($order->updated_at))}}</span></li>
                                                        @endif
                                                        @if($order->status_name=='Cancelled')
                                                        <li class="done "><span>Purchased<br>{{date('d-m-Y H:i A', strtotime($order->date))}}</span></li>
                                                        <li class="done " ><span>Cancelled<br>{{date('d-m-Y H:i A', strtotime($order->cancel_date))}}</span></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ListBlock Acc-ProBlock">
                                            <div class="row">
                                                @foreach($order_detail as $i)
                                                <div class="col s4 m2">
                                                    <div class="FProImg"><a href="#"><img src="{{asset('resources/assets/frontend/images/logo.png')}}" style="object-fit:contain;" alt="{{Helper::ProjectName()}}"></a></div>
                                                </div>
                                                <div class="col s8 m6 l7">

                                                    <div class="FProText">
                                                        <h4 class="h6 m0"><a href="#">{{$i->title}}</a></h4>
                                                        <span class="price">{{$i->currency}} {{$i->amount}}/-</span>
                                                        <!-- <span class="odate"><strong>Order Date:</strong> 22 jan, 2021</span> -->
                                                    </div>

                                                </div>
                                                @endforeach
                                                <div class="col s12 m4 l3 right-align">
                                                    <!-- <p class="mb0 fs12 grey-text fw-400 mr10px">Your item has been delivered</p> -->
                                                   
                                                    @if($order->status_name=='Purchased' || $order->status_name=='Fullfilled')
                                                    <!--<a href="#" class="btn btn-main">Download Invoice</a>-->
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </section>



    @include('inc.footer')
   