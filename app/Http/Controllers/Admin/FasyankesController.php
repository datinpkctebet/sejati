<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\TrackingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class FasyankesController extends Controller
{
    /** Daftar semua pengajuan fasyankes */
    public function index(Request $request)
    {
        $query = Pengajuan::with('trackingHistories')->latest('tanggal_pengajuan');

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        // Filter jenis fasyankes
        if ($request->filled('jenis_fasyankes')) {
            $query->where('jenis_fasyankes', $request->jenis_fasyankes);
        }
        // Search nama/tiket
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('nomor_tiket', 'like', "%{$q}%")
                   ->orWhere('nama_fasyankes', 'like', "%{$q}%")
                   ->orWhere('nama_penanggung_jawab', 'like', "%{$q}%");
            });
        }

        $pengajuans = $query->paginate(15)->withQueryString();

        // Stats ringkasan
        $stats = [
            'total'              => Pengajuan::count(),
            'proses_penjadwalan' => Pengajuan::where('status', 'proses_penjadwalan')->count(),
            'kunjungan_selesai'  => Pengajuan::where('status', 'kunjungan_selesai')->count(),
            'proses_ttd'         => Pengajuan::where('status', 'proses_ttd')->count(),
            'selesai'            => Pengajuan::where('status', 'selesai')->count(),
        ];

        return view('admin.fasyankes.index', compact('pengajuans', 'stats'));
    }

    /** Detail pengajuan */
    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load('trackingHistories');
        return view('admin.fasyankes.show', compact('pengajuan'));
    }

    /**
     * Update status: proses_penjadwalan → input jadwal kunjungan
     */
    public function updatePenjadwalan(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'jadwal_kunjungan' => 'required|date|after_or_equal:today',
            'keterangan'       => 'nullable|string|max:1000',
        ], [
            'jadwal_kunjungan.required'       => 'Tanggal kunjungan wajib diisi.',
            'jadwal_kunjungan.after_or_equal' => 'Tanggal kunjungan tidak boleh sebelum hari ini.',
        ]);
 
        DB::beginTransaction();
        try {
            $jadwalFmt  = Carbon::parse($request->jadwal_kunjungan)->translatedFormat('d F Y');
            $keterangan = $request->filled('keterangan')
                ? $request->keterangan
                : "Kunjungan dijadwalkan pada tanggal {$jadwalFmt}. Petugas Puskesmas Tebet akan datang ke lokasi fasyankes.";
 
            // 1. Update data pengajuan → langsung ke kunjungan_selesai
            $pengajuan->update([
                'jadwal_kunjungan'    => $request->jadwal_kunjungan,
                'tanggal_penjadwalan' => now(),
            ]);
 
            // 2. Perbarui history proses_penjadwalan dengan jadwal + keterangan
            TrackingHistory::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id, 'status' => 'proses_penjadwalan'],
                [
                    'keterangan'     => $keterangan,
                    'tanggal_status' => now(),
                ]
            );
 
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Jadwal kunjungan ({$jadwalFmt}) berhasil disimpan. Status diperbarui ke Kunjungan Selesai.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateLangsungKunjungan(Request $request, Pengajuan $pengajuan)
    {
        DB::beginTransaction();
        try {
            $pengajuan->update([
                'tanggal_kunjungan' => now(),
                'status'           => 'kunjungan_selesai',
            ]);

            TrackingHistory::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id, 'status' => 'kunjungan_selesai'],
                [
                    'keterangan'     => "Kunjungan telah dilaksanakan pada " . now()->translatedFormat('d F Y') . ". Menunggu input hasil kunjungan dari petugas Puskesmas.",
                    'tanggal_status' => now(),
                ]
            );

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Kunjungan telah dilaksanakan. Status diperbarui ke Kunjungan Selesai.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update status: kunjungan_selesai → input hasil kunjungan
     */
    public function updateKunjungan(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'hasil_kunjungan'      => 'required|in:memenuhi_syarat,tidak_memenuhi_syarat',
            'keterangan_kunjungan' => 'nullable|string|max:2000',
        ], [
            'hasil_kunjungan.required' => 'Hasil kunjungan wajib dipilih.',
        ]);
 
        DB::beginTransaction();
        try {
            $memenuhi = $request->hasil_kunjungan === 'memenuhi_syarat';
 
            // Keterangan default sesuai hasil
            if ($memenuhi) {
                $defaultKet = "Fasyankes dinyatakan <span class='badge badge-light-success fs-9'>MEMENUHI SYARAT</span>. <br> Kunjungan telah selesai dilaksanakan. Mohon Unduh Template Dokumen PKS pada link berikut: <a href='https://bit.ly/template-dokumen-pks' target='_blank'>[Download Template PKS]</a>. Setelah itu, isi dokumen PKS dan kirimkan kembali ke Email Puskesmas <a href='#'>puskesmas.tebet@jakarta.go.id</a>";
            } else {
                $defaultKet = "Fasyankes dinyatakan <span class='badge badge-light-danger fs-9'>TIDAK MEMENUHI SYARAT</span>. <br> Kunjungan telah selesai dilaksanakan. Mohon menindaklanjuti temuan dan mengajukan ulang setelah perbaikan selesai.";
            }
            $keterangan = $request->filled('keterangan_kunjungan')
                ? $request->keterangan_kunjungan
                : $defaultKet;
 
            // Status pengajuan: naik jika memenuhi, tetap jika tidak
            $newStatus = $memenuhi ? 'proses_ttd' : 'kunjungan_selesai';
 
            $updateData = [
                'hasil_kunjungan'      => $request->hasil_kunjungan,
                'keterangan_kunjungan' => $keterangan,
                'status'               => $newStatus,
            ];
            if ($memenuhi) {
                $updateData['tanggal_ttd'] = now();
            }
 
            $pengajuan->update($updateData);
 
            // Update history kunjungan_selesai dengan hasil + keterangan lengkap
            TrackingHistory::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id, 'status' => 'kunjungan_selesai'],
                [
                    'keterangan'     => $keterangan,
                    'tanggal_status' => $pengajuan->tanggal_kunjungan ?? now(),
                ]
            );
 
            // Jika memenuhi syarat → buat history proses_ttd
            if ($memenuhi) {
                TrackingHistory::updateOrCreate(
                    ['pengajuan_id' => $pengajuan->id, 'status' => 'proses_ttd'],
                    [
                        'keterangan'     => "Dokumen PKS sedang dalam proses penandatanganan oleh Kepala Puskesmas Tebet. Estimasi selesai maksimal 4 hari kerja.",
                        'tanggal_status' => now(),
                    ]
                );
            }
 
            DB::commit();
 
            $msg = $memenuhi
                ? 'Hasil kunjungan disimpan. Status diperbarui ke Proses Tanda Tangan.'
                : 'Hasil kunjungan disimpan. Status tetap Kunjungan Selesai (tidak memenuhi syarat).';
 
            return response()->json(['success' => true, 'message' => $msg]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update status: proses_ttd → tandatangani PKS
     */
    public function updateTtd(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            $keterangan = $request->keterangan
                ?? "Dokumen PKS sedang dalam proses penandatanganan oleh Kepala Puskesmas Tebet. Estimasi selesai maksimal 4 hari kerja.";

            $pengajuan->update([
                'status'      => 'proses_ttd',
                'tanggal_ttd' => now(),
            ]);

            TrackingHistory::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id, 'status' => 'proses_ttd'],
                ['keterangan' => $keterangan, 'tanggal_status' => now()]
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Status diperbarui ke Proses Tanda Tangan.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update status: selesai
     */
    public function updateSelesai(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            $keterangan = $request->keterangan
                ?? "PKS telah selesai ditandatangani dan siap diambil. Silakan datang ke Puskesmas Tebet pada jam kerja (Senin–Jumat, 08.00–15.00 WIB).";

            $pengajuan->update([
                'status'          => 'selesai',
                'tanggal_selesai' => now(),
            ]);

            TrackingHistory::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id, 'status' => 'selesai'],
                ['keterangan' => $keterangan, 'tanggal_status' => now()]
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Pengajuan telah ditandai Selesai.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /** Ambil data pengajuan untuk modal (AJAX) */
    public function getData(Pengajuan $pengajuan)
    {
        return response()->json([
            'success'   => true,
            'pengajuan' => array_merge($pengajuan->toArray(), [
                'status_label'            => $pengajuan->status_label,
                'status_color'            => $pengajuan->status_color,
                'jenis_fasyankes_label'   => $pengajuan->jenis_fasyankes_label,
                'kelurahan_label'         => $pengajuan->kelurahan_label,
                'hasil_kunjungan_label'   => $pengajuan->hasil_kunjungan_label,
                'hasil_kunjungan_color'   => $pengajuan->hasil_kunjungan_color,
                'whatsapp_url'            => $pengajuan->whatsapp_url,
                'jadwal_kunjungan_fmt'    => $pengajuan->jadwal_kunjungan
                    ? $pengajuan->jadwal_kunjungan->translatedFormat('d F Y') : null,
            ]),
        ]);
    }

    public function downloadDokumen($path)
    {
        try {
            $decodedPath = base64_decode($path);
            
            if (!str_starts_with($decodedPath, 'dokumen/')) {
                abort(403, 'Akses ditolak');
            }
            
            $fullPath = public_path('storage/' . $decodedPath);
            
            if (!file_exists($fullPath)) {
                abort(404, 'File tidak ditemukan');
            }
            
            return response()->file($fullPath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($fullPath) . '"',
            ]);
        } catch (\Exception $e) {
            abort(500, 'Terjadi kesalahan saat membuka file');
        }
    }
}