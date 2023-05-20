<form method="post" class="updateform">
    @csrf
    <input type="hidden" name="id" value="{{$lists->id}}">
    <input type="hidden" name="oldtitle" value="{{$lists->title}}">
    <div class="row mg-b-25">

        <div class="col-lg-12">

            <div class="form-group">

                <label>Catgeory <span class="error">*</span></label>
               
                <select name="category" id="category" class="form-control">
                    <option value="">Choose Category</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" @selected($category->id==$lists->category_id)>{{$category->title}}</option>
                    @endforeach
                </select>
                
                
                @error('category')
                    <span class="error">{{ $message }}<span>
                        @enderror

            </div>

        </div>

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

                <label>Alias <span class="error">*</span></label>

                <input type="text" class="form-control" value="{{ old('alias', $lists->alias) }}" name="alias"
                    readonly placeholder="Alias Here...">
                   

            </div>

        </div>

    </div>

    <div class="form-layout-footer text-right">

        <button class="btn btn-dark esvbtn">Confirm & Update</button>
        <button type="button" style="display:none;" class="btn btn-dark eprcbtn"><i
                class="fad fa-spinner-third fa-spin"></i> Loading...</button>
        <a href="{{route('admin.expertise')}}" class="btn btn-danger">Cancel</a>
    </div><!-- form-layout-footer -->

</form>
<script>
    $('.updateform').on('submit',function(e){
        $('.error').html('');
        $('.esvbtn').hide();
        $('.eprcbtn').show();
        e.preventDefault();
        $.ajax({
            data:new FormData(this),
            url:@json(route('admin.expertise.update')),
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                loadingbox();
                $('.offcanvas-body').load(@json(route('admin.expertise.edit',['id'=>$lists->id])));
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