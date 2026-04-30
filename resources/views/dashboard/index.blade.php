@extends('layouts.app')

@section('content')
<div class="row gy-5 g-xl-5">

    {{-- ===== TOTAL FASYANKES ===== --}}
    <div class="col-xxl-12">
        <div class="card card-xxl-stretch">
            <!-- <div class="card-header border-0 bg-danger py-5">
                <h3 class="card-title fw-bolder text-white">Total Fasyankes</h3>
            </div> -->
            <div class="card-body p-0">
                <!-- <div class="mixed-widget-2-chart card-rounded-bottom bg-danger"
                     data-kt-color="danger" style="height: 200px"></div> -->
                     <img src="{{ asset('assets/media/logos/logosejati3.png') }}" alt="Logo" class="card-rounded-bottom img-fluid" style="height: auto; max-height: 280px; width: 100%;"/>
                <div class="card-p mt-n20 position-relative">
                    <div class="row g-0">

                        {{-- Klinik Pratama --}}
                        <div class="col bg-light-success px-6 py-8 rounded-2 me-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
                                    <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"/>
                                    <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
                                    <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
                                </svg>
                            </span>
                            <a href="#" class="text-success fw-bold fs-6">Klinik Pratama</a>
                            <div class="fs-2 fw-bolder"
                                 data-kt-countup="true"
                                 data-kt-countup-value="{{ $stats['klinik_pratama'] }}">0</div>
                        </div>

                        {{-- Klinik Utama --}}
                        <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black"/>
                                    <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black"/>
                                </svg>
                            </span>
                            <a href="#" class="text-primary fw-bold fs-6">Klinik Utama</a>
                            <div class="fs-2 fw-bolder"
                                 data-kt-countup="true"
                                 data-kt-countup-value="{{ $stats['klinik_utama'] }}">0</div>
                        </div>

                        {{-- Praktek Mandiri --}}
                        <div class="col bg-light-info px-6 py-8 rounded-2 me-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
                                    <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"/>
                                    <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
                                    <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
                                </svg>
                            </span>
                            <a href="#" class="text-info fw-bold fs-6">Praktek Mandiri</a>
                            <div class="fs-2 fw-bolder"
                                 data-kt-countup="true"
                                 data-kt-countup-value="{{ $stats['praktek_mandiri'] }}">0</div>
                        </div>

                        {{-- Laboratorium --}}
                        <div class="col bg-light-success px-6 py-8 rounded-2 me-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
                                    <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"/>
                                    <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
                                    <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
                                </svg>
                            </span>
                            <a href="#" class="text-success fw-bold fs-6">Laboratorium</a>
                            <div class="fs-2 fw-bolder"
                                 data-kt-countup="true"
                                 data-kt-countup-value="{{ $stats['laboratorium'] }}">0</div>
                        </div>

                        {{-- Optik --}}
                        <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black"/>
                                    <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black"/>
                                </svg>
                            </span>
                            <a href="#" class="text-primary fw-bold fs-6">Optik</a>
                            <div class="fs-2 fw-bolder"
                                 data-kt-countup="true"
                                 data-kt-countup-value="{{ $stats['optik'] }}">0</div>
                        </div>

                        {{-- Apotik --}}
                        <div class="col bg-light-info px-6 py-8 rounded-2 me-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
                                    <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"/>
                                    <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
                                    <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
                                </svg>
                            </span>
                            <a href="#" class="text-info fw-bold fs-6">Apotik</a>
                            <div class="fs-2 fw-bolder"
                                 data-kt-countup="true"
                                 data-kt-countup-value="{{ $stats['apotek'] }}">0</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== PENGAJUAN KERJA SAMA ===== --}}
    <div class="col-xxl-12">
        <div class="card card-xl-stretch mb-xl-8">
            <div class="card-body d-flex align-items-center pt-3 pb-0">
                <div class="d-flex flex-column flex-grow-1 py-2 py-lg-13 me-2">
                    <a href="#" class="fw-bolder text-dark fs-4 mb-2 text-hover-primary">Pengajuan Kerja Sama</a>
                    <span class="fw-bold text-muted fs-5">
                        Ajukan permohonan kerja sama atau perpanjangan antara fasyankes Anda dengan Puskesmas Tebet.
                        Klik tombol di bawah untuk memulai proses pengajuan dan dapatkan nomor tiket untuk memantau status pengajuan Anda.
                    </span>
                    <div class="d-flex align-items-center mt-5">
                        <a href="#"
                           data-bs-toggle="modal"
                           data-bs-target="#kt_modal_jenis_pengajuan"
                           class="btn btn-primary fw-bolder fs-8 fs-lg-base">
                            Klik Disini
                        </a>
                    </div>
                </div>
                <img src="{{ asset('assets/media/svg/avatars/pengajuan.png') }}"
                     alt="" class="h-200px" />
            </div>
        </div>
    </div>

    {{-- ===== TRACKING TICKET ===== --}}
    <div class="col-xxl-12">
        <div class="card card-xl-stretch mb-xl-8">
            <div class="card-body d-flex align-items-center pt-3 pb-0">
                <div class="d-flex flex-column flex-grow-1 py-2 py-lg-13 me-2">
                    <a href="#" class="fw-bolder text-dark fs-4 mb-2 text-hover-primary">Tracking Ticket</a>
                    <span class="fw-bold text-muted fs-6 mb-4">
                        Masukkan nomor tiket yang Anda terima setelah mengajukan permohonan kerja sama untuk memantau statusnya.
                    </span>
                    <div class="d-flex align-items-center">
                        <div class="position-relative w-md-500px me-md-2">
                            <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.5" d="M10 3L8 21M16 3L14 21" stroke="black" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M3 10H21M3 16H21" stroke="black" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </span>
                            <input type="text"
                                   id="tracking_input"
                                   class="form-control form-control-solid ps-10"
                                   placeholder="Contoh: TBT2026001"
                                   maxlength="20" />
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="button" id="btn_tracking" class="btn btn-primary me-5">
                                <span class="indicator-label">
                                    <i class="fas fa-search me-2"></i>Cari
                                </span>
                                <span class="indicator-progress">
                                    Mencari... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div id="tracking_error" class="text-danger fs-7 mt-2 d-none"></div>
                </div>
                <img src="{{ asset('assets/media/svg/avatars/ticket.png') }}"
                     alt="" class="h-150px" />
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
// ─── CSRF setup ───────────────────────────────────────────
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

