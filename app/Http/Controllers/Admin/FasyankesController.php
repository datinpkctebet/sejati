<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\TrackingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'jadwal_kunjungan.required'          => 'Tanggal kunjungan wajib diisi.',
            'jadwal_kunjungan.after_or_equal'    => 'Tanggal kunjungan tidak boleh sebelum hari ini.',
        ]);

        DB::beginTransaction();
        try {
            $keterangan = $request->keterangan
                ?? "Kunjungan dijadwalkan pada tanggal " . \Carbon\Carbon::parse($request->jadwal_kunjungan)->translatedFormat('d F Y') . ". Petugas Puskesmas Tebet akan datang ke lokasi fasyankes.";

            $pengajuan->update([
                'jadwal_kunjungan'    => $request->jadwal_kunjungan,
                'tanggal_penjadwalan' => now(),
            ]);

            // Update history keterangan di status proses_penjadwalan
            TrackingHistory::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id, 'status' => 'proses_penjadwalan'],
                ['keterangan' => $keterangan, 'tanggal_status' => now()]
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Jadwal kunjungan berhasil disimpan.']);
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
            'hasil_kunjungan'        => 'required|in:memenuhi_syarat,tidak_memenuhi_syarat',
            'keterangan_kunjungan'   => 'nullable|string|max:2000',
        ], [
            'hasil_kunjungan.required' => 'Hasil kunjungan wajib dipilih.',
        ]);

        DB::beginTransaction();
        try {
            $hasilLabel = $request->hasil_kunjungan === 'memenuhi_syarat'
                ? 'Memenuhi Syarat' : 'Tidak Memenuhi Syarat';

            $defaultKet = $request->hasil_kunjungan === 'memenuhi_syarat'
                ? "Kunjungan telah selesai dilaksanakan. Fasyankes dinyatakan {$hasilLabel}. Link draf PKS akan segera dikirimkan."
                : "Kunjungan telah selesai dilaksanakan. Fasyankes dinyatakan {$hasilLabel}. Mohon menindaklanjuti temuan dan mengajukan ulang setelah perbaikan selesai.";

            $pengajuan->update([
                'status'               => 'kunjungan_selesai',
                'hasil_kunjungan'      => $request->hasil_kunjungan,
                'keterangan_kunjungan' => $request->keterangan_kunjungan ?? $defaultKet,
                'tanggal_kunjungan'    => now(),
            ]);

            TrackingHistory::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id, 'status' => 'kunjungan_selesai'],
                [
                    'keterangan'     => $request->keterangan_kunjungan ?? $defaultKet,
                    'tanggal_status' => now(),
                ]
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Hasil kunjungan berhasil disimpan.']);
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
}