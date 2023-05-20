@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

        <div class="col-md-6">

            <nav class="breadcrumb pd-0 mg-0 tx-12">

            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
            <a class="breadcrumb-item" href="{{route('admin.career')}}">Career Management</a>
            <span class="breadcrumb-item active">Add Career</span>

            </nav>

        </div>

        <div class="col-md-6">
            <div class="text-right">
                <a href="{{route('admin.career')}}" class="btn btn-secondary btn-with-icon">
                    <div class="ht-40">
                        <span class="icon wd-40"><i class="fa fa-backward"></i></span>
                        <span class="pd-x-15">Back</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <form method="POST" action="{{route('admin.updatecareer')}}" enctype="multipart/form-data" class="table-wrapper sequenceform">
                @csrf
                <input type="hidden" name="preid" value="{{$data->id}}">
                <div class="row mg-b-25">
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Title <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('title',$data->title) }}" name="title"
                                placeholder="Title Here...">            
                                @error('title') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-lg-6">            
                        <div class="form-group">            
                            <label>Department <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('department',$data->department) }}" name="department"
                                placeholder="Department Here...">            
                                @error('department') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div> 
                    <div class="col-lg-6">            
                        <div class="form-group">            
                            <label>Role <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('role',$data->rol) }}" name="role"
                                placeholder="Role Here...">            
                                @error('role') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Locations</label>            
                            <input type="text" class="form-control" value="{{ old('locations',$data->locations) }}" name="locations"
                                placeholder="Locations Here...">            
                                @error('locations') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div> 
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Description <span class="error">*</span></label>            
                            <textarea class="form-control" id="summernote" name="description">{{ old('description',$data->description) }}</textarea>           
                            @error('description') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Meta Title <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('meta_title',$data->meta_title) }}" name="meta_title"
                                placeholder="Meta Title Here...">            
                                @error('meta_title') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Meta Keywords <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('meta_keywords',$data->meta_keywords) }}" name="meta_keywords"
                                placeholder="Meta Keywords Here...">            
                                @error('meta_keywords') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Meta Description <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('meta_description',$data->meta_description) }}" name="meta_description"
                                placeholder="Meta Description Here...">            
                                @error('meta_description') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                </div>            
                <div class="form-layout-footer text-right">            
                    <button class="btn btn-dark esvbtn" onclick="$('.esvbtn').hide(); $('.eprcbtn').show();">Confirm & Save</button>
                    <button type="button" style="display:none;" disabled class="btn btn-dark eprcbtn">
                        <i class="fad fa-spinner-third fa-spin"></i> Loading...
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('css')
<title>Edit Career : {{project()}}</title>
@endpush
@push('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
        defaultimg.src = URL.createObjectURL(file)
        }
    }
</script>
@endpush