<x-guest-layout title="Lupa Password">
<!-- <main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Reset Password</div>
                  <div class="card-body">

                      <form action="{{ route('reset.password.post') }}" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">

                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required autofocus>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                  @if ($errors->has('password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Reset Password
                              </button>
                          </div>
                      </form>

                  </div>
              </div>
          </div>
      </div>
  </div>
</main> -->

    <div class="item" style="overflow: hidden !important;">
        <div class="container-fluid">
            <div class="" style="margin-top:100px; ">
                <div class="rounded d-flex justify-content-center">
                    <div class="col-md-4 col-sm-12 shadow p-5 bg-light" style="border-radius: 2rem !important">
                        <div class="text-center">
                            <div class="text-center">
                                <img src="{{asset('img')}}/logo-itk-text.png" width="150">

                            </div>
                            <div class="text-primary text-center mt-2 fs-3 fw-bolder">SIM-<span
                                    class="text-dark">Aset</span>
                            </div>
                            <div class=" text-center mt-2 fs-6 fw-bolder"><span
                                    class="text-dark">Masukkan password baru</span>
                            </div>
                        </div>
                        <form class="" action="{{ route('reset.password.post') }}" method="POST">
                            @csrf
                            <div class="p-4">
                                <form class="" action="{{ route('reset.password.post') }}" method="POST">
                                    @csrf
                                    <div class="row mt-3 d-flex flex-column align-items-center">
                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible show fade">
                                                <div class="alert-body">
                                                    {{ session('error') }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible show fade">
                                                <div class="alert-body">
                                                    {{ session('success') }}
                                                </div>
                                            </div>
                                        @endif
                                        <input type="text" name="token" value="{{$token}}" hidden>
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label class="text-dark fw">Email</label>
                                                <input class="form-control shadow-sm" type="email" name="email"
                                                    value="{{ old('email') }}"
                                                    style="border-radius: 1rem; margin-top:0.3rem" required>
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                                <div>
                                                    <input style="border-radius: 1rem; margin-top:0.3rem" type="password" id="password" class="form-control" name="password" required autofocus>
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label for="password-confirm" class=" text-md-right">Konfirmasi Password</label>
                                            <div class="">
                                                <input style="border-radius: 1rem; margin-top:0.3rem" type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                        <input style="margin-top: 0.9rem" type="checkbox"
                                                    onclick="myFunction()"> Show Password
                                        </div>

                                        <div class="col text-center mt-4">
                                            <button type="submit" class="btn btn-success shadow">Simpan</button>
                                        </div>
                                    </div>
                                </form>
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
</x-guest-layout>
