@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3 pb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">User Sign Up</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-10">
                    <!-- <label for="lemail" class="form-label mb-0 ms-3"><small>Phone No.</small></label> -->
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <h2 class="mt-2 h4">Sign Up</h2>
                            <p class="text-secondary">Create your {{project()}} account</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-secondary w-100 m-0 mt-4 text-end mb-3">Already have an account? <a class="thm" href="{{route('login')}}"><strong>Login</strong></a></p>
                        </div>
                    </div>
                    <form method="post" action="{{route('user.savestep1')}}" class="card card-body  formbox">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>First Name</small></label>
                                <input type="text" class="form-control inputTextBox" name="first_name"
                                    placeholder="Your Name" value="{{ old('first_name') }}">
                                @if($errors->has('first_name'))
                                <div style="color:red">
                                    {{ $errors->first('first_name') }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>Last Name</small></label>
                                <input type="text" class="form-control inputTextBox" name="last_name"
                                    placeholder="Your Name" value="{{ old('last_name') }}">
                            </div>
                            <div class="col-lg-6 mb-2">
                            <label class="ms-2"><small>Phone No</small></label>
                                <div class="CountryBox">
                                    <div class="input-group CountryCode mt-3">
                                        <span>
                                            <a class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"><span
                                                    id="CountryName">+{{$ccode->phonecode ?? 0}}</span></a>
                                            <ul class="dropdown-menu countrylist">
                                                <x-country-list />
                                            </ul>
                                        </span>
                                        <input type="hidden" name="mobileverify">
                                        <input type="hidden" name="ccode" value="{{$ccode->phonecode ?? 0}}">
                                        <input type="text" class="form-control" name="mobile"
                                            placeholder="Enter Phone No." value="{{ old('mobile') }}">

                                    </div>
                                    @if($errors->has('mobile'))
                                    <div  style="color:red">{{ $errors->first('mobile') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                            <label class="ms-2"><small>Email</small></label>
                                <div class="CustomerInfo">
                                    <div class="input-group mt-3">
                                        <input type="hidden" name="emailverify">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Email" value="{{ old('email') }}">
                                       
                                    </div>
                                </div>
                                <div class="OTPbox EmailOTPbox mt-3" style="display:none;">
                                    <div class="text-center d-flex justify-content-around">
                                        <div>
                                            <div class="text-center"><i>
                                                    <!-- <small>Sent to <strong>+91******4343</strong></small> -->OTP
                                                    Verification for Email ID
                                                </i></div>
                                            <div id="otp" class="input-group justify-content-center">
                                                <input type="hidden" name="oldemailotp">
                                                <input class="m-1 text-center form-control otpn" type="number"
                                                    name="emailotp1" onkeypress="return isNumber(event)" maxlength="1">
                                                <input class="m-1 text-center form-control otpn" type="number"
                                                    name="emailotp2" onkeypress="return isNumber(event)" maxlength="1">
                                                <input class="m-1 text-center form-control otpn" type="number"
                                                    name="emailotp3" onkeypress="return isNumber(event)" maxlength="1">
                                                <input class="m-1 text-center form-control otpn" type="number"
                                                    name="emailotp4" onkeypress="return isNumber(event)" maxlength="1">
                                            </div>
                                            <span class="emailotp-error error"></span>
                                        </div>
                                        <div>
                                            <div class="resendcounter"><small>Resend OTP in <strong
                                                        id="seconds-counter">30s</strong></small></div>
                                            <div class="resendemail" style="display: none;"><small><a
                                                        href="javascript:void();" class="resendemailformbtn">Resend
                                                        OTP</a></small></div>
                                            <button class="btn btn-sm formbtn evcsbtn m-auto mt-2" type="button">Verify
                                                <i class="fal fa-arrow-right ms-2"></i></button>
                                            <button class="btn btn-sm formbtn evcpbtn m-auto mt-2 disabled"
                                                style="display: none;" type="button"><i
                                                    class="fad fa-spinner-third fa-spin me-1"></i> verifing...</button>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('email'))
                                    <div  style="color:red">{{ $errors->first('email') }}</div>
                                    @enderror
                            </div>
                            <!-- <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>GST Number</small></label>
                                <input type="text" class="form-control" name="gst_number" placeholder="Enter GST Number">
                                <span class="gst-error error"></span>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>Company Name</small></label>
                                <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name">
                                <span class="company-error error"></span>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label class="ms-2"><small>Billing Address</small></label>
                                <textarea name="billing_address" style="height:70px" placeholder="Enter Billing Address" class="form-control"></textarea>
                                <span class="address-error error"></span>
                            </div> -->


                            <div class="col-lg-6 mb-2 d-none">
                                <label class="ms-2"><small>Password</small></label>
                                <input type="password" class="form-control lpass" name="password"
                                    placeholder="Password">
                                <i id="lpass-icon" class="far fa-eye-slash"></i>
                                <span class="password-error error"></span>
                            </div>
                            <div class="col-lg-6 mb-2 d-none">
                                <label class="ms-2"><small>Confirm Password</small></label>
                                <input type="password" class="form-control cpass" name="confirm_password"
                                    placeholder="Confirm Password">
                                <i id="cpass-icon" class="far fa-eye-slash"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn formbtn px-4 btn-thm2 sbtn">Next</button>
                            <button type="button" class="btn formbtn px-4 btn-thm2 disabled pbtn"
                                style="display: none"><i class="fad fa-spinner-third fa-spin me-1"></i>
                                Loading...</button>
                        </div>
                    </form>
                    <!-- <div class="form-check mt-3"><input class="form-check-input" type="checkbox" value="" id="lstay"><label class="form-check-label thm" for="lstay">By continuing you agree to our <a href="#"><u>Terms</u></a> and <a href="#"><u>Privacy Policy</u></a></label></div> -->
                </div>
            </div>
        </div>
        <div class="bg-img">
            <img src="{{asset('frontend/img/bg-img-l.svg')}}" width="450" height="500">
            <img src="{{asset('frontend/img/bg-img-r1.svg')}}" width="450" height="500">
        </div>
    </section>
</main>
@endsection
@push('css')
<title>User Sign Up : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
section.grey>div{z-index:2;position:relative}
.formbox{border-radius:9px!important;border:none!important;box-shadow:0 5px 12px rgb(var(--blackrgb)/.1)}
.formbox .row>div{position:relative}
.CountryCode a{border:1px solid #e1e1e1;display:flex;align-items:center;line-height:normal!important;background:var(--white)!important;padding:9px 18px;border-radius:30px 0 0 30px;height:100%}
.CountryCode a:after{font-size:16px}
.CountryCode a span{max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;font-size:16px!important;text-transform:uppercase}
.CountryCode a span:after{display:none}
.CountryCode .CountryCode{max-width:66px;text-align:center;padding:0!important}
.CountryCode .form-control,.CustomerInfo .form-control,.CountryBox .form-control,.formbox>.row>div>.form-control{height:calc(2.5rem + 2px);border-radius:0 30px 30px 0!important;font-size:16px;padding:0 20px}
.CountryCode .form-control:first-child,.CountryCode>span.d-none~.form-control,.CountryCode>span[style="display:none"]~.form-control,.CountryCode>span[style="display: none"]~.form-control,.CountryCode>span[style="display: none;"]~.form-control,.CountryCode>span[style="display:none;"]~.form-control{border-radius:30px!important}
.CustomerInfo .form-control,.CountryBox>.form-control,.formbox>.row>div>.form-control{border-radius:30px!important}
.CountryCode .countrylist{padding:0;max-height:200px;overflow:auto;background:var(--white);right:auto!important;left:0!important}
.formbtn{height:42px;min-width:42px!important;width:auto!important;display:flex;align-items:center;border-radius:35px!important;border:1px solid var(--thm)!important;font-size:18px!important;color:var(--thm)!important}
.formbtn.btn-sm{font-size:16px!important;padding:0 15px;height:36px}
.otpn{height:40px;max-width:40px!important;border-radius:9px!important;padding:0!important;font-size:18px!important}
.formbtn:hover{background:var(--thm)!important;color:var(--white)!important}
.countrylist li{padding:5px 12px;cursor:pointer;font-size:14px;padding-right:70px;white-space:nowrap}
.countrylist li i{margin-right:5px}
.countrylist li span{font-size:12px;color:rgb(var(--blackrgb)/.5);position:absolute;right:12px}
.countrylist li:hover{background:rgb(var(--blackrgb)/.08)}
img.bg-img{position:relative;bottom:0;opacity:.6;margin-top:-90px;width:100%;height:auto;z-index:1}
.lpass~i,.cpass~i,.npass~i{position:absolute;right:24px;top:37px;opacity:0; z-index:3; transition:all .5s}
.lpass:hover~i,.lpass:active~i,.lpass:focus~i,.lpass~i:hover,.lpass~i:active,.lpass~i:focus,.cpass:hover~i,.cpass:active~i,.cpass:focus~i,.cpass~i:hover,.cpass~i:active,.cpass~i:focus,.npass~i:hover~i,.npass:active~i,.npass:focus~i,.npass:hover,.npass~i:active,.npass~i:focus{opacity:1}
</style>
@endpush
@push('js')
<link rel="preload" as="style" href="css/flag-icons.min.css" onload="this.rel='stylesheet'">
<script type="text/javascript">
const UserFirstStepUrl = @json(route('user.savestep1'));
const UserEmailVerify = @json(route('sendemailotp'));
const UserMobileVerify = @json(route('sendmobileotp'));
$(document).ready(function(){    
    $('.CountryCode .dropdown-menu').find('li').click(function(e) {
        e.preventDefault();
        var spa = $(this).data('text');
        $('.CountryCode #CountryName').text(spa);
        $('input[name=ccode]').val(spa.substr(1));
    });
});
$(".otpn").bind("input", function() {
    var $this = $(this);
    setTimeout(function() {
        if ( $this.val().length >= parseInt($this.attr("maxlength"),6))
            $this.next("input").focus();
    },0);
});
</script>
@endpush