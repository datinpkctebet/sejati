{{-- Modal: Sukses – tampilkan nomor tiket --}}
<div class="modal fade" id="kt_modal_sukses_tiket" tabindex="-1" aria-hidden="true"
     data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">
            <div class="modal-body py-15 px-lg-17 text-center">

                {{-- Animasi centang --}}
                <div class="mb-8">
                    <div class="d-inline-flex align-items-center justify-content-center
                                w-90px h-90px rounded-circle bg-light-success mb-5">
                        <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h2 class="fw-bolder text-dark mb-2">Pengajuan Berhasil!</h2>
                    <p class="text-muted fs-6">
                        Permohonan kerja sama Anda telah berhasil diterima oleh sistem.
                        Puskesmas Tebet akan segera memproses pengajuan Anda.
                    </p>
                </div>

                {{-- Nomor Tiket --}}
                <div class="bg-light-primary rounded p-7 mb-8">
                    <p class="text-gray-700 fw-bold fs-6 mb-2">Nomor Tiket Anda</p>
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <span id="sukses_nomor_tiket"
                              class="fw-bolder fs-1 text-primary letter-spacing-lg"
                              style="letter-spacing: 3px;">–</span>
                        <button type="button"
                                class="btn btn-sm btn-icon btn-light-primary"
                                id="btn_copy_tiket"
                                title="Salin nomor tiket">
                            <i class="fas fa-copy fs-6"></i>
                        </button>
                    </div>
                    <p class="text-muted fs-7 mt-3 mb-0">
                        <i class="fas fa-info-circle me-1"></i>
                        Simpan nomor tiket ini untuk memantau status pengajuan Anda.
                    </p>
                </div>

                {{-- Langkah selanjutnya --}}
                <div class="text-start bg-light rounded p-6 mb-8">
                    <h5 class="fw-bolder text-gray-800 mb-4">Langkah Selanjutnya:</h5>
                    <div class="d-flex align-items-start mb-3">
                        <span class="badge badge-circle badge-light-primary me-3 mt-1">1</span>
                        <span class="text-gray-700 fs-6">Puskesmas akan menjadwalkan kunjungan dalam <strong>maksimal 2 hari kerja</strong>.</span>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <span class="badge badge-circle badge-light-primary me-3 mt-1">2</span>
                        <span class="text-gray-700 fs-6">Pantau status pengajuan menggunakan nomor tiket di bagian <strong>Tracking Ticket</strong>.</span>
                    </div>
                    <div class="d-flex align-items-start">
                        <span class="badge badge-circle badge-light-primary me-3 mt-1">3</span>
                        <span class="text-gray-700 fs-6">Informasi lebih lanjut akan dikirim melalui email yang Anda daftarkan.</span>
                    </div>
                </div>

                {{-- Tombol aksi --}}
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btn_track_from_sukses">
                        <i class="fas fa-search me-2"></i>Cek Status Sekarang
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Salin nomor tiket ke clipboard
$('#btn_copy_tiket').on('click', function () {
    const tiket = $('#sukses_nomor_tiket').text();
    navigator.clipboard.writeText(tiket).then(() => {
        $(this).html('<i class="fas fa-check fs-6 text-success"></i>');
        setTimeout(() => { $(this).html('<i class="fas fa-copy fs-6"></i>'); }, 2000);
    });
});

// Tracking langsung dari modal sukses
$('#btn_track_from_sukses').on('click', function () {
    const tiket = $('#sukses_nomor_tiket').text();
    $('#kt_modal_sukses_tiket').modal('hide');
    $('#tracking_input').val(tiket);
    // Scroll ke section tracking
    $('html, body').animate({ scrollTop: $('#tracking_input').offset().top - 120 }, 400, function () {
        $('#btn_tracking').trigger('click');
    });
});
</script>
@endpush