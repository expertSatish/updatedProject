@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey py-0 MainConPart">
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
                    <div class="row m-0 justify-content-center">
                        <div class="col-lg-12 p-0">
                            <div class="ps-lg-5">
                            <div class="card UserBox MVideo p-0">
                                <div class="card-body">
                                    <button class="playbtn play"><span></span></button>
                                    <video poster="https://www.samwebstudio.co/expertbells/html/img/video-img.jpg" id="PVideo" controls><source src="https://www.samwebstudio.co/expertbells/html/img/video/video.mp4" type="video/mp4"></video>
                                </div>
                            </div>
                            <div class="bg-white mb-4 border-bottom">
                                <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                    <li class="nav-item me-2" role="presentation"><button class="nav-link active" id="info-tab" data-bs-toggle="pill" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Slot Information</button></li>
                                    {{-- <li class="nav-item me-2" role="presentation"><button class="nav-link" id="course-tab" data-bs-toggle="pill" data-bs-target="#course" type="button" role="tab" aria-controls="course" aria-selected="false">Sessions <span class="thm">(3)</span></button></li> --}}
                                </ul>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="rounded-4 bg-white border shadow-sm mb-3">
                                                <h6 class="mt-0 text-black border-bottom px-4 py-2">BOOKING INFORMATION</h6>
                                                @php 
                                                    $start = strtotime($bookings->booking_date.' '.$bookings->booking_start_time);
                                                    $end = strtotime($bookings->booking_date.' '.$bookings->booking_end_time);
                                                    $mins = ($end - $start) / 60;
                                                @endphp
                                                <div class="px-4">
                                                    <ul class="p-0">
                                                        <li class="border-bottom py-2"><small><i class="fas fa-clipboard-list"></i> Booking No: <b>#{{$bookings->booking_id}}</b></small></li>
                                                        <li class="border-bottom py-2"><small><i class="fas fa-calendar-alt"></i> Booking: {{dateformat($bookings->booking_date)}}</small></li>
                                                        <li class="border-bottom py-2"><small><i class="fas fa-user-clock"></i> Duration: {{$mins}} minutes</small></li>
                                                        <li class="py-2"><small><i class="fas fa-alarm-clock"></i> Time: {{date('H:i A',strtotime($bookings->booking_start_time))}} - {{date('H:i A',strtotime($bookings->booking_end_time))}}</small></li>
                                                    </ul>                                                    
                                                </div>
                                                <div class="text-center px-4 py-2 bg-light" style="font-weight: 800;">   {{$bookings->status}}
                                                    @if($bookings->status==0) <small class="text-secondary">NEW BOOKING</small> @endif                                                  
                                                    @if($bookings->status==1) <small class="text-primary">BOOKING CONFIRM</small> @endif                                                  
                                                    @if($bookings->status==2) <small class="text-danger">BOOKING REJECTED</small> @endif                                                  
                                                    @if($bookings->status==3) <small class="text-success">DONE & CLOSED</small> @endif                                                  
                                                    @if($bookings->reschedule_slot>0) 
                                                    <small class="text-danger">RESCHEDULE</small> 
                                                    @endif                                                
                                                </div>
                                            </div>

                                            <div class="rounded-4 bg-white border shadow-sm mb-5">
                                                <h6 class="text-black border-bottom px-4 py-2 mt-0 ">AMOUNT & DIDUCTION</h6>
                                                <div class="px-4">
                                                    <ul class="p-0">
                                                        <li class="border-bottom py-2"><small>Booking Amount: <b>{{defaultcurrency()}} {{$bookings->booking_amount}}</b></small></li>
                                                        <li class="border-bottom py-2"><small>Booking Discount: {{defaultcurrency()}} {{$bookings->coupon_discount ?? 0}}</small></li>
                                                        <li class="py-2"><small> Paid Amount: <b>{{defaultcurrency()}} {{$bookings->paid_amount}}</b></small></li>
                                                        @if($bookings->refund>0)
                                                        <li class="border-top py-2">
                                                            <small class="text-success">Refunded: <b>{{defaultcurrency()}} {{$bookings->refund ?? 0}}</b> </small>
                                                        </li>                                                            
                                                        @endif
                                                    </ul>
                                                </div> 
                                                <div class="text-center px-4 py-2 bg-light" style="font-weight: 800;">
                                                    @if($bookings->payment==0)<small class="text-secondary"> INCOMPLETE PROCESS</small> @endif
                                                    @if($bookings->payment==1)<small class="text-success"> PAYMENT RECEIVED</small>@endif
                                                    @if($bookings->payment==2)<small class="text-danger"> PAYMENT FAILED</small>@endif 
                                                    @if($bookings->payment==3)<small class="text-primary"> WALLET</small>@endif   
                                                </div>                                               
                                            </div>
                                        </div>
                                        <div class="col-8">                                            
                                            <h6 class="text-black border-bottom pb-2">USER INFORMATION</h6>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><small><b>User:</b> {{$bookings->user_name ?? $bookings->user->name}}</small></td>
                                                        <td><small><b>Contact:</b> +{{$bookings->user_number ?? $bookings->user->ccode.''.$bookings->user->mobile}}</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small><b>Email:</b> {{$bookings->user_email ?? $bookings->user->email}}</small></td>
                                                        <td>
                                                            <small>
                                                                <b>Gender:</b>
                                                                {{$bookings->user->gender==1?'Male':''}}
                                                                {{$bookings->user->gender==2?'Female':''}}
                                                                {{$bookings->user->gender==0?'Other':''}}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <small>
                                                                <b>DOB:</b>
                                                                @if(!empty($bookings->user->dob))
                                                                {{dateformat($bookings->user->dob)}}
                                                                @else
                                                                -----
                                                                @endif
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <small>
                                                                <b>Location:</b>
                                                                @if(!empty($bookings->user->cities)) {{$bookings->user->cities->name ?? ''}}, @endif
                                                                @if(!empty($bookings->user->states)) {{$bookings->user->states->name ?? ''}}, @endif
                                                                @if(!empty($bookings->user->countires)) {{$bookings->user->countires->name ?? ''}} @endif
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <small>
                                                                <b>Query: </b>
                                                                {!! $bookings->query !!}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            
                                            @if(!empty($bookings->reject_reason))
                                                <h6 class="text-black border-bottom pb-2">BOOKING REJECTED</h6>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <small><b> Date: </b>
                                                                    {{dateformat($bookings->reject_date)}}
                                                                </small>                                                                
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <small><b>Reason:</b>
                                                                    {!!$bookings->reject_reason!!}
                                                                </small>                                                                
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @endif

                                            @if($bookings->call_invitation>0)
                                            <h6 class="text-black border-bottom pb-2">MEETING INFORMATION</h6>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <small><b>Invitation :</b> 
                                                                {{$bookings->call_invitation==1?'Invitation Sent':''}}
                                                                {{$bookings->call_invitation==2?'Accept & Join Meeting':''}}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    @if($bookings->call_end_by>0)
                                                    <tr>
                                                        <td>
                                                            <small>
                                                                <b>Call closed :</b>
                                                                {{datetimeformat($bookings->call_end)}}
                                                            </small>
                                                        </td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <td>
                                                            <small>
                                                                <b>Call closed by :</b>
                                                                <span class="text-danger">
                                                                    This call closed by {{$bookings->call_end_by_type==1?'Expert':'You'}}
                                                                </span>
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            @endif

                                            @if($bookings->transfer_amount > 0)
                                            <h6 class="text-black border-bottom pb-2">TRANSFER AMOUNT</h6>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <small>Amount: {{$bookings->paid_amount}}</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <small>GST ({{$bookings->gst}}%): - {{$bookings->gst_amount}}</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <small>TDS ({{$bookings->tds}}%): - {{$bookings->tds_amount}}</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <small>Transfer Amount: {{$bookings->transfer_amount}}</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <small>Transfer Date: {{dateformat($bookings->transfer_date)}}</small>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @endif

                                            @if($bookings->reschedule_slot>0)
                                            <h6 class="text-black border-bottom pb-2">RESCHEDULE SLOT</h6>
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <small><b>Reschedule by :</b>
                                                            {{$bookings->reschedule_by==1?'You':''}}
                                                            {{$bookings->reschedule_by==1?'Customer':''}}
                                                            {{$bookings->reschedule_by==1? project() :''}}
                                                        </small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small><b>Reschedule Booking :</b>
                                                            #{{$bookings->reschedule->booking_id ?? 0}}
                                                        </small>
                                                        
                                                    </td>
                                                </tr>
                                            </table>
                                            @endif
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="tab-pane fade" id="course" role="tabpanel" aria-labelledby="course-tab" tabindex="0">
                                    <div class="CmsPage">
                                        <h3 class="text-black">All Session Information</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                    </div>
                                    <ul class="CourseSteps">
                                        <li><a data-bs-toggle="collapse" href="#Qu1" role="button" aria-expanded="false" aria-controls="Qu1" class="d-flex"><h3 class="h6 font fw-bold m-0">Session 1: Introduction</h3></a>
                                            <div class="collapse shadow-sm show CmsPage" id="Qu1">
                                                <div class="mb-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</div>
                                                <ul>
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a data-bs-toggle="collapse" href="#Qu2" role="button" aria-expanded="false" aria-controls="Qu2" class="d-flex collapsed"><h3 class="h6 font fw-bold m-0">Session 2</h3></a>
                                            <div class="collapse shadow-sm CmsPage" id="Qu2">
                                                <div class="mb-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                                                <ul>
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a data-bs-toggle="collapse" href="#Qu3" role="button" aria-expanded="false" aria-controls="Qu3" class="d-flex collapsed"><h3 class="h6 font fw-bold m-0">Session 3</h3></a>
                                            <div class="collapse shadow-sm CmsPage" id="Qu3">
                                                <div class="mb-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                                                <ul>
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a data-bs-toggle="collapse" href="#Qu4" role="button" aria-expanded="false" aria-controls="Qu4" class="d-flex collapsed"><h3 class="h6 font fw-bold m-0">Session 4</h3></a>
                                            <div class="collapse shadow-sm CmsPage" id="Qu4">
                                                <div class="mb-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
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
<style>
@media (min-width:992px){.MainConPart>div>.row,.banner>div>.row{margin:0!important}
.MainConPart>div>.row>div,.banner>div>.row>div{padding:0!important}
.MainConPart>div>.row>.col-lg-4{width:28%}
.MainConPart>div>.row>.col-lg-8{width:72%}}
.starBox small{display:inline-block;padding:1px 12px;background:var(--thm);border-radius:5px}
.starBox .star:before{color:var(--white)}
/*.MainConPart{z-index:3;overflow:initial}*/
.ImgBox{box-shadow:0 4px 9px rgb(var(--blackrgb)/.2);border:none;overflow:hidden;border-radius:15px}
.ImgBox.First{margin-top:-284px}
.ImgBox>div{border:none;background:none}
.ImgBox .card-header{height:284px;padding:0}
.ImgBox .card-header img{height:100%;width:100%;object-fit:cover}
.ImgBox .card-body .fw-500{font-weight:500}
.ImgBox .card-body .fw-600{font-weight:600}
.ImgBox .card-body .ReminderShare{display:flex;margin:0;padding:0;justify-content:space-between;column-gap:25px}
.ImgBox .card-body .ReminderShare small{line-height:normal!important;margin-top:5px}
.ImgBox .card-body .ReminderShare button{border:none}
.ImgBox .card-body .rounded-pill{background:rgb(var(--thmrgb)/.2);text-transform:capitalize;line-height:normal}
.ImgBox .card-body .rounded-pill:hover{background:var(--thm);color:var(--white)}
.ImgBox .card-body .Spec{margin:0;padding:0}
.btn.btn-sm>img{transform:scalex(1) translateX(0)!important;filter:invert(1)}
.nav-pills{position:relative}
.nav-pills:after,.nav-pills:before{position:absolute;background:linear-gradient(90deg,transparent,#fff);content:'';width:30px;top:0;left:-30px;height:calc(100% + 1px);border-bottom:var(--bs-border-width) var(--bs-border-style);border-image:linear-gradient(90deg,transparent,var(--bs-border-color)) 100% 1 !important;box-sizing:border-box;}
.nav-pills:after{left:auto;right:-30px;transform:scaleX(-1)}
.nav-pills .nav-link{border:none;color:rgb(var(--blackrgb)/.5)!important;padding:12px 0;background:none;border-radius:0;font-weight:700;margin-right:30px;position:relative}
.nav-pills .nav-link:after{border-bottom:2px solid;content:'';position:absolute;left:0;right:0;margin:0 auto;bottom:-1px;width:0;transition:all .5s}
.nav-pills .nav-link.active{background:none!important;color:var(--black)!important}
.nav-pills .nav-link.active:after{width:100%}
.CmsPage *{font-family:var(--font)!important}
.CmsPage h1,.CmsPage h2,.CmsPage h3,.CmsPage h4,.CmsPage h5,.CmsPage h6{font-weight:700}
.CmsPage p,.CmsPage ul li{font-size:15px!important}
.UserBox.MVideo{max-height:450px!important;height:100%!important;min-height:450px!important;overflow:hidden;border-radius:0!important}
.UserBox.MVideo>div{padding:0;height:100%}
.UserBox.MVideo video{height:100%;width:100%;object-fit:contain}

.CourseSteps{padding:0;margin:0}
.CourseSteps>li{position:relative;counter-increment:chapter-num;padding-left:25px;padding-bottom:20px}
.CourseSteps>li p{line-height:130%!important;margin:0}
.CourseSteps>li>*{padding:1px 30px}
.CourseSteps>li>a{background:rgb(var(--thmrgb)/.1);border:1px solid rgb(var(--thmrgb)/.1);justify-content:space-between;align-items:center;padding:8px 15px 8px 30px}
.CourseSteps>li>a:after,.LeftPS>li>a:after{background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 106.36 57.68" fill="none" stroke="%23000" stroke-linecap="round" stroke-linejoin="round" stroke-width="9px"><polyline points="101.86 4.5 53.18 53.18 4.5 4.5"/></svg>') center/15px no-repeat;content:'';height:15px;width:15px;transition:all .5s}
.CourseSteps>li>div>*:last-child{padding-bottom:25px}
.CourseSteps>li>a:not(.collapsed):after,.LeftPS>li>a:not(.collapsed):after{transform:rotate(180deg)}
.CourseSteps>li>div{background:var(--white)}
.CourseSteps>li h3{font-weight:600!important}
.CourseSteps>li:after{content:""counter(chapter-num)"";position:absolute;height:32px;width:32px;border-radius:50%;background:var(--thm1);border:5px solid #f3f3f3;display:grid;place-content:center;color:var(--thm);font-weight:600;left:0;top:0;outline:1px solid rgb(var(--thmrgb)/.1);box-sizing:initial}
.CourseSteps>li:before{position:absolute;content:'';width:1px;height:100%;left:20px;top:0;background:rgb(var(--blackrgb)/.15)}
.CourseSteps>li:last-child:before{display:none}
.CourseSteps>li .BookS{margin:0 -30px;background:rgb(var(--thmrgb1)/.15)}

.ReviewBlock{padding:0 20px 20px}
.ReviewBlock>div{border-top:1px solid rgb(var(--blackrgb)/.1)!important;padding:15px 0 0;margin-top:15px;display:flex;justify-content:space-between}
.ReviewBlock>div:first-child{border:none!important;margin-top:0}
.ReviewBlock>div .img{width:75px}
.ReviewBlock>div .img img{height:60px;width:60px;border-radius:50%;box-shadow:0 2px 3px rgb(var(--blackrgb)/.3)}
.ReviewBlock>div>div{width:calc(100% - 60px)}
.ReviewBlock>div .star{margin-left:0}
.ReviewBlock>div h4{font-size:16px;margin-top:0;font-weight:600}
.ReviewBlock>div>div>span:last-child{font-size:12px!important}

.CmsPage ul{padding-left:15px;margin-bottom:0}
.CmsPage ul li{display:flex;margin-bottom:9px}
.CmsPage ul li:last-child{margin-bottom:0}
.CmsPage ul li:before{content:'';background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 467.48 218.06" fill="%23231f20"><path d="M422.29,120.94h-411c-14.86,0-15.24-23.92,0-23.92h411s-70.41-64.35-83.35-75.36C325.71,10.44,340.88-7.42,353.6,3.3s98.72,87.2,107.8,94.85c8.17,6.9,8.07,14.41-.07,21.27-26,21.91-96.3,86-107.88,95.77s-27.62-7.75-15.28-18.22S422.29,120.94,422.29,120.94Z"/></svg>') center/1.5em auto no-repeat;min-width:25px;height:25px;margin-right:15px;opacity:.6}

.LeftPS{background:var(--white)}
.LeftPS ol{padding-left:25px}
.LeftPS ol>li{margin-bottom:6px;font-weight:500}
/*.LeftPS>ul>li>a{justify-content:space-between;align-items:center;background:rgb(var(--thmrgb)/.08)}*/
.LeftPS>ul>li>a h3{font-size:14px}
.LeftPS>ul>li>div .form-check:last-child{margin-bottom:0!important}

.LeftPS .ReminderShare{display:flex;margin:0;padding:0;justify-content:space-between;column-gap:25px}
.LeftPS .ReminderShare small{line-height:normal!important;margin-top:5px}

.ConBox{max-height:18rem;overflow:hidden;position:relative;padding-bottom:50px}
.ConBox:after{background:linear-gradient(transparent,#f3f3f3 60%);position:absolute;width:100%;height:90px;left:0;bottom:0;content:''}
.ConBox.show{max-height:none!important;overflow:initial}
.ConBox.show:after{display:none}
.ConBox .showmore{position:absolute;bottom:0;left:0;z-index:1}
.ConBox .showmore img{transition:all .5s}
.ConBox .showmore.show img{transform:rotate(180deg)}
.bg-white .ConBox:after{background:linear-gradient(transparent,var(--white) 60%)}
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
    </script>    
@endpush