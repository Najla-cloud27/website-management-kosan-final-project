<?php

namespace App\Livewire\Public;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Bill;
use App\Models\Notification;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.public')]
class RoomDetail extends Component
{
    public $slug;
    public $room;
    
    public $name = '';
    public $email = '';
    public $phone = '';
    public $duration = 3; // months
    public $message = '';
    public $check_in_date;
    
    // Modal properties
    public $showModal = false;
    public $modalType = ''; // 'success' or 'error'
    public $modalTitle = '';
    public $modalMessage = '';
    public $bookingCode = '';
    
    public function mount($slug)
    {
        $this->slug = $slug;
        $this->room = Room::with('images')->where('slug', $slug)->firstOrFail();
        $this->check_in_date = now()->addDays(1)->format('Y-m-d');
        
        // Auto-fill form jika user sudah login
        if (Auth::check()) {
            $user = Auth::user();
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone_number ?? '';
        }
    }

    public function submitBooking()
    {
        // Validasi user harus login
        if (!Auth::check()) {
            $this->showModal = true;
            $this->modalType = 'error';
            $this->modalTitle = 'Login Diperlukan';
            $this->modalMessage = 'Silakan login terlebih dahulu untuk melakukan booking.';
            return;
        }

        // Validasi input
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'duration' => 'required|integer|min:1|max:12',
        ]);

        // Cek apakah user adalah penyewa
        if (Auth::user()->role !== 'penyewa') {
            $this->showModal = true;
            $this->modalType = 'error';
            $this->modalTitle = 'Akses Ditolak';
            $this->modalMessage = 'Hanya penyewa yang dapat melakukan booking.';
            return;
        }

        // Cek apakah kamar tersedia
        if ($this->room->status !== 'tersedia') {
            $this->showModal = true;
            $this->modalType = 'error';
            $this->modalTitle = 'Kamar Tidak Tersedia';
            $this->modalMessage = 'Maaf, kamar ini sudah tidak tersedia untuk dibooking.';
            return;
        }

        // Generate booking code
        $bookingCode = Booking::generateBookingCode();

        // Hitung tanggal check-in (default besok)
        $checkInDate = now()->addDays(1);

        try {
            // Create booking dengan data lengkap
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'room_id' => $this->room->id,
                'booking_code' => $bookingCode,
                'duration_in_months' => $this->duration,
                'planned_check_in_date' => $checkInDate,
                'selesai_booking' => $checkInDate->copy()->addMonths($this->duration),
                'status' => 'pembayaran_tertunda',
            ]);

            // Update room status menjadi sudah_dipesan menggunakan direct update
            Log::info('Before Update - Room ID: ' . $this->room->id . ', Current Status: ' . $this->room->status);
            
            $affected = DB::table('rooms')
                ->where('id', $this->room->id)
                ->update(['status' => 'sudah_dipesan', 'updated_at' => now()]);
            
            Log::info('Update Affected Rows: ' . $affected);
            
            // JANGAN refresh room data karena akan trigger re-render dengan status baru
            // $this->room = Room::with('images')->find($this->room->id);
            
            Log::info('After Update - Status should be: sudah_dipesan');

            // Create notification untuk user
            Notification::create([
                'user_id' => Auth::id(),
                'title' => 'Booking Berhasil!',
                'message' => "Booking untuk {$this->room->name} berhasil dibuat. Kode booking: {$bookingCode}. Silakan menunggu konfirmasi dari admin.",
                'type' => 'booking',
                'is_read' => false,
            ]);

            // Create notification untuk admin
            $admins = \App\Models\User::where('role', 'pemilik')->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'title' => 'Booking Baru!',
                    'message' => "Booking baru dari {$this->name} untuk kamar {$this->room->name}. Kode: {$bookingCode}",
                    'type' => 'booking',
                    'is_read' => false,
                ]);
            }

            // Show success modal and redirect after 2 seconds
            $this->showModal = true;
            $this->modalType = 'success';
            $this->modalTitle = 'Booking Berhasil!';
            $this->modalMessage = "Booking Anda telah berhasil dibuat dengan kode booking: <strong>{$bookingCode}</strong>. Anda akan diarahkan ke halaman booking Anda.";
            $this->bookingCode = $bookingCode;
            
            // Flash message untuk halaman selanjutnya
            session()->flash('success', 'Booking berhasil dibuat! Kode booking: ' . $bookingCode);
            
            // Redirect ke halaman booking tenant setelah 2 detik
            $this->dispatch('booking-success');

        } catch (\Exception $e) {
            // Show error modal
            $this->showModal = true;
            $this->modalType = 'error';
            $this->modalTitle = 'Booking Gagal';
            $this->modalMessage = 'Terjadi kesalahan saat membuat booking. Silakan coba lagi.';
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->modalType = '';
        $this->modalTitle = '';
        $this->modalMessage = '';
        $this->bookingCode = '';
    }

    public function goToBookings()
    {
        return redirect()->route('tenant.bookings');
    }

    #[Title('Room Detail')]

    public function render()
    {
        return view('livewire.public.room-detail');
    }
}
