<div class="ExpertLogin" style="display:none">
    <div class="text-center mt-5 mb-3 position-relative"><h2 class="h3 text-center">Expert Login</h2><button type="button" class="btn btn-sm formbtn BackToLogin m-auto p-0 position-absolute mt-1 top-0 end-0 sws-top sws-bounce" data-title="Back"><i class="fal fa-arrow-left"></i></button></div>
    <p class="text-secondary text-center mb-4">Start by entering your Email ID. We'll send you a 4-digit code to verify:</p>
    <div class="CountryBox">
        <div class="input-group CountryCode">
            {{-- <span class="CountryCodeBox" style="display:none">
                <a class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span id="CountryName">+91</span></a>
                <ul class="dropdown-menu countrylist">
                    
                </ul>
            </span> --}}
            <input type="text" class="form-control emailnmobile" name="e_email_mobile" value="" placeholder="Enter Email ID">
            <button class="btn ms-3 formbtn expertloginform esbtn otpbtn" type="button"><i class="fal fa-arrow-right"></i></button>
            <button class="btn ms-2 formbtn sws-right evpbtn disabled" style="display: none" type="button" data-title="Please wait"><i class="fad fa-spinner-third fa-spin"></i></button>
            
        </div>
        <small class="error e-email-error"></small> 
        {{-- <small class="expertotppreview"></small> --}}
        <div class="OTPbox" style="display:none;">
            <div class="text-center mt-4"><i><small class="expertsendfor">Sent to <strong>+91******4343</strong></small></i></div>
            <form class="text-center mb-3 checkexpertloginotp">
                @csrf
                <div id="otp" class="input-group justify-content-center">
                    <input class="m-1 text-center form-control otpn" type="number" name="expertmobileotp1" onkeypress="return isNumber(event)" maxlength="1">
                    <input class="m-1 text-center form-control otpn" type="number" name="expertmobileotp2" onkeypress="return isNumber(event)" maxlength="1">
                    <input class="m-1 text-center form-control otpn" type="number" name="expertmobileotp3" onkeypress="return isNumber(event)" maxlength="1">
                    <input class="m-1 text-center form-control otpn" type="number" name="expertmobileotp4" onkeypress="return isNumber(event)" maxlength="1">
                </div><span class="error expert-mobileotp-error"></span>
                <div><small class="expertresendcounter">Resend OTP in <strong id="expert-seconds-counter">30s</strong></small></div>
                <div class="expertresendemail" style="display: none;"><small><a href="javascript:void();" class="expertresendeformbtn">Resend OTP</a></small></div>
                <button class="btn btn-thm4 btn-sm eotpsvbtn formbtn m-auto mt-1">Confirm <i class="fal fa-arrow-right ms-2"></i></button>
                <button class="btn btn-thm4 btn-sm eotppcbtn formbtn m-auto mt-1 disabled" style="display: none;" type="button"><i class="fad fa-spinner-third fa-spin me-1"></i> verifing...</button>
                
            </form>
        </div>
        {{-- <div class="form-check mt-4 justify-content-center">
            <input class="form-check-input" type="checkbox" name="terms_and_conditions" value="1" id="lstay">
            <label class="form-check-label thm" for="lstay">By continuing you agree to our 
                <a href="{{route('termsandconditions')}}" target="_blank"><u>Terms</u></a> and 
                <a href="{{route('privacypolicy')}}" target="_blank"><u>Privacy Policy</u></a>
            </label>            
        </div>
        <div class="text-center">
            <span class="error trmer"></span>
        </div> --}}
    </div>
    <p class="w-100 m-0 mt-4 text-center">New to ExpertBells? <a class="btn btn-sm formbtn  m-auto" href="{{route('expertregister')}}#s1"><strong>Sign Up Free</strong></a></p>
</div>