

@php
    use Firebase\JWT\JWT;
    
    $mobile = '';

    $VIDEOSDK_API_KEY = env('VIDEOSDK_API_KEY');
    $VIDEOSDK_SECRET_KEY = env('VIDEOSDK_SECRET_KEY');
    $issuedAt = new DateTimeImmutable();
    $expire = $issuedAt->modify('+24 hours')->getTimestamp();  
    $payload = [
        'apikey' => $VIDEOSDK_API_KEY,
        'permissions' => ['allow_join', 'allow_mod'],
        'iat' => $issuedAt->getTimestamp(),
        'exp' => $expire,
    ];
    $jwt = JWT::encode($payload, $VIDEOSDK_SECRET_KEY, 'HS256');
    $Start = date('Y-m-d H:i', strtotime('-60 minutes' . $checkbooking->booking_date . ' ' . $checkbooking->booking_start_time));
    $End = $checkbooking->booking_date . ' ' . $checkbooking->booking_end_time;

    $from = \Carbon\Carbon::parse($checkbooking->booking_date.' '.$checkbooking->booking_start_time);
    $to = \Carbon\Carbon::parse($checkbooking->booking_date.' '.$checkbooking->booking_end_time);
    $mins  = $to->diffInMinutes($from);
    $sec = ($mins * 60) * 1000;

    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
@endphp
@extends('layouts.app')
@section('content')
<div class="offcanvas offcanvas-end ChatPopup" tabindex="-1" id="chatModule" aria-labelledby="offcanvasRightLabel" data-bs-scroll="true" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h5 id="chatHeading">Let's Chat!</h5>
        <button type="button" id="chatCloseBtn" onclick="closeChatWrapper()" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="chatArea" class="chat-wrapper-content text-light" style="overflow-y: scroll"></div>
        <div class="message-box input-group mb-2">
            <input type="text" id="txtChat" class="form-control" placeholder="Message..." />
            <div id="btnSend" class="input-group-append"><button class="btn btn-primary bgthm h-100">Send</button></div>
        </div>
    </div>
