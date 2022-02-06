<x-guest-layout title="Verifikasi Email">
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
                                  class="text-dark">Verifikasi Email</span>
                          </div>
                      </div>
                      @csrf
                      <div class="p-4">
                          <form class="" action="{{ route('email.verify.post') }}" method="POST">
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
                                      <p class="text-justify">Anda harus melakukan verifikasi email terlebih dahulu</p>
                                  </div>


                                  <div class="col text-center mt-4">
                                      <button type="submit" class="btn btn-success shadow">Kirim email verifikasi</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-guest-layout>