// ─── Jenis Pengajuan → next modal ────────────────────────
$('#kt_modal_jenis_pengajuan_submit').on('click', function (e) {
    e.preventDefault();
    const jenis = $('input[name="jenis_pengajuan"]:checked').val();
    $('#kt_modal_jenis_pengajuan').modal('hide');
    if (jenis === 'baru') {
        $('#kt_modal_form_pengajuan_baru').modal('show');
    } else {
        $('#kt_modal_form_pengajuan_perpanjangan').modal('show');
    }
});

// ─── Submit Pengajuan BARU ────────────────────────────────
$('#kt_modal_form_pengajuan_baru_form').on('submit', function (e) {
    e.preventDefault();
    submitPengajuan($(this), 'baru');
});

// ─── Submit Pengajuan PERPANJANGAN ───────────────────────
$('#kt_modal_form_pengajuan_perpanjangan_form').on('submit', function (e) {
    e.preventDefault();
    submitPengajuan($(this), 'perpanjangan');
});

function submitPengajuan($form, jenis) {
    const $btn     = $form.find('[type="submit"]');
    const formData = new FormData($form[0]);
    formData.append('jenis_pengajuan', jenis);

    $btn.attr('data-kt-indicator', 'on');

    $.ajax({
        url: '{{ route("pengajuan.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success(res) {
            $btn.removeAttr('data-kt-indicator');
            if (res.success) {
                // Tutup modal form
                $('#kt_modal_form_pengajuan_baru, #kt_modal_form_pengajuan_perpanjangan').modal('hide');
                // Tampilkan nomor tiket
                $('#sukses_nomor_tiket').text(res.nomor_tiket);
                $('#kt_modal_sukses_tiket').modal('show');
                // Reset form
                $form[0].reset();
            } else {
                Swal.fire('Gagal', res.message, 'error');
            }
        },
        error(xhr) {
            $btn.removeAttr('data-kt-indicator');
            const errors = xhr.responseJSON?.errors;
            if (errors) {
                const msg = Object.values(errors).flat().join('<br>');
                Swal.fire({ title: 'Validasi Gagal', html: msg, icon: 'warning' });
            } else {
                Swal.fire('Error', xhr.responseJSON?.message || 'Terjadi kesalahan.', 'error');
            }
        }
    });
}

