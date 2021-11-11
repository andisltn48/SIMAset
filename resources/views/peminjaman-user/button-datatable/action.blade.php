<div class="d-flex justify-content-around ">
    @if ($model->status_peminjaman == 'Disetujui')
        <div>
            <button class="btn me-1 btn-block btn-warning" disabled>
                <a class="text-dark" style="text-decoration: none;"
                    href="{{ route('data-aset.detail-riwayat-import', $model->id) }}"><i
                    class="fas fa-edit me-2"></i>Edit</a>
            </button>
        </div>
        <div>
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-block btn-danger" onclick="confirm_delete()" disabled><i
                        class="fas fa-trash-alt me-2"></i>Hapus</button>
            </form>
        </div>
    @else
        <div>
            <button class="btn me-1 btn-block btn-warning">
                <a class="text-dark" style="text-decoration: none;"
                    href="{{ route('data-aset.detail-riwayat-import', $model->id) }}"><i
                        class="fas fa-edit me-2"></i>Edit</a>
            </button>
        </div>
        <div>
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-block btn-danger" onclick="confirm_delete()"><i
                        class="fas fa-trash-alt me-2"></i>Hapus</button>
            </form>
        </div>
    @endif
    <script>
        function confirm_delete() {
            return confirm('Apakah anda yakin untuk menghapus riwayat impor aset ini ? ');
        }
    </script>
</div>
