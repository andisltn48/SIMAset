<x-app-layout title="Impor Data Inventaris">
    <div class="mt-4 card shadow p-3 bg-white rounded dataaset-card" style="border-radius: 0.7rem !important">
        <div class="row container-dataaset header-dataaset">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Impor Data Inventaris</h5>
            </div>
            <div class="col button text-end">
                <a href="{{ route('data-inventaris.index') }}"><button class="btn btn-block btn-success">Data
                        Inventaris</button></a>
            </div>
        </div>
        <hr>
        <div class="modal fade" id="errorImpor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Terjadi kesalahan</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img>
                            <?xml version="1.0" ?>
                            <!DOCTYPE svg
                                PUBLIC '-//W3C//DTD SVG 1.0//EN' 'http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd'>
                            <svg height="50" style="overflow:visible;enable-background:new 0 0 32 32"
                                viewBox="0 0 32 32" width="50" xml:space="preserve"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g>
                                    <g id="Error_1_">
                                        <g id="Error">
                                            <circle cx="16" cy="16" id="BG" r="16"
                                                style="fill:#D72828;" />
                                            <path d="M14.5,25h3v-3h-3V25z M14.5,6v13h3V6H14.5z"
                                                id="Exclamatory_x5F_Sign" style="fill:#E6E6E6;" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </img>
                        <p class="mt-3 text-dark">
                            Terjadi kesalahan pada proses impor. Silahkan lihat riwayat impor untuk detail kesalahan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @if (session('error'))
            {{-- <div id="alert-div" class="alert alert-danger alert-dismissible show fade">
                
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="alert-body text-white">
                    {{ session('error') }}
                </div>
            </div> --}}
            <script>
                $(function() {
                    $('#errorImpor').modal('show');
                });
            </script>
        @endif
        @if (session('success'))
            <div id="alert-div" class="alert alert-success alert-dismissible show fade">
                <div class="alert-body text-white">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col">
                <p>

                    File template excel untuk melakukan impor : <a
                        href="{{ route('data-inventaris.import-template') }}"><button class="ms-2 btn btn-primary"> <i
                                class="fas fa-fw fa-file-excel me-2"></i>Download Template</button></a>

                </p>
            </div>
        </div>
        <form action="{{ route('data-inventaris.import-data-inventaris') }}" method="POST" enctype="multipart/form-data">
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
                    <a href="{{ route('data-inventaris.index') }}" class=" ms-2 btn btn-block btn-danger"><i
                            class="fas fa-arrow-circle-left me-2"></i>Kembali</a>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-4 card shadow p-3 mb-5 bg-white rounded dataaset-card" style="border-radius: 0.7rem !important">
        <div class="row container-dataaset header-dataaset">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Riwayat Impor Data Inventaris</h5>
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
                url: "{{ route('data-inventaris.getdataimport') }}",
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
