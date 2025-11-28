<?php

namespace App\Exports;

use App\Models\Bill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Bill::with(['user', 'booking.room'])
            ->where('status', 'dibayar');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('updated_at', [$this->startDate, $this->endDate]);
        }

        return $query->orderBy('updated_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Tagihan',
            'Penyewa',
            'Kamar',
            'Bulan Tagihan',
            'Total Tagihan',
            'Tanggal Jatuh Tempo',
            'Tanggal Dibayar',
            'Status',
        ];
    }

    public function map($bill): array
    {
        return [
            $bill->bill_code,
            $bill->user->name,
            $bill->booking ? $bill->booking->room->name : '-',
            $bill->bill_month,
            'Rp ' . number_format($bill->total_amount, 0, ',', '.'),
            $bill->due_date->format('d M Y'),
            $bill->updated_at->format('d M Y H:i'),
            ucfirst($bill->status),
        ];
    }
}
