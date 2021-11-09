<x-guest-layout title="Masuk">
    <div class="login-field row">
        <div class="col-sm-4">
            <div class="card shadow" style="border-radius: 1rem">
                <div class="card-body">
                    <div class="text-center">
                        <img src="img/logo-itk-text.png" width="150"> 
                        {{-- <h1>Logo</h1> --}}
                    </div>
                    <div class="text-primary text-center mt-2 fs-3 fw-bolder">SIM-<span class="text-dark">Aset</span>
                    </div>
                    <form class="" action="{{ route('auth.login') }}" method="POST">
                        @csrf
                        <div class="row mt-5 d-flex flex-column align-items-center">
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
                            <div class="col-9 mb-3">
                                <div class="form-group">
                                    <label class="text-dark fw">Email</label>
                                    <input class="form-control shadow-sm" type="email" name="email" value="{{old('email')}}" style="border-radius: 1rem; margin-top:0.3rem" required>
                                </div>
                            </div>
                            <div class="col-9 mb-2">
                                <div class="form-group">
                                    <label class="text-dark">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control shadow-sm" value="{{old('password')}}" name="password"
                                            id="myInput" required style="border-radius: 1rem; margin-top:0.3rem">

                                    </div>
                                    <input style="margin-top: 0.9rem" type="checkbox" onclick="myFunction()"> Show Password
                                </div>
                            </div>
                            <div class="mt-3 d-flex flex-column text-center">
                                {{-- <a href="{{ route('data-aset.index') }}">Lupa password?</a> --}}
                                {{-- <a href="/register">Daftar untuk peminjam</a> --}}
                            </div>
                            <div class="col text-center mt-4">
                                <button type="submit" class="btn btn-success shadow">Masuk</button>
                            </div>
                            <div class="col-lg-12 text-center mt-5">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="col " style="width: 60%">
            
        </div> --}}
        {{-- <div class="col d-flex bg-light justify-content-start">
            <img class="img-responsive" src="{{ asset('img/loginUndraw.svg') }}" alt="" width="650">
        </div> --}}
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</x-guest-layout>
