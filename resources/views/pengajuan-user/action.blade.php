<div class="d-flex justify-content-around ">
    <div>
        <form action="{{route('pengajuan.destroy-pengajuan', $model->id)}}" method="POST">
            
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus pengajuan ini?');"><i
            class="fas fa-trash-alt me-2"></i>Hapus</button>
        </form>
    </div>
</div>
