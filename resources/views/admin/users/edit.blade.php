@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

        <div class="col-md-6">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="breadcrumb-item" href="{{ route('admin.users') }}">Users</a>
                <span class="breadcrumb-item active">Edit User</span>
            </nav>
        </div>

        <div class="col-md-6">
            <div class="text-right">
                <a href="{{route('admin.users')}}" class="btn btn-secondary btn-sm btn-with-icon">
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
            <form method="POST" action="{{route('admin.users.update')}}" enctype="multipart/form-data" class="table-wrapper sequenceform">
                @csrf
                <input type="hidden" name="preid" id="preid" value="{{$lists->id}}">
                <div class="row mg-b-25">
                    <div class="col-md-4">            
                        <div class="form-group">            
                            <small>User Id <span class="error">*</span></small>            
                            <input type="text" readonly class="form-control" value="{{ $lists->user_id }}" name="title" placeholder="Title Here...">      
                        </div>            
                    </div> 
                    <div class="col-md-4">            
                        <div class="form-group">            
                            <small>User Name <span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('name',$lists->name) }}" name="name"
                                placeholder="User Name Here...">            
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
                            <small>User Mobile <span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('mobile',$lists->mobile) }}" name="mobile"
                                placeholder="User Mobile Here...">            
                                @error('mobile') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>  
                    <div class="col-md-4">            
                        <div class="form-group">            
                            <small for="exampleFormControlInput1" class="form-label">User Email <span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{ old('email',$lists->email) }}" name="email"
                                placeholder="User Email Here...">            
                                @error('email') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    <div class="col-md-4">            
                        <div class="form-group">            
                            <small for="exampleFormControlInput1" class="form-label">User DOB </small>            
                            <input type="date" class="form-control" max="{{date('Y-m-d',strtotime('-10 years'))}}" value="{{ old('dob',$lists->dob) }}" name="dob"
                                placeholder="User Email Here...">            
                                @error('dob') <span class="text-danger error">{{$message}}</span>  @enderror        
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
                        <small class="error country-error"></small>
                    </div>
                    <div class="col-md-4 statebox">            
                        <small for="exampleFormControlInput1" class="form-label">State</small>
                        <select class="form-control chosen-select" name="state">
                            <option value="">Choose State</option>
                        </select>            
                        <small class="error state-error"></small>
                    </div>
                    <div class="col-md-4 citybox">            
                        <small for="exampleFormControlInput1" class="form-label">City</small>
                        <select class="form-control chosen-select" name="city">
                            <option value="">Choose City</option>
                        </select>            
                        <small class="error city-error"></small>
                    </div>
                    <div class="col-md-4 mt-4">            
                        <small for="exampleFormControlInput1" class="form-label">Profile Image</small>
                        <input type="file" class="form-control" onchange="loadFile(event)" name="profile">
                        <small>Best Image Size: 476px * 483px</small>         
                        <small class="error image-error"></small>
                    </div>
                    <div class="col-md-2 mt-4">
                        <div class="PhotoBox imgbox me-4">
                            <label>
                                @php 
                                    $class="w-100 defaultimgcss";
                                    $id='output';
                                    $alt =$lists->name ?? '';
                                    $path = '/uploads/user/';
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
<title>Edit User Information: {{ project() }}</title>
<link href="{{ asset('admin/lib/SpinKit/spinkit.css') }}" rel="stylesheet">
<style>
.youtube-player{position:relative;height:200px;overflow:hidden;max-width:100%;background:#000}
.youtube-player iframe{position:absolute;top:0;left:0;width:100%;height:100%;z-index:100;background:transparent}
.youtube-player img{object-fit:cover;display:block;left:0;bottom:0;margin:auto;max-width:100%;width:100%;position:absolute;right:0;top:0;border:none;height:auto;cursor:pointer;-webkit-filter:brightness(75%);-webkit-transition:0.4s all;-moz-transition:0.4s all;transition:0.4s all}
.youtube-player .play{height:72px;width:72px;left:50%;top:50%;transform:translateX(-50%) translatey(-50%);position:absolute;background:url('../../../frontend/img/play.svg') no-repeat;cursor:pointer;z-index:2;filter:drop-shadow(2px 3px 0 rgb(var(--blackrgb)/.2))}
</style>
@endpush
@push('js')
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
<script>
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
</script>
@endpush