<x-guest-layout title="Lupa Password">
    <!-- <main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Reset Password</div>
                  <div class="card-body">

                    @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                      <form action="{{ route('forget.password.post') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Send Password Reset Link
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
        <div class="container-fluid vh-100">
            <div class="" style="margin-top:100px; ">
                <div class="rounded d-flex justify-content-center">
                    <div class="col-md-4 col-sm-12 shadow p-5 bg-light" style="border-radius: 2rem !important">
                        <div class="text-center">
                            <div class="text-center">
                                <img src="img/logo-itk-text.png" width="150">

                            </div>
                            <div class="text-primary text-center mt-2 fs-3 fw-bolder">SIM-<span
                                    class="text-dark">Inventaris</span>
                            </div>
                            <div class=" text-center mt-2 fs-6 fw-bolder"><span class="text-dark">Lupa
                                    Password</span>
                            </div>
                        </div>
                        <form class="" action="{{ route('forget.password.post') }}" method="POST">
                            @csrf
                            <div class="p-4">
                                <form class="" action="{{ route('forget.password.post') }}"
                                    method="POST">
                                    @csrf
                                    <div class="row mt-3 d-flex flex-column align-items-center">
                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible show fade">
                                                <div class="alert-body text-white">
                                                    {{ session('error') }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible show fade">
                                                <div class="alert-body text-white">
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
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col text-center mt-4">
                                            <button type="submit" class="btn btn-success shadow">Send Password Reset
                                                Link</button>
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

    </script>
</x-guest-layout>
