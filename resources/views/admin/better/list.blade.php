@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">

        <div class="br-pageheader pd-y-15 pd-l-20">

            <div class="col-md-6">

                <nav class="breadcrumb pd-0 mg-0 tx-12">

                    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <span class="breadcrumb-item active">Get Better</span>

                </nav>

            </div>

            <div class="col-md-6">

                <div class="text-right">

                </div>

            </div>

        </div>

        <div class="br-pagebody">

            <div class="row row-sm mg-t-20">

                <div class="col-sm-5">

                    <div class="card shadow-base bd-0">

                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">

                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Add
                                {{ ucwords(str_replace('-', ' ', Request::segment(2))) }}</h6>

                            <span class="tx-12 tx-uppercase">{{ date('F d, Y') }}</span>

                        </div><!-- card-header -->

                        <div class="card-body justify-content-between align-items-center">

                            <form method="post" action="{{ route('admin.getbetter.save') }}"
                                enctype="multipart/form-data">

                                @csrf

                                
                                <div class="row mg-b-25">

                                    <div class="col-lg-12">

                                        <div class="form-group">

                                            <label>Title <span class="error">*</span></label>

                                            <input type="text" class="form-control" value="{{ old('title') }}"
                                                name="title" placeholder="Title Here...">

                                            @error('title')
                                                <span class="error">{{ $message }}<span>
                                                    @enderror

                                        </div>

                                    </div>

                                </div>

                                <div class="form-layout-footer text-right">

                                    <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();"
                                        class="btn btn-dark">Confirm & Proceed</button>

                                    <button type="button" id="prcbtn" style="display:none;" class="btn btn-dark"><i class="fad fa-spinner-third fa-spin"></i> Loading...</button>

                                </div><!-- form-layout-footer -->

                            </form>

                        </div><!-- card-body -->

                    </div><!-- card -->

                </div><!-- col-4 -->

                <div class="col-sm-7 mg-t-20 mg-sm-t-0">

                    <div class="card shadow-base bd-0">

                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">

                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">
                                {{ ucwords(str_replace('-', ' ', Request::segment(2))) }} List</h6>

                            <span class="tx-12 tx-uppercase">{{ date('F d, Y') }}</span>

                        </div><!-- card-header -->

                        <div class="card-body justify-content-between align-items-center">

                            @if($lists->count()==0)
                                <x-admin.no-data-box/>
                            @endif

                            @if($lists->count()>0)
                            <form method="POST" class="table-wrapper">
                                @csrf

                                <table class="table  table-bordered table-colored table-dark">

                                    <thead>

                                        <tr>

                                            <th class="wd-5p">
                                                <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                                        id="checkall"><span></span></label>

                                            </th>

                                            <th>Title</th>

                                            <th>alias</th>

                                            <th>Sequence</th>

                                            <th>Publish</th>

                                            <th class="wd-5p">
                                                <div class="dropdown TAction show">

                                                    <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                                        data-toggle="dropdown" aria-expanded="true"><i
                                                            class="fa fa-ellipsis-v"></i></a>

                                                    <ul class="dropdown-menu" x-placement="bottom-end">

                                                        <li class="sequenceform"><a href="javascript:void(0)"><i class="fa fa-sitemap"></i> Update Sequence</a>
                                                        </li>

                                                        <li class="bulkremoveform"><a href="javascript:void(0)" class="text-danger"><i
                                                                    class="fa fa-trash"></i> Bulk Remove</a></li>

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

                                                        <input type="checkbox" class="listcheck" name="check[]" value="{{ $list->id }}">

                                                        <span></span>

                                                    </label>
                                                </td>

                                                <td>{{ $list->title }}</td>
                                                <td>{{ $list->alias }}</td>
                                                <td><input type="text" class="form-control" style="width: 80px;"
                                                        name="sequence[{{ $list->id }}]"
                                                        value="{{ $list->sequence }}"></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" @checked($list->is_publish)
                                                            type="checkbox" value="{{ $list->id }}" role="switch" onclick="changestatus(this.value)" id="flexSwitchCheckDefault{{ $list->id }}">
                                                    </div>
                                                </td>
                                                <td class="pd-r-0-force tx-center">

                                                    <div class="dropdown TAction show">

                                                        <a href="#" class="nav-link" data-toggle="dropdown"
                                                            aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>

                                                        <ul class="dropdown-menu" x-placement="bottom-end">

                                                            <li><a href="#editmodal" data-bs-toggle="offcanvas" data-bs-id="{{$list->id}}" ><i
                                                                        class="fa fa-pencil"></i> Edit</a></li>

                                                            <li><a href="{{route('admin.getbetter.remove',['id'=>$list->id])}}" class="text-danger"
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
    <script src="{{asset('admin/lib/parsleyjs/parsley.js')}}"></script>
<script>
    function RemoveRecord(){
        if(confirm('Are you sure! you want to remove this qualification.')){ return true;}
        return false;
    }
    $('.sequenceform').on('click',function(){ $('.table-wrapper').attr('action',@json(route('admin.getbetter.sequence'))); $('.table-wrapper').submit(); });
    $('.bulkremoveform').on('click',function(){ $('.table-wrapper').attr('action',@json(route('admin.getbetter.bulkremove'))); $('.table-wrapper').submit(); });
    function changestatus(id){
        let status = 0;
        if($('#flexSwitchCheckDefault'+id).prop('checked')==true){
            status = 1;
        }
        let url = @json(route('admin.getbetter.status'));
        databasestatuschange(url,status,id);
    }
    $('[data-bs-id]').on('click',function(){
        let id = $(this).attr('data-bs-id');
        $('.offcanvas-title').text('Edit getbetter');
        loadingbox();
        $('.offcanvas-body').load(@json(route('admin.getbetter.edit'))+'?id='+id);
    });
</script>
@endpush
@push('css')
<title>Get Better Management : {{project()}}</title>
    <link href="{{asset('admin/lib/SpinKit/spinkit.css')}}" rel="stylesheet">
@endpush