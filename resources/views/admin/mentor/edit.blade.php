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
                <textarea name="description" rows="3" class="form-control" placeholder="Write something here...">{{ old('description', $lists->description) }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}<span>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-layout-footer text-right">
        <button class="btn btn-dark esvbtn">Confirm & Update</button>
        <button type="button" style="display:none;" class="btn btn-dark eprcbtn"><i
                class="fad fa-spinner-third fa-spin"></i> Loading...</button>
        <a href="{{route('admin.mentor')}}" class="btn btn-danger">Cancel</a>
    </div>
</form>
<script>
    $('.updateform').on('submit',function(e){
        $('.error').html('');
        $('.esvbtn').hide();
        $('.eprcbtn').show();
        e.preventDefault();
        $.ajax({
            data:new FormData(this),
            url:@json(route('admin.updatementor')),
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                loadingbox();
                $('.offcanvas-body').load(@json(route('admin.editmentor',['id'=>$lists->id])));
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