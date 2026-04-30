<?php

namespace Database\Seeders;

use App\Models\Pengajuan;
use App\Models\TrackingHistory;
use Illuminate\Database\Seeder;

class PengajuanSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            [
                'jenis_pengajuan'       => 'baru',
                'jenis_fasyankes'       => 'klinik_pratama',
                'nama_fasyankes'        => 'Klinik Sehat Mandiri',
                'nama_pemilik'          => 'Dr. Budi Santoso',
                'nama_penanggung_jawab' => 'Dr. Budi Santoso',
                'email'                 => 'klinik.sehat@mail.com',
                'nomor_hp'              => '08123456789',
                'alamat'                => 'Jl. Tebet Barat Dalam No. 12, Jakarta Selatan',
                'kelurahan'             => 'tebet_barat',
                'status'                => 'selesai',
                'histories'             => [
                    ['status' => 'proses_penjadwalan', 'keterangan' => 'Pengajuan diterima. Penjadwalan kunjungan sedang diproses.',                  'offset' => -10],
                    ['status' => 'kunjungan_selesai',  'keterangan' => 'Kunjungan selesai dilaksanakan. Fasyankes memenuhi semua persyaratan.',       'offset' => -7],
                    ['status' => 'proses_ttd',          'keterangan' => 'Draf PKS telah dikirimkan. Proses penandatanganan oleh Kepala Puskesmas.',    'offset' => -3],
                    ['status' => 'selesai',             'keterangan' => 'PKS telah selesai ditandatangani dan dapat diambil di Puskesmas Tebet.',      'offset' => 0],
                ],
            ],
            [
                'jenis_pengajuan'       => 'perpanjangan',
                'jenis_fasyankes'       => 'klinik_utama',
                'nama_fasyankes'        => 'RS Pratama Tebet',
                'nama_pemilik'          => 'Dr. Siti Rahayu, Sp.PD',
                'nama_penanggung_jawab' => 'Dr. Ahmad Fauzi',
                'email'                 => 'rs.pratama@mail.com',
                'nomor_hp'              => '08567891234',
                'alamat'                => 'Jl. Manggarai Selatan No. 45, Jakarta Selatan',
                'kelurahan'             => 'manggarai_selatan',
                'status'                => 'proses_ttd',
                'histories'             => [
                    ['status' => 'proses_penjadwalan', 'keterangan' => 'Pengajuan perpanjangan diterima.',                                            'offset' => -5],
                    ['status' => 'kunjungan_selesai',  'keterangan' => 'Kunjungan selesai. Beberapa dokumen perlu diperbarui, sudah ditindaklanjuti.', 'offset' => -2],
                    ['status' => 'proses_ttd',          'keterangan' => 'Dokumen PKS perpanjangan sedang dalam proses tanda tangan.',                  'offset' => 0],
                ],
            ],
            [
                'jenis_pengajuan'       => 'baru',
                'jenis_fasyankes'       => 'apotek',
                'nama_fasyankes'        => 'Apotek Keluarga Sehat',
                'nama_pemilik'          => 'Apt. Dewi Lestari',
                'nama_penanggung_jawab' => 'Apt. Dewi Lestari',
                'email'                 => 'apotek.keluarga@mail.com',
                'nomor_hp'              => '08211234567',
                'alamat'                => 'Jl. Kebon Baru No. 7, Jakarta Selatan',
                'kelurahan'             => 'kebon_baru',
                'status'                => 'kunjungan_selesai',
                'histories'             => [
                    ['status' => 'proses_penjadwalan', 'keterangan' => 'Pengajuan diterima. Kunjungan dijadwalkan pada 3 hari ke depan.', 'offset' => -3],
                    ['status' => 'kunjungan_selesai',  'keterangan' => 'Kunjungan telah selesai dilaksanakan. Menunggu konfirmasi draf PKS.', 'offset' => 0],
                ],
            ],
            [
                'jenis_pengajuan'       => 'baru',
                'jenis_fasyankes'       => 'laboratorium',
                'nama_fasyankes'        => 'Lab Diagnostik Tebet',
                'nama_pemilik'          => 'Dr. Hendro Kusuma',
                'nama_penanggung_jawab' => 'Dr. Hendro Kusuma',
                'email'                 => 'lab.diagnostik@mail.com',
                'nomor_hp'              => '08312345678',
                'alamat'                => 'Jl. Bukit Duri No. 23, Jakarta Selatan',
                'kelurahan'             => 'bukit_duri',
                'status'                => 'proses_penjadwalan',
                'histories'             => [
                    ['status' => 'proses_penjadwalan', 'keterangan' => 'Pengajuan diterima. Tim Puskesmas akan segera menghubungi untuk penjadwalan kunjungan.', 'offset' => 0],
                ],
            ],
        ];

        foreach ($samples as $sample) {
            $histories = $sample['histories'];
            unset($sample['histories']);

            $pengajuan = Pengajuan::create(array_merge($sample, [
                'nomor_tiket'      => Pengajuan::generateNomorTiket(),
                'tanggal_pengajuan' => now()->subDays(10),
            ]));

            foreach ($histories as $history) {
                TrackingHistory::create([
                    'pengajuan_id'   => $pengajuan->id,
                    'status'         => $history['status'],
                    'keterangan'     => $history['keterangan'],
                    'tanggal_status' => now()->addDays($history['offset']),
                ]);
            }
        }
    }
}