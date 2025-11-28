<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin / Pemilik
        \App\Models\User::create([
            'name' => 'Najla (Pemilik)',
            'email' => 'admin@kosan.com',
            'password' => bcrypt('password'),
            'nik' => '1234567890123456',
            'phone_number' => '081234567890',
            'role' => 'pemilik',
        ]);

        // Penyewa 1
        \App\Models\User::create([
            'name' => 'Ahmad Penyewa',
            'email' => 'ahmad@example.com',
            'password' => bcrypt('password'),
            'nik' => '1234567890123457',
            'phone_number' => '081234567891',
            'role' => 'penyewa',
        ]);

        // Penyewa 2
        \App\Models\User::create([
            'name' => 'Siti Penyewa',
            'email' => 'siti@example.com',
            'password' => bcrypt('password'),
            'nik' => '1234567890123458',
            'phone_number' => '081234567892',
            'role' => 'penyewa',
        ]);
    }
}
