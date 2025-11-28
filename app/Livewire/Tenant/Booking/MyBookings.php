<?php

namespace App\Livewire\Tenant\Booking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class MyBookings extends Component
{
    use WithPagination;

    public $showBookingModal = false;
    public $selectedRoomId;
    public $name;
    public $email;
    public $phone;
    public $duration = 1;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        // Auto-fill form dengan data user
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone_number ?? '';
    }

    public function openBookingModal()
    {
        $this->showBookingModal = true;
        $this->selectedRoomId = null;
        $this->duration = 1;
    }

    public function closeBookingModal()
    {
        $this->showBookingModal = false;
        $this->selectedRoomId = null;
        $this->resetValidation();
    }

    public function submitBooking()
    {
        // Validasi input
        $this->validate([
            'selectedRoomId' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'duration' => 'required|integer|min:1|max:12',
        ]);

        // Ambil room
        $room = Room::findOrFail($this->selectedRoomId);

        // Cek apakah kamar tersedia
        if ($room->status !== 'tersedia') {
            session()->flash('error', 'Kamar ini tidak tersedia untuk dibooking.');
            $this->closeBookingModal();
            return;
        }

        // Generate booking code
        $bookingCode = Booking::generateBookingCode();

        // Hitung tanggal check-in (default besok)
        $checkInDate = now()->addDays(1);

        // Create booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'booking_code' => $bookingCode,
            'duration_in_months' => $this->duration,
            'planned_check_in_date' => $checkInDate,
            'selesai_booking' => $checkInDate->copy()->addMonths((int) $this->duration),
            'status' => 'pembayaran_tertunda',
        ]);

        // Update room status
        Room::where('id', $room->id)->update(['status' => 'sudah_dipesan']);

        // Create notification untuk user
        \App\Models\Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Booking Berhasil!',
            'message' => "Booking untuk {$room->name} berhasil dibuat. Kode booking: {$bookingCode}. Silakan menunggu konfirmasi dari admin.",
            'type' => 'booking',
            'is_read' => false,
        ]);

        // Create notification untuk admin
        $admins = \App\Models\User::where('role', 'pemilik')->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'title' => 'Booking Baru!',
                'message' => "Booking baru dari {$this->name} untuk kamar {$room->name}. Kode: {$bookingCode}",
                'type' => 'booking',
                'is_read' => false,
            ]);
        }

        session()->flash('success', 'Booking berhasil dibuat! Kode booking: ' . $bookingCode);
        $this->closeBookingModal();
    }

    public function cancelBooking($bookingId)
    {
        try {
            $booking = Booking::where('id', $bookingId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Hanya bisa cancel jika status pembayaran_tertunda atau dikonfirmasi
            if (in_array($booking->status, ['pembayaran_tertunda', 'dikonfirmasi'])) {
                $booking->update(['status' => 'dibatalkan']);
                
                // Update room status kembali tersedia
                Room::where('id', $booking->room_id)->update(['status' => 'tersedia']);
                
                session()->flash('success', 'Booking berhasil dibatalkan.');
            } else {
                session()->flash('error', 'Booking tidak dapat dibatalkan.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal membatalkan booking: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $bookings = Booking::with(['room'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $availableRooms = Room::where('status', 'tersedia')->get();

        $stats = [
            'total' => Booking::where('user_id', Auth::id())->count(),
            'pending' => Booking::where('user_id', Auth::id())->where('status', 'pembayaran_tertunda')->count(),
            'confirmed' => Booking::where('user_id', Auth::id())->where('status', 'dikonfirmasi')->count(),
            'cancelled' => Booking::where('user_id', Auth::id())->where('status', 'dibatalkan')->count(),
        ];

        return view('livewire.tenant.booking.my-bookings', [
            'bookings' => $bookings,
            'availableRooms' => $availableRooms,
            'stats' => $stats,
        ])->layout('layouts.tenant-ubold', [
            'title' => 'Booking Saya'
        ]);
    }
}
