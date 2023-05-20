<form class="updateinformation">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Other Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            {{-- <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Qualification</small>
                <select class="form-control chosen-select" name="qualification">
                    @foreach($qualifications as $qualification)
                    <option value="{{$qualification->id ?? 0}}" @selected($expert->highest_qualification==$qualification->id) >{{$qualification->title ?? ''}}</option>
                    @endforeach
                </select>            
                <small class="error qualification-error"></small>
            </div> --}}
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Company Name</small>
                <input type="text" name="company_name" class="form-control" value="{{$expert->compnay_name}}">
                <small class="error company-error"></small>
            </div>
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Currently Working</small>
                <select class="form-control chosen-select" name="currently_working">
                    @foreach($workings as $working)
                    <option value="{{$working->id ?? 0}}" @selected($expert->currently_working_as==$working->id) >{{$working->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error working-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">Role</small>
                <select class="form-control chosen-select" name="role[]" onchange="getRoleTypeData(this.value)">
                    @foreach($roles as $role)
                    <option value="{{$role->id ?? 0}}" @selected(in_array($role->id,$roleArr)) >{{$role->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error role-error"></small>
            </div>
            <div class="col-12 otherrolebox" style="display: {{$expert->roles[0]->role==27?'':'none'}};">            
                <small for="exampleFormControlInput1" class="form-label">Other Role</small>
                <input type="text" name="other_role" placeholder="Write Other Role Here..." class="form-control" value="{{$expert->roles[0]->other_role ?? ''}}">
                <small class="error session-error"></small>
            </div>
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Take Session (Per Week)</small>
                <input type="number" name="take_session" class="form-control" value="{{$expert->take_session}}">
                <small class="error session-error"></small>
            </div>
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Experience (IN YEARS)</small>
                <input type="number" name="experience" class="form-control" value="{{$expert->experience}}">
                <small class="error experience-error"></small>
            </div>
            {{-- <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Charges (Per Hour)</small>
                <input type="number" name="charge" class="form-control" value="{{$expert->charge}}">
                <small class="error charge-error"></small>
            </div> --}}
            <div class="col-12">            
                <small for="exampleFormControlInput1" class="form-label">Linkedin</small>
                <input type="text" name="linkedin" class="form-control" value="{{$expert->linkedin}}">
                <small class="error linkedin-error"></small>
            </div>
            <div class="col-12">            
                <small for="exampleFormControlInput1" class="form-label">Instagram</small>
                <input type="text" name="instagram" class="form-control" value="{{$expert->instagram}}">
                <small class="error instagram-error"></small>
            </div>
            <div class="col-12">            
                <small for="exampleFormControlInput1" class="form-label">Youtube Channel</small>
                <input type="text" name="youtube_channel" class="form-control" value="{{$expert->youtube_channel_link}}">
                <small class="error youtube-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">Area of Expertise</small>
                <select class="form-control chosen-select" multiple name="expertises[]">
                    @foreach($expertise as $expertis)
                    <option value="{{$expertis->id ?? 0}}" @selected(in_array($expertis->id,$expertiseArr)) >{{$expertis->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error expertises-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">Language</small>
                <select class="form-control chosen-select" multiple name="languages[]">
                    @foreach($languages as $language)
                    <option value="{{$language->id ?? 0}}" @selected(in_array($language->id,$languagesArr)) >{{$language->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error languages-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">Industries</small>
                <select class="form-control chosen-select" multiple name="industries[]">
                    <option value="0">Choose Industries</option>
                    @foreach($industries as $industrie)
                    <option value="{{$industrie->id ?? 0}}" @selected(in_array($industrie->id,$industriesArr))>{{$industrie->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error industries-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlTextarea1" class="form-label">Bio</small>
                <textarea class="form-control summernote" name="bio" id="exampleFormControlTextarea1" rows="3">{{$expert->bio ?? ''}}</textarea>
                <small class="error bio-error"></small>
            </div>
            {{-- <div class="col-12">
                <small for="exampleFormControlTextarea1" class="form-label">Strengths</small>
                <textarea class="form-control summernote2" name="strengths" id="exampleFormControlTextarea1" rows="3">{{$expert->your_strength ?? ''}}</textarea>
                <small class="error strengths-error"></small>
            </div> --}}
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
    $('.summernote2').summernote({
        height: 100,
        toolbar: []
    });
    function getRoleTypeData(data){
        if(data==27){ $('.otherrolebox').show();}
        else{ $('.otherrolebox').hide(); }
    }
    $(".chosen-select").chosen();
    $('.updateinformation').on('submit',function(e){
        e.preventDefault();
        $('.otsbtn').hide();
        $('.otpbtn').show();
        $('.error').html('');
        $.ajax({
            data:new FormData(this),
            url:@json(route('expert.updateotherinformation')),
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
            },
            error:function(response){            
                if(response.responseJSON.errors.role!== undefined){
                    $('.role-error').text(response.responseJSON.errors.role);
                }  
                if(response.responseJSON.errors.currently_working!== undefined){
                    $('.working-error').text(response.responseJSON.errors.currently_working);
                }
                if(response.responseJSON.errors.strengths!== undefined){
                    $('.strengths-error').text(response.responseJSON.errors.strengths);
                }
                if(response.responseJSON.errors.expertises!== undefined){
                    $('.expertises-error').text(response.responseJSON.errors.expertises);
                }
                if(response.responseJSON.errors.languages!== undefined){
                    $('.languages-error').text(response.responseJSON.errors.languages);
                }
                if(response.responseJSON.errors.industries!== undefined){
                    $('.industries-error').text(response.responseJSON.errors.industries);
                }
                if(response.responseJSON.errors.bio!== undefined){
                    $('.bio-error').text(response.responseJSON.errors.bio);
                }
                $('.otsbtn').show();
                $('.otpbtn').hide(); 
            }
        });
    });
</script>