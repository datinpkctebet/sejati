{{-- Modal: Tandai Selesai (status: selesai) --}}
<div class="modal fade" id="modal_selesai" tabindex="-1" aria-hidden="true"
     data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">
            <div class="modal-header bg-light-success">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40px me-4">
                        <span class="symbol-label bg-success">
                            <i class="fas fa-trophy text-white fs-4"></i>
                        </span>
                    </div>
                    <div>
                        <h3 class="modal-title fw-bolder mb-0">Tandai PKS Selesai</h3>
                        <span class="text-muted fs-7">Status: Proses TTD → Selesai</span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times fs-4"></i>
                </button>
            </div>

            <form id="form_selesai">
                @csrf
                <div class="modal-body py-8 px-lg-12">

                    {{-- Info Fasyankes --}}
                    <div class="bg-light-success rounded p-5 mb-7">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clinic-medical text-success fs-3 me-4"></i>
                            <div>
                                <div class="fw-bolder text-dark fs-6" id="sl_nama_fasyankes">–</div>
                                <div class="text-muted fs-7">
                                    Tiket: <span id="sl_nomor_tiket" class="fw-bold text-primary">–</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Konfirmasi --}}
                    <div class="notice d-flex bg-light-success rounded border-success border border-dashed mb-7 p-5">
                        <i class="fas fa-check-circle fs-3 text-success me-4 mt-1"></i>
                        <div class="text-gray-700 fs-7">
                            Dengan menandai <strong>Selesai</strong>, PKS telah resmi ditandatangani dan siap diambil.
                            Status tracking fasyankes akan diperbarui menjadi <strong>Selesai</strong> secara otomatis.
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-5">
                        <label class="fw-bolder text-gray-700 fs-6 mb-2">
                            <i class="fas fa-comment-alt me-2 text-muted"></i>
                            Keterangan <span class="text-muted fs-7">(opsional)</span>
                        </label>
                        <textarea id="sl_keterangan" name="keterangan" rows="3"
                                  class="form-control form-control-solid"
                                  placeholder="Contoh: PKS dapat diambil di loket Puskesmas Tebet pada jam kerja..."></textarea>
                    </div>

                    {{-- WhatsApp Notif --}}
                    <div class="separator separator-dashed mb-5"></div>
                    <div class="d-flex align-items-center justify-content-between p-4
                                bg-light-success rounded border border-dashed border-success">
                        <div class="d-flex align-items-center">
                            <i class="fab fa-whatsapp text-success fs-2 me-4"></i>
                            <div>
                                <div class="fw-bolder text-dark fs-6">Beritahu Fasyankes via WhatsApp</div>
                                <div class="text-muted fs-7">Kirim notifikasi PKS siap diambil</div>
                            </div>
                        </div>
                        <a id="sl_wa_link" href="#" target="_blank"
                           class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp me-2"></i>Buka WA
                        </a>
                    </div>
                </div>

                <div class="modal-footer flex-center py-5">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="indicator-label"><i class="fas fa-check me-2"></i>Tandai Selesai</span>
                        <span class="indicator-progress">Memproses... <span class="spinner-border spinner-border-sm ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>