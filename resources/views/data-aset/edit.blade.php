<x-app-layout title="Edit Aset">
    <div class="mt-4 card shadow p-3 mb-5 bg-white rounded dataaset-card">
        <div class="row container-dataaset header-dataaset">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Edit Aset</h5>
            </div>
            <div class="col button text-end">
                <a href="{{ route('data-aset.index') }}"><button class="btn btn-block btn-success">Data
                        Aset</button></a>
            </div>
        </div>
        <hr>
        <div>
            <form action="{{ route('data-aset.update', $dataaset->id) }}" method="POST">
                @csrf
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
                @method('PUT')
                <div class="row mt-3">
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Nama Barang<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ $dataaset->nama_barang }}" name="nama_barang" type="text"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Kode Barang<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ $dataaset->kode }}" name="kode_barang" type="text" class="form-control"
                                required>
                        </div>
                        <div class="text-danger">
                            @error('kode_barang')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Uraian Barang<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ $dataaset->uraian_barang }}" name="uraian_barang" type="text"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>NUP<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ $dataaset->nup }}" name="nup" type="text" class="form-control"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Harga Satuan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ $dataaset->harga_satuan }}" name="harga_satuan" type="text"
                                class="form-control" id="rupiah" required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Harga Total<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ $dataaset->harga_total }}" name="harga_total" type="text"
                                class="form-control" id="rupiah" required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Nilai Tagihan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ $dataaset->nilai_tagihan }}" name="nilai_tagihan" type="text"
                                class="form-control" id="rupiah" required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Tanggal SP2D<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ date('Y-m-d\TH:i:s', strtotime($dataaset->tanggal_SP2D)) }}"
                                name="tanggal_sp2d" type="datetime-local" step="1" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Nomor SP2D<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ $dataaset->nomor_SP2D }}" name="nomor_sp2d" type="text"
                                class="form-control" required>
                        </div>
                        <div class="text-danger">
                            @error('nomor_sp2d')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Kelompok Belanja<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input value="{{ $dataaset->kelompok_belanja }}" name="kelompok_belanja" type="text"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Asal Perolehan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="asal_perolehan"
                                value="{{ $dataaset->asal_perolehan }}" required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Nomor Bukti Perolehan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nomor_bukti_perolehan"
                                value="{{ $dataaset->nomor_bukti_perolehan }}" required>
                        </div>
                        <div class="text-danger">
                            @error('nomor_bukti_perolehan')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Merk<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="merk" value="{{ $dataaset->merk }}"
                                required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Sumber Dana<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="sumber_dana"
                                value="{{ $dataaset->sumber_dana }}" required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>PJ/PIC<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pic" value="{{ $dataaset->pic }}"
                                required>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Kode Ruangan</p>
                        </div>
                        <div class="form-group">
                            <input name="kode_ruangan" value="{{ $dataaset->kode_ruangan }}" type="text"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col" style="max-width:17.4vw">
                        <div class="">
                            <p>Ruangan</p>
                        </div>
                        <div class="form-group">
                            <input name="ruangan" value="{{ $dataaset->ruangan }}" type="text"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Kondisi Barang<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <select name="kondisi" class="form-select" required>
                                <option value="">Pilih</option>

                                @foreach ($kondisi as $key => $item)
                                    @if ($key == $dataaset->kondisi)
                                        <option value="{{ $key }}" selected>{{ $item }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Unit/Rumpun<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <select name="unit" class="form-select" required>
                                <option value="">Pilih</option>
                                @foreach ($unit as $item)
                                    @if ($item->kode_unit == $dataaset->unit)
                                        <option value="{{ $item->kode_unit }}" selected>{{ $item->nama_unit }}
                                        </option>
                                    @else
                                        <option value="{{ $item->kode_unit }}">{{ $item->nama_unit }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col" style="width:15vw">
                        <div class="">
                            <p>Gedung</p>
                        </div>
                        <div class="form-group">
                            <input name="gedung" value="{{ $dataaset->gedung }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="">
                            <p>Catatan</p>
                        </div>
                        <div class="form-group">
                            <textarea name="catatan" class="form-control" id="exampleFormControlTextarea1"
                                rows="3">{{ $dataaset->catatan }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col text-center">
                        <button type="submit" class="me-3 btn btn-primary"><i
                                class="fas fa-save me-2"></i>Simpan</button>
                        <a href="{{ route('data-aset.index') }}" class=" btn btn-block btn-danger"><i
                                class="fas fa-arrow-circle-left me-2"></i></i>Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
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
    </script>
</x-app-layout>
