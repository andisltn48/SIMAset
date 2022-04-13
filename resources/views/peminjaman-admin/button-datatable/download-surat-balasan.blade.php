<div class="d-flex justify-content-around ">
    <div>
        @if ($model->surat_balasan != NULL)
        <a target="_blank" href="{{route('peminjaman.download-surat-balasan-admin', $model->no_peminjaman)}}" class="btn me-1 btn-block btn-primary" id="download"><i
            class="fas fa-download me-2"></i>Download Surat</a>
        @endif
    </div>
</div>