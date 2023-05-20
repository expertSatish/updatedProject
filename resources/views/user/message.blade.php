@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"> Dashboard</a></li>
                <li class="breadcrumb-item"><a aria-current="page">Message</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-user.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="LeftPanelSec">
                        <div class="Leftpanel MLeftpanel">
                            <div class="Compose mb-2">
                                <span class="btn btn-thm3 w-100 mt-0 d-block SendMessage">Compose</span>
                                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#MsgMenu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                            </div>
                            <ul id="MsgMenu" class="collapse">
                                <li class="{{Request::segment(3)==''?'active':''}}"><a href="{{route('user.message')}}"><i class="fal fa-inbox me-2"></i><span>Inbox <span class="badge bg-info ms-3">{{$unread}}</span></span></a></li>
                                <li class="{{Request::segment(3)=='sent'?'active':''}}"><a href="{{route('user.message',['type'=>'sent'])}}"><i class="fal fa-envelope me-2"></i> <span>Sent</span></a></li>
                                {{-- <li><a href="{{route('user.message',['type'=>'star'])}}"><i class="fal fa-star me-2"></i> <span>Star</span></a></li> --}}
                                <li class="{{Request::segment(3)=='trash'?'active':''}}"><a href="{{route('user.message',['type'=>'trash'])}}"><i class="fal fa-trash me-2"></i> <span>Trash</span></a></li>
                                <li class="{{Request::segment(3)=='archive'?'active':''}}"><a href="{{route('user.message',['type'=>'archive'])}}"><i class="fal fa-archive me-2"></i> <span>Archive</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="MailBox card p-0">
                        <form method="GET" action="" id="formbox">
                            @csrf
                            <div class="MailBoxR">
                                <div class="MBThead">
                                    <div class="row">
                                        <div class="col-sm-2 col-4 justify-content-sm-center"><h3>{{Request::segment(3)==''?'Inbox':ucwords(Request::segment(3))}}</h3></div>
                                        <div class="col-sm-5 col-8 order-sm-first">
                                            <div class="form-check mr-2"><input type="checkbox" id="AllCheck" class="form-check-input"><label for="AllCheck" class="form-check-label">All</label></div>
                                            <a href="{{url()->current()}}" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Refresh"><i class="far fa-redo"></i></a>
                                            <button type="button" onclick="$('#formbox').attr('action','{{route('user.bulkarchivemessage')}}?previous={{url()->current()}}'); $('#formbox').attr('method','POST'); $('#formbox').submit();" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Archive"><i class="far fa-archive"></i></button>
                                            <button type="button" onclick="$('#formbox').attr('action','{{route('user.bulkdeletemessage')}}?previous={{url()->current()}}');  $('#formbox').attr('method','POST'); $('#formbox').submit();" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Delete"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                        <div class="col-sm-5 col-12">
                                            <div class="SearchBar">
                                                <input type="text" placeholder="Search" value="{{request('search')}}" required name="search" class="form-control msgsearch">
                                                <i class="fal fa-search"></i>
                                            </div>
                                            <div class="messagesearchbox"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="MBmails">
                                    <ul>
                                        @if($lists->count()==0)
                                        <li class="justify-content-center">
                                            <small>You have no any message yet.</small>
                                        </li>
                                        @endif
                                        @foreach ($lists as $item)
                                            <li class="{{$item->send_by==1 && $item->read_to==0?'unread':''}}">
                                                <span class="check me-2"><input type="checkbox" name="check[]" value="{{$item->id}}" class="form-check-input"></span>
                                                {{-- <span class="mstar starbox25"><i class="far fa-star"></i></span> --}}
                                                <a href="{{route('user.message',['type'=>base64_encode($item->id)])}}">
                                                    <div class="name">
                                                        <span>{{$item->expert->name ?? '-----'}} <small>
                                                            
                                                            @if(!empty($item->expert->email)) ({{$item->expert->email ?? ''}}) @endif
                                                        </small></span>
                                                    </div>
                                                    <div class="mail"><strong>{{$item->subject}} </strong>- {!! strip_tags($item->message) !!}</div>
                                                    @if(count($item->attechments)) <div class="attachment"><i class="fal fa-paperclip"></i></div> @endif
                                                    <div class="date">{{messagetime($item->created_at)}}</div>
                                                </a>
                                            </li>
                                        @endforeach                                        
                                    </ul>
                                    {{$lists->links()}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Message : Expert Bells</title>
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
    <x-user.message-popup/>    
    <script>
        $("#AllCheck").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    </script>
@endpush