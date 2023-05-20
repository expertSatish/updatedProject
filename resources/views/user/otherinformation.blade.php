<form class="updateuserinformation">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Other Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <small for="exampleFormControlInput1" class="form-label">Designation</small>
                <input type="text" name="designation" class="form-control" value="{{userinfo()->designation}}">

                <small class="error designation-error"></small>
            </div>
            <div class="col-6">
                <small for="exampleFormControlInput1" class="form-label">Industries</small>
                <select class="form-control chosen-select" name="industry">
                    @foreach($industries as $industrie)
                    <option value="{{$industrie->id ?? 0}}" @selected(userinfo()->industry==$industrie->id)
                        >{{$industrie->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error industry-error"></small>
            </div>
            <div class="col-6">
                <small for="exampleFormControlInput1" class="form-label">Company</small>
                <input type="text" name="company_name" class="form-control" value="{{userinfo()->company_name}}">
                <small class="error company_name-error"></small>
            </div>
            <div class="col-6">
                <small for="exampleFormControlInput1" class="form-label">Stage of StartUp</small>
                <input type="text" name="stage_of_startup" class="form-control"
                    value="{{userinfo()->stage_of_startup}}">
                <small class="error stage_of_startup-error"></small>
            </div>
            <div class="col-6">
                <small for="exampleFormControlTextarea1" class="form-label">GST Number</small>
                <input type="text" name="gst_number" class="form-control" value="{{userinfo()->gst_number}}">
                <small class="error gst_number-error"></small>
            </div>
            <div class="col-lg-12 mb-2">
                <label class="ms-2"><small>Select 3 Objectives which you wish to achieve</small></label>
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control chosen-select" multiple name="objectives[]">
                    
                </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-dark otsbtn">Update & Proceed</button>
        <button type="button" style="display: none;" class="btn btn-dark otpbtn disabled"><i
                class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>

<script>
$('.summernote').summernote({
    height: 100,
    toolbar: []
});
$(".chosen-select").chosen();
$('.updateuserinformation').on('submit', function(e) {
    e.preventDefault();
    $('.otsbtn').hide();
    $('.otpbtn').show();
    $('.error').html('');
    $.ajax({
        data: new FormData(this),
        url: @json(route('user.updateotherinformation')),
        method: 'POST',
        dataType: 'Json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            toastr.success(data.success);
            $('.otsbtn').show();
            $('.otpbtn').hide();
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        },
        error: function(response) {
            if (response.responseJSON.errors.designation !== undefined) {
                $('.designation-error').text(response.responseJSON.errors.designation);
            }
            if (response.responseJSON.errors.industry !== undefined) {
                $('.industry-error').text(response.responseJSON.errors.industry);
            }
            if (response.responseJSON.errors.company_name !== undefined) {
                $('.company_name-error').text(response.responseJSON.errors.company_name);
            }
            if (response.responseJSON.errors.stage_of_startup !== undefined) {
                $('.stage_of_startup-error').text(response.responseJSON.errors.stage_of_startup);
            }
            if (response.responseJSON.errors.gst_number !== undefined) {
                $('.gst_number-error').text(response.responseJSON.errors.gst_number);
            }
            $('.otsbtn').show();
            $('.otpbtn').hide();
        }
    });
});
</script>