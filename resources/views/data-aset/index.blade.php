<x-app-layout title="Data Aset">
    <div class="row info-data">
        <div class="col">
            <div class="card shadow p-3 mb-5 bg-white jumlah-aset" style="border-radius: 0.7rem">
                <div class="card-body row">
                    <div class="col">
                        <h5 class="card-title fw-bolder" id="jumlahaset">{{ $jumlahaset }}</h5>
                        <h6 class="card-subtitle mt-2 text-nowrap">Jumlah Aset</h6>
                    </div>
                    <div class="col text-center iconitem">
                        <i class="fas fa-database fa-3x text-dark"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow p-3 mb-5 bg-white aset-nonaktif" style="border-radius: 0.7rem">
                <div class="card-body row">
                    <div class="col">
                        <h5 class="card-title fw-bolder" id="baik">{{ $baik }}</h5>
                        <h6 class="card-subtitle mt-2 text-nowrap">Baik</h6>
                    </div>
                    <div class="col text-center iconitem">
                        <i class="fas fa-times-circle fa-3x text-dark"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow p-3 mb-5 bg-white aset-aktif" style="border-radius: 0.7rem">
                <div class="card-body row">
                    <div class="col">
                        <h5 class="card-title fw-bolder" id="rusakringan">{{ $rusakringan }}</h5>
                        <h6 class="card-subtitle mt-2 text-nowrap">Rusak Ringan</h6>
                    </div>
                    <div class="col text-center iconitem">
                        <i class="fas fa-check-circle fa-3x text-dark"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow p-3 mb-5 bg-white aset-nonaktif" style="border-radius: 0.7rem">
                <div class="card-body row">
                    <div class="col">
                        <h5 class="card-title fw-bolder" id="rusakberat">{{ $rusakberat }}</h5>
                        <h6 class="card-subtitle mt-2 text-nowrap">Rusak Berat</h6>
                    </div>
                    <div class="col text-center iconitem">
                        <i class="fas fa-times-circle fa-3x text-dark"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row info-data2" style="margin-top: -2.4rem !important">
        <div class="">
            <div id="card" class="card shadow p-3 mb-5 bg-white harga-aset" style="border-radius: 0.7rem">
                <div class="card-body row">
                    <div class="col-10">
                        <h5 class="card-title fw-bolder" id="hargatotal">{{ $hargatotal }}</h5>
                        <h6 class="card-subtitle mt-2">Total Harga Aset</h6>
                    </div>
                    <div class="col text-center iconitem">
                        <i class="fas fa-money-check-alt fa-3x text-dark"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow p-3 mb-5 bg-white dataaset-card" style="border-radius: 0.7rem">
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
        <div class="row container-dataaset header-dataaset">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Data Aset</h5>
            </div>
            <div class="col button text-end">
                <a href="{{ route('data-aset.create') }}"><button class="btn btn-block btn-success">Tambah
                        Aset</button></a>
                <a href="{{ route('data-aset.import') }}"><button class="btn btn-block btn-success">Impor
                        Aset</button></a>
            </div>
        </div>
        <hr>
        <div class="row mt-2">
            <div class="col">
                <div class="title-filter">
                    <p>Unit/Rumpun</p>
                </div>
                <div class="form-group">
                    <select class="form-select select2" id="filter-unit">
                        <option value="">Semua</option>
                        @foreach ($unit as $item)
                            <option value="{{ $item->kode_unit }}">{{ $item->nama_unit }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="title-filter">
                    <p>Kondisi Aset</p>
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
            <div class="col">
                <div class="title-filter">
                    <p>Kode Ruangan</p>
                </div>
                <div class="form-group">
                    <select class="form-select select2" id="filter-koderuangan">
                        <option value="">Semua</option>
                        <option value="A102">A102 || Kepegalan</option>
                        <option value="A103">A103 || Kepegawaian2</option>
                        <option value="A104">A104 || Kepegawaian3</option>
                        <option value="A105">A105 || Kepegawaian4</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="title-filter">
                    <p>Ruangan</p>
                </div>
                <div class="form-group">
                    <input type="text" id="filter-ruangan" class="ruangan form-control">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <div class="title-filter">
                    <p>Kode Barang</p>
                </div>
                <div class="form-group">
                    <input type="text" id="filter-kodebarang" class="ruangan form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="title-filter">
                    <p>NUP</p>
                </div>
                <div class="form-group">
                    <input type="text" id="filter-nup" class="ruangan form-control">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mt-4">
            <button class="btn btn-block btn-primary me-3" id="filter" style="width: 7vw;"><i
                    class="fas fa-filter me-2"></i>Filter</button>
            <button class="btn btn-block btn-danger" id="reset" style="width: 7vw;"><i
                    class="fas fa-undo-alt me-2"></i>Reset</button>
        </div>
        <div class="row mt-2 me-1 ms-1">
            <button class="btn btn-primary mb-2" onclick="export_excel()" style="max-width: 11vw;" href="">Export to
                Excel</button>
            <table id="tableDataAset" class="table table-bordered display nowrap">
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

        <!-- Modal -->
        <div id="modal-detail" class="modal fade bd-example-modal-lg" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- konten modal-->
                <div class="modal-content">
                    <!-- heading modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Detail data aset</h4>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <!-- body modal -->

                    <div class="model-body p-4">
                        <table class="mt-4 table table-hover table-borderless ">
                            <tbody>
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
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <div>
                            <a id="btn-edit" href=""><button class="btn me-1 btn-block btn-warning"><i
                                        class="fas fa-edit me-2"></i>Edit</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            let unit = $('#filter-unit').val();
            let kondisi = $('#filter-kondisi').val();
            let koderuangan = $('#filter-koderuangan').val();
            let ruangan = $('#filter-ruangan').val();
            let kodebarang = $('#filter-kodebarang').val();
            let nup = $('#filter-nup').val();
            // let status = $('#filter-status').val()
            //export
            function export_excel() {
                unit = $('#filter-unit').val()
                kondisi = $('#filter-kondisi').val()
                koderuangan = $('#filter-koderuangan').val()
                ruangan = $('#filter-ruangan').val()
                kodebarang = $('#filter-kodebarang').val()
                nup = $('#filter-nup').val()
                // status = $('#filter-status').val()
                var query = {
                    unit,
                    kondisi,
                    koderuangan,
                    ruangan,
                    kodebarang,
                    nup
                }

                var url = "{{ route('data-aset.export_excel') }}?" + $.param(query)

                window.location = url;
            }
            // DataTable
            let table = $('#tableDataAset').DataTable({
                order: [
                    [10, "desc"]
                ],
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('data-aset.getdatatable') }}",
                    data: function(d) {
                        d.unit = unit;
                        d.kondisi = kondisi;
                        d.kodebarang = kodebarang;
                        d.koderuangan = koderuangan;
                        d.ruangan = ruangan;
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
            $('#filter').on('click', function() {
                unit = $('#filter-unit').val()
                kondisi = $('#filter-kondisi').val()
                koderuangan = $('#filter-koderuangan').val()
                ruangan = $('#filter-ruangan').val()
                kodebarang = $('#filter-kodebarang').val()
                nup = $('#filter-nup').val()

                console.log(unit, kondisi, koderuangan, ruangan, kodebarang, nup);
                table.ajax.reload(null, false)

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('data-aset.filter-data-aset') }}",
                    type: "get",
                    data: {
                        unit: unit,
                        kondisi: kondisi,
                        kodebarang: kodebarang,
                        koderuangan: koderuangan,
                        ruangan: ruangan,
                        nup: nup,
                    },
                    success: function(response) {
                        if (response) {
                            $('#hargatotal').html(response.hargatotal);
                            $('#jumlahaset').html(response.jumlahaset);
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
                ruangan = "";
                kodebarang = "";
                nup = "";
                $('#filter-unit').prop('selectedIndex', 0).change()
                $('#filter-kondisi').prop('selectedIndex', 0).change()
                $('#filter-koderuangan').val('')
                $('#filter-ruangan').val('')
                $('#filter-kodebarang').val('')
                $('#filter-nup').val('')
                // console.log(paymentstatus)
                table.ajax.reload(null, false)

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('data-aset.filter-data-aset') }}",
                    type: "get",
                    data: {
                        unit: unit,
                        kondisi: kondisi,
                        kodebarang: kodebarang,
                        koderuangan: koderuangan,
                        ruangan: ruangan,
                        nup: nup,
                    },
                    success: function(response) {
                        if (response) {
                            $('#hargatotal').html(response.hargatotal);
                            $('#jumlahaset').html(response.jumlahaset);
                            $('#baik').html(response.baik);
                            $('#rusakringan').html(response.rusakringan);
                            $('#rusakberat').html(response.rusakberat);
                        }
                    },
                });

            })

            function confirm_delete() {
                return confirm('Apakah anda yakin untuk menghapus data aset ini ? ');
            }

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
                $('#btn-edit').attr('href', link);
            });

            let toggle2 = document.querySelector('.toggle');
            let greetings = document.querySelector('.greetings');
            toggle2.onclick = function() {
                greetings.classList.toggle('hide');
            }
        </script>
    </div>
</x-app-layout>
