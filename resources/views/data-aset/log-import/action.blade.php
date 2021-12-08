<div class="d-flex justify-content-around ">
    <div>
        <a href="{{ route('data-aset.detail-riwayat-import', $model->id) }}"
            class="btn me-1 btn-block btn-primary btn-detail"><i class="fas fa-eye me-2"></i>Detail</a>
    </div>
    {{-- <div>
        <a href="{{ route('data-aset.edit', $model->id) }}"><button class="btn me-1 btn-block btn-warning"
                style="width: 5vw;">Edit</button></a>
    </div> --}}
    <div>
        <form action="{{ route('data-aset.destroy-log-import', $model->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus riwayat impor ini ?');"><i
                    class="fas fa-trash-alt me-2"></i>Hapus</button>
        </form>
    </div>
    <script>
        function confirm_delete() {
            return confirm('Apakah anda yakin untuk menghapus riwayat impor aset ini ? ');
        }
    </script>
</div>
