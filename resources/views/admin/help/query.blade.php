@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

        <div class="col-md-6">

            <nav class="breadcrumb pd-0 mg-0 tx-12">

                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>

                <span class="breadcrumb-item active">Help Center Queries</span>

            </nav>

        </div>

        <div class="col-md-6">
            <div class="text-right">
                <a href="{{route('admin.helpcenter.add')}}" class="btn btn-dark btn-with-icon btn-xs">
                    <div class="ht-40">
                        <span class="icon wd-40"><i class="fa fa-plus"></i></span>
                        <span class="pd-x-15">Add New</span>
                    </div>
                </a>
                
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
                            <form method="POST" action="" class="table-wrapper listform">
                                @csrf
                                <table class="table  table-bordered table-colored table-dark">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p">
                                                <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                                        id="checkall"><span></span></label>
                                            </th>
                                            <th>User Info</th>
                                            <th>Query</th>
                                            <th class="wd-5p">
                                                <div class="dropdown TAction show">
                                                    <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                                        data-toggle="dropdown" aria-expanded="true"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu" x-placement="bottom-end">
                                                        <li onclick="$('.listform').attr('action','{{route('admin.helpcenterquery.bulkremove')}}'); $('.listform').submit();"><a href="javascript:void(0)"
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
                                                    @if($list->type=='user')
                                                    <small><b>Name: </b> {{$list->user->name ?? ''}}</small><br>
                                                    <small>{{$list->user->email ?? ''}}</small><br>
                                                    <small><b>Contact: </b> {{$list->user->ccode ?? ''}}{{$list->user->mobile ?? ''}}</small><br>
                                                    <span class="badge badge-primary">Users</span> 
                                                    @endif
                                                    @if($list->type=='expert') 
                                                        <small><b>Name: </b> {{$list->expert->name ?? ''}}</small><br>
                                                        <small>{{$list->expert->email ?? ''}}</small><br>
                                                        <small><b>Contact: </b> {{$list->expert->ccode ?? ''}}{{$list->expert->mobile ?? ''}}</small><br>
                                                        <span class="badge badge-dark">Experts</span> 
                                                    @endif
                                                </td>                                                
                                                <td>{!! $list->description !!}</td>
                                                <td class="pd-r-0-force tx-center">
                                                    <div class="dropdown TAction show">
                                                        <a href="#" class="nav-link" data-toggle="dropdown"
                                                            aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>

                                                        <ul class="dropdown-menu" x-placement="bottom-end">

                                                            <li><a href="{{ route('admin.helpcenterquery.remove', ['id' => $list->id]) }}"
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

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection
@push('css')
    <title>Queries Request :: {{project()}}</title>
@endpush
@push('js')
    <script>
        function RemoveRecord(){
            if(confirm('Are you sure! you want to remove this qualification.')){ return true;}
            return false;
        }        
    </script>
@endpush