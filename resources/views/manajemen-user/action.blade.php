<div class="d-flex justify-content-around ">
    <div class="m-1">
      <a  data-link="{{route('manajemen-user.update', $model->id)}}"
          data-email ="{{$model->email}}"
          data-name ="{{$model->name}}"
          data-toggle="modal" data-target="#modal-user-edit"
          type="submit" class="btn btn-block btn-warning btn-edit-user"><i class="me-2 fas fa-edit"></i>Edit</a>
    </div>
    <div class="m-1">
        <form action="{{ route('manajemen-user.destroy', $model->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus user ini ?');"><i
                class="fas fa-trash-alt me-2"></i>Hapus</button>
        </form>
    </div>
</div>
