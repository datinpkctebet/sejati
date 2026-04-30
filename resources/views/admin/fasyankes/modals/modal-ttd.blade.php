{{-- Modal: Proses Tanda Tangan PKS (status: proses_ttd) --}}
<div class="modal fade" id="modal_ttd" tabindex="-1" aria-hidden="true"
     data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">
            <div class="modal-header bg-light-primary">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40px me-4">
                        <span class="symbol-label bg-primary">
                            <i class="fas fa-pen-fancy text-white fs-4"></i>
                        </span>
                    </div>
                    <div>
                        <h3 class="modal-title fw-bolder mb-0">Proses Tanda Tangan PKS</h3>
                        <span class="text-muted fs-7">Status: Kunjungan Selesai → Proses TTD</span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times fs-4"></i>
                </button>
            </div>

            <form id="form_ttd">
                @csrf
                <div class="modal-body py-8 px-lg-12">

                    {{-- Info Fasyankes --}}
                    <div class="bg-light-primary rounded p-5 mb-7">
                        <div class="row g-3">
                            <div class="col-md-8 d-flex align-items-center">
                                <i class="fas fa-clinic-medical text-primary fs-3 me-4"></i>
                                <div>
                                    <div class="fw-bolder text-dark fs-6" id="ttd_nama_fasyankes">–</div>
                                    <div class="text-muted fs-7">
                                        Tiket: <span id="ttd_nomor_tiket" class="fw-bold text-primary">–</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="text-muted fs-8 mb-1">Hasil Kunjungan</div>
                                <span class="badge badge-light-success fw-bolder fs-7" id="ttd_hasil">–</span>
                            </div>
                        </div>
                    </div>

                    {{-- Notice TTD --}}
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-7 p-5">
                        <i class="fas fa-info-circle fs-3 text-primary me-4 mt-1"></i>
                        <div class="text-gray-700 fs-7">
                            <strong>Langkah selanjutnya untuk fasyankes:</strong>
                            <ul class="mt-2 mb-0 ps-4">
                                <li>Cetak draf PKS sebanyak <strong>2 rangkap</strong></li>
                                <li>Lengkapi dengan materai <strong>Rp10.000</strong></li>
                                <li>1 rangkap ditandatangani Kepala Puskesmas, 1 rangkap Kepala/PJ Klinik</li>
                                <li>Kirim ke Puskesmas Tebet untuk proses tanda tangan Kepala Puskesmas</li>
                                <li>Estimasi penyelesaian: <strong>maksimal 4 hari kerja</strong></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-5">
                        <label class="fw-bolder text-gray-700 fs-6 mb-2">
                            <i class="fas fa-comment-alt me-2 text-muted"></i>
                            Keterangan <span class="text-muted fs-7">(opsional)</span>
                        </label>
                        <textarea id="ttd_keterangan" name="keterangan" rows="3"
                                  class="form-control form-control-solid"
                                  placeholder="Keterangan tambahan untuk fasyankes..."></textarea>
                    </div>

                    {{-- WhatsApp Notif --}}
                    <div class="separator separator-dashed mb-5"></div>
                    <div class="d-flex align-items-center justify-content-between p-4
                                bg-light-success rounded border border-dashed border-success">
                        <div class="d-flex align-items-center">
                            <i class="fab fa-whatsapp text-success fs-2 me-4"></i>
                            <div>
                                <div class="fw-bolder text-dark fs-6">Informasikan via WhatsApp</div>
                                <div class="text-muted fs-7">Kirim notifikasi langsung ke fasyankes</div>
                            </div>
                        </div>
                        <a id="ttd_wa_link" href="#" target="_blank"
                           class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp me-2"></i>Buka WA
                        </a>
                    </div>
                </div>

                <div class="modal-footer flex-center py-5">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label"><i class="fas fa-pen-fancy me-2"></i>Proses Tanda Tangan</span>
                        <span class="indicator-progress">Memproses... <span class="spinner-border spinner-border-sm ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>