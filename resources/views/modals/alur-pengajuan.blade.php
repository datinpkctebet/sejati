{{-- Modal: Alur Pengajuan --}}
<div class="modal fade" id="kt_modal_alur_pengajuan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_alur_pengajuan_header">
                <h2 class="fw-bolder">Alur Pengajuan Kerja Sama</h2>
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
                <div class="scroll-y me-n7 pe-7"
                     data-kt-scroll="true"
                     data-kt-scroll-activate="{default: false, lg: true}"
                     data-kt-scroll-max-height="auto"
                     data-kt-scroll-dependencies="#kt_modal_alur_pengajuan_header"
                     data-kt-scroll-wrappers="#kt_modal_alur_pengajuan_scroll"
                     data-kt-scroll-offset="300px">

                    {{-- Step-by-step visual timeline --}}
                    <div class="timeline timeline-border-dashed">

                        @php
                        $steps = [
                            ['icon'=>'fas fa-book-open','color'=>'primary','title'=>'Baca Informasi PKS','desc'=>'Fasyankes membaca dan memahami informasi terkait Perjanjian Kerja Sama (PKS) dengan Puskesmas Tebet.'],
                            ['icon'=>'fas fa-mouse-pointer','color'=>'success','title'=>'Klik Tombol Pengajuan','desc'=>'Fasyankes mengklik tombol <strong>"Pengajuan Kerja Sama"</strong> yang tersedia pada halaman beranda.'],
                            ['icon'=>'fas fa-list-ul','color'=>'warning','title'=>'Pilih Jenis Pengajuan','desc'=>'Fasyankes memilih jenis pengajuan: <strong>Baru</strong> (kerja sama pertama kali) atau <strong>Perpanjangan</strong> (memperpanjang PKS yang sudah ada).'],
                            ['icon'=>'fas fa-file-alt','color'=>'info','title'=>'Isi Formulir & Upload Dokumen','desc'=>'Fasyankes mengisi formulir data diri, data fasyankes, dan mengupload dokumen persyaratan sesuai jenis pengajuan.'],
                            ['icon'=>'fas fa-paper-plane','color'=>'primary','title'=>'Klik Ajukan','desc'=>'Setelah semua data terisi lengkap, klik tombol <strong>"Ajukan"</strong> untuk mengirim permohonan.'],
                            ['icon'=>'fas fa-ticket-alt','color'=>'success','title'=>'Terima Nomor Tiket','desc'=>'Sistem akan menghasilkan <strong>Nomor Tiket</strong> unik sebagai tanda bukti pengajuan Anda. Simpan nomor ini baik-baik.'],
                            ['icon'=>'fas fa-search','color'=>'warning','title'=>'Tracking Status Pengajuan','desc'=>'Gunakan Nomor Tiket di bagian <strong>"Tracking Ticket"</strong> pada halaman beranda untuk memantau proses pengajuan secara real-time.'],
                            ['icon'=>'fas fa-bell','color'=>'danger','title'=>'Pantau 4 Tahap Status','desc'=>'Tracking System memiliki 4 status:<ul class="mt-2 mb-0"><li><strong>Proses Penjadwalan Kunjungan</strong> – Puskesmas akan menjadwalkan kunjungan dalam maks. 2 hari kerja.</li><li><strong>Kunjungan Selesai</strong> – Hasil kunjungan dan rekomendasi tersedia. Jika memenuhi syarat, link draf PKS akan muncul. Jika belum memenuhi syarat, Fasyankes diminta menindaklanjuti temuan.</li><li><strong>Proses Tanda Tangan</strong> – PKS sedang ditandatangani Kepala Puskesmas Tebet (maks. 4 hari kerja).</li><li><strong>Selesai</strong> – PKS dapat diambil di Puskesmas Tebet.</li></ul>'],
                            ['icon'=>'fas fa-clipboard-check','color'=>'info','title'=>'Laporkan Nomor Registrasi','desc'=>'Khusus pengajuan <strong>baru</strong>: setelah selesai, harap melaporkan Nomor Registrasi Fasyankes pada akhir Tracking System.'],
                        ];
                        @endphp

                        @foreach($steps as $i => $step)
                        <div class="timeline-item">
                            <div class="timeline-line w-40px"></div>
                            <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                <div class="symbol-label bg-light-{{ $step['color'] }}">
                                    <i class="{{ $step['icon'] }} fs-6 text-{{ $step['color'] }}"></i>
                                </div>
                            </div>
                            <div class="timeline-content mb-10 mt-n1">
                                <div class="pe-3 mb-2">
                                    <div class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-1">
                                        {{ $i + 1 }}. {{ $step['title'] }}
                                    </div>
                                    <div class="d-flex align-items-center mt-1 fs-6 text-gray-700">
                                        {!! $step['desc'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="modal-footer flex-center">
                <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary"
                        data-bs-dismiss="modal"
                        onclick="$('#kt_modal_jenis_pengajuan').modal('show')">
                    <i class="fas fa-arrow-right me-2"></i>Mulai Pengajuan
                </button>
            </div>
        </div>
    </div>
</div>