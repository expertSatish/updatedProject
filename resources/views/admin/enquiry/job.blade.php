@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

        <div class="col-md-6">

            <nav class="breadcrumb pd-0 mg-0 tx-12">

            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>

            <span class="breadcrumb-item active">Apply Jobs</span>

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
                            <th>User</th>
                            <th>Resume</th>
                            <th class="wd-5p">
                                <div class="dropdown TAction show">
                                    <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                        data-toggle="dropdown" aria-expanded="true"><i
                                            class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu" x-placement="bottom-end">
                                        {{-- <li><a href="javascript:void(0)" onclick="$('.bannerform').attr('action','{{route('admin.enquirysequence',['type'=>'jobs'])}}'); $('.bannerform').submit();"><i
                                                    class="fa fa-sitemap"></i> Update Sequence</a>
                                        </li> --}}
                                        <li><a href="javascript:void(0)" onclick="$('.bannerform').attr('action','{{route('admin.enquirybulkdestory',['type'=>'jobs'])}}');  $('.bannerform').submit();"
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
                            <td>
                                <small><b>DATE:</b> {{datetimeformat($list->created_at)}}</small><br>
                                <small>
                                    <b>JOB:</b>
                                    @if(!empty($list->jobs))
                                    <a href="{{url('career/'.$list->jobs->alias)}}" target="_blank">
                                        {{$list->jobs->title ?? ''}}
                                    </a>
                                    @endif
                                </small>
                            </td>
                            <td>
                                <small><b>NAME:</b> {{$list->name}}</small><br>
                                <small><b>EMAIL:</b> {{$list->email}} </small><br>
                                <small><b>MOBILE:</b> {{$list->phone}} </small>
                            </td>
                            <td>
                                <small><b>EXPERIENCE: </b> {{$list->experience}}</small><br>
                                @if(!empty($list->resume) && file_exists(public_path('uploads/resume/'.$list->resume)))
                                <small>
                                    <b>RESUME: </b>
                                    <a href="{{asset('uploads/resume/'.$list->resume)}}" download>
                                        <i class="fa fa-download ms-1"></i> download
                                    </a>
                                </small>
                                @endif
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
<title>Job Apply Management : {{project()}}</title>
@endpush
@push('js')
<script>
    function changestatus(id){
        let status = 0;
        if($('#flexSwitchCheckDefault'+id).prop('checked')==true){
            status = 1;
        }
        let url = @json(route('admin.enquirypublish',['type'=>'jobs']));
        databasestatuschange(url,status,id);
    }
    $('[data-bs-id]').on('click',function(){
        let id = $(this).attr('data-bs-id');     
        $('.offcanvas-title').text('Job Information');
        $('.offcanvas-body').html('<div class="text-center mt-5"><i class="fad fa-spinner-third fa-spin"></i> Loading....</div>');
        $('.offcanvas-body').load(@json(route('admin.enquiryinfo',['type'=>'jobs'])) + '?id=' + id);   
    });
</script>
@endpush