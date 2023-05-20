@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <div class="col-md-6">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
                <span class="breadcrumb-item active">FAQs</span>               
            </nav>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <a href="{{route('admin.newfaqs')}}" class="btn btn-dark btn-with-icon">
                    <div class="ht-40">
                        <span class="icon wd-40"><i class="fa fa-plus"></i></span>
                        <span class="pd-x-15">Add New</span>
                    </div>
                </a>
                <a href="{{route('admin.faqcms')}}" class="btn btn-dark btn-with-icon">
                    <div class="ht-40">
                        <span class="icon wd-40"><i class="fa fa-book"></i></span>
                        <span class="pd-x-15">FAQs Page Content</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <form method="POST" action="{{route('admin.faqssequence')}}" class="table-wrapper bannerform">
                @csrf
                <table class="table table-bordered table-colored table-dark">
                    <thead>
                        <tr>
                            <th class="wd-5p">
                                <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                        id="checkall"><span></span></label>

                            </th>                            
                            <th>Title</th>                            
                            <th>Category</th>
                            <th>Sequence</th>
                            <th>Publish</th>
                            <th>Home</th>
                            <th class="wd-5p">
                                <div class="dropdown TAction show">
                                    <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                        data-toggle="dropdown" aria-expanded="true"><i
                                            class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu" x-placement="bottom-end">
                                        <li><a href="javascript:void(0)" onclick="$('.bannerform').attr('action','{{route('admin.faqssequence')}}'); $('.bannerform').submit();"><i
                                                    class="fa fa-sitemap"></i> Update Sequence</a>
                                        </li>
                                        <li><a href="javascript:void(0)" onclick="$('.bannerform').attr('action','{{route('admin.bulkfaqsdestory')}}');  $('.bannerform').submit();"
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
                            <td>{{$list->title}}</td>
                            <td>{{$list->category->title ?? ''}}</td>
                            <td><input type="text" class="form-control" style="width: 80px;"
                                name="sequence[{{ $list->id }}]"
                                value="{{ $list->sequence }}"></td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" @checked($list->is_publish)
                                        type="checkbox" value="{{ $list->id }}" role="switch" onclick="changestatus(this.value)" id="flexSwitchCheckDefault{{ $list->id }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" @checked($list->is_home)
                                        type="checkbox" value="{{ $list->id }}" role="switch" onclick="changestatus2(this.value)" id="flexHomeSwitchCheckDefault{{ $list->id }}">
                                </div>
                            </td>
                            <td class="pd-r-0-force tx-center">

                                <div class="dropdown TAction show">

                                    <a href="#" class="nav-link" data-toggle="dropdown"
                                        aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>

                                    <ul class="dropdown-menu" x-placement="bottom-end">

                                        <li><a href="{{route('admin.editfaqs',['id'=>$list->id])}}" ><i class="fa fa-pencil"></i> Edit</a></li>

                                        <li><a href="{{route('admin.faqsremove',['removeid'=>$list->id])}}" class="text-danger"
                                                onclick="return RemoveRecord()"><i
                                                    class="fa fa-trash"></i> Remove</a></li>

                                    </ul>

                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$lists->links()}}
            </form>
        </div>
    </div>
</div>
@endsection
@push('css')
<title>FAQs : {{project()}}</title>
@endpush
@push('js')
<script>
    function changestatus(id){
        let status = 0;
        if($('#flexSwitchCheckDefault'+id).prop('checked')==true){
            status = 1;
        }
        let url = @json(route('admin.faqspublish'));
        databasestatuschange(url,status,id);
    }
    function changestatus2(id){
        let status = 0;
        if($('#flexHomeSwitchCheckDefault'+id).prop('checked')==true){
            status = 1;
        }
        let url = @json(route('admin.faqspublishhome'));
        databasestatuschange(url,status,id);
    }
</script>
@endpush