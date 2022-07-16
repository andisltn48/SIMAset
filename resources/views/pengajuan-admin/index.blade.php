<x-app-layout title="Daftar Pencatatan">
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
                <h5 class="fw-bold">Daftar Pencatatan Inventaris</h5>
            </div>
            {{-- <div class="col button" style="text-align: end">
                <a href="{{ route('peminjaman.list-peminjaman-admin') }}"><button
                        class="btn btn-block btn-primary">Daftar Inventaris </button></a>
            </div> --}}
        </div>
        <hr>
        <div class="row p-3">
            <table id="tableListPencatatan" class=" ps-1 table table-bordered display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pencatatan</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Uraian Barang</th>
                        <th>NUP</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Status Pencatatan</th>
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
                                <img id="foto-inventaris" class="img-thumbnail" alt="">
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
    <div id="modal-confirm" class="modal fade bd-example-modal-lg" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Pencatatan</h4>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <!-- body modal -->

                <div class="model-body p-4">
                    <form method="POST" id="form-confirm" enctype="multipart/form-data">
                        @csrf
                        <div class="title">
                            <p>Status<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <select class="form-select" id="filter-kondisi" name="status" required>
                                <option value="">Semua</option>
                                <option value="Disetujui">Setujui</option>
                                <option value="Ditolak">Tolak</option>
                            </select>
                        </div>
                        
                        <div class="mt-5">
                            <div class="">
                                <p>Catatan</p>
                            </div>
                            <div class="form-group">
                                <textarea name="catatan" class="form-control" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button class="btn me-1 btn-block btn-primary" type="submit"><i
                                    class="fas fa-save me-2"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".select2").select2();


        // window.alert(id);
        let table = $('#tableListPencatatan').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },
                searchPlaceholder: "Cari no pengajuan"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [12, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('pengajuan.getdatapengajuan-admin') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                width: '5vw',
                data: 'no_pengajuan',
                name: 'no_pengajuan'
            }, {
                width: '5vw',
                data: 'nama_barang',
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
                data: 'status_pengajuan'
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

        
        $(document).on('click', '#btn-detail', function(event) {
            // return confirm($(this).data('tanggalSP2D'));
            no_peminjamans = $(this).data('no_peminjaman');

            console.log(no_peminjamans);

            table2.ajax.url("data-from-nopeminjam-admin?no_peminjaman=" + no_peminjamans).load();
            // table2.ajax.reload(null, false)


        });

        $(document).on('click', '.btn-confirm', function(event) {
            // return confirm($(this).data('tanggalSP2D'));
            var link = $(this).data('link');


            $('#form-confirm').attr('action', link);
        });

        function btnClose() {
            // table2.ajax.url("?no_peminjamans=0").load();
            // console.log(table2.ajax.reload(null, false));
        }
    </script>
</x-app-layout>
{{-- <div style="background: rgb(233, 189, 160); border-radius: 2rem;" class="p-2 text-white"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div> --}}
