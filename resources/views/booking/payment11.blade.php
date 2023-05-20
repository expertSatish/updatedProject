@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3 pb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Payment</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <h1 class="h3 text-center thm">Pay Now</h1>
                    <h2 class="h6 text-center">This is the last step, pay for an appointment with an expert.</h2>
                    <div class="card ExpertBOx rounded-3 bg-light border">
                        <div class="card-body">
                            <div class="img rounded-circle border">
                                <x-image-box>
                                    <x-slot:image>{{$lists->expert->profile}}</x-slot:image>
                                    <x-slot:path>/uploads/expert/</x-slot:image>
                                    <x-slot:alt>{{$lists->expert->name ?? ''}} {{!empty($lists->expert->expertise->title) ? '('.$lists->expert->expertise->title.')' : ''}} </x-slot:image>
                                    <x-slot:width>380</x-slot:image>
                                    <x-slot:height>480</x-slot:image>
                                </x-image-box>
                            </div>
                            <div class="text">
                                <h3 class="h5 text-black verify">{{$lists->expert->name ?? ''}}</h3>
                                @if(!empty($lists->expert->suitable_industry))
                                <span class="text-secondary">
                                    @foreach(json_decode($lists->expert->suitable_industry) as $industry)
                                        @php $industry = \App\Models\Industry::find($industry); @endphp
                                        {{$industry->title ?? ''}} {{!$loop->last?'+':''}}
                                    @endforeach     
                                </span>
                                @endif
                                <div class="thm ExpStar"><span class="star" data-title="{{floatval($lists->expert->publishreviews()->avg('rating'))}}"></span> {{floatval($lists->expert->publishreviews()->avg('rating'))}} </div>
                            </div>
                        </div>
                    </div>
                    <div class="CallInfo">
                        <div class="d-flex justify-content-between">
                            <div class="SetTime text-secondary">
                                <div class="mb-1"><small><i class="far fa-calendar-alt text-black"></i> {{date('l, d M',strtotime($lists->booking_date))}}</small></div>
                                <div><small><i class="far fa-clock text-black"></i> {{substr($lists->booking_start_time,0,-3)}} to {{substr($lists->booking_end_time,0,-3)}}</small></div>
                                @if($lists->coupon_discount > 0)
                                <div><small><i class="far fa-check text-black"></i> Coupon Applied</small></div>
                                @endif
                            </div>
                            <div class="text-end">
                                <small>
                                    <span>Booking No: </span>
                                    <span class="text-black fw-bold">#{{$lists->booking_id}}</span>
                                </small><br>                        
                                <small>
                                    <span>Booking Amount: </span>
                                    <span class="text-black fw-bold"> {{defaultcurrency()}} {{$lists->booking_amount}}/-</span>
                                </small>
                                @if($lists->coupon_discount > 0)
                                <br><small>
                                    <span>Discount Amount: </span>
                                    <span class="text-black fw-bold"> {{defaultcurrency()}} {{$lists->coupon_discount}}/-</span>
                                    <a href="{{route('couponcancel',['booking'=>$lists->booking_id])}}" class="text-danger sws-top sws-bounce" data-title="Cancel Applied Coupon"><i class="fas fa-trash"></i></a>
                                </small>
                                @endif 
                                @if($lists->gst > 0)
                                <br><small>
                                    <span>GST ({{$lists->gst}}%): </span>
                                    <span class="text-black fw-bold"> {{defaultcurrency()}} {{$lists->gst_amount}}/-</span>
                                </small>
                                @endif                        
                            </div>
                        </div>
                        <div class="price mt-3 text-center text-black fw-bold">Paid Amount: {{defaultcurrency()}} {{$lists->paid_amount}}/-</div>
                        <div class="text-center">
                            <label for="walletamount">
                                <small><input type="checkbox" name="walletamount" id="walletamount"> <b>Available Wallet:</b> {{defaultcurrency()}} {{userinfo()->wallet}}</small>
                            </label>
                        </div>
                    </div>
                    <div class="CustomerInfo">
                        <div class="row mt-4">
                            @if(empty($lists->coupon_discount))
                            {{-- <div class="col-lg-6 border-end">
                                <form class="me-lg-3" method="POST" action="{{route('couponapply')}}">
                                    @csrf
                                    <input type="hidden" name="booking" value="{{$lists->id}}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="coupon" placeholder="Apply Coupon">
                                        <button class="ms-2 formbtn csbtn" onclick="$('.cpbtn').show(); $('.csbtn').hide()"><i class="fal fa-arrow-right"></i></button>
                                        <button type="button" style="display: none" class="ms-2 cpbtn formbtn"><i class="fad fa-spinner-third fa-spin"></i></button>
                                    </div>
                                    @error('coupon') <small class="error">{{$message}}</small> @enderror
                                </form>
                            </div> --}}
                            @endif
                            {{-- <div class="col-lg-{{$lists->coupon_discount>0?'12':'6'}} text-center">
                                <a href="{{route('paymentresponse',['booking'=>$lists->booking_id])}}" onclick="$('.pbtn').hide(); $('.ldbtn').show();" class="btn formbtn btn-thm2 m-auto pbtn px-4">Pay Now <i class="fal fa-arrow-right ms-2"></i></a>
                                <button class="btn formbtn btn-thm2 m-auto ldbtn px-4" style="display: none" disabled type="button"><i class="fad fa-spinner-third fa-spin me-2"></i> Loadin...</button>
                            </div> --}}
                            <div class="col-lg-{{$lists->coupon_discount>0?'12':'12'}} text-center">
                                <a href="{{route('paymentresponse',['booking'=>$lists->booking_id])}}" id="paymentbtn" onclick="$('.pbtn').hide(); $('.ldbtn').show();" class="btn formbtn btn-thm2 m-auto pbtn px-4">Pay Now <i class="fal fa-arrow-right ms-2"></i></a>
                                <button class="btn formbtn btn-thm2 m-auto ldbtn px-4" style="display: none" disabled type="button"><i class="fad fa-spinner-third fa-spin me-2"></i> Loadin...</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{asset('frontend/img/bg-img1.svg')}}" width="900" height="500" class="bg-img">
    </section>
