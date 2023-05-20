<div class="UserLogin" style="display:none">
    <div class="text-center mt-5 mb-3 position-relative"><h2 class="h3 text-center">User Login</h2><button type="button" class="btn btn-sm formbtn BackToLogin m-auto p-0 position-absolute mt-1 top-0 end-0 sws-top sws-bounce" data-title="Back"><i class="fal fa-arrow-left"></i></button></div>
    <p class="text-secondary text-center">Start by entering your Email ID. We'll send you a 4-digit code to verify:</p>
    <div class="CountryBox">
        <div class="input-group CountryCode">
            {{-- <span class="CountryCodeBox" style="display:none">
                <a class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span id="CountryName">+91</span></a>
                <ul class="dropdown-menu countrylist">
                   
                </ul>
            </span> --}}
            <input type="text" class="form-control uemailnmobile" name="email_mobile" placeholder="Enter Email ID">
            <button class="btn ms-3 formbtn userloginform usbtn otpbtn" type="button"><i class="fal fa-arrow-right"></i></button>
            <button class="btn ms-2 formbtn sws-right uvpbtn disabled" style="display: none" type="button" data-title="Please wait"><i class="fad fa-spinner-third fa-spin"></i></button>
            
        </div>
        <small class="error u-email-error"></small> 
        {{-- <small class="userotppreview"></small> --}}
        <div class="OTPbox" style="display:none;">
            <div class="text-center mt-4"><i><small class="usersendfor">Sent to <strong>+91******4343</strong></small></i></div>
            <form class="text-center mb-3 checkuserloginotp">
                @csrf
                <div id="otp" class="input-group justify-content-center">
                    <input class="m-1 text-center form-control otpn" type="number" name="usermobileotp1" onkeypress="return isNumber(event)" maxlength="1">
                    <input class="m-1 text-center form-control otpn" type="number" name="usermobileotp2" onkeypress="return isNumber(event)" maxlength="1">
                    <input class="m-1 text-center form-control otpn" type="number" name="usermobileotp3" onkeypress="return isNumber(event)" maxlength="1">
                    <input class="m-1 text-center form-control otpn" type="number" name="usermobileotp4" onkeypress="return isNumber(event)" maxlength="1">
                </div>
                <small class="user-mobileotp-error error"></small>
                <div><small class="userresendcounter">Resend OTP in <strong id="user-seconds-counter">30s</strong></small></div>
                <div class="userresendemail" style="display: none;"><small><a href="javascript:void(0);" class="lresendemobileformbtn">Resend OTP</a></small></div>
                <button class="btn btn-thm4 btn-sm otpsvbtn formbtn m-auto mt-1">Confirm <i class="fal fa-arrow-right ms-2"></i></button>
                <button class="btn btn-thm4 btn-sm otppcbtn formbtn m-auto mt-1 disabled" style="display: none;" type="button"><i class="fad fa-spinner-third fa-spin me-1"></i> verifing...</button>
            </form>
        </div>
        {{-- <div class="form-check mt-4 justify-content-center"><input class="form-check-input" type="checkbox"  name="terms_conditions" id="lstay"><label class="form-check-label thm" for="lstay">By continuing you agree to our <a href="{{route('termsandconditions')}}" target="_blank"><u>Terms</u></a> and <a href="{{route('privacypolicy')}}" target="_blank"><u>Privacy Policy</u></a></label></div>
        <div class="text-center">
            <span class="error trmer2"></span>
        </div> --}}
    </div>
    <p class="w-100 m-0 mt-4 text-center justify-content-center">New to {{project()}}? <a  class="btn btn-sm formbtn  m-auto" href="{{route('userregister')}}"><strong>Sign Up Free</strong></a></p>
</div>