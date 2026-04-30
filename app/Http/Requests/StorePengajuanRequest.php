<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengajuanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $jenis = $this->input('jenis_pengajuan');

        $rules = [
            'jenis_pengajuan'  => 'required|in:baru,perpanjangan',
            'jenis_fasyankes'  => 'required|in:klinik_pratama,klinik_utama,praktek_mandiri,laboratorium,optik,apotek',
            'nama_fasyankes'   => 'required|string|max:255',
            'nama_pemilik'     => 'required|string|max:255',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'nomor_hp'         => 'required|string|max:20',
            'alamat'           => 'required|string',
            'kelurahan'        => 'required|in:bukit_duri,kebon_baru,manggarai,manggarai_selatan,menteng_dalam,tebet_barat,tebet_timur',
            // Dokumen wajib untuk semua jenis
            'profil_denah_fasyankes_dokumen' => 'required|file|mimes:pdf|max:2048',
            'str_tenaga_kesehatan_dokumen'   => 'required|file|mimes:pdf|max:2048',
            'mou_limbah_dokumen'             => 'required|file|mimes:pdf|max:2048',
        ];

        // Dokumen tambahan hanya untuk perpanjangan
        if ($jenis === 'perpanjangan') {
            $rules['sip_tenaga_kesehatan_dokumen'] = 'required|file|mimes:pdf|max:2048';
            $rules['sio_dokumen']                  = 'required|file|mimes:pdf|max:2048';
            $rules['sertifikat_kalibrasi_dokumen'] = 'required|file|mimes:pdf|max:2048';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'jenis_pengajuan.required'  => 'Jenis pengajuan wajib dipilih.',
            'jenis_fasyankes.required'  => 'Jenis fasyankes wajib dipilih.',
            'nama_fasyankes.required'   => 'Nama fasyankes wajib diisi.',
            'nama_pemilik.required'     => 'Nama pemilik wajib diisi.',
            'nama_penanggung_jawab.required' => 'Nama penanggung jawab wajib diisi.',
            'email.required'            => 'Email wajib diisi.',
            'email.email'               => 'Format email tidak valid.',
            'nomor_hp.required'         => 'Nomor HP wajib diisi.',
            'alamat.required'           => 'Alamat wajib diisi.',
            'kelurahan.required'        => 'Kelurahan wajib dipilih.',
            'profil_denah_fasyankes_dokumen.required' => 'Dokumen profil dan denah fasyankes wajib diupload.',
            'profil_denah_fasyankes_dokumen.mimes'    => 'Dokumen harus berformat PDF.',
            'profil_denah_fasyankes_dokumen.max'      => 'Ukuran dokumen maksimal 2MB.',
            'str_tenaga_kesehatan_dokumen.required'   => 'Dokumen STR tenaga kesehatan wajib diupload.',
            'str_tenaga_kesehatan_dokumen.mimes'      => 'Dokumen harus berformat PDF.',
            'str_tenaga_kesehatan_dokumen.max'        => 'Ukuran dokumen maksimal 2MB.',
            'mou_limbah_dokumen.required'             => 'Dokumen MOU limbah wajib diupload.',
            'mou_limbah_dokumen.mimes'                => 'Dokumen harus berformat PDF.',
            'mou_limbah_dokumen.max'                  => 'Ukuran dokumen maksimal 2MB.',
            'sip_tenaga_kesehatan_dokumen.required'   => 'Dokumen SIP tenaga kesehatan wajib diupload.',
            'sio_dokumen.required'                    => 'Dokumen SIO wajib diupload.',
            'sertifikat_kalibrasi_dokumen.required'   => 'Dokumen sertifikat kalibrasi wajib diupload.',
        ];
    }
}