<div class="SendInquiryPopup" style="display:none">
    <div class="accordion-header accordion-button" id="headingOne" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Message <button type="button" class="btn-close" aria-label="Close"></button></div>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
        <form class="MsgMain composemessage" id="sendenq">
            @csrf
            <input type="hidden" name="sendreply" id="sendreply">
            <div class="MsgHead" style="display:{{request()->segment(2)!='message'?'none':''}}">
                <textarea name="message" style="display:none;"></textarea>
                <div class="ToBox">
                    <div>
                        <span class="text-secondary me-2">To</span>
                        <input type="text" class="form-control" autocomplete="off" id="to" name="to_recipient_email" placeholder="">
                    </div>
                    {{-- <div id="cc" style="display:none">
                        <span class="text-secondary me-2">Cc</span>
                        <input type="text" class="form-control" autocomplete="off" name="cc_email" placeholder="">
                        <a href="javascript:void(0);" class="ccclose"><i class="fal fa-times"></i></a>
                    </div>
                    <a href="#cc" class="text-secondary ccbox">Cc</a>
                    <div id="bcc" style="display:none">
                        <span class="text-secondary me-2">Bcc</span>
                        <input type="text" class="form-control" autocomplete="off" name="bcc_email" placeholder="">
                        <a href="javascript:void(0);" class="bccclose"><i class="fal fa-times"></i></a>
                    </div>
                    <a href="#bcc" class="text-secondary bccbox">Bcc</a> --}}
                </div>
                <input type="text" style="display:none;" class="form-control" autocomplete="off" id="subject" name="subject" placeholder="Subject">
            </div>
            <div class="MsgBox">
                <div id="fake_textarea" class="MsgBoxType" contenteditable="true"></div>
                <div class="row Attach"></div>
            </div>
            <div class="MsgFoot">
                <button type="submit" class="btn btn-thm3 mt-0 cmsbtn"><i class="fal fa-paper-plane m-0 me-1"></i> Send</button>
                <button type="button" style="display: none" disabled class="btn btn-thm4 cmpbtn mt-0 svbtn"><i class="fad fa-spinner-third fa-spin m-0 me-1"></i> Loading...</button>
                <button type="button" style="display:none;" disabled class="btn btn-thm3 mt-0 prcbtn"><i class="fal fa-spinner m-0 me-1"></i> Processing...</button>
                <label class="sws-top sws-bounce mailfont" data-title="Formatting option"><i class="fal fa-font"></i></label>
                <div class="formatting">
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Bold" onclick="f1()"><i class="fas fa-bold"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Italic Text" onclick="f2()"><i class="far fa-italic"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Underline" onclick="f10()"><i class="far fa-underline"></i></a>
                    {{-- <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="text-size" data-bs-toggle="dropdown" aria-expanded="false" class="sws-top sws-bounce" data-title="Text Size"><i class="far fa-text-size"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="text-size">
                            <li><a href="javascript:void(0)" onclick="f11()">Small</a></li>
                            <li><a href="javascript:void(0)" onclick="f12()" class="h6">Normal</a></li>
                            <li><a href="javascript:void(0)" onclick="f13()" class="h4">Large</a></li>
                            <li><a href="javascript:void(0)" onclick="f14()" class="h2">Huge</a></li>
                        </ul>
                    </div> --}}
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Left Align" onclick="f3()"><i class="far fa-align-left"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Center Align" onclick="f4()"><i class="far fa-align-center"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Right Text" onclick="f5()"><i class="far fa-align-right"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Uppercase Text" onclick="f6()"><i class="far fa-font"></i><i class="far fa-font"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Lowercase Text" onclick="f7()">a</a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Capitalize Text" onclick="f8()"><i class="far fa-font-case"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Clear Text" onclick="f9()"><i class="far fa-file"></i></a>
                </div>
                <label class="sws-top sws-bounce attfileb" data-title="Attach files" ><i class="fal fa-paperclip me-1"></i><input type="file" id="attachment"  name="attachment[]" multiple class="d-none"></label>
                {{-- <label class="sws-top sws-bounce discarddraft" data-title="Discard draft"><i class="fal fa-trash-alt me-1"></i></label> --}}
            </div>
        </form>
    </div>
