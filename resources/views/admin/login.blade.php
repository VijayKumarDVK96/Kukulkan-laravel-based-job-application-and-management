<!DOCTYPE html>
<html lang="en">

<head>
	<title>Log In</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="icon" href="admin/images/favicon.ico" type="image/x-icon">
	<link href="{{url('admin-assets/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{url('admin-assets/css/app-style.css')}}" rel="stylesheet" />
  <link href="{{url('admin-assets/css/icons.css')}}" rel="stylesheet" />
</head>

<body>
	<!-- Start wrapper-->
	<div id="wrapper">
		<div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-5 animated bounceInDown">
			<div class="card-body">
				<div class="card-content p-2">
					<div class="text-center">
						<img src="{{url('img/logo.png')}}" alt="Kukulkan">
					</div>
					<div class="card-title text-uppercase text-center py-3">Log In</div>
					<form action="{{route('login')}}" method="post">
						@csrf
						<div class="form-group">
							<div class="position-relative has-icon-right">
								<label for="email" class="sr-only">Email</label>
								<input type="email" id="email" name="email" class="form-control form-control-rounded" placeholder="E-mail Address">
								<div class="form-control-position">
									<i class="icon-user"></i>
								</div>
								@error('email')
								<span class="error-message">{{ $message }}</span>
								@enderror
							</div>
							<span class="error-message email-error"></span>
						</div>
						<div class="form-group">
							<div class="position-relative has-icon-right">
								<label for="password" class="sr-only">Password</label>
								<input type="password" id="password" name="password" class="form-control form-control-rounded" placeholder="Password">
								<div class="form-control-position">
									<i class="icon-lock"></i>
								</div>
								@error('password')
								<span class="error-message">{{ $message }}</span>
								@enderror
							</div>
							<span class="error-message password-error"></span>
						</div>
						<div class="form-row mr-0 ml-0">
							<div class="form-group col-6">
								<div class="icheck-primary">
									<input type="checkbox" id="remember" name="remember" checked="" />
									<label for="remember">Remember me</label>
								</div>
							</div>
							<!-- <div class="form-group col-6 text-right">
								<a href="authentication-reset-password.html">Reset Password</a>
							</div> -->
						</div>
						<button type="submit" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light user-login-submit" style="margin-bottom: 20px">Sign
							In</button>
						<span class="error-message login-error"></span>
						@if(Session::has('error'))
						<div class="alert alert-icon alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<div class="alert-icon icon-part-danger">
								<i class="icon-close"></i>
							</div>
							<div class="alert-message">
								<span><strong>{{session('error')}}</strong></span>
							</div>
						</div>
						@endif
						<!-- <div class="text-center pt-3">
							<p class="text-muted">Do not have an account? <a href="authentication-signup.html"> Sign Up here</a></p>
						</div> -->
					</form>
				</div>
			</div>
		</div>

		<!--Start Back To Top Button-->
		<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		<!--End Back To Top Button-->
	</div>
	<!--wrapper-->

	<script src="{{url('admin-assets/js/jquery.min.js')}}"></script>
	<script src="{{url('admin-assets/js/popper.min.js')}}"></script>
	<script src="{{url('admin-assets/js/bootstrap.min.js')}}"></script>
	<script src="{{url('js/functions.js')}}"></script>

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('#csrf-token')[0].content
			}
		});

		$(".user-login-submi").click(function(e) {
			e.preventDefault();
			var email = check_email("#email", ".email-error", "Email is required");
			var password = check_required("#password", ".password-error", "Password is required");
			var remember = $("#remember:checked").val();

			if (email && password) {
				$.ajax({
					url: "controller/AuthController.php",
					method: 'post',
					data: {
						"email": email,
						"password": password,
						"remember": remember,
						"user-login": "user-login"
					},
					success: function(data) {
						if (data == "Success") {
							window.location.replace("index.php");
						} else {
							$(".login-error").html(data);
						}
					}
				});
			}
		});
	</script>

</body>

</html>