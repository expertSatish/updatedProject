@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">

        <div class="br-pageheader pd-y-15 pd-l-20">

            <div class="col-md-6">

                <nav class="breadcrumb pd-0 mg-0 tx-12">

                    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <span class="breadcrumb-item active">Contact Enquiry</span>

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
                    <a href="javascript:void(0)"
                                onclick="$('.bannerform').attr('action','{{ route('admin.enquirybulkdestory', ['type' => 'contact']) }}');  $('.bannerform').submit();"
                                class="btn btn-danger btn-sm mb-1"><i class="fa fa-trash"></i> Bulk
                                Remove</a>
                        <table class="table table-bordered table-colored table-dark">
                            <thead>
                                <tr>
                                    <th class="wd-5p">
                                        <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                                id="checkall"><span></span></label>

                                    </th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Business Sector</th>
                                    <th>Message</th>
                                    
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
                                            <small><b>DATE:</b> {{ datetimeformat($list->created_at) }}</small><br>
                                            <small><b>IP:</b> {{ $list->ip }} </small>
                                        </td>
                                        <td>
                                            <small><b>NAME:</b> {{ $list->name }}</small><br>
                                            <small><b>EMAIL:</b> {{ $list->email }} </small><br>
                                            <small><b>MOBILE:</b> {{ $list->mobile }} </small>
                                        </td>
                                        <td>
                                            <small><b>REASON:</b> {{ ucwords(str_replace('-',' ',$list->reason)) }}</small><br>
                                            <small><b>SECTOR:</b> {{ $list->businesssector->title ?? '' }} </small><br>
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
    <title>Contact Enquiry Management : {{ project() }}</title>
@endpush
@push('js')
    <script>
        function changestatus(id) {
            let status = 0;
            if ($('#flexSwitchCheckDefault' + id).prop('checked') == true) {
                status = 1;
            }
            let url = @json(route('admin.enquirypublish', ['type' => 'comments']));
            databasestatuschange(url, status, id);
        }
        $('[data-bs-id]').on('click', function() {
            let id = $(this).attr('data-bs-id');
        });
    </script>
@endpush
