<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name'     => 'Admin Puskesmas Tebet',
                'password' => Hash::make('admin123123'),
                'jabatan'  => 'Petugas Jejaring',
            ]
        );
    }
}