<div class="d-flex justify-content-center">
    <div class="m-1">
        <a data-link="" data-informasi="{{ $model->informasi }}" data-toggle="modal" data-target="#modal-informasi-edit"
            style="border-radius: 2rem" type="submit" class="btn btn-block btn-warning btn-edit-informasi"><i
            class="fas fa-trash-alt me-2"></i>Edit</a>
    </div>
    <div class="m-1">
        <form action="" method="POST">
            @method('DELETE')
            @csrf
            <button style="border-radius: 2rem" type="submit" class="btn btn-block btn-danger"
                onclick="return confirm('Apakah anda yakin untuk menghapus ruangan ini ?');"><i
                    class="fas fa-trash-alt me-2"></i>Hapus</button>
        </form>
    </div>
</div>