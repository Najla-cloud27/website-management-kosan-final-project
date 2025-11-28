<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;

class ManageBookings extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $selectedBooking;
    public $showModal = false;
    public $newStatus;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function editStatus($bookingId)
    {
        $this->selectedBooking = Booking::with(['user', 'room'])->findOrFail($bookingId);
        $this->newStatus = $this->selectedBooking->status;
        $this->showModal = true;
    }

    public function updateStatus()
    {
        try {
            $this->validate([
                'newStatus' => 'required|in:pembayaran_tertunda,dikonfirmasi,selesai,dibatalkan',
            ]);

            $this->selectedBooking->update([
                'status' => $this->newStatus,
            ]);

            // Update room status based on booking status
            if ($this->newStatus === 'dikonfirmasi') {
                Room::where('id', $this->selectedBooking->room_id)->update(['status' => 'sudah_dipesan']);
            } elseif ($this->newStatus === 'dibatalkan') {
                Room::where('id', $this->selectedBooking->room_id)->update(['status' => 'tersedia']);
            } elseif ($this->newStatus === 'selesai') {
                Room::where('id', $this->selectedBooking->room_id)->update(['status' => 'tersedia']);
            }

            session()->flash('success', 'Status booking berhasil diupdate.');
            $this->showModal = false;
            $this->selectedBooking = null;
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal update status: ' . $e->getMessage());
        }
    }

    public function deleteBooking($bookingId)
    {
        try {
            $booking = Booking::findOrFail($bookingId);
            
            // Update room status to available
            Room::where('id', $booking->room_id)->update(['status' => 'tersedia']);
            
            $booking->delete();
            
            session()->flash('success', 'Booking berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus booking: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedBooking = null;
        $this->newStatus = '';
    }

    public function render()
    {
        $bookings = Booking::with(['user', 'room'])
            ->when($this->search, function($query) {
                $query->where('booking_code', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('room', function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pembayaran_tertunda')->count(),
            'confirmed' => Booking::where('status', 'dikonfirmasi')->count(),
            'cancelled' => Booking::where('status', 'dibatalkan')->count(),
        ];

        return view('livewire.admin.booking.manage-bookings', [
            'bookings' => $bookings,
            'stats' => $stats,
        ])->layout('layouts.admin-ubold', [
            'title' => 'Manajemen Booking'
        ]);
    }
}
