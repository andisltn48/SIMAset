<x-app-layout title="Template Surat">
    <div class="mt-4 card shadow p-3 mb-5 bg-white rounded dataaset-card">
        <div class="row ">
            <div class="col-12 col-md-8 title">
                <h5 class="fw-bold">Download Template Surat</h5>
            </div>
            <div class="col button text-end">
                <a href="{{ route('peminjaman.form') }}"><button class="btn btn-block btn-success">Form Peminjaman</button></a>
            </div>
        </div>
        <hr>
        <div class="mt-5">
            <div>
                <p>Kategori Surat</p>
            </div>
            <div class="form-group">
                <select class="form-select">
                    <option value="" >Peminjaman Auditorium</option>
                </select>
            </div>
        </div>
        <div class="mt-5">
            <div class="text-center">
                <p>Download Template Surat : <a href=""><button class="ms-2 btn btn-primary"> <i
                    class="fas fa-fw fa-file-word me-2"></i>Download Template</button></a></p>
            </div>
        </div>
    </div>
</x-app-layout>
