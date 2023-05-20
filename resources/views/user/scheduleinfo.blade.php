@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a aria-current="page">{{ucwords(str_replace('-',' ',request()->segment(2)))}} Calls</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-user.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    @if(!empty($bookings->call_meeting_code))
                    <div class="card UserBox MVideo p-0 mb-4 overflow-hidden">
                        <div class="card-body lh-0">
                            <button class="playbtn play"><span></span></button>
                            <video poster="https://www.samwebstudio.co/expertbells/html/img/video-img.jpg" id="PVideo" class="w-100" controls><source src="https://www.samwebstudio.co/expertbells/html/img/video/video.mp4" type="video/mp4"></video>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card UserBox p-0 mb-4">
                                <div class="card-header text-u fw-bold p-2 px-3">Booking Information</div>
                                @php 
                                    $start = strtotime($bookings->booking_date.' '.$bookings->booking_start_time);
                                    $end = strtotime($bookings->booking_date.' '.$bookings->booking_end_time);
                                    $mins = ($end - $start) / 60;
                                @endphp
                                <div class="card-body d-block p-2 px-3">
                                    <ul class="list-group border-0 rounded-0 small">
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-clipboard-list-check h6 m-0 me-2"></i> Booking No: <b>#{{$bookings->booking_id}}</b></li>
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-calendar-alt h6 m-0 me-2"></i> Booking Date: {{dateformat($bookings->booking_date)}}</li>
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-user-clock h6 m-0 me-2"></i> Duration: {{$mins}} minutes</li>
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-alarm-clock h6 m-0 me-2"></i> Time: {{date('H:i A',strtotime($bookings->booking_start_time))}} - {{date('H:i A',strtotime($bookings->booking_end_time))}}</li>
                                    </ul>
                                </div>
                                <div class="card-footer p-2 px-3 border-0 justify-content-center text-u fw-bold">
                                    @if($bookings->payment==1 || $bookings->payment==3)
                                        @if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s',strtotime($bookings->booking_date.' '.$bookings->booking_start_time)))
                                            @if($bookings->reschedule_slot==0)
                                                <span class="text-secondary">{{$bookings->status==0?'NEW':''}}</span>
                                                <span class="text-primary">{{$bookings->status==1?'CONFIRM':''}}</span>
                                                <span class="text-danger">{{$bookings->status==2?'REJECTED':''}}</span>
                                                <span class="text-success">{{$bookings->status==3?'DONE & CLOSED':''}}</span>
                                            @else
                                            <span class="text-danger">RESCHEDULE</span> 
                                            @endif
                                        @else
                                            @if($bookings->reschedule_slot>0) 
                                                <span class="text-danger">RESCHEDULE</span> 
                                            @elseif($bookings->status==2)
                                            <span class="text-danger">REJECTED</span>
                                            @else
                                            <span class="text-danger">NOT ATTENDED</span>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="card UserBox p-0 mb-4">
                                <div class="card-header text-u fw-bold p-2 px-3">Amount & Diduction</div>
                                <div class="card-body d-block p-2 px-3">
                                    <ul class="list-group border-0 rounded-0 small">
                                        <li class="list-group-item border-0 border-bottom px-0">Booking Amount: <b>{{defaultcurrency()}} {{$bookings->booking_amount}}</b></small></li>
                                        @if($bookings->coupon_discount > 0)
                                        <li class="list-group-item border-0 border-bottom px-0">Booking Discount: <b>{{defaultcurrency()}} {{$bookings->coupon_discount ?? 0}}</b></small></li>
                                        @endif
                                        @if($bookings->gst > 0)
                                        <li class="list-group-item border-0 border-bottom px-0">GST({{$bookings->gst ?? 0}}%) : <b>{{defaultcurrency()}} {{$bookings->gst_amount ?? 0}}</b></small></li>
                                        @endif
                                        <li class="list-group-item border-0 border-bottom px-0">Paid Amount: <b>{{defaultcurrency()}} {{$bookings->paid_amount}}</b></small></li>
                                        @if($bookings->refund>0)
                                        <li class="list-group-item border-0 border-bottom px-0"><small class="text-success">Refunded: <b>{{defaultcurrency()}} {{$bookings->refund ?? 0}}</b> </small>
                                        </li>                                                            
                                        @endif
                                    </ul>
                                </div> 
                                <div class="card-footer p-2 px-3 border-0 justify-content-center text-u fw-bold">
                                    @if($bookings->payment==0)<span class="text-secondary"> INCOMPLETE PROCESS</span> @endif
                                    @if($bookings->payment==1)<span class="text-success"> PAYMENT RECEIVED</span>@endif
                                    @if($bookings->payment==2)<span class="text-danger"> PAYMENT FAILED</span>@endif 
                                    @if($bookings->payment==3)<span class="text-primary"> WALLET</small>@endif    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="ms-md-4">
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3">Expert & Slot Information</div>
                                <div class="row m-md-0">
                                    <div class="col-md-6 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <b>Expert:</b>
                                                {{$bookings->expert->name ?? ''}}
                                            </li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <b>Email:</b>
                                                {{$bookings->expert->email ?? ''}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <b>Contact:</b>
                                                +{{$bookings->expert->ccode ?? ''}}{{$bookings->expert->mobile ?? ''}}
                                            </li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <b>&nbsp;</b>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent pb-3"><b class="d-block">1. Tell us about your Startup ? </b> {!! $bookings->query !!}</li>
                                        </ul>
                                    </div>
                                    <div class="col-12 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent pb-3"><b class="d-block">2. What are the major challenges you are facing ? </b> {!! $bookings->facing_challenges_query !!}</li>
                                        </ul>
                                    </div>
                                    <div class="col-12 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent pb-3"><b class="d-block">3. What questions do you want to ask to the mentor ? </b> {!! $bookings->ask_question_query !!}</li>
                                        </ul>
                                    </div>
                                    <div class="col-12 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent pb-3"><b class="d-block">4. Have you previously worked with any mentors or coaches, and if so, what was the experience like ? </b> {!! $bookings->experience_query !!}</li>
                                        </ul>
                                    </div>
                                    <div class="col-12 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent pb-3"><b class="d-block">5. Attachment</b> 
                                                @if (!empty($bookings->query_attachment))
                                                    <a href="{{asset('uploads/booking-attachment/'.$bookings->query_attachment)}}" download="download"><i class="fad fa-download"></i> Download Attachment</a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            
                                @if(!empty($bookings->reject_reason))
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3 mt-4">BOOKING REJECTED</div>
                                <ul class="list-group border-0 bg-0 rounded-0 small">
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b> Date: </b>
                                        {{dateformat($bookings->reject_date)}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>Reason:</b>
                                        {!!$bookings->reject_reason!!}
                                    </li>
                                </ul>
                                @endif

                                @if($bookings->call_invitation>0)
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3 mt-4">MEETING INFORMATION</div>
                                <ul class="list-group border-0 bg-0 rounded-0 small">
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>Invitation :</b> 
                                        {{$bookings->call_invitation==1?'Invitation Sent':''}}
                                        {{$bookings->call_invitation==2?'Accept & Join Meeting':''}}
                                    </li>
                                    @if($bookings->call_end_by>0)
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>Call closed :</b>
                                        {{datetimeformat($bookings->call_end)}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>Call closed by :</b>
                                        <span class="text-danger">
                                            This call closed by {{$bookings->call_end_by_type==1?'Expert':'You'}}
                                        </span>
                                    </li>
                                    @endif
                                </ul>
                                @endif

                                @if($bookings->transfer_amount > 0)
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3 mt-4">TRANSFER AMOUNT</div>
                                <ul class="list-group border-0 bg-0 rounded-0 small">
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>Amount:</b>
                                        {{$bookings->paid_amount}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>GST</b> 
                                        ({{$bookings->gst}}%): - {{$bookings->gst_amount}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>TDS</b> 
                                        ({{$bookings->tds}}%): - {{$bookings->tds_amount}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>Transfer Amount:</b> 
                                        {{$bookings->transfer_amount}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>Transfer Date:</b> 
                                        {{dateformat($bookings->transfer_date)}}
                                    </li>
                                </ul>
                                @endif

                                @if($bookings->reschedule_slot>0)
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3 mt-4">RESCHEDULE SLOT</div>
                                <ul class="list-group border-0 bg-0 rounded-0 small">
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>Reschedule by :</b>
                                        {{$bookings->reschedule_by==1?'You':''}}
                                        {{$bookings->reschedule_by==1?'Customer':''}}
                                        {{$bookings->reschedule_by==1? project() :''}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <b>Reschedule Booking :</b>
                                        #{{$bookings->reschedule->booking_id ?? 0}}
                                    </li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>           
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Booking #{{$bookings->booking_id}} Information : {{project()}}</title>
<meta name="description" content="Welcome to Thera Session">
<meta name="keywords" content="Welcome to Thera Session">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<style>.MVideo .playbtn{width:auto!important;height:auto!important;padding:0;left:50%;top:48%!important;transform:translateX(-50%) translatey(-50%);position:absolute;cursor:pointer;z-index:2;border:none;background:none!important;transition:all .5s}
.MVideo .playbtn:not(.play){opacity:0;}
.MVideo .playbtn span{height:80px;width:80px;background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 126 126" fill="%23fff"><path d="M63,6A57,57,0,1,1,6,63H6A57,57,0,0,1,63,6m0-6a63,63,0,1,0,63,63A63,63,0,0,0,63,0Z"/><rect x="47.34" y="41.37" width="9.86" height="43.25"/><rect x="68.8" y="41.37" width="9.86" height="43.25"/></svg>') no-repeat center;background-size:contain;filter:drop-shadow(2px 4px 6px rgb(var(--blackrgb)/.5));display:block}
.MVideo .playbtn.play span{background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 126 126" fill="%23fff"><path%20d="M63,6A57,57,0,1,1,6,63,57,57,0,0,1,63,6m0-6a63,63,0,1,0,63,63A63,63,0,0,0,63,0Z"/><path%20d="M96.3,62.78l-54,31.05V31.73Z"/></svg>') no-repeat center;background-size:contain}
.MVideo:hover .playbtn:not(.play){opacity:1}
</style>
@endpush
@push('js')
<script>
$(document).ready(function(){
    $('.showmore').on('click', function(e) {
        e.preventDefault();
        $(this).find('span').text($(this).find('span').text() == 'Show less' ? 'Show more' : 'Show less');
        if ($(this).hasClass('show')){
            $(this).removeClass('show')
            $(this).closest(".ConBox").removeClass('show');
        } else {
            $(this).addClass('show')
            $(this).closest(".ConBox").addClass('show');
        }
    });
})
var ctrlVideo = document.getElementById("PVideo");
$('.playbtn').click(function() {
    // alert();
    if ($('.playbtn').hasClass("play")){ctrlVideo.play();
        $('.playbtn').removeClass("play");
    } else{ctrlVideo.pause();
        $('.playbtn').addClass("play");
    }
});
</script>    
@endpush