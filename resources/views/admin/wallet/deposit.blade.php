@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">

        <div class="br-pageheader pd-y-15 pd-l-20">

            <div class="col-md-6">

                <nav class="breadcrumb pd-0 mg-0 tx-12">

                    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <span class="breadcrumb-item active">Deposit Request</span>

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
                    <a href="javascript:void(0)" onclick="$('.bannerform').attr('action','{{ route('admin.enquirybulkdestory', ['type' => 'deposit']) }}');  $('.bannerform').submit();"
                                                class="btn btn-danger btn-sm mb-1"><i class="fa fa-trash"></i> Bulk
                                                Remove</a>
                        <table class="table table-bordered table-colored table-dark">
                            <thead>
                                <tr>
                                    <th class="wd-5p">
                                        <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                                id="checkall"><span></span></label>

                                    </th>
                                    <th>Transation No</th>
                                    <th>User Info</th>
                                    <th>Payment</th>
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
                                            {{$list->transationno}}<br>
                                            <small><b>Date: </b> {{ datetimeformat($list->created_at) }}</small>
                                        </td>
                                        <td>
                                            <small><b>Name:</b> {{$list->user->name ?? ''}}</small><br>
                                            <small><b>Email:</b> {{$list->user->email ?? ''}}</small><br>
                                            <small><b>Mobile:</b> {{$list->user->mobile ?? ''}}</small>    
                                        </td>    
                                        <td>
                                            @if($list->payment==0) <small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Payment Pending</small> <br> @endif
                                            @if($list->payment==1) <small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Payment Received</small> <br> @endif
                                            @if($list->payment==2) <small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Payment Failed</small> <br> @endif
                                            <small><b>Amount :</b> {{defaultcurrency()}} {{$list->amount}}</small> <br>
                                            @if($list->payment==1)
                                            <small><b>Reference Id :</b>  {{ $list->reference_id }} </small>
                                            @endif       
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
    <title>Deposit Request Management : {{ project() }}</title>
@endpush
