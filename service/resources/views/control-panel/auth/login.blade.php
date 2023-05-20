<!DOCTYPE html>
<html lang="en">

<head>
	<title>WELCOME TO {!! strtoupper(Helper::ProjectName()) !!}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="{{ asset('resources/assets/login/image/png') }}" href="{{ asset('resources/assets/login/images/icons/favicon.ico') }}" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/login/vendor/bootstrap/css/bootstrap.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/login/vendor/animate/animate.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/login/vendor/css-hamburgers/hamburgers.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/login/vendor/select2/select2.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/login/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/login/css/main.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/admin/build/css/toastr.css') }}">


	<style>
		.float {
			position: fixed;
			width: 60px;
			height: 60px;
			bottom: 40px;
			right: 40px;
			background-color: #393647;
			color: #FFF;
			border-radius: 50px;
			text-align: center;
			box-shadow: 2px 2px 3px #999;
		}

		.my-float {
			margin-top: 20px;
		}
	</style>



</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('{!! Helper::LOGOIMGURl(Helper::ProjectLOGO()) !!}');background-repeat: no-repeat;background-size: 723px 380px;">
			<div class="wrap-login100 p-t-100">
				<form class="login100-form validate-form" role="form" method="POST" action="{{ url('/control-panel/admin-login') }}">

					{{ csrf_field() }}

					<div class="login100-form-avatar mb-4" style="margin-left: 105px;">
						<img src="{!! Helper::LOGOIMGURl(Helper::ProjectLOGO()) !!}" alt="{!! Helper::ProjectName() !!}">
					</div>

					<span class="login100-form-title p-t-20 p-b-45 d-none">
						{!! Helper::ProjectName() !!}
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
						<input class="input100" type="email" name="email" value="{{ old('email') }}" autocomplete="off" required placeholder="Email Address">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn" type="submit"> Login </button>
					</div>

					<div class="text-center w-full p-t-25 p-b-230">

					</div>

				</form>



				<a href="#exampleModal" class="float" data-toggle="modal" title="Forget Password"> <i class="fa fa-unlock-alt my-float" style="font-size: 20px;"></i> </a>


			</div>
		</div>
	</div>


	<div class="modal" id="exampleModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" style="font-weight: bold;color:#c22020;">Forget Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form method="post" action="{{url('admin/forget-password')}}">

					{{csrf_field()}}

					<div class="modal-body">
						<div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
							<input class="input200" type="email" name="email" value="{{ old('email') }}" autocomplete="off" required placeholder="Email Address">

						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="login100-form-btn">Password Send</button>

					</div>

				</form>

			</div>
		</div>
	</div>

	<!--===============================================================================================-->
	<script src="{{ asset('resources/assets/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('resources/assets/admin/build/js/toastr.min.js') }}"></script>

	<script src="{{ asset('resources/assets/login/vendor/bootstrap/js/popper.js') }}" crossorigin="anonymous"></script>
	<script src="{{ asset('resources/assets/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>


	@if(session()->has('success_msg')) <script>
		toastr.success("{{ session()->get('success_msg') }}");
	</script> @endif

	@if(session()->has('error_msg')) <script>
		toastr.error("{{ session()->get('error_msg') }}");
	</script> @endif

</body>

</html>