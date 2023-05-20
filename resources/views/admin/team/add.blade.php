@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

        <div class="col-md-6">

            <nav class="breadcrumb pd-0 mg-0 tx-12">

            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
            <a class="breadcrumb-item" href="{{route('admin.teams')}}">Teams Management</a>
            <span class="breadcrumb-item active">Add Team</span>

            </nav>

        </div>

        <div class="col-md-6">
            <div class="text-right">
                <a href="{{route('admin.teams')}}" class="btn btn-secondary btn-with-icon">
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
            <form method="POST" action="{{route('admin.saveteams')}}" enctype="multipart/form-data" class="table-wrapper sequenceform">
                @csrf
                <div class="row mg-b-25">
                    <div class="col-lg-6">            
                        <div class="form-group">            
                            <label>Title <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('title') }}" name="title"
                                placeholder="Title Here...">            
                                @error('title') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div> 
                    <div class="col-lg-4">            
                        <div class="form-group">            
                            <label>Image <span class="error">*</span></label>            
                            <input type="file" id="imgInp" class="form-control" name="image">            
                            <small>BEST IMAGE SIZE: 220px * 220px</small> <br>
                            @error('image') <span class="text-danger error">{{$message}}</span> @enderror                                
                        </div>            
                    </div> 
                    <div class="col-lg-2">
                        <img src="{{asset('admin/img/img12.jpg')}}" id="defaultimg" class="w-100 defaultimgcss">
                    </div> 
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Short Description</label>            
                            <input type="text" class="form-control" value="{{ old('designation') }}" name="designation"
                                placeholder="Designation Here...">            
                                @error('designation') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div> 
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Description <span class="error">*</span></label>            
                            <textarea class="form-control" id="summernote" name="description">{{ old('description') }}</textarea>           
                            @error('description') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-lg-6">            
                        <div class="form-group">            
                            <label>Facbook Link</label>            
                            <input type="url" class="form-control" value="{{ old('facebook') }}" name="facebook"
                                placeholder="Facebook Link Here...">            
                                @error('facebook') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-lg-6">            
                        <div class="form-group">            
                            <label>Linkedin Link</label>            
                            <input type="url" class="form-control" value="{{ old('linkedin') }}" name="linkedin"
                                placeholder="Linkedin Link Here...">            
                                @error('linkedin') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div> 
                    <div class="col-lg-6">            
                        <div class="form-group">            
                            <label>Twitter Link</label>            
                            <input type="url" class="form-control" value="{{ old('twitter') }}" name="twitter"
                                placeholder="Twitter Link Here...">            
                                @error('twitter') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-lg-6">            
                        <div class="form-group">            
                            <label>Instagram Link</label>            
                            <input type="url" class="form-control" value="{{ old('instagram') }}" name="instagram"
                                placeholder="Instagram Link Here...">            
                                @error('instagram') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-lg-6">            
                        <div class="form-group">            
                            <label>Pinterest Link</label>            
                            <input type="url" class="form-control" value="{{ old('pinterest') }}" name="pinterest"
                                placeholder="Pinterest Link Here...">            
                                @error('pinterest') <span class="text-danger error">{{$message}}</span>  @enderror        
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
<title>Add Team : {{project()}}</title>
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