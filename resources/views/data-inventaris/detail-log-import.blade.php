<x-app-layout title="Impor Data Inventaris">
    <div class="mt-4 card shadow p-3 bg-white rounded dataaset-card" style="border-radius: 0.7rem !important">
        <div class="row container-dataaset header-dataaset">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Detail Riwayat Impor Data Inventaris</h5>
            </div>
            <div class="col button text-end">
                <a href="{{ route('data-inventaris.import') }}"><button class="btn btn-block btn-success">Impor
                        Data Inventaris</button></a>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <table id="tableRiwayatImpor" class="ms-5 ps-1 table table-bordered display nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Baris ke-</th>
                        <th>Status</th>
                        <th>Pesan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script>
        var id = {!! json_encode($import_id) !!};
        // window.alert(id);
        let table = $('#tableRiwayatImpor').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                }
            },
            searching: false,
            order: [
                [2, "asc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('data-inventaris.getdatadetailimport') }}",
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
                width: '15vw',
                data: 'nama',
            }, {
                width: '15vw',
                data: 'row',
            }, {
                width: '15vw',
                data: 'status',
            }, {
                width: '15vw',
                data: 'message'
            }],
        });
    </script>
</x-app-layout>
