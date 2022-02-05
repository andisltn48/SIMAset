<div class="d-flex justify-content-center">
    <div class="m-1">
        <a  data-link="{{route('unit.update', $model->id)}}"
            data-kodeunit ="{{$model->kode_unit}}"
            data-namaunit ="{{$model->nama_unit}}"
            data-toggle="modal" data-target="#modal-unit-edit"
            style="border-radius: 2rem" type="submit" class="btn btn-block btn-warning btn-edit-unit"><i class="me-2 fas fa-edit"></i>Edit</a>
    </div>
    <div class="m-1">
        <form action="{{route('unit.destroy', $model->id)}}" method="POST">
            @method('DELETE')
            @csrf
            <button style="border-radius: 2rem" type="submit" class="btn btn-block btn-danger"
                onclick="return confirm('Apakah anda yakin untuk menghapus data unit ini ?');"><i
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