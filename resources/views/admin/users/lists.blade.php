@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">

        <div class="br-pageheader pd-y-15 pd-l-20">

            <div class="col-md-6">

                <nav class="breadcrumb pd-0 mg-0 tx-12">

                    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <span class="breadcrumb-item active">Users</span>

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

                            <form action="{{ url()->current() }}" class="tx-12 tx-uppercase d-flex">
                                <input type="search" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Search Here...">
                                <button class="btn btn-dark ms-2"><i class="fa fa-search"></i></button>
                                <a href="{{ url()->current() }}" class="btn btn-dark ms-2"><i class="fa fa-refresh"></i></a>
                            </form>

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
                                                    <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                                            id="checkall"><span></span></label>

                                                </th>

                                                <th>Date</th>
                                                <th>Information</th>
                                                <th>Wallet / Session</th>
                                                <th>Profile</th>
                                                <th>Active</th>
                                                <th class="wd-5p">
                                                    <div class="dropdown TAction show">

                                                        <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                                            data-toggle="dropdown" aria-expanded="true"><i
                                                                class="fa fa-ellipsis-v"></i></a>

                                                        <ul class="dropdown-menu" x-placement="bottom-end">

                                                            {{-- <li class="sequenceform"><a href="javascript:void(0)"><i
                                                                        class="fa fa-sitemap"></i> Update Sequence</a>
                                                            </li> --}}

                                                            <li class="bulkremoveform"><a href="javascript:void(0)"
                                                                    class="text-danger"><i class="fa fa-trash"></i> Bulk
                                                                    Remove</a></li>

                                                        </ul>

                                                    </div>
                                                </th>

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
                                                        <small><b>Date :</b>
                                                            {{ datetimeformat($list->created_at) }}</small><br>
                                                        <small><b>User Id :</b> {{ $list->user_id }}</small><br>
                                                        <small><b>Last login :</b>
                                                            {{ datetimeformat($list->last_login) }}</small>
                                                    </td>
                                                    <td>
                                                        <small><b>Name :</b> {{ $list->name }}</small><br>
                                                        <small><b>Email :</b> {{ $list->email }}</small><br>
                                                        <small><b>Mobile :</b> {{ $list->mobile }}</small><br>
                                                    </td>
                                                    <td>
                                                        <small><b>Wallet : </b> ₹ {{ $list->wallet }}</small><br>
                                                        <small>
                                                            <b>Sessions : </b>
                                                            {{ \App\Models\SlotBook::where('user_id', $list->id)->whereIn('payment', [0, 1, 3])->count() }}
                                                        </small>
                                                    </td>
                                                    <td>
                                                        @if ($list->complete_profile == 0)
                                                            <small class="text-danger"><i class="fa fa-circle"
                                                                    style="font-size: 7px;"></i> Profile Incompleted</small>
                                                        @endif
                                                        @if ($list->complete_profile == 1)
                                                            <small class="text-success"><i class="fa fa-circle"
                                                                    style="font-size: 7px;"></i> Profile Completed</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" @checked($list->is_publish)
                                                                type="checkbox" value="{{ $list->id }}" role="switch"
                                                                onclick="changestatus(this.value)"
                                                                id="flexSwitchCheckDefault{{ $list->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="pd-r-0-force tx-center">

                                                        <div class="dropdown TAction show">

                                                            <a href="#" class="nav-link" data-toggle="dropdown"
                                                                aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>

                                                            <ul class="dropdown-menu" x-placement="bottom-end">

                                                                <li><a
                                                                        href="{{ route('admin.users.edit', ['id' => $list->id]) }}"><i
                                                                            class="fa fa-pencil"></i> Edit</a>
                                                                </li>
                                                                <li><a
                                                                        href="{{ route('admin.users.information', ['page' => 'info', 'id' => $list->id]) }}"><i
                                                                            class="fa fa-address-card"></i> Information</a>
                                                                </li>
                                                                <li><a href="{{ route('admin.users.remove', ['id' => $list->id]) }}"
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
@push('js')
    <script src="{{ asset('admin/lib/parsleyjs/parsley.js') }}"></script>
    <script>
        function RemoveRecord() {
            if (confirm('Are you sure! you want to remove this qualification.')) {
                return true;
            }
            return false;
        }
        $('.sequenceform').on('click', function() {
            $('.table-wrapper').attr('action', @json(route('admin.users.sequence')));
            $('.table-wrapper').submit();
        });
        $('.bulkremoveform').on('click', function() {
            $('.table-wrapper').attr('action', @json(route('admin.users.bulkremove')));
            $('.table-wrapper').submit();
        });

        function changestatus(id) {
            let status = 0;
            if ($('#flexSwitchCheckDefault' + id).prop('checked') == true) {
                status = 1;
            }
            let url = @json(route('admin.users.status'));
            databasestatuschange(url, status, id);
        }
    </script>
@endpush
@push('css')
    <title>Users : {{ project() }}</title>
    <link href="{{ asset('admin/lib/SpinKit/spinkit.css') }}" rel="stylesheet">
@endpush
