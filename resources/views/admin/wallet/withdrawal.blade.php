@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">

        <div class="br-pageheader pd-y-15 pd-l-20">

            <div class="col-md-6">

                <nav class="breadcrumb pd-0 mg-0 tx-12">

                    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <span class="breadcrumb-item active">Withdrawal Request</span>

                </nav>

            </div>

            <div class="col-md-6">
                <div class="text-right">

                </div>
            </div>
        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <form method="POST" action="" class="table-wrapper bannerform">
                    @csrf
                    @if ($lists->count() > 0)
                    <a href="javascript:void(0)" onclick="$('.bannerform').attr('action','{{ route('admin.enquirybulkdestory', ['type' => 'withdrawal']) }}');  $('.bannerform').submit();"
                                                class="btn btn-danger btn-sm mb-1"><i class="fa fa-trash"></i> Bulk
                                                Remove</a>
                        <table class="table table-bordered table-colored table-dark">
                            <thead>
                                <tr>
                                    <th class="wd-5p">
                                        <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                                id="checkall"><span></span></label>

                                    </th>
                                    <th>Date & Amount</th>
                                    <th>Request By</th>
                                    <th>Bank Information</th>
                                    <th>Request</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lists as $list)
                                    <tr>
                                        <td>
                                            <label class="ckbox ckbox-dark">
                                                <input type="checkbox" class="listcheck" name="check[]"
                                                    value="{{ $list->id }}">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <small><b>Amount: </b> {{defaultcurrency()}} {{ $list->amount }}</small><br>
                                            <small><b>Date: </b> {{ datetimeformat($list->created_at) }}</small>
                                            @if($list->user_id > 0) 
                                            <br>
                                            <span class="badge badge-primary">Request By User</span>
                                            @endif

                                            @if($list->expert_id > 0) 
                                            <br>
                                            <span class="badge badge-success">Request By Expert</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($list->user_id > 0)
                                            <small><b>User Name:</b> {{$list->user->name ?? '---------'}}</small><br>
                                            <small><b>User Email:</b> {{$list->user->email ?? '------'}}</small><br>
                                            <small><b>User Mobile:</b> {{$list->user->mobile ?? '-------'}}</small> 
                                            @endif
                                            @if($list->expert_id > 0)
                                            <small><b>Expert Name:</b> {{$list->expert->name ?? '---------'}}</small><br>
                                            <small><b>Expert Email:</b> {{$list->expert->email ?? '------'}}</small><br>
                                            <small><b>Expert Mobile:</b> {{$list->expert->mobile ?? '-------'}}</small> 
                                            @endif   
                                        </td>  
                                        <td>
                                            @if($list->user_id > 0)
                                            <small><b>Bank: </b> {{$list->userbank->bank_name ?? ''}}</small><br>
                                            <small><b>Account: </b> {{$list->userbank->account_number ?? ''}}</small><br>
                                            <small><b>IFSC: </b> {{$list->userbank->ifsc_code ?? ''}}</small><br>
                                            <small><b>Holder: </b> {{$list->userbank->account_holder_name ?? ''}}</small><br>
                                            @endif
                                            @if($list->expert_id > 0)
                                            <small><b>Bank: </b> {{$list->expertbank->bank_name ?? ''}}</small><br>
                                            <small><b>Account: </b> {{$list->expertbank->account_number ?? ''}}</small><br>
                                            <small><b>IFSC: </b> {{$list->expertbank->ifsc_code ?? ''}}</small><br>
                                            <small><b>Holder: </b> {{$list->expertbank->account_holder_name ?? ''}}</small><br>
                                            @endif
                                        </td>  
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="nav-link nav-link-profile " data-toggle="dropdown" aria-expanded="false">
                                                    @if($list->is_publish==0) <small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Request Pending</small> <br> @endif
                                                    @if($list->is_publish==1) <small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Request Approved</small> <br> @endif
                                                    @if($list->is_publish==2) <small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Request Rejected</small> <br> @endif
                                                </a>
                                                @if($list->is_publish==0)
                                                <div class="dropdown-menu dropdown-menu-header wd-200" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 58px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <ul class="list-unstyled user-profile-nav">
                                                        <li><a href="{{route('admin.withdrawalstatus',['id'=>$list->id,'status'=>1])}}" class="text-success"><i class="fa fa-check"></i> Approved</a></li>
                                                        <li><a href="{{route('admin.withdrawalstatus',['id'=>$list->id,'status'=>2])}}" class="text-danger"><i class="fa fa-times"></i> Rejected</a></li>
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                        </td>                                    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <x-admin.no-data-box />
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <title>Withdrawal Request : {{ project() }}</title>
@endpush
