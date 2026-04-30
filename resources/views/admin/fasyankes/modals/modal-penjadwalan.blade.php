{{-- Modal: Jadwalkan Kunjungan (status: proses_penjadwalan) --}}
<div class="modal fade" id="modal_penjadwalan" tabindex="-1" aria-hidden="true"
     data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">
            <div class="modal-header bg-light-warning">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40px me-4">
                        <span class="symbol-label bg-warning">
                            <i class="fas fa-calendar-plus text-white fs-4"></i>
                        </span>
                    </div>
                    <div>
                        <h3 class="modal-title fw-bolder mb-0">Jadwalkan Kunjungan</h3>
                        <span class="text-muted fs-7">Status: Proses Penjadwalan Kunjungan</span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times fs-4"></i>
                </button>
            </div>

            <form id="form_penjadwalan">
                @csrf
                <div class="modal-body py-8 px-lg-12">

                    {{-- Info Fasyankes --}}
                    <div class="bg-light-warning rounded p-5 mb-7">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clinic-medical text-warning fs-3 me-4"></i>
                            <div>
                                <div class="fw-bolder text-dark fs-6" id="pj_nama_fasyankes">–</div>
                                <div class="text-muted fs-7">
                                    Tiket: <span id="pj_nomor_tiket" class="fw-bold text-primary">–</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-7 p-5">
                        <i class="fas fa-info-circle fs-3 text-primary me-4 mt-1"></i>
                        <div class="text-gray-700 fs-7">
                            Setelah tanggal kunjungan disimpan, informasi ini akan langsung tampil di
                            <strong>Tracking Ticket</strong> fasyankes. Kunjungan dilakukan dalam maks.
                            <strong>2 hari kerja</strong>.
                        </div>
                    </div>

                    {{-- Tanggal Kunjungan --}}
                    <div class="mb-7">
                        <label class="required fw-bolder text-gray-700 fs-6 mb-2">
                            <i class="fas fa-calendar-day me-2 text-warning"></i>Tanggal Kunjungan
                        </label>
                        <input type="date" id="pj_jadwal_kunjungan" name="jadwal_kunjungan"
                               class="form-control form-control-solid"
                               min="{{ date('Y-m-d') }}" required/>
                        <div class="form-text text-muted">Pilih tanggal yang sesuai jadwal petugas Puskesmas.</div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-2">
                        <label class="fw-bolder text-gray-700 fs-6 mb-2">
                            <i class="fas fa-comment-alt me-2 text-muted"></i>Keterangan <span class="text-muted fs-7">(opsional)</span>
                        </label>
                        <textarea id="pj_keterangan" name="keterangan" rows="3"
                                  class="form-control form-control-solid"
                                  placeholder="Contoh: Kunjungan akan dilaksanakan pukul 10.00 WIB oleh petugas..."></textarea>
                    </div>
                </div>
                <div class="modal-footer flex-center py-5">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">
                        <span class="indicator-label"><i class="fas fa-save me-2"></i>Simpan Jadwal</span>
                        <span class="indicator-progress">Menyimpan... <span class="spinner-border spinner-border-sm ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>