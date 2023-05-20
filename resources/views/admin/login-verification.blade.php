<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="{{project()}} | Access Panel">

    <link rel="icon" href="{{ asset('frontend/img/favicon.ico') }}" type="image/x-icon">

    <link rel="apple-touch-icon" href="{{ asset('frontend/img/favicon.ico') }}">

    <meta name="author" content="ThemePixels">

    <title>{{project()}}  | Access Panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css" integrity="sha512-JApjWRnfonFeGBY7t4yq8SWr1A6xVYEJgO/UMIYONxaR3C9GETKUg0LharbJncEzJF5Nmiv+Pr5QNulr81LjGQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('admin/css/bracket.css') }}">
    <!-- Scripts -->
    <style>
        .error {
            color: #eb7777;
            font-size: 13px;
        }
    </style>

</head>

<body class=" bg-br-primary">

    <div class="container">

        <div class="row align-items-center justify-content-center ht-100v">

            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">

                {{-- <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><img
                        src="{{ asset('frontend/image/logo.svg') }}" style="width: 55%;margin-bottom: 15px;"></div> --}}

                <form action="{{ route('admin.adminloginverify') }}" method="post">

                    @csrf

                    <div class="form-group">

                        <input type="number" min="0" class="form-control" placeholder="Please verify login otp!" autocomplete="off"
                            id="otp" name="otp" value="{{ old('otp') }}">

                        @error('otp')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>

                   

                    <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();"
                        style="cursor:pointer;" class="btn btn-dark btn-block">Verify</button>

                    <button type="button" id="prcbtn" style="display:none;" disabled
                        class="btn btn-dark btn-block"><i class="fa fa-circle-o-notch fa-spin"></i> Loading...</button>

                </form>

            </div>

        </div>

    </div>

    <script src="{{ asset('admin/lib/jquery/jquery.js') }}"></script>

    <script src="{{ asset('admin/lib/popper.js/popper.js') }}"></script>

    <script src="{{ asset('admin/lib/bootstrap/bootstrap.js') }}"></script>

    <script>
        setTimeout(function() {
            $('.alert').hide();
        }, 5000);
    </script>

</body>

</html>
