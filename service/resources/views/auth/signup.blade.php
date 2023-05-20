<?php
$active = Request::segment(2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up : Expert Bells</title>
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

                    <div class="Blocks w60 left-align">
                        <h1 class="h4 Heading">Sign Up </h1>
                        <form action="{{url('signup-account')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="first_name" name="first_name" value="{{ Request::old('first_name') }}" type="text" class="validate">
                                        @if ($errors->has('first_name')) <div id="CategoryName-error" class="error">{{ $errors->first('first_name') }} </div> @endif
                                        <label for="first_name">First Name</label>
                                        <span class="helper-text" data-error="Please enter your first name."></span>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="last_name" name="last_name" value="{{ Request::old('last_name') }}" type="text" class="validate">
                                        @if ($errors->has('last_name')) <div id="CategoryName-error" class="error">{{ $errors->first('last_name') }} </div> @endif
                                        <label for="last_name">Last Name</label>
                                        <span class="helper-text"></span>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input type="text" class="validate" id="phone" value="{{ Request::old('phone') }}" minlength="10" maxlength="12" name="phone">
                                        @if ($errors->has('phone')) <div id="CategoryName-error" class="error">{{ $errors->first('phone') }} </div> @endif
                                        <label for="phone">Phone No.</label>
                                        <span class="helper-text" data-error="Please enter your valid phone no."></span>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="email" type="email" value="{{ Request::old('email') }}" class="validate" name="email">
                                        @if ($errors->has('email')) <div id="CategoryName-error" class="error">{{ $errors->first('email') }} </div> @endif
                                        <label for="email">Email</label>
                                        <span class="helper-text" data-error="Please enter your valida email address." data-success="right"></span>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="password" name="password" type="password" class="validate">
                                        @if ($errors->has('password')) <div id="CategoryName-error" class="error">{{ $errors->first('password') }} </div> @endif
                                        <label for="password">Password</label>
                                        <span class="helper-text" data-error="Please enter your password."></span>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input id="c_password" name="password_confirmation" type="password" class="validate">
                                        @if ($errors->has('password_confirmation')) <div id="CategoryName-error" class="error">{{ $errors->first('password_confirmation') }} </div> @endif
                                        <label for="c_password">Confirm Password</label>
                                        <span class="helper-text" data-error="Please enter confirm password."></span>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <label class="check"><input type="checkbox" name="terms" class="filled-in" checked="checked"><span>I agree with terms of use and privacy</span></label>
                                    @if ($errors->has('terms')) <div id="CategoryName-error" class="error">{{ $errors->first('terms') }} </div> @endif
                                    <button id="svbtn" type="submit" class="btn btn-main mt20px waves-effect waves-light" type="submit">Sign Up</button>
                                    <button style="display: none;" id="prvbtn" class="btn btn-main mt20px waves-effect waves-light" type="button"><i class="fa fa-spinner"></i> Processing...</button>
                                </div>
                                <div class="col s12 center">
                                    <h6 class="mt20px">Returning Customer? <a href="{{url('login')}}"> Login in <i class="fa fa-long-arrow-right"></i></a></h6>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('inc.footer')

    <script type="text/javascript">
        function CheckValidation() {
            var Name = $('#first_name').val();
            var Email = $('#email').val();
            var Phone = $('#phone').val();
            var Pass = $('#password').val();
            var CPass = $('#c_password').val();

            if ()


        }
    </script>