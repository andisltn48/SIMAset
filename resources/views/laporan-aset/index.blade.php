<x-app-layout title="Laporan Aset">
    <div class="card shadow p-3 mb-5 bg-white rounded mobile-margin" style="border-radius: 0.7rem !important">
        @if (session('error'))
            <div id="alert-div" class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body text-white">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @if (session('success'))
            <div id="alert-div" class="alert alert-success alert-dismissible show fade">
                <div class="alert-body text-white">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row header-peminjaman">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Laporan Aset</h5>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100 bg-light">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Kondisi Aset</h6>
                        <p class="text-sm mb-0">
                            <i class="fas fa-database text-success m-2"></i>
                            <span class="font-weight-bold">{{ $jumlahaset }}</span> Aset
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="barChart" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card z-index-2 h-100 bg-light">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Status Peminjaman Aset</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="doughnutChart" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-3">
            <div class="col mb-lg-0 mb-4">
                <div class="card z-index-2 h-100 bg-light">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="row">
                            <div class="col">
                                <div class="title-filter">
                                    <p>Pilih tahun</p>
                                </div>
                                @php
                                  $years = range(2015, strftime("%Y", time()));   
                                @endphp
                                <div class="form-group">
                                    <select class="form-select select2" id="filter-tahun" onchange="filter_tahun()">
                                      @foreach ($years as $year)
                                        @if ($year == $currentTahun)
                                          <option selected value="{{$year}}">{{$year}}</option>
                                        @else
                                          <option value="{{$year}}">{{$year}}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-capitalize">Total Harga Aset (Tahun : {{ $currentTahun }})</h6>
                        <p class="text-sm mb-0">
                            <i class="fas fa-money-check-alt text-success m-2"></i>
                            <span class="font-weight-bold">{{ $hargaAsetByTahun }}</span> Harga Total Aset
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="lineChart" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".select2").select2();


        // window.alert(id);
        let table = $('#tableListAktivitas').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },

                searchPlaceholder: "Cari nama user"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [4, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('aktivitas-sistem.get-aktivitas') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'name',
            }, {
                className: "dt-nowrap",
                data: 'user_role',
            }, {
                className: "dt-nowrap",
                data: 'user_activity',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'created_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'action',
                searchable: false
            }],
        });

        $.fn.DataTable.ext.pager.numbers_length = 5;
    </script>
    <script>
        //chart kondisi aset
        var kondisiAsetBaik = {!! json_encode($kondisiAsetBaik) !!};
        var kondisiAsetRusakRingan = {!! json_encode($kondisiAsetRusakRingan) !!};
        var kondisiAsetRusakBerat = {!! json_encode($kondisiAsetRusakBerat) !!};
        var ctxB = document.getElementById("barChart").getContext('2d');
        var myBarChart = new Chart(ctxB, {
            type: 'bar',
            data: {
                labels: ["Baik", "Rusak Ringan", "Rusak Berat"],
                datasets: [{
                    // label: '# of Votes',
                    data: [kondisiAsetBaik, kondisiAsetRusakRingan, kondisiAsetRusakBerat],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255,99,132,1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        //chart peminjaman aset
        var totalBarangPinjam = {!! json_encode($totalBarangPinjam) !!};
        var totalBarangTidakPinjam = {!! json_encode($totalBarangTidakPinjam) !!};
        var ctxD = document.getElementById("doughnutChart").getContext('2d');
        var myLineChart = new Chart(ctxD, {
            type: 'doughnut',
            data: {
                labels: ["Dalam Peminjaman", "Tidak Dalam Peminjaman"],
                datasets: [{
                    data: [totalBarangPinjam, totalBarangTidakPinjam],
                    backgroundColor: ["#46BFBD", "#949FB1"],
                    hoverBackgroundColor: ["#5AD3D1", "#A8B3C5"]
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
    <script>
        //chart harga aset
        var Januari = {!! json_encode($Januari) !!};
        var Februari = {!! json_encode($Februari) !!};
        var Maret = {!! json_encode($Maret) !!};
        var April = {!! json_encode($April) !!};
        var Mei = {!! json_encode($Mei) !!};
        var Juni = {!! json_encode($Juni) !!};
        var Juli = {!! json_encode($Juli) !!};
        var Agustus = {!! json_encode($Agustus) !!};
        var September = {!! json_encode($September) !!};
        var Oktober = {!! json_encode($Oktober) !!};
        var November = {!! json_encode($November) !!};
        var Desember = {!! json_encode($Desember) !!};

        var ctxL = document.getElementById("lineChart").getContext('2d');
        var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                    "Oktober", "November", "Desember"
                ],
                datasets: [{
                    label: "Total Harga Aset",
                    data: [Januari, Februari, Maret, April, Mei, Juni, Juli, Agustus, September, Oktober,
                        November, Desember
                    ],
                    backgroundColor: [
                        'rgba(105, 0, 132, .2)',
                    ],
                    borderColor: [
                        'rgba(200, 99, 132, .7)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                responsive: true
            }
        });
    </script>

    <script>
      let tahun = $('#filter-tahun').val();

      function filter_tahun(params) {
        tahun = $('#filter-tahun').val();
        window.location.search = '?tahun=' + tahun;
      }
    </script>
</x-app-layout>
{{-- <div style="background: rgb(233, 189, 160); border-radius: 2rem;" class="p-2 text-white"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div> --}}
