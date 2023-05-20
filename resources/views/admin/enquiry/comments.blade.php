@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

        <div class="col-md-6">

            <nav class="breadcrumb pd-0 mg-0 tx-12">

            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>

            <span class="breadcrumb-item active">Blog Comments</span>

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
                @if($lists->count() > 0)
                <table class="table table-bordered table-colored table-dark">
                    <thead>
                        <tr>
                            <th class="wd-5p">
                                <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                        id="checkall"><span></span></label>

                            </th>
                            <th>Date</th>
                            <th>Blog</th>
                            <th>User</th>
                            <th>Sequence</th>
                            <th>Publish</th>
                            <th class="wd-5p">
                                <div class="dropdown TAction show">
                                    <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                        data-toggle="dropdown" aria-expanded="true"><i
                                            class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu" x-placement="bottom-end">
                                        <li><a href="javascript:void(0)" onclick="$('.bannerform').attr('action','{{route('admin.enquirysequence',['type'=>'comments'])}}'); $('.bannerform').submit();"><i
                                                    class="fa fa-sitemap"></i> Update Sequence</a>
                                        </li>
                                        <li><a href="javascript:void(0)" onclick="$('.bannerform').attr('action','{{route('admin.enquirybulkdestory',['type'=>'comments'])}}');  $('.bannerform').submit();"
                                                class="text-danger"><i class="fa fa-trash"></i> Bulk
                                                Remove</a></li>
                                    </ul>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lists as $list)
                        <tr>
                            <td>
                                <label class="ckbox ckbox-dark">
                                    <input type="checkbox" class="listcheck" name="check[]" value="{{ $list->id }}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{datetimeformat($list->created_at)}}</td>
                            <td>
                                @if(!empty($list->blog))
                                <a href="{{url('blog/'.$list->blog->alias)}}" target="_blank">
                                    {{$list->blog->title ?? ''}}
                                </a>
                                @endif
                            </td>
                            <td>
                                <small><b>NAME:</b> {{$list->name}}</small><br>
                                <small><b>EMAIL:</b> {{$list->email}} </small><br>
                                <small><b>IP:</b> {{$list->ip}} </small>
                            </td>
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

                                    <li><a href="#editmodal" data-bs-toggle="offcanvas" data-bs-id="{{ $list->id }}"><i class="fa fa-book"></i> Detail</a></li>

                                   
                                </ul>

                            </div>

                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <x-admin.no-data-box/>
                @endif
            </form>
        </div>
    </div>
</div>


@endsection
@push('css')
<title>Blog Comment Management : {{project()}}</title>
@endpush
@push('js')
<script>
    function changestatus(id){
        let status = 0;
        if($('#flexSwitchCheckDefault'+id).prop('checked')==true){
            status = 1;
        }
        let url = @json(route('admin.enquirypublish',['type'=>'comments']));
        databasestatuschange(url,status,id);
    }
    $('[data-bs-id]').on('click',function(){
        let id = $(this).attr('data-bs-id');     
        $('.offcanvas-title').text('Comment Information');
        $('.offcanvas-body').html('<div class="text-center mt-5"><i class="fad fa-spinner-third fa-spin"></i> Loading....</div>');
        $('.offcanvas-body').load(@json(route('admin.enquiryinfo',['type'=>'comments'])) + '?id=' + id);   
    });
</script>
@endpush