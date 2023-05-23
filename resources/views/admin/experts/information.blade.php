@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel br-profile-page">

    <div class="card shadow-base bd-0 rounded-0 widget-4">
        <div class="card-header ht-75">
            <div class="hidden-xs-down">
                <a href="" class="mg-r-10"><span class="tx-medium">{{count($data->slots)}}</span> Session</a>
            </div>
            <div class="tx-24 hidden-xs-down">
                <a href="{{ route('admin.experts') }}" class="mg-r-10"><small style="font-size: 14px;">BACK</small></a>
            </div>
        </div>
        <div class="card-body">
            <div class="card-profile-img">
                <x-image-box>
                    <x-slot:image>{{$data->profile}}</x-slot>
                        <x-slot:path>/uploads/expert/</x-slot>
                            <x-slot:alt>{{$data->name ?? ''}}</x-slot>
                </x-image-box>
            </div>
            <h4 class="tx-normal tx-roboto tx-white">{{$data->name}}</h4>
        </div>
    </div>

    <div class="ht-50 bg-gray-100 pd-x-20 d-flex align-items-center justify-content-center shadow-base">
        <ul class="nav nav-outline active-info align-items-center flex-row" role="tablist">
            <li class="nav-item hidden-xs-down"><a class="nav-link active" data-toggle="tab" href="#basic" role="tab"
                    aria-expanded="false">Basic Information</a></li>
            <li class="nav-item"><a class="nav-link"
                    href="{{route('admin.experts.information', ['page'=>'slot','id' => $data->id])}}">Booking Slot</a>
            </li>
            <li class="nav-item"><a class="nav-link"
                    href="{{route('admin.experts.information', ['page'=>'charges','id' => $data->id])}}">Slot Charges &
                    Availability</a></li>
        </ul>
    </div>

    <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show" id="basic" aria-expanded="true">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                        <table class="table">
                            <tr>

                                <td><label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Working
                                        As</label>
                                    <p class="tx-inverse mg-b-15">{{$data->workingas->title ?? '--------'}}</p>
                                </td>
                                <td>
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Mobile
                                        Notification</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if($data->mobile_notification==1)
                                        <small class="text-success">ON (<i class="fa fa-check"></i>)</small>
                                        @endif
                                        @if($data->mobile_notification==0)
                                        <small class="text-danger">OFF (<i class="fa fa-times"></i>)</small>
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Profile
                                        Visibility</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if($data->profile_visibility==1)
                                        <small class="text-success">ON (<i class="fa fa-check"></i>)</small>
                                        @endif
                                        @if($data->profile_visibility==0)
                                        <small class="text-danger">OFF (<i class="fa fa-times"></i>)</small>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Video
                                        Visibility</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if($data->video_visibility==1)
                                        <small class="text-success">ON (<i class="fa fa-check"></i>)</small>
                                        @endif
                                        @if($data->video_visibility==0)
                                        <small class="text-danger">OFF (<i class="fa fa-times"></i>)</small>
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email
                                        Notification</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if($data->email_notification==1)
                                        <small class="text-success">ON (<i class="fa fa-check"></i>)</small>
                                        @endif
                                        @if($data->email_notification==0)
                                        <small class="text-danger">OFF (<i class="fa fa-times"></i>)</small>
                                        @endif
                                    </p>
                                </td>
                                <td><label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Role</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(count($data->roles) > 0)
                                        @foreach($data->roles as $rol)
                                        @php $roles = \App\Models\Role::find($rol->role); @endphp
                                        {{$roles->title ?? ''}}

                                        @if(!empty($rol->other_role)) ({{$rol->other_role}}) @endif

                                        {{!$loop->last?', ':''}}
                                        @endforeach
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label
                                        class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Company</label>
                                    <p class="tx-inverse mg-b-15">
                                        {{$data->compnay_name ?? '-------'}}
                                    </p>
                                </td>
                                <td>
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Take session
                                        (of 30 mint)</label>
                                    <p class="tx-inverse mg-b-15">
                                        {{$data->take_session ?? '-------'}}
                                    </p>
                                </td>
                                <td>
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Charges (per
                                        hour)</label>
                                    <p class="tx-inverse mg-b-15">
                                        INR {{$data->charge ?? '-------'}}
                                    </p>
                                </td>
                               
                            </tr>
                            <tr>
                            <td>
                                    @if($data->defaultcharges)
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Charges (30 Min)</label>
                                    @if($data->defaultcharges->charges > 0 )
                                    <p class="tx-inverse mg-b-15">
                                    INR {{ round(($data->defaultcharges->charges) + ($data->defaultcharges->charges * 0) / 100) }}
                                    @else
                                    <p class="tx-inverse mg-b-15">
                                    INR {{ round(($data->charge) + ($data->charge * 0) / 100) }}
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Experience
                                        (IN YEAR)</label>
                                    <p class="tx-inverse mg-b-15">
                                        {{$data->experience ?? '-------'}} Years
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><label
                                        class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Expertise</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(count($data->expertise) > 0)
                                        @foreach($data->expertise as $exp)
                                        {{$exp->expertiseinfo->title ?? ''}}{{!$loop->last?', ':''}}
                                        @endforeach
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><label
                                        class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Languages</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(count($data->languages) > 0)
                                        @foreach($data->languages as $language)
                                        @php $language = \App\Models\Language::find($language->language_id); @endphp
                                        {{$language->title ?? ''}}{{!$loop->last?', ':''}}
                                        @endforeach
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Linkedin
                                        Profile</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->linkedin))
                                        <a href="{{$data->linkedin ?? 'javascript:void(0)'}}"
                                            target="_blank">{{$data->linkedin ?? ''}}</a>
                                        @else
                                        --------
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label
                                        class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Instagram</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->instagram))
                                        <a href="{{$data->instagram ?? 'javascript:void(0)'}}"
                                            target="_blank">{{$data->instagram ?? ''}}</a>
                                        @else
                                        --------
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Youtube
                                        Channel</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->youtube_channel_link))
                                        <a href="{{$data->youtube_channel_link ?? 'javascript:void(0)'}}"
                                            target="_blank">{{$data->youtube_channel_link ?? ''}}</a>
                                        @else
                                        --------
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">BIO</label>
                                    <p class="tx-inverse mg-b-15">{!!$data->bio!!}</p>
                                </td>
                            </tr>
                            {{-- <tr>
                                    <td colspan="3">
                                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">STRENGTH</label>
                                        <p class="tx-inverse mg-b-15">{!!$data->your_strength!!}</p>
                                    </td>
                                </tr> --}}
                            <tr>
                                <td colspan="3">
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">What to
                                        expect</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(count($data->expects)>0)
                                    <ul>
                                        @foreach($data->expects as $expects)
                                        <li>{{$expects->description}}</li>
                                        @endforeach
                                    </ul>
                                    @else
                                    ---------
                                    @endif
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 mg-t-30 mg-lg-t-0">
                    <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                        <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Contact Information</h6>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Phone Number</label>
                        <p class="tx-info mg-b-15">+{{$data->ccode}}{{$data->mobile}}</p>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email Address</label>
                        <p class="tx-inverse mg-b-15">{{$data->email}}</p>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Expert Id</label>
                        <p class="tx-info mg-b-15"><small>{{$data->user_id}}</small></p>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Service Charges</label>
                        <p class="tx-info mg-b-15"><small>{{$data->service_charges ?? 0}}%</small></p>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Gender</label>
                        <p class="tx-info mg-b-15"><small>
                                {{$data->gender==0?'Other':''}}
                                {{$data->gender==1?'Male':''}}
                                {{$data->gender==2?'Female':''}}
                            </small></p>


                        @if(!empty($data->cities) || !empty($data->states) || !empty($data->countires))
                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Location</label>
                        <p class="tx-inverse mg-b-15">
                            <small>
                                @if(!empty($data->cities)) {{$data->cities->name ?? ''}}, @endif
                                @if(!empty($data->states)) {{$data->states->name ?? ''}}, @endif
                                @if(!empty($data->countires)) {{$data->countires->name ?? ''}} @endif
                            </small>
                        </p>
                        @endif


                    </div>

                    <div class="card pd-20 mt-4 pd-xs-30 shadow-base bd-0">
                        <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Other Information</h6>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Last Login</label>
                        <p class="tx-inverse mg-b-5"><small>{{datetimeformat($data->last_login)}}</small></p>

                        @if($data->is_publish==1)
                        <p class="tx-inverse mg-b-5"><small class="text-success">1. Profile Publish : Yes (<i
                                    class="fa fa-check"></i> )</small></p>
                        @endif

                        @if($data->is_publish==0)
                        <p class="tx-inverse mg-b-5"><small class="text-danger">1. Profile Publish : NO (<i
                                    class="fa fa-times"></i>)</small></p>
                        @endif

                        @if($data->top_expert==1)
                        <p class="tx-inverse mg-b-5"><small class="text-success">2. Top Expert : Yes (<i
                                    class="fa fa-check"></i>)</small></p>
                        @endif

                        @if($data->top_expert==0)
                        <p class="tx-inverse mg-b-5"><small class="text-danger">2. Top Expert : No (<i
                                    class="fa fa-times"></i>)</small></p>
                        @endif
                    </div>

                    <div class="card pd-20 mt-4 pd-xs-30 shadow-base bd-0">
                        <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Introduction Videos</h6>
                        @foreach($data->videos as $video)
                        @php
                        $arr = explode('=',$video->video_url);
                        @endphp
                        @if($video->video_type==1)
                        <div class="youtube-player" data-id="{{$arr[1] ?? ''}}"></div>
                        <a data-fancybox="" class="playVideo" href="{{$video->video_url}}"
                            data-title="{{$video->title}}"></a>
                        @endif
                        @if($video->video_type==2)
                        <video controls>
                            <source src="{{asset('uploads/expert/video/'.$video->video)}}" type="video/mp4" />
                        </video>
                        <div class="play"></div>
                        <a data-fancybox="" class="playVideo" href="{{asset('uploads/expert/video/'.$video->video)}}"
                            data-title="{{$video->title}}"></a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('css')
