@include('control-panel.inc.header')
<style>
    .dropdown-menu.statustab {
        background: #6f3377 !important;
    }
</style>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('control-panel.inc.side-menu')
            <div class="right_col" role="main">
                <div class="row">
                    @if(session()->has('success_msg')) <?php echo Helper::SuccessAlert(session()->get('success_msg')); ?> @endif
                    @if(session()->has('error_msg')) <?php echo Helper::ErrorAlert(session()->get('error_msg')); ?> @endif
                </div>
                <div class="row">
                    <!--------------------table data start-------------------------->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Order Detail </h2>
                                <div class="dropdown pull-right">
                                    <button class="btn btn-primary dropdown-toggle btn-md" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Change Order Status
                                    </button>
                                    <ul class="dropdown-menu statustab" aria-labelledby="dropdownMenuButton">
                                        @foreach($order_status as $i)
                                        <li><a class="dropdown-item" href="{{url('/control-panel/order-status-change/'.$i->order_status_id.'/'.$data->id)}}">{{$i->status_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="dropdown pull-right">
                                    <button class="btn btn-primary dropdown-toggle btn-md" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Change Payment Status
                                    </button>
                                    <ul class="dropdown-menu statustab" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="{{url('/control-panel/payment-status-change/0/'.$data->id)}}">Pending</a></li>
                                        <li><a class="dropdown-item" href="{{url('/control-panel/payment-status-change/1/'.$data->id)}}">Confirmed</a></li>
                                        <li><a class="dropdown-item" href="{{url('/control-panel/payment-status-change/2/'.$data->id)}}">Failed</a></li>
                                        <li><a class="dropdown-item" href="{{url('/control-panel/payment-status-change/3/'.$data->id)}}">Returned</a></li>
                                    </ul>
                                </div>
                                <a href="{{url('control-panel/order-management')}}" class="btn btn-danger pull-right btn-md"><i class="fa fa-arrow-left"></i> Back</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <center>
                                    <h4><strong><u>ORDER DETAIL</u></strong></h4>
                                </center>
                                <table class="table">
                                    <tr>
                                        <th>Order Date : </th>
                                        <td>{{date("d F,Y",strtotime($data->date))}}</td>
                                        <th>Order Id :</th>
                                        <td>EXP{{date('Ym').$data->id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Amount : </th>
                                        <td>{{$data->currency}} {{$data->subtotal}}</td>
                                        <th>Order Discount :</th>
                                        <td>{{$data->currency}} {{$data->coupon}}</td>
                                    </tr>
                                    <tr>
                                        <th>GST Amount : </th>
                                        <td>{{$data->currency}} {{$data->igst}}</td>
                                        <th>Total Amount :</th>
                                        <td><strong>{{$data->currency}} {{$data->total}}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Transaction Id : </th>
                                        <td>{{$data->transaction_id}}</td>
                                        <th>Payment Status :</th>
                                        <td>
                                            @if($data->payment_status==0)
                                            <a href="javascript:void(0)" class="btn btn-warning btn-xs">Payment Pending</a>
                                            @endif
                                            @if($data->payment_status==1)
                                            <a href="javascript:void(0)" class="btn btn-success btn-xs">Payment Confirmed</a>
                                            @endif
                                            @if($data->payment_status==2)
                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs">Payment Failed</a>
                                            @endif
                                            @if($data->payment_status==3)
                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs">Payment Returned</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-primary btn-xs">{{$data->status_name}}</a>
                                        </td>
                                    </tr>
                                </table>
                                <br><br>
                                <center>
                                    <h4><strong><u>USER DETAIL</u></strong></h4>
                                </center>
                                <table class="table">
                                    <tr>
                                        <th>User Name : </th>
                                        <td>{{$data->name}}</td>
                                        <th>User Mobile :</th>
                                        <td>{{$data->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>User Email : </th>
                                        <td>{{$data->email}}</td>
                                        <th>Business Name :</th>
                                        <td>{{$data->business}}</td>
                                    </tr>
                                    <tr>
                                        <th>GST No : </th>
                                        <td>{{$data->gst}}</td>
                                        <th>City :</th>
                                        <td>{{$data->city}}</td>
                                    </tr>
                                    <tr>
                                        <th>State : </th>
                                        <td>{{$data->state}}</td>
                                        <th>Address :</th>
                                        <td>{{$data->address}}</td>
                                    </tr>
                                </table>
                                <br><br>
                                <center>
                                    <h4><strong><u>SERVICE DETAIL</u></strong></h4>
                                </center>
                                <table class="table">
                                    <tr>
                                        <th>Title </th>
                                        <th>Currency</th>
                                        <td>Amount</td>
                                    </tr>
                                    @if(count($details)>0)
                                    @foreach($details as $Rows)
                                    <tr>
                                        <td>{{$Rows->servicetitle}} ({{$Rows->title}})</td>
                                        <td>{{$Rows->currency}}</td>
                                        <td>{{$Rows->amount}}/- (excluding GST)</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer> @include('control-panel.inc.footer') </footer>
</body>

<script>
    function getTypeData(data) {

        if (data == 'youtube')

        {

            $('#videobox').show();

            $('#imagebox').hide();

        } else

        {

            $('#imagebox').show();

            $('#videobox').hide();

        }

    }

    function getImage(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();



            reader.onload = function(e) {

                $('#blash').attr('src', e.target.result);

            }



            reader.readAsDataURL(input.files[0]);

        }
    }
</script>