</div>
<main>
    <section class="p-0">
        {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fal fa-home-alt"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('expert/schedules') }}">Schedules</a></li>
            <li class="breadcrumb-item"><a aria-current="page">Booking #{{ $checkbooking->booking_id }}</a></li>
        </ol> --}}
        <!----Check Time & Permission---->
    
        @if ($checkbooking->call_invitation==0)
        {{-- <div class="OffVideo h-100">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h6>Hello` {{ userinfo()->name }}</h6>
                        <p class="mb-0">You has not recived a invitation for this slot.</p>
                        <small>Please wait for your invitation.</small><br>
                        <a href="{{ url('user/schedules') }}" class="btn btn-thm2"><i class="fal fa-arrow-left m-0 me-2"></i> Back to Schedules</a>
                    </div>
                </div>
            </div> 
        <div> --}}
        @endif
        @if (date('Y-m-d H:i') < $Start)
        {{-- <div class="OffVideo h-100">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h6>Hello` {{ userinfo()->name }}</h6>
                        <p class="mb-0">You have not permission to access this video call.</p>
                        <small>This Video Start On {{ datetimeformat($Start) }}</small><br>
                        <a href="{{ url('user/schedules') }}" class="btn btn-thm2"><i class="fal fa-arrow-left m-0 me-2"></i> Back to Schedules</a>
                    </div>
                </div>
            </div> 
        <div> --}}
        @endif
        @if (date('Y-m-d H:i') > date('Y-m-d H:i', strtotime('+1 minutes' . $End)))
        <div class="OffVideo h-100">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h6>Hello` {{ userinfo()->name }}</h6>
                        <p class="mb-0">You have not permission to access this video call.</p>
                        <small>This video call time out on {{ datetimeformat($End) }}</small><br>
                        <a href="{{ url('user/schedules') }}" class="btn btn-thm2"><i class="fal fa-arrow-left m-0 me-2"></i> Back to Schedules</a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row h-100">
            <!----Start Call Section---->
            {{-- @if (date('Y-m-d H:i') >= $Start && date('Y-m-d H:i') <= date('Y-m-d H:i', strtotime('+10 minutes' . $End))) --}}
            <!--home-page start-->
            <div class="col-12 d-none">
                <div class="home-page" id="home-page">
                    <div class="flex">
                        {{-- <div class="text-center" style="font-size: 18px;"><i class="fad fa-spinner-third fa-spin"></i> Loading...</div> --}}
                        <div class="flex-container">
                            <input type="hidden" value="{{$checkbooking->call_meeting_code}}" class="form-control" id="joinMeetingId" placeholder="Enter Meeting Code" />
                        </div>
                    </div>
                </div>
            </div>
            {{-- @endif --}}
            <!--join page container start-->
            <div class="col-12">
                <div id="joinPage" class="main-bg" style="display: none; margin-left: -15px">
                    <div style="margin: auto; display: flex">
                        <!--join screen left grid start-->
                        <div class="join-left">
                            <div class="video-view">
                                <video class="video" id="joinCam"></video>
                                <div class="input-group mb-3 video-content">
                                    <button style="border-radius: 20px; height: 50px; width: 50px" id="camButton"onclick="toggleWebCam()">
                                        <i class="bi bi-camera-video-fill" style="color: black; font-size: 21px" id="onCamera"></i>
                                        <i class="bi bi-camera-video-off-fill" style="color: black; font-size: 21px; display: none" id="offCamera"></i>
                                    </button>

                                    <button id="micButton" onclick="toggleMic()">
                                        <i class="bi bi-mic-mute-fill" style="color: black; font-size: 21px; display: inline-block" id="muteMic"></i>
                                        <i class="bi bi-mic-fill" style="color: black; font-size: 21px; display: none" id="unmuteMic"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--join screen right grid start-->
                        <div class="join-right" style="width: 350px">
                            <h1 style="text-align: center">JOIN PAGE</h1>
                            <div>
                                <div class="class-control row" style="margin-top: 120px">
                                    <div class="col-8">
                                        <input type="hidden" id="joinMeetingName" value="{{userinfo()->name}}" placeholder="Name Of Participant" class="form-control" />
                                    </div>
                                    <div class="col-2" style="margin-top: -5px">
                                        <button id="meetingJoinButton" onclick="joinMeeting()" style="margin-left: 50px; width: 130px; border-radius: 5px" class="btn btn-primary">Join Meeting</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--join screen right grid end-->
                    </div>
                </div>
                <div class="grid-page VideoBox" id="gridPpage" >
                    <video id="videoScreenShare" class="VideoShare" style="display:none;"></video>
                    <div id="videoContainer" class="VideoMain">
                        <div class="text-center videoloader h-100" style="font-size:18px;"><i class="fad fa-spinner-third fa-spin mb-3 h2"></i> Loading...</div>
                    </div>
                    <div class="BtnS d-flex justify-content-center align-items-start">
                        <div class="d-none">
                            <input type="hidden" class="form-control navbar-brand" id="meetingid" readonly />
                            <button id="btnCopy" type="button" class="btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" data-title="Copy Meeting Code" onclick="copyMeetingCode()"><i class="fas fa-copy"></i></button>
                        </div>
                        <div class="callsdkbtn btn-group flex-wrap text-center">
                            <button type="button" id="btnStartRecording" style="display: none"  class="btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" data-title="Start Recording"><i class="far fa-record-vinyl"></i></button>
                            <button type="button" style="display: none" id="btnStopRecording" class="btn btn-dark sws-bounce sws-top" data-title="Stop Recording"><i class="fas fa-record-vinyl"></i></button>
                        </div>
                        @if(isMobile())
                        <div class="callsdkbtn btn-group flex-wrap text-center">
                            <button type="button" id="btnFrontCamera" class="btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" data-title="Switch Front Camera"><i class="far fa-repeat-alt"></i></button>
                            <button type="button" style="display: none" id="btnBackCamera" class="btn btn-dark sws-bounce sws-top" data-title="Switch Back Camera"><i class="far fa-repeat-alt"></i></button>
                        </div>
                        @endif
                        <!-- main page toggle mic-->
                        <div class="callsdkbtn btn-group" id="main-pg-mute-mic" style="display: inline-block">
                            <button type="button" class="btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" data-title="Un-Mute"><i class="fas fa-microphone-alt-slash"></i></button>
                        </div>
                        <div class="callsdkbtn btn-group" id="main-pg-unmute-mic" style="display: none">
                            <button type="button" class="btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" data-title="Mute"><i class="fas fa-microphone-alt"></i></button>
                        </div>
                        <!--main page toggle web-cam-->
                        <div class="callsdkbtn btn-group" id="main-pg-cam-off" style="display: inline-block">
                            <button type="button" class="btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" data-title="Video Off"><i class="fas fa-video-slash"></i></button>
                        </div>
                        <div class="callsdkbtn btn-group" id="main-pg-cam-on" style="display: none">
                            <button type="button" class="btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" data-title="Video" id="videoCamOn"><i class="fas fa-video"></i></button>
                        </div>
                        <!--screen share-->
                        <button type="button" id="btnScreenShare" class="callsdkbtn btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" data-title="Screen Share"><i class="far fa-desktop-alt"></i></button>
                        <!--participants-->
                        {{-- <button type="button" class="callsdkbtn btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" onclick="openParticipantWrapper()" data-bs-toggle="offcanvas" data-bs-target="#participants" data-title="People"><i class="far fa-users"></i></button> --}}
                        <!--chat-->
                        <button type="button" class="callsdkbtn btn btn-secondary bg-secondary bg-opacity-50 sws-bounce sws-top" onclick="openChatWrapper()" data-bs-toggle="offcanvas" data-bs-target="#chatModule" data-title="Chat"><i class="fas fa-comments"></i></button>
                        <!--call end-->
                        <div class="btn-group callsdkbtn">
                            <button type="button" id="endCall" class="btn btn-danger sws-bounce sws-top dropdown-toggle" data-title="Call End"><i class="far fa-phone-slash"></i></button>
                        </div>
                        <div class="btn-group backbtn" style="display: none;">
                            <a href="{{route('user.schedules')}}" class="btn btn-danger sws-bounce sws-top dropdown-toggle" data-title="Call End"><i class="far fa-phone-slash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
</main>
<div class="offcanvas offcanvas-end" tabindex="-1" id="participants" aria-labelledby="offcanvasRightLabel" data-bs-scroll="true" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h5 id="totalParticipants"></h5>
        <button type="button" id="ParticipantsCloseBtn"
        onclick="closeParticipantWrapper()" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="participantsList" class="participant-wrapper-content text-light"></div>
    </div>
</div>
@endsection
@push('css')
<title>Booking #{{ $checkbooking->booking_id }} Video Call : {{ project() }}</title>
<style>
nav.menu{min-height:25px!important}
nav .st{padding:0!important}
nav .container>div{justify-content:center!important}
nav .logom{max-width:99px}
nav .logom>a{padding:3px 0!important}
section{height:calc(100vh - 63px);overflow:auto;}
section .OffVideo{display:grid;place-content:center}
.VideoBox{position:relative;background:var(--thm);padding:0 12px 12px;height:100%}
.VideoBox .video-frame-you,.VideoShare{width:100%;height:calc(100vh - 125px);border-radius:15px;background:var(--thm1)}
.VideoBox .video-frame-you.video-frame-me{position:absolute;height:120px;width:212px;border-radius:12px;box-shadow:0 0 20px rgb(var(--blackrgb)/.2);right:25px;bottom:75px;z-index:2}
.VideoBox .BtnS{width:100%;padding:12px 0 0;gap:9px}
.VideoBox .BtnS .btn-secondary,.VideoBox .BtnS .btn-danger{border-radius:30px!important;min-width:38px;height:38px;padding:0;display:grid;place-content:center}
.VideoBox .BtnS .btn-danger{min-width:55px}
.VideoBox .VideoMain{line-height:0!important;height:calc(100% - 50px)}
.VideoShare{width:calc(100% - 24px);position:absolute;z-index:1}
.videoloader{display:grid;place-content:center;color:var(--white);}
main{width:100%;transition:.2s all}
.ChatPopup.show+main{width:calc(100% - 349px)}
.ChatPopup .offcanvas-body{display:flex;flex-wrap:wrap;overflow:hidden;padding-bottom:0}
.ChatPopup .offcanvas-body .chat-wrapper-content{overflow-y:auto;height:calc(100% - 56px);width:100%;flex-wrap:wrap;display:flex;flex-direction:column;justify-content:flex-end}
.ChatPopup .offcanvas-body .chat-wrapper-content>div{width:100%;margin-bottom:5px!important}
.ChatPopup .offcanvas-body .chat-wrapper-content>div>div{margin-top:0!important}
.ChatPopup .offcanvas-body .chat-wrapper-content>div span{line-height:normal;font-size:14px;display:inline-block;color:rgb(var(--blackrgb)/.2)}
footer .FooterMid{padding:0!important}
footer .fbottom{margin-top:0!important;padding:5px 0!important;border:none!important}
@media (max-width:575px){.VideoBox .video-frame-you.video-frame-me{height:99px;width:175px}}
</style>
@endpush
@push('js')
<script>
    let TOKEN = "{{ $jwt }}";
    let Redirect = @json(route('user.schedules'));
    let SendInvite = '';
    let SlotBooking = @json($checkbooking->id);
    let CallEndTime = "{{$sec}}";
    let CallEndByData = @json(route('user.videocallend'));
    let RecordingDataUrl = @json(route('user.videorecording'));
    let EndByName = @json($checkbooking->expert->name ?? 'Mentor');
    setTimeout(() => {
        joinMeeting(false);                  
    }, 1000);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js" integrity="sha512-aUhL2xOCrpLEuGD5f6tgHbLYEXRpYZ8G5yD+WlFrXrPy2IrWBlu6bih5C9H6qGsgqnU6mgx6KtU8TreHpASprw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('frontend/js/videocall/index.js') }}"></script>
<script src="https://sdk.videosdk.live/js-sdk/0.0.54/videosdk.js"></script>
<script src="{{ asset('frontend/js/videocall/config.js') }}"></script>  
<script>
      
</script>  
@endpush