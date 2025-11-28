<div>
    <!-- Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('tenant.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Booking Saya</li>
                    </ol>
                </div>
                <h4 class="page-title">Booking Saya</h4>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-calendar-check widget-icon bg-primary text-white"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Total Booking">Total Booking</h5>
                    <h3 class="mt-3 mb-3">{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-clock-outline widget-icon bg-warning text-white"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Pembayaran Tertunda">Pembayaran Tertunda</h5>
                    <h3 class="mt-3 mb-3">{{ $stats['pending'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-check-circle-outline widget-icon bg-success text-white"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Dikonfirmasi">Dikonfirmasi</h5>
                    <h3 class="mt-3 mb-3">{{ $stats['confirmed'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-close-circle-outline widget-icon bg-danger text-white"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Dibatalkan">Dibatalkan</h5>
                    <h3 class="mt-3 mb-3">{{ $stats['cancelled'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="header-title mb-0">Daftar Booking</h4>
                        <button wire:click="openBookingModal" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle me-1"></i> Booking Kamar Baru
                        </button>
                    </div>

                    <!-- Bookings Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kamar</th>
                                    <th>Durasi</th>
                                    <th>Check-in</th>
                                    <th>Selesai</th>
                                    <th>Status</th>
                                    <th>Tanggal Booking</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                <tr>
                                    <td><strong class="text-primary">{{ $booking->booking_code }}</strong></td>
                                    <td>
                                        <div>{{ $booking->room->name }}</div>
                                        <small class="text-muted">Rp {{ number_format($booking->room->price, 0, ',', '.') }}/bulan</small>
                                    </td>
                                    <td>{{ $booking->duration_in_months }} bulan</td>
                                    <td>{{ $booking->planned_check_in_date ? $booking->planned_check_in_date->format('d M Y') : '-' }}</td>
                                    <td>{{ $booking->selesai_booking ? $booking->selesai_booking->format('d M Y') : '-' }}</td>
                                    <td>
                                        @if($booking->status === 'pembayaran_tertunda')
                                            <span class="badge bg-warning">Pembayaran Tertunda</span>
                                        @elseif($booking->status === 'dikonfirmasi')
                                            <span class="badge bg-success">Dikonfirmasi</span>
                                        @elseif($booking->status === 'dibatalkan')
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @else
                                            <span class="badge bg-info">Selesai</span>
                                        @endif
                                    </td>
                                    <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        @if(in_array($booking->status, ['pembayaran_tertunda', 'dikonfirmasi']))
                                        <button wire:click="cancelBooking({{ $booking->id }})" 
                                                wire:confirm="Apakah Anda yakin ingin membatalkan booking ini?" 
                                                class="btn btn-sm btn-soft-danger">
                                            <i class="mdi mdi-close"></i> Batalkan
                                        </button>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="mdi mdi-calendar-blank mdi-48px d-block mb-2"></i>
                                            <p>Belum ada booking</p>
                                            <button wire:click="openBookingModal" class="btn btn-primary btn-sm">
                                                <i class="mdi mdi-plus-circle me-1"></i> Booking Sekarang
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    @if($showBookingModal)
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Booking Kamar Baru</h5>
                    <button type="button" class="btn-close" wire:click="closeBookingModal"></button>
                </div>
                <form wire:submit.prevent="submitBooking">
                    <div class="modal-body">
                        <!-- Pilih Kamar -->
                        <div class="mb-3">
                            <label for="selectedRoomId" class="form-label">Pilih Kamar <span class="text-danger">*</span></label>
                            <select wire:model="selectedRoomId" id="selectedRoomId" class="form-select @error('selectedRoomId') is-invalid @enderror">
                                <option value="">-- Pilih Kamar --</option>
                                @foreach($availableRooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }} - Rp {{ number_format($room->price, 0, ',', '.') }}/bulan</option>
                                @endforeach
                            </select>
                            @error('selectedRoomId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" id="name" class="form-control @error('name') is-invalid @enderror" readonly>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" wire:model="email" id="email" class="form-control @error('email') is-invalid @enderror" readonly>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="text" wire:model="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Durasi -->
                        <div class="mb-3">
                            <label for="duration" class="form-label">Durasi Sewa (Bulan) <span class="text-danger">*</span></label>
                            <select wire:model="duration" id="duration" class="form-select @error('duration') is-invalid @enderror">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }} Bulan</option>
                                @endfor
                            </select>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="mdi mdi-information-outline me-1"></i>
                            <small>Tanggal check-in otomatis diatur besok. Silakan hubungi admin jika ingin mengubah jadwal.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeBookingModal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-check-circle me-1"></i> Booking Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
