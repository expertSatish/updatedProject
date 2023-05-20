<form class="updatebank">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bank Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <small for="exampleFormControlInput1" class="form-label">Account Holder Name</small>
                <input type="text" name="holder_name" class="form-control" value="{{$expert->holder_name}}">
                <small class="error holder_name-error"></small>
            </div>
            <div class="col-6">
                <small for="exampleFormControlInput1" class="form-label">Bank Name</small>
                <input type="text" name="bank_name" class="form-control" value="{{$expert->bank_name}}">
                <small class="error bank_name-error"></small>
            </div>
            <div class="col-6">
                <small for="exampleFormControlInput1" class="form-label">IFSC Code</small>
                <input type="text" name="ifsc" class="form-control" value="{{$expert->ifsc}}">

                <small class="error ifsc-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">Account Number</small>
                <input type="text" name="account_no" class="form-control" value="{{$expert->account_no}}">
                <small class="error account_no-error"></small>
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
$('.summernote2').summernote({
    height: 100,
    toolbar: []
});

function getRoleTypeData(data) {
    if (data == 27) {
        $('.otherrolebox').show();
    } else {
        $('.otherrolebox').hide();
    }
}
$(".chosen-select").chosen();
$('.updatebank').on('submit', function(e) {
    e.preventDefault();
    $('.otsbtn').hide();
    $('.otpbtn').show();
    $('.error').html('');
    $.ajax({
        data: new FormData(this),
        url: @json(route('expert.updatebankDetails')),
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
            if (response.responseJSON.errors.holder_name !== undefined) {
                $('.holder_name-error').text(response.responseJSON.errors.holder_name);
            }
            if (response.responseJSON.errors.bank_name !== undefined) {
                $('.bank_name-error').text(response.responseJSON.errors.bank_name);
            }
            if (response.responseJSON.errors.account_no !== undefined) {
                $('.account_no-error').text(response.responseJSON.errors.account_no);
            }
            if (response.responseJSON.errors.ifsc !== undefined) {
                $('.ifsc-error').text(response.responseJSON.errors.ifsc);
            }
            $('.otsbtn').show();
            $('.otpbtn').hide();
        }
    });
});
</script>