<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuans')->onDelete('cascade');
            $table->enum('status', [
                'proses_penjadwalan',
                'kunjungan_selesai',
                'proses_ttd',
                'selesai'
            ]);
            $table->text('keterangan')->nullable();
            $table->timestamp('tanggal_status')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking_histories');
    }
};