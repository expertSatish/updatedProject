@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <div class="col-md-6">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-item active">Find Expert Step</span>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <a href="{{route('admin.findexpertstepcms')}}" target="_blank" class="btn btn-dark">
                        Section Heading
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
                            <form method="post" action="{{ route('admin.findexpertstep.save') }}"
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Description <span class="error">*</span></label>
                                            <textarea name="description" id="summernote" class="form-control" placeholder="Description Here...">{{ old('description') }}</textarea>
                                                @error('description')
                                                <span class="error">{{ $message }}<span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="p-0">Image Size is 50px * 50px</label>                              
                                            <label class="custom-file">                              
                                              <input type="file" id="imgInp" name="image" class="custom-file-input">                              
                                              <span class="custom-file-control"></span>                              
                                            </label>                              
                                            @error('image')<span class="error">{{$message}}<span> @enderror                              
                                        </div>
                                    </div>
                                    <div class="col-4">
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
                                            <th>Icon</th>
                                            <th>Title</th>
                                            <th>Sequence</th>
                                            <th>Publish</th>
                                            <th class="wd-5p">
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
                                                <td class="tblimg" style="width: 50px!important;">
                                                    <x-admin.image-preview>
                                                        <x-slot:image>{{$list->image}}</x-slot>
                                                        <x-slot:path>/uploads/findexpertstep/</x-slot>
                                                        <x-slot:alt>{{$list->title ?? ''}}</x-slot>
                                                    </x-admin.image-preview>
                                                </td>
                                                <td>{{ $list->title }}</td>
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

                                                            <li><a href="{{route('admin.findexpertstep.remove',['id'=>$list->id])}}" class="text-danger"
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function RemoveRecord(){
        if(confirm('Are you sure! you want to remove this qualification.')){ return true;}
        return false;
    }
    $('#summernote').summernote({
        popover: {
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['custom', ['imageAttributes', 'imageShape']],
                ['remove', ['removeMedia']]
            ],
        },
        callbacks: {
            onImageUpload: function(files, editor, welEditable) {
                UploadImage(files[0], editor, welEditable);                
            }
        }
    });
    $('.sequenceform').on('click',function(){ $('.table-wrapper').attr('action',@json(route('admin.findexpertstep.sequence'))); $('.table-wrapper').submit(); });
    $('.bulkremoveform').on('click',function(){ $('.table-wrapper').attr('action',@json(route('admin.findexpertstep.bulkremove'))); $('.table-wrapper').submit(); });
    function changestatus(id){
        let status = 0;
        if($('#flexSwitchCheckDefault'+id).prop('checked')==true){
            status = 1;
        }
        let url = @json(route('admin.findexpertstep.status'));
        databasestatuschange(url,status,id);
    }
    $('[data-bs-id]').on('click',function(){
        let id = $(this).attr('data-bs-id');
        $('.offcanvas-title').text('Edit Find Expert Step');
        loadingbox();
        $('.offcanvas-body').load(@json(route('admin.findexpertstep.edit'))+'?id='+id);
    });
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
        defaultimg.src = URL.createObjectURL(file)
        }
    }
</script>
@endpush
@push('css')
<title>Find Expert Step : {{project()}}</title>
    <link href="{{asset('admin/lib/SpinKit/spinkit.css')}}" rel="stylesheet">
    <style>
        /* .tblimg{width: 20%!important} */
    </style>
@endpush