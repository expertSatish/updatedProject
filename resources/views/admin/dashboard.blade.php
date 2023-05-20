@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-0">Dashboard</h4>
    </div>

    <div class="pd-x-30 mg-t-5 pd-b-9">
        <div class="row">
            <div class="col-3 mb-2">
                <div class="bg-teal rounded overflow-hidden">
                    <a href="{{route('admin.experts')}}?month={{date('m')}}&year={{date('Y')}}" style="cursor: pointer;" class="pd-15 d-flex align-items-center">
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Registered Expert</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$experts}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">{{date('M Y')}}  Experts</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="bg-primary rounded overflow-hidden">
                    <a href="{{route('admin.users')}}?month={{date('m')}}&year={{date('Y')}}" style="cursor: pointer;" class="pd-15 d-flex align-items-center">
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Registered User</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$users}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">{{date('M Y')}}  Users</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="bg-danger rounded overflow-hidden">
                    <a href="{{route('admin.schedules.booked')}}?month={{date('m')}}&year={{date('Y')}}" style="cursor: pointer;" class="pd-15 d-flex align-items-center">
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Schedules</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$slots}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">{{date('M Y')}}  Schedules</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="bg-dark rounded overflow-hidden">
                    <a href="" style="cursor: pointer;" class="pd-15 d-flex align-items-center">
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Income</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">₹ {{$incomes}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">{{date('M Y')}}  Income</span>
                        </div>
                    </a>
                </div>
            </div>            
            <div class="col-3">
                <div class="bg-teal rounded overflow-hidden">
                    <a href="{{route('admin.experts')}}" style="cursor: pointer;" class="pd-15 d-flex align-items-center">
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Expert</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$texperts}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">Total Expert</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="bg-primary rounded overflow-hidden">
                    <a href="{{route('admin.users')}}" style="cursor: pointer;" class="pd-15 d-flex align-items-center">
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">User</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$tusers}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">Total User</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="bg-danger rounded overflow-hidden">
                    <a href="{{route('admin.schedules.booked')}}" style="cursor: pointer;" class="pd-15 d-flex align-items-center">
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Schedules</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$tslots}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">Total Schedule</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="bg-dark rounded overflow-hidden">
                    <a href="javascript:void(0);" style="cursor: pointer;" class="pd-15 d-flex align-items-center">
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Income</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">₹ {{$tincomes}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">Total  Income</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="row row-sm mg-t-10">
            <div class="col-12 mg-b-10">
                <div class="card bd-0 shadow-base pd-30">
                    <div class="d-flex align-items-center justify-content-between mg-b-30">
                        <div>
                            <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Today Book Schedules
                            </h6>
                            <small class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> {{ date('d F Y') }} </small>
                        </div>
                        <a href="{{route('admin.schedules.booked',['booked'=>'booked'])}}"
                            class="btn btn-outline-dark btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">See
                            more</a>
                    </div>
                    <table class="table table-valign-middle mg-b-0">
                        <thead>
                            <tr>
                                <th>Booking Info</th>
                                <th>Expert Info</th>
                                <th>User Info</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todayslots as $list)
                                <tr>
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

            <div class="col-6 mb-5">
                <div class="card bd-0 shadow-base pd-30">
                    <div class="d-flex align-items-center justify-content-between mg-b-30">
                        <div>
                            <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Today Registered Expert</h6>
                            <small class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> {{ date('d F Y') }} </small>
                        </div>
                        <a href="{{route('admin.experts')}}" class="btn btn-outline-dark btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">See More</a>
                    </div>
                    <table class="table table-valign-middle mg-b-0">
                        <tbody>
                            @foreach ($todayexperts as $item)
                               <tr>
                                    <td>
                                        <small><b>Expert Id :</b> {{ $item->user_id }}</small><br>
                                        @if($item->profile_complete==0)
                                        <small style="font-size: 11px;" class="text-danger"><b>Profile Not Completed</b></small><br>
                                        @endif
                                        @if($item->service_charges > 0)
                                        <small><b>Service Charges :</b> {{ $item->service_charges }}%</small><br>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->name }}<br>
                                        <small><b>Email :</b> {{ $item->email }}</small><br>
                                        <small><b>Mobile :</b> {{ $item->mobile }}</small><br>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" @checked($item->is_publish)
                                                type="checkbox" value="{{ $item->id }}" role="switch"
                                                onclick="changestatus(this.value)"
                                                id="flexSwitchCheckDefault{{ $item->id }}">
                                        </div>
                                    </td>                                    
                               </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-6 mb-5">
                <div class="card bd-0 shadow-base pd-30">
                    <div class="d-flex align-items-center justify-content-between mg-b-30">
                        <div>
                            <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Today Registered User</h6>
                            <small class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> {{ date('d F Y') }} </small>
                        </div>
                        <a href="{{route('admin.users')}}"
                            class="btn btn-outline-dark btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">See
                            more</a>
                    </div>
                    <table class="table table-valign-middle mg-b-0">
                        <tbody>
                            @foreach ($todayusers as $user)
                                <tr>
                                    <td>
                                        <small><b>User Id :</b> {{$user->user_id}}</small><br>
                                    </td>
                                    <td>
                                        {{ $user->name }}<br>
                                        <small><b>Email :</b> {{$user->email}}</small><br>
                                        <small><b>Mobile :</b> {{$user->mobile}}</small><br>
                                    </td>
                                    <td> 
                                        @if($user->complete_profile==0) <small class="text-danger"><i class="fa fa-circle" style="font-size: 7px;"></i> Incomplete Profile</small> @endif  
                                        @if($user->complete_profile==1) <small class="text-success"><i class="fa fa-circle" style="font-size: 7px;"></i> Complete Profile</small> @endif      
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" @checked($user->is_publish)
                                                type="checkbox" value="{{ $user->id }}" role="switch"
                                                onclick="changestatus(this.value)"
                                                id="flexSwitchCheckDefault{{ $user->id }}">
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
    <title>Dashboard : {{project()}} </title>
@endpush
@push('js')
    <script>
        function RemoveRecord() {
            if(confirm('Are you sure! you want to delete this?')){
                return true;
            }
            return false;
        }
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
    </script>
@endpush