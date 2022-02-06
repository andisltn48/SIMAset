<x-guest-layout title="Masuk">
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

                                            <a href="/register">Daftar untuk peminjam</a>
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
    </div>
    {{-- <script type="text/JavaScript">


     </script> --}}
    <script>
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
</x-guest-layout>
