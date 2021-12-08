<x-app-layout title="Form Peminjaman">
    <div class=" card shadow p-3 mb-5 bg-white rounded mobile-margin" style="border-radius: 0.7rem !important">
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
        <div class="row header-peminjaman">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Form Peminjaman</h5>
            </div>
            <div class="col button" style="text-align: end">
                <a href="{{ route('peminjaman.template-surat') }}"><button class="btn btn-block btn-primary">Download
                        Template Surat</button></a>
            </div>
        </div>
        <hr>
        <div>
            <form action="{{ route('peminjaman.store-permintaan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-3 " id="column-mobile">
                    <div class="col">
                        <div class="">
                            <p>Nama Peminjaman<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input name="nama_peminjam" required type="text" class="form-control"
                                value="{{ Auth::user()->name }}" readonly>
                        </div>
                    </div>
                    <div class="col" id="penanggung-jawab">
                        <div class="">
                            <p>Penanggung Jawab<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="penanggung_jawab" required
                                value="{{ old('penanggung_jawab') }}">
                        </div>
                    </div>
                </div>
                <div class="row mt-3 " id="column-mobile">
                    <div class="col">
                        <div class="">
                            <p>Tanggal Penggunaan<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="form-group">
                            <input
                                value="{{ old('tanggal_penggunaan') ?? date('d-m-Y H:i:s', strtotime(old('tanggal_penggunaan'))) }}"
                                type="datetime-local" class="form-control" name="tanggal_penggunaan"
                                id="tanggalpenggunaan" required>
                        </div>
                    </div>
                    <div class="col" id="sarana-prasarana">
                        <div class="">
                            <p>Sarana/Prasarana <span class="text-muted">(Klik tambah jika lebih dari 1
                                    aset)</span><sup class="text-danger">*</sup></p>

                        </div>
                        <div class="form-group d-flex">
                            <select class="form-select select2" name="sarana" id="select-sarana">
                                <option value="">Pilih</option>
                            </select>
                            <button type="button" onclick="addCode()" class="ms-2 btn btn-primary">Tambah</button>
                            {{-- <input type="text" class="form-control" name="sarana" required value="{{old('sarana')}}"> --}}
                        </div>
                        <div class="text-danger">
                            @error('sarana')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="mt-2 shadow card inventory-prasarana"
                            style="display: none; background-color: rgba(226, 226, 253, 0.671); max-height: 12rem; overflow-x: hidden; overflow-y:auto;">
                            <div id="inventory-prasarana" class="p-3" style="overflow: hidden"></div>
                            <div class="d-flex justify-content-center align-items-center">
                                <button onclick="clearitems()" type="button" class="btn btn-danger mb-2">Clear</button>
                                {{-- <button type="button" class="btn btn-primary ms-2 mb-2">Save</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 " id="column-mobile">
                    <div class="col">
                        <div class="">
                            <p>Surat Peminjaman<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="custom-file">
                            <input class="form-control-file" name="surat_peminjaman" type="file"
                                accept=".docx,application/pdf, application/msword">
                        </div>
                        <div class="text-danger">
                            @error('surat_peminjaman')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col" id="data-diri-penanggung-jawab">
                        <div class="">
                            <p>Data Diri Penganggung Jawab<sup class="text-danger">*</sup></p>
                        </div>
                        <div class="custom-file">
                            <input class="form-control-file" name="datadiri_penanggungjawab" type="file"
                                accept=".docx,application/pdf, application/msword">
                        </div>
                        <div class="text-danger">
                            @error('datadiri_penanggungjawab')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3 " id="column-mobile">
                    <div class="col">
                        <div class="">
                            <p>Saran</p>
                        </div>
                        <div class="form-group">
                            <textarea name="saran" class="form-control">{{ old('saran') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col text-center">
                        <button type="submit" class="me-4 btn btn-primary"><i
                                class="fas fa-save me-2"></i>Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(".select2").select2();

        let inventory_prasarana = document.querySelector('.inventory-prasarana');
        $('#tanggalpenggunaan').on('change', function() {
            arr_items = [];
            document.getElementById("inventory-prasarana").innerHTML = "";
            inventory_prasarana.classList.remove('block');
            $('#select-sarana')
                .find('option:not(:first)')
                .remove()
                .end();
            var date = new Date($('#tanggalpenggunaan').val());
            day = date.getDate();
            month = date.getMonth() + 1;
            year = date.getFullYear();
            hour = date.getHours();
            minute = date.getMinutes();

            var tanggalpenggunaan = day + "-" + month + "-" + year + " " + hour + ":" + minute;
            // alert(tanggalpenggunaan);

            $.ajax({
                url: "{{ route('peminjaman.get-free-aset') }}",
                type: "GET",
                data: {
                    tanggal_penggunaan: tanggalpenggunaan,
                },
                success: function(response) {
                    if (response) {
                        console.log(response.data);
                        response.data.forEach(function(item, index) {
                            // console.log(item['kode']);
                            var textdata = item['nama_barang'] + ' || ' + item['kode'] +
                                ' || ' + item['nup'];
                            $('#select-sarana').append($('<option>', {

                                value: item['id'],
                                text: textdata
                            }));
                        });
                    }
                },
            });
        });

        var arr_items = [];
        var no_item = 0;

        function addCode() {
            no_item = no_item + 1;
            var input = document.getElementById('select-sarana');
            var id_aset = input.value;
            $('#select-sarana')
                .find('option[value=' + id_aset + ']')
                .remove()
                .end();
            arr_items.push(id_aset);
            inventory_prasarana.classList.add('block');

            // document.getElementById("inventory-prasarana").innerHTML +=
            //     "<p class=`mt-2`>This is the text which has been inserted by JS " +arr_items + "</p> <br>";

            $.ajax({
                url: "{{ route('peminjaman.temporary-data') }}",
                type: "GET",
                data: {
                    items: arr_items,
                    curr_id: id_aset
                },
                success: function(response) {
                    if (response) {
                        console.log(response.data2);

                        document.getElementById("inventory-prasarana").innerHTML += "<p class=`mt-1`>" +
                            no_item + ". " + response.data2['nama_barang'] + " || Kode Barang: " + response
                            .data2['kode'] + " || NUP: " + response.data2['nup'] + "<hr></p>";

                    }
                },
            });
        }

        function clearitems() {
            no_item = 0;
            arr_items = [];
            document.getElementById("inventory-prasarana").innerHTML = "";
            inventory_prasarana.classList.remove('block');
            $('#select-sarana')
                .find('option:not(:first)')
                .remove()
                .end();

            $('#tanggalpenggunaan').val('');
        }
    </script>
</x-app-layout>
