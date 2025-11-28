<?php

namespace App\Livewire\Admin;

use App\Models\Room;
use App\Models\User;
use App\Models\Bill;
use App\Models\Booking;
use App\Models\Complaint;
use App\Models\PaymentProof;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_rooms' => Room::count(),
            'available_rooms' => Room::where('status', 'tersedia')->count(),
            'total_tenants' => User::where('role', 'penyewa')->count(),
            'total_bookings' => Booking::count(),
            'active_bookings' => Booking::whereIn('status', ['pembayaran_tertunda', 'dikonfirmasi'])->count(),
            'unpaid_bills' => Bill::where('status', 'belum_dibayar')->count(),
            'total_revenue' => Bill::where('status', 'dibayar')->sum('total_amount'),
            'pending_proofs' => PaymentProof::where('status', 'tertunda')->count(),
            'active_complaints' => Complaint::whereIn('status', ['dikirim', 'diproses'])->count(),
            'pending_complaints' => Complaint::where('status', 'dikirim')->count(),
            'active_announcements' => \App\Models\Announcement::where('publish_status', 'diterbitkan')->count(),
        ];

        $recentBookings = Booking::with(['user', 'room'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentComplaints = Complaint::with(['user', 'room'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $pendingProofs = PaymentProof::with(['user', 'bill'])
            ->where('status', 'tertunda')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data untuk Revenue Chart (6 bulan terakhir)
        $revenueChartData = [];
        $revenueChartLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $revenueChartLabels[] = $month->format('M Y');
            $revenueChartData[] = Bill::where('status', 'dibayar')
                ->whereYear('updated_at', $month->year)
                ->whereMonth('updated_at', $month->month)
                ->sum('total_amount');
        }

        // Data untuk Room Status Chart
        $roomStatusData = [
            'tersedia' => Room::where('status', 'tersedia')->count(),
            'terisi' => Room::where('status', 'terisi')->count(),
            'sudah_dipesan' => Room::where('status', 'sudah_dipesan')->count(),
            'pemeliharaan' => Room::where('status', 'pemeliharaan')->count(),
        ];

        // Data untuk Booking Trend (7 hari terakhir)
        $bookingTrendData = [];
        $bookingTrendLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $bookingTrendLabels[] = $date->format('d M');
            $bookingTrendData[] = Booking::whereDate('created_at', $date)->count();
        }

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'recentBookings' => $recentBookings,
            'recentComplaints' => $recentComplaints,
            'pendingProofs' => $pendingProofs,
            'revenueChartData' => $revenueChartData,
            'revenueChartLabels' => $revenueChartLabels,
            'roomStatusData' => $roomStatusData,
            'bookingTrendData' => $bookingTrendData,
            'bookingTrendLabels' => $bookingTrendLabels,
        ])->layout('layouts.admin-ubold');
    }
}
