@extends('admin.layouts.app')
@section('title', 'Daftar Fasyankes')
@section('page_title', 'Daftar Fasyankes')
@section('breadcrumb', 'Daftar Fasyankes')

@section('content')

{{-- ── Stats Cards ───────────────────────────────────────────── --}}
<div class="row g-5 g-xl-8 mb-6">
    @php
    $cards = [
        ['label'=>'Total Pengajuan',     'value'=>$stats['total'],              'color'=>'primary',  'icon'=>'fa-layer-group'],
        ['label'=>'Proses Penjadwalan',  'value'=>$stats['proses_penjadwalan'], 'color'=>'warning',  'icon'=>'fa-calendar-alt'],
        ['label'=>'Kunjungan Selesai',   'value'=>$stats['kunjungan_selesai'],  'color'=>'info',     'icon'=>'fa-check-double'],
        ['label'=>'Proses Tanda Tangan', 'value'=>$stats['proses_ttd'],         'color'=>'primary',  'icon'=>'fa-pen-fancy'],
        ['label'=>'Selesai',             'value'=>$stats['selesai'],            'color'=>'success',  'icon'=>'fa-trophy'],
    ];
    @endphp
    @foreach($cards as $card)
    <div class="col-xl col-sm-6">
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-150px mb-5">
            <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                    <span class="fs-2hx fw-bolder text-{{ $card['color'] }} me-2 lh-1">
                        {{ $card['value'] }}
                    </span>
                    <span class="text-gray-400 pt-1 fw-semibold fs-7">{{ $card['label'] }}</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-end pt-0">
                <div class="d-flex align-items-center flex-column w-100">
                    <div class="d-flex justify-content-between fw-bold fs-7 text-gray-400 w-100 mt-auto mb-2">
                        <span class="badge badge-light-{{ $card['color'] }}">
                            <i class="fas {{ $card['icon'] }} fs-8 me-1 text-{{ $card['color'] }}"></i>
                            {{ $card['label'] }}
                        </span>
                    </div>
                    <div class="h-8px mx-3 w-100 bg-light-{{ $card['color'] }} rounded">
                        @if($stats['total'] > 0)
                        <div class="bg-{{ $card['color'] }} rounded h-8px"
                             style="width: {{ round($card['value']/$stats['total']*100) }}%"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- ── Filter & Table ────────────────────────────────────────── --}}
