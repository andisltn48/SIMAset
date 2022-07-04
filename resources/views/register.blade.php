<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png/x-icon" href="{{ asset('img/logo-itk-text.png') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-auth') }}/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-auth') }}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-auth') }}/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-auth') }}/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-auth') }}/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-auth') }}/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-auth') }}/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-auth') }}/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-auth') }}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-auth') }}/css/main.css">
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
                        <div class="text-primary text-center mt-2 fw-bolder">SIM-<span class="text-dark">Inventaris</span>
                        </div>
                    </span>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul style="">
                                @foreach ($errors->all() as $key => $error)
                                    <li>{{ $error }}</li>
                                    <hr>
                                @endforeach
                            </ul>
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
                        <input class="input100" type="text" name="name">
                        <span class="focus-input100" data-placeholder="Nama"></span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Email tidak valid">
                        <input class="input100" type="text" name="email">
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
                        <input class="input100" type="password" name="password_confirmation">
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
    <script src="{{ asset('template-auth') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-auth') }}/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-auth') }}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ asset('template-auth') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-auth') }}/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-auth') }}/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('template-auth') }}/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-auth') }}/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-auth') }}/js/main.js"></script>

</body>

</html>
