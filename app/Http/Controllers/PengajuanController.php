<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanRequest;
use App\Models\Pengajuan;
use App\Models\TrackingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Store a new pengajuan and return the ticket number.
     */
    public function store(StorePengajuanRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Upload dokumen
            $dokumenFields = [
                'profil_denah_fasyankes_dokumen',
                'str_tenaga_kesehatan_dokumen',
                'mou_limbah_dokumen',
                'sip_tenaga_kesehatan_dokumen',
                'sio_dokumen',
                'sertifikat_kalibrasi_dokumen',
            ];

            foreach ($dokumenFields as $field) {
                if ($request->hasFile($field)) {
                    $data[$field] = $request->file($field)
                        ->store("dokumen/{$field}", 'public');
                }
            }

            // Generate nomor tiket
            $data['nomor_tiket'] = Pengajuan::generateNomorTiket();
            $data['status']      = 'proses_penjadwalan';

            $pengajuan = Pengajuan::create($data);

            // Catat history awal
            TrackingHistory::create([
                'pengajuan_id'   => $pengajuan->id,
                'status'         => 'proses_penjadwalan',
                'keterangan'     => 'Pengajuan kerja sama berhasil diterima. Puskesmas akan menjadwalkan kunjungan dalam maksimal 2 hari kerja.',
                'tanggal_status' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success'      => true,
                'nomor_tiket'  => $pengajuan->nomor_tiket,
                'message'      => 'Pengajuan berhasil diajukan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Search ticket and return tracking info.
     */
    public function tracking(Request $request)
    {
        $request->validate([
            'nomor_tiket' => 'required|string',
        ]);

        $pengajuan = Pengajuan::with('trackingHistories')
            ->where('nomor_tiket', $request->nomor_tiket)
            ->first();

        if (!$pengajuan) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor tiket tidak ditemukan.',
            ], 404);
        }

        $steps = [
            ['key' => 'proses_penjadwalan', 'label' => 'Proses Penjadwalan Kunjungan',       'desc' => 'Puskesmas menjadwalkan kunjungan (maks. 2 hari kerja)'],
            ['key' => 'kunjungan_selesai',  'label' => 'Kunjungan Selesai',                  'desc' => 'Hasil kunjungan & rekomendasi tersedia'],
            ['key' => 'proses_ttd',         'label' => 'Proses Tanda Tangan Kepala Puskesmas','desc' => 'Penandatanganan PKS (maks. 4 hari kerja)'],
            ['key' => 'selesai',            'label' => 'Selesai',                            'desc' => 'PKS dapat diambil di Puskesmas Tebet'],
        ];

        $currentStep = $pengajuan->status_step;

        $stepsWithStatus = array_map(function ($step, $index) use ($currentStep, $pengajuan) {
            $stepNumber = $index + 1;
            $history    = $pengajuan->trackingHistories
                ->where('status', $step['key'])
                ->first();

            return array_merge($step, [
                'step'       => $stepNumber,
                'is_done'    => $stepNumber <= $currentStep,
                'is_current' => $stepNumber === $currentStep,
                'tanggal'    => $history?->tanggal_status?->format('d M Y H:i'),
                'keterangan' => $history?->keterangan,
            ]);
        }, $steps, array_keys($steps));

        return response()->json([
            'success'   => true,
            'pengajuan' => [
                'nomor_tiket'            => $pengajuan->nomor_tiket,
                'jenis_pengajuan'        => ucfirst($pengajuan->jenis_pengajuan),
                'jenis_fasyankes'        => $pengajuan->jenis_fasyankes_label,
                'nama_fasyankes'         => $pengajuan->nama_fasyankes,
                'nama_penanggung_jawab'  => $pengajuan->nama_penanggung_jawab,
                'tanggal_pengajuan'      => $pengajuan->tanggal_pengajuan->format('d M Y H:i'),
                'status'                 => $pengajuan->status,
                'status_label'           => $pengajuan->status_label,
                'status_color'           => $pengajuan->status_color,
                'status_step'            => $pengajuan->status_step,
            ],
            'steps' => $stepsWithStatus,
        ]);
    }

    /**
     * Admin: update status pengajuan.
     */
    public function updateStatus(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'status'     => 'required|in:proses_penjadwalan,kunjungan_selesai,proses_ttd,selesai',
            'keterangan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $statusField = match ($request->status) {
                'kunjungan_selesai' => 'tanggal_kunjungan',
                'proses_ttd'        => 'tanggal_ttd',
                'selesai'           => 'tanggal_selesai',
                default             => 'tanggal_penjadwalan',
            };

            $pengajuan->update([
                'status'       => $request->status,
                $statusField   => now(),
            ]);

            TrackingHistory::create([
                'pengajuan_id'   => $pengajuan->id,
                'status'         => $request->status,
                'keterangan'     => $request->keterangan,
                'tanggal_status' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}