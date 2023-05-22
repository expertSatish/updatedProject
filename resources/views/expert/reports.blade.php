@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Reports</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-expert.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="pb-2 mb-3 border-bottom d-flex justify-content-between">
                        <h3 class="m-0 h4">Reports</h3>
                        <a href="{{route('expert.reportpdf')}}" class="btn btn-thm4 m-0"><i class="fal fa-file-pdf me-2"></i>PDF</a>
                    </div>
                    <form action="" method="post" class="card UserBox mb-4">
                        <h3 class="h5 border-bottom pb-3">Transactions</h3>
                        <div class="card-body d-block">
                            <div class="table-responsive w-100 mt-2 mb-1">
                                <table class="DataTable table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Detail</th>
                                            <th>Booking</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Deduction</th>
                                            <th class="text-center">Paid To Me</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($histories as $item)
                                        <tr>
                                            <td></td>
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
                                                    <div class="">
                                                        <h3>{{$item->user_name ?? $item->user->name ?? ''}}</h3>
                                                        <p>{{$item->user_number ?? $item->user->ccode.$item->user->mobile ?? ''}}</p>
                                                    </div>
                                                </div>
</td>
                                            <td>
                                                <small><b>Booking:</b> #{{$item->booking_id}}</small><br>
                                                <small><b>Date:</b> {{dateformat($item->booking_date)}}</small><br>
                                                <small><b>Time:</b> {{timeformat($item->booking_start_time)}} To {{date('H:i A',strtotime($item->booking_end_time))}}</small>
                                            </td>
                                            <td class="text-center">
                                                @if($item->payment==0)<small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Incomplete Process</small> @endif
                                                @if($item->payment==1)<small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid By Online</small>@endif
                                                @if($item->payment==2)<small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Payment Failed</small>@endif
                                                @if($item->payment==3)<small class="text-primary"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid By Wallet</small>@endif
                                            </td>
                                            <td class="text-end">
                                                <strong class="text-success"><i class="Ricon">&#8377;</i> {{$item->booking_amount}}/-</strong>
                                            </td>
                                            @if($item->transfer_amount > 0)
                                            <td class="text-end">
                                                @if($item->service_charges > 0) <small><b>Service Charges ({{$item->service_charges_percentage}}%):</b> <i class="Ricon">&#8377;</i> {{$item->service_charges}}</small><br> @endif
                                                @if($item->tds > 0) <small><b>TDS ({{$item->tds}}%):</b> <i class="Ricon">&#8377;</i> {{$item->tds_amount}}</small> @endif
                                            </td>
                                            <td class="text-end"><strong class="text-success"><i class="Ricon">&#8377;</i> {{$item->transfer_amount ?? 0}}/-</strong></td>
                                            @else
                                            <td class="text-center"> ----- </td>
                                            <td class="text-center">
                                                <small>Transfer soon...</small>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach                                        
                                    </tbody>
                                </table>
                            </div>
                            {{$histories->links()}}
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card UserBox Boxs mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <h3 class="h6">Scheduled Calls</h3>                                            
                                        </div>
                                        <div class="col-3 text-right">
                                            <select style="height: 35px;" onchange="generatescheduledchart()" name="scheduledyear" id="scheduledyear" class="form-control">
                                                @for ($i = date('Y'); $i >= 2022; $i--)
                                                    <option value="{{$i}}">{{$i}}</option>
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
                                            <select style="height: 35px;" onchange="generateclosescheduledchart()" name="closescheduledyear" id="closescheduledyear" class="form-control">
                                                @for ($i = date('Y'); $i >= 2022; $i--)
                                                    <option value="{{$i}}">{{$i}}</option>
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
                                            <select style="height: 35px;" onchange="generaterescheduledchart()" name="rescheduledyear" id="rescheduledyear" class="form-control">
                                                @for ($i = date('Y'); $i >= 2022; $i--)
                                                    <option value="{{$i}}">{{$i}}</option>
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
                                            <select style="height: 35px;" onchange="generatepiechart()" name="pieyear" id="pieyear" class="form-control">
                                                @for ($i = date('Y'); $i >= 2022; $i--)
                                                    <option value="{{$i}}">{{$i}}</option>
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
                                            <select style="height: 35px;" onchange="generatematerialchart()" name="materialyear" id="materialyear" class="form-control">
                                                @for ($i = date('Y'); $i >= 2022; $i--)
                                                    <option value="{{$i}}">{{$i}}</option>
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
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Reports : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<link rel="preload" as="style" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" onload="this.rel='stylesheet'" integrity="sha512-160haaGB7fVnCfk/LJAEsACLe6gMQMNCM3Le1vF867rwJa2hcIOgx34Q1ah10RWeLVzpVFokcSmcint/lFUZlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">.TopBoxs{min-height:150px!important}
.TopBoxs>div{display:grid;place-content:center;text-align:center}
.TopBoxs>div h3{line-height:100%!important}
.Boxs>div{display:block;overflow:hidden}
.Boxs.p-0{padding:0!important}
.Boxs>div p{line-height:120%!important}

