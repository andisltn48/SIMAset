<x-app-layout title="Data Ruangan">
    <div class="d-flex row-ruangan">
        <div class="col card shadow p-3 bg-white rounded mobile-margin card-daftar-ruangan m-2"
            style="border-radius: 0.7rem !important">
            @if (session('error'))
                <div id="alert-div" class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body text-white">
                        <ul>
                            @foreach (session('error') as $item)
                                <li>{{ $item['kode'] }} | {{ $item['nama'] }} | {{ $item['message'] }}</li>
                            @endforeach
                        </ul>
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
            <div class="row">
                <div class="header-peminjaman">
                    <div class="title">
                        <h5 class="fw-bold">Data Ruangan</h5>
                    </div>
                </div>
                <hr>
                <div class="row p-3">
                    <table id="tableDataRuangan" class=" ps-1 table table-bordered display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Penanggung Jawab</th>
                                <th>NIP</th>
                                <th>Kode Gedung</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col card shadow p-3 bg-white rounded mobile-margin m-2"
            style="border-radius: 0.7rem !important; max-height: 36rem !important">
            <div class="row header-peminjaman">
                <div class="title">
                    <h5 class="fw-bold">Tambah Ruangan</h5>
                </div>
            </div>
            <form class="mt-2 p-2" action="{{ route('data-ruangan.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label class="text-dark fw">Kode Ruangan<sup class="text-danger">*</sup></label>
                        <input class="form-control " name="kode_ruangan" value="{{ old('kode_ruangan') }}"
                             required>
                    </div>

                    <div class="text-danger">
                        @error('kode_ruangan')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <div class="form-group">
                        <label class="text-dark fw">Nama Ruangan<sup class="text-danger">*</sup></label>
                        <input class="form-control " name="nama_ruangan" value="{{ old('nama_ruangan') }}"
                             required>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="form-group">
                        <label class="text-dark fw">Penanggung Jawab<sup class="text-danger">*</sup></label>
                        <input class="form-control " name="pj" value="{{ old('pj') }}"
                             required>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="form-group">
                        <label class="text-dark fw">NIP<sup class="text-danger">*</sup></label>
                        <input class="form-control " name="nip" value="{{ old('nip') }}"
                             required>
                    </div>
                    <div class="text-danger">
                        @error('nip')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <div class="form-group">
                        <label class="text-dark fw">Kode Gedung<sup class="text-danger">*</sup></label>
                        <input class="form-control " name="kode_gedung" value="{{ old('kode_gedung') }}"
                             required>
                    </div>
                    <div class="text-danger">
                        @error('kode_gedung')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col text-center mt-4">
                    <a data-toggle="modal" data-target="#modal-import" class="btn btn-block btn-success">Impor</a>
                    <button type="submit" class="btn btn-primary shadow">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <div id="modal-import" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Impor Ruangan</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <form class="" action="{{ route('data-ruangan.impor-data-ruangan') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="exampleFormControlInput1">Choose File<sup class="text-danger">*</sup></label>
                        <div class="custom-file">
                            <input required class="form-control-file" name="fileimport" type="file"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Impor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-ruangan-edit" class="modal fade bd-example-modal-lg" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit data ruangan</h4>
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
                                <label class="text-dark fw">Kode Ruangan<sup class="text-danger">*</sup></label>
                                <input class="form-control " name="kode_ruangan" id="kode-ruangan-edit"
                                     readonly>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Nama Ruangan<sup class="text-danger">*</sup></label>
                                <input class="form-control " name="nama_ruangan" id="nama-ruangan-edit"
                                     required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Penanggung Jawab<sup
                                        class="text-danger">*</sup></label>
                                <input class="form-control " name="pj" id="pj-edit"
                                     required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">NIP<sup class="text-danger">*</sup></label>
                                <input class="form-control " name="nip" id="nip-edit"
                                     required>
                            </div>
                            <div class="text-danger">
                                @error('nip')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Kode Gedung<sup class="text-danger">*</sup></label>
                                <input class="form-control " name="kode_gedung" id="kode-gedung-edit"
                                     required>
                            </div>
                            <div class="text-danger">
                                @error('kode_gedung')
                                    {{ $message }}
                                @enderror
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
        $(".select2").select2();

        // window.alert(id);
        let table = $('#tableDataRuangan').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },
                searchPlaceholder: "Cari kode ruangan"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [1, "asc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('data-ruangan.get-data-ruangan') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'kode_ruangan',
                searchable: 'true'
            }, {
                className: "dt-nowrap",
                data: 'nama_ruangan',
                searchable: 'true'
            }, {
                className: "dt-nowrap",
                data: 'pj',
                searchable: 'true'
            }, {
                className: "dt-nowrap",
                data: 'nip',
                searchable: 'true'
            }, {
                className: "dt-nowrap",
                data: 'kode_gedung',
                searchable: 'true'
            }, {
                className: "dt-nowrap",
                data: 'action'
            }],
        });
        $.fn.DataTable.ext.pager.numbers_length = 5;


        $(document).on('click', '.btn-edit-ruangan', function(event) {
            // return confirm($(this).data('tanggalSP2D'));
            var link = $(this).data('link');
            var koderuangan = $(this).data('koderuangan');
            var namaruangan = $(this).data('namaruangan');
            var pj = $(this).data('pj');
            var nip = $(this).data('nip');
            var kodegedung = $(this).data('kodegedung');

            console.log(koderuangan)


            $('#form-edit').attr('action', link);
            $('#kode-ruangan-edit').val(koderuangan);
            $('#nama-ruangan-edit').val(namaruangan);
            $('#pj-edit').val(pj);
            $('#nip-edit').val(nip);
            $('#kode-gedung-edit').val(kodegedung);
        });
    </script>
</x-app-layout>
{{-- <div style="background: rgb(233, 189, 160); border-radius: 2rem;" class="p-2 text-white"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div> --}}
