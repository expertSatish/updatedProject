<form class="updateinformation">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-12">            
                <small for="exampleFormControlInput1" class="form-label">Profile Name</small>
                <input type="text" class="form-control" value="{{userinfo()->name}}" name="profile_name" placeholder="Change Profile Name">         
                <small class="error name-error"></small>
            </div>
            <div class="col-12">            
                <small for="exampleFormControlInput1" class="form-label">Register Email</small>
                <input type="text" class="form-control" value="{{userinfo()->email}}" name="email" placeholder="Change Register Email">         
                <small class="error email-error"></small>
            </div>
            <div class="col-md-6">            
                <small for="exampleFormControlInput1" class="form-label">Register Mobile</small>
                <div class="CountryCode">                   
                    <a class="btn dropdown-toggle inputtext noeditt" contenteditable="false" readonly="readonly" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span id="CountryName">+{{$ccode->phonecode ?? ''}}</span></a>
                    <ul class="dropdown-menu countrylist">
                        <x-country-list/>
                    </ul> 
                    <input type="hidden" name="ccode" value="{{$ccode->phonecode ?? 0}}">
                    <input type="text" class="inputtext form-control" value="{{userinfo()->mobile}}" name="mobile" placeholder="Change Register Mobile">         
                </div>
                <small class="error mobile-error"></small>
            </div>
            <div class="col-md-6">            
                <small for="exampleFormControlInput1" class="form-label">DOB</small>
                <input type="date" class="form-control flatpickr" value="{{userinfo()->dob}}" name="dob" placeholder="DOB">         
                <small class="error dob-error"></small>
            </div>
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Gender</small>
                <select class="form-control chosen-select" name="gender">
                    <option value="0" @selected(userinfo()->gender==0)>Other</option>
                    <option value="1" @selected(userinfo()->gender==1)>Male</option>
                    <option value="2" @selected(userinfo()->gender==2)>Female</option>                    
                </select>            
                <small class="error gender-error"></small>
            </div>
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Country</small>
                <select class="form-control chosen-select" name="country" onchange="State(this.value)">
                    <option value="">Choose Country</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id ?? ''}}" @selected(userinfo()->country==$country->id) >{{$country->name ?? '-----'}}</option>
                    @endforeach
                </select>            
                <small class="error country-error"></small>
            </div>
            <div class="col-6 statebox">            
                <small for="exampleFormControlInput1" class="form-label">State</small>
                <select class="form-control chosen-select" name="state">
                    <option value="">Choose State</option>
                </select>            
                <small class="error state-error"></small>
            </div>
            <div class="col-6 citybox">            
                <small for="exampleFormControlInput1" class="form-label">City</small>
                <select class="form-control chosen-select" name="city">
                    <option value="">Choose City</option>
                </select>            
                <small class="error city-error"></small>
            </div>
            <div class="col-md-7">            
                <small for="exampleFormControlInput1" class="form-label">Profile Image</small>
                <input type="file" class="form-control" onchange="loadFile(event)" name="profile">
                <small>Best Image Size: 476px * 483px</small>         
                <small class="error image-error"></small>
            </div>
            <div class="col-md-5">
                <div class="PhotoBox imgbox me-4">
                    <label>
                        @php 
                            $class="mt-2";
                            $id='output';
                            $alt =userinfo()->name ?? '';
                            $path = '/uploads/user/';
                            $image=userinfo()->profile;
                        @endphp
                        @if (in_array(checkimagetype($image), ['SVG','WEBP']) && file_exists(public_path($path . $image)))
                            <img loading="lazy" src="{{ asset($path . $image) }}" class="{{$class ?? ''}}" id="{{ $id ?? '' }}" alt="{{ $alt }}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
                        @elseif(file_exists(public_path($path . $image . '.webp')))
                            <img loading="lazy" src="{{ asset($path . 'jpg/'. $image . '.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
                        @elseif(file_exists(public_path($path . 'jpg/' . $image . '.jpg')))
                            <img loading="lazy" src="{{ asset($path . 'jpg/'. $image . '.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
                        @else
                            <img loading="lazy" src="{{ asset('frontend/image/no-img.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
                        @endif
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-dark otsbtn">Confirm & Proceed</button>
        <button type="button" style="display: none;" class="btn btn-dark otpbtn disabled"><i class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>

<!-- summernote css/js -->

