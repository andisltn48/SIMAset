<x-app-layout title="Unit">
    <div class="d-flex row-unit">
        <div class="col mt-4 card shadow p-3 bg-white rounded dataaset-card m-2 card-daftar-unit"
            style="border-radius: 0.7rem !important">
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
                <div class="col-12 col-md-8 title">
                    <h5 class="fw-bold">Manajemen Unit</h5>
                </div>
            </div>
            <hr>
            <div class="">
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
        </div>
        <div class="mt-4 card shadow p-3 bg-white rounded dataaset-card m-2 col m-2"
            style="border-radius: 0.7rem !important; max-height: 23rem;">
            <h5 class="fw-bolder text-center">
                Tambah Unit
            </h5>
            <form action="{{ route('unit.store') }}" method="POST">
                @csrf
                <div class="form-addunit mt-5">
                    <div class="mb-2">
                        <div class="form-group">
                            <label class="text-dark fw">Kode Unit<sup class="text-danger">*</sup></label>
                            <input class="form-control" type="number" name="kode"
                                style="border-radius: 1rem; margin-top:0.3rem" required>
                            <div class="text-danger">
                                @error('kode')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <div class="form-group">
                            <label class="text-dark">Nama Unit<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <input class="form-control" name="nama" style="border-radius: 1rem; margin-top:0.3rem"
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
    <div id="modal-unit-edit" class="modal fade bd-example-modal-lg" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit data unit</h4>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <!-- body modal -->

                <div class="model-body p-4">
                    <form class="mt-2 p-2" id="form-edit" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="text-dark fw">Kode Unit<sup class="text-danger">*</sup></label>
                                <input class="form-control shadow-sm" name="kode" id="kode-unit-edit"
                                    style="border-radius: 1rem; margin-top:0.3rem" readonly>
                                <div class="text-danger">
                                    @error('kode')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Nama Unit<sup class="text-danger">*</sup></label>
                                <input class="form-control shadow-sm" name="nama" id="nama-unit-edit"
                                    style="border-radius: 1rem; margin-top:0.3rem" required>
                            </div>
                        </div>

                        <div class="col text-center mt-4">
                            <button type="submit" class="btn btn-primary shadow">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let table = $('#tableUnit').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },
                searchPlaceholder: "Cari kode unit"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [1, "asc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('unit.get-data-unit') }}"
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

        $(document).on('click', '.btn-edit-unit', function(event) {
            // return confirm($(this).data('tanggalSP2D'));
            var link = $(this).data('link');
            var kodeunit = $(this).data('kodeunit');
            var namaunit = $(this).data('namaunit');


            $('#form-edit').attr('action', link);
            $('#kode-unit-edit').val(kodeunit);
            $('#nama-unit-edit').val(namaunit);
        });
    </script>
</x-app-layout>