</div>
<style>
    .defaultimgcss{
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        width: 100%;
    }
</style>
<script type="text/javascript">
$('body').on('click','.SendMessage',function(){
    $('.SendInquiryPopup').fadeIn();
    $('.SendInquiryPopup .accordion-collapse').addClass('show');
    $('.SendInquiryPopup .accordion-header').removeClass('collapsed');
});
$('body').on('click','.SendInquiryPopup .accordion-header .btn-close',function(){
    $('.SendInquiryPopup').hide();
    $('.SendInquiryPopup .accordion-header').removeClass('collapsed');
});

$('body').on('click','.mailfont',function(){
    if ($('.formatting').hasClass('active')){
        $('.formatting').removeClass('active');
        $(this).removeClass('active');
    } else {
        $('.formatting').addClass('active');
        $(this).addClass('active');
    }
});
$('body').on('click','.ccbox',function(){
    $('.ccbox').hide();
    $('#cc').show();
});
$('body').on('click','.ccbox',function(){
    $('.ccbox').hide();
    $('#cc').show();
});
$('body').on('click','.bccbox',function(){
    $('.bccbox').hide();
    $('#bcc').show();
});
$('.ccclose').on('click',function(){
    $('.ccbox').show();
    $('#cc').hide();
    $('#cc').val('');
});
$('.bccclose').on('click',function(){
    $('.bccbox').show();
    $('#bcc').hide();
    $('#bcc').val('');
});
// $('body').on('click','#subject',function(){
//     if($('#cc').val()==''){
//         $('.ccbox').show();
//         $('#cc').hide();
//     }
//     if($('#bcc').val()==''){
//         $('.bccbox').show();
//         $('#bcc').hide();
//     }
// });
$('body').on('click','.discarddraft',function(){
    $('.SendInquiryPopup').hide();
    $('#sendenq').trigger("reset");
    $('#fake_textarea').html('');
    $('.ccbox').show();
    $('#cc').hide();  
    $('.bccbox').show();
    $('#bcc').hide();          
});
$("body").on("click",".removeattach",function(){ 
    $(this).parents(".attachbox").remove();
});

$('.composemessage').on('submit',function(e){
    e.preventDefault();
    $('.cmsbtn').hide();
    $('.cmpbtn').show();
    let formdata = new FormData(this);
    formdata.append('message',$('#fake_textarea').html());
    $.ajax({
        data:formdata,
        url:@json(route('expert.sendmessage')),
        method:'POST',
        dataType:'JSON',
        cache:false,
        contentType:false,
        processData:false,
        success:function(success){
            $('.composemessage').trigger('reset');
            $('.Attach').html('');
            toastr.success(success.message);
            // setTimeout(() => {
            //     window.location.href=success.redirect;
            // }, 1000);
            $('#fake_textarea').html('');
            $('.cmsbtn').show();
            $('.cmpbtn').hide();
        },
        error:function(response){
            if(response.responseJSON.errors.to_recipient_email!== undefined){
                toastr.error(response.responseJSON.errors.to_recipient_email);
            }
            if(response.responseJSON.errors.subject!== undefined){
                toastr.error(response.responseJSON.errors.subject);
            }
            if(response.responseJSON.errors.message!== undefined){
                toastr.error(response.responseJSON.errors.message);
            }
            $('.cmsbtn').show();
            $('.cmpbtn').hide();
        }
    });
});
$(function() {    
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
        var filesAmount = input.files.length;
        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function(event) {                
                // $($.parseHTML('<div class="col-md-3 prechoosimg"><img class="defaultimgcss" src="'+event.target.result+'"></div>')).appendTo(placeToInsertImagePreview);
            }
            let Filename = input.files[i].name;
            let Html ='';
            Html +='<div class="prechoosimg mb-2"><i class="fad fa-circle" style="font-size: 9px"></i> '+Filename+' <i class="fal fa-check text-success"></i></div>';
            $('.Attach').append(Html);
            reader.readAsDataURL(input.files[i]);
        }
        }
    };
    $('#attachment').on('change', function() {
    $('.prechoosimg').remove();
    imagesPreview(this, 'div.Attach');
    });
});
</script>