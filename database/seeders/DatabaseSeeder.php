<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Room;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Room::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Admin (Pemilik)
        User::create([
            'name' => 'Admin Kosan',
            'email' => 'admin@kosan.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'pemilik',
            'phone_number' => '081234567890',
            'nik' => '3174012345678901',
            'avatar_url' => null,
            'remember_token' => Str::random(10),
        ]);

        // Create Penyewa
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'penyewa',
            'phone_number' => '082345678901',
            'nik' => '3174019876543210',
            'avatar_url' => null,
            'remember_token' => Str::random(10),
        ]);

        // Create 5 Rooms
        $rooms = [
            [
                'name' => 'Kamar A1',
                'description' => 'Kamar nyaman dengan fasilitas lengkap di lantai 1. Dilengkapi dengan AC, kasur springbed, lemari pakaian, dan meja belajar. Lokasi strategis dekat dengan kampus dan pusat perbelanjaan.',
                'slug' => 'kamar-a1',
                'price' => 1500000,
                'size' => '3x4 meter',
                'status' => 'tersedia',
                'fasilitas' => json_encode([
                    'AC',
                    'Kasur',
                    'Lemari',
                    'Meja Belajar',
                    'Kamar Mandi Dalam',
                    'WiFi',
                ]),
                'stok' => 'tersedia',
                'main_image_url' => null,
                'icon_svg' => null,
            ],
            [
                'name' => 'Kamar A2',
                'description' => 'Kamar luas dengan view bagus di lantai 1. Dilengkapi AC, kasur king size, lemari sliding door, dan balkon pribadi. Cocok untuk mahasiswa atau pekerja profesional.',
                'slug' => 'kamar-a2',
                'price' => 1750000,
                'size' => '4x4 meter',
                'status' => 'tersedia',
                'fasilitas' => json_encode([
                    'AC',
                    'Kasur King Size',
                    'Lemari Sliding',
                    'Meja Belajar',
                    'Kamar Mandi Dalam',
                    'WiFi',
                    'Balkon',
                ]),
                'stok' => 'tersedia',
                'main_image_url' => null,
                'icon_svg' => null,
            ],
            [
                'name' => 'Kamar B1',
                'description' => 'Kamar standar di lantai 2 dengan harga terjangkau. Fasilitas standar meliputi kipas angin, kasur single, lemari kecil, dan meja lipat. Ideal untuk mahasiswa dengan budget terbatas.',
                'slug' => 'kamar-b1',
                'price' => 1200000,
                'size' => '3x3 meter',
                'status' => 'tersedia',
                'fasilitas' => json_encode([
                    'Kipas Angin',
                    'Kasur Single',
                    'Lemari',
                    'Meja Lipat',
                    'Kamar Mandi Luar',
                    'WiFi',
                ]),
                'stok' => 'tersedia',
                'main_image_url' => null,
                'icon_svg' => null,
            ],
            [
                'name' => 'Kamar B2',
                'description' => 'Kamar premium di lantai 2 dengan fasilitas mewah. AC dual inverter, kasur orthopedic, smart TV 32 inch, lemari walk-in, dan dapur mini. Cocok untuk eksekutif muda.',
                'slug' => 'kamar-b2',
                'price' => 2500000,
                'size' => '4x5 meter',
                'status' => 'tersedia',
                'fasilitas' => json_encode([
                    'AC Dual Inverter',
                    'Kasur Orthopedic',
                    'Smart TV 32"',
                    'Lemari Walk-in',
                    'Meja Kerja',
                    'Kamar Mandi Dalam',
                    'WiFi',
                    'Dapur Mini',
                    'Kulkas Mini',
                ]),
                'stok' => 'tersedia',
                'main_image_url' => null,
                'icon_svg' => null,
            ],
            [
                'name' => 'Kamar C1',
                'description' => 'Kamar semi furnished di lantai 3 dengan pencahayaan alami. AC, kasur double, lemari 2 pintu, jendela besar, dan area kerja yang nyaman. Suasana tenang dan privat.',
                'slug' => 'kamar-c1',
                'price' => 1600000,
                'size' => '3.5x4 meter',
                'status' => 'tersedia',
                'fasilitas' => json_encode([
                    'AC',
                    'Kasur Double',
                    'Lemari 2 Pintu',
                    'Meja Kerja',
                    'Kursi Ergonomis',
                    'Kamar Mandi Dalam',
                    'WiFi',
                    'Jendela Besar',
                ]),
                'stok' => 'tersedia',
                'main_image_url' => null,
                'icon_svg' => null,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('');
        $this->command->info('=== Login Credentials ===');
        $this->command->info('Admin:');
        $this->command->info('  Email: admin@kosan.com');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Penyewa:');
        $this->command->info('  Email: budi@example.com');
        $this->command->info('  Password: password');
        $this->command->info('========================');
    }
}

