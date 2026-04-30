<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            // Untuk status kunjungan_selesai
            $table->enum('hasil_kunjungan', ['memenuhi_syarat', 'tidak_memenuhi_syarat'])
                  ->nullable()
                  ->after('catatan');
            $table->text('keterangan_kunjungan')->nullable()->after('hasil_kunjungan');
            // Tanggal kunjungan yang dijadwalkan (diisi admin saat proses_penjadwalan)
            $table->date('jadwal_kunjungan')->nullable()->after('tanggal_penjadwalan');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn(['hasil_kunjungan', 'keterangan_kunjungan', 'jadwal_kunjungan']);
        });
    }
};