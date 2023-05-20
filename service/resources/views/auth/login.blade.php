<?php
$active = Request::segment(2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login : Expert Bells</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    @include('inc.header')

    <section class="Home Login">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <!-- @if(Session::has('success_msg'))

                    <div class="green alert_box" id="alert_box">
                        {{ Session::get('success_msg') }}
                        <span class="close" id="alert_close">&#10005;</span>
                    </div>
                    @endif -->
                    <div class="Blocks w50 left-align">
                        <div class="p10px">
                            <h1 class="h4 Heading">Login </h1>
                            <form action="{{url('login-account')}}" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col s12">
                                        <div class="input-field">
                                            <input id="email" name="email" type="text" class="validate">
                                            <label for="email">Email ID</label>
                                            <span class="helper-text" data-error="Please enter your valida email address." data-success="right"></span>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field">
                                            <input id="password" name="password" type="password" class="validate">
                                            <label for="password">Password</label>
                                            <span class="helper-text" data-error="Please enter your password."></span>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <button type="submit" class="btn btn-main mt20px waves-effect waves-light" type="submit">Log in</button>
                                        <a class="waves-effect mt20px waves-light btn-main1 modal-trigger" href="#Thanks">Forgot your password?</a>

                                    </div>
                                    <div class="col s12 center">
                                        <h6 class="center-align">New Customer? <a href="{{url('signup')}}">Sign up <i class="fa fa-long-arrow-right"></i></a></h6>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
<!-- Modal Structure -->
  <div id="Thanks" class="modal customize">
    <div class="modal-content">
        <h4 class="h5 mcolor">Forgot your password?</h4>
        <p class="fs14">Change your password in three easy steps. This will help you to secure your password!</p>
        <ol class="fs14" >
            <li>Enter your email address below.</li>
            <li>Our system will send you a new password.</li>
        </ol>
        <form action="{{url('reset-pass')}}" method="post" id="forgetfrom">
            @csrf
            <div class="input-field"><input class="form-control" name="email" type="text" id="forget_email" required="" placeholder="Enter your email address"><!--<label for="email">Enter your email address</label>--></div>
            <p><small class="form-text text-muted">Enter the email address you used during the registration on expertbells.com. Then we'll email a new password to this address.</small></p>
           <button class="btn btn-main" type="submit">Get New Password</button>
           <!--<button class="btn btn-main1 modal-close" type="submit">Back to Login</button> -->
        </form>
    </div>
    <a href="#!" class="modal-action modal-close red-text h5">&times;</a>
  </div>
    @include('inc.footer')
    