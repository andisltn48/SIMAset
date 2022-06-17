<x-app-layout title="Manajemen User">
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

        <div class="tab d-flex row-filter">
            <button class="m-1 btn btn-primary tablinks active" onclick="openTab(event, 'Peminjam')">Peminjam</button>
            <button class="m-1 btn btn-primary tablinks" onclick="openTab(event, 'Unit')">Unit</button>
            <button class="m-1 btn btn-primary tablinks" onclick="openTab(event, 'Sarpras')">Sapras</button>
            <button class="m-1 btn btn-primary tablinks" onclick="openTab(event, 'Admin')">Admin</button>
            <button class="m-1 btn btn-primary tablinks" onclick="openTab(event, 'SuperAdmin')">SuperAdmin</button>
            <a class="m-1 btn btn-success tablinks" data-toggle="modal" data-target="#modal-user-add">Tambah Akun</a>
        </div>

        <div id="Peminjam" class="tabcontent active">
          <div class="row header-peminjaman">
              <div class="col-12 col-md-8 title">
                  <h5 class="fw-bold">Daftar Peminjam</h5>
              </div>
          </div>
          <hr>
          <div class="row p-3">
              <table id="tablePeminjam" class=" ps-1 table table-bordered" style="width: 100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Created At</th>
                          <th>Update At</th>
                          <th>Action</th>
                      </tr>
                  </thead>
              </table>
          </div>
        </div>

        <div id="Unit" class="tabcontent">
          <div class="row header-peminjaman">
              <div class="col-12 col-md-8 title">
                  <h5 class="fw-bold">Daftar Unit</h5>
              </div>
          </div>
          <hr>
          <div class="row p-3">
              <table id="tableUnit" class=" ps-1 table table-bordered" style="width: 100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Created At</th>
                          <th>Update At</th>
                          <th>Action</th>
                      </tr>
                  </thead>
              </table>
          </div>
        </div>

        

        <div id="Sarpras" class="tabcontent">
          <div class="row header-peminjaman">
              <div class="col-12 col-md-8 title">
                  <h5 class="fw-bold">Daftar Sarpras</h5>
              </div>
          </div>
          <hr>
          <div class="row p-3">
              <table id="tableSarpras" class=" ps-1 table table-bordered" style="width: 100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Created At</th>
                          <th>Update At</th>
                          <th>Action</th>
                      </tr>
                  </thead>
              </table>
          </div>
        </div>

        <div id="Admin" class="tabcontent">
          <div class="row header-peminjaman">
              <div class="col-12 col-md-8 title">
                  <h5 class="fw-bold">Daftar Admin</h5>
              </div>
          </div>
          <hr>
          <div class="row p-3">
              <table id="tableAdmin" class=" ps-1 table table-bordered" style="width: 100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Created At</th>
                          <th>Update At</th>
                          <th>Action</th>
                      </tr>
                  </thead>
              </table>
          </div>
        </div>

        <div id="SuperAdmin" class="tabcontent">
          <div class="row header-peminjaman">
              <div class="col-12 col-md-8 title">
                  <h5 class="fw-bold">Daftar Super Admin</h5>
              </div>
          </div>
          <hr>
          <div class="row p-3">
              <table id="tableSuperAdmin" class=" ps-1 table table-bordered" style="width: 100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Created At</th>
                          <th>Update At</th>
                          <th>Action</th>
                      </tr>
                  </thead>
              </table>
          </div>
        </div>


         <!-- <div>
            <form action="{{route('test')}}" method="POST">
                @csrf
                <table>
                    <tr>
                        <td> <input type="hidden" name="a[]" value="xyz" /> xyz</td>
                        <td> <input type="hidden" name="b[]" value="123" /> 123</td>
                        <td> <input type="hidden" name="c[]" value="456" /> 456</td>
                        <td> <input type="hidden" name="d[]" value="abc" /> abc</td>
                    </tr>
                    <tr>
                        <td> <input type="hidden" name="a[]" value="xyzd" /> xyz</td>
                        <td> <input type="hidden" name="b[]" value="123z" /> 123</td>
                        <td> <input type="hidden" name="c[]" value="456s" /> 456</td>
                        <td> <input type="hidden" name="d[]" value="abcx" /> abc</td>
                    </tr>
                </table>
                <button type="submit">Input</button>
            </form>
        </div>  -->
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

    <div id="modal-user-add" class="modal fade bd-example-modal-lg" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah user</h4>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <!-- body modal -->

                <div class="model-body p-4">
                    <form class="mt-2 p-2" action="{{route('manajemen-user.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="text-dark fw">Role<sup class="text-danger">*</sup></label>
                                <select class="form-control" required name="role">
                                    <option value="">--Pilih--</option>
                                    @foreach ($roles as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="text-dark fw">Email<sup class="text-danger">*</sup></label>
                                <input class="form-control " name="email"
                                     required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Nama<sup class="text-danger">*</sup></label>
                                <input class="form-control " name="name"
                                     required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Password<sup
                                        class="text-danger">*</sup></label>
                                <input class="form-control " type="password" name="password" id="password2" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-group">
                                <label class="text-dark fw">Konfirmasi Password<sup
                                        class="text-danger">*</sup></label>
                                <input class="form-control" type="password" name="password_confirmation" id="password-confirm2" required>
                            </div>
                        </div>
                        <input style="margin-top: 0.9rem" type="checkbox" onclick="myFunctions()"> Show
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
        let tableSuperAdmin = $('#tableSuperAdmin').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },
                searchPlaceholder: "Cari email user"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [4, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('manajemen-user.get-superadmin') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'email',
            }, {
                className: "dt-nowrap",
                data: 'name',
            }, {
                className: "dt-nowrap",
                data: 'created_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'updated_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'action',
                searchable: false
            }],
        });

        let tableAdmin = $('#tableAdmin').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },
                searchPlaceholder: "Cari email user"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [4, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('manajemen-user.get-admin') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'email',
            }, {
                className: "dt-nowrap",
                data: 'name',
            }, {
                className: "dt-nowrap",
                data: 'created_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'updated_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'action',
                searchable: false
            }],
        });


        let tableSarpras = $('#tableSarpras').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },
                searchPlaceholder: "Cari email user"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [4, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('manajemen-user.get-sarpras') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'email',
            }, {
                className: "dt-nowrap",
                data: 'name',
            }, {
                className: "dt-nowrap",
                data: 'created_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'updated_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'action',
                searchable: false
            }],
        });

        let tablePeminjam = $('#tablePeminjam').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },
                searchPlaceholder: "Cari email user"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [4, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('manajemen-user.get-peminjam') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'email',
            }, {
                className: "dt-nowrap",
                data: 'name',
            }, {
                className: "dt-nowrap",
                data: 'created_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'updated_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'action',
                searchable: false
            }],
        });

        let tableUnit = $('#tableUnit').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                },
                searchPlaceholder: "Cari email user"
            },
            pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
            order: [
                [4, "desc"]
            ],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('manajemen-user.get-pengaju') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'email',
            }, {
                className: "dt-nowrap",
                data: 'name',
            }, {
                className: "dt-nowrap",
                data: 'created_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'updated_at',
                searchable: false
            }, {
                className: "dt-nowrap",
                data: 'action',
                searchable: false
            }],
        });

        $.fn.DataTable.ext.pager.numbers_length = 5;

        $(document).ready(function() {
           $('.dataTables_filter input[type="search"]').css({
               'max-width': '130px',
               'display': 'inline-block'
           });
         });

        function openTab(evt, tabName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " active";

          tableSuperAdmin.ajax.reload(null, false)
          tableAdmin.ajax.reload(null, false)
          tableSarpras.ajax.reload(null, false)
          tablePeminjam.ajax.reload(null, false)
          tableUnit.ajax.reload(null, false)
        }

        $(document).on('click', '.btn-edit-user', function(event) {
            // return confirm($(this).data('tanggalSP2D'));
            var link = $(this).data('link');
            var name = $(this).data('name');
            var email = $(this).data('email');


            $('#form-edit').attr('action', link);
            $('#email-edit').val(email);
            $('#name-edit').val(name);
        });

        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("password-confirm");


            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }


        }

        function myFunctions() {
            var s = document.getElementById("password2");
            var j = document.getElementById("password-confirm2");

            if (s.type === "password") {
                s.type = "text";
            } else {
                s.type = "password";
            }

            if (j.type === "password") {
                j.type = "text";
            } else {
                j.type = "password";
            }
        }
    </script>
</x-app-layout>
{{-- <div style="background: rgb(233, 189, 160); border-radius: 2rem;" class="p-2 text-white"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div> --}}
