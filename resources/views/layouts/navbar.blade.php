<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3 mb-2">

        <div style="display: none">
            @php
                $notification = auth()->user()->unreadNotifications;
                $allnotification = auth()->user()->notifications;
            @endphp
        </div>
        <nav aria-label="breadcrumb">
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">

                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                      <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                      </div>
                    </a>
                  </li>
                <li class="nav-item d-flex align-items-center m-1">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                        <span class="m-1">Selamat datang, {{ Auth::user()->name }}</span>
                        {{-- <i class="fa fa-user me-sm-1"></i> --}}
                    </a>
                </li>

                <li class="nav-item dropdown pe-2 d-flex align-items-center m-1" id="dropdown">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        @if (count($notification) > 0)
                            <span id="countNotif" class="fwb-old"
                                style="color: rgb(156, 5, 5); font-size: 11px; font-weight: 900;">
                                {{ count($notification) }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        @if (count($allnotification) > 0)
                            <div class="dropdown-item alert" id="linkNotif">
                                @foreach ($allnotification as $item)
                                    <p style="font-size: 15px !important">{{ $item->data['body'] }} </p>
                                    <p style="font-size: 12px !important; margin-top: -5px !important"
                                        class="text-primary"><i class="fas fa-clock me-2"></i>{{ $item->created_at }}
                                    </p>
                                    <!-- <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm text-success font-weight-normal mb-1">
                                                        {{ $item->data['body'] }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        {{ $item->created_at }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li> -->

                                @endforeach
                                {{-- <a href="#" class="float-right mark-as-read ms-4" data-id="{{ $item->id }}">
                                    <i class="fas fa-check-double text-success"></i>
                                </a> --}}
                            </div>
                        @endif

                        <div class="dropdown-divider"></div>
                        @if (count($allnotification) == null)
                            <button disabled class="dropdown-item text-center text-dark" href="#">Tidak Ada
                                Notifikasi</button>
                        @else
                            <button class="dropdown-item text-center text-danger" href="#" id="mark-all">Bersihkan semua
                                notifikasi</button>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    function sendMarkRequest() {
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
                method: 'get'
            });
            $('#linkNotif').remove();
            document.getElementById("mark-all").innerHTML =
                '<button disabled class="dropdown-item text-center text-dark" href="#">Tidak Ada Notifikasi</button>';
        });
    });
</script>