<title>Experts Information : {{ project() }}</title>
<link href="{{ asset('admin/lib/SpinKit/spinkit.css') }}" rel="stylesheet">
<style>
.youtube-player {
    position: relative;
    height: 200px;
    overflow: hidden;
    max-width: 100%;
    background: #000
}

.youtube-player iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 100;
    background: transparent
}

.youtube-player img {
    object-fit: cover;
    display: block;
    left: 0;
    bottom: 0;
    margin: auto;
    max-width: 100%;
    width: 100%;
    position: absolute;
    right: 0;
    top: 0;
    border: none;
    height: auto;
    cursor: pointer;
    -webkit-filter: brightness(75%);
    -webkit-transition: 0.4s all;
    -moz-transition: 0.4s all;
    transition: 0.4s all
}

.youtube-player .play {
    height: 72px;
    width: 72px;
    left: 50%;
    top: 50%;
    transform: translateX(-50%) translatey(-50%);
    position: absolute;
    background: url('../../../frontend/img/play.svg') no-repeat;
    cursor: pointer;
    z-index: 2;
    filter: drop-shadow(2px 3px 0 rgb(var(--blackrgb)/.2))
}
</style>
@endpush
@push('js')
<script>
function labnolIframe(div) {
    var iframe = document.createElement('iframe');
    iframe.setAttribute(
        'src',
        'https://www.youtube.com/embed/' + div.dataset.id + '?autoplay=1&rel=0'
    );
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allowfullscreen', '1');
    iframe.setAttribute(
        'allow',
        'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture'
    );
    div.parentNode.replaceChild(iframe, div);
}

