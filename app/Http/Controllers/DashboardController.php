<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'klinik_pratama'  => Pengajuan::where('jenis_fasyankes', 'klinik_pratama')->count(),
            'klinik_utama'    => Pengajuan::where('jenis_fasyankes', 'klinik_utama')->count(),
            'praktek_mandiri' => Pengajuan::where('jenis_fasyankes', 'praktek_mandiri')->count(),
            'laboratorium'    => Pengajuan::where('jenis_fasyankes', 'laboratorium')->count(),
            'optik'           => Pengajuan::where('jenis_fasyankes', 'optik')->count(),
            'apotek'          => Pengajuan::where('jenis_fasyankes', 'apotek')->count(),
        ];

        return view('dashboard.index', compact('stats'));
    }
}