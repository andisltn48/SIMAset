<x-app-layout title="Daftar Permintaan">
    <div class="card shadow p-3 mb-5 bg-white rounded mobile-margin" style="border-radius: 0.7rem !important">
        @if (session('error'))
            <div id="alert-div" class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @if (session('success'))
            <div id="alert-div" class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row header-peminjaman">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Daftar Aktivitas Dalam Sistem</h5>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <table id="tableListAktivitas" class=" ps-1 table table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Aktivitas</th>
                        <th>Tanggal Aktivitas</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        {{-- <div>
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
        </div> --}}
    </div>

    <script>
        $(".select2").select2();


        // window.alert(id);
        let table = $('#tableListAktivitas').DataTable({
            language: {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                }
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
    </script>
</x-app-layout>
{{-- <div style="background: rgb(233, 189, 160); border-radius: 2rem;" class="p-2 text-white"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div> --}}
