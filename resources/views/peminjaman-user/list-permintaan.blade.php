<x-app-layout title="Daftar Permintaan">
    <div class=" card shadow p-3 mb-5 bg-white rounded mobile-margin" style="border-radius: 0.7rem !important">
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
                <h5 class="fw-bold">Daftar Permintaan Peminjaman</h5>
            </div>
            <div class="col button" style="text-align: end">
                <a href="{{ route('peminjaman.list-peminjaman') }}"><button class="btn btn-block btn-primary">Daftar
                        Peminjaman</button></a>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <table id="tableListPermintaan" class=" ps-1 table table-bordered display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Daftar Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Tanggal Penggunaan</th>
                        <th>Status</th>
                        <th>Surat Peminjaman</th>
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
    <script>
        $(".select2").select2();

        var id = {!! json_encode($id_peminjam) !!};
        // window.alert(id);
        let table = $('#tableListPermintaan').DataTable({
          language: {
              'paginate': {
                  'previous': '<i class="fa fa-angle-left"></i>',
                  'next': '<i class="fa fa-angle-right"></i>'
              },
              searchPlaceholder: "Cari no peminjaman"
          },
          searching: false,
            order: [
                [6, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('peminjaman.getdatapermintaanpeminjaman') }}",
                data: function(d) {
                    d.id = id;
                }
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'list_barang',
            }, {
                className: "dt-nowrap",
                data: 'jumlah',
            }, {
                className: "dt-nowrap",
                data: 'tanggal_penggunaan'
            }, {
                className: "dt-nowrap",
                data: 'status_permintaan'
            }, {
                className: "dt-nowrap",
                data: 'download_surat_peminjaman'
            }, {
                className: "dt-nowrap",
                data: 'updated_at'
            }, {
                className: "dt-nowrap",
                data: 'action'
            }],
        });
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
                url: "{{ route('peminjaman.data-from-nopeminjam') }}",
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

            table2.ajax.url("data-from-nopeminjam?no_peminjaman=" + no_peminjamans).load();
            // table2.ajax.reload(null, false)


        });

        function btnClose() {
            // table2.ajax.url("?no_peminjamans=0").load();
            // console.log(table2.ajax.reload(null, false));
        }
    </script>
</x-app-layout>
{{-- <div style="background: rgb(233, 189, 160); border-radius: 2rem;" class="p-2 text-white"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div> --}}
