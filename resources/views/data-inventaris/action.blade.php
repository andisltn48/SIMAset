<div class="d-flex justify-content-around ">
    <div>
        <a data-toggle="modal" data-target="#modal-detail" data-id="{{ $model->id }}"
            data-namabarang="{{ $model->nama_barang }}" data-kode="{{ $model->kode }}" data-nup="{{ $model->nup }}"
            data-uraianbarang="{{ $model->uraian_barang }}" data-hargasatuan="{{ $model->harga_satuan }}"
            data-hargatotal="{{ $model->harga_total }}" data-nilaitagihan="{{ $model->nilai_tagihan }}"
            data-tanggalsp2d="{{ $model->tanggal_SP2D }}" data-nomorsp2d="{{ $model->nomor_SP2D }}"
            data-kelompokbelanja="{{ $model->kelompok_belanja }}" data-asalperolehan="{{ $model->asal_perolehan }}"
            data-nomorbuktiperolehan="{{ $model->nomor_bukti_perolehan }}" data-merk="{{ $model->merk }}"
            data-sumberdana="{{ $model->sumber_dana }}" data-pic="{{ $model->pic }}"
            data-koderuangan="{{ $model->kode_ruangan }}" data-kondisi="{{ $model->kondisi }}"
            data-foto="{{asset('storage/foto-inventaris/'.$model->foto) }}"
            data-unit="{{ $model->nama_unit }}" data-status="{{ $model->status }}" data-gedung="{{ $model->gedung }}"
            data-ruangan="{{ $model->ruangan }}" data-catatan="{{ $model->catatan }}" data-tahunpengadaan="{{ $model->tahun_pengadaan }}"
            data-link={{ route('data-inventaris.edit', $model->id) }} class="btn me-1 btn-block btn-primary btn-detail"><i
                class="fas fa-eye me-2"></i>Detail</a>
    </div>
    {{-- <div>
        <a href="{{ route('data-inventaris.edit', $model->id) }}"><button class="btn me-1 btn-block btn-warning"
                style="width: 5vw;">Edit</button></a>
    </div> --}}
    @if (session('role') == 'Super Admin' || session('role') == 'Admin' || session('role') == 'BMN')
        <div>
            <form action="{{ route('data-inventaris.destroy', $model->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data inventaris ini ?');"><i
                    class="fas fa-trash-alt me-2"></i>Hapus</button>
            </form>
        </div>
    @else
    <div>
        <form action="{{ route('data-inventaris.destroy', $model->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button disabled type="submit" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus desain ini ?');"><i
                class="fas fa-trash-alt me-2"></i>Hapus</button>
        </form>
    </div>
    @endif
</div>
