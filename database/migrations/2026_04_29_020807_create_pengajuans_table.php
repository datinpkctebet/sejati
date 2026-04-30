<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket')->unique();
            $table->enum('jenis_pengajuan', ['baru', 'perpanjangan']);
            $table->enum('jenis_fasyankes', [
                'klinik_pratama',
                'klinik_utama',
                'praktek_mandiri',
                'laboratorium',
                'optik',
                'apotek'
            ]);
            $table->string('nama_fasyankes');
            $table->string('nama_pemilik');
            $table->string('nama_penanggung_jawab');
            $table->string('email');
            $table->string('nomor_hp');
            $table->text('alamat');
            $table->enum('kelurahan', [
                'bukit_duri',
                'kebon_baru',
                'manggarai',
                'manggarai_selatan',
                'menteng_dalam',
                'tebet_barat',
                'tebet_timur'
            ]);
            // Dokumen bersama (baru & perpanjangan)
            $table->string('profil_denah_fasyankes_dokumen')->nullable();
            $table->string('str_tenaga_kesehatan_dokumen')->nullable();
            $table->string('mou_limbah_dokumen')->nullable();
            // Dokumen tambahan perpanjangan
            $table->string('sip_tenaga_kesehatan_dokumen')->nullable();
            $table->string('sio_dokumen')->nullable();
            $table->string('sertifikat_kalibrasi_dokumen')->nullable();
            // Status tracking
            $table->enum('status', [
                'proses_penjadwalan',
                'kunjungan_selesai',
                'proses_ttd',
                'selesai'
            ])->default('proses_penjadwalan');
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_pengajuan')->useCurrent();
            $table->timestamp('tanggal_penjadwalan')->nullable();
            $table->timestamp('tanggal_kunjungan')->nullable();
            $table->timestamp('tanggal_ttd')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};