</main>
@endsection
@push('css')
<title>Payment : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
.ExpertBOx,.CallInfo{width:450px;margin:20px auto 0;}
.ExpertBOx>div{display:flex;justify-content:center;}
.ExpertBOx .img{height:90px; min-width:90px;overflow:hidden;}
.ExpertBOx .img img{height:100%;width:100%;object-fit:contain;}
.ExpertBOx .text{width:calc(100% - 90px);margin-left:20px;}
.ExpertBOx .text .star{font-size:18px!important;}
.CountryCode a{border:1px solid #e1e1e1;display:flex;align-items:center;line-height:normal!important;background:var(--white)!important;padding:9px 25px;border-radius:30px;}
.CountryCode a:after{font-size:18px}
.CountryCode a span{max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;font-size:18px!important;text-transform:uppercase}
.CountryCode a span:after{display:none}
.CountryCode .CountryCode{max-width:66px;text-align:center;padding:0!important}
.CountryCode>.form-control,.CustomerInfo .form-control{height:calc(3rem + 2px);border-radius:0 30px 30px 0!important;font-size:18px;padding:0 20px;}
.CustomerInfo .form-control{border-radius:30px!important;}
.CountryCode>.countrylist{padding:0;max-height:200px;overflow:auto;background:var(--white);right:auto!important;left:0!important}
.formbtn{height:50px;min-width:50px!important;width:auto!important;display:flex;align-items:center; justify-content:center; border-radius:35px!important;border:1px solid var(--thm)!important;font-size:22px!important;color:var(--thm)!important}
.formbtn.btn-sm{font-size:16px!important;padding:0 15px;height:36px}
.otpn{height:50px;max-width:50px!important;border-radius:9px!important;padding:0!important;font-size:18px!important}
.formbtn:hover{background:var(--thm)!important;color:var(--white)!important;}
/* .SetTime{border:1px dashed rgb(var(--blackrgb)/.1);padding:9px 15px;border-radius:9px;display:inline-block;} */
.price{font-size:22px!important;}
section.grey>div{z-index:2;position:relative;}
img.bg-img{position:relative;bottom:0;opacity:.6;margin-top:-9%;width:100%;height:auto;z-index:1;}
</style>
@endpush
@push('js')
<script>
    $('#walletamount').on('click',function(e){
        let walletcheckbox = $(this).prop('checked');
        if(walletcheckbox==true){
            $('#paymentbtn').attr('href',@json(route('paymentwalletresponse',['booking'=>$lists->booking_id])));
        }else{
            $('#paymentbtn').attr('href',@json(route('paymentresponse',['booking'=>$lists->booking_id])));
        }
    });    
</script>
@endpush