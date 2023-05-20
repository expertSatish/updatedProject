@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <div class="col-md-6">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', Request::segment(3))) }} Schedules</span>
            </nav>
        </div>
        <div class="col-md-6">
            <div class="text-right">                              
            </div>
        </div>
    </div>
    <div class="br-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-sm-12 mg-t-20 mg-sm-t-0">
                <div class="card shadow-base bd-0">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h6 class="card-title tx-uppercase tx-12 mg-b-0">
                            {{ ucwords(str_replace('-', ' ', Request::segment(2))) }} List</h6>
                        <span class="tx-12 tx-uppercase">{{ date('F d, Y') }}</span>
                    </div><!-- card-header -->
                    <div class="card-body justify-content-between align-items-center">
                        @if ($lists->count() == 0)
                            <x-admin.no-data-box />
                        @endif
                        @if ($lists->count() > 0)
                            <form method="POST" class="table-wrapper">
                                @csrf
                                <table class="table  table-bordered table-colored table-dark">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p">
                                                #
                                            </th>
                                            <th class="wd-20p">Schedule Information</th>
                                            <th class="wd-20p">Expert Information</th>
                                            <th class="wd-20p">User Information</th>
                                            <th class="wd-20p">Booking</th>
                                            <th class="wd-10p">Payment</th>
                                            <th class="wd-10p">Status</th>
                                            <th class="wd-5p">
                                                <div class="dropdown TAction show">
                                                    {{-- <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                                        data-toggle="dropdown" aria-expanded="true"><i
                                                            class="fa fa-ellipsis-v"></i></a> --}}
                                                    {{-- <ul class="dropdown-menu" x-placement="bottom-end">
                                                        <li class="bulkremoveform"><a href="javascript:void(0)"
                                                                class="text-danger"><i class="fa fa-trash"></i> Bulk
                                                                Remove</a></li>
                                                    </ul> --}}
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lists as $list)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
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
                                                    <small><b>Name :</b> {{$list->user->name ?? ''}} (#{{$list->user->user_id ?? ''}})</small><br>
                                                    <small><b>Email :</b> {{$list->user->email ?? ''}}</small><br>
                                                    <small><b>Contact :</b> {{$list->user->ccode ?? ''}}{{$list->user->mobile ?? ''}}</small><br>                                                    
                                                </td>
                                                <td>
                                                    <small><b>Amount :</b> {{defaultcurrency()}} {{$list->booking_amount}}</small><br>
                                                    @if($list->coupon_discount > 0)<small><b>Discount :</b> {{defaultcurrency()}} {{$list->coupon_discount ?? 0}}</small><br>@endif
                                                    @if($list->gst > 0)<small><b>GST ({{$list->gst ?? 0}}%):</b> {{defaultcurrency()}} {{$list->gst_amount ?? 0}}</small><br>@endif
                                                    <small><b>Paid Amount :</b> {{defaultcurrency()}} {{$list->paid_amount}}</small>
                                                </td>
                                                <td>
                                                    @if($list->payment==0)<small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Incomplete Process</small> @endif
                                                    @if($list->payment==1)<small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid By Online</small>@endif
                                                    @if($list->payment==2)<small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Payment Failed</small>@endif
                                                    @if($list->payment==3)<small class="text-primary"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid By Wallet</small>@endif
                                                </td>
                                                <td>
                                                    @if(request()->segment(3)!='expired')                                                    
                                                        @if($list->reschedule_slot==0 && $list->call_invitation==0)
                                                            <small class="text-secondary">{{$list->status==0?'New':''}}</small>
                                                            <small class="text-primary">{{$list->status==1?'Confirm':''}}</small>
                                                            <small class="text-danger">{{$list->status==2?'Reject':''}}</small>
                                                        @elseif($list->reschedule_slot==0 && $list->call_invitation==1 && $list->status==1)
                                                            <small class="text-primary">Send Call Invitation</small>   
                                                        @elseif($list->reschedule_slot==0 && $list->call_invitation==2 && $list->status==1)
                                                        <small class="text-primary">Accept Call Invitation</small>   
                                                        @elseif($list->reschedule_slot==0 && $list->status==3)
                                                        <small class="text-success">Done & Closed</small>   
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

                                {{ $lists->links() }}

                            </form>
                        @endif

                    </div><!-- card-body -->

                </div><!-- card -->

            </div><!-- col-4 -->

        </div><!-- row -->

    </div>

</div>
@endsection
@push('css')
    <title>{{ ucwords(str_replace('-', ' ', Request::segment(3))) }} Schedules</title>
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