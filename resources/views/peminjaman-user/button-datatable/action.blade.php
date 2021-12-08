<div class="d-flex justify-content-around ">
    @if ($model->status_permintaan == 'Disetujui')
        <div>
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-block btn-danger" disabled><i
                        class="fas fa-trash-alt me-2"></i>Hapus</button>
            </form>
        </div>
    @else
        <div>
            <form action="{{route('peminjaman.destroy-permintaan', $model->no_peminjaman)}}" method="POST">
                
                @csrf
                <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus permintaan ini?');"><i
                class="fas fa-trash-alt me-2"></i>Hapus</button>
            </form>
        </div>
    @endif
</div>
