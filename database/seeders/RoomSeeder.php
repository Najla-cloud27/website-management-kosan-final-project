<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Kamar A1',
                'description' => 'Kamar berukuran 3x4 meter dengan fasilitas lengkap',
                'price' => 1500000,
                'size' => '3x4 meter',
                'status' => 'tersedia',
                'fasilitas' => ['AC', 'Kasur', 'Lemari', 'Kamar Mandi Dalam'],
                'stok' => 'tersedia',
            ],
            [
                'name' => 'Kamar A2',
                'description' => 'Kamar nyaman dengan view bagus',
                'price' => 1300000,
                'size' => '3x3 meter',
                'status' => 'tersedia',
                'fasilitas' => ['Kipas Angin', 'Kasur', 'Lemari', 'Kamar Mandi Luar'],
                'stok' => 'tersedia',
            ],
            [
                'name' => 'Kamar B1',
                'description' => 'Kamar dengan lokasi strategis',
                'price' => 1800000,
                'size' => '4x4 meter',
                'status' => 'tersedia',
                'fasilitas' => ['AC', 'Kasur', 'Lemari', 'Meja Belajar', 'Kamar Mandi Dalam'],
                'stok' => 'tersedia',
            ],
            [
                'name' => 'Kamar B2',
                'description' => 'Kamar ekonomis untuk mahasiswa',
                'price' => 1000000,
                'size' => '3x3 meter',
                'status' => 'tersedia',
                'fasilitas' => ['Kasur', 'Lemari', 'Kamar Mandi Luar'],
                'stok' => 'tersedia',
            ],
            [
                'name' => 'Kamar C1',
                'description' => 'Kamar premium dengan fasilitas lengkap',
                'price' => 2000000,
                'size' => '4x5 meter',
                'status' => 'terisi',
                'fasilitas' => ['AC', 'Kasur King', 'Lemari', 'Meja Belajar', 'TV', 'Kamar Mandi Dalam'],
                'stok' => 'tidak_tersedia',
            ],
        ];

        foreach ($rooms as $room) {
            \App\Models\Room::create($room);
        }
    }
}
