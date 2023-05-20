@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">

        <div class="br-pageheader pd-y-15 pd-l-20">

            <div class="col-md-6">

                <nav class="breadcrumb pd-0 mg-0 tx-12">

                    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <span class="breadcrumb-item active">Claim Request</span>

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
                    <a href="javascript:void(0)" onclick="$('.bannerform').attr('action','{{ route('admin.enquirybulkdestory', ['type' => 'claim']) }}');  $('.bannerform').submit();"
                                                class="btn btn-danger btn-sm mb-1"><i class="fa fa-trash"></i> Bulk
                                                Remove</a>
                        <table class="table table-bordered table-colored table-dark">
                            <thead>
                                <tr>
                                    <th class="wd-5p">
                                        <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                                id="checkall"><span></span></label>

                                    </th>
                                    <th>Request For</th>
                                    <th>Request By</th>
                                    <th width="50%">Message</th>
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
                                            {{ucwords(str_replace('-',' ',$list->request_for))}}<br>
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
                                            {{$list->message}}      
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
    <title>Claim Request Management : {{ project() }}</title>
@endpush
