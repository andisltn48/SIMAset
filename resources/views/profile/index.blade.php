<x-app-layout title="Profil">
    <div class="card shadow p-3 mb-5 bg-white rounded mobile-margin" style="border-radius: 0.7rem !important">
        @if (session('error'))
            <div id="alert-div" class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body text-white">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div id="alert-div" class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-white">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div id="alert-div" class="alert alert-success alert-dismissible show fade">
                <div class="alert-body text-white">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row header-peminjaman">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Profil</h5>
            </div>
        </div>
        <hr>
        <form class="forms-sample">
            <div class="form-group row">
                <p for="exampleInputUsername2" class="col-sm-3 text-dark fw-bold">Nama</p>
                <div class="col-sm-9">
                    <p >{{$user->name}}</p>
                </div>
            </div>
            <div class="form-group row">
                <p for="exampleInputUsername2" class="col-sm-3 text-dark fw-bold">Email</p>
                <div class="col-sm-9">
                    <p>{{$user->email}}</p>
                </div>
            </div>
            <div class="form-group row">
                <p for="exampleInputUsername2" class="col-sm-3 text-dark fw-bold">Role</p>
                <div class="col-sm-9">
                    <p>{{session('role')}}</p>
                </div>
            </div>
            <div class="form-group row">
                <p for="exampleInputUsername2" class="col-sm-3 text-dark fw-bold">Created At</p>
                <div class="col-sm-9">
                    <p>{{$user->created_at}}</p>
                </div>
            </div>
            <div class="form-group row">
                <p for="exampleInputUsername2" class="col-sm-3 text-dark fw-bold">Updated At</p>
                <div class="col-sm-9">
                    <p >{{$user->updated_at}}</p>
                </div>
            </div>
            <div class="text-center">
              <a  data-link="{{route('manajemen-profil.update', $user->id)}}"
                  data-email ="{{$user->email}}"
                  data-name ="{{$user->name}}"
                  data-toggle="modal" data-target="#modal-user-edit"
                  type="submit" class="btn btn-block btn-warning btn-edit-user"><i class="me-2 fas fa-edit"></i>Edit</a>
            </div>
        </form>
    </div>
    <div id="modal-user-edit" class="modal fade bd-example-modal-lg" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit data user</h4>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <!-- body modal -->

                <div class="model-body p-4">
                    <form class="mt-2 p-2" id="form-edit" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="text-dark fw">Email<sup class="text-danger">*</sup></label>
                                <input class="form-control " name="email" id="email-edit"
                                     readonly>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Nama<sup class="text-danger">*</sup></label>
                                <input class="form-control " name="name" id="name-edit"
                                     required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Password</label>
                                <input class="form-control " type="password" name="password" id="password">
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Konfirmasi Password</label>
                                <input class="form-control" type="password" name="password_confirmation" id="password-confirm">
                            </div>
                        </div>
                        <input style="margin-top: 0.9rem" type="checkbox" onclick="myFunction()"> Show
                        Password
                        <div class="col text-center mt-4">
                            <button type="submit" class="btn btn-primary shadow">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".select2").select2();


        // window.alert(id);
        let table = $('#tableListAktivitas').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },

                searchPlaceholder: "Cari nama user"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [4, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('aktivitas-sistem.get-aktivitas') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'name',
            }, {
                className: "dt-nowrap",
                data: 'user_role',
            }, {
                className: "dt-nowrap",
                data: 'user_activity',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'created_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'action',
                searchable: false
            }],
        });

        $.fn.DataTable.ext.pager.numbers_length = 5;

        $(document).on('click', '.btn-edit-user', function(event) {
            // return confirm($(this).data('tanggalSP2D'));
            var link = $(this).data('link');
            var name = $(this).data('name');
            var email = $(this).data('email');


            $('#form-edit').attr('action', link);
            $('#email-edit').val(email);
            $('#name-edit').val(name);
        });
    </script>
</x-app-layout>
