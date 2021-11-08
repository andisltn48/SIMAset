<nav class="hamburger" style="display: none">
    {{-- <ul class="menu desktop">
        <li><a href="" class="menu__item">Listings</a></li>
        <li><a href="" class="menu__item">News</a></li>
        <li><a href="" class="menu__item">Blog</a></li>
        <li><a href="" class="menu__item">About us</a></li>
        <li><a href="" class="menu__item">Contact us</a></li>
    </ul> --}}
    <a class="menu__icon mobile"><span></span></a>
    <ul class="menu mobile">
        @if ((session('role') == 'Sarpras'))
        <li><a href="" class="menu__item">Form Pengajuan</a></li>
        <li><a href="" class="menu__item">Contact us</a></li>
        @else
        <li><a href="" class="menu__item">Form Peminjaman</a></li>
        <li><a href="" class="menu__item">Daftar Peminjaman</a></li>
        @endif
    </ul>
</nav>
<div class="sidebar">
    <div class="sidebar-header mt-2">
        <div class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-text text-white fw-bold fs-3 mx-3">
                <h4 class="mt-3 fw-bold brand">SIM-Aset</h4>
            </div>
        </div>
    </div>
    <ul class="mt-5">
        @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN' || session('role') == 'Sarpras')
            <li class="list active">
                <b></b>
                <b></b>
                <div class="row">
                    <a class="col" style="min-width: 10vw" href="{{ route('data-aset.index') }}">
                        <span class="icon"><i class="fas fa-file"></i></span>
                        <span class="titlenavbar">Data Aset</span>
                    </a>
                </div>
            </li>
        @endif
        @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'Sarpras')
            <li class="list">
                <b></b>
                <b></b>
                <a href="#">
                    <span class="icon"><i class="fas fa-archive"></i></span>
                    <span class="titlenavbar">Peminjaman</span>
                </a>
            </li>
        @endif
        @if (session('role') == 'Super Admin' || session('role') == 'Admin')
            <li class="list">
                <b></b>
                <b></b>
                <a href="{{ route('unit.index') }}">
                    <span class="icon"><i class="fas fa-suitcase"></i></span>
                    <span class="titlenavbar">Manajemen Unit</span>
                </a>
            </li>
        @endif
        @if (session('role') == 'Super Admin')
            <li class="list">
                <b></b>
                <b></b>
                <a href="#">
                    <span class="icon"><i class="fas fa-users"></i></span>
                    <span class="titlenavbar">Manajemen User</span>
                </a>
            </li>
        @endif
        @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN')
            <li class="list">
                <b></b>
                <b></b>
                <a href="#">
                    <span class="icon"><i class="fas fa-clipboard-list"></i></span>
                    <span class="titlenavbar">Daftar Pengajuan</span>
                </a>
            </li>
        @endif
        @if (session('role') == 'Super Admin')
            <li class="list">
                <b></b>
                <b></b>
                <a href="#">
                    <span class="icon"><i class="fas fa-file-medical-alt"></i></span>
                    <span class="titlenavbar">Laporan Aset</span>
                </a>
            </li>
        @endif
        @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN' || session('role') == 'Sarpras' || session('role') == 'Pengaju')
            <div class="">
                <div class=" log text-center text-white mt-3">
                    <a href="#"><i class="mt-2 text-white fas fa-user fa-3x"></i></a>
                </div>
                <div class="mt-2 greetings text-center text-white">
                    <h5 class="fw-bold">Halo, {{ Auth::user()['name'] }}</h5>
                </div>
                <div class=" log text-center text-white mt-3">
                    <a href="{{ route('auth.logout') }}"><i class="text-white fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        @endif
        @if (session('role') != 'Super Admin' && session('role') != 'Admin' && session('role') != 'BMN' && session('role') != 'Sarpras' && session('role') != 'Pengaju')
            <li class="list">
                <b></b>
                <b></b>
                <a href="#">
                    <span class="icon"><i class="fab fa-wpforms"></i></span>
                    <span class="titlenavbar">Form Peminjaman</span>
                </a>
            </li>
            <li class="list">
                <b></b>
                <b></b>
                <a href="#">
                    <span class="icon"><i class="fas fa-list-ul"></i></span>
                    <span class="titlenavbar">Daftar Peminjaman</span>
                </a>
            </li>
        @endif
    </ul>
</div>
<div class="toggle">
    <i class="fas fa-angle-left fa-lg close"></i>
    <i class="fas fa-angle-right fa-lg open"></i>
</div>
<script>
    let list = document.querySelectorAll('.list');
    for (let i = 0; i < list.length; i++) {
        list[i].onclick = function() {
            let j = 0;
            while (j < list.length) {
                list[j++].className = 'list';
            }
            list[i].className = 'list active'
        }
    }

    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

    $(document).ready(function() {
        $('.menu__icon').click(function() {
            $('body').toggleClass('menu_shown');
        });
    });
</script>
