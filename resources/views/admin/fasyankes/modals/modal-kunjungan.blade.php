{{-- Modal: Hasil Kunjungan (status: kunjungan_selesai) --}}
<div class="modal fade" id="modal_kunjungan" tabindex="-1" aria-hidden="true"
     data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header bg-light-info">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40px me-4">
                        <span class="symbol-label bg-info">
                            <i class="fas fa-clipboard-check text-white fs-4"></i>
                        </span>
                    </div>
                    <div>
                        <h3 class="modal-title fw-bolder mb-0">Input Hasil Kunjungan</h3>
                        <span class="text-muted fs-7">Status: Kunjungan Selesai</span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times fs-4"></i>
                </button>
            </div>

            <form id="form_kunjungan">
                @csrf
                <div class="modal-body py-8 px-lg-12">

                    {{-- Info Fasyankes --}}
                    <div class="bg-light-info rounded p-5 mb-7">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clinic-medical text-info fs-3 me-4"></i>
                                <div>
                                    <div class="fw-bolder text-dark fs-6" id="kj_nama_fasyankes">–</div>
                                    <div class="text-muted fs-7">
                                        Tiket: <span id="kj_nomor_tiket" class="fw-bold text-primary">–</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="text-muted fs-8">Tgl. Kunjungan</div>
                                <div class="fw-bold fs-7 text-dark" id="kj_jadwal">–</div>
                            </div>
                        </div>
                    </div>

                    {{-- Pilih Hasil Kunjungan --}}
                    <div class="mb-7">
                        <label class="required fw-bolder text-gray-700 fs-6 mb-4">
                            <i class="fas fa-tasks me-2 text-info"></i>Hasil Kunjungan
                        </label>
                        <div class="row g-4">
                            {{-- Memenuhi Syarat --}}
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="hasil_kunjungan"
                                       value="memenuhi_syarat" id="hasil_memenuhi" required/>
                                <label class="btn btn-outline btn-outline-dashed btn-outline-success
                                              d-flex align-items-center p-5 h-100 gap-3"
                                       for="hasil_memenuhi">
                                    <div class="symbol symbol-50px">
                                        <span class="symbol-label bg-light-success">
                                            <i class="fas fa-check-circle text-success fs-2"></i>
                                        </span>
                                    </div>
                                    <div class="text-start">
                                        <span class="fw-bolder text-dark d-block fs-5">Memenuhi Syarat</span>
                                        <span class="text-muted fw-semibold fs-7">
                                            Proses PKS dapat dilanjutkan
                                        </span>
                                    </div>
                                </label>
                            </div>
                            {{-- Tidak Memenuhi Syarat --}}
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="hasil_kunjungan"
                                       value="tidak_memenuhi_syarat" id="hasil_tidak"/>
                                <label class="btn btn-outline btn-outline-dashed btn-outline-danger
                                              d-flex align-items-center p-5 h-100 gap-3"
                                       for="hasil_tidak">
                                    <div class="symbol symbol-50px">
                                        <span class="symbol-label bg-light-danger">
                                            <i class="fas fa-times-circle text-danger fs-2"></i>
                                        </span>
                                    </div>
                                    <div class="text-start">
                                        <span class="fw-bolder text-dark d-block fs-5">Tidak Memenuhi</span>
                                        <span class="text-muted fw-semibold fs-7">
                                            Fasyankes perlu tindak lanjut
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-2">
                        <label class="fw-bolder text-gray-700 fs-6 mb-2">
                            <i class="fas fa-comment-alt me-2 text-muted"></i>
                            Keterangan / Temuan
                            <span class="text-muted fs-7">(opsional)</span>
                        </label>
                        <textarea id="kj_keterangan" name="keterangan_kunjungan" rows="4"
                                  class="form-control form-control-solid"
                                  placeholder="Tuliskan temuan, catatan kunjungan, atau informasi tambahan untuk fasyankes..."></textarea>
                    </div>

                    {{-- Info lanjutan berdasarkan pilihan --}}
                    <div id="info_memenuhi" class="notice d-flex bg-light-success rounded border-success border border-dashed mt-5 p-5 d-none">
                        <i class="fas fa-info-circle fs-3 text-success me-4 mt-1"></i>
                        <div class="text-gray-700 fs-7">
                            Setelah disimpan, status akan berubah ke <strong>Kunjungan Selesai</strong>.
                            Tombol <strong>Proses TTD</strong> akan muncul untuk melanjutkan ke tahap penandatanganan PKS.
                        </div>
                    </div>
                    <div id="info_tidak_memenuhi" class="notice d-flex bg-light-danger rounded border-danger border border-dashed mt-5 p-5 d-none">
                        <i class="fas fa-exclamation-triangle fs-3 text-danger me-4 mt-1"></i>
                        <div class="text-gray-700 fs-7">
                            Fasyankes akan diinformasikan untuk menindaklanjuti temuan dan
                            <strong>mengajukan ulang</strong> setelah perbaikan selesai dilakukan.
                        </div>
                    </div>
                </div>

                <div class="modal-footer flex-center py-5">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white">
                        <span class="indicator-label"><i class="fas fa-save me-2"></i>Simpan Hasil</span>
                        <span class="indicator-progress">Menyimpan... <span class="spinner-border spinner-border-sm ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$('input[name="hasil_kunjungan"]').on('change', function () {
    const val = $(this).val();
    $('#info_memenuhi').toggleClass('d-none', val !== 'memenuhi_syarat');
    $('#info_tidak_memenuhi').toggleClass('d-none', val !== 'tidak_memenuhi_syarat');
});
</script>
@endpush