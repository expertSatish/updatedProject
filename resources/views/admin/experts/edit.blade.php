@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

        <div class="col-md-6">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="breadcrumb-item" href="{{ route('admin.experts') }}">Experts</a>
                <span class="breadcrumb-item active">Edit Experts</span>
            </nav>
        </div>

        <div class="col-md-6">
            <div class="text-right">
                <a href="{{route('admin.experts')}}" class="btn btn-secondary btn-sm btn-with-icon">
                    <div class="ht-40">
                        <span class="icon wd-40"><i class="fa fa-backward"></i></span>
                        <span class="pd-x-15">Back</span>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <form method="POST" action="{{route('admin.experts.update')}}" enctype="multipart/form-data" class="table-wrapper sequenceform">
                @csrf
                <input type="hidden" name="preid" id="preid" value="{{$lists->id}}">
                <div class="row mg-b-25">
                    <div class="col-md-12 mb-4">
                        <h6 class="card-title tx-uppercase tx-12 mg-b-0"><u>Basic Information</u></h6>
                    </div>
                    <div class="col-md-4">            
                        <div class="form-group">            
                            <small>Expert Id <span class="error">*</span></small>            
                            <input type="text" readonly class="form-control" value="{{ $lists->user_id }}" name="title" placeholder="Title Here...">      
                        </div>            
                    </div> 
                    <div class="col-md-4">            
                        <div class="form-group">            
                            <small>Expert Name <span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('name',$lists->name) }}" name="name"
                                placeholder="Expert Name Here...">            
                                @error('name') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-md-1" style="margin-right: -27px!important;">            
                        <div class="form-group">            
                            <small>&nbsp;</small>            
                            <input type="number" class="form-control" value="{{ old('ccode',$lists->ccode) }}" name="ccode"
                                placeholder="Phone Code Here...">            
                            @error('ccode') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-md-3">            
                        <div class="form-group">            
                            <small>Expert Mobile <span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('mobile',$lists->mobile) }}" name="mobile"
                                placeholder="Expert Mobile Here...">            
                                @error('mobile') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>  
                    <div class="col-md-4">            
                        <div class="form-group">            
                            <small for="exampleFormControlInput1" class="form-label">Expert Email <span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('email',$lists->email) }}" name="email"
                                placeholder="Expert Email Here...">            
                                @error('email') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-md-4">            
                        <div class="form-group">            
                            <small for="exampleFormControlInput1" class="form-label">User Gender </small>            
                            <select name="gender" class="form-select" id="gender">
                                <option value="1" {{old('gender',$lists->gender)==1?'selected':''}} >Male</option>    
                                <option value="2" {{old('gender',$lists->gender)==2?'selected':''}} >Female</option>    
                                <option value="0" {{old('gender',$lists->gender)==0?'selected':''}} >Other</option>    
                            </select>      
                            @error('gender') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div> 
                    <div class="col-md-4">            
                        <small for="exampleFormControlInput1" class="form-label">Country</small>
                        <select class="form-control chosen-select" name="country" onchange="State(this.value)">
                            <option value="">Choose Country</option>
                            @foreach($countries as $country)
                            <option value="{{$country->id ?? ''}}" @selected($lists->country==$country->id) >{{$country->name ?? '-----'}}</option>
                            @endforeach
                        </select>    
                        @error('country') <span class="text-danger error">{{$message}}</span>  @enderror    
                    </div>
                    <div class="col-md-4 statebox">            
                        <small for="exampleFormControlInput1" class="form-label">State</small>
                        <select class="form-control chosen-select" name="state">
                            <option value="">Choose State</option>
                        </select>     
                        @error('state') <span class="text-danger error">{{$message}}</span>  @enderror         
                    </div>
                    <div class="col-md-4 citybox">            
                        <small for="exampleFormControlInput1" class="form-label">City</small>
                        <select class="form-control chosen-select" name="city">
                            <option value="">Choose City</option>
                        </select>  
                        @error('city') <span class="text-danger error">{{$message}}</span>  @enderror            
                    </div>
                    <div class="col-md-12 mt-3 mb-4">            
                        <small for="exampleFormControlInput1" class="form-label">Current Address</small>
                        <textarea name="address" class="form-control" placeholder="Current Address Here">{{$lists->address}}</textarea>
                        @error('address') <span class="text-danger error">{{$message}}</span>  @enderror    
                    </div>
                    <hr>
                    <div class="col-md-12 mb-2">
                        <h6 class="card-title tx-uppercase tx-12 mg-b-0"><u>Profile Information</u></h6>
                    </div>
                    <div class="col-md-12 mt-4">
                        <small for="exampleFormControlInput1" class="form-label">Expert BIO</small>
                        <textarea class="form-control" id="summernote" rows="5" name="bio" placeholder="Write Bio here...">{{ old('bio',$lists->bio) }}</textarea>
                        @error('bio') <span class="text-danger error">{{$message}}</span>  @enderror 
                    </div>
                    <div class="col-md-4 mt-4">            
                        <small for="exampleFormControlInput1" class="form-label">Profile Image</small>
                        <input type="file" class="form-control" onchange="loadFile(event)" name="profile">
                        <small>Best Image Size: 476px * 483px</small>  
                        @error('profile')
                            <br><span class="error">{{$message}}</span>
                        @enderror       
                    </div>
                    <div class="col-md-2 mt-4">
                        <div class="PhotoBox imgbox me-4">
                            <label>
                                @php 
                                    $class="w-100 defaultimgcss";
                                    $id='output';
                                    $alt =$lists->name ?? '';
                                    $path = '/uploads/expert/';
                                    $image=$lists->profile;
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
                    <hr>                    
                    <div class="col-md-12 my-4">
                        
                        <h6 class="card-title tx-uppercase tx-12 mg-b-0"><u>Other Information</u></h6>
                    </div>
                    <div class="col-md-3">            
                        <div class="form-group">            
                            <small>Company Name <span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('company_name',$lists->compnay_name) }}" name="company_name"
                                placeholder="Company Name Here...">            
                                @error('company_name') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div> 
                    </div>                    
                    <div class="col-md-3">            
                        <div class="form-group">            
                            <small>Experience (IN YEAR) </small>            
                            <input type="number" min="1" class="form-control" value="{{ old('experience',$lists->experience) }}" name="experience"
                                placeholder="Experience (IN YEAR)...">            
                                @error('experience') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>   
                    </div>
                    <div class="col-md-6">            
                        <div class="form-group">            
                            <small>Linkedin Profile<span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('linkedin',$lists->linkedin) }}" name="linkedin"
                                placeholder="Linkedin Link Here...">            
                                @error('linkedin') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div> 
                    </div>
                    <div class="col-md-3">            
                        <div class="form-group">            
                            <small>Take session (of 30 mint) <span class="error">*</span></small>            
                            <input type="number" min="0" class="form-control" value="{{ old('take_session',$lists->take_session) }}" name="take_session"
                                placeholder="Take session (of 30 mint)...">            
                                @error('take_session') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>   
                    </div>
                    
                    <div class="col-md-3">            
                        <small for="exampleFormControlInput1" class="form-label">Currently Working as</small>
                        <select class="form-control chosen-select" name="currently_working">
                            <option value="">Currently Working as</option>                            
                            @foreach($workings as $working)
                            <option value="{{$working->id}}" {{ old('currently_working',$lists->currently_working_as)==$working->id?'selected':'' }}>{{$working->title}}</option>
                            @endforeach
                        </select>  
                        @error('currently_working') <span class="text-danger error">{{$message}}</span>  @enderror            
                    </div>
                    <div class="col-md-6">            
                        <div class="form-group">            
                            <small>Instagram Profile<span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('instagram',$lists->instagram) }}" name="instagram"
                                placeholder="Instagram Link Here...">            
                                @error('instagram') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>   
                    </div>
                    <div class="col-md-3">            
                        <small for="exampleFormControlInput1" class="form-label">Role</small>
                        <select class="form-control chosen-select" name="role[]" onchange="getRoleTypeData(this.value)">
                            <option value="">Choose role</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}"  {{in_array($role->id,$Prerole)?'selected':''}}  >{{$role->title}}</option>
                            @endforeach
                        </select>  
                        @error('role') <span class="text-danger error">{{$message}}</span>  @enderror           
                    </div>
                    <div class="col-md-3"> 
                        <div class="form-group otherbox" style="display:{{ $lists->roles[0]->role == 27 ? '' : 'none' }}">            
                            <small>Other Role </small>  
                            <input type="text" class="form-control" value="{{ old('other_role',$lists->roles[0]->other_role ?? '') }}" name="other_role"
                            placeholder="Other Role Here..."> 
                            @error('other_role') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div> 
                    </div>
                    <div class="col-md-6">            
                        <div class="form-group">            
                            <small>Youtube Channel Link<span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('youtube_channel',$lists->youtube_channel_link) }}" name="youtube_channel"
                                placeholder="Youtube Channel Link Here...">            
                                @error('youtube_channel') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div> 
                    </div>
                    
                    <div class="col-md-6">                         
                        <small for="exampleFormControlInput1" class="form-label">Language</small>
                        <select class="form-control chosen-select" multiple name="languages[]">
                            <option value="">Choose Language</option>
                            @foreach($languages as $language)
                            <option value="{{$language->id}}" {{in_array($language->id,$Prelang)?'selected':''}} >{{$language->title}}</option>
                            @endforeach
                        </select>   
                        @error('languages') <span class="text-danger error">{{$message}}</span>  @enderror              
                    </div>
                    <div class="col-md-6">                         
                        <small for="exampleFormControlInput1" class="form-label">Area of Expertise</small>
                        <select class="form-control chosen-select" multiple name="expertises[]">
                            <option value="">Choose Expertise</option>
                            @foreach($expertises as $expertise)
                            <option value="{{$expertise->id}}" {{in_array($expertise->id,$Preexpert)?'selected':''}} >{{$expertise->title}}</option>
                            @endforeach
                        </select>
                        @error('expertises') <span class="text-danger error">{{$message}}</span>  @enderror                 
                    </div>
                    <div class="col-md-6 mt-3">                         
                        <small for="exampleFormControlInput1" class="form-label">Industries</small>
                        <select class="form-control chosen-select" multiple name="industries[]">
                            <option value="">Choose Industries</option>
                            @foreach($industries as $industrie)
                            <option value="{{$industrie->id}}" {{in_array($industrie->id,$Preindus)?'selected':''}} >{{$industrie->title}}</option>
                            @endforeach
                        </select> 
                        @error('industries') <span class="text-danger error">{{$message}}</span>  @enderror           
                    </div>
                    <hr>
                                           
                </div>
            
                <div class="form-layout-footer text-right">            
                    <button class="btn btn-dark esvbtn" onclick="$('.esvbtn').hide(); $('.eprcbtn').show();">Confirm & Save</button>
                    <button type="button" style="display:none;" disabled class="btn btn-dark eprcbtn">
                        <i class="fad fa-spinner-third fa-spin"></i> Loading...
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
@push('css')
<title>Edit Expert Information: {{ project() }}</title>
<link href="{{ asset('admin/lib/SpinKit/spinkit.css') }}" rel="stylesheet">
<style>
.youtube-player{position:relative;height:200px;overflow:hidden;max-width:100%;background:#000}
.youtube-player iframe{position:absolute;top:0;left:0;width:100%;height:100%;z-index:100;background:transparent}
.youtube-player img{object-fit:cover;display:block;left:0;bottom:0;margin:auto;max-width:100%;width:100%;position:absolute;right:0;top:0;border:none;height:auto;cursor:pointer;-webkit-filter:brightness(75%);-webkit-transition:0.4s all;-moz-transition:0.4s all;transition:0.4s all}
.youtube-player .play{height:72px;width:72px;left:50%;top:50%;transform:translateX(-50%) translatey(-50%);position:absolute;background:url('../../../frontend/img/play.svg') no-repeat;cursor:pointer;z-index:2;filter:drop-shadow(2px 3px 0 rgb(var(--blackrgb)/.2))}
</style>
@endpush
@push('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
<script>
    $('#summernote').summernote({
        popover: {
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['custom', ['imageAttributes', 'imageShape']],
                ['remove', ['removeMedia']]
            ],
        },
        callbacks: {
            onImageUpload: function(files, editor, welEditable) {
                UploadImage(files[0], editor, welEditable);                
            }
        }
    });
    $(document).ready(function(){
        $(".chosen-select").chosen();
        if(@json($lists->country > 0)){ State(@json($lists->country)); }
    });
    function State(value){
        $.ajax({
            data:{_token:XCSRF_Token,country:value},
            url:@json(route('admin.users.countrystates')),
            method:'POST',
            dataType:'Json',
            success:function(data){
                let Html = '';                
                Html +='<small for="exampleFormControlInput1" class="form-label">State</small>';
                Html +='<select class="form-control chosen-select" onchange="City(this.value)" name="state">';
                    Html +='<option value="">Choose State</option>';
                    data.data.forEach(element => {
                        let Select = "{{$lists->state}}";
                        if(Select==element.id){
                            Html +='<option value="'+element.id+'" selected>'+element.name+'</option>';
                        }else{
                            Html +='<option value="'+element.id+'" >'+element.name+'</option>';
                        }                        
                    });
                Html +='</select>';
                Html +='<small class="error state-error"></small>';
                
                $('.statebox').html(Html);
                $(".chosen-select").chosen();
                if(@json($lists->state > 0)){ City(@json($lists->state)); }
            }
        });
    }
    function City(value){
        $.ajax({
            data:{_token:XCSRF_Token,state:value},
            url:@json(route('admin.users.statecities')),
            method:'POST',
            dataType:'Json',
            success:function(data){
                let Html = '';
                Html +='<small for="exampleFormControlInput2" class="form-label">City</small>';
                Html +='<select class="form-control chosen-select" name="city">';
                    Html +='<option value="">Choose City</option>';
                    data.data.forEach(element => {
                        let Select = "{{$lists->city}}";
                        if(Select==element.id){
                            Html +='<option value="'+element.id+'" selected>'+element.name+'</option>';
                        }else{
                            Html +='<option value="'+element.id+'" >'+element.name+'</option>';
                        } 
                    });
                Html +='</select>';
                Html +='<small class="error state-error"></small>';
                $('.citybox').html(Html);
                $(".chosen-select").chosen();
            }
        });
    }
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
    
    function getRoleTypeData(data){
        if(data==27){ $('.otherbox').show();}
        else{ $('.otherbox').hide(); }
    }
</script>
@endpush