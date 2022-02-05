<div class="d-flex justify-content-around ">
    <div>
        <form action="{{ route('aktivitas-sistem.destroy', $model->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus aktivitas ini ?');"><i
                class="fas fa-trash-alt me-2"></i>Hapus</button>
        </form>
    </div>
</div>