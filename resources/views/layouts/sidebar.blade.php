<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
            target="_blank">
            {{-- <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
            <span class="ms-1 fs-5 font-weight-bold">SIM-Aset</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN' || session('role') == 'Sarpras')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('data-aset.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif

            @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'Sarpras')
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('peminjaman.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-archive text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Peminjaman</span>
                    </a>
                </li>
            @endif

            @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN')
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-clipboard text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Daftar Pengajuan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('data-ruangan.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-suitcase text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manajemen Ruangan</span>
                    </a>
                </li>
            @endif

            @if (session('role') == 'Super Admin' || session('role') == 'Admin')
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('unit.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-suitcase text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manajemen Unit</span>
                    </a>
                </li>
            @endif

            @if (session('role') == 'Super Admin')
                <li class="nav-item">
                    <a class="nav-link " href="{{route('manajemen-user.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manajemen User</span>
                    </a>
                </li>
            @endif

            @if (session('role') == 'Super Admin')
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('aktivitas-sistem.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-medical-alt text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Laporan Aktivitas Sistem</span>
                    </a>
                </li>
            @endif

            @if (session('role') == 'Super Admin')
                <li class="nav-item">
                    <a class="nav-link " href="{{route('laporan-aset.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-medical-alt text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Laporan Aset</span>
                    </a>
                </li>
            @endif

            @if (session('role') == 'Peminjam')
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('peminjaman.form') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fab fa-wpforms text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Form Peminjaman</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('peminjaman.list-peminjaman') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-medical-alt text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Daftar Peminjaman</span>
                    </a>
                </li>
            @endif

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('manajemen-profil.index')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('auth.logout') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-out-alt text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Keluar</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
