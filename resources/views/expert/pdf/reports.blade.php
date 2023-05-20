<html>
<head>
<title>Reports : Expert Bells</title>
<style>body{font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif !important;font-size:12px;padding:0;margin:0;line-height:120%;color:#444;}
@page{padding:0;margin:0}
.text-primary{color:#0d6efd!important;}
.text-primary .dot{background:#0d6efd!important}
.text-secondary{color:#6c757d!important;}
.text-secondary .dot{background:#6c757d!important}
.text-success{color:#198754!important;}
.text-success .dot{background:#198754!important}
.text-info{color:#0dcaf0!important;}
.text-info .dot{background:#0dcaf0!important}
.text-warning{color:#ffc107!important;}
.text-warning .dot{background:#ffc107!important}
.text-danger{color:#dc3545!important;}
.text-danger .dot{background:#dc3545!important}
.logo,.flogo{padding:1rem 2rem;background:#eee;text-align:center}
.flogo{padding:.5rem 2rem}
.logo img{width:160px;height:30px}
section{padding:2rem}
.ProTable{width:150px;}
.ProTable .img{width:30px;height:30px;border-radius:50%;overflow:hidden;display:inline-block;float:left}
.ProTable .img img{height:100%;width:100%;object-fit:cover}
.ProTable>div:last-child{width:115px;display:inline-block;float:right;}
.ProTable h3{font-size:11px;font-weight:600!important;margin:0 0 4px;padding:0;color:#000}
.ProTable p{font-size:9px!important;margin:0;padding:0;line-height:normal!important;color:#888!important;white-space:normal}
.DataTable{font-size:12px;border:1px solid #eee;}
table.DataTable{margin:0!important;width:100%}
.DataTable td,.DataTable th{padding:.5rem!important;vertical-align:middle;border-bottom:1px solid #eee;border-right:1px solid #eee;}
.DataTable>thead>tr>th{background:#0c233b;color:#fff;padding:9px!important;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif !important}
/*.DataTable>thead>tr>th:not(.sorting_disabled),.DataTable>thead>tr>td:not(.sorting_disabled){padding-right:25px!important}*/
.DataTable>thead>tr>th:first-child{padding-right:1rem!important}
.DataTable>thead>tr>th:first-child:after,.DataTable>thead>tr>th:first-child:before{display:none}
/*.DataTable>thead .sorting:before,.DataTable>thead .sorting:after{bottom:.7em!important}*/
.DataTable thead{background:var(--thm);color:var(--white)}
.DataTable thead th{font-weight:500!important}
/*.DataTable tbody tr{counter-increment:slides-num}*/
/*.DataTable tbody tr td:first-child:after,.DataTable tbody tr th:first-child:after{content:" "counter(slides-num)"."}*/
.DataTable tbody tr>td small{font-size:8.9px}
.DataTable tbody tr>td b{color:#000}
.DataTable tbody tr>td strong.h6{font-size:11px}
.dot{height:5px;width:5px;border-radius:50%;display:inline-block;}
.text-center{text-align:center;}
.text-end{text-align:right;}
</style>
</head>
<body>
<div class="logo">
    <img src="https://www.expertbells.com/frontend/img/logo.png" height="51" width="272" style="float:left;">
    <span style="float:right;line-height:150%;" class="text-end"><strong>Download Reports</strong><br><small class="text-secondary">{{ date('Y-m-d H:i:s') }}</small></span><div style="clear:both;"></div>
</div><div style="clear:both;"></div>
<section>
    <div style="font-size:18px;font-weight:bold;margin-bottom:15px;color:#000;" class="text-center">Transactions</div>
    <table class="DataTable" cellpadding="0" border="1" cellspacing="0">
        <thead>
            <tr>
                <!-- <th>#</th> -->
                <th width="23%">User Detail</th>
                <th width="19%">Booking</th>
                <th width="15%">Status</th>
                <th width="11%">Total</th>
                <th width="21%">Deduct</th>
                <th width="11%">Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $item)
                <tr>
                    <!-- <td></td> -->
                    <td>
                        <div class="ProTable">
                            <div class="img">
                                <x-image-box>
                                    <x-slot:image>{{$item->user->profile ?? ''}}</x-slot:image>
                                    <x-slot:path>/uploads/user/</x-slot:path>
                                    <x-slot:alt>{{expertinfo()->name ?? ''}}</x-slot:alt>
                                    <x-slot:width>380</x-slot:width>
                                    <x-slot:height>480</x-slot:height>
                                </x-image-box>
                            </div>
                            <div>
                                <h3>{{ $item->user_name ?? ($item->user->name ?? '') }}</h3>
                                <p>{{ $item->user_number ?? ($item->user->ccode . $item->user->mobile ?? '') }}</p>
                            </div>
                        </div><div style="clear:both;"></div>
                    </td>
                    <td>
                        <small style="display:block;"><b>Booking:</b> #{{ $item->booking_id }}</small>
                        <small style="display:block;"><b>Date:</b> {{ dateformat($item->booking_date) }}</small>
                        <small style="display:block;"><b>Time:</b> {{ timeformat($item->booking_start_time) }} To {{ date('H:i A', strtotime($item->booking_end_time)) }}</small>
                    </td>
                    <td class="text-center">
                        @if($item->payment==0)<small class="text-secondary"><span class="dot"></span> Incomplete Process</small> @endif
                        @if($item->payment==1)<small class="text-success"><span class="dot"></span> Paid</small>@endif
                        @if($item->payment==2)<small class="text-danger"><span class="dot"></span> Failed</small>@endif
                        @if($item->payment==3)<small class="text-primary"><span class="dot"></span> Wallet</small>@endif
                    </td>
                    <td class="text-end"><strong class="h6 text-success">Rs. {{ $item->paid_amount }}/-</strong></td>
                    @if ($item->transfer_amount > 0)
                        <td class="text-end">
                            @if($item->service_charges > 0) <small style="display:block;"><b>Service Charges ({{$item->service_charges_percentage}}%):</b> Rs. {{$item->service_charges}}</small>@endif
                            @if($item->gst > 0) <small style="display:block;"><b>GST ({{$item->gst}}%):</b> Rs. {{$item->gst_amount}}</small>@endif
                            @if($item->tds > 0) <small style="display:block;"><b>TDS ({{$item->tds}}%):</b> Rs. {{$item->tds_amount}}</small> @endif
                        </td>
                        <td class="text-end"><strong class="h6 text-success">Rs. {{ $item->transfer_amount ?? 0 }}/-</strong></td>
                    @else
                        <td class="text-center" colspan="2"><small>Transfer soon...</small></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $histories->links() }}
    <div class="row" style="display:none;">
        <div class="col-md-6">
            <div class="card UserBox Boxs mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="h6">Scheduled Calls</h3>
                        </div>
                        <div class="col-3 text-right">
                            <select style="height: 35px;" onchange="generatescheduledchart()"
                                name="scheduledyear" id="scheduledyear" class="form-control">
                                @for ($i = date('Y'); $i >= 2022; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="ScheduledChatBox">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card UserBox Boxs mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="h6">Close Scheduled</h3>
                        </div>
                        <div class="col-3 text-right">
                            <select style="height: 35px;" onchange="generateclosescheduledchart()"
                                name="closescheduledyear" id="closescheduledyear"
                                class="form-control">
                                @for ($i = date('Y'); $i >= 2022; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="CloseScheduledChatBox">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card UserBox Boxs mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="h6">Rescheduled Calls</h3>
                        </div>
                        <div class="col-3 text-right">
                            <select style="height: 35px;" onchange="generaterescheduledchart()"
                                name="rescheduledyear" id="rescheduledyear" class="form-control">
                                @for ($i = date('Y'); $i >= 2022; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="ReScheduledChatBox">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card UserBox Boxs mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 text-right">
                            <select style="height: 35px;" onchange="generatepiechart()"
                                name="pieyear" id="pieyear" class="form-control">
                                @for ($i = date('Y'); $i >= 2022; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="PieChatBox">
                        <canvas id="mypie" style="max-width:243px;margin:0 auto"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card UserBox Boxs">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="h6 m-0">All Report Section</h3>
                        </div>
                        <div class="col-3 text-right">
                            <select style="height: 35px;" onchange="generatematerialchart()"
                                name="materialyear" id="materialyear" class="form-control">
                                @for ($i = date('Y'); $i >= 2022; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="MaterialChatBox">
                        <div id="multi" class="w-100" style="height:400px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="text-center flogo" style="margin-top:9px;">
    <p class="text-center">© Copyright {{ date('Y') }} <strong>Expert Bells</strong> All Rights Reserved.</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    const generatepiecharturl = @json(route('expert.generatepiechart'));
    const scheduledcharturl = @json(route('expert.scheduledchart'));
    const closescheduledcharturl = @json(route('expert.closescheduledchart'));
    const rescheduledcharturl = @json(route('expert.rescheduledchart'));
    const generatematerialcharturl = @json(route('expert.generatematerialchart'));
    generatescheduledchart();
    generateclosescheduledchart();
    generaterescheduledchart();
    generatepiechart();
    generatematerialchart();
</script>
</body>
</html>