.DataTable{font-size:15px}
table.dataTable{margin:0!important}
.dataTables_wrapper>.row:first-child{margin-bottom:9px!important}
.DataTable>:not(caption)>*>*{padding:.6rem 1rem!important;vertical-align:middle}
.DataTable>thead>tr>th:not(.sorting_disabled),.DataTable>thead>tr>td:not(.sorting_disabled){padding-right:25px!important}
.DataTable>thead>tr>th:first-child{padding-right:1rem!important}
.DataTable>thead>tr>th:first-child:after,.DataTable>thead>tr>th:first-child:before{display:none}
.DataTable>thead .sorting:before,.DataTable>thead .sorting:after{bottom:.7em!important}
.DataTable thead{background:var(--thm);color:var(--white)}
.DataTable thead th{font-weight:500!important}
.DataTable thead .form-check-input[type=checkbox]:after{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 9l4 4l11-12'/%3e%3c/svg%3e")}
.DataTable thead .form-check{align-items:center}
.DataTable .form-check input{margin:0!important}
.DataTable tbody tr{counter-increment:slides-num}
.DataTable tbody tr td:first-child:after,.DataTable tbody tr th:first-child:after{content:" "counter(slides-num)"."}
.DataTable tbody tr>td small{font-size:11px}
.DataTable tbody tr>td strong.h6{font-size:18px}

.badge{font-weight:400!important;font-size:12px!important;line-height:14px!important;border-radius:15px!important}
.btni{height:32px;min-width:32px;padding:0 12px!important; margin:0 0 5px;display:inline-flex!important;justify-content:center;align-items:center;border-radius:20px!important;background:none!important;border-color:transparent!important;color:rgb(var(--blackrgb)/.7)!important}
.btni:hover,.btni.btn-success{border-color:var(--bs-btn-border-color)!important;background:var(--bs-btn-bg)!important;color:var(--bs-btn-color)!important}
.btni i{font-size:18px}
.btni span{font-weight:300;font-size:13px}
.btni.disable{opacity:.6;cursor:no-drop}
.btni.disable.btn-success{border-color:#6c757d!important;background-color:#6c757d!important}
.ProTable{display:flex;justify-content:space-between;width:170px;}
.ProTable .img{min-width:45px;height:45px;border-radius:50%;overflow:hidden}
.ProTable .img img{height:100%;width:100%;object-fit:cover}
.ProTable>div:last-child{width:calc(100% - 60px)}
.ProTable h3{font-size:14px;display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:2;margin-bottom:3px;line-height:150%!important;font-weight:600!important}
.ProTable p{font-size:13px!important;margin:0;line-height:normal!important;color:rgb(var(--blackrgb)/.6)!important;white-space:normal}
.star{margin:0!important;font-size:16px!important}
.TimeBox{margin-top:20px;display:flex;flex-wrap:wrap}
.TimeBox .btn{border-radius:5px;margin-bottom:8px;margin-right:8px;font-weight:500;min-width:35px;padding:5px;color:var(--thm3);background:rgb(var(--thmrgb)/.15)}
.TimeBox>li>:checked[type=radio]+.btn,.TimeBox>li>:checked[type=checkbox]+.btn{background:var(--thm3);color:var(--white);border-color:var(--thm3)}
.btn-check:disabled+.btn,.btn-check[disabled]+.btn{opacity:.5!important}
.btn-back{border:none;border-radius:4px;background:rgb(var(--thmrgb)/.1);padding:3px 9px;font-size:14px}
.modal-dialog.modal-sm{max-width:355px}
@media (max-width:767px){.btni span{display:none}
.UserBox{padding:0!important}
.table-responsive table{white-space:nowrap}
.dataTables_wrapper>.row:first-child>div:first-child{display:none}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div{overflow:auto}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-webkit-scrollbar{width:3px;height:3px;background-color:rgb(var(--blackrgb)/0)}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-webkit-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-moz-scrollbar{width:3px;height:3px;background-color:rgb(var(--blackrgb)/0)}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-moz-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-o-scrollbar{width:3px;height:3px;background-color:rgb(var(--blackrgb)/0)}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-o-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}}
</style>
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script defer type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.11.4/dataTables.bootstrap5.min.js" integrity="sha512-nfoMMJ2SPcUdaoGdaRVA1XZpBVyDGhKQ/DCedW2k93MTRphPVXgaDoYV1M/AJQLCiw/cl2Nbf9pbISGqIEQRmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$(document).ready(function(){
    if ($(window).width() < 991){
        $("#AccMenuBar").removeClass('d-none');
        $("#AccountMenu").addClass('collapse');
    };    
});
</script>
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
@endpush