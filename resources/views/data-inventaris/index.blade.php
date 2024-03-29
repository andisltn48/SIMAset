<x-app-layout title="Data Inventaris">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Data Inventaris</p>
                                <h5 class="font-weight-bolder mb-0" id="jumlahinventaris">
                                    {{ $jumlahinventaris }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md ">
                                <i class="fas fa-database text-white text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Kondisi Baik</p>
                                <h5 class="font-weight-bolder mb-0" id="baik">
                                    {{ $baik }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-check-circle text-white text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rusak Ringan</p>
                                <h5 class="font-weight-bolder mb-0" id="rusakringan">
                                    {{ $rusakringan }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-times-circle text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rusak Berat</p>
                                <h5 class="font-weight-bolder mb-0" id="rusakberat">
                                    {{ $rusakberat }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-times-circle text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Harga Data Inventaris</p>
                                <h5 class="font-weight-bolder mb-0" id="hargatotal">
                                    {{ $hargatotal }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-money-check-alt text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
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
                        <div class="row container-dataaset header-dataaset">
                            <div class="col-md-6 title">
                                <h5 class="fw-bold">Data Inventaris</h5>
                            </div>
                            @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN')
                                <div class="col button text-end">
                                    <a href="{{ route('data-inventaris.create') }}"><button
                                            class="btn btn-block btn-success">Tambah
                                            Data Inventaris</button></a>
                                    <a href="{{ route('data-inventaris.import') }}"><button
                                            class="btn btn-block btn-success">Impor
                                            Data Inventaris</button></a>
                                </div>
                            @else
                                <div class="col button text-end">
                                    <button disabled class="btn btn-block btn-success">Tambah
                                        Data Inventaris</button>
                                    <button disabled class="btn btn-block btn-success">Impor
                                        Data Inventaris</button>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="d-flex row-filter mt-2">
                            <div class="col m-1">
                                <div class="title-filter">
                                    <p>Unit/Rumpun</p>
                                </div>
                                <div class="form-group">
                                    <select class="form-select select2 " id="filter-unit">
                                        <option value="">Semua</option>
                                        @foreach ($unit as $item)
                                            <option value="{{ $item->kode_unit }}">{{ $item->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col m-1">
                                <div class="title-filter">
                                    <p>Kondisi</p>
                                </div>
                                <div class="form-group">
                                    <select class="form-select select2" id="filter-kondisi">
                                        <option value="">Semua</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Rusak Ringan">Rusak Ringan</option>
                                        <option value="Rusak Berat">Rusak Berat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col m-1">
                                <div class="title-filter">
                                    <p>Kode Ruangan</p>
                                </div>
                                <div class="form-group">
                                    <select class="form-select select2 " id="filter-koderuangan">
                                        <option value="">Semua</option>
                                        @foreach ($dataruangan as $data)
                                            <option value="{{ $data->kode_ruangan }}">{{ $data->kode_ruangan }} ||
                                                {{ $data->nama_ruangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col m-1">
                                <div class="title-filter">
                                    <p>Tahun Pengadaan</p>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="filter-tahunpengadaan" class="tahunpengadaan form-control">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex row-filter">
                            <div class="col m-1">
                                <div class="title-filter">
                                    <p>Kode Barang</p>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="filter-kodebarang" class="kodebarang form-control">
                                </div>
                            </div>
                            <div class="col m-1">
                                <div class="title-filter">
                                    <p>NUP</p>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="filter-nup" class="nup form-control">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <button class="btn btn-block btn-primary me-3" id="filter" style="min-width: 7vw;"><i
                                    class="fas fa-filter me-2"></i>Filter</button>
                            <button class="btn btn-block btn-danger" id="reset" style="min-width: 7vw;"><i
                                    class="fas fa-undo-alt me-2"></i>Reset</button>
                        </div>
                        <div class="row mt-2 me-1 ms-1">
                            <button class="btn btn-exportexcel-aset btn-primary mb-2" onclick="export_excel()"
                                href="">Export to
                                Excel</button>
                            <table id="tableDataInventaris" class="table table-bordered display nowrap" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Kode Barang</th>
                                        <th>Uraian Barang</th>
                                        <th>NUP</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga</th>
                                        <th>Asal Perolehan</th>
                                        <th>Unit</th>
                                        <th>Kondisi</th>
                                        <th>Updatet At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-detail" class="modal fade bd-example-modal-lg" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- konten modal-->
                <div class="modal-content">
                    <!-- heading modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Detail data inventaris</h4>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <!-- body modal -->

                    <div class="model-body p-4">
                        <table class="mt-4 table table-hover table-borderless ">
                            <tbody>
                                <div class="text-center">
                                    <img id="foto-aset" class="img-thumbnail" alt="">
                                </div>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Nama Barang</th>
                                    <td id="nama-barang" style="max-width: 35vw"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Kode Barang</th>
                                    <td style="max-width: 35vw" id="kode-barang"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">NUP</th>
                                    <td style="max-width: 35vw" id="nup"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Uraian Barang</th>
                                    <td style="max-width: 35vw" id="uraian-barang"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Harga Satuan</th>
                                    <td style="max-width: 35vw" id="harga-satuan"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Harga Total</th>
                                    <td style="max-width: 35vw" id="harga-total"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Nilai Tagihan</th>
                                    <td style="max-width: 35vw" id="nilai-tagihan"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Tanggal SP2D</th>
                                    <td style="max-width: 35vw" id="tanggal-sp2d"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Nomor SP2D</th>
                                    <td style="max-width: 35vw" id="nomor-sp2d"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Kelompok Belanja</th>
                                    <td style="max-width: 35vw" id="kelompok-belanja"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Asal Perolehan</th>
                                    <td style="max-width: 35vw" id="asal-perolehan"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Nomor Bukti Perolehan</th>
                                    <td style="max-width: 35vw" id="nomor-bukti-perolehan"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Merk</th>
                                    <td style="max-width: 35vw" id="merk"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Sumber Dana</th>
                                    <td style="max-width: 35vw" id="sumber-dana"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">PIC</th>
                                    <td style="max-width: 35vw" id="pic"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Kode Ruangan</th>
                                    <td style="max-width: 35vw" id="kode-ruangan"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Kondisi</th>
                                    <td style="max-width: 35vw" id="kondisi"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Unit</th>
                                    <td style="max-width: 35vw" id="unit"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Status</th>
                                    <td style="max-width: 35vw" id="status"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Gedung</th>
                                    <td style="max-width: 35vw" id="gedung"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Ruangan</th>
                                    <td style="max-width: 35vw" id="ruangan"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Catatan</th>
                                    <td style="max-width: 35vw" id="catatan"></td>
                                </tr>
                                <tr>
                                    <th style="width: 25vw; height:7vh">Tahun Pengadaan</th>
                                    <td style="max-width: 35vw" id="tahun-pengadaan"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN')
                        <div class="modal-footer">
                            <div>
                                <a id="btn-edit" href=""><button class="btn me-1 btn-block btn-warning"><i
                                            class="fas fa-edit me-2"></i>Edit</button></a>
                            </div>
                        </div>
                    @else
                        <div class="modal-footer">
                            <div>
                                <button disabled class="btn me-1 btn-block btn-warning"><i
                                        class="fas fa-edit me-2"></i>Edit</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <script type="text/javascript">
            let unit = $('#filter-unit').val();
            let kondisi = $('#filter-kondisi').val();
            let koderuangan = $('#filter-koderuangan').val();
            let tahunpengadaan = $('#filter-tahunpengadaan').val();
            let kodebarang = $('#filter-kodebarang').val();
            let nup = $('#filter-nup').val();
            // let status = $('#filter-status').val()
            //export
            function export_excel() {
                unit = $('#filter-unit').val()
                kondisi = $('#filter-kondisi').val()
                koderuangan = $('#filter-koderuangan').val()
                tahunpengadaan = $('#filter-tahunpengadaan').val()
                kodebarang = $('#filter-kodebarang').val()
                nup = $('#filter-nup').val()
                // status = $('#filter-status').val()
                var query = {
                    unit,
                    kondisi,
                    koderuangan,
                    tahunpengadaan,
                    kodebarang,
                    nup
                }

                var url = "{{ route('data-inventaris.export_excel') }}?" + $.param(query)

                window.location = url;
            }
            // DataTable
            let table = $('#tableDataInventaris').DataTable({
                language: {
                    'paginate': {
                        'previous': '<i class="fa fa-angle-left"></i>',
                        'next': '<i class="fa fa-angle-right"></i>'
                    },
                    searchPlaceholder: "Cari nama barang"
                },
                pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
                order: [
                    [10, "desc"]
                ],
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('data-inventaris.getdatatable') }}",
                    data: function(d) {
                        d.unit = unit;
                        d.kondisi = kondisi;
                        d.kodebarang = kodebarang;
                        d.koderuangan = koderuangan;
                        d.tahunpengadaan = tahunpengadaan;
                        d.nup = nup;
                    }
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_Row_Index',
                    orderable: false,
                    searchable: false
                }, {
                    width: '5vw',
                    data: 'nama_barang',
                    name: 'nama_barang'
                }, {
                    data: 'kode'
                }, {
                    data: 'uraian_barang'
                }, {
                    data: 'nup'
                }, {
                    data: 'harga_satuan'
                }, {
                    data: 'harga_total'
                }, {
                    data: 'asal_perolehan'
                }, {
                    data: 'nama_unit'
                }, {
                    data: 'kondisi'
                }, {
                    data: 'updated_at'
                }, {
                    data: 'action'
                }],
            });

            $.fn.DataTable.ext.pager.numbers_length = 5;

            $('#filter').on('click', function() {
                unit = $('#filter-unit').val()
                kondisi = $('#filter-kondisi').val()
                koderuangan = $('#filter-koderuangan').val()
                tahunpengadaan = $('#filter-tahunpengadaan').val()
                kodebarang = $('#filter-kodebarang').val()
                nup = $('#filter-nup').val()
                // console.log(unit, kondisi, koderuangan, tahunpengadaan, kodebarang, nup);
                table.ajax.reload(null, false)

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('data-inventaris.filter-data-inventaris') }}",
                    type: "get",
                    data: {
                        unit: unit,
                        kondisi: kondisi,
                        kodebarang: kodebarang,
                        koderuangan: koderuangan,
                        tahunpengadaan: tahunpengadaan,
                        nup: nup,
                    },
                    success: function(response) {
                        if (response) {
                            $('#hargatotal').html(response.hargatotal);
                            $('#jumlahinventaris').html(response.jumlahinventaris);
                            $('#baik').html(response.baik);
                            $('#rusakringan').html(response.rusakringan);
                            $('#rusakberat').html(response.rusakberat);
                        }
                    },
                });

            });

            $('#reset').on('click', function() {
                unit = "";
                kondisi = "";
                koderuangan = "";
                tahunpengadaan = "";
                kodebarang = "";
                nup = "";
                $('#filter-unit').prop('selectedIndex', 0).change()
                $('#filter-kondisi').prop('selectedIndex', 0).change()
                $('#filter-koderuangan').prop('selectedIndex', 0).change()
                $('#filter-tahunpengadaan').val('')
                $('#filter-kodebarang').val('')
                $('#filter-nup').val('')
                // console.log(paymentstatus)
                table.ajax.reload(null, false)

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('data-inventaris.filter-data-inventaris') }}",
                    type: "get",
                    data: {
                        unit: unit,
                        kondisi: kondisi,
                        kodebarang: kodebarang,
                        koderuangan: koderuangan,
                        tahunpengadaan: tahunpengadaan,
                        nup: nup,
                    },
                    success: function(response) {
                        if (response) {
                            $('#hargatotal').html(response.hargatotal);
                            $('#jumlahinventaris').html(response.jumlahinventaris);
                            $('#baik').html(response.baik);
                            $('#rusakringan').html(response.rusakringan);
                            $('#rusakberat').html(response.rusakberat);
                        }
                    },
                });

            })


            $(".select2").select2();

            // display a modal (medium modal)
            $(document).on('click', '.btn-detail', function(event) {
                // return confirm($(this).data('tanggalSP2D'));
                var link = $(this).data('link');
                var namabarang = $(this).data('namabarang');
                var kode = $(this).data('kode');
                var nup = $(this).data('nup');
                var uraianbarang = $(this).data('uraianbarang');
                var hargasatuan = $(this).data('hargasatuan');
                var hargatotal = $(this).data('hargatotal');
                var nilaitagihan = $(this).data('nilaitagihan');
                var tanggalSP2D = $(this).data('tanggalsp2d');
                var nomorSP2D = $(this).data('nomorsp2d');
                var kelompokbelanja = $(this).data('kelompokbelanja');
                var asalperolehan = $(this).data('asalperolehan');
                var nomorbuktiperolehan = $(this).data('nomorbuktiperolehan');
                var merk = $(this).data('merk');
                var sumberdana = $(this).data('sumberdana');
                var pic = $(this).data('pic');
                var koderuangan = $(this).data('koderuangan');
                var kondisi = $(this).data('kondisi');
                var unit = $(this).data('unit');
                var status = $(this).data('status');
                var gedung = $(this).data('gedung');
                var ruangan = $(this).data('ruangan');
                var catatan = $(this).data('catatan');
                var tahunpengadaan = $(this).data('tahunpengadaan');
                var linkFoto = $(this).data('foto');

                $('#nama-barang').text(namabarang);
                $('#kode-barang').text(kode);
                $('#nup').text(nup);
                $('#uraian-barang').text(uraianbarang);
                $('#harga-satuan').text(hargasatuan);
                $('#harga-total').text(hargatotal);
                $('#nilai-tagihan').text(nilaitagihan);
                $('#tanggal-sp2d').text(tanggalSP2D);
                $('#nomor-sp2d').text(nomorSP2D);
                $('#kelompok-belanja').text(kelompokbelanja);
                $('#asal-perolehan').text(asalperolehan);
                $('#nomor-bukti-perolehan').text(nomorbuktiperolehan);
                $('#merk').text(merk);
                $('#sumber-dana').text(sumberdana);
                $('#pic').text(pic);
                $('#kode-ruangan').text(koderuangan);
                $('#kondisi').text(kondisi);
                $('#status').text(status);
                $('#unit').text(unit);
                $('#gedung').text(gedung);
                $('#ruangan').text(ruangan);
                $('#catatan').text(catatan);
                $('#tahun-pengadaan').text(tahunpengadaan);
                $('#btn-edit').attr('href', link);
                $('#foto-aset').attr('src', linkFoto);

                console.log(linkFoto);
            });

            // let toggle2 = document.querySelector('.toggle');
            // let greetings = document.querySelector('.greetings');
            // toggle2.onclick = function() {
            //     greetings.classList.toggle('hide');
            // }
        </script>
    </div>
</x-app-layout>
