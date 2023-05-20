@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('expert.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a aria-current="page">{{ucwords(str_replace('-',' ',request()->segment(2)))}} Calls</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-expert.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="text-center mb-4">Slot information</h3>
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
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-clipboard-list-check h6 m-0 me-2"></i> Booking No: <strong>#{{$bookings->booking_id}}</strong></li>
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-calendar-alt h6 m-0 me-2"></i> Booking Date: {{dateformat($bookings->booking_date)}}</li>
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-user-clock h6 m-0 me-2"></i> Duretion: {{$mins}} minutes</li>
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-alarm-clock h6 m-0 me-2"></i> Time: {{date('H:i A',strtotime($bookings->booking_start_time))}} - {{date('H:i A',strtotime($bookings->booking_end_time))}}</li>
                                    </ul>
                                </div>
                                <div class="card-footer p-2 px-3 border-0 justify-content-center text-u fw-bold">
                                    @if($bookings->payment==1 || $bookings->payment==3)
                                        @if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s',strtotime($bookings->booking_date.' '.$bookings->booking_start_time)))
                                            @if($bookings->reschedule_slot==0)
                                                <span class="text-secondary">{{$bookings->status==0?'NEW BOOKING':''}}</span>
                                                <span class="text-primary">{{$bookings->status==1?'BOOKING CONFIRM':''}}</span>
                                                <span class="text-danger">{{$bookings->status==2?'BOOKING REJECTED':''}}</span>
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
                            <div class="card UserBox p-0">
                                <div class="card-header text-u fw-bold p-2 px-3">Amount & Diduction</div>
                                <div class="card-body d-block p-2 px-3">
                                    <ul class="list-group border-0 rounded-0 small">
                                        <li class="list-group-item border-0 border-bottom px-0">Booking Amount: <strong>{{defaultcurrency()}} {{$bookings->booking_amount - $bookings->service_charges}}</strong></li>
                                        <li class="list-group-item border-0 border-bottom px-0">Service Charges: <strong>{{defaultcurrency()}} {{$bookings->service_charges}}</strong></li>
                                        <li class="list-group-item border-0 border-bottom px-0">GST ({{$bookings->gst ?? 0}}%): <strong>{{defaultcurrency()}} {{$bookings->gst_amount ?? 0}}</strong></li>
                                        <li class="list-group-item border-0 border-bottom px-0">Paid Amount: <strong>{{defaultcurrency()}} {{$bookings->paid_amount}}</strong></li>
                                        @if($bookings->refund>0)
                                        <li class="list-group-item border-0 border-bottom px-0">Refunded: <strong>{{defaultcurrency()}} {{$bookings->refund ?? 0}}</strong></li>                                                            
                                        @endif
                                    </ul>
                                </div>
                                <div class="card-footer p-2 px-3 border-0 justify-content-center text-u fw-bold">
                                    @if($bookings->payment==0)<span class="text-secondary"> INCOMPLETE PROCESS</span> @endif
                                    @if($bookings->payment==1)<span class="text-success"> PAYMENT RECEIVED</span>@endif
                                    @if($bookings->payment==2)<span class="text-danger"> PAYMENT FAILED</span>@endif
                                    @if($bookings->payment==3)<span class="text-primary"> WALLET</span>@endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="ms-md-4">
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3">User Information</div>
                                <div class="row m-md-0">
                                    <div class="col-md-6 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <strong>User:</strong>
                                                {{$bookings->user_name ?? $bookings->user->name}}
                                            </li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <strong>Email:</strong>
                                                {{$bookings->user_email ?? $bookings->user->email}}
                                            </li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <strong>DOB:</strong>
                                                @if(!empty($bookings->user->dob))
                                                {{dateformat($bookings->user->dob)}}
                                                @else
                                                -----
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <strong>Contact:</strong>
                                                +{{$bookings->user_number ?? $bookings->user->ccode.''.$bookings->user->mobile}}</li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <strong>Gender:</strong>
                                                @if(!empty($bookings->user))
                                                    {{$bookings->user->gender==1?'Male':''}}
                                                    {{$bookings->user->gender==2?'Female':''}}
                                                    {{$bookings->user->gender==0?'Other':''}}
                                                @else
                                                    --------
                                                @endif
                                            </li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent">
                                                <strong>Location:</strong>
                                                @if(!empty($bookings->user->cities)) {{$bookings->user->cities->name ?? ''}}, @endif
                                                @if(!empty($bookings->user->states)) {{$bookings->user->states->name ?? ''}}, @endif
                                                @if(!empty($bookings->user->countires)) {{$bookings->user->countires->name ?? ''}} @endif
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
                                        <strong>Date:</strong>
                                        {{dateformat($bookings->reject_date)}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>Reason:</strong>
                                        {!!$bookings->reject_reason!!}
                                    </li>
                                </ul>
                                @endif

                                @if($bookings->call_invitation>0)
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3 mt-4">MEETING INFORMATION</div>
                                <ul class="list-group border-0 bg-0 rounded-0 small">
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>Invitation :</strong>
                                        {{$bookings->call_invitation==1?'Invitation Sent':''}}
                                        {{$bookings->call_invitation==2?'Accept & Join Meeting':''}}
                                    </li>
                                    @if($bookings->call_end_by>0)
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>Call closed :</strong>
                                        {{datetimeformat($bookings->call_end)}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>Call closed by :</strong>
                                        <span class="text-danger">This call closed by {{$bookings->call_end_by_type==1?'Expert':'You'}}</span>
                                    </li>
                                    @endif
                                </ul>
                                @endif
                                
                                @if($bookings->transfer_amount > 0)
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3 mt-4">TRANSFER AMOUNT</div>
                                <ul class="list-group border-0 bg-0 rounded-0 small">
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>Amount:</strong>
                                        {{$bookings->paid_amount}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>GST</strong>
                                        ({{$bookings->gst}}%): - {{$bookings->gst_amount}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>TDS</strong>
                                        ({{$bookings->tds}}%): - {{$bookings->tds_amount}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>Transfer Amount:</strong>
                                        {{$bookings->transfer_amount}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>Transfer Date:</strong>
                                        {{dateformat($bookings->transfer_date)}}
                                    </li>
                                </ul>
                                @endif
                                
                                @if($bookings->reschedule_slot>0)
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3 mt-4">RESCHEDULE SLOT</div>
                                <ul class="list-group border-0 bg-0 rounded-0 small">
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>Reschedule by :</strong>
                                        {{$bookings->reschedule_by==1?'You':''}}
                                        {{$bookings->reschedule_by==1?'Customer':''}}
                                        {{$bookings->reschedule_by==1? project() :''}}
                                    </li>
                                    <li class="list-group-item border-0 border-bottom bg-transparent pb-3">
                                        <strong>Reschedule Booking :</strong>
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
    </script>    
@endpush