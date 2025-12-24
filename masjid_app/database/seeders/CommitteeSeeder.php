<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Committee;
use Illuminate\Support\Facades\Hash;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cipta Admin Utama
        Committee::create([
            'name' => 'Admin Masjid',
            'email' => 'admin@masjid.com',
            'password' => Hash::make('password123'), // Sila tukar password ini
            'role' => 'admin', // Penting: set sebagai admin
        ]);

        // (Optional) Cipta Moderator contoh
        Committee::create([
            'name' => 'AJK Tugas Khas',
            'email' => 'ajk@masjid.com',
            'password' => Hash::make('password123'),
            'role' => 'moderator',
        ]);
    }
}