@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">
  <div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
      <a class="breadcrumb-item" href="{{route('admin.blogs')}}">Blog Management</a>
      <span class="breadcrumb-item active">Edit Blog</span>
    </nav>
  </div>
  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <form method="post" action="{{route('admin.updateblog')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="preid" value="{{$lists->id}}">
        <input type="hidden" name="oldtitle" value="{{$lists->title}}">
        <div class="form-layout form-layout-1">
          <div class="row mg-b-25">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Title: <span class="error">*</span></label>
                <input class="form-control" type="text" name="title" value="{{old('title',$lists->title)}}" placeholder="Title Here...">
                @error('title')<span class="error">{{$message}}<span> @enderror
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label class="form-control-label">Category : <span class="error">*</span></label>
                <select class="form-control" name="category">
                    <option value="">Choose One</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" @selected(old('category',$lists->category_id)==$category->id)>{{$category->title}}</option>
                    @endforeach
                </select>
                @error('category')<span class="error">{{$message}}<span> @enderror
              </div>
            </div>

          <div class="col-lg-3">

              <div class="form-group">

                <label class="form-control-label">Post Date : <span class="error">*</span></label>

                <input class="form-control" type="date"  name="post_date" value="{{old('post_date',$lists->post_date)}}" >

                @error('post_date')<span class="error">{{$message}}<span> @enderror

              </div>

            </div>

          <div class="col-lg-4">

            <div class="form-group">

              <label class="p-0">Banner Size is 928px * 480px</label>

              <label class="custom-file">

                <input type="file" id="imgInp2" name="banner" class="custom-file-input">

                <span class="custom-file-control"></span>

              </label>

              @error('banner')<span class="error">{{$message}}<span> @enderror

            </div>

          </div>

          <div class="col-lg-2">
            <x-admin.image-preview>
              <x-slot:image>{{$lists->banner}}</x-slot>
              <x-slot:path>/uploads/blog/banner/</x-slot>
              <x-slot:alt>{{$lists->title ?? ''}}</x-slot>
              <x-slot:class>defaultimgcss</x-slot>
              <x-slot:id>defaultimg2</x-slot>
            </x-admin.image-preview>
          </div>

          <div class="col-lg-4">

              <div class="form-group">

                <label class="p-0">IMAGE Size is 600px * 800px</label>

                <label class="custom-file">

                  <input type="file" id="imgInp" name="image" class="custom-file-input">

                  <span class="custom-file-control"></span>

                </label>

                @error('image')<span class="error">{{$message}}<span> @enderror

              </div>

            </div>

            <div class="col-lg-2">

                <x-admin.image-preview>
                  <x-slot:image>{{$lists->image}}</x-slot>
                  <x-slot:path>/uploads/blog/</x-slot>
                  <x-slot:alt>{{$lists->title ?? ''}}</x-slot>
                  <x-slot:class>defaultimgcss</x-slot>
                  <x-slot:id>defaultimg</x-slot>
                </x-admin.image-preview>

            </div>

          <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Short Description: <span class="error">*</span></label>

                <textarea class="form-control" name="sort_description" id="sort_description" placeholder="Write Something Here...">{{old('sort_description',$lists->short_description)}}</textarea>

                @error('sort_description')<span class="error">{{$message}}<span> @enderror

              </div>

          </div>

          

          <div class="col-lg-12">

              <div class="form-group">

              <label class="form-control-label">Description: <span class="error">*</span></label>

              <textarea class="form-control" name="description" id="summernote" placeholder="Write Something Here...">{{old('description',$lists->description)}}</textarea>
              @error('description')<span class="error">{{$message}}<span> @enderror
              </div>

          </div>

          

          <div class="col-lg-12">

            <div class="form-group">

              <label class="form-control-label">Meta Title:</label>

              <input class="form-control" type="text" name="meta_title" value="{{old('meta_title',$lists->meta_title)}}" placeholder="Meta Title Here...">

              @error('meta_title')<span class="error">{{$message}}<span> @enderror

            </div>

          </div>



          <div class="col-lg-12">

            <div class="form-group">

              <label class="form-control-label">Meta Keywords: </label>

              <textarea class="form-control" placeholder="Meta Keywords Here..." name="meta_keywords" >{{old('meta_keywords',$lists->meta_keywords)}}</textarea>

            </div>

          </div>



          <div class="col-lg-12">

            <div class="form-group">

              <label class="form-control-label">Meta Description: </label>

              <textarea class="form-control" placeholder="Meta Description Here..." name="meta_description" >{{old('meta_description',$lists->meta_description)}}</textarea>

            </div>

          </div>    

          

        </div><!-- row -->



        <div class="form-layout-footer text-right">

          <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();" class="btn btn-success">Confirm & Proceed</button>

          <button type="button" id="prcbtn" style="display:none;" disabled class="btn btn-success">Processing...</button>

          <a href="{{route('admin.blogs')}}" class="btn btn-dark">Cancel</a>

        </div><!-- form-layout-footer -->

      </div><!-- form-layout -->

      </form>

    </div>

  </div>

 

</div>
@endsection
@push('css')

  <link href="{{asset('admin/lib/select2/css/select2.min.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('frontend/fonts/flaticon/flaticon.css')}}" />

  <title>Edit Blog : {{project()}}</title>

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

  imgInp2.onchange = evt => {

    const [file] = imgInp2.files

    if (file) {

      defaultimg2.src = URL.createObjectURL(file)

    }

  }

  

</script>

@endpush    

