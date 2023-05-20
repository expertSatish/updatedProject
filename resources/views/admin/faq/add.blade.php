@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="breadcrumb-item" href="{{ route('admin.faqs') }}">FAQs</a>
                <span class="breadcrumb-item active">Add FAQs </span>
            </nav>
        </div>
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <form method="post" action="{{ route('admin.savefaqs') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label class="form-control-label">Title: <span class="error">*</span></label>
                                    <input class="form-control" type="text" name="title" value="{{ old('title') }}"
                                        placeholder="Title Here...">
                                    @error('title')
                                        <span class="error">{{ $message }}<span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">                    
                                  <label class="form-control-label">Category : <span class="error">*</span></label>
                                    <select class="form-control" name="category">                    
                                        <option value="">Choose One</option>                    
                                        @foreach($categories as $category)  
                                            @if(count($category->child)==0)                  
                                            <option value="{{$category->id}}" @selected(old('category')==$category->id)>{{$category->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>                    
                                  @error('category')<span class="error">{{$message}}<span> @enderror                    
                                </div>                    
                            </div>
                            <div class="col-lg-12">            
                                <div class="form-group">            
                                    <label>Description <span class="error">*</span></label>            
                                    <textarea class="form-control" id="summernote" name="description">{{ old('description') }}</textarea>           
                                    @error('description') <span class="text-danger error">{{$message}}</span>  @enderror        
                                </div>            
                            </div>                    
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Title:</label>
                                    <input class="form-control" type="text" name="meta_title"
                                        value="{{ old('meta_title') }}" placeholder="Meta Title Here...">
                                    @error('meta_title')
                                        <span class="error">{{ $message }}<span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Keywords: </label>
                                    <textarea class="form-control" placeholder="Meta Keywords Here..." name="meta_keywords">{{ old('meta_keywords') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Description: </label>
                                    <textarea class="form-control" placeholder="Meta Description Here..." name="meta_description">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-layout-footer text-right">
                            <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();"
                                class="btn btn-success">Confirm & Proceed</button>
                            <button type="button" id="prcbtn" style="display:none;" disabled
                                class="btn btn-success">Processing...</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('css')
<title>New FAQs : {{project()}}</title>
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

</script>
@endpush