<div class="card">
    <div class="card-header border-0 pt-6">
        <!-- <span class="text-muted fw-bold fs-7 ">
            Total: <strong>{{ $pengajuans->total() }}</strong> data
        </span> -->
        <form method="GET" action="{{ route('admin.fasyankes.index') }}" class="card-toolbar flex-row-fluid justify-content-end gap-4" id="filter_form">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"/>
                            <path d="M11 19C6.55228 19 3 15.4477 3 11C3 6.55228 6.55228 3 11 3C15.4477 3 19 6.55228 19 11C19 15.4477 15.4477 19 11 19ZM11 17C14.3137 17 17 14.3137 17 11C17 7.68629 14.3137 5 11 5C7.68629 5 5 7.68629 5 11C5 14.3137 7.68629 17 11 17Z" fill="black"/>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control form-control-solid w-250px ps-14 me-1"
                            placeholder="Cari nama / nomor tiket..."/>
                    <select name="status" class="form-select form-select-solid w-200px" data-control="select2" data-placeholder="Semua Status">
                        <option value="">Semua Status</option>
                        <option value="proses_penjadwalan" {{ request('status')=='proses_penjadwalan' ? 'selected' : '' }}>Proses Penjadwalan</option>
                        <option value="kunjungan_selesai"  {{ request('status')=='kunjungan_selesai'  ? 'selected' : '' }}>Kunjungan Selesai</option>
                        <option value="proses_ttd"         {{ request('status')=='proses_ttd'         ? 'selected' : '' }}>Proses Tanda Tangan</option>
                        <option value="selesai"            {{ request('status')=='selesai'            ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <select name="jenis_fasyankes" class="form-select form-select-solid w-200px" data-control="select2" data-placeholder="Semua Jenis">
                        <option value="">Semua Jenis Fasyankes</option>
                        <option value="klinik_pratama"  {{ request('jenis_fasyankes')=='klinik_pratama'  ? 'selected' : '' }}>Klinik Pratama</option>
                        <option value="klinik_utama"    {{ request('jenis_fasyankes')=='klinik_utama'    ? 'selected' : '' }}>Klinik Utama</option>
                        <option value="praktek_mandiri" {{ request('jenis_fasyankes')=='praktek_mandiri' ? 'selected' : '' }}>Praktek Mandiri</option>
                        <option value="laboratorium"    {{ request('jenis_fasyankes')=='laboratorium'    ? 'selected' : '' }}>Laboratorium</option>
                        <option value="optik"           {{ request('jenis_fasyankes')=='optik'           ? 'selected' : '' }}>Optik</option>
                        <option value="apotek"          {{ request('jenis_fasyankes')=='apotek'          ? 'selected' : '' }}>Apotek</option>
                    </select>
                </div>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary px-6 me-2">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>
                @if(request()->hasAny(['search','status','jenis_fasyankes']))
                    <a href="{{ route('admin.fasyankes.index') }}" class="btn btn-light px-6">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-50px rounded-start">#</th>
                        <th class="min-w-160px">Nomor Tiket</th>
                        <th class="min-w-200px">Fasyankes</th>
                        <th class="min-w-140px">Jenis</th>
                        <th class="min-w-130px">Pengajuan</th>
                        <th class="min-w-160px">Status</th>
                        <th class="min-w-160px text-center rounded-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuans as $i => $p)
                    <tr>
                        <td class="ps-4">
                            <span class="text-muted fw-bold fs-7">
                                {{ ($pengajuans->currentPage()-1) * $pengajuans->perPage() + $i + 1 }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-light-primary fw-bolder fs-7">{{ $p->nomor_tiket }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40px symbol-circle me-3">
                                    <span class="symbol-label bg-light-info fw-bolder fs-6 text-info">
                                        {{ strtoupper(substr($p->nama_fasyankes, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-dark fw-bolder text-hover-primary fs-6">{{ $p->nama_fasyankes }}</span>
                                    <span class="text-muted fw-semibold fs-7">{{ $p->nama_penanggung_jawab }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-light-dark fw-bold fs-8">{{ $p->jenis_fasyankes_label }}</span>
                            <div class="text-muted fs-8 mt-1">{{ ucfirst($p->jenis_pengajuan) }}</div>
                        </td>
                        <td>
                            <span class="text-dark fw-bold fs-7">
                                {{ $p->tanggal_pengajuan->format('d/m/Y') }}
                            </span>
                            <div class="text-muted fs-8">{{ $p->tanggal_pengajuan->format('H:i') }}</div>
                        </td>
                        <td>
                            <span class="badge badge-light-{{ $p->status_color }} fw-bolder fs-8 px-3 py-2">
                                {{ $p->status_label }}
                            </span>
                            @if($p->jadwal_kunjungan && $p->status === 'proses_penjadwalan')
                            <div class="text-muted fs-8 mt-1">
                                <i class="fas fa-calendar-check text-success me-1"></i>
                                {{ $p->jadwal_kunjungan->format('d/m/Y') }}
                            </div>
                            @endif
                            @if($p->hasil_kunjungan && $p->status === 'kunjungan_selesai')
                            <div class="mt-1">
                                <span class="badge badge-light-{{ $p->hasil_kunjungan_color }} fs-9">
                                    {{ $p->hasil_kunjungan_label }}
                                </span>
                            </div>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                {{-- Tombol aksi berdasarkan status --}}
                                @if($p->status === 'proses_penjadwalan')
                                <button type="button"
                                        class="btn btn-sm btn-warning btn-aksi"
                                        data-id="{{ $p->id }}"
                                        data-action="penjadwalan"
                                        data-bs-toggle="tooltip"
                                        title="Jadwalkan Kunjungan">
                                    <i class="fas fa-calendar-plus fs-7"></i> Jadwalkan
                                </button>
                                <button type="button"
                                        class="btn btn-sm btn-info btn-aksi"
                                        data-id="{{ $p->id }}"
                                        data-action="langsungKunjungan"
                                        data-bs-toggle="tooltip"
                                        title="Input Hasil Kunjungan">
                                    <i class="fas fa-clipboard-check fs-7"></i> Lakukan Kunjungan
                                </button>
                                @endif

                                @if($p->status === 'kunjungan_selesai' && !$p->hasil_kunjungan)
                                <button type="button"
                                        class="btn btn-sm btn-info btn-aksi"
                                        data-id="{{ $p->id }}"
                                        data-action="kunjungan"
                                        data-bs-toggle="tooltip"
                                        title="Input Hasil Kunjungan">
                                    <i class="fas fa-clipboard-check fs-7"></i> Hasil
                                </button>
                                @endif

                                @if($p->status === 'kunjungan_selesai' && $p->hasil_kunjungan === 'memenuhi_syarat')
                                <button type="button"
                                        class="btn btn-sm btn-primary btn-aksi"
                                        data-id="{{ $p->id }}"
                                        data-action="ttd"
                                        data-bs-toggle="tooltip"
                                        title="Proses Tanda Tangan PKS">
                                    <i class="fas fa-pen-fancy fs-7"></i> Proses TTD
                                </button>
                                @endif

                                @if($p->status === 'proses_ttd')
                                <button type="button"
                                        class="btn btn-sm btn-success btn-aksi"
                                        data-id="{{ $p->id }}"
                                        data-action="selesai"
                                        data-bs-toggle="tooltip"
                                        title="Tandai Selesai">
                                    <i class="fas fa-check fs-7"></i> Selesai
                                </button>
                                <a href="{{ $p->whatsapp_url }}" target="_blank"
                                   class="btn btn-sm btn-light-success"
                                   data-bs-toggle="tooltip" title="Info via WhatsApp">
                                    <i class="fab fa-whatsapp fs-5"></i>
                                </a>
                                @endif

                                {{-- Detail selalu ada --}}
                                <a href="{{ route('admin.fasyankes.show', $p) }}"
                                   class="btn btn-sm btn-light-dark"
                                   data-bs-toggle="tooltip" title="Lihat Detail">
                                    <i class="fas fa-eye fs-7"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-15">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fas fa-inbox fs-3x text-muted mb-4"></i>
                                <span class="text-muted fw-bold fs-6">Tidak ada data pengajuan ditemukan.</span>
                                @if(request()->hasAny(['search','status','jenis_fasyankes']))
                                <a href="{{ route('admin.fasyankes.index') }}" class="btn btn-sm btn-light mt-4">Reset Filter</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
            <div class="text-muted fw-semibold fs-7">
                Menampilkan {{ $pengajuans->firstItem() }}–{{ $pengajuans->lastItem() }}
                dari {{ $pengajuans->total() }} data
            </div>
            {{ $pengajuans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- ── Modals Update Status ── --}}
@include('admin.fasyankes.modals.modal-penjadwalan')
@include('admin.fasyankes.modals.modal-kunjungan')
@include('admin.fasyankes.modals.modal-ttd')
@include('admin.fasyankes.modals.modal-selesai')

@endsection

@push('scripts')
<script>
const ROUTES = {
    getData:       (id) => `/admin/fasyankes/${id}/data`,
    penjadwalan:   (id) => `/admin/fasyankes/${id}/penjadwalan`,
    langsungKunjungan: (id) => `/admin/fasyankes/${id}/langsungKunjungan`,
    kunjungan:     (id) => `/admin/fasyankes/${id}/kunjungan`,
    ttd:           (id) => `/admin/fasyankes/${id}/ttd`,
    selesai:       (id) => `/admin/fasyankes/${id}/selesai`,
};

let currentId = null;

// Open appropriate modal on btn click
$(document).on('click', '.btn-aksi', function () {
    currentId = $(this).data('id');
    const action = $(this).data('action');

    // Fetch data lalu buka modal
    $.get(ROUTES.getData(currentId), function (res) {
        const p = res.pengajuan;

        if (action === 'penjadwalan') {
            $('#pj_nama_fasyankes').text(p.nama_fasyankes);
            $('#pj_nomor_tiket').text(p.nomor_tiket);
            $('#pj_jadwal_kunjungan').val('');
            $('#pj_keterangan').val('');
            $('#modal_penjadwalan').modal('show');

        } else if (action === 'langsungKunjungan') {
            $.ajax({
                url: ROUTES.langsungKunjungan(currentId),
                type: 'PATCH',
                data: { hasil_kunjungan: null },
                success(res) {
                    if (res.success) {
                        Swal.fire({ icon: 'success', title: 'Berhasil!', text: res.message, timer: 2000, showConfirmButton: false })
                            .then(() => location.reload());
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                },
                error(xhr) {
                    Swal.fire('Error', xhr.responseJSON?.message || 'Terjadi kesalahan.', 'error');
                }
            });
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

// Generic AJAX submit for modals
function submitModal(modalId, url, data, successCb) {
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
            } else {
                Swal.fire('Gagal', res.message, 'error');
            }
        },
        error(xhr) {
            $btn.removeAttr('data-kt-indicator');
            const errors = xhr.responseJSON?.errors;
            if (errors) {
                Swal.fire({ title: 'Validasi Gagal', html: Object.values(errors).flat().join('<br>'), icon: 'warning' });
            } else {
                Swal.fire('Error', xhr.responseJSON?.message || 'Terjadi kesalahan.', 'error');
            }
        }
    });
}

// PENJADWALAN submit
$('#form_penjadwalan').on('submit', function (e) {
    e.preventDefault();
    submitModal('modal_penjadwalan', ROUTES.penjadwalan(currentId), {
        jadwal_kunjungan: $('#pj_jadwal_kunjungan').val(),
        keterangan:       $('#pj_keterangan').val(),
    });
});

// KUNJUNGAN submit
$('#form_kunjungan').on('submit', function (e) {
    e.preventDefault();
    submitModal('modal_kunjungan', ROUTES.kunjungan(currentId), {
        hasil_kunjungan:      $('input[name="hasil_kunjungan"]:checked').val(),
        keterangan_kunjungan: $('#kj_keterangan').val(),
    });
});

// TTD submit
$('#form_ttd').on('submit', function (e) {
    e.preventDefault();
    submitModal('modal_ttd', ROUTES.ttd(currentId), {
        keterangan: $('#ttd_keterangan').val(),
    });
});

// SELESAI submit
$('#form_selesai').on('submit', function (e) {
    e.preventDefault();
    submitModal('modal_selesai', ROUTES.selesai(currentId), {
        keterangan: $('#sl_keterangan').val(),
    });
});
</script>
@endpush