@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <div class="col-md-6">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-item active">Banner Management</span>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <a href="{{route('admin.bannercms')}}" target="_blank" class="btn btn-dark">
                        Content Section
                    </a>
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
                        </div>
                        <div class="card-body justify-content-between align-items-center">
                            <form method="post" action="{{ route('admin.banner.save') }}"
                                enctype="multipart/form-data">
                                @csrf                                
                                <div class="row mg-b-25">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Type <span class="error">*</span></label>
                                            <select name="type" class="form-control">
                                                <option value="image" @selected(old('type')=='image')>Image</option>
                                                <option value="video" @selected(old('type')=='video')>Video</option>
                                                <option value="youtube" @selected(old('type')=='youtube')>Youtube</option>
                                            </select>
                                            @error('type')
                                                <span class="error">{{ $message }}<span>
                                                    @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 youtubebox" style="display: {{old('type')=='youtube'?'':'none'}}">
                                        <div class="form-group">
                                            <label>Youtube Url</label>
                                            <input type="text" class="form-control" value="{{ old('youtube') }}"
                                                name="youtube" placeholder="Youtube Url Here...">
                                            @error('youtube')
                                                <span class="error">{{ $message }}<span>
                                                    @enderror
                                        </div>
                                    </div>  
                                    <div class="col-lg-12 imagebox" style="display: {{old('type')!='youtube'?'':'none'}}">
                                        <div class="form-group">
                                            <label>Alt</label>
                                            <input type="text" class="form-control" value="{{ old('title') }}"
                                                name="title" placeholder="Title Here...">
                                            @error('title')
                                                <span class="error">{{ $message }}<span>
                                                    @enderror
                                        </div>
                                    </div>                                                                      
                                    <div class="col-lg-8 imagebox" style="display: {{old('type')!='youtube'?'':'none'}}">
                                        <div class="form-group">'
                                            <small class="p-0 videobox" style="display:{{old('type')=='video'?'':'none'}}">Choose Video</small>
                                            <small class="p-0 imagehebox" style="display: {{old('type')=='image' || old('type')==''?'':'none'}}">Image Size is 1150px * 620px</small>                         
                                            <label class="custom-file">                              
                                              <input type="file" id="imgInp" name="image" class="custom-file-input">                              
                                              <span class="custom-file-control"></span>                              
                                            </label>                              
                                            @error('image')<span class="error">{{$message}}<span> @enderror                              
                                        </div>
                                    </div>
                                    <div class="col-4 imagebox" style="display: {{old('type')!='youtube'?'':'none'}}">
                                        <img src="{{asset('admin/img/img12.jpg')}}" id="defaultimg" class="w-100 mt-3 defaultimgcss">
                                    </div>
                                </div>
                                <div class="form-layout-footer text-right">
                                    <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();"
                                        class="btn btn-dark">Confirm & Proceed</button>
                                    <button type="button" id="prcbtn" style="display:none;" class="btn btn-dark"><i class="fad fa-spinner-third fa-spin"></i> Loading...</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 mg-t-20 mg-sm-t-0">
                    <div class="card shadow-base bd-0">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">
                                {{ ucwords(str_replace('-', ' ', Request::segment(2))) }} List</h6>
                            <span class="tx-12 tx-uppercase">{{ date('F d, Y') }}</span>
                        </div>
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
                                            <th>Image / Youtube</th>
                                            <th>Sequence</th>
                                            <th>Publish</th>
                                            <th>
                                                <div class="dropdown TAction show">
                                                    <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                                        data-toggle="dropdown" aria-expanded="true"><i
                                                            class="fa fa-ellipsis-v"></i>
                                                    </a>
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
                                                @if($list->type=='video')
                                                <td>
                                                    <video class="w-100" controls="true">
                                                        <source src="{{asset('uploads/banner/'.$list->image)}}"type="video/mp4">
                                                    </video>
                                                </td>
                                                @endif
                                                @if($list->type=='image')
                                                <td class="tblimg">
                                                    <x-admin.image-preview>
                                                        <x-slot:image>{{$list->image}}</x-slot>
                                                        <x-slot:path>/uploads/banner/</x-slot>
                                                        <x-slot:alt>{{$list->title ?? ''}}</x-slot>
                                                        <x-slot:width>100</x-slot>
                                                        <x-slot:height>150</x-slot>
                                                    </x-admin.image-preview>
                                                </td>
                                                @endif
                                                @if($list->type=='youtube')
                                                <td>
                                                   {!! youtube_preview($list->title,100,150) !!}
                                                </td>
                                                @endif
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

                                                            <li><a href="{{route('admin.banner.remove',['id'=>$list->id])}}" class="text-danger"
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
    $('.sequenceform').on('click',function(){ $('.table-wrapper').attr('action',@json(route('admin.banner.sequence'))); $('.table-wrapper').submit(); });
    $('.bulkremoveform').on('click',function(){ $('.table-wrapper').attr('action',@json(route('admin.banner.bulkremove'))); $('.table-wrapper').submit(); });
    function changestatus(id){
        let status = 0;
        if($('#flexSwitchCheckDefault'+id).prop('checked')==true){
            status = 1;
        }
        let url = @json(route('admin.banner.status'));
        databasestatuschange(url,status,id);
    }
    $('[data-bs-id]').on('click',function(){
        let id = $(this).attr('data-bs-id');
        $('.offcanvas-title').text('Edit Banner');
        loadingbox();
        $('.offcanvas-body').load(@json(route('admin.banner.edit'))+'?id='+id);
    });
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
        defaultimg.src = URL.createObjectURL(file)
        }
    }
    $('select[name=type]').on('change',function(e){
        if(e.target.value=='image' || e.target.value=='video'){ 
            $('.imagebox').show();
            $('.youtubebox').hide();
            if(e.target.value=='image'){ $('.imagehebox').show(); $('.videobox').hide();}
            if(e.target.value=='video'){ $('.imagehebox').hide(); $('.videobox').show(); }
        }
        if(e.target.value=='youtube'){ 
            $('.imagebox').hide();
            $('.youtubebox').show();
        }
    });
</script>
@endpush
@push('css')
<title>Banner Management : {{project()}}</title>
    <link href="{{asset('admin/lib/SpinKit/spinkit.css')}}" rel="stylesheet">
    <style>
        .tblimg{width: 20%!important}
    </style>
@endpush