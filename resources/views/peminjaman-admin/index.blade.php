<x-app-layout title="Daftar Permintaan">
    <div class="card shadow p-3 mb-5 bg-white rounded mobile-margin" style="border-radius: 0.7rem !important">
        @if (session('error'))
            <div id="alert-div" class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @if (session('success'))
            <div id="alert-div" class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row header-peminjaman">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Daftar Permintaan Peminjaman</h5>
            </div>
            <div class="col button" style="text-align: end">
                <a href="{{ route('peminjaman.list-peminjaman-admin') }}"><button class="btn btn-block btn-primary">Daftar
                        Peminjaman</button></a>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <table id="tableListPermintaan" class=" ps-1 table table-bordered display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>No Peminjaman</th>
                        <th>Daftar Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Tanggal Penggunaan</th>
                        <th>Status</th>
                        <th>Surat Peminjaman</th>
                        <th>Surat Balasan</th>
                        <th>Updated_At</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div id="modal-detail" class="modal fade bd-example-modal-lg modal-detail-daftar-barang" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- konten modal-->
                <div class="modal-content">
                    <!-- heading modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Detail data aset</h4>
                        <button type="button" class="btn" onclick="btnClose()" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <!-- body modal -->

                    <div class="model-body p-4" style="overflow-x: scroll; overflow-y:hidden">
                        <table class="mt-4 table table-hover table-borderless " id="tableDetailDaftarBarang">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>NUP Barang</th>
                                    <th>Kondisi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-confirm" class="modal fade bd-example-modal-lg" role="dialog">
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
                    <form  method="POST" id="form-confirm" enctype="multipart/form-data">
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
                        <div class="mt-3">
                            <p>Surat Balasan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="custom-file">
                            <input class="form-control-file" name="surat_balasan" type="file"
                                accept=".docx,application/pdf, application/msword" required>
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
                            <button class="btn me-1 btn-block btn-primary" type="submit"><i class="fas fa-save me-2"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".select2").select2();


        // window.alert(id);
        let table = $('#tableListPermintaan').DataTable({
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [9, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('peminjaman.getdatapermintaanpeminjaman-admin') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'nama_peminjam',
            }, {
                className: "dt-nowrap",
                data: 'no_peminjaman',
            }, {
                className: "dt-nowrap",
                data: 'list_barang',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'jumlah',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'tanggal_penggunaan',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'status_permintaan',
            }, {
                className: "dt-nowrap",
                data: 'download_surat_peminjaman',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'download_surat_balasan',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'updated_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'action',
                searchable: false
            }],
        });

        $.fn.DataTable.ext.pager.numbers_length = 5;

        var no_peminjamans;
        var table2 = $('#tableDetailDaftarBarang').DataTable({
            retrieve: true,
            // searching: false,
            order: [
                [1, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('peminjaman.data-from-nopeminjam-admin') }}",
                type: "get",
                data: {
                    no_peminjaman: no_peminjamans,
                },
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'nama_barang',
            }, {
                searchable: false,
                className: "dt-nowrap",
                data: 'kode_barang',
            }, {
                searchable: false,
                className: "dt-nowrap",
                data: 'nup_barang'
            }, {
                className: "dt-nowrap",
                data: 'kondisi'
            }],
        });
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
