<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'status',
        'keterangan',
        'tanggal_status',
    ];

    protected $casts = [
        'tanggal_status' => 'datetime',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'proses_penjadwalan' => 'Proses Penjadwalan Kunjungan',
            'kunjungan_selesai'  => 'Kunjungan Selesai',
            'proses_ttd'         => 'Proses Tanda Tangan Kepala Puskesmas',
            'selesai'            => 'Selesai',
            default              => '-',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'proses_penjadwalan' => 'warning',
            'kunjungan_selesai'  => 'info',
            'proses_ttd'         => 'primary',
            'selesai'            => 'success',
            default              => 'secondary',
        };
    }

    public function getStatusIconAttribute(): string
    {
        return match ($this->status) {
            'proses_penjadwalan' => 'calendar',
            'kunjungan_selesai'  => 'check-circle',
            'proses_ttd'         => 'pen',
            'selesai'            => 'trophy',
            default              => 'circle',
        };
    }
}