<style>
.imgbox img{border: 1px solid #ddd;padding: 5px;width: 100px!important;}
.CountryCode{display:flex;width:100%}
.CountryCode a.inputtext{display:flex;align-items:center;justify-content:center;line-height:normal!important;font-size:14px;min-width:60px!important;width:auto!important;padding-right:5px;border-radius:.25rem 0 0 .25rem!important;border: 1px solid #ced4da;padding:6px;}
.CountryCode a.inputtext span:after,.CountryCode a:after{display:none!important}
.CountryCode a.inputtext~.inputtext{border-radius:0 .25rem .25rem 0!important;border-left:none!important;height:auto;padding:.375rem .75rem;font-size: 1rem;}
.CountryCode a.inputtext[contenteditable="true"]:after{display:block}
.CountryCode a.inputtext[contenteditable="true"]{width:80px}
.CountryCode>.countrylist{padding:0;max-height:200px;overflow:auto;background:var(--white);right:auto!important;left:0!important}
.CountryCode a span{font-size:16px!important}
.countrylist li{padding:5px 12px;cursor:pointer;font-size:14px;padding-right:70px;white-space:nowrap}
.countrylist li i{margin-right:5px;position:static!important}
.countrylist li span{font-size:12px;color:rgb(var(--blackrgb)/.5);position:absolute;right:12px}
.countrylist li:hover{background:rgb(var(--blackrgb)/.08)}
</style>
<script>flatpickr(".flatpickr",{altInput:true, altFormat:"F j, Y", dateFormat:"Y-m-d"});</script>
<script>
    $(document).ready(function(){
        if(@json(userinfo()->country > 0)){ State(@json(userinfo()->country)); }
        $('.CountryCode .dropdown-menu').find('li').click(function(e) {
            e.preventDefault();
            var spa = $(this).data('text');
            $('.CountryCode #CountryName').text(spa);
            $('input[name=ccode]').val(spa.substr(1));
        });
        
    });
    $(".chosen-select").chosen();
    $('.updateinformation').on('submit',function(e){
        e.preventDefault();
        $('.otsbtn').hide();
        $('.otpbtn').show();
        $('.error').html('');
        $.ajax({
            data:new FormData(this),
            url:@json(route('user.updateprofile')),
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
                if(response.responseJSON.errors.name!== undefined){
                    $('.name-error').text(response.responseJSON.errors.name);
                } 
                if(response.responseJSON.errors.email!== undefined){
                    $('.email-error').text(response.responseJSON.errors.email);
                } 
                if(response.responseJSON.errors.mobile!== undefined){
                    $('.mobile-error').text(response.responseJSON.errors.mobile);
                } 
                if(response.responseJSON.errors.dob!== undefined){
                    $('.dob-error').text(response.responseJSON.errors.dob);
                }
                if(response.responseJSON.errors.gender!== undefined){
                    $('.gender-error').text(response.responseJSON.errors.gender);
                }  
                if(response.responseJSON.errors.country!== undefined){
                    $('.country-error').text(response.responseJSON.errors.country);
                }
                if(response.responseJSON.errors.state!== undefined){
                    $('.state-error').text(response.responseJSON.errors.state);
                }
                if(response.responseJSON.errors.city!== undefined){
                    $('.city-error').text(response.responseJSON.errors.city);
                }  
                $('.otsbtn').show();
                $('.otpbtn').hide(); 
            }
        });
    });
    

    function State(value){
        $.ajax({
            data:{_token:$('meta[name=csrf-token]').attr('content'),country:value},
            url:@json(route('user.countrystates')),
            method:'POST',
            dataType:'Json',
            success:function(data){
                let Html = '';
                Html +='<small for="exampleFormControlInput1" class="form-label">State</small>';
                Html +='<select class="form-control chosen-select"  onchange="City(this.value)"  name="state">';
                    Html += data.data;
                Html +='</select>';          
                Html +='<small class="error state-error"></small>';
                $('.statebox').html(Html);
                $(".chosen-select").chosen();
                if(@json(userinfo()->state > 0)){ City(@json(userinfo()->state)); }
            }
        });
    }
    function City(value){
        $.ajax({
            data:{_token:$('meta[name=csrf-token]').attr('content'),state:value},
            url:@json(route('user.statecities')),
            method:'POST',
            dataType:'Json',
            success:function(data){
                let Html = '';
                Html +='<small for="exampleFormControlInput2" class="form-label">City</small>';
                Html +='<select class="form-control chosen-select" name="city">';
                    Html += data.data;
                Html +='</select>';          
                Html +='<small class="error state-error"></small>';
                $('.citybox').html(Html);
                $(".chosen-select").chosen();
            }
        });
    }
    $('.countrylist .SearchConCode').on( "keyup", function() {
        val = $(this).val().toLowerCase();
        $(".countrylist li").each(function () {
            $(this).toggle($(this).text().toLowerCase().includes(val));
        });
    });
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>