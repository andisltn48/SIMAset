<div class="d-flex justify-content-around ">
    @if ($model->status_permintaan == 'Disetujui' || $model->status_permintaan == 'Ditolak')
    <div>
        <button disabled data-toggle="modal" data-target="#modal-confirm" data-link={{ route('peminjaman.confirm-request', $model->no_peminjaman) }} class="btn me-1 btn-block btn-primary btn-confirm"><i
            class="fas fa-check-square me-2"></i>Konfirmasi</button>
    </div>
    @else
    <div>
        <a data-toggle="modal" data-target="#modal-confirm" data-link={{ route('peminjaman.confirm-request', $model->no_peminjaman) }} class="btn me-1 btn-block btn-primary btn-confirm"><i
            class="fas fa-check-square me-2"></i>Konfirmasi</a>
    </div>
    @endif
    <div>
        <form action="{{route('peminjaman.destroy-permintaan', $model->no_peminjaman)}}" method="POST">
            
            @csrf
            <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus permintaan ini?');"><i
            class="fas fa-trash-alt me-2"></i>Hapus</button>
        </form>
    </div>
</div>
