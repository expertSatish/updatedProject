@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

        <div class="col-md-6">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="breadcrumb-item" href="{{ route('admin.experts') }}">Experts</a>
                <span class="breadcrumb-item active">Videos</span>
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
            <form method="POST" action="{{route('admin.experts.updatevideos')}}" enctype="multipart/form-data" class="table-wrapper sequenceform">
                @csrf
                <input type="hidden" name="preid" id="preid" value="{{$vidoes->id ?? ''}}">
                <input type="hidden" name="expert" value="{{$expert->id ?? ''}}">
                <div class="row mg-b-25">
                    <div class="col-md-3">            
                        <div class="form-group">            
                            <small>Video Type <span class="error">*</span></small>            
                            <select name="video_type" class="form-select" onchange="chooseType(this.value)">
                                <option value="">Choose One</option>
                                <option value="1" @selected(($vidoes->video_type ?? old('video_type'))==1)>Youtube Video</option>
                                <option value="2" @selected(($vidoes->video_type ?? old('video_type'))==2)>Other Video</option>   
                            </select>   
                        </div>            
                    </div>
                    <div class="col-md-9">            
                        <div class="form-group">            
                            <small>Video Title <span class="error">*</span></small>            
                            <input type="text" class="form-control" value="{{$vidoes->title ?? ''}}" name="title" placeholder="Title Here...">      
                        </div>            
                    </div>

                    <div class="col-md-8 mb-2 youtubebox" style="display: {{($vidoes->video_type ?? old('video_type'))==1?'':'none'}} ">
                        <small for="url" class="form-label">Youtube Video URL</small>
                        <input type="url" name="video_url" value="{{$vidoes->video_url ?? ''}}" class="form-control" placeholder="Youtube video url here....">
                    </div>
                    @if(!empty($vidoes->video_url))
                    <div class="col-md-4 mb-2 youtubebox" style="display: {{($vidoes->video_type ?? old('video_type'))==1?'':'none'}} ">
                        {!! youtube_preview($vidoes->video_url,150,150) !!}
                    </div>
                    @endif
                    <div class="col-md-4 mb-2 videobox" style="display:  {{($vidoes->video_type ?? old('video_type'))==2?'':'none'}}">
                        <small for="file" class="form-label">Choose Video</small>
                        <input type="file" name="video" id="videoUpload" class="form-control">
                    </div>
                    <div class="col-md-3 mb-2 videobox" style="display: {{($vidoes->video_type ?? old('video_type'))==2?'':'none'}}">
                        <video class="w-100" controls>
                            @if(!empty($vidoes->video))
                            <source src="{{asset('uploads/expert/video/'.$vidoes->video)}}" type="video/mp4" />
                            <source src="{{asset('uploads/expert/video/'.$vidoes->video)}}" type="video/ogg" />
                            @endif
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="col-md-12 mt-3 mb-4">            
                        <small for="exampleFormControlInput1" class="form-label">Description</small>
                        <textarea name="description" id="summernote" class="form-control" placeholder="Write Something Here">{{$vidoes->description ?? ''}}</textarea>
                        @error('description') <span class="text-danger error">{{$message}}</span>  @enderror    
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
<title>Expert Videos: {{ project() }}</title>
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
    function chooseType(value){
        if(value==1){ 
            $('.youtubebox').show();
            $('.videobox').hide();
        }
        if(value==2){ 
            $('.youtubebox').hide();
            $('.videobox').show();
        }        
    }
    document.getElementById("videoUpload")
    .onchange = function(event) {
    let file = event.target.files[0];
    let blobURL = URL.createObjectURL(file);
    document.querySelector("video").src = blobURL;
    }
</script>
@endpush