<div>
    @include('layouts.partials.page-title', [
        'title' => 'Dashboard Penyewa',
        'breadcrumbs' => [
            ['label' => 'Penyewa', 'url' => route('tenant.dashboard')],
            ['label' => 'Dashboard']
        ]
    ])

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Tagihan Belum Dibayar</h5>
                    <h2>{{ $stats['unpaid_bills'] }}</h2>
                    <a href="{{ route('tenant.billing.history') }}" class="btn btn-light btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Keluhan Aktif</h5>
                    <h2>{{ $stats['active_complaints'] }}</h2>
                    <a href="{{ route('tenant.complaints.index') }}" class="btn btn-light btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Booking Aktif</h5>
                    <h2>{{ $stats['active_bookings'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-megaphone"></i> Pengumuman Terbaru</h5>
        </div>
        <div class="card-body">
            @forelse($announcements as $announcement)
                <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                    <h6 class="mb-2">{{ $announcement->title }}</h6>
                    <p class="mb-1">{{ $announcement->content }}</p>
                    <small class="text-muted">
                        <i class="bi bi-clock"></i> {{ $announcement->created_at->format('d M Y, H:i') }}
                    </small>
                    @if($announcement->image_url)
                        <div class="mt-2">
                            <img src="{{ Storage::url($announcement->image_url) }}" class="img-fluid" style="max-height: 200px;">
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-muted mb-0">Belum ada pengumuman.</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Bills -->
    @if($recentBills->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-receipt"></i> Tagihan Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBills as $bill)
                                <tr>
                                    <td>{{ $bill->bill_code }}</td>
                                    <td>Rp {{ number_format($bill->total_amount, 0, ',', '.') }}</td>
                                    <td><span class="badge {{ status_badge_class($bill->status) }}">{{ format_status($bill->status) }}</span></td>
                                    <td>{{ $bill->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('tenant.billing.history') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
        </div>
    @endif

    <!-- Active Bookings -->
    @if($activeBookings->count() > 0)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-house-check"></i> Booking Aktif</h5>
            </div>
            <div class="card-body">
                @foreach($activeBookings as $booking)
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div>
                            <strong>{{ $booking->room->name }}</strong><br>
                            <small>Kode: {{ $booking->booking_code }}</small><br>
                            <small>Check-in: {{ $booking->planned_check_in_date ? $booking->planned_check_in_date->format('d M Y') : '-' }}</small>
                        </div>
                        <span class="badge {{ status_badge_class($booking->status) }}">
                            {{ format_status($booking->status) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Initialize Lucide icons after Livewire updates
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons({ icons: window.lucide.icons });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    });
</script>
@endpush
