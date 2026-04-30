{{-- Modal: Jenis Pengajuan --}}
<div class="modal fade" id="kt_modal_jenis_pengajuan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_jenis_pengajuan_header">
                <h2 class="fw-bolder">Formulir Pengajuan Kerja Sama</h2>
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
                {{-- Catatan --}}
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
                            <h4 class="text-gray-900 fw-bolder">Catatan!</h4>
                            <div class="fs-6 text-gray-700">
                                Jika Anda memiliki pertanyaan, silahkan periksa
                                <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_alur_pengajuan"
                                   onclick="$('#kt_modal_jenis_pengajuan').modal('hide')">
                                    Alur Pengajuan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Pilihan --}}
                <div class="fv-row">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="radio" class="btn-check" name="jenis_pengajuan"
                                   value="baru" checked id="kt_jenis_pengajuan_baru"/>
                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-10"
                                   for="kt_jenis_pengajuan_baru">
                                <span class="svg-icon svg-icon-3x me-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black"/>
                                        <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black"/>
                                    </svg>
                                </span>
                                <span class="d-block fw-bold text-start">
                                    <span class="text-dark fw-bolder d-block fs-4 mb-2">Baru</span>
                                    <span class="text-muted fw-bold fs-6">Jika ingin mengajukan permohonan kerja sama baru</span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <input type="radio" class="btn-check" name="jenis_pengajuan"
                                   value="perpanjangan" id="kt_jenis_pengajuan_perpanjangan"/>
                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center"
                                   for="kt_jenis_pengajuan_perpanjangan">
                                <span class="svg-icon svg-icon-3x me-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black"/>
                                        <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black"/>
                                    </svg>
                                </span>
                                <span class="d-block fw-bold text-start">
                                    <span class="text-dark fw-bolder d-block fs-4 mb-2">Perpanjangan</span>
                                    <span class="text-muted fw-bold fs-6">Jika ingin mengajukan permohonan perpanjangan kerja sama</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-center">
                <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="kt_modal_jenis_pengajuan_submit" class="btn btn-primary">
                    <span class="indicator-label">Lanjutkan</span>
                    <span class="indicator-progress">Mohon tunggu...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>