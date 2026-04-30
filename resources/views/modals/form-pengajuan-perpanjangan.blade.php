{{-- Modal: Form Pengajuan PERPANJANGAN --}}
<div class="modal fade" id="kt_modal_form_pengajuan_perpanjangan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_form_pengajuan_perpanjangan_header">
                <h2 class="fw-bolder">Formulir Pengajuan Perpanjangan Kerja Sama</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"/>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"/>
                        </svg>
                    </span>
                </div>
            </div>

            <form id="kt_modal_form_pengajuan_perpanjangan_form" class="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-10 px-lg-17">
                    <div class="scroll-y me-n7 pe-7"
                         id="kt_modal_form_pengajuan_perpanjangan_scroll"
                         data-kt-scroll="true"
                         data-kt-scroll-activate="{default: false, lg: true}"
                         data-kt-scroll-max-height="auto"
                         data-kt-scroll-dependencies="#kt_modal_form_pengajuan_perpanjangan_header"
                         data-kt-scroll-wrappers="#kt_modal_form_pengajuan_perpanjangan_scroll"
                         data-kt-scroll-offset="300px">

                        {{-- Notifikasi dokumen --}}
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-10 p-6">
                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"/>
                                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
                                </svg>
                            </span>
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-bold">
                                    <h4 class="text-gray-900 fw-bolder">Dokumen Persyaratan Perpanjangan</h4>
                                    <div class="fs-6 text-gray-700">
                                        Siapkan dokumen berikut dalam format <strong>PDF (maks. 2MB)</strong> per file:
                                        Profil &amp; Denah, STR, SIP Tenaga Kesehatan, MOU Limbah, SIO, dan Sertifikat Kalibrasi Terbaru.
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Shared fields --}}
                        @include('modals._form-fields', ['modalId' => 'kt_modal_form_pengajuan_perpanjangan'])

                        {{-- Dokumen Perpanjangan --}}
                        <div class="separator separator-dashed my-5"></div>
                        <h4 class="fw-bolder text-gray-800 mb-6">Upload Dokumen Persyaratan</h4>

                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">
                                    Profil &amp; Denah Fasyankes
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                       title="Dokumen profil lengkap dan denah/layout fasyankes"></i>
                                </label>
                                <input type="file" name="profil_denah_fasyankes_dokumen"
                                       class="form-control form-control-solid" accept=".pdf" required/>
                                <div class="form-text text-muted">Format: PDF · Maks. 2MB</div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">
                                    STR Tenaga Kesehatan
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                       title="Surat Tanda Registrasi tenaga kesehatan yang masih berlaku"></i>
                                </label>
                                <input type="file" name="str_tenaga_kesehatan_dokumen"
                                       class="form-control form-control-solid" accept=".pdf" required/>
                                <div class="form-text text-muted">Format: PDF · Maks. 2MB</div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">
                                    SIP Tenaga Kesehatan
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                       title="Surat Izin Praktik tenaga kesehatan yang masih berlaku"></i>
                                </label>
                                <input type="file" name="sip_tenaga_kesehatan_dokumen"
                                       class="form-control form-control-solid" accept=".pdf" required/>
                                <div class="form-text text-muted">Format: PDF · Maks. 2MB</div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">
                                    MOU Limbah
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                       title="Dokumen perjanjian pengelolaan limbah medis"></i>
                                </label>
                                <input type="file" name="mou_limbah_dokumen"
                                       class="form-control form-control-solid" accept=".pdf" required/>
                                <div class="form-text text-muted">Format: PDF · Maks. 2MB</div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">
                                    SIO (Surat Izin Operasional)
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                       title="Surat Izin Operasional fasyankes yang masih berlaku"></i>
                                </label>
                                <input type="file" name="sio_dokumen"
                                       class="form-control form-control-solid" accept=".pdf" required/>
                                <div class="form-text text-muted">Format: PDF · Maks. 2MB</div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">
                                    Sertifikat Kalibrasi Terbaru
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                       title="Sertifikat kalibrasi alat kesehatan terbaru"></i>
                                </label>
                                <input type="file" name="sertifikat_kalibrasi_dokumen"
                                       class="form-control form-control-solid" accept=".pdf" required/>
                                <div class="form-text text-muted">Format: PDF · Maks. 2MB</div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="btn_submit_perpanjangan" class="btn btn-primary">
                        <span class="indicator-label">
                            <i class="fas fa-paper-plane me-2"></i>Ajukan
                        </span>
                        <span class="indicator-progress">
                            Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>