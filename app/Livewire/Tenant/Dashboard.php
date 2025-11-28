<?php

namespace App\Livewire\Tenant;

use App\Models\Announcement;
use App\Models\Bill;
use App\Models\Booking;
use App\Models\Complaint;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $announcements = Announcement::where('publish_status', 'diterbitkan')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentBills = Bill::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $activeBookings = Booking::where('user_id', auth()->id())
            ->whereIn('status', ['pembayaran_tertunda', 'dikonfirmasi'])
            ->with('room')
            ->get();

        $stats = [
            'unpaid_bills' => Bill::where('user_id', auth()->id())
                ->where('status', 'belum_dibayar')
                ->count(),
            'active_complaints' => Complaint::where('user_id', auth()->id())
                ->whereIn('status', ['dikirim', 'diproses'])
                ->count(),
            'active_bookings' => $activeBookings->count(),
        ];

        return view('livewire.tenant.dashboard', [
            'announcements' => $announcements,
            'recentBills' => $recentBills,
            'activeBookings' => $activeBookings,
            'stats' => $stats,
        ])->layout('layouts.tenant-ubold');
    }
}
