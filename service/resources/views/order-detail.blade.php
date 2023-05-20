<?php
ob_start();
$active = 'Orders';
?>
@include('inc.html')

<head>
    <title>My Orders : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
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
                                <a href="#" class="breadcrumb">My Account</a>
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
                                                        <li class="done " ><span>Purchased<br>{{date('d-m-Y H:i A', strtotime($order->date))}}</span></li>
                                                        <!-- <li class="done tooltipped" data-position="bottom" data-tooltip="Shipped<br>Aug 21, 2020, 4:29 AM"><span>Shipped<br>Aug 21, 2020, 4:29 AM</span></li>
                                                        <li class="done tooltipped" data-position="bottom" data-tooltip="Dispatched<br>Aug 22, 2020, 6:34 PM"><span>Dispatched<br>Aug 22, 2020, 4:34 PM</span></li> -->
                                                        <li class="" ><span>Fullfilled<br>{{date('d-m-Y H:i A', strtotime($order->date))}}</span></li>
                                                        @endif
                                                        @if($order->status_name=='Fullfilled')
                                                        <li class="done " ><span>Purchased<br>{{date('d-m-Y H:i A', strtotime($order->date))}}</span></li>
                                                        <li class="done "><span>Fullfilled<br>{{date('d-m-Y H:i A', strtotime($order->updated_at))}}</span></li>
                                                        @endif
                                                        @if($order->status_name=='Cancelled')
                                                        <li class="done " ><span>Purchased<br>{{date('d-m-Y H:i A', strtotime($order->date))}}</span></li>
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
                                                    @if($order->status_name=='Purchased')
                                                    <a href="{{url('/order-cancel/'.$order->id)}}" class="btn btn-main1">Cancel Order</a>
                                                    @endif
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
            </div>
        </div>
    </section>
    @include('inc.footer')