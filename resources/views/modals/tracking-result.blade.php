{{-- Modal: Hasil Tracking Tiket --}}
<div class="modal fade" id="kt_modal_tracking_result" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Status Pengajuan Kerja Sama</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"/>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"/>
                        </svg>
                    </span>
                </div>
            </div>

            <div class="modal-body py-10 px-lg-17">
                <div class="scroll-y me-n7 pe-7" style="max-height: 70vh; overflow-y: auto;">

                    {{-- Info Pengajuan --}}
                    <div class="card bg-light mb-8">
                        <div class="card-body py-6 px-7">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted fs-7 fw-bold mb-1">Nomor Tiket</span>
                                        <span id="tr_nomor_tiket" class="fw-bolder fs-5 text-primary"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted fs-7 fw-bold mb-1">Status Terkini</span>
                                        <span id="tr_status_badge" class="badge fs-7 fw-bolder d-inline-flex align-items-center" style="width:fit-content"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted fs-7 fw-bold mb-1">Nama Fasyankes</span>
                                        <span id="tr_nama_fasyankes" class="fw-bold text-dark fs-6"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted fs-7 fw-bold mb-1">Jenis Fasyankes</span>
                                        <span id="tr_jenis_fasyankes" class="fw-bold text-dark fs-6"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted fs-7 fw-bold mb-1">Jenis Pengajuan</span>
                                        <span id="tr_jenis_pengajuan" class="fw-bold text-dark fs-6"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted fs-7 fw-bold mb-1">Tanggal Pengajuan</span>
                                        <span id="tr_tanggal_pengajuan" class="fw-bold text-dark fs-6"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="mb-8">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bolder text-gray-800 fs-6">Progress Pengajuan</span>
                            <span id="tr_progress_text" class="fw-bold text-primary fs-6"></span>
                        </div>
                        <div class="progress h-12px rounded">
                            <div id="tr_progress_bar"
                                 class="progress-bar bg-primary"
                                 role="progressbar"
                                 style="width: 0%"
                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    {{-- Timeline Steps --}}
                    <h5 class="fw-bolder text-gray-800 mb-6">
                        <i class="fas fa-history me-2 text-primary"></i>Riwayat Status
                    </h5>
                    <div id="tr_steps"></div>

                </div>
            </div>

            <div class="modal-footer flex-center">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-light-primary" id="btn_refresh_tracking">
                    <i class="fas fa-sync-alt me-2"></i>Refresh Status
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Refresh tracking dari dalam modal
$('#btn_refresh_tracking').on('click', function () {
    const tiket = $('#tr_nomor_tiket').text();
    if (!tiket) return;

    const $btn = $(this);
    $btn.prop('disabled', true).html('<i class="fas fa-sync-alt fa-spin me-2"></i>Memuat...');

    $.ajax({
        url: '{{ route("pengajuan.tracking") }}',
        type: 'POST',
        data: { nomor_tiket: tiket },
        success(res) {
            $btn.prop('disabled', false).html('<i class="fas fa-sync-alt me-2"></i>Refresh Status');
            if (res.success) renderTracking(res);
        },
        error() {
            $btn.prop('disabled', false).html('<i class="fas fa-sync-alt me-2"></i>Refresh Status');
        }
    });
});

// Override renderTracking to also update progress bar
const _origRenderTracking = window.renderTracking;
window.renderTracking = function (res) {
    _origRenderTracking(res);
    const step     = res.pengajuan.status_step;
    const totalSteps = 4;
    const pct      = Math.round((step / totalSteps) * 100);
    $('#tr_progress_bar').css('width', pct + '%').attr('aria-valuenow', pct);
    $('#tr_progress_text').text(step + ' / ' + totalSteps + ' tahap');
};
</script>
@endpush