<x-app-layout title="Daftar Peminjaman">
    <div class="card shadow p-3 mb-5 bg-white rounded mobile-margin" style="border-radius: 0.7rem !important">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body text-white">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body text-white">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row header-peminjaman">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Daftar Peminjaman</h5>
            </div>
            <div class="col button" style="text-align: end">
                <a href="{{ route('peminjaman.index') }}"><button class="btn btn-block btn-primary">Daftar
                        Permintaan Peminjaman</button></a>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <table id="tableListPeminjaman" class=" ps-1 table table-bordered display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>No Peminjaman</th>
                        <th>Daftar Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Tanggal Penggunaan</th>
                        <th>Status Peminjaman</th>
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
                        <h4 class="modal-title">Detail data inventaris</h4>
                        <button type="button" class="btn" onclick="btnClose()" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <!-- body modal -->

                    <div class="model-body p-4" style="overflow-x: scroll; overflow-y:hidden; ">
                        <table style="width:100%" class="mt-4 table table-hover table-borderless nowrap" id="tableDetailDaftarBarang">
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
    <script>
        $(".select2").select2();

        // window.alert(id);
        let table = $('#tableListPeminjaman').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },
                searchPlaceholder: "Cari nama peminjam"
            },
            order: [
                [7, "asc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('peminjaman.getdatapeminjaman-admin') }}",
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
                searchable: 'true',
                className: "dt-nowrap",
                data: 'no_peminjaman',
            }, {
                searchable: 'false',
                className: "dt-nowrap",
                data: 'list_barang',
            }, {
                searchable: 'false',
                className: "dt-nowrap",
                data: 'jumlah',
            }, {
                width: '15rem',
                searchable: 'false',
                className: "dt-nowrap",
                data: 'tanggal_penggunaan'
            }, {
                searchable: 'false',
                className: "dt-nowrap",
                data: 'status_peminjaman'
            }, {
                searchable: 'false',
                className: "dt-nowrap",
                data: 'download_surat_balasan'
            }, {
                width: '10rem',
                searchable: 'false',
                className: "dt-nowrap",
                data: 'updated_at'
            }, {
                width: '10rem',
                searchable: 'false',
                className: "dt-nowrap",
                data: 'action'
            }, ],
        });
        var no_peminjamans;
        var table2 = $('#tableDetailDaftarBarang').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                }
            },
            // language: {
            //     searchPlaceholder: "Cari Nama Barang"
            // },
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

        function btnClose() {
            // table2.ajax.url("?no_peminjamans=0").load();
            // console.log(table2.ajax.reload(null, false));
        }
    </script>
</x-app-layout>
{{-- <div style="background: rgb(255, 185, 185); border-radius: 2rem;" class="p-2 text-white"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div> --}}
