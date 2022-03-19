<x-app-layout title="Daftar Pengajuan">
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
                <h5 class="fw-bold">Daftar Pengajuan</h5>
            </div>
        </div>
        <div class="row status-pengajuan">
            <div class="title-filter">
                <p>Status Pengajuan</p>
            </div>
            <div class="form-group">
                <select class="form-select select2" id="filter-status">
                    <option value="">Semua</option>
                    <option value="Belum Dikonfirmasi">Belum Dikonfirmasi</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <table id="tableListPengajuan" class=" ps-1 table table-bordered display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pengajuan</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Uraian Barang</th>
                        <th>NUP</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Status Pengajuan</th>
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
    <script>
        $(".select2").select2();
        let status_pengajuan = $('#filter-unit').val();
        // window.alert(id);
        let table = $('#tableListPengajuan').DataTable({
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
                url: "{{ route('pengajuan.getdatapengajuan') }}",
                data: function(d) {
                    d.status_pengajuan = status_pengajuan;
                }
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

        $('#filter-status').on('change', function() {
            status_pengajuan = $('#filter-status').val()
        
            table.ajax.reload(null, false)
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
{{-- <div style="background: rgb(255, 185, 185); border-radius: 2rem;" class="p-2 text-white"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div> --}}
