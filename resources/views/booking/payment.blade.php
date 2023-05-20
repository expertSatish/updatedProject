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
            <div class="px-lg-5">
                <div class="row justify-content-around">
                    <div class="col-lg-5 col-md-6 PayD">
                        <h3 class="mb-4 h2">1-on-1 Session with Mentor</h3>
                        <h4 class="h5 thm3">The Agenda of Your Consultation</h4>
                        <ul class="small">
                            <li class="mb-2 text-secondary">Social Media Growth Hacking</li>
                            <li class="mb-2 text-secondary">Revenue Growth within Next 30/90 days</li>
                            <li class="mb-2 text-secondary">Create Your Own Info Product</li>
                        </ul>
                        <h4 class="h5 thm3 mt-5">After you book a session, you get a <strong>Questionnaire</strong> on your mail id. You have to fill that out and send back to us.</h4>
                        <p class="text-secondary mt-5">Currently Dates Available from : October Week 2</p>
                        <div class="mt-5">
                            <h4 class="h5 thm mt-5 thm">Contact Us:</h4>
                            <div class="small mb-2 thm"><a href="mailto:info@expertbells.com"><i class="fas fa-envelope me-2"></i> info@expertbells.com</a></div>
                            <div class="small mb-2 thm"><a href="tel:+917438997438"><i class="fas fa-phone-alt me-2"></i> +917438997438</a></div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <form action="{{route('paymentresponse',['booking'=>$lists->booking_id])}}" method="POST" class="card border-0 PayForm">
                            @csrf
                            <div class="card-body">
                                <h3 class="mb-4 h4">Payment Details</h3>
                                <div class="d-sm-flex align-items-center mb-4">
                                    <label for="amount" class="text-secondary">Amount</label>
                                    <div class="w-50 lh-n">
                                        <input type="text" class="form-control w-100" id="amount" value="{{$lists->paid_amount}}" name="amount" readonly>
                                        @error('amount') <span class="error">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <input type="hidden" id="booking_id" value="{{$lists->booking_id}}">
                                <input type="hidden" id="expert_id" value="{{$lists->expert_id}}">
                                <input type="hidden" id="user_id" value="{{$lists->user_id}}">
                                <div class="d-sm-flex align-items-center mb-4">
                                    <label for="name" class="text-secondary">Your Name</label>
                                    <div class="w-50 lh-n">
                                        <input type="text" class="form-control w-100" id="name" name="name" value="{{$lists->user->name ?? $lists->user_name}}">
                                        @error('name') <span class="error">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center mb-4">
                                    <label for="email" class="text-secondary">Email</label>
                                    <div class="w-50 lh-n">
                                        <input type="email" class="form-control w-100" id="email" name="email" value="{{$lists->user->email ?? $lists->user_email}}">
                                        @error('email') <span class="error">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center mb-4">
                                    <label for="phone" class="text-secondary">Phone</label>
                                    <div class="w-50 lh-n">
                                        <input type="number" class="form-control w-100" id="phone" name="phone" value="{{$lists->user->mobile ?? $lists->user_number}}">
                                        @error('phone') <span class="error">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center mb-4">
                                    <label for="city" class="text-secondary">City</label>
                                    <div class="w-50 lh-n">
                                        <input type="text" class="form-control w-100" id="city" name="city" value="{{ $lists->user->cities->name ?? $lists->user_city}}">
                                        @error('city') <span class="error">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center mb-4">
                                    <label for="city" class="text-secondary">Apply Coupon Code</label>
                                    @if($lists->coupon)
                                    <p class="text-success">{{$lists->coupon}} Coupon Applied</p>
                                    @else
                                    <div class="w-50 lh-n">
                                        <input type="text" class="form-control w-100" id="coupon"   name="coupon_title">
                                        <button class="btn btn-success btn-sm"   id="applyCoupon">Apply</button>
                                        <h6 id="successMessage"  style="display: none; color:green"></h6>
                                        <h6 id="errorMessage"  style="display: none; color:red"></h6>

                                    </div>
                                    @endif
                                    
                                </div>
                                @if($lists->gst > 0)
                                <hr>
                                <div class="text-end">
                                    <small><b>Booking Amount:</b> <i class="Ricon">&#8377;</i> {{$lists->booking_amount}}</small><br>
                                    <small><b>GST ({{$lists->gst}}%):</b> <i class="Ricon">&#8377;</i> {{$lists->gst_amount}}</small><br>
                                    @if(userinfo()->wallet > 0)
                                    <label for="walletamount">
                                        <small><input type="checkbox" name="walletamount" id="walletamount" value="{{userinfo()->wallet}}"> <b>Available Wallet:</b> <i class="Ricon">&#8377;</i> {{userinfo()->wallet}}</small>
                                    </label>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between ps-3">
                                <picture>
                                    <source srcset="{{asset('frontend/img/payment.webp')}}" type="image/webp">
                                    <img loading="lazy" src="{{asset('frontend/img/payment.jpg')}}" alt="payment" width="158" height="15">
                                </picture>
                                <button class="m-0 fw-semibold btn btn-thm1 btn-lg pbtn rounded-0 bgthm4">Pay <span class="ms-2 me-1">&#8377;</span>{{$lists->paid_amount}}</button>
                                <button type="button" style="display: none" class="m-0 fw-semibold btn btn-thm1 p-loader btn-lg rounded-0 disabled bgthm4"><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                                {{-- <a href="{{route('paymentquery')}}" class="m-0 fw-semibold btn btn-thm1 btn-lg rounded-0 bgthm4">Pay <span class="ms-2 me-1">&#8377;</span>{{$lists->paid_amount}} </a> --}}
                            </div>
                        </form>
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
<style>
.PayD ul:not(.browser-default)>li{list-style-type:disc;}
.PayForm{box-shadow:0 5px 20px rgb(var(--blackrgb)/.1);border-radius:0}
.PayForm>div{padding:30px;border:none}
.PayForm>div.card-footer{padding:0;}
.PayForm input{border-radius:0;background:var(--white)}
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
img.bg-img{position:relative;bottom:0;opacity:.6;margin-top:0;width:100%;height:auto;z-index:1;}
.bgthm4.btn-thm1:hover,.bgthm4.btn-thm1:focus{transform:translateY(0)!important;color:var(--white)!important}
.bgthm4.btn-thm1:hover:before,.bgthm4.btn-thm1:hover:after{background:var(--thm1)!important}
@media (min-width:575px){.PayForm label,.PayForm input{width:50%;}}
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
<script>
    $(document).ready(function () {
        // Set the CSRF token in the headers for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#applyCoupon').on('click', function (event) {
            event.preventDefault();

            var couponCode = $('#coupon').val();
            var booking_id = $('#booking_id').val(); 
            var expert_id = $('#expert_id').val(); 
            var user_id = $('#user_id').val(); 

            $.ajax({
                url: '{{ route("applyCoupon") }}',
                method: 'POST',
                data: {
                    coupon_code: couponCode,
                    booking_id: booking_id,
                    expert_id: expert_id,
                    user_id: user_id,
                },
                success: function (response) {
                    if (response.success) {
                        // Coupon code applied successfully
                        $('#successMessage').text(response.message);
                        $('#successMessage').show();
                        $('#discount').html(response.discount);
                        location.reload();
                    } else {
                        // Invalid coupon code
                        $('#errorMessage').text(response.message);
                        $('#errorMessage').show();
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>


@endpush