<x-app-layout title="Impor Aset">
    <div class="mt-4 card shadow p-3 bg-white rounded dataaset-card" style="border-radius: 0.7rem !important">
        <div class="row container-dataaset header-dataaset">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Impor Aset</h5>
            </div>
            <div class="col button text-end">
                <a href="{{ route('data-aset.index') }}"><button class="btn btn-block btn-success">Data
                        Aset</button></a>
            </div>
        </div>
        <hr>
        @if (session('error'))
            <div id="alert-div" class="alert alert-danger alert-dismissible show fade">
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
        <div class="row">
            <div class="col">
                <p>

                    File template excel untuk melakukan impor : <a
                        href="{{ route('data-aset.import-template') }}"><button class="ms-2 btn btn-primary"> <i
                                class="fas fa-fw fa-file-excel me-2"></i>Download Template</button></a>

                </p>
            </div>
        </div>
        <form action="{{ route('data-aset.import-data-aset') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mt-5">
                <div class="col">
                    <label for="exampleFormControlInput1">Choose File<sup class="text-danger">*</sup></label>
                    <div class="custom-file">
                        <input class="form-control-file" required name="fileimport" type="file"
                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    </div>
                    <div class="text-danger">
                        @error('fileimport')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="col text-start mt-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square me-2"></i>Impor</button>
                    <a href="{{ route('data-aset.index') }}" class=" ms-2 btn btn-block btn-danger"><i
                            class="fas fa-arrow-circle-left me-2"></i>Kembali</a>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-4 card shadow p-3 mb-5 bg-white rounded dataaset-card" style="border-radius: 0.7rem !important">
        <div class="row container-dataaset header-dataaset">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Riwayat Impor Aset</h5>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <table id="tableRiwayatImpor" class="ms-5 table table-bordered display nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Success</th>
                        <th>Failed</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script>
        let table = $('#tableRiwayatImpor').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                }
            },
            searching: false,
            order: [
                [3, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('data-aset.getdataimport') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                width: '15vw',
                data: 'success',
            }, {
                width: '15vw',
                data: 'failed'
            }, {
                width: '20vw',
                data: 'created_at'
            }, {
                data: 'action'
            }],
        });
    </script>
</x-app-layout>
