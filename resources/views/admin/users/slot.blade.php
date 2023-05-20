@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel br-profile-page">

        <div class="card shadow-base bd-0 rounded-0 widget-4">
            <div class="card-header ht-75">
                <div class="hidden-xs-down">
                    <a href="" class="mg-r-10"><span class="tx-medium">{{count($data->slots)}}</span> Session</a>
                </div>
                <div class="tx-24 hidden-xs-down">
                    <a href="{{ route('admin.users') }}" class="mg-r-10"><small style="font-size: 14px;">BACK</small></a>
                </div>
            </div>
            <div class="card-body">
                <div class="card-profile-img">
                    <x-image-box>
                        <x-slot:image>{{$data->profile}}</x-slot>
                        <x-slot:path>/uploads/user/</x-slot>
                        <x-slot:alt>{{$data->name ?? ''}}</x-slot>
                    </x-image-box>
                </div>
                <h4 class="tx-normal tx-roboto tx-white">{{$data->name}}</h4>
            </div>
        </div>

        <div class="ht-50 bg-gray-100 pd-x-20 d-flex align-items-center justify-content-center shadow-base">
            <ul class="nav nav-outline active-info align-items-center flex-row" role="tablist">
                <li class="nav-item hidden-xs-down"><a class="nav-link" href="{{route('admin.users.information', ['page'=>'info','id' => $data->id])}}">Basic Information</a></li>
                <li class="nav-item"><a class="nav-link active" href="#slot">Booking Slot</a></li>                
            </ul>
        </div>

        <div class="tab-content br-profile-body">
            <div class="tab-pane fade active show" id="slots" aria-expanded="true">
                <div class="row">
                    <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                        <table class="table  table-bordered table-colored table-dark">
                            <thead>
                                <tr>
                                    <th class="wd-5p">#</th>
                                    <th>Booking</th>                                    
                                    <th>Expert</th>                                  
                                    <th>Amount</th>
                                    <th class="wd-15p">Payment</th>
                                    <th class="wd-10p">Status</th>
                                    <th class="wd-5p">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lists as $list)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <small><b>Booking No :</b> #{{$list->booking_id}}</small><br>
                                        <small><b>Booking Date :</b> {{ dateformat($list->booking_date) }}</small><br>
                                        <small><b>Booking Time :</b> {{ substr($list->booking_start_time,0,-3) }} - {{ substr($list->booking_end_time,0,-3) }}</small>
                                        
                                        @if(!empty($list->preassign))
                                            <small class="badge text-start text-success">This booking reassigned. (#{{$list->preassign->booking_id}})</small>
                                        @endif
                                        @if($list->reassign_slot>0)
                                            <small class="badge badge-default text-success"><i class="far fa-check"></i> Reassign (#{{$list->reassign->booking_id}})</small>
                                        @endif

                                        @if($list->reschedule_slot>0)
                                            <small class="badge badge-default text-success"><i class="far fa-check"></i> New reschedule (#{{$list->reschedule->booking_id ?? 0}})</small>
                                        @endif
                                    </td>
                                    <td>
                                        <small><b>Name :</b> {{$list->expert->name ?? ''}} (#{{$list->expert->user_id ?? ''}})</small><br>
                                        <small><b>Email :</b> {{$list->expert->email ?? ''}}</small><br>
                                        <small><b>Contact :</b> {{$list->expert->ccode ?? ''}}{{$list->expert->mobile ?? ''}}</small><br>                                                    
                                    </td>
                                    <td>
                                        <small><b>Amount :</b> {{defaultcurrency()}} {{$list->booking_amount}}</small><br>
                                        @if($list->coupon_discount > 0)
                                        <small><b>Discount :</b> {{defaultcurrency()}} {{$list->coupon_discount ?? 0}}</small><br>
                                        @endif
                                        <small><b>Gst({{$list->gst}}%) :</b> {{defaultcurrency()}} {{$list->gst_amount}}</small><br>
                                        <small><b>Paid Amount :</b> {{defaultcurrency()}} {{$list->paid_amount}}</small>
                                    </td>
                                    <td>
                                        @if($list->payment==0)<small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Incomplete Process</small> @endif
                                        @if($list->payment==1)<small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid</small>@endif
                                        @if($list->payment==2)<small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Failed</small>@endif
                                        @if($list->payment==3)<small class="text-primary"><i class="fad fa-circle" style="font-size: 10px;"></i> Wallet</small>@endif
                                    </td>
                                    <td>
                                        @if(request()->segment(3)!='expired')
                                            @if($list->reschedule_slot==0)
                                                <small class="text-secondary">{{$list->status==0?'New':''}}</small>
                                                <small class="text-primary">{{$list->status==1?'Confirm':''}}</small>
                                                <small class="text-danger">{{$list->status==2?'Reject':''}}</small>
                                                <small class="text-success">{{$list->status==3?'Done & Closed':''}}</small>
                                            @else
                                                <small class="text-danger">Reschedule</small>                                                            
                                            @endif
                                        @else
                                            @if($list->reschedule_slot>0)
                                            <small class="text-danger">Reschedule</small>  
                                            @elseif($list->status==2)
                                            <small class="text-danger">Rejected</small>
                                            @else                                                                           
                                            <small class="text-danger">Expired</small>                                           
                                            @endif
                                        @endif
                                    </td>
                                    <td class="pd-r-0-force tx-center">

                                        <div class="dropdown TAction show">

                                            <a href="#" class="nav-link" data-toggle="dropdown"
                                                aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>

                                            <ul class="dropdown-menu" x-placement="bottom-end">
                                                @if(request()->segment(3)=='rejected' && $list->reassign_slot==0 && date('Y-m-d H:i:s') < date('Y-m-d H:i:s',strtotime('-60 minutes'.$list->booking_date.' '.$list->booking_start_time)))
                                                {{-- <li><a href="#editmodal" data-bs-type="assignexpert" data-bs-toggle="offcanvas"
                                                        data-bs-id="{{ $list->id }}"><i class="fa fa-user-plus"></i> Assign Expert</a></li> --}}
                                                @endif
                                                <li><a href="#editmodal" data-bs-type="information" data-bs-toggle="offcanvas"
                                                    data-bs-id="{{ $list->id }}"><i class="fa fa-book"></i> Information</a></li>

                                                <li><a href="{{ route('admin.schedules.remove', ['id' => $list->id]) }}"
                                                        class="text-danger"
                                                        onclick="return RemoveRecord()"><i
                                                            class="fa fa-trash"></i> Remove</a></li>

                                            </ul>

                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('css')
    <title>User Information : {{ project() }}</title>
    <link href="{{ asset('admin/lib/SpinKit/spinkit.css') }}" rel="stylesheet">
@endpush
@push('js')
<script>
    $('[data-bs-type]').on('click',function(){
        let id = $(this).attr('data-bs-id');
        let type = $(this).attr('data-bs-type');
        $('.offcanvas-body').html('<center><i class="fad fa-spinner-third fa-spin" style="font-size: 40px;margin-top: 50px;"></i></center>');
        if(type=='assignexpert'){
            $('.offcanvas-title').text('Assign Expert');
            $('.offcanvas-body').load(@json(route('admin.schedules.assignexpert'))+'?id='+id);
        }
        if(type=='information'){
            $('.offcanvas-title').text('');
            $('.offcanvas-body').load(@json(route('admin.schedules.information'))+'?id='+id);
        }            
    });
    function RemoveRecord() {
        if(confirm('Are you sure! you want to delete this?')){
            return true;
        }
        return false;
    }
</script>
@endpush
