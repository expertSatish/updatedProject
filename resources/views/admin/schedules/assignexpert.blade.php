<form method="post" class="updateform">
    @csrf
    <input type="hidden" name="id" value="{{$lists->id}}">
    <div class="row mg-b-25">
        <div class="col-lg-12">
            <label>Do you want to assign an expert in this booking <b>#{{ $lists->booking_id }}</b> schedule?</label>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <select class="form-control chosen" name="expert" onchange="assignexpertinfo(this.value)">
                    <option value="">Assign Expert</option>
                    @foreach($experts as $expert)
                    <option value="{{$expert->id}}">{{$expert->name}} ({{$expert->expertise->title ?? '#'.$expert->user_id}})</option>
                    @endforeach
                </select>
                <span class="error title-error"><span>
            </div>
        </div>
        <div class="col-lg-12">
            <label><b>NOTE:</b> <small>If you assign this booking to another expert, then this slot will be entered in the records with the new booking.</small></label>
        </div>
        <div class="col-lg-12 chargesbox"></div>
    </div>
    <div class="form-layout-footer text-right">
        <button class="btn btn-dark esvbtn" disabled>Confirm & Assign</button>
        <button type="button" style="display:none;" disabled class="btn btn-dark eprcbtn"><i
                class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>
<script>
    $('.chosen').chosen();
    function assignexpertinfo(expert){
        if(expert > 0){
            $('.chargesbox').html('<center><i class="fad fa-spinner-third fa-spin" style="font-size: 30px;margin-top: 50px;"></i></center>');
            $.ajax({
                data:{_token:XCSRF_Token,expert:expert,booking:@json($lists->id)},
                url:@json(route('admin.schedules.assignexpertinfo')),
                method:'POST',
                dataType:'Json',
                success:function(data){                
                    $('.chargesbox').html(data.html);
                    if(data.availability>0){ 
                        $('.esvbtn').removeAttr('disabled');
                    }
                    if(data.availability==0){ 
                        $('.esvbtn').attr('disabled','disabled');
                    }
                }
            });
        }
        if(expert=='' || expert==0){
            $('.chargesbox').html('');
            $('.esvbtn').attr('disabled','disabled');
        }
    }
    $('.updateform').on('submit',function(e){
        $('.error').html('');
        $('.esvbtn').hide();
        $('.eprcbtn').show();
        e.preventDefault();
        $.ajax({
            data:new FormData(this),
            url:@json(route('admin.schedules.reassignexpert')),
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                toastr.success(data.success);
                window.location.href=@json(route('admin.schedules.booked',['booked'=>'booked']));
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