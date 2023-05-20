<template>
   <main>
        <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
        <section class="grey pt-3 pb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i class="fal fa-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a aria-current="page">Login</a></li>
                </ol>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-7">
                        <ul class="LoginBox mt-5">
                            <li class="card Expert">
                                <div class="card-body">
                                    <span class="img"><img src="frontend/img/expert.svg" height="80" width="80"></span>
                                    <h3 class="d-block h5 thm m-0 mt-2">Expert Login</h3>
                                </div>
                            </li>
                            <li class="card User">
                                <div class="card-body">
                                    <span class="img"><img src="frontend/img/admin.svg" height="80" width="80"></span>
                                    <h3 class="d-block h5 thm m-0 mt-2">User Login</h3>
                                </div>
                            </li>
                        </ul>
                        <div class="ExpertLogin" style="display:none">
                            <div class="text-center mt-5 mb-3 position-relative"><h2 class="h3 text-center">Expert Login</h2><button type="button" class="btn btn-sm formbtn BackToLogin m-auto p-0 position-absolute mt-1 top-0 end-0 sws-top sws-bounce" data-title="Back"><i class="fal fa-arrow-left"></i></button></div>
                            <p class="text-secondary text-center mb-4">Start by entering your Mobile Number/Email ID. We'll send you a 4-digit code to verify:</p>
                            <div class="CountryBox">
                                <div class="input-group CountryCode">
                                    <span class="CountryCodeBox" style="display:none">
                                        <a class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span id="CountryName">+91</span></a>
                                        <ul class="dropdown-menu countrylist">
                                            <!----->
                                        </ul>
                                    </span>
                                    <input type="text" class="form-control emailnmobile" name="emailnmobile" value="" placeholder="Enter Phone No./Email ID">
                                    <button class="btn ms-3 formbtn otpbtn" style="display:none" type="button"><i class="fal fa-arrow-right"></i></button>
                                </div>
                                <div class="input-group CountryCode mt-4 InputBOx" style="display:none;">
                                    <form action="expert-account" method="post" class="text-center w-100">
                                        <input type="password" class="form-control lpass" id="lpassword" name="lpassword" placeholder="Enter Password">
                                        <i id="lpass-icon" class="far fa-eye-slash"></i>
                                        <button class="btn btn-thm4 formbtn m-auto mt-3" type="submit">Sign In <i class="fal fa-arrow-right ms-2"></i></button>
                                    </form>
                                </div>
                                <div class="OTPbox" style="display:none;">
                                    <div class="text-center mt-4"><i><small>Sent to <strong>+91******4343</strong></small></i></div>
                                    <form action="expert-account" method="post" class="text-center mb-3">
                                        <div id="otp" class="input-group justify-content-center">
                                            <input class="m-1 text-center form-control otpn" type="number" oninput="maxLengthCheck(this)" maxlength="1">
                                            <input class="m-1 text-center form-control otpn" type="number" oninput="maxLengthCheck(this)" maxlength="1">
                                            <input class="m-1 text-center form-control otpn" type="number" oninput="maxLengthCheck(this)" maxlength="1">
                                            <input class="m-1 text-center form-control otpn" type="number" oninput="maxLengthCheck(this)" maxlength="1">
                                        </div>
                                        <small class="d-block">Resend OTP in <strong>30s</strong></small>
                                        <button class="btn btn-thm4 btn-sm formbtn m-auto mt-1" type="submit">Confirm <i class="fal fa-arrow-right ms-2"></i></button>
                                    </form>
                                </div>
                                <div class="form-check mt-4 justify-content-center"><input class="form-check-input" type="checkbox" value="" id="lstay"><label class="form-check-label thm" for="lstay">By continuing you agree to our <a href="#"><u>Terms</u></a> and <a href="#"><u>Privacy Policy</u></a></label></div>
                            </div>
                            <p class="w-100 m-0 mt-4 text-center">New to ExpertBells? <a class="btn btn-sm formbtn BackToLogin m-auto" href="expert-signup.php#s1"><strong>Sign Up Free</strong></a></p>
                        </div>
                        <div class="UserLogin" style="display:none">
                            <div class="text-center mt-5 mb-3 position-relative"><h2 class="h3 text-center">User Login</h2><button type="button" class="btn btn-sm formbtn BackToLogin m-auto p-0 position-absolute mt-1 top-0 end-0 sws-top sws-bounce" data-title="Back"><i class="fal fa-arrow-left"></i></button></div>
                            <p class="text-secondary text-center">Start by entering your Mobile Number/Email ID. We'll send you a 4-digit code to verify:</p>
                            <div class="CountryBox">
                                <div class="input-group CountryCode">
                                    <span class="CountryCodeBox" style="display:none">
                                        <a class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span id="CountryName">+91</span></a>
                                        <ul class="dropdown-menu countrylist">
                                            <!----->
                                        </ul>
                                    </span>
                                    <input type="text" class="form-control emailnmobile" name="emailnmobile" value="" placeholder="Enter Phone No./Email ID">
                                    <button class="btn ms-3 formbtn otpbtn" style="display:none" type="button"><i class="fal fa-arrow-right"></i></button>
                                </div>
                                <div class="input-group CountryCode mt-4 InputBOx" style="display:none;">
                                    <form action="account" method="post" class="text-center w-100">
                                        <input type="password" class="form-control npass" id="cpassword" name="cpassword" placeholder="Enter Password">
                                        <i id="npass-icon" class="far fa-eye-slash"></i>
                                        <button class="btn btn-thm4 formbtn m-auto mt-3" type="submit">Sign In <i class="fal fa-arrow-right ms-2"></i></button>
                                    </form>
                                </div>
                                <div class="OTPbox" style="display:none;">
                                    <div class="text-center mt-4"><i><small>Sent to <strong>+91******4343</strong></small></i></div>
                                    <form action="account" method="post" class="text-center mb-3">
                                        <div id="otp" class="input-group justify-content-center">
                                            <input class="m-1 text-center form-control otpn" type="number" oninput="maxLengthCheck(this)" maxlength="1">
                                            <input class="m-1 text-center form-control otpn" type="number" oninput="maxLengthCheck(this)" maxlength="1">
                                            <input class="m-1 text-center form-control otpn" type="number" oninput="maxLengthCheck(this)" maxlength="1">
                                            <input class="m-1 text-center form-control otpn" type="number" oninput="maxLengthCheck(this)" maxlength="1">
                                        </div>
                                        <small class="d-block">Resend OTP in <strong>30s</strong></small>
                                        <button class="btn btn-thm4 btn-sm formbtn m-auto mt-1" type="submit">Confirm <i class="fal fa-arrow-right ms-2"></i></button>
                                    </form>
                                </div>
                                <div class="form-check mt-4 justify-content-center"><input class="form-check-input" type="checkbox" value="" id="lstay"><label class="form-check-label thm" for="lstay">By continuing you agree to our <a href="#"><u>Terms</u></a> and <a href="#"><u>Privacy Policy</u></a></label></div>
                            </div>
                            <p class="w-100 m-0 mt-4 text-center justify-content-center">New to ExpertBells? <a  class="btn btn-sm formbtn BackToLogin m-auto" href="user-signup.php"><strong>Sign Up Free</strong></a></p>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-img">
                <img src="{{asset('frontend/img/bg-img-l.svg')}}" width="450" height="500">
                <img src="{{asset('frontend/img/bg-img-r1.svg')}}" width="450" height="500">
            </div>
        </section>
    </main>
</template>