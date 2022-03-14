<x-app-layout title="Tambah Aset">
    <div class="mt-4 card shadow p-3 mb-5 bg-white rounded dataaset-card" style="border-radius: 0.7rem !important">
        <div class="row container-dataaset header-dataaset">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Form Pengajuan Aset</h5>
            </div>
            {{-- <div class="col button text-end">
                <a href="{{ route('data-aset.index') }}"><button class="btn btn-block btn-success">Data
                        Aset</button></a>
            </div> --}}
        </div>
        <hr>
        <div>
            <form action="{{ route('pengajuan.store-pengajuan') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                <div class="d-flex row-tambah mt-3">
                    <div class="col m-1">
                        <div class="">
                            <p>Nama Barang<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ old('merk') }}" name="nama_barang" type="text" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Kode Barang<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ old('kode_barang') }}" name="kode_barang" type="text"
                                class="form-control" required>
                        </div>
                        <div class="text-danger">
                            @error('kode_barang')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Uraian Barang<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ old('uraian_barang') }}" name="uraian_barang" type="text"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>NUP Awal<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input id="nup-awal" value="{{ old('nup_awal') }}" name="nup_awal" type="number" class="form-control" required>
                        </div>
                        <div class="text-danger">
                            @error('nup_awal')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex row-tambah mt-3">
                    <div class="col m-1">
                        <div class="">
                            <p>NUP Akhir</p>
                        </div>
                        <div class="form-group">
                            <input id="nup-akhir" value="{{ old('nup_akhir') }}" name="nup_akhir" type="number" class="form-control" oninput="nupAkhir();">
                        </div>
                        <div class="text-danger">
                            @error('nup_akhir')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Jumlah Barang<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input id="jumlah" value="{{ old('jumlah_barang') }}" name="jumlah_barang" type="number"
                                class="form-control" required>
                        </div>
                        <div class="text-danger">
                            @error('jumlah_barang')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Harga Satuan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ old('harga_satuan') }}" name="harga_satuan" type="text"
                                class="form-control" id="rupiah" required>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Harga Total<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ old('harga_total') }}" name="harga_total" type="text"
                                class="form-control" id="rupiah" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex row-tambah mt-3">
                    <div class="col m-1">
                        <div class="">
                            <p>Nilai Tagihan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ old('nilai_tagihan') }}" name="nilai_tagihan" type="text"
                                class="form-control" id="rupiah" required>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Tanggal SP2D<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input
                                value="{{ old('tanggal_sp2d') ?? date('d-m-Y H:i:s', strtotime(old('tanggal_sp2d'))) }}"
                                name="tanggal_sp2d" type="datetime-local" step="1" class="form-control" required>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Nomor SP2D<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ old('nomor_sp2d') }}" name="nomor_sp2d" type="text"
                                class="form-control" required>
                        </div>
                        <div class="text-danger">
                            @error('nomor_sp2d')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Kelompok Belanja<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ old('kelompok_belanja') }}" name="kelompok_belanja" type="text"
                                class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex row-tambah mt-3">
                    <div class="col m-1">
                        <div class="">
                            <p>Asal Perolehan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="asal_perolehan"
                                value="{{ old('asal_perolehan') }}" required>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Nomor Bukti Perolehan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nomor_bukti_perolehan"
                                value="{{ old('nomor_bukti_perolehan') }}" required>
                        </div>
                        <div class="text-danger">
                            @error('nomor_bukti_perolehan')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Merk<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="merk" value="{{ old('merk') }}" required>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Sumber Dana<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="sumber_dana"
                                value="{{ old('sumber_dana') }}" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex row-tambah mt-3">
                    <div class="col m-1">
                        <div class="">
                            <p>PJ/PIC<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pic" value="{{ old('pic') }}" required>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="title-filter">
                            <p>Kode Ruangan</p>
                        </div>
                        <div class="form-group">
                            <select class="form-select select2 " id="filter-koderuangan" name="kode_ruangan" onchange="ruanganselect()">
                                <option value="">Semua</option>
                                @foreach($dataruangan as $data)
                                  @if (old('kode_ruangan') == $data->kode_ruangan)
                                  <option value="{{$data->kode_ruangan}}" selected>{{$data->kode_ruangan}} || {{$data->nama_ruangan}}</option>
                                  @else
                                  <option value="{{$data->kode_ruangan}}">{{$data->kode_ruangan}} || {{$data->nama_ruangan}}</option>
                                  @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Kondisi Barang<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <select name="kondisi" class="form-select select2" required>
                                <option value="">Pilih</option>
                                @foreach ($kondisi as $key => $data)
                                    @if (Request::old('kondisi') == $key)
                                        <option value="{{ $key }}" selected>{{ $data }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $data }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Unit/Rumpun<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <select class="form-select select2" name="unit" required>
                                <option value="">Pilih</option>
                                @foreach ($unit as $item)
                                    @if (Request::old('unit') == $item->kode_unit)
                                        <option value="{{ $item->kode_unit }}" selected>{{ $item->nama_unit }}
                                        </option>
                                    @else
                                        <option value="{{ $item->kode_unit }}">{{ $item->nama_unit }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex row-tambah mt-3">
                    <div class="col m-1">
                        <div class="">
                            <p>Gedung</p>
                        </div>
                        <div class="form-group">
                            <input name="gedung" value="{{ old('gedung') }}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Ruangan</p>
                        </div>
                        <div class="form-group">
                            <input id="ruangan" name="ruangan" value="{{ old('ruangan') }}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col m-1">
                        <div class="">
                            <p>Tahun Pengadaan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input required name="tahun_pengadaan" value="{{ old('tahun_pengadaan') }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="d-flex row-tambah mt-3">
                    <div class="col m-1">
                        <div class="">
                            <p>Foto Aset</p>
                        </div>
                        <div class="form-group">
                            <input accept="image/*" class="form-control-file" name="foto" type="file">
                        </div>
                    </div>
                </div>
                <div class="d-flex row-tambah mt-3">
                    <div class="col m-1">
                        <div class="">
                            <p>Catatan</p>
                        </div>
                        <div class="form-group">
                            <textarea name="catatan" class="form-control" id="exampleFormControlTextarea1"
                                rows="3">{{ old('catatan') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex row-tambah justify-content-center  mt-5">
                        <button type="submit" class="m-2 btn btn-primary"><i
                                class="fas fa-save me-2"></i>Simpan</button>
                        <a href="{{ route('data-aset.index') }}" class="m-2 btn btn-block btn-danger"><i
                                class="fas fa-arrow-circle-left me-2"></i>Kembali</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        // $(".select2").select2();
        var rupiah = document.querySelectorAll('#rupiah');
        for (let index = 0; index < rupiah.length; index++) {
            rupiah[index].addEventListener("keyup", function(e) {
                rupiah[index].value = formatRupiah(this.value, );
            });
        };
        // var rupiah = document.getElementById("rupiah");
        // rupiah.addEventListener("keyup", function(e) {
        // // tambahkan 'Rp.' pada saat form di ketik
        // // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        // rupiah.value = formatRupiah(this.value,);
        // });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
        // var kode_ruangan = document.getElementById('select_koderuangan');
        // var value = kode_ruangan.options[kode_ruangan.selectedIndex];
        function ruanganselect(){
          console.log($('#filter-koderuangan').val());
          let value = $('#filter-koderuangan').val();
            if ( value.length > 0) {
                $('#ruangan').attr('readonly', true);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('pengajuan.get-ruangan') }}",
                    type: "get",
                    data: {
                        kode: value
                    },
                    success: function(response) {
                        console.log(response.data);
                        if (response) {
                            $('#ruangan').val(response.data);
                        }
                    },
                });
            } else {
                $('#ruangan').removeAttr('readonly')
            }
        }

        function nupAkhir() {
            let nupawal = $('#nup-awal').val();
            let nupakhir = $('#nup-akhir').val();
            if ( nupakhir.length > 0) {
                console.log();
                $('#jumlah').attr('readonly', true)
                $('#jumlah').val(nupakhir-nupawal+1);
            } else {
                $('#jumlah').removeAttr('readonly')
            }
        }

    </script>
</x-app-layout>
