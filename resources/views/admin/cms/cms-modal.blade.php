<form class="editcmsmodalform">
    @csrf
    <input type="hidden" name="id" value="{{$lists->id}}">
    <div class="modal-header pd-x-20">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold title">
            {{$lists->title ?? ''}}
        </h6>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body pd-20 ">
        <div class="row mg-b-25">
            @if($lists->id!=3)
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Title <span class="error">*</span></label>
                    <input type="text" class="form-control" value="{{ old('title', $lists->title) }}" name="title"
                        placeholder="Title Here...">
                        <span class="error title-error"><span>
                </div>
            </div>
            @endif
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Description <span class="error">*</span></label>
                    <textarea class="form-control" name="description">{{ old('title', $lists->description) }}</textarea>      
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-center">
        <button type="submit" id="Msvbtn" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Update & Proceed</button>
        <button type="button" disabled id="Mprcbtn" style="display:none;" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>
<script>
    $('.editcmsmodalform').on('submit',function(e){
        e.preventDefault();
        $('#Msvbtn').hide();
        $('#Mprcbtn').show();
        $('.error').html('');
        $.ajax({
            data:new FormData(this),
            url:@json(route('admin.updatecmsmodal')),
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                toastr.success(data.success);
                $('#Msvbtn').show();
                $('#Mprcbtn').hide();
            },
            error:function(response){            
                if(response.responseJSON.errors.title!== undefined){
                    $('.title-error').text(response.responseJSON.errors.title);
                }  
                if(response.responseJSON.errors.description!== undefined){
                    $('.description-error').text(response.responseJSON.errors.description);
                }
                $('#Msvbtn').show();
                $('#Mprcbtn').hide(); 
            }
        });
    });
</script>