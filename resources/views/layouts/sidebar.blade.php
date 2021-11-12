<div id="body-pd">
    <header class="header" id="header">
        <div style="display: none">
            {{ $notification = auth()->user()->unreadNotifications }}
        </div>
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="name-notif d-flex align-items-center justify-content-center">
            <div class="header_name"> <span class="text-primary fw-bolder">Halo, </span> {{ Auth::user()->name }}<img
                    src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
            <div class="nav-item avatar dropdown">
                <a class="nav-link data-toggle waves-effect waves-light text-primary" id="navbarDropdownMenuLink-5"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer">
                    <i class="fas fa-bell"></i>
                    @if (count($notification)>0)
                    <spanc class="fwb-old" style="color: rgb(156, 5, 5); font-size: 11px; font-weight: 900;">
                        {{ count($notification) }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-secondary p-2" style="min-width: 25rem !important;">
                    @foreach ($notification as $item)
                        <div class="dropdown-item alert">
                            User {{ $item->data['body'] }} has just registered
                            <a href="#" class="float-right mark-as-read ms-4" data-id="{{ $item->id }}">
                                <i class="fas fa-check-double text-success"></i>
                            </a>
                        </div>
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-center text-success" href="#" id="mark-all">Tandai semua sebagai dibaca<i class="ms-2 fas fa-check-double text-success"></i></a>
                </div>
            </div>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                        class="nav_logo-name">SIM-Aset</span> </a>
                <div class="nav_list">
                    @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN' || session('role') == 'Sarpras')
                        <a href="{{ route('data-aset.index') }}" class="nav_link"> <i
                                class="fas fa-file"></i>
                            <span class="nav_name">Data Aset</span> </a>
                    @endif

                    @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'Sarpras')
                        <a href="{{ route('peminjaman.index') }}" class="nav_link"><i
                                class="fas fa-archive"></i>
                            <span class="nav_name">Peminjaman</span> </a>
                    @endif

                    @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN')
                        <a href="#" class="nav_link"><i class="fas fa-clipboard-list"></i>
                            <span class="nav_name">Daftar Pengajuan</span> </a>
                    @endif

                    @if (session('role') == 'Super Admin' || session('role') == 'Admin')
                        <a href="{{ route('unit.index') }}" class="nav_link"><i class="fas fa-suitcase"></i>
                            <span class="nav_name">Manajemen Unit</span> </a>
                    @endif

                    @if (session('role') == 'Super Admin')
                        <a href="#" class="nav_link"><i class="fas fa-users"></i>
                            <span class="nav_name">Manajemen User</span> </a>
                    @endif

                    @if (session('role') == 'Super Admin')
                        <a href="#" class="nav_link"><i class="fas fa-file-medical-alt"></i>
                            <span class="nav_name">Laporan Aset</span> </a>
                    @endif

                    @if (session('role') == 'Peminjam')
                        <a href="{{ route('peminjaman.form') }}" class="nav_link"><i class="fab fa-wpforms"></i>
                            <span class="nav_name">Form Peminjaman</span> </a>

                        <a href="{{ route('peminjaman.list-peminjaman') }}" class="nav_link"><i
                                class="fas fa-file-medical-alt"></i>
                            <span class="nav_name">Daftar Peminjaman</span> </a>
                    @endif
                </div>
            </div> <a href="{{ route('auth.logout') }}" class="nav_link"> <i
                    class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
</div>
<!--Container Main start-->
{{-- <div class="height-100 bg-light">
        <h4>Main Components</h4>
    </div> --}}


{{-- <script>

        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, headerId, contentId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    headerpd = document.getElementById(headerId),
                    contentspan = document.getElementById(content)

                // Validate that all variables exist
                if (toggle && nav && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('expand')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        // add padding to header
                        headerpd.classList.toggle('body-pd')

                        contentspan.classList.toggle('span')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'header')

        });
    </script> --}}
<script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('auth.mark-read') }}", {
            method: 'get',
            data: {
                id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
</script>