function initYouTubeVideos() {
    var playerElements = document.getElementsByClassName('youtube-player');
    for (var n = 0; n < playerElements.length; n++) {
        var videoId = playerElements[n].dataset.id;
        var div = document.createElement('div');
        div.setAttribute('data-id', videoId);
        var thumbNode = document.createElement('img');
        thumbNode.src = '//i.ytimg.com/vi/ID/hqdefault.jpg'.replace(
            'ID',
            videoId
        );
        thumbNode.alt = "Youtube Voideo";
        div.appendChild(thumbNode);
        var playButton = document.createElement('div');
        playButton.setAttribute('class', 'play');
        div.appendChild(playButton);
        div.onclick = function() {
            labnolIframe(this);
        };
        playerElements[n].appendChild(div);
    }
}
document.addEventListener('DOMContentLoaded', initYouTubeVideos);
$('[data-bs-type]').on('click', function(e) {
    let Modal = $(this).attr('data-bs-type');
    if (Modal == 'addvideo') {
        $('.modal-content').html(
            '<div class="text-center p-4"><i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i></div>'
            );
        $('.modal-content').load(@json(route('expert.addvideo')));
    }
    if (Modal == 'editvideo') {
        let id = $(this).attr('data-bs-id');
        $('.modal-content').html(
            '<div class="text-center p-4"><i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i></div>'
            );
        setTimeout(() => {
            $('.modal-content').load(@json(route('expert.editvideo')) + '?id=' + id);
        }, 1000);
    }
});
</script>
@endpush