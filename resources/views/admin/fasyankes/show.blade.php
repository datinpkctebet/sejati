@extends('admin.layouts.app')
@section('title', 'Detail – ' . $pengajuan->nama_fasyankes)
@section('page_title', 'Detail Fasyankes')
@section('breadcrumb', 'Detail')

@section('content')
<div class="row g-6 g-xl-9">

    {{-- ── Kiri: Info Pengajuan ── --}}
    <div class="col-lg-4">

        {{-- Card identitas --}}
        <div class="card mb-6">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-70px symbol-circle">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-3">
                                {{ strtoupper(substr($pengajuan->nama_fasyankes, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="text-gray-800 fw-bolder fs-4 me-3">
                                        {{ $pengajuan->nama_fasyankes }}
                                    </span>
                                </div>
                                <div class="d-flex flex-wrap fw-semibold mb-4 fs-7 text-gray-400">
                                    <span class="badge badge-light-dark me-2">{{ $pengajuan->jenis_fasyankes_label }}</span>
                                    <span class="badge badge-light-secondary">{{ ucfirst($pengajuan->jenis_pengajuan) }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="badge badge-light-{{ $pengajuan->status_color }} fw-bolder fs-7 px-4 py-2">
                            {{ $pengajuan->status_label }}
                        </span>
                    </div>
                </div>
                <div class="separator mb-4"></div>
                {{-- Kontak --}}
                <div class="pb-5">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-user text-muted w-20px me-3 fs-6"></i>
                        <div>
                            <div class="text-muted fs-8">Pemilik</div>
                            <div class="fw-bold text-dark fs-7">{{ $pengajuan->nama_pemilik }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-user-md text-muted w-20px me-3 fs-6"></i>
                        <div>
                            <div class="text-muted fs-8">Penanggung Jawab</div>
                            <div class="fw-bold text-dark fs-7">{{ $pengajuan->nama_penanggung_jawab }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-envelope text-muted w-20px me-3 fs-6"></i>
                        <div>
                            <div class="text-muted fs-8">Email</div>
                            <div class="fw-bold text-dark fs-7">{{ $pengajuan->email }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-phone text-muted w-20px me-3 fs-6"></i>
                        <div>
                            <div class="text-muted fs-8">Nomor HP</div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="fw-bold text-dark fs-7">{{ $pengajuan->nomor_hp }}</span>
                                <a href="{{ $pengajuan->whatsapp_url }}" target="_blank"
                                   class="btn btn-xs btn-icon btn-light-success h-25px w-25px"
                                   title="Chat WhatsApp">
                                    <i class="fab fa-whatsapp fs-7"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-map-marker-alt text-muted w-20px me-3 fs-6 mt-1"></i>
                        <div>
                            <div class="text-muted fs-8">Alamat</div>
                            <div class="fw-bold text-dark fs-7">
                                {{ $pengajuan->alamat }}<br/>
                                <span class="badge badge-light-info mt-1">{{ $pengajuan->kelurahan_label }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-ticket-alt text-muted w-20px me-3 fs-6"></i>
                        <div>
                            <div class="text-muted fs-8">Nomor Tiket</div>
                            <div class="fw-bold text-primary fs-7">{{ $pengajuan->nomor_tiket }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock text-muted w-20px me-3 fs-6"></i>
                        <div>
                            <div class="text-muted fs-8">Tanggal Pengajuan</div>
                            <div class="fw-bold text-dark fs-7">
                                {{ $pengajuan->tanggal_pengajuan->format('d M Y, H:i') }} WIB
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Dokumen --}}
        <div class="card mb-6">
            <div class="card-header">
                <h3 class="card-title fw-bolder fs-6">
                    <i class="fas fa-folder-open text-warning me-2"></i>Dokumen Persyaratan
                </h3>
            </div>
            <div class="card-body py-4">
                @php
                $dokumens = [
                    'Profil & Denah Fasyankes' => $pengajuan->profil_denah_fasyankes_dokumen,
                    'STR Tenaga Kesehatan'     => $pengajuan->str_tenaga_kesehatan_dokumen,
                    'MOU Limbah'               => $pengajuan->mou_limbah_dokumen,
                    'SIP Tenaga Kesehatan'     => $pengajuan->sip_tenaga_kesehatan_dokumen,
                    'SIO'                      => $pengajuan->sio_dokumen,
                    'Sertifikat Kalibrasi'     => $pengajuan->sertifikat_kalibrasi_dokumen,
                ];
                @endphp
                @foreach($dokumens as $label => $path)
                @if($path)
                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-pdf text-danger me-3 fs-5"></i>
                        <span class="text-gray-700 fw-semibold fs-7">{{ $label }}</span>
                    </div>
                    <a href="{{ Storage::url($path) }}" target="_blank"
                       class="btn btn-xs btn-light-primary px-3 py-1 fs-8">
                        <i class="fas fa-download fs-8 me-1"></i>Unduh
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        </div>

    </div>

    {{-- ── Kanan: Tracking & Aksi ── --}}
    <div class="col-lg-8">

        {{-- Progress Bar --}}
        <div class="card mb-6">
            <div class="card-body py-6">
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bolder text-gray-800 fs-6">Progress Pengajuan</span>
                    <span class="fw-bold text-primary fs-6">
                        {{ $pengajuan->status_step }} / 4 Tahap
                    </span>
                </div>
                <div class="progress h-12px rounded mb-4">
                    <div class="progress-bar bg-{{ $pengajuan->status_color }} rounded h-12px"
                         style="width: {{ $pengajuan->status_step * 25 }}%"></div>
                </div>
                <div class="row g-0 text-center">
                    @php
                    $steps = [
                        ['label'=>'Penjadwalan','color'=>'warning'],
                        ['label'=>'Kunjungan', 'color'=>'info'],
                        ['label'=>'Tanda Tangan','color'=>'primary'],
                        ['label'=>'Selesai',   'color'=>'success'],
                    ];
                    @endphp
                    @foreach($steps as $i => $s)
                    <div class="col">
                        <div class="d-flex flex-column align-items-center">
                            <div class="w-30px h-30px rounded-circle d-flex align-items-center justify-content-center mb-2
                                {{ $pengajuan->status_step >= ($i+1) ? 'bg-'.$s['color'] : 'bg-light' }}">
                                @if($pengajuan->status_step >= ($i+1))
                                    <i class="fas fa-check text-white fs-8"></i>
                                @else
                                    <span class="text-muted fw-bold fs-8">{{ $i+1 }}</span>
                                @endif
                            </div>
                            <span class="text-{{ $pengajuan->status_step >= ($i+1) ? $s['color'] : 'muted' }} fw-bold fs-9">
                                {{ $s['label'] }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Aksi berdasarkan status --}}
        <div class="card mb-6">
            <div class="card-header">
                <h3 class="card-title fw-bolder fs-6">
                    <i class="fas fa-tasks text-primary me-2"></i>Aksi Update Status
                </h3>
            </div>
            <div class="card-body py-5">
                @if($pengajuan->status === 'proses_penjadwalan')
                <div class="d-flex align-items-center justify-content-between p-5 bg-light-warning rounded mb-4">
                    <div>
                        <div class="fw-bolder text-dark fs-6 mb-1">Jadwalkan Kunjungan</div>
                        <div class="text-muted fs-7">
                            @if($pengajuan->jadwal_kunjungan)
                                Dijadwalkan: <strong>{{ $pengajuan->jadwal_kunjungan->format('d M Y') }}</strong>
                            @else
                                Belum dijadwalkan. Atur tanggal kunjungan.
                            @endif
                        </div>
                    </div>
                    <button class="btn btn-warning btn-aksi text-white"
                            data-id="{{ $pengajuan->id }}" data-action="penjadwalan">
                        <i class="fas fa-calendar-plus me-2"></i>
                        {{ $pengajuan->jadwal_kunjungan ? 'Ubah Jadwal' : 'Set Jadwal' }}
                    </button>
                </div>
                @endif

                @if($pengajuan->status === 'kunjungan_selesai' && !$pengajuan->hasil_kunjungan)
                <div class="d-flex align-items-center justify-content-between p-5 bg-light-info rounded mb-4">
                    <div>
                        <div class="fw-bolder text-dark fs-6 mb-1">Input Hasil Kunjungan</div>
                        <div class="text-muted fs-7">Tentukan apakah fasyankes memenuhi syarat PKS.</div>
                    </div>
                    <button class="btn btn-info btn-aksi text-white"
                            data-id="{{ $pengajuan->id }}" data-action="kunjungan">
                        <i class="fas fa-clipboard-check me-2"></i>Input Hasil
                    </button>
                </div>
                @endif

                @if($pengajuan->status === 'kunjungan_selesai' && $pengajuan->hasil_kunjungan)
                <div class="p-5 bg-light-{{ $pengajuan->hasil_kunjungan_color }} rounded mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bolder text-dark fs-6 mb-1">Hasil Kunjungan</div>
                            <span class="badge badge-light-{{ $pengajuan->hasil_kunjungan_color }} fs-7">
                                {{ $pengajuan->hasil_kunjungan_label }}
                            </span>
                        </div>
                        @if($pengajuan->hasil_kunjungan === 'memenuhi_syarat')
                        <button class="btn btn-primary btn-aksi"
                                data-id="{{ $pengajuan->id }}" data-action="ttd">
                            <i class="fas fa-pen-fancy me-2"></i>Proses TTD
                        </button>
                        @endif
                    </div>
                    @if($pengajuan->keterangan_kunjungan)
                    <div class="text-gray-600 fs-7 mt-3 border-top pt-3">
                        {{ $pengajuan->keterangan_kunjungan }}
                    </div>
                    @endif
                </div>
                @endif

                @if($pengajuan->status === 'proses_ttd')
                <div class="p-5 bg-light-primary rounded mb-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <div class="fw-bolder text-dark fs-6 mb-1">PKS Dalam Proses Tanda Tangan</div>
                            <div class="text-muted fs-7">Kepala Puskesmas Tebet sedang menandatangani PKS.</div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ $pengajuan->whatsapp_url }}" target="_blank"
                               class="btn btn-success">
                                <i class="fab fa-whatsapp me-2"></i>Info WA
                            </a>
                            <button class="btn btn-success btn-aksi"
                                    data-id="{{ $pengajuan->id }}" data-action="selesai">
                                <i class="fas fa-check me-2"></i>Tandai Selesai
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                @if($pengajuan->status === 'selesai')
                <div class="d-flex align-items-center p-5 bg-light-success rounded">
                    <i class="fas fa-trophy text-success fs-2 me-5"></i>
                    <div>
                        <div class="fw-bolder text-success fs-5 mb-1">Pengajuan Selesai</div>
                        <div class="text-gray-600 fs-7">
                            PKS telah selesai pada {{ $pengajuan->tanggal_selesai?->format('d M Y, H:i') }} WIB.
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Timeline Tracking --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title fw-bolder fs-6">
                    <i class="fas fa-history text-info me-2"></i>Riwayat Tracking
                </h3>
            </div>
            <div class="card-body py-6">
                <div class="timeline timeline-border-dashed">
                    @foreach($pengajuan->trackingHistories as $history)
                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                            <div class="symbol-label bg-light-{{ $history->status_color }}">
                                <i class="fas fa-{{ $history->status_icon }} fs-7 text-{{ $history->status_color }}"></i>
                            </div>
                        </div>
                        <div class="timeline-content mb-8 mt-n1">
                            <div class="pe-3">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="fs-6 fw-bolder text-{{ $history->status_color }}">
                                        {{ $history->status_label }}
                                    </span>
                                    <span class="text-muted fs-8">
                                        {{ $history->tanggal_status->format('d M Y, H:i') }} WIB
                                    </span>
                                </div>
                                @if($history->keterangan)
                                <div class="text-gray-600 fs-7 mt-1">{{ $history->keterangan }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($pengajuan->trackingHistories->isEmpty())
                    <div class="text-center text-muted py-5 fs-7">Belum ada riwayat tracking.</div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Modals --}}
@include('admin.fasyankes.modals.modal-penjadwalan')
@include('admin.fasyankes.modals.modal-kunjungan')
@include('admin.fasyankes.modals.modal-ttd')
@include('admin.fasyankes.modals.modal-selesai')

@endsection

@push('scripts')
<script>
const ROUTES = {
    getData:     (id) => `/admin/fasyankes/${id}/data`,
    penjadwalan: (id) => `/admin/fasyankes/${id}/penjadwalan`,
    kunjungan:   (id) => `/admin/fasyankes/${id}/kunjungan`,
    ttd:         (id) => `/admin/fasyankes/${id}/ttd`,
    selesai:     (id) => `/admin/fasyankes/${id}/selesai`,
};
let currentId = null;

$(document).on('click', '.btn-aksi', function () {
    currentId = $(this).data('id');
    const action = $(this).data('action');
    $.get(ROUTES.getData(currentId), function (res) {
        const p = res.pengajuan;
        if (action === 'penjadwalan') {
            $('#pj_nama_fasyankes').text(p.nama_fasyankes);
            $('#pj_nomor_tiket').text(p.nomor_tiket);
            $('#pj_jadwal_kunjungan').val(p.jadwal_kunjungan ?? '');
            $('#pj_keterangan').val('');
            $('#modal_penjadwalan').modal('show');
        } else if (action === 'kunjungan') {
            $('#kj_nama_fasyankes').text(p.nama_fasyankes);
            $('#kj_nomor_tiket').text(p.nomor_tiket);
            $('#kj_jadwal').text(p.jadwal_kunjungan_fmt ?? '-');
            $('input[name="hasil_kunjungan"]').prop('checked', false);
            $('#kj_keterangan').val('');
            $('#modal_kunjungan').modal('show');
        } else if (action === 'ttd') {
            $('#ttd_nama_fasyankes').text(p.nama_fasyankes);
            $('#ttd_nomor_tiket').text(p.nomor_tiket);
            $('#ttd_hasil').text(p.hasil_kunjungan_label);
            $('#ttd_keterangan').val('');
            $('#ttd_wa_link').attr('href', p.whatsapp_url);
            $('#modal_ttd').modal('show');
        } else if (action === 'selesai') {
            $('#sl_nama_fasyankes').text(p.nama_fasyankes);
            $('#sl_nomor_tiket').text(p.nomor_tiket);
            $('#sl_keterangan').val('');
            $('#sl_wa_link').attr('href', p.whatsapp_url);
            $('#modal_selesai').modal('show');
        }
    });
});

function submitModal(modalId, url, data) {
    const $btn = $(`#${modalId} [type="submit"]`);
    $btn.attr('data-kt-indicator', 'on');
    $.ajax({
        url, type: 'PATCH', data,
        success(res) {
            $btn.removeAttr('data-kt-indicator');
            if (res.success) {
                $(`#${modalId}`).modal('hide');
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: res.message, timer: 2000, showConfirmButton: false })
                    .then(() => location.reload());
            } else { Swal.fire('Gagal', res.message, 'error'); }
        },
        error(xhr) {
            $btn.removeAttr('data-kt-indicator');
            const errors = xhr.responseJSON?.errors;
            Swal.fire({ title: errors ? 'Validasi Gagal' : 'Error',
                html: errors ? Object.values(errors).flat().join('<br>') : (xhr.responseJSON?.message || 'Terjadi kesalahan.'),
                icon: errors ? 'warning' : 'error' });
        }
    });
}

$('#form_penjadwalan').on('submit', function(e) {
    e.preventDefault();
    submitModal('modal_penjadwalan', ROUTES.penjadwalan(currentId),
        { jadwal_kunjungan: $('#pj_jadwal_kunjungan').val(), keterangan: $('#pj_keterangan').val() });
});
$('#form_kunjungan').on('submit', function(e) {
    e.preventDefault();
    submitModal('modal_kunjungan', ROUTES.kunjungan(currentId),
        { hasil_kunjungan: $('input[name="hasil_kunjungan"]:checked').val(), keterangan_kunjungan: $('#kj_keterangan').val() });
});
$('#form_ttd').on('submit', function(e) {
    e.preventDefault();
    submitModal('modal_ttd', ROUTES.ttd(currentId), { keterangan: $('#ttd_keterangan').val() });
});
$('#form_selesai').on('submit', function(e) {
    e.preventDefault();
    submitModal('modal_selesai', ROUTES.selesai(currentId), { keterangan: $('#sl_keterangan').val() });
});
</script>
@endpush