// ─── TRACKING ─────────────────────────────────────────────
$('#btn_tracking').on('click', function () {
    const nomorTiket = $('#tracking_input').val().trim();
    const $err       = $('#tracking_error');
    $err.addClass('d-none').text('');

    if (!nomorTiket) {
        $err.text('Masukkan nomor tiket terlebih dahulu.').removeClass('d-none');
        return;
    }

    const $btn = $(this);
    $btn.attr('data-kt-indicator', 'on');

    $.ajax({
        url: '{{ route("pengajuan.tracking") }}',
        type: 'POST',
        data: { nomor_tiket: nomorTiket },
        success(res) {
            $btn.removeAttr('data-kt-indicator');
            if (res.success) {
                renderTracking(res);
                $('#kt_modal_tracking_result').modal('show');
            } else {
                $err.text(res.message).removeClass('d-none');
            }
        },
        error(xhr) {
            $btn.removeAttr('data-kt-indicator');
            $err.text(xhr.responseJSON?.message || 'Nomor tiket tidak ditemukan.').removeClass('d-none');
        }
    });
});

// Juga bisa trigger dengan Enter
$('#tracking_input').on('keypress', function (e) {
    if (e.which === 13) $('#btn_tracking').trigger('click');
});

function renderTracking(res) {
    const p = res.pengajuan;
    // Info header
    $('#tr_nomor_tiket').text(p.nomor_tiket);
    $('#tr_nama_fasyankes').text(p.nama_fasyankes);
    $('#tr_jenis_fasyankes').text(p.jenis_fasyankes);
    $('#tr_jenis_pengajuan').text(p.jenis_pengajuan);
    $('#tr_tanggal_pengajuan').text(p.tanggal_pengajuan);
    $('#tr_status_label').text(p.status_label);
    $('#tr_status_badge')
        .removeClass()
        .addClass(`badge badge-light-${p.status_color} fs-7 fw-bolder`)
        .text(p.status_label);

    // Steps
    const $steps = $('#tr_steps');
    $steps.empty();
    res.steps.forEach(step => {
        const iconClass = step.is_done
            ? `fa-check-circle text-success`
            : `fa-circle text-muted`;
        const cardClass = step.is_current
            ? 'border-primary shadow-sm'
            : (step.is_done ? 'border-success' : 'border-light');

        $steps.append(`
            <div class="d-flex align-items-start mb-6">
                <div class="me-4 mt-1">
                    <i class="fas ${iconClass} fs-2"></i>
                </div>
                <div class="card flex-grow-1 border ${cardClass}">
                    <div class="card-body py-3 px-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bolder fs-6 ${step.is_current ? 'text-primary' : (step.is_done ? 'text-success' : 'text-muted')}">
                                ${step.step}. ${step.label}
                            </span>
                            ${step.tanggal ? `<span class="text-muted fs-8">${step.tanggal}</span>` : ''}
                        </div>
                        ${step.keterangan ? `<div class="text-gray-600 fs-7 mt-1">${step.keterangan}</div>` : ''}
                        ${!step.is_done && !step.is_current ? `<div class="text-muted fs-7 mt-1 fst-italic">${step.desc}</div>` : ''}
                    </div>
                </div>
            </div>
        `);
    });
}
</script>
@endpush