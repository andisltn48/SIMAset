<x-app-layout title="Data Ruangan">
    <div class="row">
      <div class="col-8 card shadow p-3 mb-5 bg-white rounded mobile-margin ms-3" style="border-radius: 0.7rem !important">
          @if (session('error'))
              <div class="alert alert-danger alert-dismissible show fade">
                  <div class="alert-body">
                      {{ session('error') }}
                  </div>
              </div>
          @endif
          @if (session('success'))
              <div class="alert alert-success alert-dismissible show fade">
                  <div class="alert-body">
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
      <div class="col card shadow p-3 mb-5 bg-white rounded mobile-margin ms-3" style="border-radius: 0.7rem !important; max-height: 33rem !important">
        <div class="row header-peminjaman">
            <div class="title">
                <h5 class="fw-bold">Tambah Ruangan</h5>
            </div>
        </div>
        <form class="mt-2 p-2" action="{{route('data-ruangan.store')}}" method="post">
          @csrf
          <div class="mb-3">
              <div class="form-group">
                  <label class="text-dark fw">Kode Ruangan<sup class="text-danger">*</sup></label>
                  <input class="form-control shadow-sm" name="kode_ruangan"
                      value="{{ old('kode_ruangan') }}"
                      style="border-radius: 1rem; margin-top:0.3rem" required>
              </div>
          </div>
          <div class="mb-2">
              <div class="form-group">
                  <label class="text-dark fw">Nama Ruangan<sup class="text-danger">*</sup></label>
                  <input class="form-control shadow-sm" name="nama_ruangan"
                      value="{{ old('nama_ruangan') }}"
                      style="border-radius: 1rem; margin-top:0.3rem" required>
              </div>
          </div>
          <div class="mb-2">
              <div class="form-group">
                  <label class="text-dark fw">Penanggung Jawab<sup class="text-danger">*</sup></label>
                  <input class="form-control shadow-sm" name="pj"
                      value="{{ old('pj') }}"
                      style="border-radius: 1rem; margin-top:0.3rem" required>
              </div>
          </div>
          <div class="mb-2">
              <div class="form-group">
                  <label class="text-dark fw">NIP<sup class="text-danger">*</sup></label>
                  <input class="form-control shadow-sm" name="nip"
                      value="{{ old('nip') }}"
                      style="border-radius: 1rem; margin-top:0.3rem" required>
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
                  <input class="form-control shadow-sm" name="kode_gedung"
                      value="{{ old('kode_gedung') }}"
                      style="border-radius: 1rem; margin-top:0.3rem" required>
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
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="" action="{{route('data-ruangan.impor-data-ruangan')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <label for="exampleFormControlInput1">Choose File<sup class="text-danger">*</sup></label>
              <div class="custom-file">
                  <input required class="form-control-file" name="fileimport" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Impor</button>
            </div>
          </form>
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
        let table = $('#tableDataRuangan').DataTable({
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
