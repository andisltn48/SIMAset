{{-- <x-guest-layout title="Daftar">
    <div class="item" style="overflow: hidden !important;">
        <div class="container-fluid ">
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
                        <form class="" action="{{ route('auth.register') }}" method="POST">
                            @csrf
                            <div class="row mt-5 d-flex flex-column align-items-center">
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body text-white">
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
                                <div class="col mb-3">
                                    <div class="form-group">
                                        <label class="text-dark fw">Nama</label>
                                        <input class="form-control shadow-sm" type="text" name="name"
                                            value="{{ old('name') }}" style="border-radius: 1rem; margin-top:0.3rem"
                                            required>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <div class="form-group">
                                        <label class="text-dark fw">Email</label>
                                        <input class="form-control shadow-sm" type="email" name="email"
                                            value="{{ old('email') }}" style="border-radius: 1rem; margin-top:0.3rem"
                                            required>
                                    </div>

                                    <div class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label class="text-dark">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control shadow-sm"
                                                value="{{ old('password') }}" name="password" id="password" required
                                                style="border-radius: 1rem; margin-top:0.3rem">

                                        </div>
                                    </div>

                                    <div class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label class="text-dark">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control shadow-sm"
                                                value="{{ old('password') }}" name="password_confirmation" id="password-confirm" required
                                                style="border-radius: 1rem; margin-top:0.3rem">

                                        </div>
                                        <input style="margin-top: 0.9rem" type="checkbox" onclick="myFunction()"> Show
                                        Password
                                    </div>

                                    <div class="text-danger">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 d-flex flex-column text-center">
                                    <a href="/">Sudah memiliki akun</a>
                                </div>
                                <div class="col text-center mt-4">
                                    <button type="submit" class="btn btn-success shadow">Daftar</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      function myFunction() {
          var x = document.getElementById("password");
          var y = document.getElementById("password-confirm");
          if (x.type === "password") {
              x.type = "text";
          } else {
              x.type = "password";
          }

          if (y.type === "password") {
              y.type = "text";
          } else {
              y.type = "password";
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
				<form class="login100-form validate-form" action="{{ route('auth.register') }}" method="POST">
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
                            <div class="alert-body text-white">
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
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="name" value="{{ old('name') }}">
						<span class="focus-input100" data-placeholder="Nama"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Email tidak valid">
						<input class="input100" type="text" name="email" value="{{ old('email') }}">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Masukkan password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Konfirmasi password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password_confirmation" >
						<span class="focus-input100" data-placeholder="Konfirmasi Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Daftar
							</button>
						</div>
					</div>

					<div class="text-center p-t-50">
						<span class="">
							<a href="/">Sudah memiliki akun</a>
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