<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_tiket',
        'jenis_pengajuan',
        'jenis_fasyankes',
        'nama_fasyankes',
        'nama_pemilik',
        'nama_penanggung_jawab',
        'email',
        'nomor_hp',
        'alamat',
        'kelurahan',
        'profil_denah_fasyankes_dokumen',
        'str_tenaga_kesehatan_dokumen',
        'mou_limbah_dokumen',
        'sip_tenaga_kesehatan_dokumen',
        'sio_dokumen',
        'sertifikat_kalibrasi_dokumen',
        'status',
        'catatan',
        'hasil_kunjungan',
        'keterangan_kunjungan',
        'tanggal_pengajuan',
        'tanggal_penjadwalan',
        'tanggal_kunjungan',
        'tanggal_ttd',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_pengajuan'  => 'datetime',
        'tanggal_penjadwalan' => 'datetime',
        'tanggal_kunjungan'  => 'datetime',
        'tanggal_ttd'        => 'datetime',
        'tanggal_selesai'    => 'datetime',
    ];

    public function trackingHistories()
    {
        return $this->hasMany(TrackingHistory::class)->orderBy('tanggal_status', 'asc');
    }

    /**
     * Generate unique ticket number: TBTYYYYXXX
     */
    public static function generateNomorTiket(): string
    {
        $prefix = 'TBT' . now()->format('Y');
        $last   = static::where('nomor_tiket', 'like', $prefix . '%')
                        ->orderByDesc('nomor_tiket')
                        ->value('nomor_tiket');
        $seq    = $last ? (intval(substr($last, -3)) + 1) : 1;
        return $prefix . str_pad($seq, 3, '0', STR_PAD_LEFT);
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

    public function getStatusStepAttribute(): int
    {
        return match ($this->status) {
            'proses_penjadwalan' => 1,
            'kunjungan_selesai'  => 2,
            'proses_ttd'         => 3,
            'selesai'            => 4,
            default              => 0,
        };
    }

    public function getJenisFasyankesLabelAttribute(): string
    {
        return match ($this->jenis_fasyankes) {
            'klinik_pratama'   => 'Klinik Pratama',
            'klinik_utama'     => 'Klinik Utama',
            'praktek_mandiri'  => 'Praktek Mandiri',
            'laboratorium'     => 'Laboratorium',
            'optik'            => 'Optik',
            'apotek'           => 'Apotek',
            default            => '-',
        };
    }

    public function getKelurahanLabelAttribute(): string
    {
        return match ($this->kelurahan) {
            'bukit_duri'        => 'Bukit Duri',
            'kebon_baru'        => 'Kebon Baru',
            'manggarai'         => 'Manggarai',
            'manggarai_selatan' => 'Manggarai Selatan',
            'menteng_dalam'     => 'Menteng Dalam',
            'tebet_barat'       => 'Tebet Barat',
            'tebet_timur'       => 'Tebet Timur',
            default             => '-',
        };
    }

    public function getHasilKunjunganLabelAttribute(): string
    {
        return match ($this->hasil_kunjungan) {
            'memenuhi_syarat'       => 'Memenuhi Syarat',
            'tidak_memenuhi_syarat' => 'Tidak Memenuhi Syarat',
            default => '-',
        };
    }
 
    public function getHasilKunjunganColorAttribute(): string
    {
        return match ($this->hasil_kunjungan) {
            'memenuhi_syarat'       => 'success',
            'tidak_memenuhi_syarat' => 'danger',
            default => 'secondary',
        };
    }
 
    public function getWhatsappUrlAttribute(): string
    {
        $phone = preg_replace('/\D/', '', $this->nomor_hp);
        if (str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);
        $msg = urlencode(
            "Yth. {$this->nama_penanggung_jawab},\n\n" .
            "Kami dari Puskesmas Tebet menginformasikan bahwa pengajuan kerja sama Anda " .
            "dengan nomor tiket *{$this->nomor_tiket}* saat ini sedang dalam tahap " .
            "*{$this->status_label}*.\n\nMohon menghubungi kami untuk informasi lebih lanjut.\n\nTerima kasih.\nPuskesmas Tebet"
        );
        return "https://wa.me/{$phone}?text={$msg}";
    }
}