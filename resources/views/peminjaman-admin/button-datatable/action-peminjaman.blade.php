<div class="d-flex justify-content-around ">
    @if ($model->status_peminjaman == 'Dalam Peminjaman')
    <div>
        <a href="{{route('peminjaman.done-peminjaman', $model->id)}}" class="btn me-1 btn-block btn-primary btn-confirm"><i
            class="fas fa-check-square me-2"></i>Selesai</a>
    </div>
    @else
      <div>
          <form action="{{route('peminjaman.destroy-peminjaman', $model->id)}}" method="POST">
              @csrf
              <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus permintaan ini?');"><i
              class="fas fa-trash-alt me-2"></i>Hapus</button>
          </form>
      </div>
    @endif
</div>
