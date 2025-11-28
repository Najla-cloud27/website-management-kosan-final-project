<?php

namespace App\Exports;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RoomsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Room::withCount('images')->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Nama Kamar',
            'Harga per Bulan',
            'Ukuran (m²)',
            'Status',
            'Fasilitas',
            'Jumlah Gambar',
            'Tanggal Dibuat',
        ];
    }

    public function map($room): array
    {
        return [
            $room->name,
            'Rp ' . number_format($room->price, 0, ',', '.'),
            $room->size,
            match($room->status) {
                'tersedia' => 'Tersedia',
                'terisi' => 'Terisi',
                'sudah_dipesan' => 'Sudah Dipesan',
                'pemeliharaan' => 'Pemeliharaan',
                default => $room->status,
            },
            $room->fasilitas ? implode(', ', $room->fasilitas) : '-',
            $room->images_count,
            $room->created_at->format('d M Y'),
        ];
    }
}
