<div class="d-flex justify-content-center">
    <div class="m-1">
        <a  data-link="{{route('data-ruangan.update', $model->id)}}"
            data-koderuangan ="{{$model->kode_ruangan}}"
            data-namaruangan ="{{$model->nama_ruangan}}"
            data-pj ="{{$model->pj}}"
            data-nip ="{{$model->nip}}" 
            data-kodegedung ="{{$model->kode_gedung}}" 
            data-toggle="modal" data-target="#modal-ruangan-edit"
            style="border-radius: 2rem" type="submit" class="btn btn-block btn-warning btn-edit-ruangan"><i class="me-2 fas fa-edit"></i>Edit</a>
    </div>
    <div class="m-1">
        <form action="{{route('data-ruangan.destroy', $model->id)}}" method="POST">
            @method('DELETE')
            @csrf
            <button style="border-radius: 2rem" type="submit" class="btn btn-block btn-danger"
                onclick="return confirm('Apakah anda yakin untuk menghapus data ruangan ini ?');"><i
                    class="fas fa-trash-alt me-2"></i>Hapus</button>
        </form>
    </div>
</div>

{{-- <div>
    $pemesanantiketnew
    $idwisata
    @if ($pemesanantiketnew->user_id == Auth::user()->id)
        @if ($pemesanantiketnew->wisata_id == $idwisata)
            <button>blaawda</button>
        @endif
    @endif
</div> --}}