<form class="updateinformation">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">What to expect</h5>
        <button type="button" onclick="window.location.reload();" class="btn-close" aria-label="Close"></button>
    </div>
    <div class="modal-body" style="overflow-y: auto; max-height: 430px;">
        @foreach ($whatexpects as $item)
        <div class="d-flex align-items-start InBox mb-2 prepopbox">
            <div>
                <input type="text" class="form-control" value="{{$item->description}}" required name="description[]" placeholder="Write something here..."> 
                <span class="d-block text-end small"><small>Max. words limit 15 word</small></span> 
            </div>
            <button type="button" class="btn btn-danger btn-md removeexpect" data-bs-removeid="{{$item->id}}" ><i class="fas fa-trash"></i></button>
        </div>
        @endforeach
        <div class="wexpertbox">
            <div class="d-flex align-items-start InBox mb-2">
                <div>
                    <input type="text" class="form-control" required name="description[]" placeholder="Write something here..."> 
                    <span class="d-block text-end small"><small>Max. words limit 15 word</small></span> 
                </div>
                <button type="button" class="btn btn-dark btn-md add"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-dark otsbtn">Confirm & Proceed</button>
        <button type="button" style="display: none;" class="btn btn-dark otpbtn disabled"><i class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>
<script>
    $('.add').on('click',function(){
        let box =  '<div class="d-flex align-items-start InBox mb-2"><div><input type="text" class="form-control" required name="description[]" placeholder="Write something here..."><span class="d-block text-end small"><small>Max. words limit 15 word</small></span> </div><button type="button" class="btn btn-danger btn-md remove"><i class="fas fa-trash"></i></button></div>';
        $('.updateinformation .wexpertbox').prepend(box);
        $('.remove').on('click',function(){
            $(this).parent('.InBox').remove();
        });
    });

    $('.removeexpect').on('click',function(){
        let removeid = $(this).attr('data-bs-removeid');
        let prepopbox = $(this).parent('.prepopbox');
        $.ajax({
            data:{_token:$('meta[name=csrf-token]').attr('content'),removeid:removeid},
            url:@json(route('expert.removewhatexpect')),
            method:'POST',
            dataType:'Json',
            success:function(data){
                prepopbox.remove();
            }
        });
    }); 
    
    $('.updateinformation').on('submit',function(e){
        e.preventDefault();
        $('.otsbtn').hide();
        $('.otpbtn').show();
        $('.error').html('');
        $.ajax({
            data:new FormData(this),
            url:@json(route('expert.savewhatexpect')),
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                toastr.success(data.success);
                $('.updateinformation').trigger('reset');
                $('.otsbtn').show();
                $('.otpbtn').hide();
                $('.remove').parent('.InBox').remove();
                window.location.reload();
            },
            error:function(response){            
                if(response.responseJSON.errors.description!== undefined){
                    $('.description-error').text(response.responseJSON.errors.description);
                }  
                $('.otsbtn').show();
                $('.otpbtn').hide(); 
            }
        });
    });
</script>