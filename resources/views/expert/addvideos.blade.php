<form class="addinformation">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-12 mb-2">
                <small for="title" class="form-label">Video Title</small>
                <input type="title" name="title" class="form-control" placeholder="video title here....">
                <small class="error title-error"></small>
            </div>
            <div class="col-12 mb-2">
                <small for="exampleFormControlInput1" class="form-label">Video Type</small>
                <select class="form-control" onchange="chooseType(this.value)" name="video_type">
                    <option value="">Choose Type</option>
                    <option value="1">Youtube Video</option>
                    <option value="2">Other</option>
                </select>
                <small class="error type-error"></small>
            </div>
            <div class="col-12 mb-2 youtubebox" style="display: none">
                <small for="url" class="form-label">Youtube Video URL</small>
                <input type="url" name="video_url" class="form-control" placeholder="Youtube video url here....">
                <small class="error url-error"></small>
            </div>
            <div class="col-12 mb-2 videobox" style="display: none">
                <small for="file" class="form-label">Choose Video</small>
                <input type="file" name="video" class="form-control">
                <small class="error video-error"></small>
            </div>
            <div class="col-12 mb-2 " style="display: none">
                <small for="file" class="form-label">Choose Video Image</small>
                <input type="file" name="video_image" class="form-control">
                <small class="error image-error"></small><br>
                <small class="text-primary">Best Image Size: 480px * 360px</small>
            </div>
            {{-- <div class="col-12 mb-2" style="display: none">
                <small for="exampleFormControlInput1" class="form-label">Industries</small>
                <select class="form-control chosen-select" multiple name="industries[]">
                    <option value="0">Choose Industries</option>
                    @foreach($industries as $industrie)
                    <option value="{{$industrie->id ?? 0}}">{{$industrie->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error industries-error"></small>
            </div> --}}
            <div class="col-12">
                <small for="exampleFormControlTextarea1" class="form-label">Description</small>
                <textarea class="form-control summernote" name="description" id="description" rows="3"></textarea>
                <small class="error description-error"></small>
            </div>            
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-dark otsbtn">Update & Proceed</button>
        <button type="button" style="display: none;" class="btn btn-dark otpbtn disabled"><i class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>

<script>
    $('.summernote').summernote({
        height: 100,
        toolbar: []
    });    
    function chooseType(value){
        if(value==1){ 
            $('.youtubebox').show();
            $('.videobox').hide();
        }
        if(value==2){ 
            $('.youtubebox').hide();
            $('.videobox').show();
        }
        
    }
    $(".chosen-select").chosen();
    $('.addinformation').on('submit',function(e){
        e.preventDefault();
        $('.otsbtn').hide();
        $('.otpbtn').show();
        $('.error').html('');
        $.ajax({
            data:new FormData(this),
            url:@json(route('expert.savevideo')),
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                toastr.success(data.success);
                $('.otsbtn').show();
                $('.otpbtn').hide();
                setTimeout(() => {
                    window.location.reload();
                }, 1000);                
                $('.addinformation').trigger('reset');
            },
            error:function(response){            
                if(response.responseJSON.errors.video_type!== undefined){
                    $('.type-error').text(response.responseJSON.errors.video_type);
                }
                if(response.responseJSON.errors.title!== undefined){
                    $('.title-error').text(response.responseJSON.errors.title);
                }  
                if(response.responseJSON.errors.video_url!== undefined){
                    $('.url-error').text(response.responseJSON.errors.video_url);
                }
                if(response.responseJSON.errors.video!== undefined){
                    $('.video-error').text(response.responseJSON.errors.video);
                }
                if(response.responseJSON.errors.video_image!== undefined){
                    $('.image-error').text(response.responseJSON.errors.video_image);
                }
                if(response.responseJSON.errors.industries!== undefined){
                    $('.industries-error').text(response.responseJSON.errors.industries);
                }
                if(response.responseJSON.errors.description!== undefined){
                    $('.description-error').text(response.responseJSON.errors.description);
                }
                $('.otsbtn').show();
                $('.otpbtn').hide(); 
            }
        });
    });
</script>