<form method="post" class="updateform">
    @csrf
    <input type="hidden" name="id" value="{{$lists->id}}">
    <input type="hidden" name="oldtitle" value="{{$lists->title}}">
    <div class="row mg-b-25">

        <div class="col-lg-12">

            <div class="form-group">

                <label>Title <span class="error">*</span></label>

                <input type="text" class="form-control" value="{{ old('title', $lists->title) }}" name="title"
                    placeholder="Title Here...">

                    <span class="error title-error"><span>

            </div>

        </div>

        <div class="col-lg-12">

            <div class="form-group">

                <label>Description </label>

                <textarea name="description" id="summernote2" class="form-control" placeholder="Write something here...">{{ old('description', $lists->description) }}</textarea>

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
            <x-admin.image-preview>
                <x-slot:image>{{$lists->image}}</x-slot>
                <x-slot:path>/uploads/findexpertstep/</x-slot>
                <x-slot:alt>{{$lists->title ?? ''}}</x-slot>
                <x-slot:id>defaultimg</x-slot>
                <x-slot:class>w-100 defaultimgcss</x-slot>
            </x-admin.image-preview>
        </div>

    </div>

    <div class="form-layout-footer text-right">

        <button class="btn btn-dark esvbtn">Confirm & Update</button>
        <button type="button" style="display:none;" class="btn btn-dark eprcbtn"><i
                class="fad fa-spinner-third fa-spin"></i> Loading...</button>
        <a href="{{route('admin.findexpertstep')}}" class="btn btn-danger">Cancel</a>
    </div><!-- form-layout-footer -->

</form>
<script>
    $('#summernote2').summernote({
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
    $('.updateform').on('submit',function(e){
        $('.error').html('');
        $('.esvbtn').hide();
        $('.eprcbtn').show();
        e.preventDefault();
        $.ajax({
            data:new FormData(this),
            url:@json(route('admin.findexpertstep.update')),
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                loadingbox();
                $('.offcanvas-body').load(@json(route('admin.findexpertstep.edit',['id'=>$lists->id])));
                toastr.success(data.success);
            },
            error:function(response){
                if(response.responseJSON.errors.title!== undefined){
                    $('.title-error').text(response.responseJSON.errors.title);
                }
                $('.esvbtn').show();
                $('.eprcbtn').hide();
            }
        });
    })
</script>