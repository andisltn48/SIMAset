<x-app-layout title="Unit">
    <div class="mt-4 card shadow p-3 bg-white rounded dataaset-card">
        <div class="row container-dataaset header-dataaset">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Manajemen Unit</h5>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <div class="col-7">
                <table id="tableUnit" class="table table-bordered display nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Unit</th>
                            <th>Nama Unit</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col">
                <div class="fs-5 fw-bolder ps-5 text-center">
                    Tambah Unit
                </div>
                <form action="">
                    <div class="form-addunit mt-5 ps-5">
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Kode Unit</label>
                                <input class="form-control" type="text" name="kode" value="" required>
                            </div>
                        </div>
                        <div class="col mt-3">
                            <div class="form-group">
                                <label class="text-dark">Nama Unit</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" value="" name="nama" id="myInput"
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                                <button type="submit" class="me-3 btn btn-primary"><i
                                        class="fas fa-save me-2"></i>Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let table = $('#tableUnit').DataTable({
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [1, "asc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('unit.getdataunit') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                width: '15vw',
                data: 'kode_unit',
            }, {
                width: '15vw',
                data: 'nama_unit',
            }, {
                width: '15vw',
                data: 'updated_at',
            }, {
                width: '15vw',
                data: 'action'
            }],
        });

        $.fn.DataTable.ext.pager.numbers_length = 5;
    </script>
</x-app-layout>
