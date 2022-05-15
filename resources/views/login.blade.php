{{-- <x-guest-layout title="Masuk">
    <div class="item" style="overflow: hidden !important;">
        <div class="container-fluid vh-100">
            <div class="" style="margin-top:100px; ">
                <div class="rounded d-flex justify-content-center">
                    <div class="col-md-4 col-sm-12 shadow p-5 bg-light" style="border-radius: 2rem !important">
                        <div class="text-center">
                            <div class="text-center">
                                <img src="img/logo-itk-text.png" width="150">

                            </div>
                            <div class="text-primary text-center mt-2 fs-3 fw-bolder">SIM-<span
                                    class="text-dark">Aset</span>
                            </div>
                        </div>
                        <form class="" action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            <div class="p-4">
                                <form class="" action="{{ route('auth.login') }}" method="POST">
                                    @csrf
                                    <div class="row mt-3 d-flex flex-column align-items-center">
                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible show fade">
                                                <div class="alert-body text-dark">
                                                    {{ session('error') }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible show fade">
                                                <div class="alert-body text-dark">
                                                    {{ session('success') }}
                                                </div>
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label class="text-dark fw">Email</label>
                                                <input class="form-control shadow-sm" type="email" name="email"
                                                    value="{{ old('email') }}"
                                                    style="border-radius: 1rem; margin-top:0.3rem" required>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <div class="form-group">
                                                <label class="text-dark">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control shadow-sm"
                                                        value="{{ old('password') }}" name="password" id="myInput"
                                                        required style="border-radius: 1rem; margin-top:0.3rem">

                                                </div>
                                                <input style="margin-top: 0.9rem" type="checkbox"
                                                    onclick="myFunction()"> Show Password
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex flex-column text-center">

                                            <a href="{{route('forget.password.get')}}">Lupa password?</a>
                                        </div>
                                        <div class="mt-1 d-flex flex-column text-center">

                                            <a href="{{route('register')}}">Daftar untuk peminjam</a>
                                        </div>
                                        <div class="col text-center mt-4">
                                            <button type="submit" class="btn btn-success shadow">Masuk</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <script type="text/JavaScript">


     </script> --}}
    {{-- <script>
        let count = 0;

        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Masuk</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('template-auth')}}/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{asset('template-auth')}}/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="text-center">
                        <img src="img/logo-itk-text.png" width="150">

                    </div>
					<span class="login100-form-title p-b-26">
                        <div class="text-primary text-center mt-2 fw-bolder">SIM-<span
                            class="text-dark">Aset</span>
                        </div>
					</span>
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body text-dark">
                            {{ session('error') }}
                        </div>
                    </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body text-dark">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Masuk
							</button>
						</div>
					</div>

					<div class="text-center p-t-50">
						<span class="">
							<a href="{{route('register')}}">Daftar untuk peminjam</a>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('template-auth')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('template-auth')}}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('template-auth')}}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{asset('template-auth')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('template-auth')}}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('template-auth')}}/vendor/daterangepicker/moment.min.js"></script>
	<script src="{{asset('template-auth')}}/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('template-auth')}}/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('template-auth')}}/js/main.js"></script>

</body>
</html>
