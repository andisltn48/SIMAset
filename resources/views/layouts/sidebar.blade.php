<div id="body-pd">
    <header class="header" id="header">
        <div style="display: none">
            {{ $notification = auth()->user()->unreadNotifications }}
            {{ $allnotification = auth()->user()->notifications }}
        </div>
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="name-notif d-flex align-items-center justify-content-center">
            <div class="header_name"> <span class="text-primary fw-bolder">Halo, </span> {{ Auth::user()->name }}<img
                    src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
            <div class="nav-item avatar dropdown" id="dropdown">
                <a class="nav-link data-toggle waves-effect waves-light text-primary"
                    id="navbarDropdownMenuLink-5 mark-as-read" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true" style="cursor: pointer">
                    <i class="fas fa-bell"></i>
                    @if (count($notification) > 0)
                        <span id="countNotif" class="fwb-old"
                            style="color: rgb(156, 5, 5); font-size: 11px; font-weight: 900;">
                            {{ count($notification) }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-secondary p-2" style="min-width: 25% !important;">
                    @if (count($allnotification) > 0)
                    <a class="dropdown-item alert" id="linkNotif">
                        @foreach ($allnotification as $item)
                            <p style="font-size: 15px !important">{{ $item->data['body'] }} </p>
                            <p style="font-size: 12px !important; margin-top: -5px !important" class="text-primary"><i
                                    class="fas fa-clock me-2"></i>{{ $item->created_at }}</p>

                        @endforeach
                        {{-- <a href="#" class="float-right mark-as-read ms-4" data-id="{{ $item->id }}">
                                <i class="fas fa-check-double text-success"></i>
                            </a> --}}
                    </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    @if (count($allnotification) == null)
                        <button disabled class="dropdown-item text-center text-dark" href="#">Tidak Ada Notifikasi</button>
                    @else
                        <a class="dropdown-item text-center text-danger" href="#" id="mark-all">Bersihkan semua
                            notifikasi</a>
                    @endif
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
                <span class="nav_name">Keluar</span> </a>
                
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
    var id = {!! json_encode(auth()->user()->id) !!};

    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('notif.mark-read') }}", {
            method: 'get'
        });
    }
    $(function() {
        $('#dropdown').click(function() {
            // let curr_notif_count = document.getElementById("countNotif").innerHTML;
            // console.log(curr_notif_count - 1);
            // let request = sendMarkRequest($(this).data('id'));
            // request.done(() => {
            //     $(this).parents('div.alert').remove();
            //     if (curr_notif_count > 1) {
            //         document.getElementById("countNotif").innerHTML = curr_notif_count-1
            //     } else {
            //         document.getElementById("countNotif").innerHTML = ""
            //     }
            // });
            // $('div.alert').remove();
            console.log("Hai")
            let request = sendMarkRequest();

            request.done(() => {

                document.getElementById("countNotif").innerHTML = "";
            })
        });
        $('#mark-all').click(function() {
            $.ajax("{{ route('notif.clearnotif') }}", {
                method: 'get',
                data: {
                    id_login: id
                }
            });
            $('#linkNotif').remove();
            document.getElementById("mark-all").innerHTML = '<button disabled class="dropdown-item text-center text-dark" href="#">Tidak Ada Notifikasi</button>';
        });
    });
</script>
