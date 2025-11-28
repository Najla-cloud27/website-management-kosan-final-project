<div>
    @include('layouts.partials.page-title', [
        'title' => 'Manajemen Booking',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Booking']
        ]
    ])

    {{-- Success & Error Messages --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i data-lucide="check-circle" class="icon-dual icon-xs me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i data-lucide="alert-circle" class="icon-dual icon-xs me-1"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-3">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="badge bg-primary rounded-circle p-3">
                                <i data-lucide="calendar" class="icon-sm"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">{{ $stats['total'] }}</h5>
                            <p class="text-muted mb-0 fs-13">Total Booking</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="badge bg-warning rounded-circle p-3">
                                <i data-lucide="clock" class="icon-sm"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">{{ $stats['pending'] }}</h5>
                            <p class="text-muted mb-0 fs-13">Pembayaran Tertunda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="badge bg-success rounded-circle p-3">
                                <i data-lucide="check-circle" class="icon-sm"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">{{ $stats['confirmed'] }}</h5>
                            <p class="text-muted mb-0 fs-13">Dikonfirmasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="badge bg-danger rounded-circle p-3">
                                <i data-lucide="x-circle" class="icon-sm"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">{{ $stats['cancelled'] }}</h5>
                            <p class="text-muted mb-0 fs-13">Dibatalkan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Cari kode booking, nama user, atau kamar...">
                </div>
                <div class="col-md-6">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pembayaran_tertunda">Pembayaran Tertunda</option>
                        <option value="dikonfirmasi">Dikonfirmasi</option>
                        <option value="dibatalkan">Dibatalkan</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Booking</th>
                            <th>User</th>
                            <th>Kamar</th>
                            <th>Durasi</th>
                            <th>Check-in</th>
                            <th>Status</th>
                            <th>Tanggal Booking</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td><strong>{{ $booking->booking_code }}</strong></td>
                            <td>
                                <div>{{ $booking->user->name }}</div>
                                <small class="text-muted">{{ $booking->user->email }}</small>
                            </td>
                            <td>{{ $booking->room->name }}</td>
                            <td>{{ $booking->duration_in_months }} bulan</td>
                            <td>{{ $booking->planned_check_in_date ? $booking->planned_check_in_date->format('d M Y') : '-' }}</td>
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
                                <div class="btn-group btn-group-sm">
                                    <button wire:click="editStatus({{ $booking->id }})" class="btn btn-soft-primary" title="Edit Status">
                                        <i data-lucide="edit" class="icon-xs"></i>
                                    </button>
                                    <button wire:click="deleteBooking({{ $booking->id }})" 
                                            wire:confirm="Apakah Anda yakin ingin menghapus booking ini?" 
                                            class="btn btn-soft-danger" 
                                            title="Hapus">
                                        <i data-lucide="trash-2" class="icon-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i data-lucide="inbox" class="icon-lg text-muted mb-2"></i>
                                <p class="text-muted mb-0">Tidak ada data booking</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Edit Status -->
    @if($showModal && $selectedBooking)
    <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status Booking</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><strong>Kode Booking:</strong></label>
                        <p>{{ $selectedBooking->booking_code }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>User:</strong></label>
                        <p>{{ $selectedBooking->user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Kamar:</strong></label>
                        <p>{{ $selectedBooking->room->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="newStatus" class="form-label">Status</label>
                        <select wire:model="newStatus" id="newStatus" class="form-select">
                            <option value="pembayaran_tertunda">Pembayaran Tertunda</option>
                            <option value="dikonfirmasi">Dikonfirmasi</option>
                            <option value="dibatalkan">Dibatalkan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Batal</button>
                    <button type="button" class="btn btn-primary" wire:click="updateStatus">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
