@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('expert.dashboard')}}"> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('expert.message')}}">Message</a></li>
                <li class="breadcrumb-item"><a aria-current="page">Message Details</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-expert.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="LeftPanelSec">
                        <div class="Leftpanel MLeftpanel">
                            <div class="Compose mb-2">
                                <span class="btn btn-thm3 w-100 mt-0 d-block SendMessage SendAddMessage">Compose</span>
                                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#MsgMenu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                            </div>
                            <ul id="MsgMenu" class="collapse">
                                <li class="active"><a href="{{route('expert.message')}}"><i class="fal fa-inbox me-2"></i><span>Inbox <span class="badge bg-info ms-3">{{$unread}}</span></span></a></li>
                                <li><a href="{{route('expert.message',['type'=>'sent'])}}"><i class="fal fa-envelope me-2"></i> <span>Sent</span></a></li>
                                {{-- <li><a href="{{route('expert.message',['type'=>'star'])}}"><i class="fal fa-star me-2"></i> <span>Star</span></a></li> --}}
                                <li><a href="{{route('expert.message',['type'=>'trash'])}}"><i class="fal fa-trash me-2"></i> <span>Trash</span></a></li>
                                <li><a href="{{route('expert.message',['type'=>'archive'])}}"><i class="fal fa-archive me-2"></i> <span>Archive</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="MailBox card p-0">
                        <div class="MailBoxR">
                            @foreach($lists as $list)                                
                            <input type="hidden" id="replybox" value="{{$list->user->email ?? ''}}">
                            <input type="hidden" id="replyid" value="{{$list->id}}">
                            <div class="MBThead">
                                <div class="row">
                                    <div class="col-sm-3 justify-content-center"><h3>Mail Detail</h3></div>
                                    <div class="col-sm-4 col-7 order-sm-first">
                                        <a href="{{ url()->previous() }}" class="btn btntag ms-0 sws-top sws-bounce" data-title="Go Back"><i class="fal fa-arrow-left"></i></a>
                                    </div>
                                    <div class="col-5">
                                        @if($list->send_by==2  && count($list->reply)==0)
                                        @php 
                                            \App\Models\ComposeMessage::where('id',$list->id)->update(['read_to'=>1]);
                                        @endphp
                                            <button type="button" class="btn btntag m-0 me-2 sws-top sws-bounce SendMessage SendReplyMessage" data-title="Reply"><i class="fal fa-reply"></i></button>
                                        @endif
                                        <!-- <button type="button" class="btn btntag m-0 me-2 sws-top sws-bounce replybtn" target="replybox" data-title="Reply all"><i class="fal fa-reply-all"></i></button>
                                        <button type="button" class="btn btntag m-0 me-2 sws-top sws-bounce replybtn" target="replybox" data-title="Forward"><i class="fal fa-arrow-alt-right"></i></button> -->
                                        {{-- <div class="NextPre">
                                            <a href="#" class="disabled"><i class="far fa-chevron-left"></i></a>
                                            <a href="#" class=""><i class="far fa-chevron-right"></i></a>
                                        </div> --}}
                                        @if($list->expert_id==expertinfo()->id)
                                            @if($list->archive_expert==0)
                                                <a href="{{route('expert.archivemessage',['previous'=>url()->previous(),'id'=>$list->id])}}" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Archive"><i class="fal fa-archive"></i></a>
                                            @else
                                                <a href="{{route('expert.archivemessage',['previous'=>url()->previous(),'id'=>$list->id])}}" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Un-Archive"><i class="fal fa-archive"></i></a>
                                            @endif
                                            @if($list->delete_expert==0)
                                                <a href="{{route('expert.deletemessage',['previous'=>url()->previous(),'id'=>$list->id])}}" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Delete"><i class="fal fa-trash-alt"></i></a>
                                            @elseif($list->delete_expert==1)
                                                <a href="{{route('expert.deletemessage',['previous'=>url()->previous(),'id'=>$list->id])}}" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Moved From Trash"><i class="far fa-arrows"></i></a>
                                                <a href="{{route('expert.deletemessage',['previous'=>url()->previous(),'id'=>$list->id,'confirm'=>true])}}" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Delete"><i class="fal fa-trash-alt"></i></a>
                                            @endif
                                        @endif 
                                    </div>
                                </div>
                            </div>                            
                            <div class="MailBoxD">
                                <div>
                                    <h4 class="MailTitle">{{$list->subject}}</h4>
                                    <div class="MailHead">
                                        <span class="uimg NameIcon">
                                            <span>{{$list->user->name ?? 'Dear'}}</span>
                                        </span>
                                        <div class="NameDate">
                                            <span>{{$list->user->name ?? 'Dear'}}</span>
                                            <div class="d-flex align-items-center">
                                                <p class="m-0"><small>{{dateformat($list->created_at)}} | {{timeformat($list->created_at)}}</small></p>
                                                <div class="dropdown dropend">
                                                    <button type="button" id="dd_id1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn me-0 p-0 px-1 h-100 dropdown-toggle sws-top sws-bounce" data-title="Forward"><i class="fas fa-ellipsis-v"></i></button>
                                                    <div aria-labelledby="dd_id1" class="dropdown-menu">
                                                        <a href="#" class="dropdown-item"><span>from:</span>  {{$list->expert->email ?? ''}}</a>
                                                        <a href="#" class="dropdown-item"><span>to:</span>  {{$list->user->email ?? ''}}</a>
                                                        <a href="#" class="dropdown-item"><span>date:</span>  {{dateformat($list->created_at)}} | {{timeformat($list->created_at)}}</a>
                                                        <a href="#" class="dropdown-item"><span>subject:</span>  {{$list->subject}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="MailText">
                                        {!!$list->message!!}
                                        <hr>
                                        <div class="row attachments">
                                            @foreach($list->attechments as $attechments)
                                            <div class="col-4 col-sm-3 col-md-2 mb-2">
                                                <div class="attimg">
                                                    <a href="{{asset('uploads/message/'.$attechments->attachment)}}" download>
                                                        @if(strtoupper($attechments->attachment_type)=='PDF')
                                                            <img src="{{asset('frontend/img/pdf.png')}}" class="w-100">
                                                        @elseif(in_array(strtoupper($attechments->attachment_type),['XLSX','XLS','CSV']))
                                                            <img src="{{asset('frontend/img/excel.png')}}" class="w-100">
                                                        @elseif(in_array(strtoupper($attechments->attachment_type),['JPG','JPEG','WEBP','AVIF','PNG','SVG','GIF']))
                                                            <img src="{{asset('uploads/message/'.$attechments->attachment)}}" class="w-100">
                                                        @else
                                                            <img src="{{asset('frontend/img/txt.png')}}" class="w-100">
                                                        @endif
                                                        <div>                                                            
                                                            <span>{{$attechments->attachment_size}} KB</span>
                                                            <a href="#" class="downloadicon"><i class="fal fa-download"></i></a>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach                                            
                                        </div>
                                        @if($list->send_by==2 && count($list->reply)==0)
                                        <div>
                                            <button type="button" class="btn btntag m-0 me-2 SendMessage SendReplyMessage"><i class="fal fa-reply me-1"></i> Reply</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                                @foreach($list->reply as $reply)

                                <div class="MailBoxD">
                                    <div>
                                        <h4 class="MailTitle">{{$reply->subject}}</h4>
                                        <div class="MailHead">
                                            <span class="uimg NameIcon">
                                                <span>{{$reply->user->name ?? 'Dear'}}</span>
                                            </span>
                                            <div class="NameDate">
                                                <span>{{$reply->user->name ?? 'Dear'}}</span>
                                                <div class="d-flex align-items-center">
                                                    <p class="m-0"><small>{{dateformat($reply->created_at)}} | {{timeformat($reply->created_at)}}</small></p>
                                                    <div class="dropdown dropend">
                                                        <button type="button" id="dd_id1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn me-0 p-0 px-1 h-100 dropdown-toggle sws-top sws-bounce" data-title="Forward"><i class="fas fa-ellipsis-v"></i></button>
                                                        <div aria-labelledby="dd_id1" class="dropdown-menu">
                                                            <a href="#" class="dropdown-item"><span>from:</span>  {{$reply->expert->email ?? ''}}</a>
                                                            <a href="#" class="dropdown-item"><span>to:</span>  {{$reply->user->email ?? ''}}</a>
                                                            <a href="#" class="dropdown-item"><span>date:</span>  {{dateformat($reply->created_at)}} | {{timeformat($reply->created_at)}}</a>
                                                            <a href="#" class="dropdown-item"><span>subject:</span>  {{$reply->subject}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="MailText">
                                            {!!$reply->message!!}
                                            <hr>
                                            <div class="row attachments">
                                                @foreach($reply->attechments as $attechments)
                                                <div class="col-4 col-sm-3 col-md-2 mb-2">
                                                    <div class="attimg">
                                                        <a href="{{asset('uploads/message/'.$attechments->attachment)}}" download>
                                                            @if(strtoupper($attechments->attachment_type)=='PDF')
                                                                <img src="{{asset('frontend/img/pdf.png')}}" class="w-100">
                                                            @endif
                                                            @if(in_array(strtoupper($attechments->attachment_type),['JPG','JPEG','WEBP','AVIF','PNG','SVG','GIF']))
                                                                <img src="{{asset('uploads/message/'.$attechments->attachment)}}" class="w-100">
                                                            @endif
                                                            <div>
                                                                {{-- <h6>{{$attechments->attachment}}</h6> --}}
                                                                <span>{{$attechments->attachment_size}} KB</span>
                                                                <a href="#" class="downloadicon"><i class="fal fa-download"></i></a>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endforeach                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Message Details : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/message.css')}}">
<style type="text/css">
body>main,body section{overflow:inherit!important;}
.SendInquiryPopup>div ~ div .MsgHead .ToBox{display:block!important;}
</style>
@endpush
@push('js')
    <x-message-popup/>
    <script>
        $('.SendReplyMessage').on('click',function(){
            let ReplyEmail = $('#replybox').val();
            let ReplyId = $('#replyid').val();
            $('#to').val(ReplyEmail);
            $('#to').attr('readonly',true);
            $('#sendreply').val(ReplyId);
        });
        $('.SendAddMessage').on('click',function(){
            $('#to').val('');
            $('#to').removeAttr('readonly',false);
            $('#sendreply').val('');
        });
    </script>
@endpush